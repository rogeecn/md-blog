<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'blog',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'application\controllers',
    'modules'             => [
        'manage' => [
            'class' => 'application\modules\manage\Module',
        ],
    ],
    'components'          => [
        'request'      => [
            'csrfParam' => '_csrf_blog',
        ],
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => TRUE,
            'loginUrl'        => [
                'manage/login',
            ],
        ],
        'session'      => [
            'name' => 'sess_blog',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => TRUE,
            'showScriptName'  => FALSE,
            'rules'           => [
            ],
        ],
        'formatter'    => [
            'dateFormat'     => 'php:y/m/d',
            'datetimeFormat' => 'php:y/m/d H:i',
            'timeFormat'     => 'php:H:i:s',
        ],
        'view'         => [
            'class' => 'common\extend\View',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset'             => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ],
                    'js'        => [
                        '//cdn.staticfile.org/jquery/3.2.1/jquery.min.js',
                    ],
                ],
                'plugins\FontAwesome\FontAwesome' => [
                    'css' => [
                        '//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css',
                    ],
                ],
            ],
        ],
    ],
    'params'              => $params,
];
