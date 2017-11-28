<?php
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Post */

$articleUrl = ['/page/index', 'id' => $model->slug];
?>
<article class="panel panel-default">
    <div class="panel-body post-title">
        <h1>
            <?= Html::a(Html::encode($model->title), $articleUrl, ['class' => 'article-title']) ?>
        </h1>

        <div class="article-meta">
            <span class="post-date">
                <span class="glyphicon glyphicon-time"></span>
                <time><?= date("Y-m-d", $model->created_at) ?></time>
            </span>

            <?php if (!\common\utils\UserSession::isGuest()): ?>
                <span class="admin">
                <?= Html::a("[编辑]", ['/manage/post/edit', 'id' => $model->id]) ?>
            </span>
            <?php endif; ?>
        </div>
    </div>


    <div class="panel-body article-content"><?= $model->renderContent() ?></div>

    <div class="panel-body">
        <a class="badge">LifeStyle</a>
        <a class="badge">LifeStyle</a>
        <a class="badge">LifeStyle</a>
        <a class="badge">LifeStyle</a>
    </div>
</article>
