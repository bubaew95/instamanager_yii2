<?php

namespace common\components;

use common\models\entities\Module;
use common\modules\example_billing\InstaModule;
use yii\web\Application;

class WebApplication extends Application
{
    const EVENT_EXAMPLE_USER_CREATE = 'core.exampleUser.create';

    /** @inheritdoc */
    public function init()
    {
        parent::init();
        $this->registerEventHandlers();
        $this->enableModules();
    }

    /**
     * Set modules.
     */
    protected function enableModules()
    {
        $modules = Module::find()->active()->with('activeVersion');
        foreach ($modules->each() as $module) {
            if (!$module->activeVersion) {
                continue;
            }

            if(!class_exists($module->activeVersion->source)){
                continue;
            }

            $this->setModule($module->m_name, $module->activeVersion->source);
            $this->urlManager->registerModuleRules($module->activeVersion);
            $this->eventManager->registerModuleHandlers($module->activeVersion);
        }
    }

    /**
     * Registers core event handlers.
     */
    protected function registerEventHandlers()
    {
//        $this->eventManager->registerHandlers([
//            InstaModule::EVENT_EXAMPLE_INVOICE_CREATE => [
//                /** @see \common\components\EventHandler::invoiceCreateHandler() */
//                [EventHandler::class, 'invoiceCreateHandler'],
//            ],
//        ]);
    }
}