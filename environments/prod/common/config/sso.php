<?php
return [
    'components' => [
        'user'          => [
            'enableAutoLogin' => TRUE,
            'identityCookie'  => [
                'name'     => '_identity',
                'httpOnly' => TRUE,
                'domain'   => ".ipaoyun.com",
            ],
        ],
        'redis.session' => [
            'class'    => 'yii\redis\Connection',
            'hostname' => '57ad6d2dc05e4bfc.m.cnhza.kvstore.aliyuncs.com',
            'password' => '57ad6d2dc05e4bfc:Adminhao0202',
            'port'     => 6379,
            'database' => 2,
        ],

        'session' => [
            'class'        => 'yii\redis\Session',
            'redis'        => 'redis.session',
            'keyPrefix'    => 'sess_',
            'name'         => 'session_id',
            'cookieParams' => [
                'domain'   => ".ipaoyun.com",
                'lifetime' => 3600,
                'path'     => '/',
            ],
            'timeout'      => 3600,
        ],
        'request' => [
            'cookieValidationKey' => 'QB7cRrj331HVcNnl8xFEpc_t2mzU_CCe',
        ],
    ],
];
