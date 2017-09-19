-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 19 2017 г., 23:40
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `abwby`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autos`
--

CREATE TABLE `autos` (
  `id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT '0',
  `date` timestamp NULL DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL,
  `country` varchar(50) DEFAULT '0',
  `mark` varchar(50) DEFAULT '0',
  `model` varchar(50) DEFAULT '0',
  `year` int(4) DEFAULT '0',
  `seller_city` varchar(50) DEFAULT '0',
  `seller_phone` varchar(50) DEFAULT '0',
  `price` float DEFAULT '0',
  `currency_type` varchar(10) DEFAULT '0',
  `displacement` int(10) DEFAULT '0',
  `run` int(10) DEFAULT '0',
  `run_metric` varchar(10) DEFAULT '0',
  `state` varchar(255) DEFAULT '0',
  `color` varchar(255) DEFAULT '0',
  `body_type` varchar(255) DEFAULT '0',
  `engine_type` varchar(255) DEFAULT '0',
  `gear_type` varchar(255) DEFAULT '0',
  `transmission` varchar(255) DEFAULT '0',
  `horse_power` int(10) DEFAULT '0',
  `additional_info` varchar(255) DEFAULT '0',
  `import_date` timestamp NULL DEFAULT NULL,
  `removed` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `auto_equipment`
--

CREATE TABLE `auto_equipment` (
  `auto_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `galleries`
--

CREATE TABLE `galleries` (
  `auto_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `URL` (`url`);

--
-- Индексы таблицы `auto_equipment`
--
ALTER TABLE `auto_equipment`
  ADD KEY `Индекс 1` (`auto_id`);

--
-- Индексы таблицы `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `equipment` (`name`);

--
-- Индексы таблицы `galleries`
--
ALTER TABLE `galleries`
  ADD KEY `Индекс 1` (`auto_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `autos`
--
ALTER TABLE `autos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
