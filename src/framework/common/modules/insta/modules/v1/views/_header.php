<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
//$page = Yii::$app->request->get('tab', 'general');
//
$action = Yii::$app->controller->id;
?>

<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-second">
            <i class="icon-menu7 mr-2"></i>
            Profile navigation
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-second">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="<?= Url::to(['/insta'])?>" class="navbar-nav-link <?= $action == 'default' ? 'active' : null?>">
                    <i class="icon-home mr-2"></i>
                    Главная
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= Url::to(['/insta/media'])?>" class="navbar-nav-link  <?= $action == 'media' ? 'active' : null?>">
                    <i class="icon-image4 mr-2"></i>
                    Медиа
                    <span class="badge badge-pill bg-success position-static ml-auto ml-lg-2"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= Url::to(['/insta/direct'])?>" class="navbar-nav-link  <?= $action == 'direct' ? 'active' : null?>">
                    <i class="icon-comment-discussion mr-2"></i>
                    Директ
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    <i class="icon-stack-text mr-2"></i>
                    Notes
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    <i class="icon-collaboration mr-2"></i>
                    Friends
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="navbar-nav-link">
                    <i class="icon-images3 mr-2"></i>
                    Photos
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear"></i>
                    <span class="d-lg-none ml-2">Settings</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="#" class="dropdown-item"><i class="icon-image2"></i> Update cover</a>
                    <a href="#" class="dropdown-item"><i class="icon-clippy"></i> Update info</a>
                    <a href="#" class="dropdown-item"><i class="icon-make-group"></i> Manage sections</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-three-bars"></i> Activity log</a>
                    <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Profile settings</a>
                </div>
            </li>
        </ul>
    </div>
</div>
