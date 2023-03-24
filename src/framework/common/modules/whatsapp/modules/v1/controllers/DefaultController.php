<?php

namespace common\modules\whatsapp\modules\v1\controllers;

use common\components\FrontendController;

/**
 * Default controller for the `whatsapp` module
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
