<?php
session_start();
require_once "../db/connect.php";

if(!isset($_GET['page'])){
    $pages=1;
}
else{
    $pages=$_GET['page'];
}

$sql_id = "select product_id from cart where email = :email";
$query_id = $pdo -> prepare($sql_id);
$query_id -> execute([
    'email' => $_SESSION['login']
]);
$id = $query_id ->fetchAll(PDO::FETCH_ASSOC);

$cart_products = array();

foreach ($id as $key) {
    $sql_cart_products = "select product_id, product_name, product_path, product_price, category_id, discount_value from products inner
    join discounts on products.discount_id = discounts.discount_id where product_id = :product";
    $query_cart_products = $pdo -> prepare($sql_cart_products);
    $query_cart_products -> execute([
        'product' => $key['product_id']
    ]);
    $cart_products[] = $query_cart_products -> fetchAll();
}

$cart_categories_sql = "select category_id from products inner join cart on products.product_id = cart.product_id where products.product_id = cart.product_id  and cart.email = :login group by(category_id)";
$cart_categories_query = $pdo -> prepare($cart_categories_sql);
$cart_categories_query -> execute([
    'login' => $_SESSION['login']
]);
$cart_categories = $cart_categories_query -> fetchAll();

$similar_slider_products = array();
foreach ($cart_categories as $key) {
    $similar_slider_products_sql = "select products.product_id, product_name, product_price, product_path, products.discount_id, discount_value, category_id from products left outer join
    cart on products.product_id = cart.product_id inner join discounts on products.discount_id = discounts.discount_id where category_id = :id and cart.cart_id is null order by rand()";
    $similar_cart_products_query = $pdo -> prepare($similar_slider_products_sql);
    $similar_cart_products_query -> execute([
        'id' => $key['category_id']
    ]);
    $similar_slider_products[] = $similar_cart_products_query -> fetchAll();
}

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
                    <a class="logo" href="../main/index.php">
                        <img src="img/logo.png" alt="">
                        <img src="img/logo-text.png" alt="logo">
                    </a>
                    <div class="header__menu menu">
                        <nav class="menu__body">
                            <ul class="menu__list">
                                <li class="menu__item"><a class="menu__link" href="404/404.htm">Покупателям</a></li>
                                <li class="menu__item"><a class="menu__link" href="../catalog/index.php">Каталог</a></li>
                                <li class="menu__item"><a class="menu__link" href="404/404.htm">О компании</a></li>
                                <?php 
                                if($_SESSION['role'] == 1){
                                    echo '<li class="menu__item"><a class="menu__link" href="../admin/index.php">Админ</a></li>';
                                }
                                ?>
                                <?php 
                                    if(isset($_SESSION['login'])){
                                        echo '<li class="menu__item"><a class="menu__link" href="../account/index.php">Личный кабинет</a></li>';
                                    }
                                    else{
                                        echo '<li class="menu__item"><a class="menu__link" href="../reglog/log.php">Личный кабинет</a></li>';
                                    }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header__search">
                    <div class="search-form">
                        <form action="#" class="search-form__item">
                            <a class="search-form__btn _icon-search"></a>
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
    <main style="position: relative">
    <div class="layer"></div>
        <section class="cart search-bot">
    <div class="cart__container container">
        <div class="cart__wrapper">
            <div class="cart__title title">
                <h1>Корзина</h1>
            </div>
            
            <div class="cart__body">
                <div class="cart__content">
                    <?php
                    if(empty($cart_products)){
                        echo '
                        <div class="cart-empty">
                            <div class="cart-empty__image">
                                <img src="img/cart.svg" alt="">
                            </div>
                            <div class="cart-empty__text">
                                <h4>В корзине пока нет товаров</h4>
                                <a class="btn" href="../catalog/index.php">Начать покупки</a>
                            </div>
                        </div>
                        ';
                    }
                    else{
                        if(isset($_SESSION['login'])){
                            foreach ($cart_products as $key) {
    
                                echo '<div data-id="'. $key[0]['product_id'] .'" data-category="'. $key[0]['category_id'] .'" class="cart__item item-cart">
                            <div class="item-cart__preview">
                                <a href="../product/index.php?id='. $key[0]['product_id'] .'&category='. $key[0]['category_id'] .'">
                                    <img src="'. $key[0]['product_path'] .'" alt="">
                                </a>
                            </div>
                            <div class="item-cart__name">'. $key[0]['product_name'].'</div>
                            <div class="item-cart__count count-cart">
                                <div class="count-cart__minus"><a class="minus">-</a></div>
                                <div class="count-cart__quantity"><span>1</span> шт</div>
                                <div class="count-cart__plus"><a class="plus" >+</a></div>
                            </div>
                            <div class="item-cart__price" data-price='. $key[0]['product_price'] .'><span>'. $key[0]['product_price'] .'</span>руб</div>
                            <a href="#" class="item-cart__delete" data-id="'. $key[0]['product_id'] .'" style="color: #000">&#10006;</a>
                        </div>';
                            }
                        }
                        else{
                            echo '<div class="cart__item item-cart">Войдите в аккаунт или зарегистрируйтесь, чтобы пользоваться корзиной</div>';
                        }
                    }

                    ?>
                </div>
                <div class="cart__finish finish-cart">
                    <div class="return">
                        <div class="return__delete">Удаление через</div>
                        <div class="return__time"></div>
                        <div class="return__text"></div>
                    </div>
                    <div class="finish-cart__type">Самовывоз</div>
                    <div class="finish-cart__address">Звездный, Опалихинская</div>
                    <div class="finish-cart__count"><?php echo count($cart_products) ?> товар(ов)</div>
                    <div class="finish-cart__pay pay-cart">
                        <div class="pay-cart__title">К оплате</div>
                        <div class="pay-cart__price">0 Р</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="advices">
    <div class="advices__container container">
        <div class="women__body body-women">
            <div class="body-women__title title">
                <h2>Вам может быть интересно</h2>
            </div>
            <div class="body-women__wrapper">
                <div class="aslider">
                    <?php
                            foreach ($similar_slider_products as $product => $zxc) {
                                foreach ($zxc as $product2 => $qwe) {

                                    echo '
                                    <div class="slider__item qwe">
                                        <article class="products__item item-product" data-id="'. $zxc[$product2]["product_id"] .'">
                                            <div class="item-product__labels">
                                                <div class="item-product__label item-product__label_sale">-'. $zxc[$product2]["discount_value"] .'%</div>
                                            </div>
                                            <a href="href="../product/index.php?id='. $zxc[$product2]["product_id"] .'&category='. $zxc[$product2]["category_id"] .'"" class="item-product__image">
                                                <img class="catalog-img" src="'. $zxc[$product2]["product_path"] .'" alt="">
                                            </a>
                                            <div class="item-product__body">
                                                <div class="item-product__content">
                                                    <a href="../product/index.php?id='. $zxc[$product2]["product_id"] .'&category='. $zxc[$product2]["category_id"] .'" class="item-product__title">'. $zxc[$product2]["product_name"] .'</a>
                                                </div>
                                                <div class="item-product__prices">
                                                    <div class="item-product__price">'. round($zxc[$product2]["product_price"] - $zxc[$product2]["product_price"] * $zxc[$product2]["discount_value"]/100,1) .'руб.</div>
                                                    <div class="item-product__price item-product__price_old">'. $zxc[$product2]["product_price"] .'руб.</div>
                                                </div>
                                                <div class="item-product__actions actions-product">
                                                    <div class="actions-product__body">
                                                        <a class="btn  actions-product__btn">В корзину</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>';
                                }
                            }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>
    </main>
