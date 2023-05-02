-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Май 02 2023 г., 20:26
-- Версия сервера: 5.7.39
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ooppart1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categoryName` text NOT NULL,
  `liname` text NOT NULL,
  `liprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `categoryName`, `liname`, `liprice`) VALUES
(12, 'qw', 'eerg', 23),
(14, '123', 'ewrgeg', 135),
(15, 'herth', 'ewrgeg', 135),
(16, 'ger', 'ewrgeg', 135),
(17, 'rth', 'jtyj', 456),
(18, 'eyr', 'rth', 567),
(19, 'rter', 'rth', 567),
(20, 'eyru', 'rth', 567),
(21, 'shttruty', 'rth', 567),
(22, 'qwerty', 'rth', 567),
(23, 'werty', 'jnkjj', 45),
(24, 'werty', 'hrttyj', 4564),
(25, 'werty', 'jlgk', 678),
(26, 'werty', 'hyj', 456),
(27, 'werty', 'rghdh', 235),
(28, 'qw', 'eerg', 5645),
(29, 'qw', 'ngfhn', 345);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
