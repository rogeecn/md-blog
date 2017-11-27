<?php
namespace application\base;


use common\utils\UserSession;

trait TraitNeedLogin
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