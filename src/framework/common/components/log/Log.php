<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 03/10/2019
 * Time: 18:29
 */

namespace common\components\log;


class Log
{

    const WEBHOOK_HOST = 'https://www.webhook.site/b63be8ff-e5c4-4ad9-98a8-04a0eaff3289?';

    public static function writeToLog($data, $title = '', $name = null) {
        $log = "\n------------------------\n";
        $log .= date("d.m.Y G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, 1);
        $log .= "\n------------------------\n";
        $logName = date('Y-m-d');
        if(!empty($name)) {
            $logName= $name;
        }
        file_put_contents(
            __DIR__ ."/log_{$logName}.log",
            $log,
            FILE_APPEND
        );
        return true;
    }

    public static function sendHook($params)
    {
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json',
                'content' => json_encode($params)
            )
        );
        $context  = stream_context_create($opts);

        return file_get_contents(self::WEBHOOK_HOST, false, $context );
    }


}
