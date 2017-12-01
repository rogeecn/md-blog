<?php

/* @var $this \common\extend\View */
/* @var $content string */
/* @var $snip string */

use application\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= $this->commonMetaTags() ?>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $this->render("_nav") ?>
<?php require sprintf("%s/%s.php", __DIR__, $snip); ?>
<?= $this->render("_footer") ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

