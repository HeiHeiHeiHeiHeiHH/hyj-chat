<?php
use Lib\Core;
use App\Auth;
use App\Controller\Chat;
use Workerman\Protocols\Http;
require_once HYJ_PATH . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

date_default_timezone_set("Asia/Chongqing");
define("CHAT_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("CHAT_DEBUG", true);

if (CHAT_DEBUG) {
    error_reporting(E_ALL);
} else {
    error_reporting(~E_ALL | ~E_WARNING);
}

session_start();

Core::run();
try {
    $controllerInfo = Core::dispatch();
    $Object = new $controllerInfo['namespace'];
    $Object->$controllerInfo['method']();
} catch (\Exception $exception) {
    http::end($exception->getMessage());
}




