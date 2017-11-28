<?php
/* @var $this yii\web\View */
?>
<?php for ($i = 0; $i < 10; $i++): ?>
    <article class="panel panel-default article article-type-post">
        <div class="panel-body post-title">
            <h1>
                <a class="article-title" href="#">Take aDeep Breath and Just Be</a>
            </h1>

            <div class="article-meta">
                    <span class="post-date">
                        <span class="glyphicon glyphicon-time"></span>
                        <time>2016-07-12</time>
                    </span>
            </div>
        </div>


        <div class="panel-body">
            <p>
                This is Icarus, a free responsive, high resolution and pretty flexible theme for you to use to
                write
                about things you love. Make sure to check all the examples out! To download this theme or to
                check
                the full feature list, just go here. Feel free to leave a comment there if you digg it!
            </p>

            <div class="article-more-link">
                <a href="#">Read More</a>
            </div>
        </div>

        <div class="panel-body">
            <a class="badge">LifeStyle</a>
            <a class="badge">LifeStyle</a>
            <a class="badge">LifeStyle</a>
            <a class="badge">LifeStyle</a>
        </div>
    </article>
<?php endfor; ?>

