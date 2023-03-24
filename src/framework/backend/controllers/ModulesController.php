<?php

namespace backend\controllers;

use common\models\entities\Module;

class ModulesController extends \yii\web\Controller
{

    public function actionIndex()
    {
        $modules = Module::find()->where(['active' => 1])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index', [
            'modules' => $modules
        ]);
    }

}
