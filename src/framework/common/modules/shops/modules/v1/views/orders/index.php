<?php
use yii\helpers\Html;

$this->title = 'Заказы';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs']['shops'] = ['label' => 'Магазин', 'url' => ['/shops']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card ">
    <?= $this->render('../_header')?>

    <div class="card-header header-elements-inline">
        <h5 class="card-title"><?= $this->title?></h5>
        <div class="header-elements">
            <?= Html::a("<i class='icon-plus-circle2'></i>", ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        </div>
    </div>

    <div class="card-body">

    </div>
    <div class="dataTables_wrapper no-footer">
        <div class="books-index table-responsive">

        </div>
    </div>
</div>