<?php
define("TEST_PATH", __DIR__ . DIRECTORY_SEPARATOR);
require_once "../../vendor/Bootstrap/Autoloader.php";

\Bootstrap\Autoloader::instance()->addRoot(TEST_PATH)->init();

$data = array(
    'hyj_name'  => 'Avicii',
    'hyj_token' => md5(226198),
    'hyj_phone' => '15928634421',
    'hyj_mail'  => 'zhongqil@jumei.com',
    'hyj_sex'   =>  'true',
    'hyj_age'   =>  '23',
    'hyj_uid'   =>  mt_rand('1000000000', '9999999999')
);

$hehe = Module\Db::instance(false,"write");

if ($hehe->exec("insert", "chat_auth", $data,'')) {
    echo "YEs";
} else {
    echo "No";
}