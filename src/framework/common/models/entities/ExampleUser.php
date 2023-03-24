<?php

namespace common\models\entities;

use common\components\WebApplication;
use common\events\ExampleUserEvent;
use common\components\ActiveRecord;

class ExampleUser extends ActiveRecord
{
    /** @return ExampleUserQuery */
    public static function find()
    {
        return new ExampleUserQuery(static::class);
    }

    public function create()
    {
        // Creates user and fire event after that.
        \Yii::$app->eventManager->fire(WebApplication::EVENT_EXAMPLE_USER_CREATE, new ExampleUserEvent($this));
    }
}