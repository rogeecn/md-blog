<?php
namespace application\controllers;

use application\base\BaseController;

class SiteController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
