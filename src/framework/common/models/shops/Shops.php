<?php

namespace common\models\shops;

use common\models\projects\Projects;
use common\models\themes\Themes;
use Yii;

/**
 * This is the model class for table "{{%shops}}".
 *
 * @property int $id
 * @property int $id_project Проект
 * @property int $id_theme Тема
 * @property string $img Изображение
 * @property string $name Название
 * @property string $latin_name Латинское название
 * @property string $text Описание
 * @property string $keywords Ключевые слов
 * @property string $description Краткое описание
 * @property int $created_at Дата создания
 * @property int $updated_at Дата изменения
 *
 * @property Projects $project
 * @property Themes $theme
 */
class Shops extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shops}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'id_theme', 'name', 'latin_name'], 'required'],
            [['id_project', 'id_theme', 'created_at', 'updated_at'], 'integer'],
            [['img', 'keywords', 'description'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['latin_name'], 'string', 'max' => 120],
            [['text'], 'string', 'max' => 512],
            [['latin_name'], 'unique'],
            [['id_project'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['id_project' => 'id']],
            [['id_theme'], 'exist', 'skipOnError' => true, 'targetClass' => Themes::className(), 'targetAttribute' => ['id_theme' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true,'extensions'    => 'png, jpg'],
            ['imageFile', 'image', 'minWidth' => 100, 'maxWidth' => 490, 'minHeight' => 50, 'maxHeight' => 125]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'id_project'    => 'Проект',
            'id_theme'      => 'Тема',
            'img'           => 'Логотип',
            'imageFile'     => 'Логотип',
            'name'          => 'Название',
            'latin_name'    => 'Латинское название',
            'text'          => 'Описание',
            'keywords'      => 'Ключевые слов',
            'description'   => 'Краткое описание',
            'created_at'    => 'Дата создания',
            'updated_at'    => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'id_project']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTheme()
    {
        return $this->hasOne(Themes::className(), ['id' => 'id_theme']);
    }

    /**
     * {@inheritdoc}
     * @return ShopsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ShopsQuery(get_called_class());
    }

    public function upload()
    {
        if ($this->validate()) {
            $fileName   = "{$this->imageFile->baseName}.{$this->imageFile->extension}";
            $path       = "{$_SERVER['DOCUMENT_ROOT']}/uploads/shops/{$this->id_project}/logo/";
            if(!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $this->imageFile->saveAs("{$path}{$fileName}", false);
            $this->img = $fileName;
            return true;
        } else {
            return false;
        }
    }

}
