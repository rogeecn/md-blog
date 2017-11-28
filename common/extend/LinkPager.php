<?php
namespace common\extend;

class LinkPager extends \yii\widgets\LinkPager
{
    public $nextPageLabel  = '下一页';
    public $prevPageLabel  = '上一页';
    public $firstPageLabel = FALSE;
    public $lastPageLabel  = FALSE;

    protected function renderPageButtons()
    {
        $pageHtml = parent::renderPageButtons();

        return Html::tag("div", $pageHtml, ['class' => 'text-center']);
    }
}