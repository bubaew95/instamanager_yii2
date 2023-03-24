<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\products\Products */

$this->title = 'Добавить товар';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Магазин', 'url' => ['/shops']];
$this->params['breadcrumbs']['products'] = ['label' => 'Товары', 'url' => ['/shops/products']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
