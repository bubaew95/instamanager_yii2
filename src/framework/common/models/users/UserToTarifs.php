<?php

namespace common\models\users;

use common\models\payments\Payments;
use common\models\projects\Projects;
use common\models\tarifs\Tarifs;
use Yii;

/**
 * This is the model class for table "{{%user_to_tarifs}}".
 *
 * @property int $id
 * @property int $id_user ID клиента
 * @property int $id_tarif ID аккаунта
 *
 * @property Payments[] $payments
 * @property Projects[] $projects
 * @property Tarifs $tarif
 * @property Users $user
 */
class UserToTarifs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_to_tarifs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_tarif'], 'integer'],
            [['id_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => Tarifs::className(), 'targetAttribute' => ['id_tarif' => 'id']],
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
            'id_user' => 'ID клиента',
            'id_tarif' => 'ID аккаунта',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payments::className(), ['id_user_to_farif' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Projects::className(), ['id_user_to_tarif' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarif()
    {
        return $this->hasOne(Tarifs::className(), ['id' => 'id_tarif']);
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
     * @return UserToTarifsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserToTarifsQuery(get_called_class());
    }
}
