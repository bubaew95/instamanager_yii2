<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 28.04.2019
 * Time: 22:53
 */

namespace backend\assets;


use yii\web\AssetBundle;

class EchartLinesAssets extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        "js/plugins/visualization/echarts/echarts.min.js",
        "js/demo_pages/charts/echarts/pies_donuts.js",
        "js/demo_pages/charts/echarts/lines.js",
    ];
    public $depends = [
    ];
}