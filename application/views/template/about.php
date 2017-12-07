<?php
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Post */

$this->title = $model->title;
$articleUrl  = ['/page/index', 'pid' => $model->slug];
?>
<article class="panel panel-default">
    <div class="panel-body post-title">
        <h1>
            <?= Html::a(Html::encode($model->title), $articleUrl, ['class' => 'article-title']) ?>
        </h1>
        <div>
            <?php if (!\common\utils\UserSession::isGuest()): ?>
                <span class="admin">
                    <?= Html::a("[编辑]", ['/manage/post/edit', 'id' => $model->id]) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="panel-body markdown-body"><?= $model->renderContent() ?></div>
</article>
