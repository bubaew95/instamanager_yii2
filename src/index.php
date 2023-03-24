<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/framework/vendor/autoload.php';
require __DIR__ . '/framework/vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/framework/common/config/bootstrap.php';
require __DIR__ . '/framework/frontend/config/bootstrap.php';
require __DIR__ . '/framework/common/components/WebApplication.php';


$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/framework/common/config/main.php',
    require __DIR__ . '/framework/common/config/main-local.php',
    require __DIR__ . '/framework/frontend/config/main.php',
    require __DIR__ . '/framework/frontend/config/main-local.php'
);

(new \common\components\WebApplication($config))->run();

//(new yii\web\Application($config))->run();
