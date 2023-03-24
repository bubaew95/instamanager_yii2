<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 15/09/2019
 * Time: 17:42
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'MS Luis';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card ">
    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?= $this->title?></h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">

        </p>
    </div>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => '<div class="form-group row"> {label} <div class="col-lg-10">{input}{error}{hint}</div></div>',
                'labelOptions'=>['class' => 'col-form-label col-lg-2'],
            ],
        ]) ?>
        <?= $form->field($model, 'app_key')?>
        <?= $form->field($model, 'subscription_key')->textInput()?>
        <?= $form->field($model, 'verbose')->checkbox()?>
        <?= $form->field($model, 'active')->checkbox()?>

        <div class="text-right">
            <?php
                $textButton = $model->isNewRecord ? 'Создать' : 'Обновить';
                echo Html::submitButton("<i class='icon-paperplane mr-2'></i> {$textButton}" , ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
            ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
