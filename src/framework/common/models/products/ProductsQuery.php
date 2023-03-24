<?php

namespace common\models\products;

/**
 * This is the ActiveQuery class for [[Projects]].
 *
 * @see Projects
 */
class ProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Products[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Products|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
