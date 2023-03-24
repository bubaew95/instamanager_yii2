<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 30/09/2019
 * Time: 21:38
 */

namespace common\components\constants;


class Constants {

    const HOST = 'http://neb-chr.ru/';

    const HASH_KEY          = 'bubaew';

    const RABBIT_HOST       = '188.120.229.19';
    const RABBIT_PORT       = 5672;
    const RABBIT_LOGIN      = 'guest';
    const RABBIT_PASS       = 'guest';


    public static function getProjectId()
    {
        return 2;
    }

    public static function getUserId()
    {
        return 1;
    }

}
