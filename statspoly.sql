-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2023 at 09:27 AM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

create database statspoly;
use statspoly;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20504209_statspoly`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `admn` smallint(4) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sem` tinyint(1) NOT NULL,
  `tid` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`admn`, `name`, `mobile`, `mail`, `password`, `type`, `sem`, `tid`) VALUES
(5798, 'Adithyan Manayil', '9072835246', 'manayiladithyan@gmail.com', 'Daffodil', 2, 0, 0),
(1111, 'Dinuli Mendis', '9080706050', 'dinulimendis@gmail.com', '12345678', 1, 1, 0),
(4444, 'Naruto Uzumaki', '1472583690', 'naruto@konoha.com', '12121212', 0, 1, 1111),
(1212, 'Sakura', '9638527410', 'sakura@konoha.com', '12121212', 0, 1, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `admn` smallint(6) NOT NULL,
  `code` smallint(6) NOT NULL,
  `grade` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`admn`, `code`, `grade`, `verified`) VALUES
(4444, 1001, 'B', 1),
(4444, 1002, 'A', 1),
(4444, 1003, 'C', 1),
(4444, 1004, 'A', 1),
(4444, 1005, 'B', 1),
(4444, 1007, 'S', 1),
(4444, 1008, 'B', 1),
(4444, 1009, 'S', 1),
(1212, 1001, 'B', 1),
(1212, 1002, 'A', 1),
(1212, 1003, 'C', 1),
(1212, 1004, 'A', 1),
(1212, 1005, 'B', 1),
(1212, 1007, 'S', 1),
(1212, 1008, 'B', 1),
(1212, 1009, 'S', 1);

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
