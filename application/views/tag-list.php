<?php
/* @var $this yii\web\View */
/* @var $tag string */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = "TAG: " . $tag;
?>
<h1 class="tag-title">Tag: <?= \common\extend\Html::encode($tag) ?></h1>
<?= $this->render("_list", ['dataProvider' => $dataProvider]) ?>
