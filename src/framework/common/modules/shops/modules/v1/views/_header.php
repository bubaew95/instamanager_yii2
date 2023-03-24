<?php
use yii\helpers\Url;

$action = Yii::$app->controller->id;
?>

<div class="navbar navbar-expand-lg bg-white">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-second">
            <i class="icon-menu7 mr-2"></i>
            Profile navigation
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-second">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="<?= Url::to(['/shops'])?>" class="navbar-nav-link <?= $action == 'default' ? 'active' : null?>">
                    <i class="icon-menu7 mr-2"></i>
                    Общее
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= Url::to(['/shops/products'])?>" class="navbar-nav-link  <?= $action == 'products' ? 'active' : null?>">
                    <i class="icon-calendar3 mr-2"></i>
                    Товар
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= Url::to(['/shops/orders'])?>" class="navbar-nav-link  <?= $action == 'orders' ? 'active' : null?>">
                    <i class="icon-cog3 mr-2"></i>
                    Заказы
                    <span class="badge badge-pill bg-danger position-static ml-auto ml-lg-2">12</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear"></i>
                    <span class="ml-2">Настройки</span>
                </a>

                <div class="dropdown-menu" style="left: inherit;">
                    <a href="<?= Url::to(['/shops/menu'])?>" class="dropdown-item"><i class="icon-image2"></i> Меню</a>
                    <a href="#" class="dropdown-item"><i class="icon-clippy"></i> Настройки шаблона</a>
                    <a href="#" class="dropdown-item"><i class="icon-make-group"></i> Слайдер</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="icon-three-bars"></i> Activity log</a>
                    <a href="<?= Url::to(['/shops/settings'])?>" class="dropdown-item"><i class="icon-cog5"></i> Настройки магазина</a>
                </div>
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
        </ul>
    </div>
</div>