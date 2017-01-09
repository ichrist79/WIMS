-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 02:10 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wimsfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `perigrafi` text COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `user_id`, `title`, `perigrafi`, `location`, `active`) VALUES
(113, 23, 'meeting 1.1', 'Συνάντηση 1.1', 'Thessaloniki, Greece', 1),
(114, 23, 'meeting 1.2', 'Συνάντηση 1.2', 'Τσιμισκή, Θεσσαλονίκη, Ελλάδα', 1),
(115, 24, 'meeting 2.1', 'Συνάντηση 2.1', 'Athens, Kentrikos Tomeas Athinon, Greece', 1),
(116, 25, 'meeting 3.1', 'Συνάντηση 3.1', 'Canada', 1),
(117, 25, 'meeting 3.2', 'Συνάντηση 3.2', 'Canada', 1),
(118, 25, 'meeting 3.3', 'Συνάντηση 3.3', 'Τρίκαλα, Ελλάδα', 1),
(119, 24, 'meeting 2.2', 'Συνάντηση 2.2', 'Τρίπολη, Αρκαδία, Ελλάδα', 1),
(121, 23, 'meeting 1.3', 'Συνάντηση 1.3', 'Τσιμισκή, Θεσσαλονίκη, Ελλάδα', 1),
(122, 24, 'Meeting 2.3', 'Συνάντηση 2.3', 'Tennessee, United States', 1),
(123, 25, 'Meeting 3.4', 'sssss', 'Georgia, United States', 1),
(124, 25, 'afgafsaf', 'ssss', 'Victoria, Australia', 1),
(125, 25, 'das', 'ss', 'Florida, United States', 0),
(126, 25, 'das', 'ss', 'Florida, United States', 0),
(127, 25, 'σ', 'σφ', 'Γλυφάδα, Νότιος Τομέας Αθηνών, Ελλάδα', 0),
(128, 25, 'φ', 'σσ', 'Εύβοια, Ελλάδα', 0),
(129, 25, 'faaf', 'www', 'Florida, United States', 1),
(130, 25, 'gg', 'ss', 'Florida, United States', 1),
(131, 24, 'sfsfsfd', 'sdffd', 'France', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_day_time`
--

CREATE TABLE `event_day_time` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `day` date NOT NULL,
  `time` time NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_day_time`
--

INSERT INTO `event_day_time` (`id`, `id_event`, `day`, `time`, `vote`) VALUES
(144, 113, '2017-01-08', '12:00:00', 1),
(145, 113, '2017-01-09', '13:00:00', 1),
(146, 113, '2017-01-09', '14:00:00', 0),
(147, 114, '2017-01-14', '16:05:00', 1),
(148, 114, '2017-01-17', '13:01:00', 0),
(149, 114, '2017-01-23', '15:58:00', 0),
(150, 115, '2017-01-19', '13:58:00', 2),
(151, 115, '2017-01-24', '15:20:00', 3),
(152, 115, '2017-01-31', '13:01:00', 2),
(153, 116, '2017-01-12', '13:00:00', 0),
(154, 116, '2017-01-13', '03:15:00', 0),
(155, 116, '2017-01-25', '13:50:00', 0),
(156, 117, '2017-01-27', '14:00:00', 0),
(157, 117, '2017-01-18', '13:03:00', 1),
(158, 117, '2017-01-17', '02:01:00', 1),
(159, 118, '2017-01-19', '13:01:00', 0),
(160, 118, '2017-03-26', '14:01:00', 0),
(161, 118, '2017-01-19', '22:09:00', 1),
(162, 118, '2017-01-27', '19:57:00', 1),
(163, 119, '2017-01-19', '14:06:00', 1),
(164, 119, '2017-01-17', '14:59:00', 1),
(165, 121, '2017-01-26', '13:01:00', 0),
(166, 121, '2017-01-27', '11:57:00', 0),
(167, 121, '2017-01-29', '15:02:00', 0),
(168, 121, '2017-01-11', '01:54:00', 0),
(169, 122, '2017-01-10', '13:01:00', 1),
(170, 122, '2017-01-13', '14:01:00', 1),
(171, 122, '2017-01-19', '15:01:00', 2),
(172, 123, '2017-01-27', '14:03:00', 1),
(173, 123, '2017-01-18', '14:00:00', 1),
(174, 124, '2017-01-11', '02:01:00', 0),
(175, 127, '2017-01-26', '03:01:00', 0),
(176, 128, '2017-01-18', '00:00:00', 0),
(177, 129, '2017-01-18', '01:01:00', 0),
(178, 130, '2017-01-19', '02:01:00', 0),
(179, 131, '2017-01-13', '02:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_vote`
--

CREATE TABLE `event_vote` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_event_day` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_vote`
--

INSERT INTO `event_vote` (`id`, `id_event`, `id_event_day`, `user_id`) VALUES
(140, 115, 150, 23),
(141, 115, 151, 23),
(142, 117, 157, 23),
(143, 115, 150, 25),
(144, 115, 151, 25),
(145, 115, 152, 25),
(146, 118, 161, 23),
(147, 118, 162, 23),
(148, 115, 151, 26),
(149, 113, 144, 25),
(150, 113, 145, 25),
(151, 115, 152, 26),
(152, 114, 147, 25),
(153, 119, 163, 23),
(154, 119, 164, 23),
(155, 117, 158, 23),
(156, 122, 169, 23),
(157, 122, 171, 25),
(158, 122, 170, 26),
(159, 122, 171, 26),
(160, 123, 172, 24),
(161, 123, 173, 24);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`id`, `user_id`, `email`, `id_event`) VALUES
(43, 23, 'test2@gmail.com', 113),
(44, 23, 'test3@gmail.com', 113),
(45, 23, 'test4@gmail.com', 113),
(46, 23, 'test2@gmail.com', 114),
(47, 23, 'test3@gmail.com', 114),
(48, 23, 'test4@gmail.com', 114),
(49, 24, 'test1@gmail.com', 115),
(50, 24, 'test3@gmail.com', 115),
(51, 24, 'test4@gmail.com', 115),
(52, 25, 'test1@gmail.com', 116),
(53, 25, 'test2@gmail.com', 116),
(54, 25, 'test4@gmail.com', 116),
(55, 25, 'test2@gmail.com', 117),
(56, 25, 'test1@gmail.com', 117),
(57, 25, 'test4@gmail.com', 117),
(58, 25, 'test1@gmail.com', 118),
(59, 25, 'test2@gmail.com', 118),
(60, 25, 'test4@gmail.com', 118),
(61, 24, 'test1@gmail.com', 119),
(62, 24, 'test3@gmail.com', 119),
(63, 23, 'test3@gmail.com', 121),
(64, 23, 'test4@gmail.com', 121),
(65, 24, 'test1@gmail.com', 122),
(66, 24, 'test3@gmail.com', 122),
(67, 24, 'test4@gmail.com', 122),
(68, 25, 'test2@gmail.com', 123),
(69, 25, 'test1@gmail.com', 123),
(70, 25, 'test4@gmail.com', 123),
(71, 25, 'ioannis.christoudis@gmail.com', 128),
(72, 25, 'test2@gmail.com', 129),
(73, 25, 'test4@gmail.com', 129),
(74, 25, 'test1@gmail.com', 129),
(75, 25, 'test2@gmail.com', 130),
(76, 25, 'test1@gmail.com', 130),
(77, 25, 'test4@gmail.com', 130),
(78, 24, 'test1@gmail.com', 131),
(79, 24, 'test3@gmail.com', 131);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `display_name`, `email`, `password`) VALUES
(23, 'τεστ1', 'τεστ1', 'τεστ1', 'test1@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(24, 'τεστ2', 'τεστ2', 'τεστ2', 'test2@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(25, 'τεστ3', 'τεστ3', 'τεστ3', 'test3@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(26, 'τεστ4', 'τεστ4', 'τεστ4', 'test4@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `event_day_time`
--
ALTER TABLE `event_day_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_vote`
--
ALTER TABLE `event_vote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `event_day_time`
--
ALTER TABLE `event_day_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `event_vote`
--
ALTER TABLE `event_vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
