<?php

namespace backend\models\users;

use Yii;

/**
 * This is the model class for table "{{%admin_users_profile}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $phone
 * @property string $phone_vercode
 *
 * @property AdminUser $user
 */
class AdminUsersProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_users_profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['phone'], 'number'],
            [['phone_vercode'], 'string', 'max' => 20],
            [['phone'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'phone' => 'Phone',
            'phone_vercode' => 'Phone Vercode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(AdminUser::className(), ['id' => 'user_id']);
    }
}
