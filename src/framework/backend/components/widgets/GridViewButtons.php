<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 29.04.2019
 * Time: 23:28
 */

namespace backend\components\widgets;

use yii\helpers\Html;

class GridViewButtons
{


    public static function viewButtons(array $buttons = [])
    {
        return [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="icon-eye2"></i>', $url, [
                        'title' => 'Full Details',
                        'data-pjax' => '0',
                    ]);
                },
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="icon-pencil"></i>', $url, [
                        'title' => 'Full Details',
                        'data-pjax' => '0',
                    ]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="icon-trash-alt"></i>', $url, [
                        'title' => \Yii::t('yii', 'Delete'),
                        'data-confirm' => 'Are you sure you want to delete?',
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ]);
                },
            ],
        ];
    }

}