<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title                   = '编辑文章';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render("_form", [
    'model' => $model,
]); ?>
