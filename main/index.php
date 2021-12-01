<?php
session_start();
require_once "../db/connect.php";

$sql_categories = "select * from categories";
$query_categories = $pdo -> prepare($sql_categories);
$query_categories -> execute();
$categories = $query_categories -> fetchAll();

$purchases_products_sql = "select * from products inner join purchases on products.product_id = purchases.product_id inner join discounts 
    on products.discount_id = discounts.discount_id";
$purchases_products_query = $pdo -> prepare($purchases_products_sql);
$purchases_products_query -> execute();
$purchases_products = $purchases_products_query -> fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>
<header class="header">
    <div class="header__wrapper">
        <div class="header__container container">
            <div class="header__body">
                <div class="header__main">
                    <a class="logo" href="index.php">
                        <img src="img/logo.png" alt="">
                        <img src="img/logo-text.png" alt="logo">
                    </a>
                    <div class="header__menu menu">
                        <nav class="menu__body">
                            <ul class="menu__list">
                                <li class="menu__item"><a class="menu__link" href="#">Покупателям</a></li>
                                <li class="menu__item"><a class="menu__link" href="../catalog/index.php">Каталог</a></li>
                                <li class="menu__item"><a class="menu__link" href="#">О компании</a></li>
                                <li class="menu__item"><a class="menu__link" href="../account/index.php">Личный кабинет</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header__search">
                    <div class="search-form">
                        <form action="#" class="search-form__item">
                            <a class="search-form__btn icon-search"></a>
                            <input autocomplete="off" type="text" name="forma" class="search-from__input">
                            <div class="search-window">
        <div class="search-window__content">
        </div>
    </div>
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
        <section class="banner search-bot">
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
            <h2> Отзывы наших клиентов</h2>
        </div>
    </div>
    <div class="gallery__container">
        <div data-speed="0.03" class="gallery__body">
            <div class="gallery__items">
                <div class="gallery__column _anim-item">
                    <div class="gallery__row row-gallery row-gallery__left-top">
                        <a href="" class="row-gallery__item" style="background: #e1f6f9; width: 500px; min-height: 300px">
                            <!-- <img style="height: 300px; width: 500px;" src="img/gallery-1.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/1.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Макаров Амадей</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="" class="row-gallery__item" style="background:#edf5d6; width: 500px; min-height: 340px">
                            <!-- <img style="width: 500px; height: 340px;" src="img/gallery-2.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/2.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Львова Ольга</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="gallery__row row-gallery row-gallery__left-bottom">
                        <a href="" class="row-gallery__item" style="background: #fef6eb; width: 375px; min-height: 300px">
                            <!-- <img style="height: 301px; width: 375px;" src="img/gallery-3.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/3.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Войтов Ювеналий</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="" class="row-gallery__item" style="background: #faecfa; width: 450px; min-height: 245px">
                            <!-- <img style="width: 450px; height: 245px;" src="img/gallery-4.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/4.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Андреев Владлен</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="gallery__column _anim-item">
                    <div class="gallery__row row-gallery row-gallery__center">
                        <a href="" class="row-gallery__item" style="background: #ffe8db; width: 550px;">
                            <!-- <img style="width: 550px;" src="img/gallery-5.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/5.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Круглов Евграф</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="gallery__column _anim-item">
                    <div class="gallery__row row-gallery row-gallery__right-top">
                        <a href="" class="row-gallery__item" style="background: #dfebfd; width: 375px; min-height: 300px">
                            <!-- <img style="width: 500px;" src="img/gallery-6.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/6.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Любимов Трофим</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="../" class="row-gallery__item" style="background: #dcf8ec; width: 500px; min-height: 300px">
                            <!-- <img style="height: 300px; width: 500px;" src="img/gallery-7.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/7.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Шахуро Михаил</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="gallery__row row-gallery row-gallery__right-bottom">
                        <a href="" class="row-gallery__item" style="background: #faecfa; width: 450px;">
                            <!-- <img style="width: 450px;" src="img/gallery-8.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/8.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Богатырева Амина</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
                        </a>
                        <a href="" class="row-gallery__item" style="background: #fce2e2;">
                            <!-- <img src="img/gallery-9.jpg" alt=""> -->
                            <div class="responce">
                                <div class="responce__photo" style="background: center/cover url(img/responces/9.jpg) no-repeat;">
                                </div>
                                <div class="responce__name">
                                    <h3>Алексеева Федосья</h3>
                                </div>
                                <div class="responce__text">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure 
                                        dolor in reprehenderit in voluptate velit esse cillum dolore. 
                                    </p>
                                </div>
                            </div>
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
<section class="products">
    <div class="products__container container">
        <div class="products__title title">
            <h2>Часто покупаемые товары</h2>
        </div>
            <div class="products__items">
            <?php
                foreach ($purchases_products as $key) {
                    echo '
                    <article name="zxc" data-id='. $key['product_id'] .' class="content-page__item item-product">
                        <div class="item-product__labels">
                            <div class="item-product__label item-product__label_sale">-'. $key['discount_value'] .'%</div>
                            <div class="item-product__label item-product__label_cart _icon-cart"></div>
                        </div>
                        <a href="" class="item-product__image">
                            <img class="catalog-img" src="'.$key['product_path'].'" alt="">
                        </a>
                        <div class="item-product__body">
                            <div class="item-product__content">
                            <a href="../product/index.php?id='. $key['product_id'] .'&category='. $key['category_id'] .'"><h5 class="item-product__title">'. $key['product_name'] .'</h5></a>
                            </div>
                            <div class="item-product__prices">
                                <div class="item-product__price">'. round($key['product_price']-$key['product_price'] * $key['discount_value']/100,1) .'руб./кг</div>
                                <div class="item-product__price item-product__price_old">'. $key['product_price'] .'руб./кг</div>
                            </div>
                            <div class="item-product__actions actions-product">
                                <div class="actions-product__body">
                                    <a class="btn  actions-product__btn">Добавить</a>
                                </div>
                            </div>
                        </div>
                    </article>';
                }
            ?>
            </div>
        </div>
    </div>
</section>
<section class="page search-bot">
    <div class="page__container container">
        <div class="page__wrapper">
            <div class="page__body body-page">
                <div class="body-page__content content-page">
                    <div class="body-page__title title">
                        <h2>Категории товаров</h2>
                    </div>
                    <div class="content-page__list list-page">
                        <?php 
                        foreach ($categories as $key) {
                            echo '
                                <div class="list-page__item item-page" style="background: right/contain url('. $key['category_img'] .') no-repeat">
                                    <a href="../catalog/index.php?category_id='. $key['category_id'] .'" class="item-page__link">
                                        <div class="item-page__wrapper">
                                            <div class="item-page__content">'. $key['category_name'] .'</div>
                                        </div>
                                    </a>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
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
    <script src="js/search.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

</body>

</html>