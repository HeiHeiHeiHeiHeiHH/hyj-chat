<?php

namespace Module;

class Help
{
    public static $instance ;

    public function instance()
    {
        if (!self::$instance) {
            return static::$instance = new static();
        }
        return static::$instance;
    }

    public static function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getData($key) {
        return isset($_GET[$key]) ? $_GET[$key] : '';
    }

    public static function postData($key) {
        return isset($_POST[$key]) ? $_POST[$key] : '';
    }

    public static function fileData($key) {
        return isset($_FILES[$key]) ? $_FILES[$key] : '';
    }

    public static function getUri()
    {
        $requrestUri = $_SERVER['REQUEST_URI'];
        $uri = explode("?", $requrestUri);

        return trim($uri[0], '/');
    }
}