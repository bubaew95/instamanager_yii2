<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\products\Products */

$this->title = $model->name;
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Магазин', 'url' => ['/shops']];
$this->params['breadcrumbs']['products'] = ['label' => 'Товары', 'url' => ['/shops/products']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="card ">

    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?= $this->title?></h5>
        <div class="header-elements">
            <?= Html::a("<i class='icon-pencil3'></i>", ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?> &nbsp;
            <?= Html::a("<i class='icon-trash'></i>", ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'img',
                    'format' => 'html',
                    'value' => Html::img($model->instagramData ? $model->img : "/uploads/shops/{$model->id_project}/{$model->img}", ['width' => 200]),
                ],
                'id_project',
                'name',
                'latin_name',
                'text:ntext',
                'price',
                'created_at',
            ],
        ]) ?>
    </div>
</div>
