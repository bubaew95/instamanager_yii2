<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\menu\Menu */

$this->title = 'Новое меню';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Магазин', 'url' => ['/shops']];
$this->params['breadcrumbs']['products'] = ['label' => 'Меню', 'url' => ['/shops/menu']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
