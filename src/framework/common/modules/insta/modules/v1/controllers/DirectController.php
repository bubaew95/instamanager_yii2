<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 04/10/2019
 * Time: 00:20
 */

namespace common\modules\insta\modules\v1\controllers;

use common\components\constants\Constants;
use common\components\encryption\Encryption;
use common\components\ModulesController;
use common\models\instagram\InstagramDirect;
use common\models\instagram\InstagramMessages;
use common\models\instagram\InstagramModel;
use common\modules\insta\modules\common\insta\InstaAuth;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Response;


class DirectController extends ModulesController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'sendmessage' => ['post'],
                ],
            ],
        ];
    }

    public function actionLoad()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return InstagramDirect::find()->asArray()->all();
    }

    public function actionMess()
    {
        $model = InstagramModel::find()
            ->where(['id_project' => Constants::getProjectId()])
            ->andWhere(['id_user' => Constants::getUserId()])
            ->one();
        $password = Encryption::decrypt(Constants::HASH_KEY, $model->password);
        $ig = InstaAuth::Init($model->login, $password);

        $direct = $ig->direct->getThreadByParticipants([1324751131]);

        debug($direct);
    }

    /**
     * Вывод пользователей, в директе
     * @return string
     */
    public function actionIndex()
    {
        $model = InstagramDirect::find()->where(['id_project' => Constants::getProjectId()])->orderBy(['id' => SORT_DESC])->all();

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Сообщения чата
     * @return string
     */
    public function actionItems()
    {
        $post = Yii::$app->request->post();
        $id_direct = $post['id_direct'];
        $thread_id = $post['thread_id'];

        $model = InstagramMessages::find()
            ->where(['id_direct' => $id_direct])
            ->all();
        return $this->renderAjax('items', [
            'model' => $model,
            'thread_id' => $thread_id
        ]);
    }

    public function actionSendmessage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model      = InstagramModel::findOne(1);
        $passWord   = Encryption::decrypt(Constants::HASH_KEY, $model->password);
        $ig         = InstaAuth::Init($model->login, $passWord);
        if(empty($ig->uuid)) return null;
        $post = Yii::$app->request->post();
        $res = $ig->direct->sendText(['thread' => $post['thread_id']], $post['text']);
        return $res;
    }

}