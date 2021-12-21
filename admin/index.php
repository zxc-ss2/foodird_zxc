<?php
require_once "../db/connect.php";
session_start();
$users_sql = "select * from users";
$users_query = $pdo -> prepare($users_sql);
$users_query -> execute();
$users = $users_query -> fetchAll();

$cart_sql = "select * from cart";
$cart_query = $pdo -> prepare($cart_sql);
$cart_query -> execute();
$cart = $cart_query -> fetchAll();

$purchases_sql = "select * from purchases";
$purchases_query = $pdo -> prepare($purchases_sql);
$purchases_query -> execute();
$purchases = $purchases_query -> fetchAll();

$products_sql = "select * from products inner join discounts on products.discount_id = discounts.discount_id inner join categories
                on products.category_id = categories.category_id";
$products_query = $pdo -> prepare($products_sql);
$products_query -> execute();
$products = $products_query -> fetchAll();
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
                    <a class="logo" href="#">
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
                        <a href="" class="cart-header__icon _icon-cart"></a>
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
        <section class="admin">
    <div class="admin__container container">
        <div class="admin__wrapper">
            <div class="admin__body body-admin">
                <div class="body-admin__content">
                    <div class="wrapper">
                        <table class="table_price">
                            <caption>Пользователи</caption>
                                <tr>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php
                                foreach ($users as $key) {
                                    echo '
                                    <tr>
                                        <td>'. $key['name'] .'</td>
                                        <td>'. $key['email'] .'</td>
                                        <td><a data-id="'. $key['user_id'] .'" class="user-delete" href="#">Удалить</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                        </table>
                        <table class="table_price">
                            <caption>Корзина</caption>
                                <tr>
                                    <th>Номер</th>
                                    <th>Email</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php
                                foreach ($cart as $key) {
                                    echo '
                                    <tr>
                                        <td>'. $key['cart_id'] .'</td>
                                        <td>'. $key['email'] .'</td>
                                        <td><a data-id="'. $key['cart_id'] .'" class="cart-delete" href="#">Удалить</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                        </table>
                        <table class="table_price">
                            <caption>Заказы</caption>
                                <tr>
                                    <th>Количество</th>
                                    <th>Дата</th>
                                    <th>Пользователь</th>
                                    <th>Продукт</th>
                                </tr>
                                <?php
                                foreach ($purchases as $key) {
                                    echo '
                                    <tr>
                                        <td>'. $key['purchase_count'] .'</td>
                                        <td>'. $key['date'] .'</td>
                                        <td>'. $key['user_id'] .'</td>
                                        <td><a data-id="'. $key['purchase_id'] .'" class="purchase-delete" href="#">Удалить</a></td>
                                    </tr>
                                    ';
                                }
                                ?>
                        </table>
                    </div>
                    <div class="products">
                        <table class="table_price">
                            <caption>Продукты</caption>
                                <tr>
                                    <th>Номер продукта</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Номер поставщика</th>
                                    <th>Скидка</th>
                                    <th>Категория</th>
                                </tr>
                                <?php
                                foreach ($products as $key) {
                                    echo '
                                    <tr>
                                        <td>'. $key['product_id'] .'</td>
                                        <td>'. $key['product_name'] .'</td>
                                        <td>'. $key['product_price'] .'</td>
                                        <td>'. $key['supplier_id'] .'</td>
                                        <td>'. $key['discount_value'] .'</td>
                                        <td>'. $key['category_name'] .'</td>
                                    </tr>
                                    ';
                                }
                                ?>
                        </table>
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
    <script src="js/script.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>

</body>

</html>