-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 16 2020 г., 10:16
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `author`, `text`, `id_product`, `date`) VALUES
(1, 'Пётр', 'Отличный товар!', 1, '0000-00-00 00:00:00'),
(4, 'Василий', 'Хорошо', 1, '2020-04-06 17:46:00'),
(5, 'Нина', 'олдолдолд', 1, '2020-04-06 18:22:00'),
(6, 'Гена', 'сммитьить', 5, '2020-04-06 18:23:00'),
(7, 'Венера', 'Отличное платье для лета!', 5, '2020-04-06 19:14:00'),
(8, 'Катерина', 'Не очень!', 5, '2020-04-06 19:24:00'),
(9, 'Дана', 'Хороший подарок! Но не долговечная вещь.', 2, '2020-04-06 19:45:00'),
(10, 'Элла', 'Круть!', 0, '2020-04-08 15:49:00'),
(11, 'Василий', 'gjhghjghj', 4, '2020-04-08 16:02:00'),
(12, 'ghjghj', 'ghjgjghj', 1, '2020-04-08 16:02:00'),
(13, '1234Log', 'fghjkjk', 4, '2020-04-08 16:12:00'),
(14, 'Динара', 'Я не куплю такое', 4, '2020-04-08 16:13:00'),
(15, 'Пётр', 'Хочу ,хочу, хочу', 3, '2020-04-08 16:21:00'),
(16, 'Колик', 'У моего брата такая ему нравится', 3, '2020-04-08 16:32:00'),
(17, 'Валентин', 'Купил жене. довольна.', 5, '2020-04-10 11:53:00'),
(18, 'Горан', 'Good!', 11, '2020-04-16 10:08:00');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `width` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `views` int(200) DEFAULT NULL COMMENT 'Число просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `file_name`, `width`, `product_name`, `price`, `views`) VALUES
(1, 'Card-1.jpg', 252, 'T-shirt', 400, 42),
(2, 'Card-2.jpg', 252, 'Pink sleeveless blouse', 1000, 44),
(3, 'Card-3.jpg', 252, 'Jacket bolognese blue', 1200, 38),
(4, 'Card-4.jpg', 252, 'Flower dress', 1020, 38),
(5, 'Card-5.jpg', 252, 'Sleeveless blouse with black and white stripes', 900, 51),
(11, 'Card-6.jpg', 252, 'Men\'s suit silver', 700, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(180) NOT NULL,
  `user_id` int(180) NOT NULL,
  `adress` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) DEFAULT 'Предварительная обработка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `adress`, `date`, `status`) VALUES
(17, 7, '234536, г. Москва, ул. Петрова, д. 12, кв. 9.', '2020-04-13 19:43:00', 'Ожидание оплаты'),
(18, 9, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-04-13 19:48:00', 'Сборка'),
(21, 9, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-04-13 21:30:00', 'Предварительная обработка'),
(23, 7, '234536, г. Москва, ул. Петрова, д. 12, кв. 9.', '2020-04-13 21:45:00', 'Предварительная обработка'),
(24, 11, '342178, Орловская обл., г. Ливны, ул. Менделя, д. 22, кв. 9.', '2020-04-16 10:13:00', 'Предварительная обработка');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `good_id` int(20) NOT NULL,
  `count` int(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `good_id`, `count`, `price`) VALUES
(1, 17, 5, 1, 900),
(2, 17, 4, 2, 1020),
(3, 18, 3, 2, 1200),
(4, 18, 1, 2, 400),
(5, 21, 5, 2, 900),
(6, 21, 4, 1, 1020),
(7, 21, 1, 1, 400),
(8, 23, 1, 1, 400),
(9, 23, 3, 1, 1200),
(10, 23, 2, 3, 1000),
(11, 24, 11, 2, 700),
(12, 24, 4, 1, 1020);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` varchar(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `is_admin`, `name`, `login`, `password`, `date`) VALUES
(7, NULL, 'Валентин', 'Valik', '$2y$10$RMK4Q0NW8ew13VofN7f88ue62ox9XlIVukRobVM/P3sWxPKQ6FMCe', '1966-04-26 00:00:00'),
(9, NULL, 'Юлий', 'Yulik', '$2y$10$bywuG6Xs9zNWIrsUvcMbEuOHbxsS2xR9XZojI2GaEr20jrOjLG0Cu', '1999-07-23 00:00:00'),
(10, 'admin', 'Viktor Alikin', 'admin', '$2y$10$TOzEdE.9JbWx/G1PfgiueO94iGYGJcYjKxVb9N/HPQCZi8rMU7aSW', '2020-04-16 00:00:00'),
(11, NULL, 'Зосим', 'Zosik', '$2y$10$f9mZRDzdeKqaGon4RYSBk.msFvYqlHZ/G.jZtts0QbtktCVl3Of0K', '1988-07-29 00:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(180) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
