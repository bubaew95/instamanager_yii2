<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 21.01.2019
 * Time: 21:48
 */
use yii\widgets\Menu;
use yii\helpers\Url;

$get = Yii::$app->request->get();
?>


<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        <span class="font-weight-semibold">Navigation</span>
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user-material">
            <!-- div class="sidebar-user-material-body">
                <div class="card-body text-center">
                    <a href="#">
                        <img src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/users/face17.jpg" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                    </a>
                    <h6 class="mb-0 text-white text-shadow-dark"><?=Yii::$app->user->identity->email?></h6>
                    <span class="font-size-sm text-white text-shadow-dark">Santa Ana, CA</span>
                </div>

                <div class="sidebar-user-material-footer">
                    <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>Мой аккаунт</span></a>
                </div>
            </div-->
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/500px-Instagram_icon.png" width="38" height="38" class="rounded-circle" alt=""></a>
                        </div>

                        <div class="media-body">
                            <div class="media-title font-weight-semibold"><?=Yii::$app->user->identity->email?></div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                            </div>
                        </div>

                        <div class="ml-3 align-self-center sidebar-user-material-footer">
                            <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><i class="icon-cog3"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collapse" id="user-nav">
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-user-plus"></i>
                            <span>My profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-coins"></i>
                            <span>My balance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-comment-discussion"></i>
                            <span>Messages</span>
                            <span class="badge bg-teal-400 badge-pill align-self-center ml-auto">58</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-cog5"></i>
                            <span>Account settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="icon-switch2"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">

            <?php

            $menus['main'] = [
                'label' => 'Основные',
                'url' => '',
                'options'=>['class'=>'nav-item-header'],
                'template' => '<div class="text-uppercase font-size-xs line-height-xs">{label}</div> <i class="icon-menu" title="Main"></i>',
            ];
            $menus['home'] = [
                'label' => 'Главная',
                'url' => Url::to(['/site/index']),
                'options'=>['class'=>'nav-item'],
                'template' => '<a href="{url}" class="nav-link"><i class="icon-home4"></i><span>{label}</span></a>',
            ];

            $menus['modules'] = [
                'label' => 'Модули',
                'url' => Url::to(['/modules/index']),
                'options'=>['class'=>'nav-item'],
                'template' => '<a href="{url}" class="nav-link"><i class="icon-stack3"></i><span>{label}</span></a>',
            ];

            if(!empty($get['project_id'])):
                $menus['catalog'] = [
                    'label' => 'Каталог интеграции',
                    'url' => Url::to(['catalog/index']),
                    'options'=>['class'=>'nav-item'],
                    'template' => '<a href="{url}" class="nav-link"><i class="icon-puzzle3"></i><span>{label}</span></a>',
                ];
            endif;

            echo Menu::widget([
                'items' => $menus,
                'options' => [
                    'id'=>'navid',
                    'class' => 'nav nav-sidebar',
                    'data-nav-type'=>'accordion',
                ]
            ]);
            ?>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
