<?php
use common\extend\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Post */
/* @var $tag \common\models\Tag */
?>
<article class="panel panel-default post-list">
    <div class="panel-body post-title">
        <h1>
            <a class="article-title" href="#"><?= Html::encode($model->title) ?></a>
        </h1>

        <div class="article-meta">
            <span class="post-date">
                <span class="glyphicon glyphicon-time"></span>
                <time><?= date("Y-m-d", $model->created_at) ?></time>
            </span>
        </div>
    </div>


    <div class="panel-body">
        <?= $model->descriptionHtml() ?>
    </div>

    <div class="panel-body">
        <?php foreach ($model->getTagModel() as $tag): ?>
            <?= Html::a($tag->name, ['/tag/index', 'id' => $tag->name], ['class' => 'badge']) ?>
        <?php endforeach; ?>


        <div class="pull-right">
            <div class="article-more-link">
                <?= Html::a("Read More", ['/read/index', 'id' => $model->primaryKey]) ?>
            </div>
        </div>
    </div>
</article>

