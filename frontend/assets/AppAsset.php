<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'fa/css/all.min.css',
        'summernote/summernote.min.css',
    ];
    public $js = [
        'js/autoload.js',
        'js/ajax.js',
        'js/functions.js',
        'summernote/summernote.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
