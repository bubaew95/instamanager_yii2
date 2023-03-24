<?php

namespace common\components;

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

abstract class ModuleActiveRecord extends ActiveRecord
{
    /** @inheritdoc */
    public static function tableName()
    {
        $className = static::class;
        return
            static::getTablePrefix($className) .
            Inflector::camel2id(StringHelper::basename($className), '_');
    }

    /**
     * Generate prefix for table name based on module id and name.
     *
     * @param string $className
     * @return string
     */
    public static function getTablePrefix($className)
    {
        list(, $idModule, $tail) = explode('\\modules\\', $className);
        if (!$idModule) {
            return '';
        }
        $idVersion = explode('\\', $tail)[0];
        return $idModule . '_' . $idVersion . '_';
    }
}