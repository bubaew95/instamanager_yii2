<?php

namespace common\models\cart;

/**
 * This is the ActiveQuery class for [[Cart]].
 *
 * @see Cart
 */
class BotsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cart[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cart|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
