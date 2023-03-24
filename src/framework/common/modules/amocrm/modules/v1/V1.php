<?php

namespace common\modules\amocrm\modules\v1;

use common\components\WebApplication;
use common\components\VersionModule;


/**
* amocrm module definition class
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
            'GET /modules/amocrm' => '/amocrm/default',
        ];
    }

}
