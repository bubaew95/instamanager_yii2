<?php

namespace common\models\luis;

/**
 * This is the ActiveQuery class for [[Luis]].
 *
 * @see Luis
 */
class LuisQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Luis[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Luis|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
