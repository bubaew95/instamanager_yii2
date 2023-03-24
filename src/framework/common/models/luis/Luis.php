<?php

namespace common\models\luis;

use common\models\projects\Projects;
use common\models\tarifs\Tarifs;
use Yii;

/**
 * This is the model class for table "{{%luis}}".
 *
 * @property int $id
 * @property int $id_project Проект
 * @property int $id_tarif Тариф
 * @property string $app_key Ключ
 * @property string $subscription_key Ключ подписки
 * @property int $verbose Показать весь массив
 * @property int $active Активность
 *
 * @property Tarifs $tarif
 * @property Projects $project
 */
class Luis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%luis}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'id_tarif', 'verbose', 'active'], 'integer'],
            [['app_key', 'subscription_key'], 'required'],
            [['app_key', 'subscription_key'], 'string', 'max' => 255],
            [['id_tarif'], 'exist', 'skipOnError' => true, 'targetClass' => Tarifs::className(), 'targetAttribute' => ['id_tarif' => 'id']],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['id_project' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_project' => 'Проект',
            'id_tarif' => 'Тариф',
            'app_key' => 'Ключ',
            'subscription_key' => 'Ключ подписки',
            'verbose' => 'Показать весь массив',
            'active' => 'Активность',
        ];
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
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'id_project']);
    }

    /**
     * {@inheritdoc}
     * @return LuisQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LuisQuery(get_called_class());
    }
}
