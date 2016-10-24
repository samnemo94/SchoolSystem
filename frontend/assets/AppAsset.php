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
        'css/site.css',
        'css/style.min.css',
        'css/roboto_font.css',
        //'css/dropzone.min.css',
       // 'css/jquery-jvectormap.css',
       // 'css/nouislider.min.css',
    ];
    public $js = [
        'js/jquery.min.js',
//        'js/colors.js',
//        'js/bootstrap-datepicker.min.js',
//        'js/bootstrap-timepicker.js',
//        'js/Chart.min.js',
//        'js/dataTables.bootstrap.js',
//        'js/dropzone.min.js',
//        'js/fullcalendar.min.js',
//        'js/jquery.bootstrap-touchspin.js',
//        'js/jquery.countdown.min.js',
//        'js/jquery.dataTables.js',
//        'js/jquery.fancytree-all.min.js',
//        'js/jquery.jvectormap.min.js',
//        'js/jquery.nestable.js',
//        'js/moment.min.js',
//        'js/morris.min.js',
//        'js/nouislider.min.js',
//        'js/raphael.min.js',
//        'js/summernote.min.js',
//        'js/sweetalert.min.js',
        'js/tether.min.js',
        'js/bootstrap.min.js',
        'js/adminplus.js',
        'js/main.min.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
          'yii\materialicons\AssetBundle'
    ];
}
