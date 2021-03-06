<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2prod',
            'username' => 'root',
            'password' => '',
            'enableQueryCache' => true,
            'enableSchemaCache' => true,
            'schemaCacheDuration' => false,
            'charset' => 'utf8',
        ],
        'db-oci' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'oci:host=localhost/1521;dbname=yii2prod',
            'username' => 'root',
            'password' => '',
            'enableQueryCache' => true,
            'enableSchemaCache' => true,
            'schemaCacheDuration' => false,
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
