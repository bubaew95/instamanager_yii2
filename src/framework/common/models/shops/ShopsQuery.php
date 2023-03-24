<?php

namespace common\models\shops;

use common\components\constants\Constants;
use phpDocumentor\Reflection\Types\Integer;
use yii\base\Object;

/**
 * This is the ActiveQuery class for [[Shops]].
 *
 * @see Shops
 */
class ShopsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function shopId(int $id_project = 0) : ?int
    {
        return $this->select(['id'])
            ->where(['id_project' => $id_project])->scalar();
    }

    /**
     * {@inheritdoc}
     * @return Shops[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Shops|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
