<?php

namespace common\modules\insta\modules\v1\models\entities;

use common\components\ModuleActiveRecord;
use common\modules\insta\events\InstaEvent;
use common\modules\insta\InstaModule;
use common\modules\insta\modules\v1\models\queries\ExampleInvoiceQuery;

class ExampleInvoice extends ModuleActiveRecord
{
    /** @return ExampleInvoiceQuery */
    public static function find()
    {
        return new ExampleInvoiceQuery(static::class);
    }

    public function create()
    {
        // Creates Modify and fire event after that.
        \Yii::$app->eventManager->fire(InstaModule::EVENT_EXAMPLE_INVOICE_CREATE, new InstaEvent($this));
    }

    public function modify()
    {
        // Modify invoice and fire event after that.
        \Yii::$app->eventManager->fire(InstaModule::EVENT_V1_EXAMPLE_INVOICE_MODIFY, new InstaEvent($this));
    }
}