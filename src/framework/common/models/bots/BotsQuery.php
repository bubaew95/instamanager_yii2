<?php

namespace common\models\bots;

/**
 * This is the ActiveQuery class for [[Bots]].
 *
 * @see Bots
 */
class BotsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Bots[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Bots|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
