<?php
use yii\helpers\Html;

/** @var string $content */
?>
<div class="container">
    <div class="row">

        <div class="col-md-9" id="main">
            <?= $content; ?>
        </div>

        <div class="col-md-3">
            <div id="profile">
                <div class="panel panel-default text-center">
                    <div class="panel-body">
                        <?= Html::img("/images/avatar.jpg", ['id' => 'avatar']) ?>
                    </div>
                    <div class="panel-body">
                        <h2 id="name">Rogee</h2>
                        <h3 id="title">Web Developer &amp; Designer</h3>
                    </div>
                    <div class="panel-body" id="follow">
                        <?= Html::a("FOLLOW", "https://github.com/rogeecn", [
                            'class'  => 'btn btn-info',
                            'style'  => 'border-radius: 34px',
                            'target' => '_blank',
                        ]) ?>
                    </div>
                    <table class="table table-bordered" id="post-info">
                        <tr>
                            <td>
                                <?= \common\models\Post::totalCount() ?>
                                <span>POSTS</span>
                            </td>
                            <td>
                                <?= \common\models\Tag::totalCount() ?>
                                <span>TAGS</span>
                            </td>
                        </tr>
                    </table>
                    <!--                    <table class="table" id="sns-info">-->
                    <!--                        <tr>-->
                    <!--                            <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>-->
                    <!--                            <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>-->
                    <!--                            <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>-->
                    <!--                            <td><a href="#"><span class="glyphicon glyphicon-apple"></span></a></td>-->
                    <!--                        </tr>-->
                    <!--                    </table>-->
                </div>
            </div>
        </div>
    </div>
</div>
