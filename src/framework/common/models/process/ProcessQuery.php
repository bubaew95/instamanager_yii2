<?php

namespace common\models\process;

/**
 * This is the ActiveQuery class for [[Process]].
 *
 * @see ProcessModel
 */
class ProcessQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProcessModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProcessModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
