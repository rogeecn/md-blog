<?php
namespace common\extend;


class ErrorAction extends \yii\web\ErrorAction
{
    public $view = "/error";

    protected function renderHtmlResponse()
    {
        return $this->controller->render($this->view ?: $this->id, $this->getViewRenderParams());
    }
}