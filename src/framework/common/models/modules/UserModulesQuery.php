<?php

namespace common\models\modules;

/**
 * This is the ActiveQuery class for [[UserModules]].
 *
 * @see UserModules
 */
class UserModulesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserModules[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserModules|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
