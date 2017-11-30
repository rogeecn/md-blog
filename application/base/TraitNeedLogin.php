<?php
namespace application\base;


use common\utils\UserSession;

trait TraitNeedLogin
{
    public function beforeAction($action)
    {
        if (UserSession::isGuest()) {
            UserSession::needLogin();

            return FALSE;
        }

        return parent::beforeAction($action);
    }
}