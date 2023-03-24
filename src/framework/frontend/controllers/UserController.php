<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 19.04.2019
 * Time: 22:26
 */

namespace frontend\controllers;

use common\components\FrontendController;
use common\models\users\User;
use common\models\users\Userinfo;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use Yii;
use frontend\models\LoginForm;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class UserController extends FrontendController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'requestPasswordReset', 'resetPassword'],
                'rules' => [
                    [
                        'actions' => ['logout', 'signup', 'RequestPasswordReset', 'ResetPassword'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'favorite', 'myprofile', 'myread'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionMyprofile()
    {
        $id_user = Yii::$app->user->identity->getId();
        $model = User::find()->where(['id' => $id_user])->one();
        $modeInfo = Userinfo::find()->where(['id' => $id_user])->one();
        if(
            $model->load(Yii::$app->request->post()) &&
            $modeInfo->load(Yii::$app->request->post()) &&
            $model->save() &&
            $modeInfo->save()
        )
        {
            return $this->goBack();
        }
        return $this->render('myprofile', [
            'model' => $model,
            'modeInfo' => $modeInfo
        ]);
    }

    public function actionFavorite()
    {
        return $this->render('favorite', []);
    }

    public function actionMyread()
    {
        return $this->render('myread', []);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $loginForm = new LoginForm();
        $regForm = new SignupForm();
        return $this->render('index', [
            'modelLogin' => $loginForm,
            'modelReg' => $regForm,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post())) {
            if($model->checkOfResetPassword()) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            if($model->login()) {
                return $this->goBack();
            }
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        $model->scenario = SignupForm::SCENARIO_CREATE;
        $errors = [];
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
            'errors' => $errors
        ]);
    }



    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}