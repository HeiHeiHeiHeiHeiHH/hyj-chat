<?php
/**
 * Created by PhpStorm.
 * User: cdyf
 * Date: 17-8-23
 * Time: 下午3:15
 */

define("WORKER_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("APP_NAME", "WorkerMan测试用例");
require_once WORKER_PATH . 'vendor/autoload.php';

define("DEBUG", true);


if (DEBUG) {
    error_reporting(E_ALL);
} else {
    error_reporting(~E_ALL | ~E_WARNING);
}