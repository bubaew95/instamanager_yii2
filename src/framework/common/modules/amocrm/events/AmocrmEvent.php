<?php

namespace common\modules\amocrm\events;

use yii\base\Event;

/**
* Default controller for the `amocrm` event
*/
class AmocrmEvent extends Event
{
    /**
     * @param array $config
    */
    public function __construct($params = null, $config = [])
    {
        parent::__construct($config);
    }
}
