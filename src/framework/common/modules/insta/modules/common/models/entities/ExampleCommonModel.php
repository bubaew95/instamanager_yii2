<?php

namespace common\modules\insta\modules\v1\models\entities;

use common\modules\insta\InstaModule;

class ExampleCommonModel
{
    public function testMethod()
    {
        $class = InstaModule::getClass('models\entities\ExamplePrice');
        if ($class) {
            $list = $class::find()->all();
            // ...
        }
    }
}