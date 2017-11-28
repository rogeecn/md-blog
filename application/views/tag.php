<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

?>

<article class="panel panel-default tag-list">
    <div class="panel-body post-title">
        <h1>Tag</h1>
    </div>
    <?= \yii\widgets\ListView::widget([
        'itemOptions'  => [
            'tag' => 'span',
        ],
        'itemView'     => '_item_tag',
        'layout'       => "<div class=\"panel-body\">{items}</div>\n<div class=\"panel-body\">{pager}</div>",
        'dataProvider' => $dataProvider,
        'pager'        => [
            'class' => \common\extend\LinkPager::className(),
        ],
    ]) ?>
</article>

