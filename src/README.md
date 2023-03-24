http://diamantgjota.com/themes/plus-v1.3.0/shop-sidebar-left.html
http://demo.devitems.com/boighor-v3/index.html

Миграция настроек
----
```
yii migrate/up --migrationPath=@vendor/pheme/yii2-settings/migrations
```

Виджет вывода книг
---
```php
use frontend\components\itemsview\ItemsViewWidget

ItemsViewWidget::widget([
    'template' => '_list|_grid',
    'model' => $model
]) 
```

Виджет страниц 
---
```php
use frontend\components\pages\PagesWidget;

PagesWidget::widget([
    'position' => 'top|bottom'
])
```


Нижнее меню
---
```html
<li>
    <a href="shop.html">
        <span>
            <img src="https://d29u17ylf1ylz9.cloudfront.net/bege-v2/images/icons/27.png" alt="menu-icon">
        </span>
        Sanyo
        <i class="fa fa-angle-right" aria-hidden="true"></i>
    </a>
    <!-- categori Mega-Menu Start -->
    <ul class="ht-dropdown megamenu first-megamenu">
        <!-- Single Column Start -->
        <li class="single-megamenu">
            <ul>
                <li class="menu-tile">Cameras</li>
                <li><a href="shop.html">Cords and Cables</a></li>
                <li><a href="shop.html">gps accessories</a></li>
                <li><a href="shop.html">Microphones</a></li>
                <li><a href="shop.html">Wireless Transmitters</a></li>
            </ul>
        </li>
        <!-- Single Column End -->
    </ul>
    <!-- categori Mega-Menu End -->
</li>
```

Верхнее меню
-----
```HTML
<li class="current">
    <a href="/">Home <i class="fa fa-angle-down"></i></a>
    <ul class="submenu">
        <li><a href="index.html">Home Shop 1</a></li>
        <li><a href="index-2.html">Home Shop 2</a></li>
        <li><a href="index-3.html">Home Shop 3</a></li>
        <li><a href="index-4.html">Home Shop 4</a></li>
    </ul>
</li>
```

Левый слайдбар
----
```Html
<aside class="wedget__categories pro--range">
    <h3 class="wedget__title">Filter by price</h3>
    <div class="content-shopby">
        <div class="price_filter s-filter clear">
            <form action="#" method="GET">
                <div id="slider-range"></div>
                <div class="slider__range--output">
                    <div class="price__output--wrap">
                        <div class="price--output">
                            <span>Price :</span><input type="text" id="amount" readonly="">
                        </div>
                        <div class="price--filter">
                            <a href="#">Filter</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</aside>
<aside class="wedget__categories poroduct--tag">
    <h3 class="wedget__title">Product Tags</h3>
    <ul>
        <li><a href="#">Biography</a></li>
        <li><a href="#">Business</a></li>
        <li><a href="#">Cookbooks</a></li>
        <li><a href="#">Health & Fitness</a></li>
        <li><a href="#">History</a></li>
        <li><a href="#">Mystery</a></li>
        <li><a href="#">Inspiration</a></li>
        <li><a href="#">Religion</a></li>
        <li><a href="#">Fiction</a></li>
        <li><a href="#">Fantasy</a></li>
        <li><a href="#">Music</a></li>
        <li><a href="#">Toys</a></li>
        <li><a href="#">Hoodies</a></li>
    </ul>
</aside>
<aside class="wedget__categories sidebar--banner">
    <img src="/images/others/banner_left.jpg" alt="banner images">
    <div class="text">
        <h2>new products</h2>
        <h6>save up to <br> <strong>40%</strong>off</h6>
    </div>
</aside>
```

Слайдер книг
---
```php
<?php foreach ($raitings as $item) : ?>
<!-- Start Single Product -->
<div class="product product__style--3">
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="product__thumb">
            <figure class='book'>
                <!-- Front -->
                <ul class='hardcover_front'>
                    <li>
                        <img src="<?= Constants::HOST . $item->img?>" alt="" width="100%" height="100%">
                    </li>
                    <li></li>
                </ul>
                <!-- Pages -->
                <ul class='page'>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <!-- Back -->
                <ul class='hardcover_back'>
                    <li></li>
                    <li></li>
                </ul>
                <ul class='book_spine'>
                    <li></li>
                    <li></li>
                </ul>
            </figure>  
        </div>
        <div class="product__content content--center">
            <h5><a href="#"><?= $item->name?></a></h5>
            <div class="action">
                <div class="actions_inner">
                    <ul class="add_to_links">
                        <li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
                        <li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
                        <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
                        <li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Single Product -->
<?php endforeach ?>
```
