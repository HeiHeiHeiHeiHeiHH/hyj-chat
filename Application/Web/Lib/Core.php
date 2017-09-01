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
        $namespace = self::isClassFile($namespace); // 判断指定的命名空间是否存在 不存在获取默认的

        if (!method_exists($namespace, $method)) {
            http::end("请访问一个已知的方法～");
        }

        return array(
            "namespace" => $namespace,
            "method"    => $method
        );
    }

    public static function getControllerAndMethod() {
        $requestUri = trim($_SERVER['REQUEST_URI'], '/');
        if (!$requestUri) {
            return array(
                "namespace" => "App\Auth",
                "method" => "Index"
            );
        }
        $explodeUri = explode("?", $requestUri);
        $controllerPwd = $explodeUri['0'];

        $explodePwd = explode("/", $controllerPwd);
        $namespace = "App\\";
        $method = '';
        foreach ($explodePwd as $value) {
            if (is_dir(CHAT_PATH . "App/" . "$value")) {
                $namespace .= $value . "\\";
                continue;
            }

            if (is_file(CHAT_PATH . "App/" . "$value" . ".php")) {
                $namespace .= $value;
                continue;
            }

            $method = $value;
        }

        $method = $method == '' ? 'Index' : $method;

        return array(
            "namespace" => $namespace,
            "method"    => $method
        );
    }

    public static function isClassFile($namespace) {
        if (!$namespace) {
            return "App\Auth";
        } else {
            $init = "App\Auth";
            if (class_exists($namespace))
                return $namespace;

            return $init;
        }
    }
}