<footer class="footer" style="position: relative">
<div class="layer"></div>
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
                        <a href="404/404.htm" class="_icon-twitter"></a>
                        <a href="404/404.htm" class="_icon-insta"></a>
                        <a href="404/404.htm" class="_icon-facebook"></a>
                        <a href="404/404.htm" class="_icon-vk"></a>
                    </div>
                </div>
                <div class="body-footer__right right-content">
                    <div class="right-content__title title">
                        <h3>Подписаться на рассылку</h2>
                    </div>
                    <div class="right-content__form join-form">
                        <input type="text" placeholder="Ваш Email" class="join-form__input">
                        <a href="404/404.htm">></a>
                    </div>
                    <div class="right-content__menu footer-menu">
                        <div class="footer-menu__body">
                            <h5>Каталог</h5>
                            <div class="footer-menu__shop">
                                <ul class="shop-menu">
                                    <li class="shop-menu__item"><a href="404/404.htm">Фрукты, Овощи</a></li>
                                    <li class="shop-menu__item"><a href="404/404.htm">Мясо, птица</a></li>
                                    <li class="shop-menu__item"><a href="404/404.htm">Молоко, сыр</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu__body">
                            <h5>Контакты</h5>
                            <div class="footer-menu__help">
                                <ul class="help-menu">
                                    <li class="help-menu__item"><a href="404/404.htm">Магазины</a></li>
                                    <li class="help-menu__item"><a href="404/404.htm">Правовая информация</a></li>
                                    <li class="help-menu__item"><a href="404/404.htm">Реквизиты</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="footer-menu__body">
                            <h5>О компании</h5>
                            <div class="footer-menu__about">
                                <ul class="about-menu">
                                    <li class="about-menu__item"><a href="404/404.htm">Вакансии</a></li>
                                    <li class="about-menu__item"><a href="404/404.htm">История</a></li>
                                    <li class="about-menu__item"><a href="404/404.htm">Арендаторам</a></li>
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
    <script src="js/slider.js"></script>
    <script src="js/script.js"></script>
    <script src="js/search.js"></script>
</body>
</html>