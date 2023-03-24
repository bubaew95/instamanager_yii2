<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 04/10/2019
 * Time: 00:52
 */

namespace console\controllers;


use yii\console\Controller;

class SocketController extends Controller
{

    public function actionIndex()
    {
        if(extension_loaded('sockets')) echo "WebSockets OK";
        else echo "WebSockets UNAVAILABLE";
    }

}