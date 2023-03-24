<?php
/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = "Модули";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <?php foreach ($modules as $item) : ?>
        <div class="col-xl-2 col-xs-4 col-md-5 col-sm-12">
            <div class="card">
                <div class="card-img-actions mx-1 mt-1">
                    <img class="card-img img-fluid" src="<?= "/admin/images/modules/{$item->img}"?>" alt="">
                </div>

                <div class="card-body">
                    <div class="d-flex align-items-start flex-nowrap">
                        <div>
                            <div class="font-weight-semibold mr-2"><?= $item->name?></div>
                            <span class="font-size-sm text-muted"><?= $item->text?></span>
                        </div>

                        <div class="list-icons list-icons-extended ml-auto">
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <a href="<?= Url::to(["/{$item->m_name}"])?>" class="btn-default btn">Подключить</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach?>
</div>