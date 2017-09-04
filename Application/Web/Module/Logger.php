<?php
namespace Module;

class Logger
{
    const DEFAULT_FILEPATH = CHAT_PATH . 'Log';

    public static function writeLog($message, $logKind = 'Log_in')
    {
        $fileDir = self::DEFAULT_FILEPATH . DIRECTORY_SEPARATOR . $logKind;
        if (!is_dir($fileDir)) {
            mkdir($fileDir, 0775, true);
        }
        $fileName = date('Ymd') . '.log';
        $messages = date('Y-m-d H:i:s') . chr(9);
        foreach ($message as $value) {
            $messages .= $value . '|';
        }
        $messages = trim($messages, '|') . PHP_EOL;
        error_log($messages, 3, $fileDir . DIRECTORY_SEPARATOR . $fileName);
    }
}