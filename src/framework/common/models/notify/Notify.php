<?php

namespace common\models\notify;

use common\models\users\Users;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%notify}}".
 *
 * @property int $id
 * @property int $id_user Пользователь
 * @property string $status Статус оповещения
 * @property string $text Текст оповещения
 * @property int $isAllPage Оповещение на всю страницу
 * @property int $created_at Дата оповещения
 * @property int $isSaw Клиент видел
 *
 * @property Users $user
 */
class Notify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%notify}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'status', 'text'], 'required'],
            [['id_user', 'isAllPage', 'created_at', 'isSaw'], 'integer'],
            [['status'], 'string', 'max' => 15],
            [['text'], 'string', 'max' => 255],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            'status' => 'Статус оповещения',
            'text' => 'Текст оповещения',
            'isAllPage' => 'Оповещение на всю страницу',
            'created_at' => 'Дата оповещения',
            'isSaw' => 'Клиент видел',
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
     * {@inheritdoc}
     * @return NotifyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotifyQuery(get_called_class());
    }
}
