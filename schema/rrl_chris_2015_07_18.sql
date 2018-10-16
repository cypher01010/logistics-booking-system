-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2015 at 03:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rrl_chris_2015_07_18`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE IF NOT EXISTS `delivery` (
`id` int(11) NOT NULL,
  `receiver_name` varchar(128) DEFAULT NULL,
  `tracking_id` varchar(64) DEFAULT NULL,
  `delivery_book_id` int(11) NOT NULL,
  `date_delivery` datetime DEFAULT NULL,
  `delivery_time` time DEFAULT NULL,
  `tel_no` varchar(32) DEFAULT NULL,
  `image_signature` varchar(512) DEFAULT NULL,
  `address1` varchar(128) DEFAULT NULL,
  `address2` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `province` varchar(64) DEFAULT NULL,
  `country_name` varchar(64) DEFAULT NULL,
  `zip_code` varchar(32) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `package_type` enum('standard') NOT NULL DEFAULT 'standard',
  `status` enum('failed','cancelled','delivered','progress') NOT NULL DEFAULT 'progress'
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `receiver_name`, `tracking_id`, `delivery_book_id`, `date_delivery`, `delivery_time`, `tel_no`, `image_signature`, `address1`, `address2`, `city`, `province`, `country_name`, `zip_code`, `customer_id`, `driver_id`, `vehicle_id`, `package_type`, `status`) VALUES
(1, 'kigwa', '123', 9090, '2015-07-01 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(2, 'asdfasd fds ', '', 12312, '2015-07-01 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(3, 'kigwa', '123', 9090, '2015-07-01 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(4, 'asdfasd fds ', '', 12312, '2015-07-04 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(5, 'kigwa', '123', 9090, '2015-07-05 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(6, 'asdfasd fds ', '', 12312, '2015-07-06 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(7, 'kigwa', '123', 9090, '2015-07-06 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(8, 'asdfasd fds ', '', 12312, '2015-07-06 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(9, 'kigwa', '123', 9090, '2015-07-06 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(10, 'asdfasd fds ', '', 12312, '2015-07-06 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(11, 'kigwa', '123', 9090, '2015-07-09 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(12, 'asdfasd fds ', '', 12312, '2015-07-09 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(13, 'kigwa', '123', 9090, '2015-07-09 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(14, 'asdfasd fds ', '', 12312, '2015-07-09 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(15, 'kigwa', '123', 9090, '2015-07-09 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(16, 'asdfasd fds ', '', 12312, '2015-07-09 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(17, 'kigwa', '123', 9090, '2015-07-09 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(18, 'asdfasd fds ', '', 12312, '2015-07-10 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(19, 'kigwa', '123', 9090, '2015-07-10 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(20, 'asdfasd fds ', '', 12312, '2015-07-10 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(21, 'kigwa', '123', 9090, '2015-07-10 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(22, 'asdfasd fds ', '', 12312, '2015-07-10 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(23, 'kigwa', '123', 9090, '2015-07-10 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(24, 'asdfasd fds ', '', 12312, '2015-07-10 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(25, 'kigwa', '123', 9090, '2015-07-10 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(26, 'asdfasd fds ', '', 12312, '2015-07-10 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(27, 'kigwa', '123', 9090, '2015-07-11 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(28, 'asdfasd fds ', '', 12312, '2015-07-11 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(29, 'kigwa', '123', 9090, '2015-07-11 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(30, 'asdfasd fds ', '', 12312, '2015-07-11 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(31, 'kigwa', '123', 9090, '2015-07-11 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(32, 'asdfasd fds ', '', 12312, '2015-07-11 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(33, 'kigwa', '123', 9090, '2015-07-11 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(34, 'asdfasd fds ', '', 12312, '2015-07-11 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(35, 'kigwa', '123', 9090, '2015-07-12 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(36, 'asdfasd fds ', '', 12312, '2015-07-12 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(37, 'kigwa', '123', 9090, '2015-07-12 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(38, 'asdfasd fds ', '', 12312, '2015-07-13 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(39, 'kigwa', '123', 9090, '2015-07-13 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(40, 'asdfasd fds ', '', 12312, '2015-07-13 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(41, 'kigwa', '123', 9090, '2015-07-13 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(42, 'asdfasd fds ', '', 12312, '2015-07-13 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(43, 'kigwa', '123', 9090, '2015-07-14 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(44, 'asdfasd fds ', '', 12312, '2015-07-14 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(45, 'kigwa', '123', 9090, '2015-07-14 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(46, 'asdfasd fds ', '', 12312, '2015-07-14 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(47, 'kigwa', '123', 9090, '2015-07-14 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(48, 'asdfasd fds ', '', 12312, '2015-07-15 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(49, 'kigwa', '123', 9090, '2015-07-15 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(50, 'asdfasd fds ', '', 12312, '2015-07-16 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(51, 'kigwa', '123', 9090, '2015-07-16 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(52, 'asdfasd fds ', '', 12312, '2015-07-16 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(53, 'kigwa', '123', 9090, '2015-07-16 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(54, 'asdfasd fds ', '', 12312, '2015-07-17 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(55, 'kigwa', '123', 9090, '2015-07-17 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(56, 'asdfasd fds ', '', 12312, '2015-07-17 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(57, 'kigwa', '123', 9090, '2015-07-17 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(58, 'asdfasd fds ', '', 12312, '2015-07-18 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(59, 'kigwa', '123', 9090, '2015-07-18 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(60, 'asdfasd fds ', '', 12312, '2015-07-19 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(61, 'kigwa', '123', 9090, '2015-07-19 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(62, 'asdfasd fds ', '', 12312, '2015-07-19 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(63, 'kigwa', '123', 9090, '2015-07-19 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(64, 'asdfasd fds ', '', 12312, '2015-07-21 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(65, 'kigwa', '123', 9090, '2015-07-24 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(66, 'asdfasd fds ', '', 12312, '2015-07-27 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(67, 'kigwa', '123', 9090, '2015-07-27 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(68, 'asdfasd fds ', '', 12312, '2015-07-28 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(69, 'kigwa', '123', 9090, '2015-07-28 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(70, 'asdfasd fds ', '', 12312, '2015-07-28 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(71, 'kigwa', '123', 9090, '2015-07-28 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(72, 'asdfasd fds ', '', 12312, '2015-07-29 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(73, 'kigwa', '123', 9090, '2015-07-29 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(74, 'asdfasd fds ', '', 12312, '2015-07-30 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress'),
(75, 'kigwa', '123', 9090, '2015-07-31 00:00:00', '00:00:01', '1231', NULL, 'bisan asa', '', 'basta', 'langob', 'kigwa', '999', 6, 3, 1, 'standard', 'progress'),
(76, 'asdfasd fds ', '', 12312, '2015-07-31 00:00:00', NULL, '', NULL, '', '', 'asdfasdfas', '', 'asdf asd', 'asdf asdfas', 6, 3, 10001, 'standard', 'progress');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_book`
--

