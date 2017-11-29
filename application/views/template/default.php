<?php
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var $model \common\models\Post */

$this->title = $model->title;
$articleUrl  = ['/page/index', 'id' => $model->slug];
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


    <div class="panel-body article-content">
        <?= $model->renderContent() ?>

        <div class="alert alert-warning copyright">
            <ul>
                <li>
                    版权声明：自由转载-非商用-非衍生-保持署名（<a href="https://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh">创意共享3.0许可证</a>）
                </li>
                <li>
                    发表日期：<?= date("Y-m-d", $model->created_at) ?>
                </li>
            </ul>
        </div>
    </div>


    <div class="panel-body">
        <?php foreach ($model->getTagModel() as $tag): ?>
            <?= Html::a($tag->name, ['/tag-list/index', 'id' => $tag->name], ['class' => 'badge']) ?>
        <?php endforeach; ?>
    </div>
</article>
