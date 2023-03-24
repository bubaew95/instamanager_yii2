<?php

namespace common\models\cart;

use common\models\products\Products;
use Yii;

/**
 * This is the model class for table "{{%cart}}".
 *
 * @property int $id
 * @property int $id_product ID продукта
 * @property int $user_id ID пользователя инстаграм
 * @property string $thread_id ID диалога
 * @property string $thread_item_id ID сообщения
 * @property string $key Ключ
 * @property string $value Значение
 *
 * @property Products $product
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product', 'user_id', 'thread_id', 'thread_item_id', 'key', 'value'], 'required'],
            [['id_product', 'user_id'], 'integer'],
            [['thread_id', 'thread_item_id', 'key', 'value'], 'string', 'max' => 255],
            [['id_product'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['id_product' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_product' => 'ID продукта',
            'user_id' => 'ID пользователя инстаграм',
            'thread_id' => 'ID диалога',
            'thread_item_id' => 'ID сообщения',
            'key' => 'Ключ',
            'value' => 'Значение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
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
