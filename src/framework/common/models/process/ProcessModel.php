<?php

namespace common\models\process;

use common\models\projects\Projects;
use common\models\users\Users;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%process}}".
 *
 * @property int $id
 * @property int $id_user Пользователь
 * @property int $id_project Проект
 * @property int $isProcess Процесс
 * @property string $key Ключ
 * @property int $created_at Дата процесса
 * @property int $updated_at Дата обновления
 *
 * @property Users $user
 * @property Projects $project
 */
class ProcessModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%process}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_project'], 'required'],
            [['id_user', 'id_project', 'isProcess', 'created_at', 'updated_at'], 'integer'],
            [['key'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['id_project' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
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
            'isProcess' => 'Процесс',
            'key' => 'Ключ',
            'created_at' => 'Дата процесса',
            'updated_at' => 'Дата обновления',
        ];
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
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'id_project']);
    }

    /**
     * {@inheritdoc}
     * @return ProcessQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProcessQuery(get_called_class());
    }
}
