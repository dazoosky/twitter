-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 04 Maj 2017, 23:25
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
(15, 2, 1, 'New test comment 4/2 for post no. 2', '2017-04-19 23:33:24'),
(16, 1, 2, 'Comment by user 2', '2017-04-20 20:21:24'),
(17, 6, 1, 'Lorem ipsum mądrze mówisz!', '2017-04-20 20:37:27'),
(18, 6, 1, 'Wiadomo\r\n', '2017-04-24 19:31:03'),
(19, 7, 3, 'mea culpa!\r\n', '2017-04-24 21:55:59');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Msgs`
--

CREATE TABLE `Msgs` (
  `id` int(11) NOT NULL,
  `senderId` int(11) DEFAULT NULL,
  `receiverId` int(11) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sentDate` datetime DEFAULT NULL,
  `readStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Msgs`
--

INSERT INTO `Msgs` (`id`, `senderId`, `receiverId`, `content`, `sentDate`, `readStatus`) VALUES
(26, 1, 2, 'Lorem ipsum dolor sit amet magna. Fusce interdum. Donec quis orci. ', '2017-05-04 23:10:03', 0),
(27, 1, 3, 'Lorem ipsum dolor sit amet magna. Fusce interdum. Donec quis orci. ', '2017-05-04 23:10:05', 0),
(28, 1, 31, 'Lorem ipsum dolor sit amet magna. Fusce interdum. Donec quis orci. ', '2017-05-04 23:10:08', 0),
(29, 1, 32, 'Lorem ipsum dolor sit amet magna. Fusce interdum. Donec quis orci. ', '2017-05-04 23:10:10', 0),
(30, 2, 1, 'Ut sagittis ultricies. Donec facilisis dignissim eu, magna', '2017-05-04 23:10:31', 1),
(31, 2, 1, 'Ut sagittis ultricies. Donec facilisis dignissim eu, magna', '2017-05-04 23:10:34', 1),
(32, 2, 31, 'Ut sagittis ultricies. Donec facilisis dignissim eu, magna', '2017-05-04 23:10:41', 0),
(33, 2, 32, 'Ut sagittis ultricies. Donec facilisis dignissim eu, magna', '2017-05-04 23:10:43', 0),
(34, 2, 3, 'Ut sagittis ultricies. Donec facilisis dignissim eu, magna', '2017-05-04 23:10:45', 0),
(35, 32, 3, 'Curabitur adipiscing wisi a pellentesque sed, dapibus a, sollicitudin ac, felis.', '2017-05-04 23:11:00', 0),
(36, 32, 2, 'Curabitur adipiscing wisi a pellentesque sed, dapibus a, sollicitudin ac, felis.', '2017-05-04 23:11:03', 0),
(37, 32, 1, 'Curabitur adipiscing wisi a pellentesque sed, dapibus a, sollicitudin ac, felis.', '2017-05-04 23:11:05', 1),
(38, 32, 1, 'Curabitur adipiscing wisi a pellentesque sed, dapibus a, sollicitudin ac, felis.', '2017-05-04 23:11:06', 1),
(39, 32, 3, 'Curabitur adipiscing wisi a pellentesque sed, dapibus a, sollicitudin ac, felis.', '2017-05-04 23:11:08', 0);

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
(5, 1, 'Tweet no comment', '2017-04-17 05:26:04'),
(6, 2, 'Tweet dodany za pośrednictwem strony ', '2017-04-20 20:34:25'),
(7, 3, 'Tweeted by testuser3', '2017-04-24 21:55:49');

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
(2, 'test2@abc.pl', 'testuser2', '$2y$10$bo59x.I2Md9BGZvgWym3XO6T5CQIDvDjfAxElFJTeTUsNlIIYsz3u'),
(3, 'test3@abc.pl', 'testuser3', '$2y$10$GMv/fxnaDzhvqNoX6BiuLe7rlxO5cTFFDXQtSqz2mqMjADnn2T1Bq'),
(31, 'testuser4@abc.pl', 'testuser4', '$2y$10$udoqHCCtXO5Z9BnzBrYbWe2cS2.jdFn1MlQ2Fk8h49GJ64Ua9cq9m'),
(32, 'test5@abc.pl', 'testuser5', '$2y$10$i1DK.B4avK8EBf5g9YCA8.WSh6.bjqHtWMN9QuPzNEqzlvqT/O1j6');

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
  ADD KEY `recieverId` (`receiverId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT dla tabeli `Msgs`
--
ALTER TABLE `Msgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
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
  ADD CONSTRAINT `Msgs_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `Tweets_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
