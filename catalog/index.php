<?php
session_start();
require_once "../db/connect.php";
$sql_purchases = "select count(product_id), category_id from purchases group by category_id";
$query_purchases = $pdo -> prepare($sql_purchases);
$query_purchases -> execute();
$popular_categories = $query_purchases -> fetchAll();
$zxc_categories = array();

foreach ($popular_categories as $key) {
        $sql_categories = "select category_name, category_img from categories where category_id = :id";
        $query_categories = $pdo -> prepare($sql_categories);
        $query_categories -> execute([
            'id' => $key['category_id']
        ]);
        $zxc_categories[] = $query_categories -> fetchAll();
}

$sql_products = "select product_id, discount_value, product_name, product_price, product_path, category_id from products inner join 
                discounts on products.discount_id = discounts.discount_id where products.discount_id != 21 order by rand() limit 3";
$query_products = $pdo -> prepare($sql_products);
$query_products -> execute();
$popular_products = $query_products -> fetchAll();

    $sql_cart_products = "select * from cart where email = :email and product_id = :id";
    $query_cart_products = $pdo -> prepare($sql_cart_products);
    $query_cart_products -> execute([
        'email' => $_SESSION['login'],
        'id' => $_POST['id']
    ]);

    $needed_product = $query_products -> fetchAll();

$category_from_main_sql = "select * from products inner join discounts on products.discount_id = discounts.discount_id inner join categories on products.category_id
                = categories.category_id where products.category_id = :category ORDER BY rand()";
$category_from_main_query = $pdo -> prepare($category_from_main_sql);
$category_from_main_query -> execute([
    'category' => $_GET['category_id']
]);
$category_from_main = $category_from_main_query -> fetchAll();

$sql_categories = "select * from categories";
$query_categories= $pdo -> prepare($sql_categories);
$query_categories -> execute();
$categories = $query_categories -> fetchAll();

$random_category_sql = "select * from products inner join discounts on products.discount_id = discounts.discount_id inner join categories on products.category_id
                        = categories.category_id where products.category_id = :category ORDER BY rand()";
$random_category_query = $pdo -> prepare($random_category_sql);
$random_category_query -> execute([
    'category' => rand(3,count($categories))
]);
$random_category = $random_category_query -> fetchAll();

if(isset($_GET['category_id'])) {
    $random_category = array();
}   


?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body style="position: relative">
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
                                <li class="menu__item"><a class="menu__link" href="../account/index.php">Личный кабинет</a></li>
                                <?php 
                                if($_SESSION['role'] == 1){
                                    echo '<li class="menu__item"><a class="menu__link" href="../admin/index.php">Админ</a></li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="header__search">
                    <div class="search-form">
                        <form action="#" class="search-form__item" style="">
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
<section class="page search-bot">
    <div class="page__container container">
        <div class="page__wrapper">
            <div class="page_title title">
                <!-- <h3>Популярные категории</h3> -->
            </div>
            <div class="page__body body-page">
                <aside class="body-page__aside aside-page">
                    <div href="#" class="aside-page__filter">
                        <?php
                        foreach ($categories as $key) {
                            echo '<div data-id="'. $key['category_id'] .'" class="aside-page__item"><a href="#">'. $key['category_name'] .'</a></div>';
                        }
                        ?>
                    </div>
                </aside>
                <div class="body-page__content content-page">
                    <div class="body-page__title title">
                        <h2>Каталог товаров</h2>
                    </div>
                    <div class="content-page__discount selected-category">
                        <div class="content-page__title category-title title">
                            <h3><?php echo $random_category[0]['category_name']; ?></h3>
                        </div>
                        <div class="filters">
                            <div class="aside-page__price price-data" data-category="<?php echo $random_category[0]['category_id']; ?>">
                            <div class="price-data__title">
                                <h5>Цена</h5>
                            </div>
                            <div class="price-data__values">
                                <div class="price-decrease">
                                    <a href="#">По убыванию</a>
                                </div>
                                <div class="price-increase">
                                    <a href="#">По возрастанию</a>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="content-page__items asdasd">
                            <?php
                                foreach ($category_from_main as $key) {
                                    echo '<article name="zxc" data-id='. $key['product_id'] .' class="content-page__item item-product">
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

                                foreach ($random_category as $key) {
                                    echo '<article name="zxc" data-id='. $key['product_id'] .' class="content-page__item item-product">
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
                    <div class="content-page__discount">
                        <div class="content-page__title title">
                            <h3>Товары по скидке</h3>
                        </div>
                        <div class="content-page__items page-items__discount">
                            <?php
                                foreach ($popular_products as $key) {
                                    echo '<article name="zxc" data-id='. $key['product_id'] .' class="content-page__item item-product">
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
                        <div class="content-page__btn">
                            <a class="btn see-more">Показать еще</a>
                        </div>
                    </div>
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
    <script src="js/seeMore.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/cart.js"></script>
    <script src="js/select-category.js"></script>
    <script src="js/search.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="js/script.js"></script>
</body>

</html>