<?php


namespace common\modules\shops\modules\v1\controllers;


use common\components\ModulesController;

class OrdersController extends ModulesController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}