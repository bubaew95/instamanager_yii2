<?php

namespace common\models\instagram;

/**
 * This is the ActiveQuery class for [[InstagramMessages]].
 *
 * @see InstagramMessages
 */
class InstagramMessagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InstagramMessages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InstagramMessages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
