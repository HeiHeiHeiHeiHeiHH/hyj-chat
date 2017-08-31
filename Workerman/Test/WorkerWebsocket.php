<?php
  use Workerman\Worker;
  require_once "../init.php";

  $WorkerWs = new Worker("websocket://0.0.0.0:4952");
  $WorkerWs->onMessage = function ($connection, $data)
  {
    $connection->send("Hello " . $data);
  };

  Worker::runAll();