<?php

namespace common\models\payments;

use common\models\users\UserToTarifs;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%payments}}".
 *
 * @property int $id
 * @property int $id_user_to_farif ID клиента
 * @property string $bought Оплаченная цена
 * @property int $demo Демо версия
 * @property int $created_at Дата первой оплаты
 * @property int $updated_at Дата последней оплаты
 * @property int $date_end Дата окончания
 *
 * @property UserToTarifs $userToFarif
 */
class Payments extends \yii\db\ActiveRecord
{

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
    public static function tableName()
    {
        return '{{%payments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user_to_farif', 'bought', 'created_at', 'updated_at', 'date_end'], 'required'],
            [['id_user_to_farif', 'demo', 'created_at', 'updated_at', 'date_end'], 'integer'],
            [['bought'], 'number'],
            [['id_user_to_farif'], 'exist', 'skipOnError' => true, 'targetClass' => UserToTarifs::className(), 'targetAttribute' => ['id_user_to_farif' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user_to_farif' => 'ID клиента',
            'bought' => 'Оплаченная цена',
            'demo' => 'Демо версия',
            'created_at' => 'Дата первой оплаты',
            'updated_at' => 'Дата последней оплаты',
            'date_end' => 'Дата окончания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToFarif()
    {
        return $this->hasOne(UserToTarifs::className(), ['id' => 'id_user_to_farif']);
    }

    /**
     * {@inheritdoc}
     * @return PaymentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PaymentsQuery(get_called_class());
    }
}
