<?php

namespace common\modules\shops\modules\v1\controllers;

use Yii;
use common\components\ModulesController;
use common\components\FrontendController;
use common\models\shops\Shops;

/**
 * Default controller for the `shops` module
 */
class DefaultController extends ModulesController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Shops();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }
}
