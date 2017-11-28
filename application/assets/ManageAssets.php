<?php

namespace application\assets;

use yii\web\AssetBundle;

class ManageAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css      = [
    ];
    public $js       = [
    ];
    public $depends  = [
        'yii\bootstrap\BootstrapAsset',
        'rogeecn\TagEditor\EditorAsset',
    ];
}
