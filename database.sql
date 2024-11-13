-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 06:27 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web_directory`
--
CREATE DATABASE IF NOT EXISTS `web_directory` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `web_directory`;

-- --------------------------------------------------------

--
-- Table structure for table `catogare`
--

CREATE TABLE IF NOT EXISTS `catogare` (
  `catgory_id` int(11) NOT NULL AUTO_INCREMENT,
  `catogry_name` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`catgory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `catogare`
--

INSERT INTO `catogare` (`catgory_id`, `catogry_name`, `img`) VALUES
(41, '  المطاعم', 'cat_img/41_aa (2).png'),
(42, 'مواقف الباصات', 'cat_img/42_pngimg.com - bus_PNG101194.png'),
(44, 'مناطق الدراسه', 'cat_img/44_aasjz0n5k.png'),
(45, 'شقق للإيجار', 'cat_img/45_house-renting-u51fau79dfu623f-home-a-house-for-rent.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `his_id` int(11) NOT NULL AUTO_INCREMENT,
  `loc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`his_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`his_id`, `loc_id`, `user_id`, `date_added`) VALUES
(3, 5, 1, '2024-06-08 12:51:14'),
(4, 3, 1, '2024-06-08 12:51:04'),
(5, 4, 1, '2024-06-08 12:51:25'),
(6, 1, 1, '2024-06-08 17:05:43'),
(7, 5, 2, '2024-06-05 10:57:09'),
(8, 7, 1, '2024-06-05 14:34:13'),
(9, 8, 1, '2024-06-08 12:51:20'),
(10, 6, 1, '2024-06-08 12:53:05'),
(11, 2, 1, '2024-06-08 17:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
  `loc_name` varchar(250) NOT NULL,
  `user_id` varchar(11) NOT NULL DEFAULT 'admin',
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `uni_id` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `desc` text NOT NULL,
  `conf` varchar(10) NOT NULL DEFAULT 'yes',
  `date_added` date NOT NULL,
  `vistor` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `loc_name`, `user_id`, `address`, `phone`, `cat_id`, `uni_id`, `lat`, `lng`, `desc`, `conf`, `date_added`, `vistor`) VALUES
(1, 'fast food truk', '0', 'عمان شارع المطار ', ' 079916655', 41, 3, 31.7888168586254, 35.92682075526682, 'asdasdasdadaasdasd\r\nsdfdsf\r\ndsfdsf', 'no', '2024-05-18', 2),
(2, 'test location 1', '0', 'sdasdsad', ' 0455', 41, 3, 32.7888168586254, 36.92682075526682, '', 'yes', '2024-05-18', 3),
(3, 'test location 2', '0', 'sdasdsad', ' 0455', 41, 3, 33.7888168586254, 37.92682075526682, 'eerwerwer', 'yes', '2024-05-18', 1),
(4, 'شقه طلابيه للإيجار', '0', 'جامعة عمان الاهليه - السلط', ' 0795541', 45, 8, 32.04723362337049, 35.777372406541346, 'شقه طابقيه للإيجار السنوي للطلاب الدوليين ، سعر الإيجار 170 دينار في الشهر ', 'yes', '2024-05-20', 1),
(5, 'كفتيريا الكوخ', '0', 'عمان - شارع المطار - جامعة الاسراء', ' 12255435356', 41, 3, 31.790254116269143, 35.92434558213248, 'كفتيريا الكوخ لتقديم جميع الوجبات السريعه للطلاب', 'yes', '2024-05-22', 1),
(6, 'test from admin', '0', 'الاردن - السلط', ' 12255435356', 42, 3, 32.067468676947406, 35.83796498346614, 'تفاصيل الموقع', 'yes', '2024-06-05', 1),
(8, 'test from user', '1', 'الاردن - السلط', ' 12255435356', 41, 4, 32.17944272071724, 35.83439350554405, 'sfsdf', 'yes', '2024-06-05', 18);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `rev_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `rate` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  PRIMARY KEY (`rev_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`rev_id`, `content`, `rate`, `date_added`, `user_id`, `loc_id`) VALUES
(19, 'تعليق 1', 5, '2024-06-08 13:39:46', 1, 8),
(21, 'تعليق 2', 3, '2024-06-08 18:07:09', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `saved_loc`
--

CREATE TABLE IF NOT EXISTS `saved_loc` (
  `save_indx` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`save_indx`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `saved_loc`
--

INSERT INTO `saved_loc` (`save_indx`, `user_id`, `loc_id`, `date_added`) VALUES
(4, 1, 4, '2024-05-25 10:29:58'),
(5, 1, 5, '2024-06-05 17:51:48'),
(6, 1, 5, '2024-06-05 17:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `universities`
--

CREATE TABLE IF NOT EXISTS `universities` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_name` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `img` varchar(150) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`uni_id`, `uni_name`, `address`, `img`, `lng`, `lat`) VALUES
(3, 'جامعة الإسراء ', 'عمان شارع المطار', 'un_logo/3_images.jpeg', 35.92967302358985, 31.78904764065239),
(4, 'الجامعة الاردنيه', 'الاردن / عمان', 'un_logo/jordan.png', 35.92967302358985, 31.78904764065239),
(5, 'جامعة مؤته', 'الاردن / الكرك', 'un_logo/mutah.png', 35.92967302358985, 31.78904764065239),
(6, 'جامعة العلوم والتكنولجيا', 'الاردن / اربد', 'un_logo/IT.png', 35.92967302358985, 31.78904764065239),
(7, 'جامعة اليرموك', 'الاردن / اربد', 'un_logo/Yarmouk.png', 35.92967302358985, 31.78904764065239),
(8, 'جامعة عمان الاهليه', 'الاردن - السلط', 'un_logo/8_amman.png', 35.77940033556678, 32.04727945128953);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `usertype` varchar(10) NOT NULL DEFAULT 'user',
  `password` varchar(100) NOT NULL,
  `confirm` varchar(5) NOT NULL DEFAULT 'no',
  `confrm_img` varchar(200) DEFAULT NULL,
  `profile_image` varchar(200) NOT NULL DEFAULT 'img/userimg.png',
  `blocked` varchar(5) NOT NULL DEFAULT 'no',
  `date_added` date NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `email`, `usertype`, `password`, `confirm`, `confrm_img`, `profile_image`, `blocked`, `date_added`, `lat`, `lng`, `last_login`) VALUES
(1, 'user2', 'user@gmail.com', 'user', '123', 'no', NULL, 'profile_img/1.jpg', 'no', '2023-12-17', 31.7888168586254, 35.92682075526682, '2024-06-08 03:05:32'),
(2, 'مدير النظام', 'admin@gmail.com', 'admin', '123', 'yes', NULL, 'profile_img/2.png', 'no', '2023-12-21', 0, 0, '2024-06-08 03:28:35'),
(3, 'admin2', 'admin2@gmail.com', 'admin', '123456', 'yes', NULL, 'img/userimg.png', 'no', '0000-00-00', 0, 0, '2024-06-05 08:30:25'),
(4, 'test user', 'mosab_cs1@yahoo.com', 'user', '123456', 'no', NULL, 'img/userimg.png', 'no', '2024-05-13', 0, 0, '2024-06-05 08:30:25'),
(5, 'user1', 'mosab_cs2@yahoo.com', 'user', '123', 'no', NULL, 'img/userimg.png', 'no', '2024-05-15', 0, 0, '2024-06-05 08:30:25');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
