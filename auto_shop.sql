-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 09 2017 г., 13:21
-- Версия сервера: 10.1.25-MariaDB-
-- Версия PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auto_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto`
--

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `auto`
--

INSERT INTO `auto` (`id`, `model_id`, `color`, `price`, `image`) VALUES
(1, 1, 'black', 1000, 'mc.png'),
(2, 2, 'white', 2000, 'me.png'),
(3, 3, 'black', 3000, 'ms.png'),
(4, 4, 'red', 5000, 'bmw6.png'),
(5, 5, 'blue', 4000, 'bmw5.png'),
(6, 6, 'blue', 5000, 'bmwi8.png'),
(7, 7, 'grey', 2000, 'vw_polo.png'),
(8, 8, 'white', 3000, 'vw_jetta.png'),
(9, 9, 'red', 4000, 'vw_passat.png'),
(10, 10, 'red', 1000, 'opel_astra.png'),
(11, 11, 'red', 1000, 'opel_corsa.png'),
(12, 12, 'red', 1000, 'opel_f.png');

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE `mark` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mark`
--

INSERT INTO `mark` (`id`, `name`, `image`) VALUES
(1, 'Mercedes-Benz', 'mercedes.png'),
(2, 'BMW', 'bmw.png'),
(3, 'Volkswagen', 'vw.png'),
(4, 'Opel', 'opel.png');

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `engine_capacity` int(11) NOT NULL,
  `max_speed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`id`, `mark_id`, `name`, `year`, `engine_capacity`, `max_speed`) VALUES
(1, 1, 'Mercedes-Benz C', 2017, 2, 250),
(2, 1, 'Mercedes-Benz E', 2016, 2, 300),
(3, 1, 'Mercedes-Benz S', 2015, 3, 250),
(4, 2, 'BMW M6', 2017, 2, 320),
(5, 2, 'BMW M5', 2016, 4, 330),
(6, 2, 'BMW I8', 2017, 3, 300),
(7, 3, 'Volkswagen Polo', 2012, 2, 220),
(8, 3, 'Volkswagen Jetta', 2013, 2, 300),
(9, 3, 'Volkswagen Passat', 2015, 3, 250),
(10, 4, 'Opel Astra', 2016, 2, 250),
(11, 4, 'Opel Corsa', 2016, 3, 250),
(12, 4, 'Opel Calibra', 2017, 3, 260);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `auto_id`, `user_id`, `payment_id`, `status`) VALUES
(25, 4, 1, 1, 0),
(26, 3, 1, 1, 0),
(27, 3, 3, 1, 0),
(28, 4, 3, 2, 1),
(29, 3, 7, 2, 0),
(30, 3, 7, 1, 0),
(31, 10, 3, 1, 0),
(32, 1, 3, 2, 1),
(33, 1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(1, 'Card'),
(2, 'Cash');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_create_at` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `token`, `token_create_at`, `created_at`) VALUES
(3, 'test', 'sfsd', 'leo@mail.ru', '$2y$10$qAJ3onzLf9dd1wPMEg8wNufRSyUhkOwTB4pqYya1h9UzX66YQEZFa', 'PK98RUIx46sUBjm9lcs68jhAo00AE0Fi', '1507548020', '2017-10-07 00:00:00'),
(5, 'yevhen', 'leo', 'leo2@mail.ru', '$2y$10$Lsx3QqcKZDJ7pkGidJsD4ePNVEYJOFlNQISn8hc.ZdU64V27cpeFu', '', '', '1507535389'),
(7, 'test', 'sfsd', 'test@test.com', '$2y$10$8cqo4MhwZOoFeYT69BqwIeI4.7nqQUyPPi6nKBNm9ZB.hYCPqf.3m', 'aKgV24JhTrG8YHsipAuh9o5BJSuavmkh', '1507532575', '1507536188');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `color` (`color`),
  ADD KEY `price` (`price`);

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `engine_capacity` (`engine_capacity`),
  ADD KEY `year` (`year`),
  ADD KEY `max_speed` (`max_speed`),
  ADD KEY `mark_id` (`mark_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_id` (`auto_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Индексы таблицы `payment_methods`
--
ALTER TABLE `payment_methods`
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
-- AUTO_INCREMENT для таблицы `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT для таблицы `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_fk1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`);

--
-- Ограничения внешнего ключа таблицы `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`mark_id`) REFERENCES `mark` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment_methods` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
