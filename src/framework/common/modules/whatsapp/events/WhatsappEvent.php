<?php

namespace common\modules\whatsapp\events;

use yii\base\Event;

/**
* Default controller for the `whatsapp` event
*/
class WhatsappEvent extends Event
{
    /**
     * @param array $config
    */
    public function __construct($params = null, $config = [])
    {
        parent::__construct($config);
    }
}
