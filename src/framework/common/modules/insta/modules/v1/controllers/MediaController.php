<?php

namespace common\modules\insta\modules\v1\controllers;

use common\components\constants\Constants;
use common\components\ModulesController;
use common\components\rabbit\RabbitMQ;
use common\models\instagram\InstagramModel;
use http\Exception;
use Yii;
use common\models\instagram\InstagramDataModel;
use common\modules\insta\modules\common\insta\MediaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MedController implements the CRUD actions for InstagramDataModel model.
 */
class MediaController extends ModulesController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'loadmedia' => ['POST'],
                ],
            ],
        ];
    }

    public function actionLoadmedia()
    {
        $model = InstagramModel::find()
            ->where(['id_project' => Constants::getProjectId()])
            ->andWhere(['id_user' => Constants::getUserId()])
            ->one();

        $rabbit = new RabbitMQ();
        $params = [
            'method'  => 'loadMedia',
            'data'    => [
                'login'         => $model->login,
                'pass'          => $model->password,
                'account_id'    => $model->user_acc_id,
                'id_user'       => 1,
                'id_project'    => 2,
                'id_module'     => $model->id
            ]
        ];
        try{
            $rabbit->sendMessageRabbit($params);
            return ['msg' => 'В процессе'];
        } catch (Exception $ex) {
            Yii::$app->response->setStatusCode(404);
            return ['msg' => $ex->getMessage()];
        }
    }

    /**
     * Lists all InstagramDataModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InstagramDataModel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new InstagramDataModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InstagramDataModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InstagramDataModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InstagramDataModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the InstagramDataModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InstagramDataModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InstagramDataModel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
