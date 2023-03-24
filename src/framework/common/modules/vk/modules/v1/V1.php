<?php

namespace common\modules\vk\modules\v1;

use common\components\WebApplication;
use common\components\VersionModule;


/**
* vk module definition class
*/
class V1 extends VersionModule
{

    public static function getEventHandlers()
    {
        return [

        ];
    }

    /** @inheritdoc */
    public static function getUrlRules()
    {
        return[
            'GET /modules/vk' => '/vk/default',
        ];
    }

}
