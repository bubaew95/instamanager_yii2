<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=mariadb.dbnetwork;dbname=neb_library_95',
            'username' => 'root',
            'password' => 'library95',
            'charset' => 'utf8',
            'tablePrefix' => 'dj_',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
