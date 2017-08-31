<?php
  use Workerman\Worker;
  use Workerman\Lib\Timer;
  require_once "../init.php";

  $Worker = new Worker("tcp://0.0.0.0:4952");
  $Worker->name = "HYJ";
  $Worker->onMessage = function ($connection, $data) {
    global $Worker;
    $connection->send("$Worker->name is connected, and the client said $data");
  };

  Worker::runAll();
