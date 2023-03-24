<?php

namespace common\models\products;

use common\models\cart\Cart;
use common\models\instagram\InstagramDataModel;
use common\models\orders\Orders;
use common\models\projects\Projects;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property int $id_project ID проекта
 * @property int $instaData Выгрузка из инстграм
 * @property string $name Название продукта
 * @property string $latin_name Латинское название
 * @property string $text Описание товара
 * @property string $price Цена товара
 * @property string $img изобрежени
 * @property string $created_at Дата добавления
 *
 * @property Cart[] $carts
 * @property InstagramDataModel[] $instagramDatas
 * @property Orders[] $orders
 * @property Projects $project
 */
class Products extends \yii\db\ActiveRecord
{

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'name', 'latin_name', 'text', 'price'], 'required'],
            [['id_project'], 'integer'],
            [['text', 'name', 'latin_name'], 'string'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['name', 'latin_name'], 'string', 'max' => 255],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['imageFile', 'instaData'], 'safe'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName   = time().".{$this->imageFile->extension}";
            $path       = "{$_SERVER['DOCUMENT_ROOT']}/uploads/shops/{$this->id_project}/";
            if(!is_dir($path)) {
                mkdir($path);
            }
            $this->imageFile->saveAs("{$path}{$fileName}", false);
            $this->img = $fileName;
            return true;
        } else {
            return false;
        }
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Изображение',
            'id_project' => 'ID проекта',
            'name' => 'Название продукта',
            'latin_name' => 'Латинское название',
            'text' => 'Описание товара',
            'price' => 'Цена товара',
            'created_at' => 'Дата добавления',
            'instaData' => 'Откуда товар',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['id_product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagramData()
    {
        return $this->hasMany(InstagramDataModel::className(), ['id_product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id_product' => 'id']);
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
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
