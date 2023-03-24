<?php


namespace frontend\controllers;


use common\components\FrontendController;

class CatalogController extends FrontendController
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSingle()
    {
        return $this->render('single');
    }

}