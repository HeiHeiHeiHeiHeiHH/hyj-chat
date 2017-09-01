<?php
use Workerman\Worker;
require_once __DIR__ . DIRECTORY_SEPARATOR . "config.inc.php";

require_once HYJ_PATH . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
DEBUG ? error_reporting(E_ALL) : error_reporting(~E_ALL | ~E_WARNING);

$scriptsDir = HYJ_PATH . "Application/";
$handler = opendir($scriptsDir);
$files = array();
while (($filename = readdir($handler)) !== false) {
    if ($filename != '.' && $filename != '..' && is_file($scriptsDir . $filename)) {
        $files[] = $filename;
    }
}
if (!IS_OUTPIDFILE) {
    Worker::$pidFile = HYJ_PATH . "Log" . DIRECTORY_SEPARATOR . "workerman.pid";
}

closedir($handler);
foreach ($files as $file) {
    require_once HYJ_PATH . "Application" . DIRECTORY_SEPARATOR . $file;
}

if (GLOBAL_DEBUG) {
    Worker::$daemonize = true;
    Worker::$stdoutFile = STD_OUT;
    Worker::$logFile = DEBUG_LOG;
    Worker::runAll();
}

