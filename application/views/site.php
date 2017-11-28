<?php
/* @var $this yii\web\View */
?>


<aside id="profile">
    <div class="panel panel-default text-center">
        <div class="panel-body">
            <img id="avatar" src="http://blog.zhangruipeng.me/hexo-theme-icarus/css/images/avatar.png">
        </div>
        <div class="panel-body">
            <h2 id="name">PPOffice</h2>
            <h3 id="title">Web Developer &amp; Designer</h3>
        </div>
        <div class="panel-body" id="follow">
            <a href="/" class="btn btn-info">FOLLOW ME</a>
        </div>
        <table class="table table-bordered" id="post-info">
            <tr>
                <td>
                    13
                    <span>POST</span>
                </td>
                <td>
                    13
                    <span>TAG</span>
                </td>
            </tr>
        </table>
        <table class="table" id="sns-info">
            <tr>
                <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>
                <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>
                <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>
                <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>
            </tr>
        </table>
    </div>
</aside>


<section id="main">
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
                <span class="glyphicon glyphicon-tag"></span>
                <a class="btn btn-default btn-xs">LifeStyle</a>
                <a class="btn btn-default btn-xs">LifeStyle</a>
                <a class="btn btn-default btn-xs">LifeStyle</a>
            </div>
        </article>
    <?php endfor; ?>

    <nav id="page-nav">
        <span class="page-number current">1</span><a class="page-number" href="/hexo-theme-icarus/page/2/">2</a><a
                class="page-number" href="/hexo-theme-icarus/page/3/">3</a><a class="extend next" rel="next"
                                                                              href="/hexo-theme-icarus/page/2/">Next
            »</a>
    </nav>
</section>

<aside id="sidebar">

    <div class="widget">
        <h3>RECENT</h3>
        <ul class="list-unstyled">
            <li><a class="mute" href="#">Take a DDeep Breath and Just BeDeep Breath and Just BeDeep Breath and Just Beeep Breath and Just Be</a></li>
            <li><a class="mute" href="#">Take a Deep Breath and Just Be</a></li>
            <li><a class="mute" href="#">Take a Deep Breath and Just Be</a></li>
            <li><a class="mute" href="#">Take a Deep Breath and Just Be</a></li>
            <li><a class="mute" href="#">Take a Deep Breath and Just Be</a></li>
        </ul>
    </div>
    <div class="widget">
        <h3>TAG</h3>
        <div>

        </div>
    </div>
</aside>

