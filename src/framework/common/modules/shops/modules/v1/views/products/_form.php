<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\products\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?= $this->title?></h5>
    </div>
    <div class="card-body">

    </div>

    <div class="card-body">
        <div class="products-form">

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'latin_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                    <?php if(!isset($isAjax)) : ?>
                        <?= $form->field($model, 'imageFile')->fileInput() ?>
                    <?php endif ?>

                    <?php
                        if(!$model->isNewRecord && file_exists("{$_SERVER['DOCUMENT_ROOT']}/uploads/shops/{$model->img}")) {
                            echo Html::img("/uploads/shops/{$model->img}", ['width' => 200]);
                        }
                    ?>

                </div>
            </div>

            <div class="text-right">
                <?php
                    $textButton = $model->isNewRecord ? 'Создать' : 'Обновить';
                    echo Html::submitButton("<i class='icon-paperplane mr-2'></i> {$textButton}" , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
                ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

