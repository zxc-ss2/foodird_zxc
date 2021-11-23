<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.min.css">
    <title>Document</title>
</head>

<body>
<header class="header">
    <div class="header__wrapper">
        <div class="header__container container">
            <div class="header__body">
                <div class="header__main">
                    <a class="logo" href="#">
                        <img src="img/logo.png" alt="">
                        <img src="img/logo-text.png" alt="logo">
                    </a>
                    <div class="header__menu menu">
                        <nav class="menu__body">
                            <ul class="menu__list">
                                <li class="menu__item"><a class="menu__link" href="#">Покупателям</a></li>
                                <li class="menu__item"><a class="menu__link" href="#">Акции</a></li>
                                <li class="menu__item"><a class="menu__link" href="#">Каталог</a></li>
                                <li class="menu__item"><a class="menu__link" href="#">О компании</a></li>
                                <li class="menu__item"><a class="menu__link" href="#">Контакты</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header__search">
                    <div class="search-form">
                        <form action="#" class="search-form__item">
                            <a class="search-form__btn icon-search"></a>
                            <input autocomplete="off" type="text" name="forma" class="search-from__input">
                        </form>
                    </div>
                </div>
                <div class="header-actions actions-header">
                    <a href="#" class="actions-header__item actions-header__item_search _icon-search"></a>
                    <?php
                    if(isset($_SESSION['login'])){
                        echo '<a href="../controllers/logout.php" class="actions-header__item actions-header__item_favorites _icon-logout"></a>';
                    }
                    else{
                        echo '<a href="../reglog/log.php" class="actions-header__item actions-header__item_favorites _icon-user"></a>';
                    }
                    ?>
                    <div class="actions-header__item cart-header">
                        <a href="../cart/index.php" class="cart-header__icon _icon-cart"></a>
                        <div class="cart-header__body">
                            <ul class="cart-header__list cart-list"></ul>
                        </div>
                    </div>
                </div>
                <a class="icon-menu">
                    <div class="menu3">
                        <a href="#" id="menu-trigger" class=" menu__btn">
                            <span class="menu__burger"></span>
                            <span class=menu__exit></span>
                        </a>
                    </div>
                </a>
            </div>
        </div>
    </div>
</header>
    <main>
        <section class="banner">
    <div class="banner__wrapper">
        <div class="banner__container">
            <div class="banner__body">
                <div class="slider">
                    <div class="slider__item">
                        <div class="wrapper wrapper1">
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="wrapper wrapper2">
                            <div class="wrapper__text container">
                                <h2>10% пенсионерам на весь ассортимент</h2>
                                <h4>Во всех магазинах сети!</h4>
                            </div>
                        </div>
                    </div>
                    <div class="slider__item">
                        <div class="wrapper3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        <section class="gallery">
    <div class="container">
        <div class="body-women__title title">
            <h2>Категории товаров</h2>
        </div>
        <div class="body-women__subtitle subtitle">
            <h3>Выберите интересующую категорию</h3>
        </div>
    </div>
    <div class="gallery__container">
        <div data-speed="0.03" class="gallery__body">
            <div class="gallery__items">
                <div class="gallery__column _anim-item">
                    <div class="gallery__row row-gallery row-gallery__left-top">
                        <a href="" class="row-gallery__item ">
                            <img style="height: 300px; width: 500px;" src="img/gallery-1.jpg" alt="">
                        </a>
                        <a href="" class="row-gallery__item">
                            <img style="width: 500px; height: 340px;" src="img/gallery-2.jpg" alt="">
                        </a>
                    </div>
                    <div class="gallery__row row-gallery row-gallery__left-bottom">
                        <a href="" class="row-gallery__item">
                            <img style="height: 301px; width: 375px;" src="img/gallery-3.jpg" alt="">
                        </a>
                        <a href="" class="row-gallery__item">
                            <img style="width: 450px; height: 245px;" src="img/gallery-4.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="gallery__column _anim-item">
                    <div class="gallery__row row-gallery row-gallery__center">
                        <a href="" class="row-gallery__item">
                            <img style="width: 550px;" src="img/gallery-5.jpg" alt="">
                        </a>
                    </div>
                </div>
                <div class="gallery__column _anim-item">
                    <div class="gallery__row row-gallery row-gallery__right-top">
                        <a href="" class="row-gallery__item">
                            <img style="width: 500px;" src="img/gallery-6.jpg" alt="">
                        </a>
                        <a href="" class="row-gallery__item">
                            <img style="height: 300px; width: 500px;" src="img/gallery-7.jpg" alt="">
                        </a>
                    </div>
                    <div class="gallery__row row-gallery row-gallery__right-bottom">
                        <a href="" class="row-gallery__item">
                            <img style="width: 450px;" src="img/gallery-8.jpg" alt="">
                        </a>
                        <a href="" class="row-gallery__item">
                            <img src="img/gallery-9.jpg" alt="">
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="gallery__mobile">

        <div class="gallery__items-m">
            <div class="gallery__item-m">
                <img src="img/gallery-1.jpg" alt="">
            </div>
            <div class="gallery__item-m">
                <img src="img/gallery-2.jpg" alt="">
            </div>
            <div class="gallery__item-m">
                <img src="img/gallery-3.jpg" alt="">
            </div>
            <div class="gallery__item-m">
                <img src="img/gallery-4.jpg" alt="">
            </div>
            <div class="gallery__item-m">
                <img src="img/gallery-5.jpg" alt="">
            </div>
            <div class="gallery__item-m">
                <img src="img/gallery-6.jpg" alt="">
            </div>
        </div>
    </div>
