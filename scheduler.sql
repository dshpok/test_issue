-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 24 2017 г., 15:25
-- Версия сервера: 5.5.45-log
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `scheduler`
--
CREATE DATABASE IF NOT EXISTS `scheduler` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `scheduler`;

-- --------------------------------------------------------

--
-- Структура таблицы `schedulers`
--

DROP TABLE IF EXISTS `schedulers`;
CREATE TABLE IF NOT EXISTS `schedulers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `date_start` timestamp NULL DEFAULT NULL,
  `is_done` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`),
  KEY `users_id` (`users_id`),
  KEY `date_start` (`date_start`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Очистить таблицу перед добавлением данных `schedulers`
--

TRUNCATE TABLE `schedulers`;
--
-- Дамп данных таблицы `schedulers`
--

INSERT INTO `schedulers` (`id`, `users_id`, `title`, `body`, `date_start`, `is_done`, `created_at`) VALUES
(5, 2, 'qqqq', 'qqqq', '2017-07-27 21:00:00', 0, '2017-07-23 20:09:39'),
(6, 2, 'sec edit', 'sec\n\ncccc', '2017-07-27 21:00:00', 0, '2017-07-23 20:31:33'),
(7, 2, 'third edit', 'third', '2017-07-27 21:00:00', 1, '2017-07-23 20:34:29'),
(24, 3, 'second edit new', 'sjcdbbdzfjkbjk', '2017-07-28 21:00:00', 1, '2017-07-24 10:00:26'),
(25, 3, 'new', 'jbjkbjhjhjh', '2017-07-28 21:00:00', 0, '2017-07-24 10:01:22'),
(26, 3, 'Fourht', 'HHHH jjkdhjdhjdr', '2017-07-23 21:00:00', 0, '2017-07-24 10:25:57'),
(27, 3, '26', 'hnkjkjjk', '2017-07-25 21:00:00', 0, '2017-07-24 10:27:12'),
(29, 3, 'new', 'ghfhgfgh\nkjkj', '2017-07-25 09:44:00', 0, '2017-07-24 10:36:28'),
(30, 3, '1246', 'bhjbjhb', '2017-07-25 10:47:00', 0, '2017-07-24 10:37:37'),
(31, 3, '22', '222', '2017-07-24 11:18:00', 0, '2017-07-24 11:15:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Очистить таблицу перед добавлением данных `users`
--

TRUNCATE TABLE `users`;
--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'ss@ss.ss', '$2y$10$7BYVZeus0bYLZm6SlTLsX.71Phd3e0RqjUo0HYTmDZZFnXc0xILga', '2017-07-23 16:55:33'),
(2, 's1@ss.ss', '$2y$10$9S4twSaPshPhzZD8HgzZ..sfAq1a0EOmB7gPT0QNrph9ynaVhIX5q', '2017-07-23 17:06:37'),
(3, 'aa@aa.aa', '$2y$10$iix6xaXaGV26JPSXinGyUulJAsAvMVNPj28m7V7GoKyK5hs15/tuq', '2017-07-24 09:54:04');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
