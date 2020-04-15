-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 11 2020 г., 16:34
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
-- База данных: `library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id_author` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id_author`, `name`) VALUES
(1, 'Ivanov'),
(2, 'Smirnov'),
(3, 'Sobolev'),
(4, 'Alekseev'),
(5, 'Makarov'),
(6, 'Aleshkin'),
(7, 'Pugachev');

-- --------------------------------------------------------

--
-- Структура таблицы `book_authors`
--

CREATE TABLE `book_authors` (
  `fid_book` int(11) NOT NULL,
  `fid_authors` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `book_authors`
--

INSERT INTO `book_authors` (`fid_book`, `fid_authors`) VALUES
(101, 1),
(101, 2),
(102, 5),
(103, 5),
(103, 4),
(110, 4),
(110, 3),
(111, 3),
(112, 5),
(113, 2),
(114, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `literature`
--

CREATE TABLE `literature` (
  `id_book` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `publisher` varchar(300) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `isbn` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `fid_resource` int(11) DEFAULT NULL,
  `literate` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `literature`
--

INSERT INTO `literature` (`id_book`, `name`, `date`, `year`, `publisher`, `quantity`, `isbn`, `number`, `fid_resource`, `literate`) VALUES
(101, 'Love story', NULL, 2015, 'Odyssey', 500, 12345, NULL, 1, 'Book'),
(102, 'Offer of the year', NULL, 2010, 'The Globe', 299, 12354, NULL, 1, 'Book'),
(103, 'Public relations', NULL, 2019, 'Factor', 350, 54321, NULL, 1, 'Book'),
(104, 'Ukrainian truth', NULL, 2019, NULL, NULL, NULL, 10000, 2, 'Political journal'),
(105, 'Semon', NULL, 2015, NULL, NULL, NULL, 10050, 2, 'Information journal'),
(106, 'Pink', NULL, 2020, NULL, NULL, NULL, 10010, 2, 'Fashion journal'),
(107, 'Courier', '2019-05-15', NULL, NULL, NULL, NULL, NULL, 3, 'Newspaper'),
(108, 'Digest', '2015-03-14', NULL, NULL, NULL, NULL, NULL, 3, 'Newspaper'),
(109, 'Quantum', '2019-03-02', NULL, NULL, NULL, NULL, NULL, 3, 'Physics newspaper'),
(110, 'Fantastic adventures', NULL, 2017, 'Odyssey', 450, 13245, NULL, 1, 'Interesting book'),
(111, 'Best friend', NULL, 2015, 'Odyssey', 150, 14235, NULL, 1, 'Book'),
(112, 'Unknown', NULL, 2020, 'Odyssey', 399, 12354, NULL, 1, 'Book'),
(113, 'Blach hole', NULL, 2016, 'The Globe', 125, 53214, NULL, 1, 'Book'),
(114, 'The Mirror', NULL, 2008, 'New Time', 799, 12543, NULL, 1, 'Horror Book'),
(115, 'Garden', '2000-05-15', NULL, NULL, NULL, NULL, NULL, 3, 'Garden newspaper');

-- --------------------------------------------------------

--
-- Структура таблицы `resource`
--

CREATE TABLE `resource` (
  `id_resource` int(11) NOT NULL,
  `title` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `resource`
--

INSERT INTO `resource` (`id_resource`, `title`) VALUES
(1, 'Book'),
(2, 'Journal'),
(3, 'Newspaper');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id_author`);

--
-- Индексы таблицы `book_authors`
--
ALTER TABLE `book_authors`
  ADD KEY `a1` (`fid_book`),
  ADD KEY `a2` (`fid_authors`);

--
-- Индексы таблицы `literature`
--
ALTER TABLE `literature`
  ADD PRIMARY KEY (`id_book`),
  ADD KEY `a3` (`fid_resource`);

--
-- Индексы таблицы `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id_resource`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `literature`
--
ALTER TABLE `literature`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `a1` FOREIGN KEY (`fid_book`) REFERENCES `literature` (`id_book`),
  ADD CONSTRAINT `a2` FOREIGN KEY (`fid_authors`) REFERENCES `authors` (`id_author`);

--
-- Ограничения внешнего ключа таблицы `literature`
--
ALTER TABLE `literature`
  ADD CONSTRAINT `a3` FOREIGN KEY (`fid_resource`) REFERENCES `resource` (`id_resource`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
