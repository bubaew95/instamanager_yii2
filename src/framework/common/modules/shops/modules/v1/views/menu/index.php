<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\menu\Menu;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\shops\modules\common\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Меню';
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
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'summary' =>false,
                'tableOptions' => [
                    'class' => 'table datatable-html dataTable no-footer'
                ],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'options' => [
                            'width' => 60
                        ]
                    ],

                    //'id',
//            'id_shop'
                    [
                        'attribute' => 'name',
                        'format' => 'html',
                        'value' => function($model) {
                            return "<i class='fa {$model->icon}'></i> {$model->name}";
                        }
                    ],
                    [
                        'attribute' => 'tree',
                        'label' => 'Root',
                        'filter' => Menu::find()->roots()->select('name, id')->indexBy('id')->column(),
                        'value' => function ($model)
                        {
                            if ( ! $model->isRoot())
                                return $model->parents()->one()->name;
                            return 'No Parent';
                        }
                    ],
                    [
                        'attribute' => 'position',
                        'options' => [
                            'width' => 100
                        ]
                    ],

//            'icon',
//            'lft',
                    //'rgt',
                    //'depth',
//            'created_at',
//            'updated_at',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options' => [
                            'width' => 100
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
