<?php

namespace common\modules\shops\modules\v1\controllers;

use common\components\constants\Constants;
use Yii;
use common\components\ModulesController;
use common\components\FrontendController;
use common\models\shops\Shops;
use yii\web\UploadedFile;

/**
 * Default controller for the `shops` module
 */
class SettingsController extends ModulesController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $id_project = Constants::getProjectId();
        $model = Shops::findOne(['id_project' => $id_project]);
        if(!$model) {
            $model = new Shops();
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->id_project = Constants::getProjectId();
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if(!empty($model->imageFile)) {
                $model->upload();
            }
            if ($model->save()){
                return $this->redirect(Yii::$app->request->referrer);
            } else
                debug($model->errors);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
