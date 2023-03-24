<?php

namespace common\models\modules;

use common\models\instagram\InstagramModel;
use common\models\projects\Projects;
use Yii;

/**
 * This is the model class for table "{{%user_modules}}".
 *
 * @property int $id
 * @property int $id_project ID проекта
 * @property int $id_module ID модуля
 * @property int $created_at Дата добавления
 *
 * @property InstagramModel[] $instagrams
 * @property Modules $module
 * @property Projects $project
 */
class UserModules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_modules}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_project', 'id_module'], 'required'],
            [['id_project', 'id_module', 'created_at'], 'integer'],
            [['id_module'], 'exist', 'skipOnError' => true, 'targetClass' => Modules::className(), 'targetAttribute' => ['id_module' => 'id']],
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
            'id_project' => 'ID проекта',
            'id_module' => 'ID модуля',
            'created_at' => 'Дата добавления',
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
    public function getModule()
    {
        return $this->hasOne(Modules::className(), ['id' => 'id_module']);
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
     * @return UserModulesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserModulesQuery(get_called_class());
    }
}
