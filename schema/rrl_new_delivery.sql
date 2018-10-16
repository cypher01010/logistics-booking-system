# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.24)
# Database: rrl
# Generation Time: 2015-07-06 11:20:42 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table delivery
# ------------------------------------------------------------

DROP TABLE IF EXISTS `delivery`;

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` enum('failed','cancel','delivered','progress') NOT NULL DEFAULT 'progress',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;

INSERT INTO `delivery` (`id`, `receiver_name`, `tracking_id`, `delivery_book_id`, `date_delivery`, `delivery_time`, `tel_no`, `image_signature`, `address1`, `address2`, `city`, `province`, `country_name`, `zip_code`, `customer_id`, `driver_id`, `vehicle_id`, `package_type`, `status`)
VALUES
	(1,'sf','2323',2323,'0000-00-00 00:00:00','00:00:23','23','sdf','sd','sd','sd','sd','sd','sd',1,1,1,'standard','failed');

/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
