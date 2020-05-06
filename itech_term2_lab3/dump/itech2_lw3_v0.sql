-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 05 2020 г., 18:34
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `itech2_lw3_v0`
--
CREATE DATABASE IF NOT EXISTS `itech2_lw3_v0` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `itech2_lw3_v0`;

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `ID_Author` int(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`ID_Author`, `name`) VALUES
(170, 'Dale Carnegie'),
(171, 'Napoleon Hill');

-- --------------------------------------------------------

--
-- Структура таблицы `book_author`
--

CREATE TABLE `book_author` (
  `FID_Book` int(20) DEFAULT NULL,
  `FID_Author` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_author`
--

INSERT INTO `book_author` (`FID_Book`, `FID_Author`) VALUES
(11, 170),
(12, 170),
(13, 171);

-- --------------------------------------------------------

--
-- Структура таблицы `literature`
--

CREATE TABLE `literature` (
  `ID_Literature` int(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `ISBN` varchar(50) DEFAULT NULL,
  `number` varchar(100) DEFAULT NULL,
  `pagesCount` int(10) DEFAULT NULL,
  `literate` enum('Book','Magazine','Newspaper') DEFAULT NULL,
  `FID_Resourse` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `literature`
--

INSERT INTO `literature` (`ID_Literature`, `name`, `date`, `year`, `publisher`, `ISBN`, `number`, `pagesCount`, `literate`, `FID_Resourse`) VALUES
(11, 'The Quick and Easy Way to Effective Speaking', NULL, 1990, 'Pocket books', '978-0671724009', NULL, 224, 'Book', NULL),
(12, 'How to Stop Worrying and Start Living', NULL, 1990, 'Pocket books', '978-0671733353', NULL, 352, 'Book', NULL),
(13, 'The Law of Success : In Sixteen Lessons', NULL, 2011, 'Wilder Publications', '978-1617201769', NULL, 548, 'Book', NULL),
(110, 'NBA News', NULL, 2020, NULL, NULL, '197', NULL, 'Magazine', 201),
(111, 'NBA News', NULL, 2020, NULL, NULL, '202', NULL, 'Magazine', 202),
(1201, 'Time', '2020-01-20', 2020, NULL, NULL, NULL, NULL, 'Newspaper', NULL),
(1202, 'Time', '2020-01-27', 2020, NULL, NULL, NULL, NULL, 'Newspaper', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `resourse`
--

CREATE TABLE `resourse` (
  `ID_Resourse` int(10) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `resourse`
--

INSERT INTO `resourse` (`ID_Resourse`, `title`) VALUES
(201, 'Disk : NBA Final 1988 - Lakers vs. Pistons'),
(202, 'Disk : NBA Final 2010 - Lakers vs. Celtics');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`ID_Author`);

--
-- Индексы таблицы `book_author`
--
ALTER TABLE `book_author`
  ADD KEY `FID_Book` (`FID_Book`,`FID_Author`),
  ADD KEY `FID_Author` (`FID_Author`);

--
-- Индексы таблицы `literature`
--
ALTER TABLE `literature`
  ADD PRIMARY KEY (`ID_Literature`),
  ADD KEY `FID_Resourse` (`FID_Resourse`);

--
-- Индексы таблицы `resourse`
--
ALTER TABLE `resourse`
  ADD PRIMARY KEY (`ID_Resourse`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book_author`
--
ALTER TABLE `book_author`
  ADD CONSTRAINT `book_author_ibfk_1` FOREIGN KEY (`FID_Book`) REFERENCES `literature` (`ID_Literature`),
  ADD CONSTRAINT `book_author_ibfk_2` FOREIGN KEY (`FID_Author`) REFERENCES `authors` (`ID_Author`);

--
-- Ограничения внешнего ключа таблицы `literature`
--
ALTER TABLE `literature`
  ADD CONSTRAINT `literature_ibfk_1` FOREIGN KEY (`FID_Resourse`) REFERENCES `resourse` (`ID_Resourse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
