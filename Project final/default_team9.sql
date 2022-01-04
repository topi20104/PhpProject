-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2021 at 06:23 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.13

CREATE DATABASE default_team9;
USE default_team9;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `default_team9`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'basicuser',
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountid`, `username`, `email`, `password`, `role`, `createdon`) VALUES
(27, 'CezarAdmin', 'email@mail.com', '$2y$10$hgFwjFPSf2Q3mRuP8/LYD.L4umEsMmWuwivVX8ThsyBozowi.YbQ.', 'admin', '2021-02-26 17:22:42'),
(34, 'TopiAdmin', 'ailatopi@gmail.com', '$2y$10$whu/wsur/4EoSrYvEdUMIOVCwN8vOJW4UDP9XdIbn2WD1XtM34cTe', 'admin', '2021-02-26 19:15:47'),
(54, 'EricAdmin', 'eric.telkkala@student.hamk.fi', '$2y$10$84xWN8Itxzn/F4ckHUKOee5.n0Vq.JCOq3wAymbdk1oGZpOhgYeh.', 'admin', '2021-02-28 19:12:48');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `ComntID` int NOT NULL,
  `postid` int DEFAULT NULL,
  `UserID` int NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`ComntID`, `postid`, `UserID`, `createdon`, `message`) VALUES
(18, 84, 27, '2021-03-07 20:19:41', 'Good one!!! XDD'),
(19, 75, 27, '2021-03-07 20:20:17', 'hahaha lmao!!'),
(20, 84, 34, '2021-03-07 20:20:39', 'I totally had that happen!!'),
(21, 83, 54, '2021-03-07 20:20:53', 'Wow, so original :D'),
(22, 80, 34, '2021-03-07 20:20:53', 'Omg that is so wrong! '),
(23, 79, 27, '2021-03-07 20:21:11', 'no, this is just a no'),
(24, 76, 34, '2021-03-07 20:21:26', 'Good thing it wasnt made of metal :-D'),
(25, 77, 27, '2021-03-07 20:21:40', 'like my father T_T'),
(26, 69, 54, '2021-03-07 20:22:27', 'Way too long');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postid` int NOT NULL,
  `accountid` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `post` text NOT NULL,
  `topic` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postid`, `accountid`, `title`, `post`, `topic`, `createdon`) VALUES
(64, 54, 'TYPECASTING', 'I just got fired from my job at the keyboard factory. They told me I wasn\'t putting in enough shifts.', 'none', '2021-03-07 20:10:09'),
(66, 27, 'Off to work', 'A guy shows up late for work. The boss yells, ‘You should’ve been here at 8.30!’ He replies. ‘Why? What happened at 8.30?’', 'Life', '2021-03-07 20:10:34'),
(67, 54, 'FISHY TEXT', '\"I feel like carp today\" \"Yeah, you look a little fishy\"', 'none', '2021-03-07 20:10:42'),
(68, 34, 'Funneh joke :DDD!', '\"A skeleton walks into a bar and says, \'Hey, bartender. I\'ll have one beer and a mop.\'\"\n', 'Life', '2021-03-07 20:10:58'),
(69, 27, 'Kid vs barber', 'A young boy enters a barber shop and the barber whispers to his customer. ‘This is the dumbest kid in the world. Watch while I prove it you.’ The barber puts a dollar bill in one hand and two quarters in the other, then calls the boy over and asks, ‘Which do you want, son?’ The boy takes the quarters and leaves. ‘What did I tell you?’ said the barber. ‘That kid never learns!’ Later, when the customer leaves, he sees the same young boy coming out of the ice cream store. ‘Hey, son! May I ask you a question? Why did you take the quarters instead of the dollar bill?’ The boy licked his cone and replied, ‘Because the day I take the dollar, the game is over!’', 'Children', '2021-03-07 20:11:12'),
(70, 54, 'OLD SCHOOL', 'You know you\'re texting too much when... ...you try to text, but you\'re on a landline.', 'none', '2021-03-07 20:11:12'),
(71, 34, 'This one cracked me so well :D', '\"How do you get a squirrel to like you? Act like a nut.\"', 'Life', '2021-03-07 20:11:38'),
(72, 27, 'You’re one in a million', 'China has a population of a billion people. One billion. That means even if you’re a one in a million kind of guy, there are still a thousand others exactly like you.', 'Life', '2021-03-07 20:12:07'),
(73, 27, 'All in a night’s work', 'A guy meets a sex worker in a bar. She says, ‘This is your lucky night. I’ve got a special game for you. I’ll do absolutely anything you want for £300 as long as you can say it in three words.’ The guy replies, ‘Hey, why not?’ He pulls his wallet out of his pocket and lays £300 on the bar, and says slowly. ‘Paint…my….house.’', 'Adults', '2021-03-07 20:13:15'),
(74, 34, 'I was literally laughing out loud about this one! ', 'Why can\'t orphans play baseball? They don\'t know where home is.', 'DarkHumor', '2021-03-07 20:13:31'),
(75, 34, 'Oh no ', 'I hate double standards. Burn a body at a crematorium, you\'re \"being a respectful friend.\" Do it at home and you\'re \"destroying evidence.\"', 'Forbidden', '2021-03-07 20:14:10'),
(76, 54, 'THIRST QUENCHER', 'Boy, I just got hit in the head with a can of soda. I was lucky it was a soft drink.', 'none', '2021-03-07 20:14:34'),
(77, 34, 'Joker :D', 'When does a joke become a dad joke? When it leaves and never comes back.', 'Family', '2021-03-07 20:14:38'),
(78, 27, 'A genie and an idiot', 'Three guys stranded on a desert island find a magic lantern containing a genie, who grants them each one wish. The first guy wishes he was off the island and back home. The second guy wishes the same. The third guy says: ‘I’m lonely. I wish my friends were back here.’', 'Life', '2021-03-07 20:15:34'),
(79, 54, 'BEHIND AT WORK', 'A butcher accidentally backed into his meat grinder and got a little behind in his work.', 'none', '2021-03-07 20:15:57'),
(80, 27, 'Don\'t play with fire', 'Give a man a match, and he\'ll be warm for a few hours. Set a man on fire, and he will be warm for the rest of his life.', 'DarkHumor', '2021-03-07 20:17:20'),
(81, 27, 'New house', 'I visited my friend at his new house. He told me to make myself at home. So I threw him out. I hate having visitors.', 'DarkHumor', '2021-03-07 20:17:58'),
(82, 27, '\"No\" to drugs', '“Just say NO to drugs!” Well, If I’m talking to my drugs, I probably already said yes.', 'DarkHumor', '2021-03-07 20:18:33'),
(83, 34, 'eks dee! xD', 'You don’t need a parachute to go skydiving. You need a parachute to go skydiving twice.', 'Life', '2021-03-07 20:18:46'),
(84, 54, 'THE CALL', 'How do you make your girlfriend scream during sex? Call and tell her about it.', 'Adults', '2021-03-07 20:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `ratinginfo`
--

CREATE TABLE `ratinginfo` (
  `accountid` int NOT NULL,
  `postid` int NOT NULL,
  `ratingstatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratinginfo`
--

INSERT INTO `ratinginfo` (`accountid`, `postid`, `ratingstatus`) VALUES
(27, 75, 'like'),
(27, 76, 'like'),
(27, 77, 'like'),
(27, 79, 'dislike'),
(27, 83, 'dislike'),
(27, 84, 'like'),
(34, 75, 'like'),
(34, 80, 'like'),
(34, 81, 'dislike'),
(34, 82, 'dislike'),
(54, 75, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `reportid` int NOT NULL,
  `postid` int NOT NULL,
  `accountid` int NOT NULL,
  `reason` varchar(100) NOT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`reportid`, `postid`, `accountid`, `reason`, `createdon`) VALUES
(25, 79, 27, 'Harmful or dangerous acts', '2021-03-07 18:20:50'),
(26, 75, 34, 'Promotes terrorism', '2021-03-07 18:21:35'),
(27, 78, 34, 'Child abuse', '2021-03-07 18:21:40'),
(28, 83, 34, 'Sexual content', '2021-03-07 18:21:51'),
(29, 69, 54, 'Spam or misleading', '2021-03-07 18:22:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`ComntID`),
  ADD KEY `postid` (`postid`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `accountid` (`accountid`);

--
-- Indexes for table `ratinginfo`
--
ALTER TABLE `ratinginfo`
  ADD UNIQUE KEY `UC_rating_info` (`accountid`,`postid`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`reportid`),
  ADD KEY `accountid` (`accountid`),
  ADD KEY `postid` (`postid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `accountid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `ComntID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `reportid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `accounts` (`accountid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CommentsToPost` FOREIGN KEY (`postid`) REFERENCES `posts` (`postid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`accountid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ratinginfo`
--
ALTER TABLE `ratinginfo`
  ADD CONSTRAINT `ratinginfo_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`accountid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratinginfo_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`postid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`accountid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`postid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
