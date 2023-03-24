<?php

namespace common\components;

abstract class VersionModule extends Module
{
    /**
     * Return rules for module.
     *
     * @return array
     */
    public static function getUrlRules()
    {
        return [];
    }

    /**
     * Return event handlers
     *
     * @return array [
     *   eventName => [
     *     handler 1,
     *     handler 2,
     *     ...
     *   ]
     * ]
     */
    public static function getEventHandlers()
    {
        return [];
    }
}