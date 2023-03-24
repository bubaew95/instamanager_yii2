<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 30/09/2019
 * Time: 21:35
 */

namespace common\modules\insta\modules\common\insta;


use common\components\constants\Constants;
use common\components\encryption\Encryption;
use Yii;
use common\models\instagram\InstagramModel;
use yii\base\Exception;
use yii\base\Model;

class InstagramForm extends Model
{

    public $id_project;
    public $login;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['id_project', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function login()
    {
        if($this->validate()) {
            $ig = InstaAuth::Init($this->login, $this->password, false,false);
            if($ig) {
                sleep(2);
                $userById = $ig->people->getInfoById($ig->account_id);
                if($userById) {
                    $userInfo = $userById->getUser();
                    $id_user = 1; //Yii::$app->user->identity->getId();

                    $transaction = Yii::$app->db->beginTransaction();
                    try {
                        $instaDB                 = new InstagramModel();
                        $instaDB->user_acc_id    = $ig->account_id;
                        $instaDB->login          = $this->login;
                        $instaDB->password       = Encryption::encrypt(Constants::HASH_KEY, $this->password);
                        $instaDB->id_project     = $this->id_project;
                        $instaDB->id_user        = $id_user;
                        $instaDB->avatar         = $userInfo->getProfilePicUrl();
                        $instaDB->bg             = $userInfo->getHdProfilePicUrlInfo()->getUrl();

                        $transaction->commit();
                        if(!$instaDB->save()) {
                            \Yii::$app->session->setFlash('warning', print_r($instaDB->errors));
                            return false;
                        }
                        return true;
                    } catch (Exception $e) {
                        $transaction->rollback();
                        \Yii::$app->session->setFlash('danger', $e->getMessage());
                        return false;
                    }
                }
            }else {
                //\Yii::$app->session->setFlash('danger', 'Ошибка авторизации');
                $this->addError('password', 'Ошибка авторизации');
            }
        }
    }

}
