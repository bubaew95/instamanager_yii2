<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\insta\modules\common\insta\MediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Instagram Data Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="instagram-data-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Instagram Data Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_instagram',
            'id_product',
            'media_id',
            'link',
            //'likes',
            //'comments',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
