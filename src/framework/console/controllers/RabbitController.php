<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 01/10/2019
 * Time: 16:21
 */

namespace console\controllers;


use common\components\rabbit\RabbitMQ;
use yii\console\Controller;

class RabbitController extends Controller
{

    public function actionIndex()
    {

    }

    public function actionRead()
    {
        $rabbit = new RabbitMQ();
        $rabbit->readRabbitMq();
    }

}
