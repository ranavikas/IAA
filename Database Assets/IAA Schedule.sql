/*
SQLyog Enterprise v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB : Database - iaa_cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `iaa_cms`;

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `schedule_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `study_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `schedule` */

/*Table structure for table `schedule_details` */

DROP TABLE IF EXISTS `schedule_details`;

CREATE TABLE `schedule_details` (
  `schedule_id` bigint(20) NOT NULL,
  `time` time DEFAULT NULL,
  `participant` int(11) DEFAULT NULL,
  `user_group` int(11) DEFAULT NULL,
  `training_condition` tinyint(4) DEFAULT NULL,
  `participant_status` tinyint(4) DEFAULT NULL,
  `participant_order` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `schedule_details` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
