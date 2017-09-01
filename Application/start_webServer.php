<?php
use \Workerman\Worker;
use \Workerman\WebServer;
$webserver = new WebServer("http://0.0.0.0:8848");
$webserver->count = 6;
$webserver->addRoot("www.hyj.com", HYJ_WED);

if (!GLOBAL_DEBUG) {
    #Worker::$daemonize = true;
    Worker::$stdoutFile = STD_OUT;
    Worker::$logFile = DEBUG_LOG;
    Worker::runAll();
}