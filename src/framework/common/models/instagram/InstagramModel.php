<?php

namespace common\models\instagram;

use common\models\bots\Bots;
use common\models\projects\Projects;
use common\models\users\Users;
use Yii;

/**
 * This is the model class for table "{{%instagram}}".
 *
 * @property int $id
 * @property int $id_project ID проекта
 * @property int $id_user ID клиента
 * @property string $user_acc_id ID в интаграме
 * @property string $avatar Аватарка
 * @property string $bg Фоновое изображение
 * @property string $login Логин инстаграма
 * @property string $password Пароль инстаграма
 * @property int $allowdirect Ответить на запросы в директ
 * @property int $answercomment Ответить на комментарий в директ
 * @property int $created_at Дата добавления
 * @property int $updated_at Дата обновления
 *
 * @property Bots[] $bots
 * @property Projects $project
 * @property Users $user
 * @property InstagramDataModel[] $instagramDatas
 * @property InstagramDirect[] $instagramDirects
 */
class InstagramModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%instagram}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'id_user', 'user_acc_id', 'login', 'password'], 'required'],
            [['id_project', 'id_user', 'user_acc_id', 'allowdirect', 'answercomment', 'created_at', 'updated_at'], 'integer'],
            [['avatar', 'bg', 'login', 'password'], 'string', 'max' => 255],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_project' => 'ID проекта',
            'id_user' => 'ID клиента',
            'user_acc_id' => 'ID в интаграме',
            'avatar' => 'Аватарка',
            'bg' => 'Фоновое изображение',
            'login' => 'Логин инстаграма',
            'password' => 'Пароль инстаграма',
            'allowdirect' => 'Ответить на запросы в директ',
            'answercomment' => 'Ответить на комментарий в директ',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function instaAccs($id_project, $id_user)
    {
        return InstagramModel::find()->projectInstagramAcc($id_project, $id_user);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBots()
    {
        return $this->hasMany(Bots::className(), ['id_instagram' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'id_project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagramDatas()
    {
        return $this->hasMany(InstagramDataModel::className(), ['id_instagram' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagramDirects()
    {
        return $this->hasMany(InstagramDirect::className(), ['id_instagram' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return InstagramQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstagramQuery(get_called_class());
    }
}
