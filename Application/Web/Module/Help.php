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

    /**
     * 以后再说～.
     *
     * @param string $key  key.
     *
     * @return boolean;
     */
    public static function fileData($key) {
        //TODO 不知道弄啥～～～
        return true;
    }

    public static function getUri()
    {
        $requrestUri = $_SERVER['REQUEST_URI'];
        $uri = explode("?", $requrestUri);

        return trim($uri[0], '/');
    }
}