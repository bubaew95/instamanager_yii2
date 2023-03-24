<?php

namespace common\models\bots;

use common\models\instagram\InstagramModel;
use Yii;

/**
 * This is the model class for table "{{%bots}}".
 *
 * @property int $id
 * @property int $id_instagram ID инстаграм
 * @property int $pid PID запушенной консоли
 * @property int $allowdirect Ответить на запрос в директе
 * @property int $answercomment Ответить на комментарий в директ
 * @property int $isII Искувственный интеллект
 * @property string $webhook Webhook
 * @property int $status Статус
 * @property int $created_at Дата запуска
 *
 * @property Instagram $instagram
 */
class Bots extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bots}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_instagram'], 'required'],
            [['pid', 'status'], 'safe'],
            [['id_instagram', 'pid', 'allowdirect', 'answercomment', 'isII', 'status'], 'integer'],
            [['webhook'], 'string', 'max' => 255],
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
            'id_instagram' => 'ID инстаграм',
            'pid' => 'PID запушенной консоли',
            'allowdirect' => 'Ответить на запрос в директе',
            'answercomment' => 'Ответить на комментарий в директ',
            'isII' => 'Искувственный интеллект',
            'webhook' => 'Webhook',
            'status' => 'Статус',
            'created_at' => 'Дата запуска',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagram()
    {
        return $this->hasOne(InstagramModel::className(), ['id' => 'id_instagram']);
    }

    /**
     * {@inheritdoc}
     * @return BotsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BotsQuery(get_called_class());
    }
}
