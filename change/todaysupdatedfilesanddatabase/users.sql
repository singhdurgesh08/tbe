-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2016 at 04:48 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inetglobal2`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `paypal_email` varchar(255) NOT NULL,
  `DOB` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `State` varchar(100) NOT NULL,
  `zip` int(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `membership_id` int(10) NOT NULL,
  `createddate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `user_email`, `user_pass`, `Address`, `paypal_email`, `DOB`, `city`, `State`, `zip`, `Country`, `membership_id`, `createddate`) VALUES
(1, '', '', 'dasj', 'jldjal', 'jdlaj', 'jdljal', '', 'jdljal', '', 'jdlajl', 0, 'fdjlka', 0, '2016-05-21 17:49:29'),
(3, '', '', 'raj', 'daj', 'jdlja', 'ljdsljl', '', 'jdalj', '', 'dfa', 0, 'dfa', 0, '2016-05-21 18:10:54'),
(4, '', '', 'dfa', 'da', 'dd', 'd', '', 'd', '', 'd', 0, 'd', 0, '2016-05-21 18:11:46'),
(5, '', '', 'dajfl', 'jdlkaj', 'lkdjalkj', 'kdjkl', '', 'jdalkj', '', 'daf', 0, 'df', 2, '2016-05-21 18:13:14'),
(6, '', '', 'sonu', 'sonu@gmail.com', '12345', 'mahavir enclave', '', 'may 1991', '', 'Delhi', 0, 'India', 0, '2016-05-24 13:46:09'),
(7, '', '', 'sunil', 'sunil@gmail.com', '12345', 'chanakya place', '', '9090', '', 'UO', 0, 'US', 0, '2016-05-24 13:47:56'),
(8, '', '', 'toni', 'toni@gmail.com', '00000', 'sita puri', '', 'feb 5', '', 'Delhi', 0, 'india', 0, '2016-05-24 13:53:31'),
(11, 'ggg', 'daf', 'durgesh singh', 'santosh@gmail.com', '12345', 'd', 'fd', '06/14/2016', 'd', 'Free', 0, 'df', 1, '2016-06-04 11:00:29'),
(12, '', '', 'durgesh singh', 'santosh@gmail.com', '12345', '3375 Alma St, 266', '', '06/07/2016', '', 'CA', 0, 'India', 1, '2016-06-04 12:06:29'),
(13, '', '', 'durgesh singh', 'santosh1@gmail.com', '12345', '41069 Crimson Pillar', '', '06/21/2016', '', '290', 0, '14', 1, '2016-06-04 13:18:30'),
(14, '', '', 'test', 'test@gmail.com', '12345', 'Test', '', '06/07/2016', '', '86', 0, '2', 1, '2016-06-04 13:27:21'),
(15, '', '', 'pankaj', 'pankaj@gmail.com', '12345', '3375 Alma St, 266', '', '06/04/2016', '', '3924', 0, '231', 1, '2016-06-04 13:56:11'),
(16, '', '', 'india', 'india@gmail.com', '12345', 'New Delhi', '', '06/16/2016', '', '289', 0, '14', 1, '2016-06-04 15:45:21'),
(17, 'Pankaj ', 'Rai', 'pankaj rai', 'pankajrai@gmail.com', '12345', 'hello', 'hello@gmail.com', 'sdf', 'jl', 'lj', 100000, 'kja', 0, '2016-06-28 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
