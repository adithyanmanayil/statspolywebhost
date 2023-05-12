-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 12, 2023 at 05:11 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20575611_statspoly`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `admn` smallint(6) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sem` tinyint(1) NOT NULL,
  `tid` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`admn`, `name`, `mobile`, `mail`, `password`, `type`, `sem`, `tid`) VALUES
(5798, 'Adithyan M S', '9072835246', 'manayiladithyan@gmail.com', 'Daffodil', 2, 0, 0),
(1111, 'Dinuli Mendis', '9080706050', 'dinulimendis@gmail.com', '12345678', 1, 1, 0),
(4444, 'Naruto Uzumaki', '1472583690', 'narutouzumaki@konoha.com', '12121212', 0, 1, 1111),
(1515, 'Sasuke Uchiha', '3692581470', 'anavenger@konoha.com', '12121212', 0, 1, 1111),
(2222, 'Kakashi Hatake', '9874563210', 'thecopyninja@konoha.com', '12345678', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `admn` smallint(6) NOT NULL,
  `code` smallint(6) NOT NULL,
  `grade` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `imark` smallint(6) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `sem` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`admn`, `code`, `grade`, `imark`, `verified`, `sem`) VALUES
(4444, 1001, '9', 23, 1, 1),
(4444, 1002, '10', 34, 1, 1),
(4444, 1003, '7', 12, 1, 1),
(4444, 1004, '10', 67, 1, 1),
(4444, 1005, '10', 53, 1, 1),
(4444, 1007, '6', 22, 1, 1),
(4444, 1008, '10', 34, 1, 1),
(4444, 1009, '0', 78, 1, 1),
(1515, 1001, '6', 23, 1, 1),
(1515, 1002, '9', 34, 1, 1),
(1515, 1003, '8', 54, 1, 1),
(1515, 1004, '8', 45, 1, 1),
(1515, 1005, '10', 97, 1, 1),
(1515, 1007, '10', 48, 1, 1),
(1515, 1008, '7', 79, 1, 1),
(1515, 1009, '10', 14, 1, 1),
(4444, 2002, '10', 25, 0, 2),
(4444, 2003, '10', 63, 0, 2),
(4444, 2006, '10', 45, 0, 2),
(4444, 2008, '10', 18, 0, 2),
(4444, 2009, '10', 76, 0, 2),
(4444, 2031, '10', 13, 0, 2),
(4444, 2131, '6', 49, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `code` smallint(6) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `credit` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `sem` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`code`, `name`, `credit`, `sem`) VALUES
(1001, 'Communication Skills in English ', '4', 1),
(1002, 'Mathematics 1', '5', 1),
(1003, 'Applied Physics 1 ', '3', 1),
(1004, 'Applied Chemistry', '3', 1),
(1005, 'Engineering Graphics', '1.5', 1),
(1007, 'Applied Chemistry Lab', '1', 1),
(1008, 'Introduction to IT Systems Lab ', '2', 1),
(1009, 'Sports and Yoga', '1', 1),
(2002, 'Mathematics 11', '4', 2),
(2003, 'Applied Physics 11', '3', 2),
(2006, 'Applied Physics Lab', '2', 2),
(2008, 'Communication Skills in English Lab', '1.5', 2),
(2009, 'Engineering Workshop Practice', '1.5', 2),
(2031, 'Fundamentals of Electrical and Electronics Engineering', '3', 2),
(2131, 'Problem Solving and Programming', '3', 2),
(3131, 'Computer Organisation', '4', 3),
(3132, 'Programming in C', '3', 3),
(3133, 'Database Management System', '3', 3),
(3134, 'Digital Computer Fundamentals', '3', 3),
(3135, 'Programming in C Lab', '1.5', 3),
(3136, 'Database Management System Lab', '1.5', 3),
(3137, 'Digital Computer Fundamentals Lab', '1.5', 3),
(3138, 'Web Technology Lab', '2.5', 3),
(4006, 'Minor Project', '2', 4),
(4131, 'Object Oriented Programming', '4', 4),
(4132, 'Computer Communication and Networks', '3', 4),
(4133, 'Data Structure', '4', 4),
(4136, 'Object Oriented Programming Lab', '1.5', 4),
(4138, 'Data Structure Lab', '1.5', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
