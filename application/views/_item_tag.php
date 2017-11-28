<?php
use common\extend\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Tag */

$tagUrl = ['/tag-list/index', 'id' => $model->name];
?>

<?= Html::a($model->name, $tagUrl, ['class' => 'badge']) ?>
