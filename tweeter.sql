-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 14 Kwi 2017, 23:01
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
  `creationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Tweets`
--

INSERT INTO `Tweets` (`id`, `userId`, `text`, `creationDate`) VALUES
(1, 1, 'Lorem ipsum ipsum lorem dolores majonez', '2017-04-14'),
(2, 1, 'lorem ipsum2', '2017-04-13'),
(3, 2, 'lorem ipsum3', '2017-04-13');

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
-- AUTO_INCREMENT dla tabeli `Msgs`
--
ALTER TABLE `Msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
