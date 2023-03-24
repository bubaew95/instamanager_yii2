<?php

namespace common\models\instagram;

use Yii;

/**
 * This is the model class for table "{{%instagram_messages}}".
 *
 * @property int $id
 * @property int $id_direct Директ
 * @property string $thread_item_id Id сообщения
 * @property string $text Текст сообщения
 * @property int $created_at Дата создания
 * @property boolean $isInterlocutor Сообщение собеседника
 *
 * @property InstagramDirect $direct
 */
class InstagramMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%instagram_messages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_direct', 'thread_item_id'], 'required'],
            [['id_direct', 'created_at', 'isInterlocutor'], 'integer'],
            [['text'], 'string'],
            [['thread_item_id'], 'string', 'max' => 512],
            [['id_direct'], 'exist', 'skipOnError' => true, 'targetClass' => InstagramDirect::className(), 'targetAttribute' => ['id_direct' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_direct' => 'Директ',
            'thread_item_id' => 'Id сообщения',
            'text' => 'Текст сообщения',
            'created_at' => 'Дата создания',
            'isInterlocutor' => 'Сообщение собеседника',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirect()
    {
        return $this->hasOne(InstagramDirect::className(), ['id' => 'id_direct']);
    }

    /**
     * {@inheritdoc}
     * @return InstagramMessagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstagramMessagesQuery(get_called_class());
    }
}
