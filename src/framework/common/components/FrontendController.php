<?php

namespace common\components;

use Yii;
use yii\base\Theme;
use yii\web\Controller;
use yii\web\View;

abstract class FrontendController extends Controller
{
    public function init()
    {
        parent::init();
        $theme = [
            'basePath' => '@frontend/themes/shopx',
            'baseUrl' => '@frontend/themes/shopx',
            'pathMap' => [
                '@frontend/views' => '@frontend/themes/shopx',
            ],
        ];
        Yii::$app->view->theme = new Theme($theme);
    }

}