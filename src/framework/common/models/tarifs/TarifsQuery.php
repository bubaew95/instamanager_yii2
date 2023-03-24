<?php

namespace common\models\tarifs;

/**
 * This is the ActiveQuery class for [[Tarifs]].
 *
 * @see Tarifs
 */
class TarifsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Tarifs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function findId($id)
    {
        return parent::where(['id' => (int) $id])->one();
    }

    /**
     * {@inheritdoc}
     * @return Tarifs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
