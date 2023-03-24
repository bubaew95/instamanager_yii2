<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\instagram\InstagramDataModel */

$this->title = 'Update Instagram Data Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Instagram Data Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="instagram-data-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
