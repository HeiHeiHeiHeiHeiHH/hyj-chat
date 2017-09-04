<?php

namespace Lib;
use Workerman\Protocols\Http;

class Core
{

    public static function run() {
        if (!get_magic_quotes_gpc()) {
            try {
                $_GET = self::addslashes($_GET);
                $_POST = self::addslashes($_POST);
                $_FILES = self::addslashes($_FILES);
                $_REQUEST = self::addslashes($_FILES);
            } catch (\Exception $e) {
                Http::end($e->getMessage());
            }
        }
    }

    public static function addslashes($data) {
        if (is_array($data)) {
            foreach ($data as $key=>$value) {
                $data[$key] = self::addslashes($value);
            }
            return $data;
        }

        return addslashes($data);
    }

    public static function dispatch() {
        $controllerAndMethod = self::getControllerAndMethod();
        extract($controllerAndMethod);
        $namespace = self::isClassFile($controllerDir, $controllerFile); // 判断指定的命名空间是否存在 不存在获取默认的
        if (!method_exists($namespace, $controllerMethod)) {
            $controllerMethod = 'defaultMethod';
        }

        $namespace::instance()->$controllerMethod();
    }

    public static function getControllerAndMethod() {
        $requestUri = $_SERVER['REQUEST_URI'];
        if (!$requestUri) {
            return array(
                "controllerDir"  => '',
                "controllerFile" => 'Auth',
                "controllerMethod" => "Auth"
            );
        }
        $controllerDir = '';
        $controllerFile = '';
        $controllerMethod = '';
        $explodeUri = explode('?', $requestUri);
        $pwdInfo = explode('/', trim($explodeUri[0], '/'));
        $tmpPwd = 'App/';
        foreach ($pwdInfo as $value) {
            if (is_dir(CHAT_PATH . 'App/' . $value)) {
                $tmpPwd .= $value . '/';
                $controllerDir .=   $value;
                continue;
            }
            if (is_file(CHAT_PATH . $tmpPwd . '/' . $value . '.php')) {
                $controllerFile = $value;
                continue;
            }

            $controllerMethod = $value;
        }

        $controllerMethod = $controllerMethod == '' ? 'Index' : $controllerMethod;

        return array(
            'controllerDir' => $controllerDir,
            'controllerFile' => $controllerFile,
            'controllerMethod'  => $controllerMethod
        );
    }

    public static function isClassFile($controllerDir, $controllerFile) {
        if (!$controllerFile) {
            return "App\\Auth";
        } else {
            $init = "Appt\\Auth";
            if (class_exists("App\\$controllerDir" . "\\$controllerFile")) {
                return "App\\$controllerDir\\$controllerFile";
            }

            return $init;
        }
    }
}