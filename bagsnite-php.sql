-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: glwebsql.mysql.database.azure.com:3306
-- Generation Time: Mar 11, 2018 at 08:54 AM
-- Server version: 5.7.20
-- PHP Version: 7.0.25-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earlgreyders`
--

-- --------------------------------------------------------

--
-- Table structure for table `duos.pc`
--

CREATE TABLE `duos.pc` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `top1` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top10` int(11) DEFAULT NULL,
  `top25` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `minutesplayed` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `kpg` int(11) DEFAULT NULL,
  `avgtime` int(11) DEFAULT NULL,
  `scorematch` int(11) DEFAULT NULL,
  `scoremin` int(11) DEFAULT NULL,
  `epicname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duos.psn`
--

CREATE TABLE `duos.psn` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `top1` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top10` int(11) DEFAULT NULL,
  `top25` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `minutesplayed` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `kpg` int(11) DEFAULT NULL,
  `avgtime` int(11) DEFAULT NULL,
  `scorematch` int(11) DEFAULT NULL,
  `scoremin` int(11) DEFAULT NULL,
  `epicname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lifetime.pc`
--

CREATE TABLE `lifetime.pc` (
  `id` int(11) UNSIGNED NOT NULL,
  `epicname` varchar(25) DEFAULT NULL,
  `top3s` int(11) DEFAULT NULL,
  `top5s` int(11) DEFAULT NULL,
  `top12s` int(11) DEFAULT NULL,
  `top25s` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `winpercent` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `timeplayed` int(11) DEFAULT NULL,
  `survivaltime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lifetime.psn`
--

CREATE TABLE `lifetime.psn` (
  `id` int(11) UNSIGNED NOT NULL,
  `epicname` varchar(25) DEFAULT NULL,
  `top3s` int(11) DEFAULT NULL,
  `top5s` int(11) DEFAULT NULL,
  `top12s` int(11) DEFAULT NULL,
  `top25s` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `winpercent` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `timeplayed` int(11) DEFAULT NULL,
  `survivaltime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solo.pc`
--

CREATE TABLE `solo.pc` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `top1` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top10` int(11) DEFAULT NULL,
  `top25` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `minutesplayed` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `kpg` int(11) DEFAULT NULL,
  `avgtime` int(11) DEFAULT NULL,
  `scorematch` int(11) DEFAULT NULL,
  `scoremin` int(11) DEFAULT NULL,
  `epicname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solo.psn`
--

CREATE TABLE `solo.psn` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `top1` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top10` int(11) DEFAULT NULL,
  `top25` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `minutesplayed` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `kpg` int(11) DEFAULT NULL,
  `avgtime` int(11) DEFAULT NULL,
  `scorematch` int(11) DEFAULT NULL,
  `scoremin` int(11) DEFAULT NULL,
  `epicname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `squads.pc`
--

CREATE TABLE `squads.pc` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `top1` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top10` int(11) DEFAULT NULL,
  `top25` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `minutesplayed` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `kpg` int(11) DEFAULT NULL,
  `avgtime` int(11) DEFAULT NULL,
  `scorematch` int(11) DEFAULT NULL,
  `scoremin` int(11) DEFAULT NULL,
  `epicname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `squads.psn`
--

CREATE TABLE `squads.psn` (
  `id` int(11) UNSIGNED NOT NULL,
  `score` int(11) DEFAULT NULL,
  `top1` int(11) DEFAULT NULL,
  `top3` int(11) DEFAULT NULL,
  `top10` int(11) DEFAULT NULL,
  `top25` int(11) DEFAULT NULL,
  `kd` int(11) DEFAULT NULL,
  `matches` int(11) DEFAULT NULL,
  `kills` int(11) DEFAULT NULL,
  `minutesplayed` int(11) DEFAULT NULL,
  `kpm` int(11) DEFAULT NULL,
  `kpg` int(11) DEFAULT NULL,
  `avgtime` int(11) DEFAULT NULL,
  `scorematch` int(11) DEFAULT NULL,
  `scoremin` int(11) DEFAULT NULL,
  `epicname` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `google_userid` varchar(24) NOT NULL,
  `email` varchar(40) NOT NULL,
  `epicname` varchar(25) DEFAULT NULL,
  `psnname` varchar(25) DEFAULT NULL,
  `slackname` varchar(25) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `nickname` varchar(25) DEFAULT NULL,
  `seen` datetime DEFAULT NULL,
  `statsupdated` datetime DEFAULT NULL,
  `level` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wins`
--

CREATE TABLE `wins` (
  `id` int(11) NOT NULL,
  `epicname` varchar(25) NOT NULL,
  `solopc` int(11) NOT NULL,
  `solopsn` int(11) NOT NULL,
  `duospc` int(11) NOT NULL,
  `duospsn` int(11) NOT NULL,
  `squadspc` int(11) NOT NULL,
  `squadspsn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `duos.pc`
--
ALTER TABLE `duos.pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `duos.psn`
--
ALTER TABLE `duos.psn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifetime.pc`
--
ALTER TABLE `lifetime.pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifetime.psn`
--
ALTER TABLE `lifetime.psn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solo.pc`
--
ALTER TABLE `solo.pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solo.psn`
--
ALTER TABLE `solo.psn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squads.pc`
--
ALTER TABLE `squads.pc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squads.psn`
--
ALTER TABLE `squads.psn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wins`
--
ALTER TABLE `wins`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `duos.pc`
--
ALTER TABLE `duos.pc`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `duos.psn`
--
ALTER TABLE `duos.psn`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lifetime.pc`
--
ALTER TABLE `lifetime.pc`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lifetime.psn`
--
ALTER TABLE `lifetime.psn`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solo.pc`
--
ALTER TABLE `solo.pc`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `solo.psn`
--
ALTER TABLE `solo.psn`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `squads.pc`
--
ALTER TABLE `squads.pc`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `squads.psn`
--
ALTER TABLE `squads.psn`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wins`
--
ALTER TABLE `wins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
