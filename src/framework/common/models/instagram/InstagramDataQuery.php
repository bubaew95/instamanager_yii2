<?php

namespace common\models\instagram;

/**
 * This is the ActiveQuery class for [[InstagramData]].
 *
 * @see InstagramDataModel
 */
class InstagramDataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InstagramDataModel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InstagramDataModel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
