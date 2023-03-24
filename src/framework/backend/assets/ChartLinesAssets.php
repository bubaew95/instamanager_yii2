<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 28.04.2019
 * Time: 22:49
 */

namespace backend\assets;


use yii\web\AssetBundle;

class ChartLinesAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
        "js/plugins/visualization/d3/d3.min.js",
        "js/plugins/visualization/c3/c3.min.js",
        //<script src="assets/js/app.js"></script>
        "js/demo_pages/charts/c3/c3_lines_areas.js",
    ];
    public $depends = [
    ];
}