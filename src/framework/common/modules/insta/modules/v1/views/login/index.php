<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "Инстграм модуль - авторизация";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-xl-3 col-md-8 col-sm-6 col-lg-offset-4">
    <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>
    <div class="card mb-0">
        <div class="card-body">
            <div class="text-center mb-3">
                <i class="icon-instagram icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                <h5 class="mb-0">Авторизация в Инстграм</h5>
                <span class="d-block text-muted">Your credentials</span>
            </div>

            <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Авторизация <i class="icon-circle-right2 ml-2"></i>', ['class' => 'btn btn-primary btn-block', 'name' => 'user-button']) ?>
            </div>

            <span class="form-text text-center text-muted">

                </span>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
