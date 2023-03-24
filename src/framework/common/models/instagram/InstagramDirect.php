<?php

namespace common\models\instagram;

use common\models\projects\Projects;
use common\models\users\Users;
use Yii;

/**
 * This is the model class for table "{{%instagram_direct}}".
 *
 * @property int $id
 * @property int $id_user Пользователь
 * @property int $id_project Проект
 * @property int $id_instagram ID инстаграм
 * @property string $thread_id ID диалога
 * @property string $user_id ID собеседника
 * @property string $user_name Логин собеседника
 * @property string $img Изображение
 * @property boolean $isType Печатает
 * @property int $created_at Дата добавления
 *
 * @property Projects $project
 * @property Users $user
 * @property Instagram $instagram
 * @property InstagramMessages[] $instagramMessages
 */
class InstagramDirect extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%instagram_direct}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_project', 'thread_id', 'user_id'], 'required'],
            [['id_user', 'id_project', 'id_instagram', 'user_id', 'created_at', 'isType'], 'integer'],
            [['thread_id', 'user_name'], 'string', 'max' => 255],
            ['img', 'string', 'max' => 512],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_instagram'], 'exist', 'skipOnError' => true, 'targetClass' => InstagramModel::className(), 'targetAttribute' => ['id_instagram' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Пользователь',
            'id_project' => 'Проект',
            'id_instagram' => 'ID инстаграм',
            'thread_id' => 'ID диалога',
            'user_id' => 'ID собеседника',
            'user_name' => 'Логин собеседника',
            'created_at' => 'Дата добавления',
            'img'   => 'Изображение',
        ];
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
    public function getInstagram()
    {
        return $this->hasOne(InstagramModel::className(), ['id' => 'id_instagram']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagramMessages()
    {
        return $this->hasMany(InstagramMessages::className(), ['id_direct' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return InstagramDirectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstagramDirectQuery(get_called_class());
    }
}
