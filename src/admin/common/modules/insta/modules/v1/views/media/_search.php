<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\insta\modules\common\insta\MediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instagram-data-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_instagram') ?>

    <?= $form->field($model, 'id_product') ?>

    <?= $form->field($model, 'media_id') ?>

    <?= $form->field($model, 'link') ?>

    <?php // echo $form->field($model, 'likes') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
