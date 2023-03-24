<?php

namespace common\modules\vk\events;

use yii\base\Event;

/**
* Default controller for the `vk` event
*/
class VkEvent extends Event
{
    /**
     * @param array $config
    */
    public function __construct($params = null, $config = [])
    {
        parent::__construct($config);
    }
}
