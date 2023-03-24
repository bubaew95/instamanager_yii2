<?php

namespace common\components;

use common\models\entities\ModuleVersion;
use yii\base\Event;

class EventManager
{
    /**
     * Fires event.
     *
     * @param string $name Event name
     * @param Event $event = null
     */
    public function fire($name, $event = null)
    {
        \Yii::$app->trigger($name, $event);
    }

    /**
     * Register handlers.
     * @param array $handlers
     */
    public function registerHandlers($handlers)
    {
        foreach ($handlers as $event => $callbacks) {
            if (!is_array($callbacks)) {
                $callbacks = [$callbacks];
            }
            foreach ($callbacks as $callback) {
                \Yii::$app->on($event, $callback);
            }
        }
    }

    /**
     * Unregister handlers.
     * @param array $handlers
     */
    public function unregisterHandlers($handlers)
    {
        foreach ($handlers as $event => $callbacks) {
            if (!is_array($callbacks)) {
                $callbacks = [$callbacks];
            }
            foreach ($callbacks as $callback) {
                \Yii::$app->off($event, $callback);
            }
        }
    }

    /**
     * Register handlers for module.
     *
     * @param ModuleVersion $module
     */
    public function registerModuleHandlers($module)
    {
            $class = $module->source;
            $handlers = $class::getEventHandlers();
            $this->registerHandlers($handlers);
    }

    /**
     * Unregister handlers for module.
     *
     * @param ModuleVersion $module
     */
    public function unregisterModuleHandlers($module)
    {
            $class = $module->source;
            $handlers = $class::getEventHandlers();
            $this->unregisterHandlers($handlers);
    }
}