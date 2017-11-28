<?php
namespace application\controllers;

use application\base\BaseController;

class ReadController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
