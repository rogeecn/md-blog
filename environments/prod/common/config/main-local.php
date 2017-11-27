<?php
return [
    'components' => [
        'db'     => [
            'class'               => 'yii\db\Connection',
            'dsn'                 => 'mysql:host=master-inner.db.service.ipaoyun.com;dbname=ipaoyun_portal',
            'username'            => 'application',
            'password'            => 'Application@!$)@)@',
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
