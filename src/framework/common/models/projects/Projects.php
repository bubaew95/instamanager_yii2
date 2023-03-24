<?php

namespace common\models\projects;

use common\models\modules\UserModules;
use common\models\products\Products;
use common\models\users\UserToTarifs;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%projects}}".
 *
 * @property int $id
 * @property int $id_user_to_tarif ID пользователя
 * @property string $name Название проекта
 * @property string $created_at Дата создания
 * @property string $updated_at Дата обновления
 *
 * @property Products[] $products
 * @property UserToTarifs $userToTarif
 * @property UserModules[] $userModules
 */
class Projects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%projects}}';
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
    public function rules()
    {
        return [
            [['id_user_to_tarif', 'name'], 'required'],
            [['id_user_to_tarif'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['id_user_to_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => UserToTarifs::className(), 'targetAttribute' => ['id_user_to_tarif' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user_to_tarif' => 'ID пользователя',
            'name' => 'Название проекта',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id_project' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToTarif()
    {
        return $this->hasOne(UserToTarifs::className(), ['id' => 'id_user_to_tarif']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserModules()
    {
        return $this->hasMany(UserModules::className(), ['id_project' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ProjectsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectsQuery(get_called_class());
    }
}
