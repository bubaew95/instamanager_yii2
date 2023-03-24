<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\instagram\InstagramDataModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="instagram-data-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_instagram')->textInput() ?>

    <?= $form->field($model, 'id_product')->textInput() ?>

    <?= $form->field($model, 'media_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'likes')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
