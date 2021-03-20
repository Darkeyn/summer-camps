-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 20 2021 г., 12:17
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd_lager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bron`
--

CREATE TABLE `bron` (
  `Id` int(11) NOT NULL,
  `Name_lager` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pochta_rod` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name_reb` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Sum` int(11) NOT NULL,
  `Id_rod` int(11) NOT NULL,
  `Id_lager` int(11) NOT NULL,
  `Id_reb` int(11) NOT NULL,
  `Smena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `lager`
--

CREATE TABLE `lager` (
  `Id` int(11) NOT NULL,
  `Id_smena` int(11) NOT NULL,
  `Name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adress` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `About` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Url` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Stoim` int(11) NOT NULL,
  `Places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lager`
--

INSERT INTO `lager` (`Id`, `Id_smena`, `Name`, `Adress`, `Phone`, `About`, `Url`, `Stoim`, `Places`) VALUES
(1, 2, 'Дозорный', 'Россия, Краснодарский край, Туапсинский район, посёлок городского типа Новомихайловский', '78616791179', 'Детский лагерь «Дозорный» – единственная в мире детская пограничная застава, приступившая к охране государственной границы 18 мая 1972 года.', 'dozor.php', 25000, 250),
(2, 3, 'Комсомольский', 'Россия, Краснодарский край, Туапсинский район, посёлок городского типа Новомихайловский', '78616791268', '«Комсомольский» - детский лагерь с большой историей, он был открыт 30 мая 1966 году, работает в летний период и принимает ребят в смену.', 'kom.php', 20000, 2),
(3, 1, 'Солнышко', 'Россия, Ростовская область, Семикаракорский район', '78616791293', '«Солнышко» - детский оздоровительный лагерь для детей младшего школьного возраста. Впервые он открыл свои двери для ребят в 1992 году.', 'sol.php', 15000, 152);

-- --------------------------------------------------------

--
-- Структура таблицы `otzyv`
--

CREATE TABLE `otzyv` (
  `Id` int(11) NOT NULL,
  `Pochta_rod` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Tema` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `otzyv`
--

INSERT INTO `otzyv` (`Id`, `Pochta_rod`, `Tema`, `Message`, `Id_user`) VALUES
(3, 'tchebanov.ilya@yandex.ru', 'Лагерь', 'Отзыв', 1),
(4, 'ol.ol@ya.ru', 'Лагерь', 'Лагерь', 3),
(5, 'van.van@y.ru', 'Отзыв', 'Отзыв', 2),
(6, 'tchebanov.ilya@yandex.ru', 'Лагерь', 'Все прекрасно!', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reb`
--

CREATE TABLE `reb` (
  `Id` int(11) NOT NULL,
  `Pochta_rod` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `Id_rod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `rod`
--

CREATE TABLE `rod` (
  `Id` int(11) NOT NULL,
  `Pochta_rod` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `smena`
--

CREATE TABLE `smena` (
  `Id` int(11) NOT NULL,
  `Date_nach` date NOT NULL,
  `Date_okonch` date NOT NULL,
  `Places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `smena`
--

INSERT INTO `smena` (`Id`, `Date_nach`, `Date_okonch`, `Places`) VALUES
(1, '2021-06-03', '2021-06-27', 0),
(2, '2021-07-03', '2021-07-27', 247),
(3, '2021-08-03', '2021-08-27', 250),
(4, '2021-06-03', '2021-06-27', 150),
(5, '2021-07-03', '2021-07-27', 149),
(6, '2021-08-03', '2021-08-27', 150),
(7, '2021-06-03', '2021-06-27', 100),
(8, '2021-07-03', '2021-07-27', 100),
(9, '2021-08-03', '2021-08-27', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Prava` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`Id`, `Login`, `Password`, `Name`, `Prava`) VALUES
(1, 'tchebanov.ilya@yandex.ru', '8aa99b1f439ff71293e95357bac6fd94', 'Илья', 'Admin'),
(2, 'van.van@y.ru', '25d55ad283aa400af464c76d713c07ad', 'Ваня', 'User'),
(3, 'ol.ol@ya.ru', '25f9e794323b453885f5181f1b624d0b', 'Олег', 'Admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bron`
--
ALTER TABLE `bron`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_lager` (`Name_lager`),
  ADD KEY `Id_reb` (`Name_reb`),
  ADD KEY `Id_lager_2` (`Id_lager`),
  ADD KEY `Id_reb_2` (`Id_reb`),
  ADD KEY `Id_rod` (`Id_rod`);

--
-- Индексы таблицы `lager`
--
ALTER TABLE `lager`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_smena` (`Id_smena`);

--
-- Индексы таблицы `otzyv`
--
ALTER TABLE `otzyv`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Индексы таблицы `reb`
--
ALTER TABLE `reb`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_rod` (`Pochta_rod`),
  ADD KEY `Id_rod_2` (`Id_rod`);

--
-- Индексы таблицы `rod`
--
ALTER TABLE `rod`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_user` (`Id_user`);

--
-- Индексы таблицы `smena`
--
ALTER TABLE `smena`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bron`
--
ALTER TABLE `bron`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `lager`
--
ALTER TABLE `lager`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `otzyv`
--
ALTER TABLE `otzyv`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `reb`
--
ALTER TABLE `reb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `rod`
--
ALTER TABLE `rod`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `smena`
--
ALTER TABLE `smena`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `lager`
--
ALTER TABLE `lager`
  ADD CONSTRAINT `lager_ibfk_1` FOREIGN KEY (`Id_smena`) REFERENCES `smena` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
