<?php

namespace common\models\instagram;

use common\models\products\Products;
use Yii;

/**
 * This is the model class for table "{{%instagram_data}}".
 *
 * @property int $id
 * @property int $id_instagram ID инстаграм
 * @property int $id_product ID продукта
 * @property int $media_id ID медиа в инстаграме
 * @property string $link Ссылка на медиа
 * @property int $likes Количество лайков
 * @property int $comments Количество комментариев
 *
 * @property InstagramModel $instagram
 * @property Products $product
 */
class InstagramDataModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%instagram_data}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_instagram', 'media_id'], 'required'],
            [['id_instagram', 'id_product', 'likes', 'comments'], 'integer'],
            [['link', 'media_id'], 'string', 'max' => 255],
            [['id_instagram'], 'exist', 'skipOnError' => true, 'targetClass' => InstagramModel::className(), 'targetAttribute' => ['id_instagram' => 'id']],
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
            'id_instagram' => 'ID инстаграм',
            'id_product' => 'ID продукта',
            'media_id' => 'ID медиа в инстаграме',
            'link' => 'Ссылка на медиа',
            'likes' => 'Количество лайков',
            'comments' => 'Количество комментариев',
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
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'id_product']);
    }

    /**
     * {@inheritdoc}
     * @return InstagramDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InstagramDataQuery(get_called_class());
    }
}
