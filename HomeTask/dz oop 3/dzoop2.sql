-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Май 29 2023 г., 09:40
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dzoop2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categories` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `categories`) VALUES
(8, 'Phone'),
(9, 'Monitor'),
(11, 'Phone'),
(12, 'Phone'),
(13, 'Phone'),
(14, 'Phone'),
(15, 'Phone'),
(16, 'Phone'),
(17, 'Phone'),
(18, 'Phone'),
(19, 'Phone'),
(20, 'Phone'),
(21, 'Phone'),
(22, 'Phone'),
(23, 'Monitor'),
(24, 'Monitor'),
(25, 'Monitor'),
(26, 'Monitor'),
(27, 'Monitor'),
(28, 'Monitor'),
(29, 'Monitor'),
(30, 'Monitor'),
(31, 'Monitor'),
(32, 'Monitor'),
(33, 'Monitor'),
(34, 'Monitor'),
(35, 'Monitor'),
(36, 'Monitor');

-- --------------------------------------------------------

--
-- Структура таблицы `monitors`
--

CREATE TABLE `monitors` (
  `id` int(11) NOT NULL,
  `categories` text,
  `name` text,
  `price` int(11) DEFAULT NULL,
  `diagonal` int(11) DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `monitors`
--

INSERT INTO `monitors` (`id`, `categories`, `name`, `price`, `diagonal`, `frequency`) VALUES
(9, 'Monitor', 'Hisense', 53799, 55, 120),
(23, 'Monitor', 'Sony', 300, 35, 60),
(24, 'Monitor', 'Sony', 400, 45, 120),
(25, 'Monitor', 'Sony', 500, 55, 240),
(26, 'Monitor', 'LG', 300, 35, 60),
(27, 'Monitor', 'LG', 400, 45, 120),
(28, 'Monitor', 'LG', 500, 55, 240),
(29, 'Monitor', 'Haier', 300, 35, 60),
(30, 'Monitor', 'Haier', 400, 45, 120),
(31, 'Monitor', 'Haier', 500, 55, 240),
(32, 'Monitor', 'Hisense', 300, 35, 60),
(33, 'Monitor', 'Hisense', 400, 45, 120),
(34, 'Monitor', 'Hisense', 500, 55, 240),
(35, 'Monitor', 'JVC', 300, 35, 60),
(36, 'Monitor', 'JVC', 400, 45, 120),
(38, 'Monitor', 'telepuz', 67846, 34, 54645),
(39, 'Monitor', 'brak', -1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `phones`
--

CREATE TABLE `phones` (
  `id` int(11) NOT NULL,
  `categories` text,
  `name` text,
  `price` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `countsim` int(11) DEFAULT NULL,
  `hdd` int(11) DEFAULT NULL,
  `os` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `phones`
--

INSERT INTO `phones` (`id`, `categories`, `name`, `price`, `ram`, `countsim`, `hdd`, `os`) VALUES
(8, 'Phone', 'iPhone Xs MAX', 456, 45, 456, 456, '654'),
(11, 'Phone', 'iPhone', 300, 2, 1, 128, 'iOS'),
(12, 'Phone', 'iPhone', 400, 4, 2, 256, 'iOS'),
(13, 'Phone', 'iPhone', 500, 3, 1, 512, 'iOS'),
(14, 'Phone', 'Samsung', 300, 4, 2, 128, 'Android'),
(15, 'Phone', 'Samsung', 400, 2, 1, 256, 'Android'),
(16, 'Phone', 'Samsung', 500, 3, 2, 512, 'Android'),
(17, 'Phone', 'Xiaomi', 300, 4, 2, 128, 'Android'),
(18, 'Phone', 'Xiaomi', 400, 2, 1, 256, 'Android'),
(19, 'Phone', 'Xiaomi', 500, 3, 2, 512, 'Android'),
(20, 'Phone', 'Huawei', 300, 4, 1, 128, 'Android'),
(21, 'Phone', 'Huawei', 400, 2, 2, 256, 'Android'),
(22, 'Phone', 'Huawei', 500, 3, 1, 512, 'Android'),
(37, 'Phone', 'myfoon', 77777, 88, 7, 8184, 'fun');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `monitors`
--
ALTER TABLE `monitors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `monitors`
--
ALTER TABLE `monitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
