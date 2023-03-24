<?php

namespace console\controllers;

use yii\console\Exception;
use yii\helpers\Console;

class MigrateController extends \yii\console\controllers\MigrateController
{
    /** @inheritdoc */
    public $templateFile = '@console/views/migration.php';
    /** @inheritdoc */
    public $migrationTable = 'migration';
    /** @inheritdoc */
    protected $namespace = 'console\migrations';

    /** @inheritdoc */
    public function actionCreate($name)
    {
        $this->create($name, $this->namespace);
    }

    /**
     * Creates new migration.
     *
     * @param string $name Name of migration (not className).
     * @param string $namespace Namespace of migration class.
     * @throws Exception
     * @see MigrateController::actionCreate()
     */
    protected function create($name, $namespace)
    {
        if (!preg_match('/^\w+$/', $name)) {
            throw new Exception("The migration name should contain letters, digits and/or underscore characters only.");
        }

        $className = 'm' . gmdate('ymd_His') . '_' . $name;
        $fullClassName = "$namespace\\{$className}";

        $file = $this->getFileOfClass($fullClassName);
        if ($this->confirm("Create new migration '$file'?")) {
            $content = $this->renderFile(\Yii::getAlias($this->templateFile), [
                'className' => $className,
                'namespace' => $namespace,
            ]);
            file_put_contents($file, $content);
            $this->stdout("New migration created successfully.\n", Console::FG_GREEN);
        }
    }

    /** @inheritdoc */
    protected function migrateUp($class)
    {
        return $this->up($class, $this->namespace);
    }

    /**
     * Migration up.
     *
     * @param string $class Name of migration class.
     * @param string $namespace Namespace of migration class.
     * @return bool
     * @throws Exception
     * @see MigrateController::migrateUp()
     */
    protected function up($class, $namespace)
    {
        if ($class === self::BASE_MIGRATION) {
            return true;
        }
        $this->stdout("*** applying $class\n", Console::FG_YELLOW);
        $start = microtime(true);
        $fullClass = "{$namespace}\\{$class}";
        $migration = $this->createMigration($fullClass);
        if ($migration->up() !== false) {
            $this->addMigrationHistory($class);
            $time = microtime(true) - $start;
            $this->stdout("*** applied $class (time: " . sprintf("%.3f", $time) . "s)\n\n", Console::FG_GREEN);
            return true;
        } else {
            $time = microtime(true) - $start;
            $this->stdout("*** failed to apply $class (time: " . sprintf("%.3f", $time) . "s)\n\n", Console::FG_RED);
            return false;
        }
    }

    /** @inheritdoc */
    protected function migrateDown($class)
    {
        return $this->down($class, $this->namespace);
    }

    /**
     * Migration down.
     *
     * @param string $class Name of migration class.
     * @param string $namespace Namespace of migration class.
     * @return bool
     * @throws Exception
     * @see MigrateController::migrateDown()
     */
    protected function down($class, $namespace)
    {
        if ($class === self::BASE_MIGRATION) {
            return true;
        }

        $this->stdout("*** reverting $class\n", Console::FG_YELLOW);
        $start = microtime(true);
        $fullClass = "{$namespace}\\{$class}";
        $migration = $this->createMigration($fullClass);
        if ($migration->down() !== false) {
            $this->removeMigrationHistory($class);
            $time = microtime(true) - $start;
            $this->stdout("*** reverted $class (time: " . sprintf("%.3f", $time) . "s)\n\n", Console::FG_GREEN);
            return true;
        } else {
            $time = microtime(true) - $start;
            $this->stdout("*** failed to revert $class (time: " . sprintf("%.3f", $time) . "s)\n\n", Console::FG_RED);
            return false;
        }
    }

    /** @inheritdoc */
    protected function createMigration($class)
    {
        $file = $this->getFileOfClass($class);
        require_once($file);
        return new $class(['db' => $this->db]);
    }

    /**
     * Returns name of file by className of migration.
     *
     * @param string $className Full class name.
     * @return string Path to file.
     */
    protected function getFileOfClass($className)
    {
        $alias = '@' . str_replace('\\', '/', $className);
        return \Yii::getAlias($alias) . '.php';
    }
}