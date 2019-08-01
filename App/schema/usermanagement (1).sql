-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 16, 2019 at 05:33 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_configuration`
--

DROP TABLE IF EXISTS `default_configuration`;
CREATE TABLE IF NOT EXISTS `default_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_label` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_updated` datetime NOT NULL,
  `option_value_one` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value_two` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `default_configuration`
--

INSERT INTO `default_configuration` (`id`, `option_name`, `option_value`, `option_label`, `date_updated`, `option_value_one`, `option_value_two`, `option_description`) VALUES
(1, 'default_user', 'ADMIN', 'Default User', '2019-07-02 00:00:00', 'USER', 'ADMIN', ''),
(2, 'default_user_status', 'ENABLED', 'Default User Status', '2019-07-03 00:00:00', 'ENABLED', 'DISABLED', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ENABLED',
  `last_password_changed` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `address`, `mobile`, `image`, `user_type`, `user_status`, `last_password_changed`) VALUES
(20, 'Binayak', 'anjalbinayak3@gmail.com', '$2y$10$Qak4OqS.kBWqifcwKxlgeerSQXc7efISwXtRpa3S3hWOXrkE/Sz1C', 'Birtamode', '9816011210', 'user201907140737245d2adbb4a4c49.jpg', 'ADMIN', 'ENABLED', '2019-07-15 06:14:56'),
(22, 'Rojin', 'rojinbastola@gmail.com', '$2y$10$SR1JeYijYEw3Cd3IaY0anuqRizpyEOTcvTIn2hEpmkCMNHDh3ZMtO', 'Laxmipur', '9842688888', 'user201907100938505d25b22a0d3d4.jpg', 'USER', 'ENABLED', '2019-07-09 10:00:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
