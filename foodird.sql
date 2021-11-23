-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 23 2021 г., 22:47
-- Версия сервера: 8.0.24
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `foodird`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `email`) VALUES
(185, 4, 'ubaykarova@gmail.com'),
(186, 18, 'ubaykarova@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_img`) VALUES
(3, 'Молоко, сыр, яйца', 'img/catalog-bg-img/milk.png'),
(4, 'Овощи, фрукты, грибы', 'img/catalog-bg-img/fruict.png'),
(5, 'Макароны, крупы, масло, специи', 'img/catalog-bg-img/oils.png'),
(6, 'Готовая еда', 'img/catalog-bg-img/gotovaya-eda.png'),
(7, 'Сладости и снеки', 'img/catalog-bg-img/sneki.png'),
(8, 'Соки, воды, напитки', 'img/catalog-bg-img/juices.png'),
(9, 'Хлеб и выпечка', 'img/catalog-bg-img/bread.png'),
(10, 'Мясо, птица, деликатесы', 'img/catalog-bg-img/meat.png'),
(11, 'Рыба и морепродукты', 'img/catalog-bg-img/fish.png'),
(12, 'Замороженные продукты', 'img/catalog-bg-img/ice.png'),
(13, 'Соусы, кетчупы, майонезы', 'img/catalog-bg-img/souces.png'),
(14, 'img/Кофе, чай, какао', 'img/catalog-bg-img/tea.png'),
(15, 'Продукты быстрого приготовления', 'img/catalog-bg-img/fasteat.png'),
(16, 'Орехи, семечки, сухофрукты', 'img/catalog-bg-img/nuts.png'),
(17, 'Мёд, варенье, джемы, сиропы', 'img/catalog-bg-img/honey.png'),
(18, 'Алкогольные напитки', 'img/catalog-bg-img/alchacol.png');

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int NOT NULL,
  `discount_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `discounts`
--

INSERT INTO `discounts` (`discount_id`, `discount_value`) VALUES
(1, 5),
(2, 10),
(3, 15),
(4, 20),
(5, 25),
(6, 30),
(7, 35),
(8, 40),
(9, 45),
(10, 50),
(11, 55),
(12, 60),
(13, 65),
(14, 70),
(15, 75),
(16, 80),
(17, 85),
(18, 90),
(19, 95),
(20, 100),
(21, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `limits`
--

CREATE TABLE `limits` (
  `limit_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_path` varchar(255) NOT NULL,
  `product_price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `supplier_id` int NOT NULL,
  `discount_id` int DEFAULT NULL,
  `category_id` int NOT NULL,
  `product_path` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_price`, `supplier_id`, `discount_id`, `category_id`, `product_path`) VALUES
(3, 'Форель радужная Русское Море филе-кусок слабосолёная, 300г', 719, 7, 6, 11, 'img/catalog-img/forel.jpg'),
(4, 'Кофе Bushido Black Katana 100% арабика молотый, 227г', 549.9, 8, 4, 14, 'img/catalog-img/cofee.jpg'),
(5, 'Хлеб Harry\'s American Sandwich пшеничный, 470г', 83.9, 3, 21, 9, 'img/catalog-img/bread.jpg'),
(6, 'Лапша Доширак быстрого приготовления со вкусом говядины, 90г', 51.9, 5, 2, 15, 'img/catalog-img/bich.jpg'),
(7, 'Семечки От Мартина отборные жареные, 200г', 199.9, 5, 4, 16, 'img/catalog-img/seeds.jpg'),
(8, 'Лист лавровый Просто, 10г', 12.9, 4, 9, 5, 'img/catalog-img/lavroviy-list.jpg'),
(9, 'Перец чёрный Просто молотый, 15г', 10.9, 4, 2, 5, 'img/catalog-img/cherniy-peretz.jpg'),
(10, 'Гречка Агро-Альянс Экстра элитная, 900г', 124.9, 6, 4, 5, 'img/catalog-img/grechka.jpg'),
(11, 'Масло подсолнечное Слобода рафинированное дезодорированное высший сорт, 1л', 109.9, 1, 3, 5, 'img/catalog-img/maslo-sloboda.jpg'),
(12, 'Хлеб Щелковохлеб Дарницкий нарезка, 320г', 24.9, 4, 4, 9, 'img/catalog-img/shelkovoxleb.jpg'),
(13, 'Хлебцы Dr.Korner Карамельные кукурузно-рисовые, 90г', 91.9, 1, 5, 9, 'img/catalog-img/dr.korner.jpg'),
(14, 'Тараллини Nina Farina классические, 180г', 45.9, 4, 2, 9, 'img/catalog-img/nina-farina.jpg'),
(15, 'Хлебцы Finn Crisp Original ржаные, 200г', 209, 6, 2, 9, 'img/catalog-img/finn-crisp-original.jpg'),
(16, 'Вино Canti Chardonnay белое полусухое 0,75л, 11,5%', 839, 2, 3, 18, 'img/catalog-img/canti-chardonnay.jpg'),
(17, 'Виски Jack Daniels Тенесси Old No.7 40%, 700мл', 2299, 8, 5, 18, 'img/catalog-img/jack-daniels.jpg'),
(18, 'Пиво Heineken светлое 4.8%, 470мл', 53.9, 1, 3, 18, 'img/catalog-img/heineken.jpg'),
(22, 'Коктейль молочный Чудо Шоколад 2%, 950г', 134.9, 4, 3, 3, 'img/catalog-img/chudo-milkshake.jpg'),
(23, 'Киви, 1кг', 119.9, 6, 2, 4, 'img/catalog-img/kiwi.jpg'),
(24, 'Огурцы Люкс, 450г', 129.9, 7, 2, 4, 'img/catalog-img/cucumber.jpg'),
(25, 'Лук репчатый, 1кг', 39.9, 4, 2, 4, 'img/catalog-img/onion.jpg'),
(26, 'Молоко Parmalat Natura Premium питьевое ультрапастеризованное 3.5%, 1л', 97.9, 3, 21, 3, 'img/catalog-img/parmalat.jpg'),
(27, 'Молоко стерилизованное Агуша 3.2% 925мл с 3 лет', 97.9, 6, 21, 3, 'img/catalog-img/agusha.jpg'),
(28, 'Сыр Arla Natura Сливочный 45%, 200г', 199.9, 6, 4, 3, 'img/catalog-img/natura.jpg'),
(29, 'Сыр Ламбер Гауда 45%, 180г', 199.9, 4, 10, 3, 'img/catalog-img/lambert.jpg'),
(30, 'Сыр творожный Hochland Сливочный 60%, 140г', 99.9, 3, 21, 3, 'img/catalog-img/hohcland.jpg'),
(31, 'Творог Простоквашино 5% 200г', 109.9, 3, 21, 3, 'img/catalog-img/prostotvorog.jpg'),
(32, 'Биотворог Тёма со вкусом клубники и банана 4.2%, 100г', 35.9, 3, 21, 3, 'img/catalog-img/temabanana.jpg'),
(33, 'Биотворог Тёма классический с LGG с 6 месяцев 5%, 100г', 33.9, 5, 5, 3, 'img/catalog-img/temaclassic.jpg'),
(34, 'Картофель, 1кг', 54.9, 3, 3, 4, 'img/catalog-img/potato.jpg'),
(35, 'Томаты красные круглые, 1кг', 139.9, 1, 21, 4, 'img/catalog-img/tomato.jpg'),
(36, 'Яблоки сезонные, 1кг', 79.9, 4, 3, 4, 'img/catalog-img/apple.jpg'),
(37, 'Апельсины, 1кг', 129.9, 7, 7, 4, 'img/catalog-img/orange.jpg'),
(38, 'Виноград Киш-миш, 1кг', 169.9, 1, 21, 4, 'img/catalog-img/grape.jpg'),
(39, 'Груши Конференс, 1кг', 199.99, 6, 6, 4, 'img/catalog-img/pear.jpg'),
(40, 'Клубника, 250г', 329.9, 8, 2, 4, 'img/catalog-img/strawberry.jpg'),
(41, 'Малина свежая, 125г', 349.9, 6, 21, 4, 'img/catalog-img/raspberries.jpg'),
(42, 'Макароны Maltagliati Chifferini rigati №038 рожки мелкие, 500г', 87.9, 7, 5, 5, 'img/catalog-img/maltagliati.jpg'),
(43, 'Спагетти Шебекинские №2 тонкие, 450г', 69.9, 3, 21, 5, 'img/catalog-img/chebenskie.jpg'),
(44, 'Рис Маркет Перекрёсток длиннозёрный, 900г', 134.9, 8, 21, 5, 'img/catalog-img/rice.jpg'),
(45, 'Рис Мистраль Кубань белый круглозёрный, 5х80г', 114.9, 3, 5, 5, 'img/catalog-img/ricekuban.jpg'),
(46, 'Чеснок Kotanyi измельчённый, 28г', 55.9, 5, 14, 5, 'img/catalog-img/chesnok.jpg'),
(47, 'Паприка Маркет Перекрёсток сладкая молотая, 15г', 43.9, 1, 21, 5, 'img/catalog-img/paprika.jpg'),
(48, 'Укроп Маркет Перекрёсток измельчённый, 7г', 43.9, 5, 6, 5, 'img/catalog-img/ukrop.jpg'),
(49, 'Мука Makfa высшего сорта, 2кг', 114.9, 4, 21, 5, 'img/catalog-img/muka.jpg'),
(50, 'Сода пищевая, 500г', 37.9, 5, 10, 5, 'img/catalog-img/soda.jpg'),
(51, 'Салат Оливье, кг', 39.9, 4, 21, 6, 'img/catalog-img/oliview.jpg'),
(52, 'Курица-гриль Перекрёсток по рецепту Перекрестка, кг', 474.6, 7, 3, 6, 'img/catalog-img/chicken-gril.jpg'),
(53, 'Салат Крабовый, кг', 39.9, 2, 21, 6, 'img/catalog-img/kraboviy.jpg'),
(54, 'Пончик Перекрёсток Donut с клубникой, 68г', 59.9, 5, 21, 6, 'img/catalog-img/donut.jpg'),
(55, 'Индейка Натурбуфет с рисом и овощами 250г', 139.9, 7, 21, 6, 'img/catalog-img/indeyka.jpg'),
(56, 'Вода Боржоми минеральная лечебно-столовая газированная, 500мл', 85.9, 7, 5, 6, 'img/catalog-img/barjomi.jpg'),
(57, 'Вода Aqua Minerale питьевая негазированная, 0,5л', 39.9, 1, 21, 6, 'img/catalog-img/aqua.jpg'),
(58, 'Паста Натурбуфет Карбонара 250г', 139.9, 8, 9, 6, 'img/catalog-img/karbonara.jpg'),
(59, 'Суп Натурбуфет Солянка Домашняя 340г', 169.9, 3, 14, 6, 'img/catalog-img/solyanka.jpg'),
(60, 'Сэндвич двойной с курицей и салатом, 200г', 129, 6, 21, 6, 'img/catalog-img/sandwich.jpg'),
(61, 'Печенье Юбилейное молочное витаминизированное с глазурью, 116г', 45.9, 6, 3, 7, 'img/catalog-img/ubileynoe.jpg'),
(62, 'Печенье Bonte Bakery малиновый десерт сдобное, 270г', 77.9, 8, 21, 7, 'img/catalog-img/bonte.jpg'),
(63, 'Чипсы кукурузные Doritos Nacho Сливочный сыр, 100г', 93.9, 7, 3, 7, 'img/catalog-img/doritos.jpg'),
(64, 'Чипсы Lay\'s Рифленые Сметана-Лук, 150г', 124.9, 3, 12, 7, 'img/catalog-img/lays.jpg'),
(65, 'Кукурузные снеки Cheetos Сыр, 55г', 47.9, 7, 21, 7, 'img/catalog-img/cheetos.jpg'),
(66, 'Шоколад молочный Milka, 85г', 129.9, 6, 2, 7, 'img/catalog-img/milk.jpg'),
(67, 'Шоколад молочный Nesquik с молочной начинкой, 100г', 89.9, 4, 21, 7, 'img/catalog-img/nesquik.jpg'),
(68, 'Батончик шоколадный Twix Экстра с печеньем, 82г', 65.9, 2, 3, 7, 'img/catalog-img/twix.jpg'),
(69, 'Набор Nutella&GO! c хлебными палочками и ореховой пастой Nutella, 52г', 109.9, 6, 21, 7, 'img/catalog-img/nutella.jpg'),
(70, 'Пирожное Kinder Maxi King орехи-карамель, 35г', 65.9, 1, 9, 7, 'img/catalog-img/kinder.jpg'),
(71, 'Кофе Egoiste Velvet жареный в зёрнах, 200г', 469, 6, 21, 14, 'img/catalog-img/egoist.jpg'),
(72, 'Чай Greenfield Spring Melody чёрный в пакетиках, 25х1.5г', 114.9, 7, 6, 14, 'img/catalog-img/spring-melody.jpg'),
(73, 'Чай Азерчай Букет чёрный байховый крупнолистовой, 100г', 139.9, 4, 8, 14, 'img/catalog-img/azertea.jpg'),
(74, 'Какао-напиток Nesquik быстрорастворимый обогащённый, 250г', 174.9, 6, 21, 14, 'img/catalog-img/nesquik-kakao.jpg'),
(75, 'Горячий шоколад Elza, 325г', 539, 5, 13, 14, 'img/catalog-img/elza.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int NOT NULL,
  `purchase_count` int NOT NULL,
  `purchase_date` date NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `purchase_count`, `purchase_date`, `user_id`, `product_id`, `category_id`) VALUES
(7, 3, '2021-11-10', 4, 4, 11),
(8, 2, '2021-11-02', 5, 14, 15),
(9, 5, '2021-11-12', 4, 22, 15),
(10, 4, '2021-11-12', 5, 18, 11),
(11, 5, '2021-11-11', 4, 24, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `removed-products`
--

CREATE TABLE `removed-products` (
  `removed-product_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`) VALUES
(1, 'Алнат', 'Барнаул'),
(2, 'АлтайФлора', 'Бийск'),
(3, 'Эллада', 'Москва'),
(4, 'ItalyConsulting', 'Московская область'),
(5, 'АйваЭко', 'Краснодар'),
(6, 'natsweet', 'Екатеринбург'),
(7, 'Каскад', 'Краснодар'),
(8, 'Вкусико Кофе', 'Москва');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(4, 'Алексей', 'skochkov.aleksey@yandex.ru', '$2y$10$WEIV78yocV2DZFziz1CkEuHxpp1jfum3gIn48bL5Q4ny10sQq2Lsy'),
(5, 'Юлия', 'ubaykarova@gmail.com', '$2y$10$bvdAA3BoH2kX0A/h4A0qYej2lsRM/65XdcgSdv78kgYhdpS4q/Y9a'),
(6, 'Uliya', 'ubaykarova1@gmail.com', '$2y$10$H7rpii4TrkYM71QsMwRREeCfZiu.o.pibiujli2c4PzSsLUi9/o1K');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Индексы таблицы `limits`
--
ALTER TABLE `limits`
  ADD PRIMARY KEY (`limit_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `discount_id` (`discount_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `removed-products`
--
ALTER TABLE `removed-products`
  ADD PRIMARY KEY (`removed-product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `limits`
--
ALTER TABLE `limits`
  MODIFY `limit_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `removed-products`
--
ALTER TABLE `removed-products`
  MODIFY `removed-product_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`discount_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `purchases_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
