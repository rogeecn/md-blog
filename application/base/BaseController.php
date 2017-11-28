<?php
namespace application\base;

use common\extend\Pagination;
use common\models\Post;
use common\utils\Request;
use common\utils\UserSession;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;

class BaseController extends Controller
{
    public $layoutSnip    = "main";
    public $pageItemCount = 10;


    public function goBack($defaultUrl = NULL)
    {
        return parent::goBack(Request::input("__returnUrl"));
    }


//    public function getRoute()
//    {
//        $route = parent::getRoute();
//        if (substr($route, -6) == "/index") {
//            $route = substr($route, 0, -6);
//        }
//
//        return $route;
//    }

    public function renderContent($content)
    {
        $layoutFile = $this->findLayoutFile($this->getView());
        if ($layoutFile !== FALSE) {
            $snipFile = "__" . $this->layoutSnip;

            return $this->getView()->renderFile($layoutFile, [
                'content' => $content,
                'snip'    => $snipFile,
            ], $this);
        }

        return $content;
    }

    /**
     * @param string|array $view
     * @param array        $params
     *
     * @return string
     */
    public function render($view, $params = [])
    {
        if (is_array($view)) {
            return parent::render("index", $view);
        }

        return parent::render($view, $params);
    }

    /**
     * @param Query $query
     *
     * @return string
     */
    public function getArticleListDataProvider($query)
    {
        $query->orderBy(['id' => SORT_DESC]);
        $query->andWhere(['type' => Post::TYPE_ARTICLE]);

        if (UserSession::isGuest()) {
            $query->andWhere(['status' => Post::STATUS_NORMAL]);
        }

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'class'           => Pagination::className(),
                'defaultPageSize' => 10,
            ],
        ]);

        return $dataProvider;

    }
}