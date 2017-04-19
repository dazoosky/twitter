-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 19 Kwi 2017, 23:44
-- Wersja serwera: 5.7.17-0ubuntu0.16.04.2
-- Wersja PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tweeter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `tweetId` int(11) DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Comments`
--

INSERT INTO `Comments` (`id`, `tweetId`, `authorId`, `content`, `createDate`) VALUES
(1, 1, 1, 'Comment loremum ipsusum', '2017-04-18 00:00:00'),
(2, 1, 1, 'test comment 2', '2017-04-18 23:53:45'),
(3, 1, 2, 'test comment 3', '2017-04-18 23:59:56'),
(4, 1, 1, 'test comment 4', '2017-04-19 00:01:44'),
(5, 2, 1, 'test comment 2/1', '2017-04-19 00:03:10'),
(6, 2, 1, 'test comment 2/2', '2017-04-19 00:03:11'),
(7, 2, 1, 'test comment 2/3', '2017-04-19 00:03:11'),
(8, 3, 1, 'test comment 3/1', '2017-04-19 00:03:12'),
(9, 3, 2, 'test comment 3/2', '2017-04-19 00:03:12'),
(10, 3, 2, 'test comment 3/3', '2017-04-19 00:03:12'),
(12, 1, 1, 'new test comment for first post', '2017-04-19 23:18:33'),
(13, 1, 1, 'another test comment', '2017-04-19 23:29:24'),
(14, 1, 1, 'and another one', '2017-04-19 23:30:23'),
(15, 2, 1, 'New test comment 4/2 for post no. 2', '2017-04-19 23:33:24');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Msgs`
--

CREATE TABLE `Msgs` (
  `id` int(11) NOT NULL,
  `senderId` int(11) DEFAULT NULL,
  `recieverId` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sentDate` date DEFAULT NULL,
  `readStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Msgs`
--

INSERT INTO `Msgs` (`id`, `senderId`, `recieverId`, `content`, `sentDate`, `readStatus`) VALUES
(2, 1, 2, 'Przykladowa wiadomosc lorem ipsum', '2017-04-14', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweets`
--

CREATE TABLE `Tweets` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(120) NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Tweets`
--

INSERT INTO `Tweets` (`id`, `userId`, `text`, `creationDate`) VALUES
(1, 1, 'Lorem ipsum ipsum lorem dolores majonez', '2017-04-14 10:17:15'),
(2, 1, 'lorem ipsum2', '2017-04-13 04:15:00'),
(3, 2, 'lorem ipsum3', '2017-04-13 02:00:00'),
(5, 1, 'Tweet no comment', '2017-04-17 05:26:04');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash_pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `email`, `username`, `hash_pass`) VALUES
(1, 'abc@abc.pl', 'testuser0', '$2y$10$bo59x.I2Md9BGZvgWym3XO6T5CQIDvDjfAxElFJTeTUsNlIIYsz3u'),
(2, 'test2@abc.pl', 'testuser2', 'sdsdsd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `UsersInfo`
--

CREATE TABLE `UsersInfo` (
  `id` int(11) NOT NULL,
  `userId` int(255) NOT NULL,
  `aboutMe` varchar(255) NOT NULL,
  `age` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `UsersInfo`
--

INSERT INTO `UsersInfo` (`id`, `userId`, `aboutMe`, `age`) VALUES
(1, 1, 'Simple text about user 1', 20);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorId` (`authorId`),
  ADD KEY `tweetId` (`tweetId`);

--
-- Indexes for table `Msgs`
--
ALTER TABLE `Msgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `recieverId` (`recieverId`);

--
-- Indexes for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `UsersInfo`
--
ALTER TABLE `UsersInfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `Msgs`
--
ALTER TABLE `Msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `UsersInfo`
--
ALTER TABLE `UsersInfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`tweetId`) REFERENCES `Tweets` (`id`);

--
-- Ograniczenia dla tabeli `Msgs`
--
ALTER TABLE `Msgs`
  ADD CONSTRAINT `Msgs_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `Msgs_ibfk_2` FOREIGN KEY (`recieverId`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
