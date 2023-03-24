<?php

namespace common\components;

use common\models\entities\ModuleVersion;

class UrlManager extends \yii\web\UrlManager
{
    public $rules = [
        '' => 'site/index',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        //'GET /user/<id:\d+>' => '/user/view',
    ];

    /**
     * Register rules for module.
     *
     * @param ModuleVersion $module
     */
    public function registerModuleRules($module)
    {
        $class = $module->source;
        $this->addRules($class::getUrlRules());
    }
}