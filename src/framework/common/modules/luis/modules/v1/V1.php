<?php

namespace common\modules\luis\modules\v1;

use common\components\VersionModule;

class V1 extends VersionModule
{
    /** @inheritdoc */
    public static function getUrlRules()
    {
        return[
            '/modules/luis'=>'/luis/default',
        ];
    }
}