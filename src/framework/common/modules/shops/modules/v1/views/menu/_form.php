<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\components\constants\AwesomeIcons;
use common\models\menu\Menu;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
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

            <div class="row">
                <div class="col-md-5">
                    <?php
                    if($model->errors) {
                        debug($model->errors);
                    }
                    ?>

                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                        <div class='form-group field-attribute-parentId'>
                            <?= Html::label('Parent', 'parent', ['class' => 'control-label']);?>
                            <?= Html::dropdownList(
                                'Menu[parentId]',
                                $model->parentId,
                                Menu::getTree($model->id),
                                ['prompt' => 'No Parent (saved as root)', 'class' => 'form-control']
                            );?>

                        </div>
                        <?php
                        $escape = new JsExpression("function(m) { return m; }");
                        echo $form->field($model, 'icon')->widget(Select2::classname(), [
                            'data' => AwesomeIcons::ICONS,
                            'options' => ['placeholder' => 'Select a state ...'],
                            'pluginOptions' => [
                                'templateResult' => new JsExpression('format'),
                                'templateSelection' => new JsExpression('format'),
                                'escapeMarkup' => $escape,
                            ],
                        ]);
                        ?>

                        <?= $form->field($model, 'position')->textInput(['type' => 'number']) ?>

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
    </div>
</div>

<?php
$format = <<< SCRIPT
    function format(state) { 
        return "<i class='fa "+state.id+"'></i> " + state.id;
    }
SCRIPT;
$this->registerJs($format, \yii\web\View::POS_HEAD);
?>