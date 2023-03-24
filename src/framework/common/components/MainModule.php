<?php

namespace common\components;

use common\models\entities\Module as ModuleAr;
use yii\base\Exception;
use yii\helpers\Inflector;

abstract class MainModule extends Module
{
    /**
     * Translates a message to the specified language by module's dictionary.
     *
     * @param string $category
     * @param string $message
     * @param array $params = []
     * @param string $language = null
     * @param string $version = null
     * @return string
     * @throws Exception
     * @see \Yii::t()
     */
    public static function t($category, $message, $params = [], $language = null, $version = null)
    {
        $class = static::class;
        $id = Inflector::underscore(substr($class, strrpos($class, '\\') + 1));
        if ($version === null) {
            $version = ModuleAr::getActiveVersionIdByModuleId($id);
        }
        if ($version === null) {
            throw new Exception("Invalid module id: {$id}");
        }
        $category = "{$id}.{$version}.{$category}";
        return \Yii::t($category, $message, $params, $language);
    }

    /**
     * Return an instance of $className from $version submodule.
     *
     * @param string $className Name of class relatively of module's root.
     * @param array $constructorArgs = [] Arguments for constructor.
     * @param string $moduleVersion = null Id of module's version. If null, active version will br used.
     * @return mixed|null An instance of class or null
     * @throws \yii\base\Exception
     */
    public static function getObject($className, array $constructorArgs = [], $moduleVersion = null)
    {
        $class = static::createFullClassName($className, $moduleVersion);
        return $class && class_exists($class) ? new $class(...$constructorArgs) : null;
    }

    /**
     * Return full name of $className from $version submodule.
     *
     * @param string $className Name of class relatively of module's root.
     * @param string $moduleVersion = null Id of module's version. If null, active version will br used.
     * @return mixed|null A class or null
     * @throws \yii\base\Exception
     */
    public static function getClass($className, $moduleVersion = null)
    {
        $class = static::createFullClassName($className, $moduleVersion);
        return $class && class_exists($class) ? $class : null;
    }

    /**
     * Creates full name of class bu his relative name and version of module.
     *
     * @param string $name Name of class relatively of module's root.
     * @param string $moduleVersion = null Id of module's version. If null, active version will br used.
     * @return string|null Full name of class. Null if module has not active version.
     */
    private static function createFullClassName($name, $moduleVersion = null)
    {
        $moduleClass = static::class;
        $moduleId = Inflector::underscore(substr($moduleClass, strrpos($moduleClass, '\\') + 1));
        if ($moduleVersion === null) {
            $moduleVersion = ModuleAr::getActiveVersionIdByModuleId($moduleId);
        }
        if ($moduleVersion === null) {
            return null;
        }

        $namespace = substr($moduleClass, 0, strrpos($moduleClass, '\\'));
        $className = ltrim($name, "\\");
        return "\\{$namespace}\\modules\\{$moduleVersion}\\{$className}";
    }
}