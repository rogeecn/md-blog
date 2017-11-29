<?php

namespace application\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl  = '@web';
    public $css      = [
        'css/site.css',
        '//cdn.staticfile.org/highlight.js/9.12.0/styles/github.min.css',
    ];
    public $js       = [
        "//cdn.staticfile.org/highlight.js/9.12.0/highlight.min.js",
    ];
    public $depends  = [
        'yii\bootstrap\BootstrapAsset',
    ];
}
