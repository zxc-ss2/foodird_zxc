-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 21 2021 г., 21:14
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
(204, 70, 'ubaykarova1@gmail.com'),
(208, 69, 'ubaykarova1@gmail.com'),
(349, 23, 'skochkov.aleksey@yandex.ru'),
(356, 131, 'uliya@gmail.com');

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
(14, 'Кофе, чай, какао', 'img/catalog-bg-img/tea.png'),
(15, 'Продукты быстрого приготовления', 'img/catalog-bg-img/fasteat.png'),
(16, 'Орехи, семечки, сухофрукты', 'img/catalog-bg-img/nuts.png'),
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
(3, 'Форель радужная Русское Море филе-кусок слабосолёная, 300г', 719, 7, 6, 11, 'img/catalog-img/forel.png'),
(4, 'Кофе Bushido Black Katana 100% арабика молотый, 227г', 549.9, 8, 4, 14, 'img/catalog-img/cofee.png'),
(5, 'Хлеб Harry\'s American Sandwich пшеничный, 470г', 83.9, 3, 21, 9, 'img/catalog-img/bread.png'),
(6, 'Лапша Доширак быстрого приготовления со вкусом говядины, 90г', 51.9, 5, 2, 15, 'img/catalog-img/bich.png'),
(7, 'Семечки От Мартина отборные жареные, 200г', 199.9, 5, 4, 16, 'img/catalog-img/seeds.png'),
(8, 'Лист лавровый Просто, 10г', 12.9, 4, 9, 5, 'img/catalog-img/lavroviy-list.png'),
(9, 'Перец чёрный Просто молотый, 15г', 10.9, 4, 2, 5, 'img/catalog-img/cherniy-peretz.png'),
(10, 'Гречка Агро-Альянс Экстра элитная, 900г', 124.9, 6, 4, 5, 'img/catalog-img/grechka.png'),
(11, 'Масло подсолнечное Слобода рафинированное дезодорированное высший сорт, 1л', 109.9, 1, 3, 5, 'img/catalog-img/maslo-sloboda.png'),
(12, 'Хлеб Щелковохлеб Дарницкий нарезка, 320г', 24.9, 4, 4, 9, 'img/catalog-img/shelkovoxleb.png'),
(13, 'Хлебцы Dr.Korner Карамельные кукурузно-рисовые, 90г', 91.9, 1, 5, 9, 'img/catalog-img/dr.korner.png'),
(14, 'Тараллини Nina Farina классические, 180г', 45.9, 4, 2, 9, 'img/catalog-img/nina-farina.png'),
(15, 'Хлебцы Finn Crisp Original ржаные, 200г', 209, 6, 2, 9, 'img/catalog-img/finn-crisp-original.png'),
(16, 'Вино Canti Chardonnay белое полусухое 0,75л, 11,5%', 839, 2, 3, 18, 'img/catalog-img/canti-chardonnay.png'),
(17, 'Виски Jack Daniels Тенесси Old No.7 40%, 700мл', 2299, 8, 5, 18, 'img/catalog-img/jack-daniels.png'),
(18, 'Пиво Heineken светлое 4.8%, 470мл', 53.9, 1, 3, 18, 'img/catalog-img/heineken.png'),
(22, 'Коктейль молочный Чудо Шоколад 2%, 950г', 134.9, 4, 3, 3, 'img/catalog-img/chudo-milkshake.png'),
(23, 'Киви, 1кг', 119.9, 6, 2, 4, 'img/catalog-img/kiwi.png'),
(24, 'Огурцы Люкс, 450г', 129.9, 7, 2, 4, 'img/catalog-img/cucumber.png'),
(25, 'Лук репчатый, 1кг', 39.9, 4, 2, 4, 'img/catalog-img/onion.png'),
(26, 'Молоко Parmalat Natura Premium питьевое ультрапастеризованное 3.5%, 1л', 97.9, 3, 21, 3, 'img/catalog-img/parmalat.png'),
(27, 'Молоко стерилизованное Агуша 3.2% 925мл с 3 лет', 97.9, 6, 21, 3, 'img/catalog-img/agusha.png'),
(28, 'Сыр Arla Natura Сливочный 45%, 200г', 199.9, 6, 4, 3, 'img/catalog-img/natura.png'),
(29, 'Сыр Ламбер Гауда 45%, 180г', 199.9, 4, 10, 3, 'img/catalog-img/lambert.png'),
(30, 'Сыр творожный Hochland Сливочный 60%, 140г', 99.9, 3, 21, 3, 'img/catalog-img/hochland.png'),
(31, 'Творог Простоквашино 5% 200г', 109.9, 3, 21, 3, 'img/catalog-img/prostotvorog.png'),
(32, 'Биотворог Тёма со вкусом клубники и банана 4.2%, 100г', 35.9, 3, 21, 3, 'img/catalog-img/temabanana.png'),
(33, 'Биотворог Тёма классический с LGG с 6 месяцев 5%, 100г', 33.9, 5, 5, 3, 'img/catalog-img/temaclassic.png'),
(34, 'Картофель, 1кг', 54.9, 3, 3, 4, 'img/catalog-img/potato.png'),
(35, 'Томаты красные круглые, 1кг', 139.9, 1, 21, 4, 'img/catalog-img/tomato.png'),
(36, 'Яблоки сезонные, 1кг', 79.9, 4, 3, 4, 'img/catalog-img/apple.png'),
(37, 'Апельсины, 1кг', 129.9, 7, 7, 4, 'img/catalog-img/orange.png'),
(38, 'Виноград Киш-миш, 1кг', 169.9, 1, 21, 4, 'img/catalog-img/grape.png'),
(39, 'Груши Конференс, 1кг', 199.99, 6, 6, 4, 'img/catalog-img/pear.png'),
(40, 'Клубника, 250г', 329.9, 8, 2, 4, 'img/catalog-img/strawberry.png'),
(41, 'Малина свежая, 125г', 349.9, 6, 21, 4, 'img/catalog-img/raspberries.png'),
(42, 'Макароны Maltagliati Chifferini rigati №038 рожки мелкие, 500г', 87.9, 7, 5, 5, 'img/catalog-img/maltagliati.png'),
(43, 'Спагетти Шебекинские №2 тонкие, 450г', 69.9, 3, 21, 5, 'img/catalog-img/chebenskie.png'),
(44, 'Рис Маркет Перекрёсток длиннозёрный, 900г', 134.9, 8, 21, 5, 'img/catalog-img/rice.png'),
(45, 'Рис Мистраль Кубань белый круглозёрный, 5х80г', 114.9, 3, 5, 5, 'img/catalog-img/ricekuban.png'),
(46, 'Чеснок Kotanyi измельчённый, 28г', 55.9, 5, 14, 5, 'img/catalog-img/chesnok.png'),
(47, 'Паприка Маркет Перекрёсток сладкая молотая, 15г', 43.9, 1, 21, 5, 'img/catalog-img/paprika.png'),
(48, 'Укроп Маркет Перекрёсток измельчённый, 7г', 43.9, 5, 6, 5, 'img/catalog-img/ukrop.png'),
(49, 'Мука Makfa высшего сорта, 2кг', 114.9, 4, 21, 5, 'img/catalog-img/muka.png'),
(50, 'Сода пищевая, 500г', 37.9, 5, 10, 5, 'img/catalog-img/soda.png'),
(51, 'Салат Оливье, кг', 39.9, 4, 21, 6, 'img/catalog-img/oliview.png'),
(52, 'Курица-гриль Перекрёсток по рецепту Перекрестка, кг', 474.6, 7, 3, 6, 'img/catalog-img/chiken-gril.png'),
(53, 'Салат Крабовый, кг', 39.9, 2, 21, 6, 'img/catalog-img/kraboviy.png'),
(54, 'Пончик Перекрёсток Donut с клубникой, 68г', 59.9, 5, 21, 6, 'img/catalog-img/donut.png'),
(55, 'Индейка Натурбуфет с рисом и овощами 250г', 139.9, 7, 21, 6, 'img/catalog-img/indeyka.png'),
(56, 'Вода Боржоми минеральная лечебно-столовая газированная, 500мл', 85.9, 7, 5, 6, 'img/catalog-img/barjomi.png'),
(57, 'Вода Aqua Minerale питьевая негазированная, 0,5л', 39.9, 1, 21, 6, 'img/catalog-img/aqua.png'),
(58, 'Паста Натурбуфет Карбонара 250г', 139.9, 8, 9, 6, 'img/catalog-img/karbonara.png'),
(59, 'Суп Натурбуфет Солянка Домашняя 340г', 169.9, 3, 14, 6, 'img/catalog-img/solyanka.png'),
(60, 'Сэндвич двойной с курицей и салатом, 200г', 129, 6, 21, 6, 'img/catalog-img/sandwich.png'),
(61, 'Печенье Юбилейное молочное витаминизированное с глазурью, 116г', 45.9, 6, 3, 7, 'img/catalog-img/ubileynoe.png'),
(62, 'Печенье Bonte Bakery малиновый десерт сдобное, 270г', 77.9, 8, 21, 7, 'img/catalog-img/bonte.png'),
(63, 'Чипсы кукурузные Doritos Nacho Сливочный сыр, 100г', 93.9, 7, 3, 7, 'img/catalog-img/doritos.png'),
(64, 'Чипсы Lay\'s Рифленые Сметана-Лук, 150г', 124.9, 3, 12, 7, 'img/catalog-img/lays.png'),
(65, 'Кукурузные снеки Cheetos Сыр, 55г', 47.9, 7, 21, 7, 'img/catalog-img/cheetos.png'),
(66, 'Шоколад молочный Milka, 85г', 129.9, 6, 2, 7, 'img/catalog-img/milk.png'),
(67, 'Шоколад молочный Nesquik с молочной начинкой, 100г', 89.9, 4, 21, 7, 'img/catalog-img/nesquik.png'),
(68, 'Батончик шоколадный Twix Экстра с печеньем, 82г', 65.9, 2, 3, 7, 'img/catalog-img/twix.png'),
(69, 'Набор Nutella&GO! c хлебными палочками и ореховой пастой Nutella, 52г', 109.9, 6, 21, 7, 'img/catalog-img/nutella.png'),
(70, 'Пирожное Kinder Maxi King орехи-карамель, 35г', 65.9, 1, 9, 7, 'img/catalog-img/kinder.png'),
(71, 'Кофе Egoiste Velvet жареный в зёрнах, 200г', 469, 6, 21, 14, 'img/catalog-img/egoist.png'),
(72, 'Чай Greenfield Spring Melody чёрный в пакетиках, 25х1.5г', 114.9, 7, 6, 14, 'img/catalog-img/spring-melody.png'),
(73, 'Чай Азерчай Букет чёрный байховый крупнолистовой, 100г', 139.9, 4, 8, 14, 'img/catalog-img/azertea.png'),
(74, 'Какао-напиток Nesquik быстрорастворимый обогащённый, 250г', 174.9, 6, 21, 14, 'img/catalog-img/nesquik-kakao.png'),
(75, 'Горячий шоколад Elza, 325г', 539, 5, 13, 14, 'img/catalog-img/elza.png'),
(76, 'Напиток газированный Pepsi, 2л', 144.9, 4, 21, 8, 'img/catalog-img/pepsi.png'),
(77, 'Напиток газированный Mirinda Апельсин, 2л', 139.9, 7, 2, 8, 'img/catalog-img/mirinda.png'),
(78, 'Энергетический напиток Adrenaline Rush, 0,449л', 149.9, 1, 21, 8, 'img/catalog-img/adrenaline.png'),
(79, 'Энергетик Black Monster Energy безалкогольный газированный, 449мл', 109.9, 4, 2, 8, 'img/catalog-img/monster.png'),
(80, 'Сок J7 Апельсиновый с мякотью 970мл', 154.9, 3, 5, 8, 'img/catalog-img/j7.png'),
(81, 'Нектар Я Вишня осветленный 970мл', 209, 1, 21, 8, 'img/catalog-img/ya.png'),
(82, 'Холодный чай Lipton Лимон, 1л', 99.9, 2, 21, 8, 'img/catalog-img/lipton.png'),
(83, 'Напиток сокосодержащий Pulpy апельсин с мякотью для детского питания, 900мл', 95.9, 3, 6, 8, 'img/catalog-img/pulpy.png'),
(84, 'Морс Добрый бруснично-морошковый, 1л', 139.9, 5, 9, 8, 'img/catalog-img/dobriy.png'),
(85, 'Напиток пивной безалкогольный Bud светлый 0.5%, 450мл', 59.85, 3, 4, 8, 'img/catalog-img/bud.png'),
(86, 'Пиво безалкогольное Балтика №0 светлое 0.5%, 450мл', 49.9, 8, 21, 8, 'img/catalog-img/baltika.png'),
(87, 'Пиццетта Перекрёсток с салями, 90г', 49.9, 4, 21, 9, 'img/catalog-img/pizza.png'),
(88, 'Лепёшки пшеничные Mission тортильи оригинальные со злаками, 250г', 95.9, 3, 6, 9, 'img/catalog-img/lepeshki.png'),
(89, 'Булочка Смак для хот-дога, 150г', 27.9, 5, 5, 9, 'img/catalog-img/smak.png'),
(90, 'Окорок куриные Перекрёсток охлаждённые, 1кг', 249.9, 5, 8, 10, 'img/catalog-img/okorok.png'),
(91, 'Сервелат варёно-копчёный Папа Может Финский, 420г', 299, 6, 21, 10, 'img/catalog-img/finskiy.png'),
(92, 'Колбаса сырокопчёная Черкизово Сальчичон в нарезке, 100г', 149.9, 5, 21, 10, 'img/catalog-img/salyami.png'),
(93, 'Бургер из говядины Мираторг охлаждённый, 200г', 149, 6, 5, 10, 'img/catalog-img/burger.png'),
(94, 'Хамон свиной Егорьевская сырокопчёный нарезка, 55г', 124.9, 5, 9, 10, 'img/catalog-img/becon.png'),
(95, 'Сосиски Вязанка Сливочные, 330г', 199.99, 4, 21, 10, 'img/catalog-img/slivushki.png'),
(96, 'Лопаточная часть говяжья Перекрёсток без кости', 639.9, 5, 5, 10, 'img/catalog-img/lopatka.png'),
(97, 'Карбонад Великолукский МК Славянский копчёно-варёный, 300г', 229, 6, 21, 10, 'img/catalog-img/carbonad.png'),
(98, 'Окорок свиной Перекрёсток задний', 309, 4, 21, 10, 'img/catalog-img/pig.png'),
(99, 'Стейк говяжий Мираторг Классик охлаждённый, 340г', 349, 8, 3, 10, 'img/catalog-img/steak.png'),
(100, 'Фарш говяжий Мираторг Black Angus охлаждённый категория Б, 400г', 229, 6, 7, 10, 'img/catalog-img/farsh.png'),
(101, 'Креветки королевские 50/70 замороженные', 659, 6, 8, 11, 'img/catalog-img/krevetki.png'),
(102, 'Минтай Новый Океан филе без кожи замороженное, 600г', 299, 4, 21, 11, 'img/catalog-img/mintay.png'),
(103, 'Икра Балтийский Берег имитированная лососёвая, 220г', 114.9, 6, 21, 11, 'img/catalog-img/ikra.png'),
(104, 'Сёмга филе на коже охлаждённое, 1кг', 1599, 7, 4, 11, 'img/catalog-img/semga-file.png'),
(105, 'Стейк из семги из замороженного сырья 1кг', 1190, 6, 6, 11, 'img/catalog-img/semga-steak.png'),
(106, 'Кальмар командорский Polar замороженный филе, 500г', 339, 8, 7, 11, 'img/catalog-img/kalmar.png'),
(107, 'Тунец Новый Океан скипджек филе-кусок, 185г', 134.9, 6, 21, 11, 'img/catalog-img/tunec.png'),
(108, 'Салака балтийская Leor холодного копчения неразделанная, 300г', 129.9, 7, 11, 11, 'img/catalog-img/salaka.png'),
(109, 'Крабовые палочки Vici Снежный краб, 200г', 269, 4, 21, 11, 'img/catalog-img/vici.png'),
(110, 'Крабовые палочки Меридиан охлаждённые, 200г', 144.9, 4, 21, 11, 'img/catalog-img/meridian.png'),
(111, 'Чебупели Горячая Штучка ветчина и сыр, 300г', 144.9, 6, 4, 12, 'img/catalog-img/chebupeli.png'),
(112, 'Тесто слоёное Звёздное бездрожжевое, 500г', 83.9, 3, 21, 12, 'img/catalog-img/testo.png'),
(113, 'Смесь овощная Hortex Брокколи и цветная быстрозамороженная, 400г', 124.9, 7, 5, 12, 'img/catalog-img/hortex.png'),
(114, 'Смесь овощная Vитамин Овощи-гриль с итальянскими травами быстрозамороженная, 400г', 174.9, 7, 3, 12, 'img/catalog-img/vitamin.png'),
(115, 'Пельмени Горячая Штучка Бульмени с говядиной и свининой, 900г', 279, 7, 21, 12, 'img/catalog-img/bulmeni.png'),
(116, 'Блины С Пылу с Жару с творогом, 360г', 109.9, 6, 7, 12, 'img/catalog-img/blini.png'),
(117, 'Тесто слоёное Просто дрожжевое, 500г', 59.9, 6, 21, 12, 'img/catalog-img/sloenoe.png'),
(118, 'Чебупицца Горячая Штучка Курочка по-итальянски, 250г', 164.9, 3, 5, 12, 'img/catalog-img/chebupizza.png'),
(119, 'Кетчуп Heinz Итальянский первая категория, 320г', 109.9, 7, 8, 13, 'img/catalog-img/heinz.png'),
(120, 'Майонез Слобода оливковый 67%, 400мл', 109.9, 3, 21, 13, 'img/catalog-img/sloboda.png'),
(121, 'Майонез Ряба Провансаль 67%, 744г', 189.9, 7, 6, 13, 'img/catalog-img/ryaba.png'),
(122, 'Соус Mr. Ricco Бургер со вкусом сладкой паприки, 310г', 104.9, 2, 3, 13, 'img/catalog-img/ricco-burger.png'),
(123, 'Соус Mr. Ricco сырный с изысканными сортами сыра, 310г', 95.9, 4, 1, 13, 'img/catalog-img/ricco-sirniy.png'),
(124, 'Уксус КомисКом столовый 9%, 500мл', 29.9, 8, 21, 13, 'img/catalog-img/comiscom.png'),
(125, 'Уксус рисовый Sen Soy для суши 3%, 220мл', 114.9, 4, 5, 13, 'img/catalog-img/sensoy.png'),
(126, 'Горчица Kamis Французкая, 185г', 139.9, 4, 21, 13, 'img/catalog-img/kamis.png'),
(127, 'Томатная паста Помидорка, 140г', 91.9, 5, 2, 13, 'img/catalog-img/pomidorka.png'),
(128, 'Кетчуп Heinz Итальянский первая категория, 320г', 109.9, 8, 21, 13, 'img/catalog-img/heinz.png'),
(129, 'Булгур Увелка Dinner Express с киноа готовый, 250г', 91.9, 6, 3, 15, 'img/catalog-img/express.png'),
(130, 'Лапша Чан Рамен Корейская быстрого приготовления с приправами, 120г', 59.9, 3, 4, 15, 'img/catalog-img/chanramen.png'),
(131, 'Суп Knorr сырный с сухариками, 15.6г', 21.9, 7, 21, 15, 'img/catalog-img/knor.png'),
(132, 'Пюре Роллтон картофельное с куриным вкусом, 40г', 39.9, 6, 6, 15, 'img/catalog-img/rolton-pure.png'),
(133, 'Гуляш Домашнее Бистро из говядины с гречей, 75г', 71.9, 4, 21, 15, 'img/catalog-img/gulyash.png'),
(134, 'Лапша Доширак Квисти быстрого приготовления со вкусом курицы, 70г', 21.9, 4, 4, 15, 'img/catalog-img/doshirak.png'),
(135, 'Пюре Биг Ланч картофельное с кусочками куриного филе, 110г', 77.9, 2, 21, 15, 'img/catalog-img/biglanch.png'),
(136, 'Каштаны Вкусы Мира запечённые очищенные, 80г', 134.9, 7, 4, 16, 'img/catalog-img/kashtani.png'),
(137, 'Грецкий орех Маркет Перекрёсток, 134г', 229, 6, 21, 16, 'img/catalog-img/grezkiy.png'),
(138, 'Кешью Маркет Перекрёсток, 130г', 279.9, 6, 5, 16, 'img/catalog-img/keshu.png'),
(139, 'Фисташки Просто солёные обжаренные, 100г', 109.9, 2, 5, 16, 'img/catalog-img/fistashki.png'),
(140, 'Арахис Просто солёный обжаренный очищенный, 200г', 69.9, 6, 21, 16, 'img/catalog-img/arahis.png'),
(141, 'Миндаль Просто сладкий обжаренный, 100г', 109.9, 6, 8, 16, 'img/catalog-img/mindal.png'),
(142, 'Джин Barrister Pink 40%, 700мл', 779, 7, 6, 18, 'img/catalog-img/barrister.png'),
(143, 'Текила Olmeca Голд Супремо 38%, 700мл', 1799, 2, 21, 18, 'img/catalog-img/olmeca.png'),
(144, 'Ром Captain Morgan Спайсд голд пряный золотой 35%, 700мл', 1199, 6, 2, 18, 'img/catalog-img/captain.png'),
(145, 'Вино Espiritu de Chile Sauvignon Blanc белое полусладкое 0,75л, 12%', 699, 2, 10, 18, 'img/catalog-img/espiritu.png'),
(146, 'Виски William Lawsons 40%, 500мл', 749.9, 6, 21, 18, 'img/catalog-img/william.png'),
(147, 'Вино La Casada Pinot Grigio Delle Venezie DOC белое сухое 0,75л, 13%', 599.9, 5, 5, 18, 'img/catalog-img/grigio.png');

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
(15, 3, '2021-12-02', 13, 8, 5),
(16, 5, '2021-11-25', 13, 16, 18),
(17, 1, '2021-12-02', 13, 37, 4),
(18, 4, '2021-12-10', 13, 56, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_value` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`role_id`, `role_value`) VALUES
(1, 1),
(2, 2);

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
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role_id`) VALUES
(13, 'алексей', 'skochkov.aleksey@yandex.ru', '$2y$10$DJMUv9TJBiYPw0dVbGS.X.TRXgPR9bg4MCRJdJIOG4VT1HcYWB.a6', 1);

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
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=357;

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
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
