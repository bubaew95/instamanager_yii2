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
        "https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900",
        "css/icons/icomoon/styles.css",
        "css/icons/glyphicon/styles.css",
        "css/icons/fontawesome/styles.min.css",
        "css/bootstrap.min.css",
        "css/bootstrap_limitless.min.css",
        "css/layout.min.css",
        "css/components.min.css",
        "css/colors.min.css",
        "css/style.css",
    ];
    public $js = [
        'js/template/bootstrap.bundle.min.js',
        'js/template/blockui.min.js',
        'js/template/ripple.min.js',
        'js/duallistbox.min.js',
        'js/jquery.cookie.js',
        'js/uniform.min.js',
        'js/app.js',
        'js/modal/modal.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\jui\JuiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
