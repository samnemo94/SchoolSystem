<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/animate.min.css',
        'css/light-bootstrap-dashboard.css',
        'css/roboto_font.css',
        'css/pe-icon-7-stroke.css',
        'css/application.css'
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/bootstrap-checkbox-radio-switch.js',
        'js/chartist.min.js',
        'js/bootstrap-notify.js',
        'js/light-bootstrap-dashboard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle'
    ];
}
