<?php

use yii\helpers\Html;
use yii\grid\GridView;
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 01/10/2019
 * Time: 13:10
 */

$this->title = 'Медиа';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Инстаграм', 'url' => ['/insta']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card ">

    <?= $this->render('../_header')?>

    <div class="card-header header-elements-inline">
        <h5 class="card-title"> <?= $this->title?> </h5>
        <div class="header-elements">
            <?= Html::a("<i class='icon-plus-circle2'></i>", ['create'], ['class' => 'btn btn-success btn-sm']) ?> &nbsp;
            <?= Html::a("<i class='icon-reload-alt'></i>", ['loadmedia'], ['class' => 'btn btn-warning btn-sm', 'id' => 'load-media']) ?>
        </div>
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

                    [
                        'attribute' => 'Изображение',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::img($data->product->img, ['width' => 100]);
                        }
                    ],
                    [
                        'attribute' => 'Текст',
                        'format' => 'html',
                        'value' => function ($data) {
                            return $data->product->text;
                        }
                    ],
//                    'id',
//                    'id_instagram',
//                    'id_product',
//                    'media_id',
//                    'link',
                    //'likes',
                    //'comments',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {product} {link} {delete}',
                        'buttons' => [
                            'product' => function ($url,$model,$key) {
                                return Html::a('<i class="icon-insert-template"></i>', ['/shops/products/update', 'id' => $model->id], ['target' => '_blank', 'class' => 'popup-modal']);
                            },
                            'link' => function ($url,$model,$key) {
                                return Html::a('<i class="icon-reply"></i>', $model->link, ['target' => '_blank']);
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS

$(function() {
  $('#load-media').on('click', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        loadMediaPOST(url);
        console.log('href', $(this).attr('href'))
  })
  function loadMediaPOST(nUrl) {
      $.post({
        url: nUrl,
        data: {},
        success: function(data) {
            console.log('data', data);
        }
      })
  }
})

JS;
$this->registerJs($js);

?>