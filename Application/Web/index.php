<?php
use Lib\Core;
use App\Auth;
use App\Controller\Chat;
use Workerman\Protocols\Http;

date_default_timezone_set("Asia/Chongqing");
define("CHAT_PATH", __DIR__ . DIRECTORY_SEPARATOR);
define("CHAT_DEBUG", true);
require_once CHAT_PATH . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once CHAT_PATH . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor'. DIRECTORY_SEPARATOR . 'Bootstrap' . DIRECTORY_SEPARATOR . 'Autoloader.php';

\Bootstrap\Autoloader::instance()->addRoot(CHAT_PATH)->init();
if (CHAT_DEBUG) {
    error_reporting(E_ALL);
} else {
    error_reporting(~E_ALL | ~E_WARNING);
}

session_start();

Core::run();
try {
    $controllerInfo = Core::dispatch();
} catch (\Exception $exception) {
    http::end($exception->getMessage());
}




