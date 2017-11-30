<?php
/* @var $this yii\web\View */
/* @var $keyword string */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = $keyword;
?>
<h1 class="tag-title">搜索: <?= \common\extend\Html::encode($keyword) ?></h1>
<?= $this->render("_list", ['dataProvider' => $dataProvider]) ?>
