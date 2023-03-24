<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shops\modules\common\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Магазин', 'url' => ['/shops']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card ">
    <?= $this->render('../_header')?>

    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?= $this->title?></h5>
        <div class="header-elements">
            <?= Html::a("<i class='icon-plus-circle2'></i>", ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>

    <div class="card-body">

    </div>
    <div class="dataTables_wrapper no-footer">
        <div class="books-index table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' =>false,
                'tableOptions' => [
                    'class' => 'table datatable-html dataTable no-footer'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'id_project',
                    [
                        'attribute' => 'img',
                        'filter' => false,
                        'content' => function ($data) {
                            if($data->instagramData) {
                                return Html::img($data->img, ['width' => 100]);
                            }
                            return Html::img("/uploads/shops/{$data->id_project}/{$data->img}", ['width' => 100]);
                        }
                    ],
                    'name',
                    //'latin_name',
//                    'img',
                    //'text:ntext',
                    [
                        'attribute' => 'price',
                        'value' => function($data) {
                            return "{$data->price} ₽";
                        }
                    ],
                    [
                        'attribute' => 'instaData',
                        'filter' => [
                            '0' => 'С сайта',
                            '1' => "С инстаграма",
                        ],
                        'format' => 'html',
                        'value' => function($data) {
                            return !$data->instaData ? '<span class="badge badge-success">Сайт</span>' : '<span class="badge badge-warning">Инстаграм</span>';
                        }
                    ],
                    //'created_at',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>