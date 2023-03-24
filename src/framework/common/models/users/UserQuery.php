<?php

namespace common\models\users;

/**
 * This is the ActiveQuery class for [[Userinfo]].
 *
 * @see Userinfo
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Userinfo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Userinfo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
