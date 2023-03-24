<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

//setcookie('template', 'new');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru_RU',
    'controllerNamespace' => 'frontend\controllers',
    //'layout' => array_key_exists('template', $_COOKIE) ? $_COOKIE['template'] : 'main',
    'components' => [


        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\users\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_id', 'httpOnly' => true],
            'loginUrl' => ['user/login']
        ],
        'session' => [
            // this is the name of the session cookie used for user on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
    ],
    'params' => $params,
];
