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
        <section class="profile search-bot">
    <div class="profile__container container">
        <div class="profile__wrapper">
            <div class="profile__body body-profile">
                <div class="body-profile__content">
                    <div class="body-profile__title title">
                        <h2>Профиль</h2>
                    </div>
                    <div class="body-profile__form">
                        <div class="body-profile__subtitle title">
                            <h4>Основная информация</h4>
                        </div>
                        <div class="main-form" name="update-info-form" method="post">
                            <div class="main-form__name name-form">
                                <label for="firstname" class="placeholder"><?php echo $user_info[0]['name']?></label>
                                <input name="new-name" id="firstname" class="name-form__inp" placeholder=" " type="text">
                            </div>

                            <div class="main-form__email email-form">
                                <label for="email" class="placeholder"><?php echo $user_info[0]['email']?></label>
                                <input name="new-email" id="email" class="email-form__inp" placeholder=" " type="text">
                            </div>

                            <a class="btn save-btn save-btn-info">Сохранить изменения</a>

                            <div class="check success">
                            <span>&#10004;</span>
                            <p>Данные успешно обновлены, вы будете перенаправлены на страницу авторизации через <span class="timer">5</span> секунд</p>
                        </div>
                        <div class="check fail">
                            <span>&#10006;</span>
                            <p class="fail-content"></p>
                        </div>
                        </div>
                        <div class="body-profile__subtitle title">
                            <h4>Сменить пароль</h4>
                        </div>
                        <div class="password-form" action="">
                            <div class="password-form__old">
                                <label for="">Новый пароль</label>
                                <input class="new__pass" type="text">
                            </div>

                            <div class="password-form__new">
                                <label for="">Повторите пароль</label>
                                <input class="conf-new__pass" type="text">
                            </div>

                            <a class="btn save-btn save-btn-pass">Сохранить изменения</a>

                            <div class="check success">
                                <span>&#10004;</span>
                                <p>Данные успешно обновлены, вы будете перенаправлены на страницу авторизации через <span class="timer">5</span> секунд</p>
                            </div>
                            <div class="check fail">
                                <span>&#10006;</span>
                                <p class="fail-content"></p>
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
    <script src="js/search.js"></script>
    <script src="js/updateInfo.js"></script>
    <script src="js/script.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
</body>
</html>