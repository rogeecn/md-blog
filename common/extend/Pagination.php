<?php
namespace common\extend;

use Yii;
use yii\web\Request;

class Pagination extends \yii\data\Pagination
{
    public function createUrl($page, $pageSize = NULL, $absolute = FALSE)
    {
        $page     = (int)$page;
        $pageSize = (int)$pageSize;
        if (($params = $this->params) === NULL) {
            $request = Yii::$app->getRequest();
            $params  = $request instanceof Request ? $request->getQueryParams() : [];
        }
        if ($page > 0 || $page == 0 && $this->forcePageParam) {
            $params[$this->pageParam] = $page + 1;
        } else {
            unset($params[$this->pageParam]);
        }
        if ($pageSize <= 0) {
            $pageSize = $this->getPageSize();
        }
        if ($pageSize != $this->defaultPageSize) {
            $params[$this->pageSizeParam] = $pageSize;
        } else {
            unset($params[$this->pageSizeParam]);
        }
        $params[0] = $this->route === NULL ? Yii::$app->controller->getRoute() : $this->route;
        if (count(explode("/", $params[0])) == 1) {
            $params[0] .= "/index";
        }

        $urlManager = $this->urlManager === NULL ? Yii::$app->getUrlManager() : $this->urlManager;
        if ($absolute) {
            return $urlManager->createAbsoluteUrl($params);
        }

        return $urlManager->createUrl($params);
    }
}