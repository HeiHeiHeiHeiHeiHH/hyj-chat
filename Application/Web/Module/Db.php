<?php

namespace Module;

use Db\Exception;

class Db
{
    public static $instance = array();
    protected $timeout = "300";

    protected $is_autocommit = false;

    protected $is_persistent = false;

    protected static $config = '';

    public $commitSql;

    protected $connection;

    public function __construct(bool $persistent = false, $connectType = "read")
    {
        if ($persistent) {
            $this->is_persistent = $persistent;
        }
        if (!self::$config) {
            if (!class_exists('\Config\MysqlConfig')) {
                exit("There is not a config file for connection mysql database!");
            }
            self::$config = new \Config\MysqlConfig();
        }

        $this->connect($connectType);
    }

    protected function connect($type)
    {
        $mysqlConfig = self::$config::${$type};
        try {
            $this->connection = new \PDO($mysqlConfig['dsn'], $mysqlConfig['user'], $mysqlConfig['password'], array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                \PDO::ATTR_PERSISTENT => $this->is_persistent,
                \PDO::ATTR_TIMEOUT => $this->timeout
            ));
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            exit("connect refuse, please checkout!!!");
        }
    }

    public static function instance(bool $persistent = false, $connectType = "read")
    {
        if (!isset(self::$instance["$connectType"])) {
            return self::$instance["$connectType"] = new self($persistent, $connectType);
        }
        return self::$instance["$connectType"];
    }

    /**
     * insert操作的预处理语句
     *
     * @param string  $table   table_name.
     * @param array   $data    data.
     *
     * @return string
     */
    public function prepareInsert($table, $data)
    {
        $fields = array_keys($data);
        $fieldstring = implode(",", $fields);
        $valuearray = array_map(function ($value) {
            return ":" . $value;
        }, $fields);
        $valuestring = implode(",", $valuearray);

        return "insert into $table ($fieldstring) values ($valuestring)";

    }

    /**
     * 删除语句 注意使用时需检测是否有条件语句 否则不予执行～
     *
     * @param string $table table_name.
     *
     * @return string
     */
    public function prepareDelete($table)
    {
        return  "delete from $table";
    }

    //$data更新的数据 键值对统一
    public function prepareUpdate($table, $data)
    {
        if (!is_array($data)) {
            $data = array($data);
        }
        $fieldsarray = array_keys($data);
        $fieldstring = '';
        foreach ($fieldsarray as $value) {
            $fieldstring .= "$value = :$value,";
        }
        $fieldstring = trim($fieldstring, ",");


        return "UPDATE $table SET $fieldstring";
    }
    // $data 查询的字段值
    public function prepareSelect($table, $data)
    {
        if (!is_array($data)) {
            $data = array($data);
        }
        $fieldstring = '';
        foreach ($data as $value) {
            $fieldstring .= $value . ",";
        }
        $fieldstring = trim($fieldstring, ",");
        return "select $fieldstring from $table";
    }

    //主要在执行更新与删除操作时检测是否具有条件语句
    public function checkSomeSqlHasCondition()
    {
        if (strpos($this->commitSql, "WHERE") === false) {
            return false;
        }
        return true;
    }

    public function buildWhere($condition)
    {

    }

    public function bindParam($data, &$execSql)
    {
        foreach ($data as $key => $value) {
            $execSql->bindParam(":$key", $value);
        }
    }

    /**
     * 执行.
     *
     * @param string $type 操作类型.
     * @param array $data data.
     * @param string $table 指定数据表.
     * @param array $condition 条件.
     *
     * @return boolean
     */
    public function exec($type,$table, $data, $condition = '')
    {
        if (!$type) {
            exit("Please choice a way to use database~~~");
        }
        if (!$table) {
            exit("Please choice a table to use~~~~");
        }
        switch ($type) {
            case "select":
                return $this->execSelect($table, $data, $condition);
                break;
            case "insert":
                return $this->execInsert($table, $data);
                break;
            case "update":
                return $this->execUpdate($table, $data, $condition);
                break;
            case "delete":
                return $this->execDelete($table, $condition);
                break;
            default:
                exit("Please choice a right way to use database~~~");
                break;
        }
    }

    public function execSelect($table, $data, $condition)
    {
        $this->commitSql = $this->prepareSelect($table, $data);
        if (!empty($condition)) {
            $this->commitSql .= $this->buildWhere($condition);
        }
        $execSql = $this->connection->prepare($this->commitSql);
        $this->bindParam($data, $execSql);
        $result = $execSql->execute();
        if ($result) {
            return array('status' => $result,
                         'result' => $execSql->fetchAll());
        }
        return $result;
    }

    public function execInsert($table, $data)
    {
        if (count($data) == count($data, COUNT_RECURSIVE)) {
            $this->commitSql = $this->prepareInsert($table, $data);
            $execSql = $this->connection->prepare($this->commitSql);

            foreach ($data as $key => $va) {
                $execSql->bindParam(":$key", $va);
            }

            $execSql->execute();
            var_dump($execSql->errorInfo());
        }

        try{
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->connection->beginTransaction();

            $this->commitSql = $this->prepareInsert($table, $data[0]);
            $execSql = $this->connection->prepare($this->commitSql);
            foreach ($data as $datum) {
                $this->bindParam($datum, $execSql);
                $execSql->execute();
            }
            return true;
        } catch (\PDOException $exception) {
            $this->connection->roolBack();
            return false;
        }
    }

    public function execUpdate($table, $data, $condition)
    {
        $this->commitSql = $this->prepareUpdate($table, $data);
        if (!empty($condition)) {
            $this->commitSql .= $this->buildWhere($condition);
        }
        if (!$this->checkSomeSqlHasCondition()) {
            exit("There must be a condition when you do Delete or Update~~~~");
        }

        $execSql = $this->connection->prepare($this->commitSql);
        $this->bindParam($data, $execSql);

        return $execSql->execute();
    }

    public function execDelete($table, $condition)
    {
        if (empty($condition)) {
            exit("There must be a condition when you do Delete or Update~~~~");
        }
        if (count($condition) == count($condition,COUNT_RECURSIVE)) {
            $this->commitSql = $this->prepareDelete($table);
            $this->commitSql .= $this->buildWhere($condition);
            $execSql = $this->connection->prepare($this->commitSql);

            return $execSql->execute();
        }

        try {
            $this->connection->setAtterbute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->connection->beginTransation();

            foreach ($condition as $value) {
                $sql = $this->prepareDelete($table);
                $sql .= $this->buildWhere($value);

                $execSql = $this->connection->prepare($sql);

                $execSql->excute();
            }

            return true;
        } catch (\PDOException $exception) {
            $this->connection->rollBack();
            return false;
        }
    }
}