<?php

namespace common\models\instagram;

/**
 * This is the ActiveQuery class for [[InstagramDirect]].
 *
 * @see InstagramDirect
 */
class InstagramDirectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InstagramDirect[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InstagramDirect|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
