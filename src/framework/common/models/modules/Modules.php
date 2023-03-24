<?php

namespace common\models\modules;

use common\models\instagram\InstagramModel;
use common\models\luis\Luis;
use common\models\projects\Projects;
use common\models\users\Users;
use Yii;

/**
 * This is the model class for table "{{%modules}}".
 *
 * @property int $id
 * @property string $name Название модуля
 * @property string $latin_name Латинское название проекта
 * @property string $text Описание модуля
 * @property string $img Изображение
 * @property string $lunk Ссылка к модулю
 * @property string $created_at Дата создания
 *
 * @property InstagramModel[] $instagrams
 * @property Luis[] $luis
 * @property UserModules[] $userModules
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%modules}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'latin_name', 'img', 'lunk'], 'required'],
            [['created_at'], 'safe'],
            [['name', 'latin_name', 'img', 'lunk'], 'string', 'max' => 255],
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
            'name' => 'Название модуля',
            'latin_name' => 'Латинское название проекта',
            'text' => 'Описание модуля',
            'img' => 'Изображение',
            'lunk' => 'Ссылка к модулю',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstagrams()
    {
        return $this->hasMany(InstagramModel::className(), ['id_user_module' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLuis()
    {
        return $this->hasMany(Luis::className(), ['id_user_module' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserModules()
    {
        return $this->hasMany(Projects::className(), ['id' => 'id_project'])
            ->viaTable(UserModules::tableName(), ['id_module' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ModulesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModulesQuery(get_called_class());
    }
}
