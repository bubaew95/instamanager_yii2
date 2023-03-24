<?php
namespace frontend\models;

use yii\base\Model;
use common\models\users\User;
use common\models\users\Userinfo;
use yii\db\Exception;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $last_sur_name;
    public $password;
    public $repassword;
    public $phone;
    public $home_address;
    public $work_or_school;

    const SCENARIO_CREATE = 'create';
    const SCENARIO_PROFILE = 'profile';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            [
                'email', 'unique',
                'targetClass' => 'common\models\users\User',
                'message' => 'Такой e-mail уже существует.',
                'on' => self::SCENARIO_CREATE
            ],
            ['email', 'string', 'min' => 2, 'max' => 255],

            [['last_sur_name', 'home_address', 'work_or_school', 'phone'], 'required'],
            [['last_sur_name', 'home_address', 'work_or_school', 'phone'], 'string', 'min' => 2, 'max' => 255],
            [['new'], 'safe'],

            [['password', 'repassword'], 'required'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 32],
            [['repassword'], 'validatePasswordRepassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Ваш E-mail',
            'last_sur_name' => 'ФИО',
            'home_address' => 'Домашний адрес',
            'work_or_school' => 'Место работы или учебное заведение',
            'phone' => 'Телефон',
            'password' => 'Пароль',
            'repassword' => 'Подтвердить пароль',
        ];
    }

    public function validatePasswordRepassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if($this->password != $this->repassword) {
                $this->addError($attribute, 'Пароли не совпадают');
            }
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $transaction = \Yii::$app->db->beginTransaction();
        try{
            $userInfo = new Userinfo();
            $userInfo->last_sur_name = $this->last_sur_name;
            $userInfo->home_address = $this->home_address;
            $userInfo->work_or_school = $this->work_or_school;
            $userInfo->phone = $this->phone;
            $userInfo->new = '1';
            $userInfo->save();

            $user = new User();
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->link('userinfo', $userInfo);
            $transaction->commit();
            return $user;
        }catch (Exception $ex) {
            $transaction->rollBack();
        }
        return false;
    }
}
