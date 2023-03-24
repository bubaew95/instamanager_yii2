<?php

namespace common\modules\insta\modules\v1;

use common\components\WebApplication;
use common\components\VersionModule;
use common\modules\insta\modules\v1\components\EventHandler;

class V1 extends VersionModule
{
    /** @inheritdoc */
    public static function getEventHandlers()
    {
        return [
            WebApplication::EVENT_EXAMPLE_USER_CREATE => [
                /** @see \common\modules\insta\modules\v1\components\EventHandler::userCreateHandler() */
                [EventHandler::class, 'userCreateHandler'],
                /** @see \common\modules\insta\modules\v1\components\EventHandler::userCreateOtherHandler() */
                [EventHandler::class, 'userCreateOtherHandler'],
            ],
        ];
    }

    /** @inheritdoc */
    public static function getUrlRules()
    {
        return[
            'GET /modules/insta' => '/insta/default',
            'GET /insta/images/Instagram.png' => '/insta/images/Instagram.png'
        ];
    }
}