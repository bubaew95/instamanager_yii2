<?php
/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator yii\gii\generators\module\Generator */

?>
<div class="module-form">
<?php
    echo $form->field($generator, 'moduleName');
    echo $form->field($generator, 'moduleText')->textarea();
    echo $form->field($generator, 'moduleClass');
    echo $form->field($generator, 'moduleID');
//    echo $form->field($generator, 'moduleImages')->fileInput();
?>
</div>
