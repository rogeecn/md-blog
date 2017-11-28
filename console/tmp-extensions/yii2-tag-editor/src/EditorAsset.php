<?php

namespace rogeecn\TagEditor;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class EditorAsset extends AssetBundle
{
    public $sourcePath = '@bower/jquery-tag-editor';

    public function init()
    {
        $this->css = [
            'jquery.tag-editor.css',
        ];

        $this->js = [
            'jquery.caret.min.js',
            'jquery.tag-editor.min.js',
        ];

        $this->depends = [
            JqueryAsset::className(),
        ];
    }
}