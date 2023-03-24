<?php

namespace common\modules\insta\modules\v1\components;

use common\events\ExampleUserEvent;

abstract class EventHandler
{
    /**
     * @param ExampleUserEvent $event
     */
    public static function userCreateHandler($event)
    {
        echo 'Handler for core.user.create in exampleBilling.v1 module has been firing.';
    }

    /**
     * @param ExampleUserEvent $event
     */
    public static function userCreateOtherHandler($event)
    {
        echo 'Other handler for core.user.create in exampleBilling.v1 module has been firing.';
    }
}