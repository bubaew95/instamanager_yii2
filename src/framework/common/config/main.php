<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru_RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@common/runtime/cache'
        ],

        'urlManager' => [
            'class' => \common\components\UrlManager::class,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            //'showScriptName' => false,
        ],
        'eventManager' => [
            'class' => \common\components\EventManager::class,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => \common\components\PhpMessageSource::class,
                    'basePath' => '/messages',
                ],
            ],
        ],
    ],
];
