<?php

namespace common\models\entities;

use common\components\ActiveQuery;
use common\models\entities\Module;

/**
 * @method Module[] each($batchSize = 100, $db = null)
 * @method Module[] all($db = null)
 * @method Module one($db = null)
 * @method Module oneOrException($db = null, $exceptionMessage = null)
 */
class ModuleQuery extends ActiveQuery
{
    /**
     * @param bool $isActive = true
     * @return $this
     */
    public function active($isActive = true)
    {
        return $isActive
            ? $this->andWhere('version_id is not null')
            : $this->andWhere('version_id is null');
    }

    /**
     * @param string|array $id
     * @return $this
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    public function byModuleName($name)
    {
        return $this->andWhere(['m_name' => $name]);
    }
}