CREATE TABLE IF NOT EXISTS `delivery_book` (
`id` int(11) NOT NULL,
  `costumer_id` int(11) NOT NULL,
  `date_book` timestamp NULL DEFAULT NULL,
  `status` enum('request','accept','denied','cancel') NOT NULL DEFAULT 'request'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `groups` varchar(128) DEFAULT NULL,
  `keyword` varchar(128) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `address1` varchar(128) DEFAULT NULL,
  `address2` varchar(128) DEFAULT NULL,
  `city` varchar(128) DEFAULT NULL,
  `province` varchar(64) DEFAULT NULL,
  `country_name` varchar(64) DEFAULT NULL,
  `zip_code` varchar(32) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `password_updated` enum('yes','no') NOT NULL DEFAULT 'no',
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `status` enum('active','inactive','delete','spam') NOT NULL DEFAULT 'active',
  `type` enum('customer','driver','admin','superadmin') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `address1`, `address2`, `city`, `province`, `country_name`, `zip_code`, `email`, `password`, `hash`, `password_updated`, `date_created`, `date_updated`, `status`, `type`) VALUES
(1, 'customer', 'customer', '', '', '', '', '', '', 'customer@customer.com', '123password', 'sfdasdfas', 'no', '2015-05-28 07:06:19', NULL, 'active', 'customer'),
(2, 'chris', 'chris', NULL, NULL, NULL, NULL, NULL, NULL, 'chris@test.com', '7fa94d09083a6e8d79389fa7a0035fab65f66ae9', '1539092a0d6717b50f7192432662', 'no', '2015-05-28 07:06:19', NULL, 'active', 'superadmin'),
(3, 'luciano', 'luciano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', NULL, NULL, 'active', 'driver'),
(4, 'tope', 'tope', NULL, NULL, NULL, NULL, NULL, NULL, 'tope@test.com', 'a5b0624ba7b91d8d9693d7469bf0187a71a719f2', '6e6cca658f9ce1f13fa995ef1b39', 'no', '2015-07-13 17:34:13', NULL, 'active', 'driver'),
(5, 'topex', 'topex', NULL, NULL, NULL, NULL, NULL, NULL, 'topex@test.com', 'b375529599b121c9afebca81f200d0e3808aa3ee', '6f2c3ed17ebb0b22c2f1217beb5e', 'no', '2015-07-13 17:51:01', NULL, 'active', 'driver'),
(6, 'customer2', 'customer2', NULL, NULL, NULL, NULL, NULL, NULL, 'customer2@yahoo.com', 'a24482cd6184e05fc4b310b117dde4b9755a56a3', '33a0b4d202cf57c84d9f832fa027', 'no', '2015-07-15 16:30:53', NULL, 'active', 'customer'),
(7, 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'admin@admin.com', '08c63e754caa182edddc69a9f3634a452f97b00b', 'eb805fe487357c06bbafa63b5627', 'no', '2015-07-15 16:44:07', NULL, 'active', 'admin'),
(8, 'driver', 'driver', NULL, NULL, NULL, NULL, NULL, NULL, 'driver@driver.com', 'ec12cc2c998c65742f1c2cc21dcae0262592403d', 'facb2658fb6068beda578300fa95', 'no', '2015-07-15 16:50:55', NULL, 'active', 'driver');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
`id` int(11) unsigned NOT NULL,
  `code` varchar(50) NOT NULL DEFAULT '',
  `vehicle_no` varchar(50) NOT NULL DEFAULT '',
  `speed_limit` int(11) DEFAULT NULL,
  `stationary_limit` int(11) DEFAULT NULL,
  `grab` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `code`, `vehicle_no`, `speed_limit`, `stationary_limit`, `grab`) VALUES
(1, '10001', 'LB1', 30, 50, 0),
(2, '001', '0011', 10, 21, 0),
(3, '', '', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_book`
--
ALTER TABLE `delivery_book`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `delivery_book`
--
ALTER TABLE `delivery_book`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
