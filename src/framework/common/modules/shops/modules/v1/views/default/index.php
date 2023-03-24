<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\themes\Themes;
use yii\helpers\ArrayHelper;

$this->title = 'Магазины';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules/index']];
$this->params['breadcrumbs'][] = $this->title;


$themes = ArrayHelper::map(Themes::find()->all(), 'id', 'name');

?>

<div class="card">

    <?= $this->render('../_header')?>

    <div class="card-header header-elements-inline">
        <h5 class="card-title"> Настройки модуля интернет магазина </h5>
        <div class="header-elements">
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">
            Настройте свой интернет магазин
        </p>

        Главная страница

    </div>
</div>