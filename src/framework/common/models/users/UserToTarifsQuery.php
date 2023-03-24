<?php

namespace common\models\users;

/**
 * This is the ActiveQuery class for [[UserToTarifs]].
 *
 * @see UserToTarifs
 */
class UserToTarifsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserToTarifs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserToTarifs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
