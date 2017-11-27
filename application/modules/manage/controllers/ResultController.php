<?php

namespace application\modules\manage\controllers;

use application\base\BaseController;

class ResultController extends BaseController
{
    public function actionSuccess()
    {
        return $this->render("success");
    }

    public function actionFail()
    {
        return $this->render("fail");
    }
}
