<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\products\Products */

$this->title = $model->name;
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Магазин', 'url' => ['/shops']];
$this->params['breadcrumbs']['products'] = ['label' => 'Товары', 'url' => ['/shops/products']];
$this->params['breadcrumbs'][] = "Редактирование: {$model->name}" ;
?>
<div class="products-update">

    <?= $this->render('_form', [
        'isAjax' => $isAjax,
        'model' => $model,
    ]) ?>

</div>
