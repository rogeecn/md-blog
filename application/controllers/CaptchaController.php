<?php
namespace application\controllers;

use application\base\BaseController;

class CaptchaController extends BaseController
{
    public function actions()
    {
        return [
            'index' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : NULL,
                'height'          => 34,
                'minLength'       => 4,
                'maxLength'       => 4,
            ],
        ];
    }
}
