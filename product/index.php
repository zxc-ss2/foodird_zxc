<?php
session_start();
require_once "../db/connect.php";
$sql_product = "select * from products inner join discounts on products.discount_id = discounts.discount_id where product_id = :id";
$query_product = $pdo -> prepare($sql_product);
$query_product -> execute([
    'id' => $_GET['id']
]);
$product = $query_product -> fetchAll();

$sql_similar_products = "select * from products inner join categories on products.category_id = categories.category_id where products.category_id = :id";
$query_similar_products = $pdo -> prepare($sql_similar_products);
$query_similar_products -> execute([
    'id' => $_GET['category']
]);
$similar_products = $query_similar_products -> fetchAll();
print_r($similar_products);
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
                        echo '<a href="../../project/reglog/log.php" class="actions-header__item actions-header__item_favorites _icon-user"></a>';
                    }
                    ?>
                    <div class="actions-header__item cart-header">
                        <a href="../../project/cart/index.php" class="cart-header__icon _icon-cart"></a>
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
        <section class="product search-bot">
            <div class="product__container container">
            <div class="product__wrapper">
                <div class="product__body body-product">
                    <div class="body-product__content content-product">
                        <div class="content-product__slider-for">
                            <div class="slider-for__item">
                                <img src="<?php echo $similar_products[0][]?>" alt="">
                            </div>
                            <div class="slider-for__item">
                                <img src="img/product2.jpg" alt="">
                            </div>
                            <div class="slider-for__item">
                                <img src="img/product3.jpg" alt="">
                            </div>
                        </div>
                        <div class="content-product__slider-nav">
                            <div class="slider-nav__item">
                                <img src="img/product1.jpg" alt="">
                            </div>
                            <div class="slider-nav__item">
                                <img src="img/product2.jpg" alt="">
                            </div>
                            <div class="slider-nav__item">
                                <img src="img/product3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div data-category=<?php echo $product[0]['category_id'];?> class="body-product__info">
                        <div class="body-product__title title">
                            <h2><?php echo $product[0]['product_name'];?></h2>
                        </div>
                        <div class="body-product__main main-product">
                            <div class="main-product__add add-product">
                                <div class="add-product__price"><?php echo $product[0]['product_price'];?>руб./кг</div>
                                <a href="#" class="add-product__btn btn">В корзину</a>
                            </div>
                            <div class="main-product__way way-product">
                                <div class="way-product__delivery">
                                    <p>Доставка за 40 минут</p>
                                    <p>Выбрать адрес доставки</p>
                                </div>
                                <div class="way-product__pickup">
                                    <p>Самовывоз: бесплатно</p>
                                    <p>В наличие в 28 магазинах</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="advices">
        <div class="advices__container container">
            <div class="advices body-advices">
                <div class="body-advices__title title">
                    <h2>Вам может быть интересно</h2>
                </div>
                <div class="body-advices__wrapper">
                    <div class="aslider">
                        <?php
                        foreach ($similar_products as $key) {
                            echo '
                            <div class="slider__item">
                                <article class="products__item item-product">
                                    <div class="item-product__labels">
                                        <div class="item-product__label item-product__label_sale">-'. $key['discount_id'] .'%</div>
                                    </div>
                                    <a href="" class="item-product__image">
                                        <img class="catalog-img" '. $key['product_path'] .'" alt="">
                                    </a>
                                    <div class="item-product__body">
                                        <div class="item-product__content">
                                            <h5 class="item-product__title">'. $key['product_name'] .'</h5>
                                        </div>
                                        <div class="item-product__prices">
                                            <div class="item-product__price">'. round($key['product_price']-$key['product_price'] * $key['product_price']/100,1) .'руб./кг</div>
                                            <div class="item-product__price item-product__price_old">'. $key['product_price'] .'руб./кг</div>
                                        </div>
                                        <div class="item-product__actions actions-product">
                                            <div class="actions-product__body">
                                                <a href="" class="btn  actions-product__btn">В корзину</a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            ';
                        }
                        ?>
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