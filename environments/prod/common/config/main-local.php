<?php
return [
    'components' => [
        'db'     => [
            'class'               => 'yii\db\Connection',
            'dsn'                 => sprintf('mysql:host=%s;dbname=%s', DB_MASTER_INNER, "blog_711xd"),
            'username'            => DB_USERNAME,
            'password'            => DB_PASSWORD,
            'charset'             => 'utf8',
            'enableSchemaCache'   => TRUE,
            'schemaCacheDuration' => 3600,
        ],
        'mailer' => [
            'class'    => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
