<?php
session_start();
require_once "../db/connect.php";

$sql_user_info = "select * from users where email = :email";
$query_user_info = $pdo -> prepare($sql_user_info);
$query_user_info -> execute([
    'email' => $_SESSION['login']
]);
$user_info = $query_user_info -> fetchAll();
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
        <section class="profile">
    <div class="profile__container container">
        <div class="profile__wrapper">
            <div class="profile__body body-profile">
                <div class="body-profile__menu menu-profile">
                    <nav class="menu-profile__nav">
                        <ul>
                            <li class="menu-profile__item"><a href="#" class="menu-profile__link">Мои заказы</a></li>
                            <li class="menu-profile__item"><a href="#" class="menu-profile__link">Профиль</a></li>
                            <li class="menu-profile__item"><a href="#" class="menu-profile__link">Мои бонусы</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="body-profile__content">
                    <div class="body-profile__title title">
                        <h2>Профиль</h2>
                    </div>
                    <div class="body-profile__form">
                        <div class="body-profile__subtitle title">
                            <h4>Основная информация</h4>
                        </div>
                        <form class="main-form" name="update-info-form">
                            <div class="main-form__name name-form">
                                <label for="firstname" class="placeholder"><?php echo $user_info[0]['name']?></label>
                                <div class="cut"></div>
                                <input id="firstname" class="name-form__inp" placeholder=" " type="text">
                            </div>

                            <div class="main-form__surname surname-form">
                                <label for="lastname" class="placeholder"><?php echo $user_info[0]['surname']?></label>
                                <div class="cut"></div>
                                <input id="lastname" class="surname-form__inp" placeholder=" " type="text">
                            </div>

                            <div class="main-form__email email-form">
                                <label for="email" class="placeholder"><?php echo $user_info[0]['email']?></label>
                                <div class="cut"></div>
                                <input id="email" class="email-form__inp" placeholder=" " type="text">
                            </div>

                            <button class="btn save-btn save-btn-info">Сохранить изменения</button>
                        </form>
                        <div class="body-profile__subtitle title">
                            <h4>Сменить пароль</h4>
                        </div>
                        <form class="password-form" action="">
                            <div class="password-form__old">
                                <label for="">Новый пароль</label>
                                <input type="text">
                            </div>

                            <div class="password-form__new">
                                <label for="">Повторите пароль</label>
                                <input type="text">
                            </div>

                            <button class="btn save-btn save-btn-pass">Сохранить изменения</button>
                        </form>
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
                        <h3>Подписаться на рассылку</h3>
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