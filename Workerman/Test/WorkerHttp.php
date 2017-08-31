<?php
  use Workerman\Worker;
  require_once '../init.php';

  $http_worker = new Worker("http://0.0.0.0:4952");

  $http_worker->count = 4;

  $http_worker->onMessage = function ($connection, $data)
  {
    $connection->send('Hello World~~~');
  };

  Worker::runAll();
