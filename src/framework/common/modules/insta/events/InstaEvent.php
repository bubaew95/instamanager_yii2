<?php

namespace common\modules\insta\events;

use yii\base\Event;

class InstaEvent extends Event
{
    public $invoice;

    /**
     * @param $invoice
     * @param array $config
     */
    public function __construct($invoice, $config = [])
    {
        parent::__construct($config);
        $this->invoice = $invoice;
    }
}