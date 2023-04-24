-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Апр 16 2023 г., 23:31
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
-- База данных: `forma`
--

-- --------------------------------------------------------

--
-- Структура таблицы `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `userName` text,
  `userEmail` text,
  `userPassword` text,
  `userMessage` text,
  `gender` text,
  `agree` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forms`
--

INSERT INTO `forms` (`id`, `userName`, `userEmail`, `userPassword`, `userMessage`, `gender`, `agree`) VALUES
(7, 'rth', '', 'hty', 'hyj', 'men', 'on'),
(9, 'reger', '', '', '', 'women', 'on'),
(10, 'deha', '', '', '', 'women', 'on'),
(11, 'va', '', '', '', 'men', 'on'),
(12, 'mlk', '', '', '', 'men', 'on'),
(14, 'uilui', '', 'lji', 'l', 'women', ''),
(15, 'va', '', '', '', 'women', 'on'),
(16, 'va', '', '', '', 'women', 'on'),
(17, 'gerg', '', '', '', 'women', 'on'),
(18, 'rge', '', '', '', 'women', 'on'),
(20, 'htr', '', '', '', 'women', ''),
(21, 'ntyj', '', '', '', 'men', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `forms`
--
ALTER TABLE `forms`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
