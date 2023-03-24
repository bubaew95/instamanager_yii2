<?php

/* @var $this \yii\web\View */
/* @var $content string */
//Body class for login form bg-slate-800

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <base href="<?=Url::base();?>">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?php if(isset($_COOKIE['menu_small']) && $_COOKIE['menu_small'] == true) echo 'sidebar-xs'?>">
<?php $this->beginBody() ?>

<?
if (Yii::$app->controller->action->id === 'login'):
    /**
     * Do not use this code in your template. Remove it.
     * Instead, use the code  $this->layout = '//main-user'; in your controller.
     */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
else:
?>
    <?=$this->render('_navbar');?>

    <!-- Page content -->
    <div class="page-content">

        <?=$this->render('_sidebar');?>

        <!-- Main content -->
        <div class="content-wrapper">

            <?=$this->render('_page_header');?>

            <!-- Content area -->
            <div class="content">

                <?= \common\widgets\Alert::widget()?>

                <?=$content;?>
            </div>
            <!-- /content area -->

            <!-- Footer -->
            <div class="navbar navbar-expand-lg navbar-light">
                <div class="text-center d-lg-none w-100">
                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                        <i class="icon-unfold mr-2"></i>
                        Footer
                    </button>
                </div>

                <div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; 2017 - <?= date('Y')?>. <a>Разработчик сайта</a> by <a href="" target="_blank">Dzhokhar</a>
					</span>
                </div>
            </div>
            <!-- /footer -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

<?php
Modal::begin([
    'id' => 'modal',
    'header' => null,
    'footer' => null,
]);
Modal::end();
?>

<? endif; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
