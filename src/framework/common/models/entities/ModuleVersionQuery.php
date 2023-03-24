<?php

namespace common\models\entities;

use common\components\ActiveQuery;

class ModuleVersionQuery extends ActiveQuery
{
    /**
     * @param string|array $id
     * @return $this
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }
}