<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\themes\Themes;
use yii\helpers\ArrayHelper;

$this->title = 'Магазины';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules/index']];
$this->params['breadcrumbs'][] = $this->title;


$themes = ArrayHelper::map(Themes::find()->all(), 'id', 'name');

?>

<div class="card">

    <?= $this->render('../_header')?>

    <div class="card-header header-elements-inline">
        <h5 class="card-title"> Настройки модуля интернет магазина </h5>
        <div class="header-elements">
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">
            Настройте свой интернет магазин
        </p>

        <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'latin_name')->textInput(['maxlength' => true, 'disabled' => (!$model->isNewRecord ? true : false)]) ?>
                    <?= $form->field($model, 'text')->textarea() ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'id_theme')->dropDownList($themes, ['disabled' => true]) ?>
                    <?= $form->field($model, 'imageFile')->fileInput() ?>

                    <?php if($model->img) :?>
                        <?= Html::img(SHOPS_IMG . "{$model->id_project}/logo/{$model->img}", ['width' => 100]);?>
                    <?php endif ?>

                    <?= $form->field($model, 'keywords')->textarea() ?>
                    <?= $form->field($model, 'description')->textarea() ?>
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