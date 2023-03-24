<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 30/09/2019
 * Time: 20:45
 */

namespace common\modules\insta\modules\v1\controllers;


use common\components\ModulesController;
use common\components\FrontendController;
use common\models\instagram\InstagramModel;
use common\modules\insta\modules\common\insta\InstagramForm;
use Yii;
use yii\helpers\Url;

class LoginController extends ModulesController
{

    public function actionIndex()
    {
        $request = 1;//Yii::$app->request->get();
        $modelDbAcc = InstagramModel::instaAccs(2, 1)->one();
        if($modelDbAcc) {
            return $this->redirect( Url::to(['/insta']) );
        }

        $model = new InstagramForm();
        $model->id_project = 2; //$request['project_id'];

        if($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect( Url::to(['/insta']) );
        }

        return $this->render('index', [
           'model' => $model
        ]);
    }

}