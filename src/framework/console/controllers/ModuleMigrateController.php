<?php

namespace console\controllers;

use common\components\ModuleActiveRecord;
use common\models\entities\Module;
use common\models\entities\ModuleVersion;
use yii\console\Exception;

class ModuleMigrateController extends MigrateController
{
    public $moduleId;
    public $versionId;

    /** @inheritdoc */
    public function options($actionId)
    {
        return array_merge(parent::options($actionId), ['moduleId', 'versionId']);
    }

    /** @inheritdoc */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->prepare();
        return true;
    }

    protected function prepare()
    {
        if ($this->moduleId === null) {
            throw new Exception('$moduleId parameter is required.');
        }
        $module = Module::find()->byModuleName($this->moduleId)->one();
        if (!$module) {
            throw new Exception("Invalid moduleId '{$this->moduleId}'");
        }

        $version = $this->versionId
            ? $module->getVersions()->byId($this->versionId)->one()
            : $module->activeVersion;
        if (!$version) {
            throw new Exception("Invalid versionId '{$this->versionId}'");
        }

        $this->namespace = $this->getNamespace($version);
        $this->migrationTable = $this->getMigrationTable($version);
        $this->migrationPath = $this->getMigrationPath($version);
    }

    /**
     * Returns migrations namespace.
     *
     * @param ModuleVersion $version
     * @return string
     */
    protected function getNamespace($version)
    {
        $class = $version->source;
        return substr($class, 1, strrpos($class, '\\')) . 'migrations';
    }

    /**
     * Returns migration table.
     *
     * @param ModuleVersion $version
     * @return string
     */
    protected function getMigrationTable($version)
    {
        $prefix = ModuleActiveRecord::getTablePrefix($version->source);
        return $prefix . $this->migrationTable;
    }

    /**
     * Returns migration path.
     *
     * @param ModuleVersion $version
     * @return string
     */
    protected function getMigrationPath($version)
    {
        $alias = '@' . str_replace('\\', '/', $this->getNamespace($version));
        return \Yii::getAlias($alias);
    }
}