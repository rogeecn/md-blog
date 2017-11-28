<?php
namespace application\base;

use common\utils\Request;
use yii\web\Controller;

class BaseController extends Controller
{
    public $layoutSnip = "main";


    public function goBack($defaultUrl = NULL)
    {
        return parent::goBack(Request::input("__returnUrl"));
    }


    public function getRoute()
    {
        $route = parent::getRoute();
        if (substr($route, -6) == "/index") {
            $route = substr($route, 0, -6);
        }

        return $route;
    }

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
}