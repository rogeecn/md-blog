<?php
\yii\bootstrap\NavBar::begin([
    'brandLabel' => $this->title,
    'brandUrl'   => false,
    'options'    => [
        'class' => 'navbar navbar-default navbar-static-top',
    ],
]);

$rightMenus = [
    ['label' => '首页', 'url' => ['/']],
];

if (\common\utils\UserSession::isGuest()) {
    $rightMenus[] = ['label' => '登录', 'url' => ['/manage/login']];
} else {
    $rightMenus[] = ['label' => '退出', 'url' => ['/manage/logout']];
}

//echo \yii\bootstrap\Nav::widget([
//    'options' => ['class' => 'navbar-nav'],
//    'items'   => $leftMenus,
//]);

echo \yii\bootstrap\Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items'   => $rightMenus,
]);

\yii\bootstrap\NavBar::end();