</section>
        <section class="advantages">
    <div class="container">
        <div class="advantages__title title">
            <h2>Наши преимущества</h2>
    </div>
    <div class="advantages__container">
        <div class="slide">
            <h3 class="slide__icon _icon-grow"></h3>
            <h5 class="slide__title">Гарантия свежести продуктов</h5>
            <p class="slide__text">Выбираем фреш не позднее половины срока годности. Привезли позже - дадим бонус</p>
        </div>
        <div class="slide">
            <h3 class="slide__icon _icon-delivery"></h3>
            <h5 class="slide__title">Бесплатная доставка за 2 часа</h5>
            <p class="slide__text">Продукты уже через два часа у тебя дома, привезем заказ совершенно бесплатно!</p>
        </div>
        <div class="slide">
            <h3 class="slide__icon _icon-snowflake"></h3>
            <h5 class="slide__title">Перевозка в термобоксах</h5>
            <p class="slide__text">Мороженое не растает (мясо не потечет) доставляем в автохолодильниках (термоконтейнерах)</p>
        </div>
        <div class="slide">
            <h3 class="slide__icon _ _icon-apple"></h3>
            <h5 class="slide__title">Лучшие фрукты/овощи</h5>
            <p class="slide__text">Не понравился наш выбор, не плати, отдай курьеру!</p>
        </div>
    </div>
    </div>
</section>
        <section class="products">
    <div class="products__container container">
        <div class="products__title title">
            <h2>Популярные товары за неделю</h2>
        </div>
            <div class="products__items">
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/banana.jpg" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Банан Эквадор вес</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">91 руб./кг</div>
                            <div class="item-product__price item-product__price_old">108 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/tomato.png" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Томаты вес</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">239 руб./кг</div>
                            <div class="item-product__price item-product__price_old">260 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/cabbage.png" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Капуста белокочанная 1,5-3кг</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">46 руб./кг</div>
                            <div class="item-product__price item-product__price_old">59 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/carrot.png" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Морковь мытая 1кг</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">63 руб./кг</div>
                            <div class="item-product__price item-product__price_old">72 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/banana.jpg" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Банан Эквадор вес</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">91 руб./кг</div>
                            <div class="item-product__price item-product__price_old">108 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/tomato.png" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Томаты вес</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">239 руб./кг</div>
                            <div class="item-product__price item-product__price_old">260 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/cabbage.png" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Капуста белокочанная 1,5-3кг</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">46 руб./кг</div>
                            <div class="item-product__price item-product__price_old">59 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
                <article class="products__item item-product">
                    <div class="item-product__labels">
                        <div class="item-product__label item-product__label_sale">-40%</div>
                    </div>
                    <a href="" class="item-product__image">
                        <img src="img/carrot.png" alt="">
                    </a>
                    <div class="item-product__body">
                        <div class="item-product__content">
                            <h5 class="item-product__title">Морковь мытая 1кг</h5>
                        </div>
                        <div class="item-product__prices">
                            <div class="item-product__price">63 руб./кг</div>
                            <div class="item-product__price item-product__price_old">72 руб./кг</div>
                        </div>
                        <div class="item-product__actions actions-product">
                            <div class="actions-product__body">
                                <a href="" class="btn  actions-product__btn">Добавить в корзину</a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
    </main>
    <footer class="footer">
    <div class="footer__wrapper">
        <div class="footer__container container">
            <div class="footer__body body-footer">
                <div class="body-footer__left left-content">
                    <div class="left-content__logo">
                        <img src="img/logo-text.png" alt="logo">
                    </div>
                    <div class="left-content__description">
                        <p>
                            Мы в социльаных сетях
                        </p>
                    </div>
                    <div class="left-content__links">
                        <a href="#" class="_icon-twitter"></a>
                        <a href="#" class="_icon-insta"></a>
                        <a href="#" class="_icon-facebook"></a>
                        <a href="#" class="_icon-vk"></a>
                    </div>
                </div>
                <div class="body-footer__right right-content">
                    <div class="right-content__title title">
                        <h3>Подписаться на рассылку</h2>
                    </div>
                    <div class="right-content__form join-form">
                        <input type="text" placeholder="Ваш Email" class="join-form__input">
                        <a href="#">></a>
                    </div>
                    <div class="right-content__menu footer-menu">
                        <div class="footer-menu__body">
                            <h5>Каталог</h5>
                            <div class="footer-menu__shop">
                                <ul class="shop-menu">
                                    <li class="shop-menu__item"><a href="">Фрукты, Овощи</a></li>
                                    <li class="shop-menu__item"><a href="">Мясо, птица</a></li>
                                    <li class="shop-menu__item"><a href="">Молоко, сыр</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu__body">
                            <h5>Контакты</h5>
                            <div class="footer-menu__help">
                                <ul class="help-menu">
                                    <li class="help-menu__item"><a href="">Магазины</a></li>
                                    <li class="help-menu__item"><a href="">Правовая информация</a></li>
                                    <li class="help-menu__item"><a href="">Реквизиты</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu__body">
                            <h5>О компании</h5>
                            <div class="footer-menu__about">
                                <ul class="about-menu">
                                    <li class="about-menu__item"><a href="">Вакансии</a></li>
                                    <li class="about-menu__item"><a href="">История</a></li>
                                    <li class="about-menu__item"><a href="">Арендаторам</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        <p>©2021. Официальный сайт сети "foodird"</p>
    </div>
</footer>
    <script src="js/script.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

</body>

</html>