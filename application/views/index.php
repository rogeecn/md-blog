<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
?>
<?= \yii\widgets\ListView::widget([
    'itemView'     => '_item',
    'layout'       => "{items}\n{pager}",
    'dataProvider' => $dataProvider,
]) ?>

