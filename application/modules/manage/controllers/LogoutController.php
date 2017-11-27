<?php

namespace application\modules\manage\controllers;

use application\base\BaseController;

class LogoutController extends BaseController
{
    public function actionIndex()
    {
        \Yii::$app->user->logout(true);

        return $this->redirect("/");
    }
}
