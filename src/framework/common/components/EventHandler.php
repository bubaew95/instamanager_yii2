<?php

namespace common\components;

use common\modules\example_billing\events\InstaEvent;

abstract class EventHandler
{
    /**
     * @param InstaEvent $event
     */
    public function invoiceCreateHandler($event)
    {
        echo 'Handler for example_billing.invoice.create in core has been firing.';
    }
}