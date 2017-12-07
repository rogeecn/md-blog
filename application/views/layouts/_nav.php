<?php
\yii\bootstrap\NavBar::begin([
    'brandLabel' => \common\utils\Param::Get("site.title"),
    'brandUrl'   => Yii::$app->homeUrl,
    'options'    => [
        'class' => 'navbar navbar-static-top theme-nav',
    ],
]);

$leftMenus   = [
    ['label' => '首页', 'url' => ['/']],
    ['label' => '标签', 'url' => ['/tag']],
    ['label' => '友情链接', 'url' => ['/friend-links']],
    ['label' => 'About', 'url' => ['/page/index', 'pid' => 'about-me']],
];
$leftMenus[] = <<<_FORM
<form class="navbar-form navbar-left" method="get" action="/search">
    <div class="form-group">
        <input type="text" name="keyword" class="form-control" placeholder="Search">
    </div>
</form>
_FORM;


if (\common\utils\UserSession::isGuest()) {
    $rightMenus[] = ['label' => '登录', 'url' => ['/manage/login']];
} else {
    $rightMenus[] = ['label' => '发表', 'url' => ['/manage/post/create']];
    $rightMenus[] = ['label' => '退出', 'url' => ['/manage/logout']];
}

echo \yii\bootstrap\Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items'   => $leftMenus,
]);

echo \yii\bootstrap\Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items'   => $rightMenus,
]);

\yii\bootstrap\NavBar::end();
