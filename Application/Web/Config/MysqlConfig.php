<?php

namespace Config;

class MysqlConfig{

    public static $read = array(
        'dsn'   => 'mysql:dbname=chat_hyj;host=localhost',
        'user'  => 'chatread',
        'password'  =>  '226198',
        'option'    =>  array()
    );

    public static $write = array(
        'dsn'   => 'mysql:dbname=chat_hyj;host=localhost',
        'user'  => 'chatwrite',
        'password'  =>  '226198',
        'option'    => array()
    );
}