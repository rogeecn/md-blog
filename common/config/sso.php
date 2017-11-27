<?php
return [
    'components' => [
        'user'          => [
            'enableAutoLogin' => TRUE,
            'identityCookie'  => [
                'name'     => '_Q',
                'httpOnly' => TRUE,
                'domain'   => ".gochat.local",
            ],
        ],
        'redis.session' => [
            'class'    => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port'     => 6379,
            'database' => 2,
        ],
        'session'       => [
            'class'        => 'yii\redis\Session',
            'redis'        => 'redis.session',
            'keyPrefix'    => 'sess_',
            'name'         => 'session_id',
            'cookieParams' => [
                'domain'   => ".gochat.local",
                'lifetime' => 3600,
                'path'     => '/',
            ],
            'timeout'      => 3600,
        ],
        'request'       => [
            'cookieValidationKey' => 'QB7cRrj331HVcNnl8xFEpc_t2mzU_CCe',
        ],
    ],
];
