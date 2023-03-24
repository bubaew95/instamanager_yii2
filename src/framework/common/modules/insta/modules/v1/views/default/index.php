<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 14/09/2019
 * Time: 20:08
 */

$this->title = 'Инстаграм модуль';
$this->params['breadcrumbs']['modules'] = ['label' => 'Модули', 'url' => ['/modules']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?= $this->render('../_header') ?>

<!-- User info -->
<div class="profile-cover">
    <div class="profile-cover-img" style="background-image: url('https://tasteam.com.ua/image/cache/catalog/promo/banner/ban15-1920x393.png')"></div>
    <div class="media align-items-center text-center text-md-left flex-column flex-md-row m-0">
        <div class="mr-md-3 mb-2 mb-md-0">
            <a href="#" class="profile-thumb">
                <img src="<?= $model->avatar?>" class="border-white rounded-circle" width="48" height="48" alt="">
            </a>
        </div>

        <div class="media-body text-white">
            <h1 class="mb-0"><?= $model->login ?></h1>
            <span class="d-block"><?= $model->login ?></span>
        </div>

        <div class="ml-md-3 mt-2 mt-md-0">
            <ul class="list-inline list-inline-condensed mb-0">
                <li class="list-inline-item">
                    <a href="#" class="btn btn-light border-transparent">
                        <i class="icon-file-picture mr-2"></i> Cover image
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="#" class="btn btn-light border-transparent">
                        <i class="icon-file-stats mr-2"></i> Statistics
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end user info -->



<div class="card mt-3">

    <div class="card-body">

        <div class="row">

            <!-- bot settings -->
            <div class="col-md-6 mt-3">
                <h4>Настройки бота</h4>
                <?php $form = ActiveForm::begin([]) ?>
                <?= $form->field($bots, 'allowdirect', [
                    'template' => '<div class="form-check"><label class="form-check-label">{input}{label}</label>{error}{hint}</div>'
                ])->checkbox(['class' => 'form-input-styled', 'data-fouc'])?>

                <?= $form->field($bots, 'answercomment', [
                    'template' => '<div class="form-check"><label class="form-check-label">{input}{label}</label>{error}{hint}</div>'
                ])->checkbox(['class' => 'form-input-styled', 'data-fouc'])?>

                <?= $form->field($bots, 'isII', [
                    'template' => '<div class="form-check"><label class="form-check-label">{input}{label}</label>{error}{hint}</div>'
                ])->checkbox(['class' => 'form-input-styled', 'data-fouc'])?>

                <?= $form->field($bots, 'webhook')->textInput()?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
            <!-- end bot settings -->

            <!-- start run bot -->
            <div class="col-md-6">
                <div class="rounded-left-0 border-bottom-1 border-info">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <h4 class="">Бот в фоновом режиме</h4>
<!--                                --><?php //if($bots->status == 1) : ?>
<!--                                    <ul class="list list-unstyled mb-0">-->
<!--                                        <li>Номер фонового потока #<a>--><?//= $bots->pid?><!--</a></li>-->
<!--                                        <li>Дата запуска: <span class="font-weight-semibold">--><?//= $bots->created_at?><!--</span></li>-->
<!--                                    </ul>-->
<!--                                --><?php //endif; ?>
                            </div>

                            <div class="text-sm-right mb-0 mt-3 mt-sm-0 ml-auto">
                                <ul class="list list-unstyled mb-0">
                                    <li>
                                        <a
                                            href="<?= Url::to(['default/statusbot', 'status' => 1])?>"
                                            id="bot-start"
                                            class="bot-status btn btn-outline-success btn-sm <?php if($bots->status == 1) echo 'disabled'; ?>">
                                            Запуск
                                        </a>
                                        <a
                                            href="<?= Url::to(['default/statusbot', 'status' => 2])?>"
                                            id="bot-restart"
                                            class="bot-status btn btn-outline-info btn-sm <?php if($bots->status == 0) echo 'disabled'; ?>">
                                            Перезагрзка
                                        </a >
                                        <a
                                            href="<?= Url::to(['default/statusbot', 'status' => 0])?>"
                                            id="bot-stop"
                                            class="bot-status btn btn-outline-danger btn-sm <?php if($bots->status == 0) echo 'disabled'; ?>">
                                            Остановить
                                        </a>
                                    </li>
                                    <li class="mt-3">
                                        Статус: &nbsp;
                                        <?php if($bots->status == 1) : ?>
                                            <a class="badge bg-success-400 align-top">Запушен</a>
                                        <?php else: ?>
                                            <a class="badge bg-danger-400 align-top">Остановлен</a>
                                        <?php endif ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- rounded-left-0 -->
            </div>
            <!-- end run bot -->

        </div>
    </div>
</div>

<?php
$js = <<<JS
$(function() {
    $('.bot-status').on('click', function(e) {
        e.preventDefault();
        var mUrl = $(this).attr('href')
        $.get({
            url: mUrl,
            data: {insta_id: "{$model->id}"},
            beforeSend: function() {
              console.log('start')
            },
            success: function(data) {
                if(data === true) {
                    window.location.reload();
                }
              console.log(data)
            },
            error: function(msg, status) {
                console.log(msg, status);
                alert(msg.responseJSON.message)
            }
        })
    }) 
})

JS;
$this->registerJs($js);
?>
