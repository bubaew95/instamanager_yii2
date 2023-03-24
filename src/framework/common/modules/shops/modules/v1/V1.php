<?php

namespace common\modules\shops\modules\v1;

use common\components\WebApplication;
use common\components\VersionModule;


/**
* shops module definition class
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
            '/shop/<\id>' => '/shops/view',
            'GET /shops' => '/shops/default',
            'GET /modules/shops/products' => '/modules/shops/products/index',
        ];
    }

}
