<?php

namespace common\modules\amocrm\modules\v1\controllers;

use common\components\FrontendController;

/**
 * Default controller for the `amocrm` module
 */
class DefaultController extends FrontendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
