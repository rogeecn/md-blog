<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = "TAG";
?>

<article class="panel panel-default tag-list">
    <div class="panel-body post-title">
        <h1>Tag</h1>
    </div>
    <?= \yii\widgets\ListView::widget([
        'itemOptions'  => [
            'tag' => 'span',
        ],
        'options'      => [
            'class' => 'panel-body',
        ],
        'itemView'     => '_item_tag',
        'layout'       => "{items}\n{pager}",
        'dataProvider' => $dataProvider,
        'pager'        => [
            'class' => \common\extend\LinkPager::className(),
        ],
    ]) ?>
</article>

