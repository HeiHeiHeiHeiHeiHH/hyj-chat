<?php
define("TEST_PATH", __DIR__ . DIRECTORY_SEPARATOR);
require_once "../../vendor/Bootstrap/Autoloader.php";

\Bootstrap\Autoloader::instance()->addRoot(TEST_PATH)->init();

$data = array(
    'hyj_name'  => 'Avicii',
    'hyj_token' => md5(226198),
    'hyj_phone' => '15928634421',
    'hyj_mail'  => 'zhongqil@jumei.com',
    'hyj_sex'   =>  1,
    'hyj_age'   =>  '23',
    'hyj_uid'   =>  mt_rand('1000000000', '9999999999')
);

$datas = array(
    "0" =>  $data,
    "1" => array(
        'hyj_name'  => "The_Chainsmoker",
        'hyj_token' => md5(226198),
        'hyj_phone' => '12121212111',
        'hyj_mail'  => '461099652@qq.com',
        'hyj_sex'   => '0',
        'hyj_age'   => '12',
        'hyj_uid'   => mt_rand(1000000000,9999999999)
    )
);

$condition = array(
    'hyj_name'  => 'Avicii'
);


#$hehe = Module\Db::instance(false,"write");

$hehe = Module\Db::instance(false, "write");

if ($hehe->exec("insert", "chat_auth", $datas, '')) {
    echo "YEs";
} else {
    echo "No";
}