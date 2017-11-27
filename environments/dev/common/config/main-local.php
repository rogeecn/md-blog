<?php
return [
    'components' => [
        'db'     => [
            'class'    => 'yii\db\Connection',
            'dsn'      => 'mysql:host=localhost;dbname=dev_blog',
            'username' => 'root',
            'password' => 'admin',
            'charset'  => 'utf8',
        ],
        'mailer' => [
            'class'            => 'yii\swiftmailer\Mailer',
            'viewPath'         => '@common/mail',
            'useFileTransport' => TRUE,
        ],
    ],
];
