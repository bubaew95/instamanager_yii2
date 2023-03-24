<?php

namespace common\modules\shops\events;

use yii\base\Event;

/**
* Default controller for the `shops` event
*/
class ShopsEvent extends Event
{
    /**
     * @param array $config
    */
    public function __construct($params = null, $config = [])
    {
        parent::__construct($config);
    }
}
