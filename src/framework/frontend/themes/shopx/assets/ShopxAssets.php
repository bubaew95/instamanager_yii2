<?php
namespace frontend\themes\shopx\assets;

use yii\web\AssetBundle;

class ShopxAssets extends AssetBundle
{
    public $baseUrl = '/shopx/assets';

    public $css = [
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7cPlayfair+Display:400,400i,700,900',
        'icons/font-awesome-4.7.0/css/font-awesome.min.css',
        'fonts/flaticon.css',
        "plugins/css/bootstrap.min.css",
        "plugins/css/jquery.fancybox.min.css",
        "plugins/css/animate.css",
        "plugins/css/owl.css",
        "plugins/css/flexslider.min.css",
        "plugins/css/selectize.css",
        "plugins/css/selectize.bootstrap3.css",
        "plugins/css/jquery-ui.min.css",
        "plugins/css/bootstrap-dropdownhover.min.css",
        "plugins/css/meanmenu.css",
        "css/style.css",
        "css/responsive.css"
    ];
    public $js = [
        "plugins/js/jquery-1.11.3.min.js",
        "plugins/js/bootstrap.min.js",
        "plugins/js/meanmenu.js",
        "plugins/js/jquery.ajaxchimp.min.js",
        "plugins/js/wow.min.js",
        "plugins/js/owl.carousel.js",
        "plugins/js/jquery.flexslider-min.js",
        "plugins/js/bootstrap-dropdownhover.min.js",
        "plugins/js/jquery-ui.min.js",
        "plugins/js/validator.min.js",
        "plugins/js/smooth-scroll.js",
        "plugins/js/jquery.fancybox.min.js",
        "plugins/js/standalone/selectize.js",
        "js/init.js"
    ];

}