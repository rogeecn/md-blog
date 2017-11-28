<?php
use common\extend\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Post */
/* @var $tag \common\models\Tag */

$articleUrl = [
    '/page/index',
    'year'  => date("Y", $model->created_at),
    'month' => date("m", $model->created_at),
    'day'   => date("d", $model->created_at),
    'id'    => $model->slug,
];

?>
<article class="panel panel-default post-list">
    <div class="panel-body post-title">
        <h1>
            <?= Html::a($model->renderTitle(), $articleUrl, ['class' => 'article-title']) ?>
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

    <div class="panel-body"><?= $model->renderDescription() ?></div>

    <div class="panel-body">
        <?php foreach ($model->getTagModel() as $tag): ?>
            <?= Html::a($tag->name, ['/tag-list/index', 'id' => $tag->name], ['class' => 'badge']) ?>
        <?php endforeach; ?>


        <div class="pull-right">
            <div class="article-more-link">
                <?= Html::a("Read More", $articleUrl) ?>
            </div>
        </div>
    </div>
</article>

