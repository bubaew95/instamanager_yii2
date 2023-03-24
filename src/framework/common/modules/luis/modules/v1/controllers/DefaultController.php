<?php


namespace common\modules\luis\modules\v1\controllers;


use common\components\constants\Constants;
use common\models\luis\Luis;
use Yii;
use common\components\FrontendController;

class DefaultController extends FrontendController
{

    public function actionIndex()
    {
        $model  = Luis::findOne(['id_project' => Constants::getProjectId()]);
        if(empty($model)) {
            $model = new Luis();
        }
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }


}