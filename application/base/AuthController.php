<?php
namespace application\base;

use common\utils\UserSession;

class AuthController extends BaseController
{
    public function beforeAction($action)
    {
        if (UserSession::isGuest()) {
            $this->redirect("/site/login");

            return false;
        }

        return parent::beforeAction($action);
    }
}