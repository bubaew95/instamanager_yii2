<?php

namespace common\models\tarifs;

use common\models\luis\Luis;
use common\models\users\UserToTarifs;
use Yii;

/**
 * This is the model class for table "{{%tarifs}}".
 *
 * @property int $id
 * @property string $logo Логотип
 * @property string $name Название услуги
 * @property string $text Описание
 * @property string $price Цена
 * @property int $count_projects Количество проектов
 * @property int $isII Искувственный интеллект
 * @property int $visible Видимость
 *
 * @property Luis[] $luis
 * @property UserToTarifs[] $userToTarifs
 */
class Tarifs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tarifs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['count_projects', 'isII', 'visible'], 'integer'],
            [['logo', 'name'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Логотип',
            'name' => 'Название услуги',
            'text' => 'Описание',
            'price' => 'Цена',
            'count_projects' => 'Количество проектов',
            'isII' => 'Искувственный интеллект',
            'visible' => 'Видимость',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLuis()
    {
        return $this->hasMany(Luis::className(), ['id_tarif' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserToTarifs()
    {
        return $this->hasMany(UserToTarifs::className(), ['id_tarif' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TarifsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TarifsQuery(get_called_class());
    }
}
