<?php

namespace common\modules\whatsapp\modules\v1;

use common\components\WebApplication;
use common\components\VersionModule;


/**
* whatsapp module definition class
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
            'GET /modules/whatsapp' => '/whatsapp/default',
        ];
    }

}
