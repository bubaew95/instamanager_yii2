<?php

namespace common\models\themes;

use common\models\shops\Shops;
use Yii;

/**
 * This is the model class for table "{{%themes}}".
 *
 * @property int $id
 * @property string $name Название
 * @property string $latin_name Латинское название
 * @property string $text Описание шаблона
 * @property string $img Изображение
 *
 * @property Shops[] $shops
 */
class Themes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%themes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'latin_name', 'img'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['latin_name'], 'string', 'max' => 120],
            [['text'], 'string', 'max' => 512],
            [['img'], 'string', 'max' => 255],
            [['latin_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'latin_name' => 'Латинское название',
            'text' => 'Описание шаблона',
            'img' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shops::className(), ['id_theme' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ThemesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ThemesQuery(get_called_class());
    }
}
