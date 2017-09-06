<?php
namespace App;
use \Workerman\Protocols\Http;

class Base
{
    public static $tipMessage; //相应用户对应的某些通知消
    public $tmpUid = '2261984952';
    const TMP_DIR = CHAT_PATH . 'Tpl/';
    public static $instance;

    public static function instance()
    {
        if (!self::$instance) {
            return self::$instance = new static();
        }

        return self::$instance;
    }

    public function defaultMethod() {
        echo "404 NOT FIND";
    }

    public function setMessage($msg, $uid) {
        if (!$uid) {
            self::$tipMessage[$this->tmpUid] = $msg;
        }
        self::$tipMessage[$uid] = $msg;
    }

    public function getMessage($uid) {
        if ($uid) {
            return isset(self::$tipMessage[$uid]) ? self::$tipMessage[$uid] : 'there is nothing to say ~' ;
        } else {
            return isset(self::$tipMessage[$this->tmpUid]) ? self::$tipMessage[$this->tmpUid] : 'So What the FUCK~';
        }
    }

    public function Assign($data)
    {
        if (is_file(self::TMP_DIR . 'Head/Head.php')) {
            require_once  self::TMP_DIR . 'Head/Head.php';
        } else {
            Http::end("there is not a tpl to choice~");
        }
    }
}