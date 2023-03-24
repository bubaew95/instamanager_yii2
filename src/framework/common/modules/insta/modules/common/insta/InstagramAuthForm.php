<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 30/09/2019
 * Time: 21:34
 */

namespace common\modules\insta\modules\common\insta;

use InstagramAPI\Response\LoginResponse;
use yii\base\Model;
use yii\db\Exception;

class InstagramAuthForm extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            [['login', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }

    public function login()
    {
        try{
            $auth = InstaAuth::Init($this->login, $this->password);
            if($auth) {
                $_SESSION = [
                    'login' => $auth->username,
                    'id_user' => $auth->account_id
                ];
                return true;
            }
        }catch (Exception $ex) {
            $this->addError('password', $ex->getMessage());
        }
        return false;
    }

}
