<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\instagram\InstagramDataModel */

$this->title = 'Create Instagram Data Model';
$this->params['breadcrumbs'][] = ['label' => 'Instagram Data Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instagram-data-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
