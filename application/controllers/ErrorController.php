<?php
namespace application\controllers;

use application\base\BaseController;

class ErrorController extends BaseController
{
    public function actions()
    {
        return [
            'index' => [
                'class' => 'common\extend\ErrorAction',
            ],
        ];
    }
}
