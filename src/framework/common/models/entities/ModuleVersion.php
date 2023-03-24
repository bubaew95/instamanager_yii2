<?php

namespace common\models\entities;

use common\components\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $source
 * @property int $module_id
 */
class ModuleVersion extends ActiveRecord
{
    /** @inheritdoc */
    public static function find()
    {
        return new ModuleVersionQuery(static::class);
    }
}