<?php


namespace common\modules\insta\modules\v1\controllers;


use common\components\ModulesController;
use common\components\constants\Constants;
use common\components\encryption\Encryption;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Yii;
use common\models\bots\Bots;
use common\models\instagram\InstagramModel;
use yii\web\Response;

class DefaultController extends ModulesController
{

    private function loadInstaInfo()
    {
        return InstagramModel::instaAccs(2,1)->one();;
    }

    public function actionIndex()
    {
        $model = $this->loadInstaInfo();
        if(!$model) {
            return $this->redirect( ['/insta/login'] );
        }

        $botModel = Bots::findOne(['id_instagram' => $model->id]);
        if(!$botModel) {
            $botModel = new Bots();
            $botModel->id_instagram = $model->id;
        }

        if($botModel->load(Yii::$app->request->post()) && $botModel->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }


        return $this->render('index', [
            'model' => $model,
            'bots' => $botModel,
        ]);
    }

    public function actionStatusbot($status = 0, $insta_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            $botModel = Bots::findOne(['id_instagram' => $insta_id]);
            if(!$botModel) {
                $botModel = new Bots();
                $botModel->id_instagram = $insta_id;
            }
            $instaModel = InstagramModel::findOne($insta_id);

            $comand = null;
            if($status == 1) {
                $comand = $this->processComandRun($instaModel);
            }

            echo $comand;die;
            if($status == 0) {
                $comand = "kill {$botModel->pid}";
            }


            $process = new Process($comand);
            $process->run();


            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $botModel->pid          = $process->getPid() != null ? ($process->getPid() + 1) : 0;
            $botModel->status       = $status;
            $botModel->created_at   = time();
            return $botModel->save();
        }
        return false;

    }

    private function processComandRun(InstagramModel $instaModel) : string
    {
        $passWord = Encryption::decrypt(Constants::HASH_KEY, $instaModel->password);
        $login = $instaModel->login;
        //nohup
        //$comand = "php {$_SERVER['DOCUMENT_ROOT']}/framework/yii realtime ";
        $comand = "{$_SERVER['DOCUMENT_ROOT']}/framework/yii realtime ";
        $comand .= "--login={$login} --pass={$passWord} > ";
        $comand .= "my_{$login}.log 2>&1 & echo $! > save_{$login}_pid.log";
        return $comand;
    }

}