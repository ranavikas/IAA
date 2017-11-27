/*
SQLyog Enterprise v12.4.1 (64 bit)
MySQL - 5.6.36-cll-lve : Database - ccms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `appointment_types` */

DROP TABLE IF EXISTS `appointment_types`;

CREATE TABLE `appointment_types` (
  `type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `appointment_type` varchar(25) NOT NULL,
  `module_type` varchar(25) DEFAULT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `appointment_types` */

insert  into `appointment_types`(`type_id`,`appointment_type`,`module_type`,`record_status`) values 
(1,'Initial Estimate',NULL,1),
(2,'Follow-Up Estimate',NULL,1);

/*Table structure for table `audit` */

DROP TABLE IF EXISTS `audit`;

CREATE TABLE `audit` (
  `audit_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` tinyint(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `record_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`audit_id`),
  KEY `audit_page_id` (`page_id`),
  CONSTRAINT `audit_page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`page_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `audit` */

insert  into `audit`(`audit_id`,`page_id`,`action`,`user_id`,`action_ts`,`record_id`) values 
(1,2,'Password Changed',1,'2017-09-10 07:14:14',NULL),
(2,2,'Password Changed',1,'2017-09-10 07:14:56',NULL),
(3,2,'Password Changed',1,'2017-09-10 07:15:21',NULL),
(4,2,'Password Changed',1,'2017-09-10 07:26:59',NULL),
(5,2,'Password Changed',1,'2017-09-10 08:03:40',NULL),
(6,2,'Password Changed',1,'2017-09-10 08:07:04',NULL),
(7,2,'Password Changed',1,'2017-09-10 08:07:29',NULL),
(8,2,'Password Changed',1,'2017-09-10 08:09:36',NULL),
(9,2,'Updated User',1,'2017-09-10 08:13:20',23),
(10,2,'Updated User',1,'2017-09-10 08:19:56',23);

/*Table structure for table `client_appointments` */

DROP TABLE IF EXISTS `client_appointments`;

CREATE TABLE `client_appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_type` tinyint(4) NOT NULL,
  `work_order` int(11) NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `client_appointments` */

insert  into `client_appointments`(`appointment_id`,`appointment_type`,`work_order`) values 
(1,2,1),
(2,2,2),
(3,2,3),
(4,2,4),
(5,2,5),
(6,2,6),
(7,2,7),
(8,2,8),
(9,2,10),
(10,5,11),
(11,12,12),
(12,16,13),
(13,5,14),
(14,5,15),
(15,18,16),
(16,16,17),
(17,16,18),
(18,16,19),
(19,16,20);

/*Table structure for table `client_status` */

DROP TABLE IF EXISTS `client_status`;

CREATE TABLE `client_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_status` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `client_status` */

insert  into `client_status`(`status_id`,`client_status`,`active`) values 
(1,'New ',1),
(2,'Cold Lead',1),
(3,'Follow Up',1),
(4,'Post Est. Follow Up',1),
(5,'Scheduled for Estimate',1),
(6,'Estimate in Progress',1),
(7,'Estimate Provided',1),
(8,'Provided to Production',1),
(9,'Waiting for Client',1),
(10,'Contract Signed',1),
(11,'In Production',1),
(13,'Work Started',1),
(14,'Closed - Not Sold',1),
(15,'Closed - Cancelled',1),
(16,'Closed - Work Completed',1);

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL COMMENT 'varchar to account for international numbers.',
  `phone_ext` varchar(5) DEFAULT NULL,
  `alternate_phone` varchar(12) DEFAULT NULL,
  `alternate_phone_ext` varchar(5) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `alternate_email` varchar(100) DEFAULT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `zip2` varchar(5) DEFAULT NULL COMMENT 'This is to account for international postal codes.',
  `country` char(2) NOT NULL DEFAULT 'US',
  `qb_synch` tinyint(4) DEFAULT '0',
  `legacy_client_id` varchar(25) DEFAULT NULL,
  `account_number` varchar(25) DEFAULT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `firstname` (`firstname`,`lastname`,`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `clients` */

insert  into `clients`(`client_id`,`firstname`,`lastname`,`phone`,`phone_ext`,`alternate_phone`,`alternate_phone_ext`,`email`,`alternate_email`,`address1`,`address2`,`city`,`state`,`zip`,`zip2`,`country`,`qb_synch`,`legacy_client_id`,`account_number`,`record_status`,`created_at`,`last_modified`) values 
(1,'Clifford ','Riegel','334-606-0771','','','','CliffordJRiegel@rhyta.com','','4864 Turkey Pen Lane','','Columbus','OH','31901','','US',1,NULL,NULL,1,'2017-06-08 21:09:27',NULL),
(2,'David ','Ford','502-632-0301','','','','DavidBFord@teleworm.us','','2814 Earnhardt Drive','','Louisville','KY','40202','','',1,NULL,NULL,1,'2017-06-08 21:09:27','2017-06-09 06:12:08'),
(3,'Susan ','Stith','636-426-6921','','','','SusanEStith@rhyta.com','','693 Rodney Street','','Saint Louis','MO','63146','','',0,NULL,NULL,1,'2017-06-08 21:40:15','2017-06-09 06:40:15'),
(5,'Oliver ','Oconnell','434-555-4071','','','','OliverMOconnell@dayrep.com','','424 Queens Lane','','Richmond','VA','23219','','',0,NULL,NULL,1,'2017-06-08 21:55:19','2017-06-09 06:55:19'),
(6,'Jose ','Hudson','205-287-1980','','','','JenniferSHudson@rhyta.com','','4486 Retreat Avenue','','Birmingham','AL','35291','','',0,NULL,NULL,1,'2017-06-08 21:58:56','2017-06-09 06:58:56'),
(7,'Samuel ','Patricio','903-833-1010','','','','SamuelAPatricio@dayrep.com','','377 Grant Street','','Ben Wheeler','TX','75754','','US',0,NULL,NULL,1,'2017-06-08 22:11:39','2017-06-09 07:11:39'),
(8,'Debbie','Griffin','856-237-0578','','','','DebbieRGriffin@teleworm.us','','374 American Drive','','Camden','NJ','08104','','',1,NULL,NULL,1,'2017-06-08 22:19:34','2017-06-09 07:19:34'),
(10,'Ben ','Gates','847-776-6251','','','','BenJGates@dayrep.com','','1932 Rebecca Street','','Palatine','IL','60067','','',0,NULL,NULL,1,'2017-06-08 23:12:03','2017-06-09 08:12:03'),
(11,'Nancy ','Thurston',' 763-287-464','','','','NancyJThurston@jourrapide.com','','4392 Willison Street','','Minneapolis','MN','55411','','',0,NULL,NULL,1,'2017-06-09 08:55:01','2017-06-09 08:55:01'),
(12,'Iluka ','Otoole','(434) 896-10','','','','il.oto@egl-inc.info','','3368 Sleepy Range','','De Busk Mill','VA','22044','7641','',0,NULL,NULL,1,'2017-06-16 17:26:21','2017-06-17 02:26:21'),
(13,'Sumit ','Carreon','(989) 347-96','','','','sumca@progressenergyinc.info','','7515 Lazy Beach','','Richardsons Mill','MI','49383','','',0,NULL,NULL,1,'2017-06-16 17:39:47','2017-06-17 02:39:47'),
(15,'Adrea','Tencer','415-847-0622','','','','testcustomer@mailinator.com','','8 El Sereno Dr.','','San Carlos','CA','94070','','',1,NULL,NULL,1,'2017-06-16 17:47:29','2017-06-28 21:31:11'),
(17,'Alina','Shytyuk','650-244-1577','','4158470622','415','testcustomer01@mailinator.com','','999 El Camino Real','#7 SMCO ','Redwood City','CA','94027','94070','',0,NULL,NULL,1,'2017-06-16 17:52:27','2017-07-30 16:41:13'),
(18,'Emmanual','Terrace','408-923-8280','','4158470622','415','testcustomer02@mailinator.com','','999 Francis Drive','','San Mateo','CA','94070','','',0,NULL,NULL,1,'2017-06-16 17:55:50','2017-06-17 02:55:50'),
(19,'Tony','Hull','(228) 708-96','','','','tony.hull@arvinmeritor.com','','4527 Tawny Valley','','Devils Elbow','MI','38645','4361','',1,NULL,NULL,1,'2017-06-19 15:25:50','2017-06-20 00:25:50'),
(20,'Robert','Malone','501-671-8435','','','','RobertIMalone@teleworm.us','','4979 Bassell Avenue','','Little Rock','AR','72205','','',0,NULL,NULL,1,'2017-06-27 00:18:50','2017-06-27 09:18:50'),
(21,'Ryan','Simpson','352-416-3332','','','','RyanJSimpson@jourrapide.com','','2209 George Street','','Ocala','FL','34471','','',0,NULL,NULL,1,'2017-06-27 09:47:05','2017-06-27 09:47:05'),
(22,'William','Gilligan','555-987-2298','','','','william.gilligan@mailinator.com','','123 Main Street','','Beverly Hills','CA','90210','','',0,NULL,NULL,1,'2017-06-28 21:33:59','2017-06-28 21:33:59'),
(23,'Thurston','Howell','562-999-9999','','','','thurston.howell@mailinator.com','','661 West Browadway','','Long Beach','CA','90802','','',0,NULL,NULL,1,'2017-06-28 21:35:09','2017-06-28 21:35:09'),
(24,'Daewn','Wells','989-765-0099','','','','dwell@mailinator.com','','6466 Howell Stree','','La Hambra','CA','90655','','',0,NULL,NULL,1,'2017-06-28 21:42:09','2017-06-28 21:42:09'),
(25,'Shagorika','Dixit','408-998-4786','','','','shagorika.dixit@gmail.com','','1234 emerald bay st','','Cupertino','CA','95014','','',0,NULL,NULL,1,'2017-07-09 20:00:53','2017-07-09 20:00:53'),
(26,'Amir','Frank','408-998-2837','','','','amir.frank@gmail.com','','3456 Mary st','','Sunnyvale','CA','94087','','',0,NULL,NULL,1,'2017-07-09 20:02:26','2017-07-09 20:02:26');

/*Table structure for table `contractors` */

DROP TABLE IF EXISTS `contractors`;

CREATE TABLE `contractors` (
  `contractor_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `contractor_title` varchar(25) DEFAULT NULL,
  `contractor_organization` varchar(50) DEFAULT NULL,
  `person_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`contractor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contractors` */

/*Table structure for table `deleted_clients` */

DROP TABLE IF EXISTS `deleted_clients`;

CREATE TABLE `deleted_clients` (
  `client_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL COMMENT 'varchar to account for international numbers.',
  `phone_ext` varchar(5) DEFAULT NULL,
  `alternate_phone` varchar(12) DEFAULT NULL,
  `alternate_phone_ext` varchar(5) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `alternate_email` varchar(100) DEFAULT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `zip2` varchar(5) DEFAULT NULL COMMENT 'This is to account for international postal codes.',
  `country` char(2) NOT NULL DEFAULT 'US',
  `legacy_client_id` varchar(25) DEFAULT NULL,
  `account_number` varchar(25) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `deleted_clients` */

insert  into `deleted_clients`(`client_id`,`firstname`,`lastname`,`phone`,`phone_ext`,`alternate_phone`,`alternate_phone_ext`,`email`,`alternate_email`,`address1`,`address2`,`city`,`state`,`zip`,`zip2`,`country`,`legacy_client_id`,`account_number`,`created_at`,`deleted_at`) values 
(4,'Rainbow','Johnson','555-555-5555','','','','test@email.com','','123 Main Street','Unit 101','Beverly Hills','CA','90210','','US',NULL,NULL,'2017-06-08 21:50:53','2017-06-19 23:16:19'),
(9,'Reginald ','Raymond','352-588-1261','','','','ReginaldLRaymond@rhyta.com','','2789 Bagwell Avenue','','San Antonio','FL','33576','','',NULL,NULL,'2017-06-08 23:00:52','2017-06-20 20:47:48');

/*Table structure for table `email_actions` */

DROP TABLE IF EXISTS `email_actions`;

CREATE TABLE `email_actions` (
  `id` bigint(20) unsigned NOT NULL,
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `options` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table for store all dynamic variables used in email template';

/*Data for the table `email_actions` */

insert  into `email_actions`(`id`,`action`,`options`) values 
(1,'account_verification','USER_NAME,VALIDATE_STRING,URL'),
(2,'thanks_for_registration','USER_NAME'),
(3,'forgot_password','USER_NAME,FORGOT_PASSWORD_LINK,LINK'),
(4,'reset_password','SiteUsername'),
(17,'user_registration','USER_NAME,EMAIL,PASSWORD,LOGIN_LINK,LINK'),
(19,'replay_to_user','USER_NAME,MESSAGE'),
(20,'send_login_credentials','USER_NAME,EMAIL,PASSWORD,LOGIN_LINK,LINK'),
(25,'contact_us','USER_NAME,EMAIL,SUBJECT,MESSAGE'),
(26,'contact_us','NAME,EMAIL,SUBJECT,MESSAGE'),
(27,'account_disabled','USER_NAME'),
(28,'account_disabled_by_admin','USER_NAME');

/*Table structure for table `email_log` */

DROP TABLE IF EXISTS `email_log`;

CREATE TABLE `email_log` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `email_template` varchar(50) NOT NULL,
  `recipient` varchar(100) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `results` varchar(500) NOT NULL,
  `sent_at` datetime NOT NULL,
  `email_template_id` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `email_log` */

insert  into `email_log`(`email_id`,`email_template`,`recipient`,`client_id`,`results`,`sent_at`,`email_template_id`) values 
(1,'New User Account','rinat.kaufman@gmail.com',NULL,'2','2017-07-09 19:41:46',NULL),
(2,'New User Account','rinat@hearttohouse.com',NULL,'2','2017-07-09 19:44:07',NULL),
(3,'New User Account','rinat_kaufman@hotmail.com',NULL,'2','2017-07-09 19:45:06',NULL),
(4,'New User Account','shar.kole1@gmail.com',NULL,'2','2017-07-09 19:48:16',NULL),
(5,'Appointment Changed','bob.johnson@mailinator.com',NULL,'2','2017-07-09 20:17:08',NULL),
(6,'Appointment Changed','bob.johnson@mailinator.com',NULL,'','2017-07-09 20:17:08',NULL),
(7,'Scheduled for Estimate','bob.johnson@mailinator.com',NULL,'2','2017-07-22 01:33:51',NULL),
(8,'Scheduled for Estimate','bob.johnson@mailinator.com',NULL,'','2017-07-22 01:33:51',NULL),
(9,'Appointment Changed','bob.johnson@mailinator.com',NULL,'2','2017-07-22 01:33:53',NULL),
(10,'Appointment Changed','bob.johnson@mailinator.com',NULL,'','2017-07-22 01:33:53',NULL),
(11,'Scheduled for Estimate','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:42:29',NULL),
(12,'Scheduled for Estimate','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:42:29',NULL),
(13,'Appointment Changed','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:42:29',NULL),
(14,'Appointment Changed','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:42:29',NULL),
(15,'Scheduled for Estimate','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:47:09',NULL),
(16,'Scheduled for Estimate','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:47:09',NULL),
(17,'Appointment Changed','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:47:09',NULL),
(18,'Appointment Changed','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:47:09',NULL),
(19,'Appointment Changed','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:48:16',NULL),
(20,'Appointment Changed','bob.johnson@mailinator.com',NULL,'1','2017-07-22 01:48:16',NULL),
(21,'New User Account','bob@mailinator.com',NULL,'2','2017-08-23 01:32:16',NULL),
(22,'Password Reset','bob@mailinator.com',NULL,'2','2017-08-28 03:24:36',NULL),
(23,'New User Account','vinodrev11@gmail.com',NULL,'2','2017-09-02 04:59:00',NULL),
(24,'New User Account','vinodrev12@gmail.com',NULL,'2','2017-09-02 07:11:33',NULL),
(25,'New User Account','vinodrev@gmail.com',NULL,'2','2017-09-02 07:27:21',NULL),
(26,'New User Account','crm.testuser@mailinator.com',NULL,'2','2017-09-05 23:12:36',NULL),
(27,'New User Account','testuser@mailinator.com',NULL,'2','2017-09-07 06:41:08',NULL);

/*Table structure for table `email_queue` */

DROP TABLE IF EXISTS `email_queue`;

CREATE TABLE `email_queue` (
  `queue_id` int(11) NOT NULL AUTO_INCREMENT,
  `recipient` varchar(100) NOT NULL,
  `email_template` int(11) NOT NULL,
  `email_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=pending; 1=delivered; 2=error',
  `status_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `email_queue` */

insert  into `email_queue`(`queue_id`,`recipient`,`email_template`,`email_status`,`status_ts`) values 
(1,'sjmcarter@mailinator.com',1,0,'2017-05-17 09:22:40');

/*Table structure for table `email_templates` */

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `template_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(50) NOT NULL,
  `action` varchar(255) DEFAULT NULL,
  `email_subject` varchar(100) NOT NULL,
  `email_body` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`template_id`),
  UNIQUE KEY `name_index` (`template_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `email_templates` */

insert  into `email_templates`(`template_id`,`template_name`,`action`,`email_subject`,`email_body`,`status`,`created`,`last_modified`) values 
(1,'New User Account','user_registration_admin','A New Account Has Been Created','A new user account for Sigura Construction client management has been created.\n\nURL: {WEBSITE_URL}\nUsername: {SiteUsername}\nPassword: {SitePassword}',1,NULL,NULL),
(2,'Scheduled for Estimate','scheduled_for_estimate','Scheduled for Estimate','Hi [[EstimatorName]],\r\n\r\nYou have an appointment scheduled with [[ClientName]] located at [[ClientAddress]] on [[AppointmentDate]] at [[AppointmentTime]].\r\n\r\nThe scope is [[Scope]].\r\nLead Source: [[LeadSource]]\r\nPhone number: [[ClientPhone]]\r\nEmail: [[ClientEmail]]\r\n\r\nPlease remember to check your calendar and confirm with the client 1 hour before the scheduled appointment.\r\n',1,NULL,NULL),
(3,'Appointment Changed','','An Appointment Has Changed','<p>Hi [[EstimatorName]],</p>\r\n\r\n<p>Your appointment with [[ClientName]] located at [[ClientAddress]] has been rescheduled.</p>\r\n\r\n<p>The new appointment is scheduled on [[AppointmentDate]] at [[AppointmentTime]].</p>\r\n\r\n<p>Please remember to check your calendar and confirm with the client 1 hour before the scheduled appointment.</p>',1,NULL,NULL),
(4,'Provided to Production','','New Job Submitted to Production','<ul>\r\n	<li>[[LeadType]]</li>\r\n	<li>[[ClientName]]</li>\r\n	<li>[[ClientAddress]]</li>\r\n	<li>[[EstimatorName]]</li>\r\n	<li>[[LeadSource]]</li>\r\n	<li>[[WorkOrderScope]]</li>\r\n	<li>[[SignedContractDate]]</li>\r\n	<li>[[WorkOrderContractAmount]]</li>\r\n</ul>',1,NULL,NULL),
(5,'Password Reset','reset_password','Your Password Has Been Reset','<p>Hello [[SiteUsername]],</p>\r\n\r\n<p>The password for your account at [[SiteURL]]&nbsp;has changed. If you did not make this change, please contact your administrator.</p>\r\n\r\n<p>Thanks!</p>\r\n\r\n<p>&nbsp;</p>',1,NULL,NULL),
(6,'User Registration','user_registration','Welcome to Sigura Registration','<h3>Dear [[USER_NAME]],</h3>\r\nGreeetings of the Day..<br />\r\n<br />\r\n<em>We wanted to let you know that </em>you are now registered with Website<br />\r\n<br />\r\nYour Email address is &quot;[[EMAIL]]&quot;<br />\r\nAnd&nbsp; password is &quot;[[PASSWORD]]&quot;.<br />\r\n<br />\r\nPlease follow the link and login with your email address and password.\r\n<p><a href=\"[[LOGIN_LINK]]\">Click here</a><br />\r\n<br />\r\nOR<br />\r\n<br />\r\nCopy below URL in your browser.<br />\r\n[[LINK]]</p>\r\n\r\n<p>Thanks</p>',1,NULL,NULL),
(7,'Forgot Password','forgot_password','Forgot Password','<h3>Dear {USER_NAME},</h3>\r\n\r\n<p>Greeetings of the Day..<br />\r\n<br />\r\n<br />\r\nPlease follow the link to reset your password.</p>\r\n\r\n<p><a href=\"{FORGOT_PASSWORD_LINK}\">Click here</a><br />\r\n<br />\r\nOR<br />\r\n<br />\r\nCopy below URL in your browser.<br />\r\n{LINK}</p>\r\nThanks.',1,NULL,NULL),
(8,'Account Disable','account_disabled','Account disable','<h3>Dear {USER_NAME},</h3>\n\n<br />\n<br />\nYou have enter wrong password more than 3 attempt your account is disabled please contact your administrator .</p>\n',1,NULL,NULL),
(9,'Account Disabled By Admin','account_disabled_by_admin','Account disabled','<h3>Hello a user {USER_NAME},</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>hhfgfh<br />\r\nattempt wrong password more then 3 times this account is disabled.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>',1,NULL,NULL),
(10,'Test Template','','This is a Test','<p>Site: [[SiteURL]]</p>\r\n\r\n<p>lorem ipsum</p>',3,NULL,NULL);

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `phone1` varchar(10) DEFAULT NULL,
  `phone2` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `employment_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `UC_Employee` (`firstname`,`lastname`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `employees` */

insert  into `employees`(`employee_id`,`firstname`,`lastname`,`department`,`title`,`phone1`,`phone2`,`email`,`employment_status`) values 
(1,'John','Smith','Sales','Sales Associate','1234567890',NULL,'test@email.com',1),
(2,'Scott','Summers',NULL,'HOA Admin',NULL,NULL,'scottsummers@mailinator.com   ',1),
(3,'Bob','testUser',NULL,NULL,NULL,NULL,'bob_ccms@mailinator',1),
(4,'Rinat','testUser',NULL,NULL,NULL,NULL,'bob_ccms@mailinator',1),
(5,'Doris','testUser',NULL,NULL,NULL,NULL,'doris_ccms@mailinator',1);

/*Table structure for table `estimators` */

DROP TABLE IF EXISTS `estimators`;

CREATE TABLE `estimators` (
  `estimator_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`estimator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `estimators` */

insert  into `estimators`(`estimator_id`,`user_id`) values 
(1,5),
(2,12),
(3,13),
(4,15),
(5,16),
(6,17),
(7,18),
(8,27);

/*Table structure for table `lead_sources` */

DROP TABLE IF EXISTS `lead_sources`;

CREATE TABLE `lead_sources` (
  `lead_source_id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `lead_source` varchar(50) NOT NULL,
  `record_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`lead_source_id`),
  UNIQUE KEY `name_index` (`lead_source`),
  UNIQUE KEY `lead_source` (`lead_source`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `lead_sources` */

insert  into `lead_sources`(`lead_source_id`,`lead_source`,`record_status`) values 
(1,'Angie\'s List',1),
(2,'CACM',1),
(3,'City',1),
(4,'Diamond Certified',1),
(5,'Google Search',1),
(6,'Google Search - Diamond Certified site',1),
(7,'Google Search - Website',1),
(8,'HOA',1),
(9,'Houzz',1),
(10,'Home Advisor ',1),
(12,'Other Web Site',1),
(13,'Prime Buyers',1),
(14,'Public Works',1),
(15,'Realtor',1),
(16,'Referral',1),
(17,'Returning Client',1),
(18,'Signs',1),
(19,'Yelp',1),
(20,'SCC Verified Home Services',1),
(21,'Truck Signs',1),
(22,'Other',1),
(25,'Test Lead Source',1),
(27,'Other Test Lead Source',1),
(29,'Other Test Lead Source 2',1),
(32,'Other Test Lead Source 3',1);

/*Table structure for table `lead_types` */

DROP TABLE IF EXISTS `lead_types`;

CREATE TABLE `lead_types` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lead_type` varchar(25) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `lead_types` */

insert  into `lead_types`(`id`,`lead_type`,`record_status`) values 
(1,'Residential',1),
(2,'Commercial',1),
(3,'HOA',1),
(4,'Public Works',1),
(5,'Painting',1);

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `login_attempts` */

/*Table structure for table `logins` */

DROP TABLE IF EXISTS `logins`;

CREATE TABLE `logins` (
  `login_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(25) NOT NULL,
  `login_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_timestamp` datetime DEFAULT NULL,
  `ip_address` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=latin1;

/*Data for the table `logins` */

insert  into `logins`(`login_id`,`user_id`,`session_id`,`login_timestamp`,`logout_timestamp`,`ip_address`) values 
(1,1,'593a3fbb3f588','2017-06-08 23:27:07','2017-06-09 08:27:35',NULL),
(2,1,'593a401e03ceb','2017-06-09 08:28:46','2017-06-09 08:28:49',NULL),
(3,1,'593a4128c25d1','2017-06-09 08:33:12','2017-06-09 11:11:56',NULL),
(4,1,'593a665d8d65b','2017-06-09 11:11:57',NULL,NULL),
(5,1,'593ac5c2c686c','2017-06-09 17:58:58',NULL,NULL),
(6,1,'593b35c85d64b','2017-06-10 01:56:56',NULL,NULL),
(7,1,'5940290386211','2017-06-13 20:03:47',NULL,NULL),
(8,1,'594394671d24d','2017-06-16 10:18:47',NULL,NULL),
(9,1,'59446794c651a','2017-06-17 01:19:48','2017-06-17 08:08:52',NULL),
(10,1,'5944c77e945c9','2017-06-17 08:09:02',NULL,NULL),
(11,1,'59484c666dfc0','2017-06-20 00:12:54',NULL,NULL),
(12,18,'594878fa3de19','2017-06-20 03:23:06','2017-06-20 03:23:33',NULL),
(13,1,'594879198f027','2017-06-20 03:23:37',NULL,NULL),
(14,1,'59489b8c7aadb','2017-06-20 05:50:36',NULL,NULL),
(15,1,'5949e9b23a81e','2017-06-21 05:36:18','2017-06-21 07:25:17',NULL),
(16,1,'594a033fc00a2','2017-06-21 07:25:19',NULL,NULL),
(17,1,'594b07a605e0e','2017-06-22 01:56:22',NULL,NULL),
(18,1,'594b524a22450','2017-06-22 07:14:50',NULL,NULL),
(19,1,'5951db98a0133','2017-06-27 06:14:16',NULL,NULL),
(20,1,'5952d8adc5b33','2017-06-28 00:14:05',NULL,NULL),
(21,1,'59533a74d77a0','2017-06-28 07:11:16',NULL,NULL),
(22,1,'59535933b85d3','2017-06-28 07:22:27',NULL,NULL),
(23,1,'59535adf25e67','2017-06-28 07:29:35',NULL,NULL),
(24,1,'59541ef0f1168','2017-06-28 21:26:08',NULL,NULL),
(25,1,'595527ddc5525','2017-06-29 16:16:29',NULL,NULL),
(26,1,'59555388c4bcc','2017-06-29 19:22:48',NULL,NULL),
(27,1,'5956842596985','2017-06-30 17:02:29',NULL,NULL),
(28,1,'595ae481278dd','2017-07-04 00:42:41',NULL,NULL),
(29,1,'595e89dc3d2b2','2017-07-06 19:05:00',NULL,NULL),
(30,1,'596285867f3ba','2017-07-09 19:35:34','2017-07-09 19:36:12',NULL),
(31,1,'596286749f727','2017-07-09 19:39:32','2017-07-09 19:48:38',NULL),
(32,21,'596288c7cbc81','2017-07-09 19:49:27',NULL,NULL),
(33,21,'596289b300e15','2017-07-09 19:53:23',NULL,NULL),
(34,20,'59628a5ac679d','2017-07-09 19:56:10',NULL,NULL),
(35,1,'59628a90acbb3','2017-07-09 19:57:04',NULL,NULL),
(36,1,'5965064052b0b','2017-07-11 17:09:20',NULL,NULL),
(37,1,'59670c5b8398e','2017-07-13 05:59:55','2017-07-13 06:03:18',NULL),
(38,21,'59670d6659c82','2017-07-13 06:04:22','2017-07-13 06:16:07',NULL),
(39,21,'5967102da7b0c','2017-07-13 06:16:13',NULL,NULL),
(40,1,'59686aff9c231','2017-07-14 06:55:59',NULL,NULL),
(41,1,'59702d34285af','2017-07-20 04:10:28',NULL,NULL),
(42,1,'59709c84966eb','2017-07-20 12:05:24',NULL,NULL),
(43,1,'5972a39677105','2017-07-22 01:00:06','2017-07-22 01:01:19',NULL),
(44,1,'5972a3e1eae46','2017-07-22 01:01:21',NULL,NULL),
(45,1,'5973ebc6be5d0','2017-07-23 00:20:22',NULL,NULL),
(46,1,'5973ec4326aa4','2017-07-23 00:22:27',NULL,NULL),
(47,1,'597821c432223','2017-07-26 04:59:48',NULL,NULL),
(48,1,'5978281e27fb0','2017-07-26 05:26:54',NULL,NULL),
(49,1,'5978632bc5bd4','2017-07-26 09:38:51',NULL,NULL),
(50,1,'597e0b9b8f7f3','2017-07-30 16:38:51',NULL,NULL),
(51,1,'597fbbf49d3ec','2017-07-31 23:23:32',NULL,NULL),
(52,1,'597fdf188925d','2017-08-01 01:53:28',NULL,NULL),
(53,1,'597fdf34ef84a','2017-08-01 01:53:56',NULL,NULL),
(54,1,'598002a79e1f0','2017-08-01 04:25:11',NULL,NULL),
(55,1,'5981153017093','2017-08-01 23:56:32','2017-08-02 00:41:47',NULL),
(56,1,'598bd3a186cde','2017-08-10 03:31:45',NULL,NULL),
(57,1,'598ea536cf817','2017-08-12 06:50:30','2017-08-12 06:57:00',NULL),
(58,1,'598ea6bea902e','2017-08-12 06:57:02',NULL,NULL),
(59,1,'5998e802c2c64','2017-08-20 01:38:10','2017-08-20 01:58:22',NULL),
(60,1,'5998ecdc8c944','2017-08-20 01:58:52','2017-08-20 02:07:46',NULL),
(61,21,'5998ef2168a15','2017-08-20 02:08:33','2017-08-20 02:10:15',NULL),
(62,1,'5998ef9173cf5','2017-08-20 02:10:25','2017-08-20 02:11:06',NULL),
(63,20,'5998efcf32c07','2017-08-20 02:11:27',NULL,NULL),
(64,1,'599cdadf2458c','2017-08-23 01:31:11',NULL,NULL),
(65,1,'59a38c36a826a','2017-08-28 03:21:26','2017-08-28 03:24:43',NULL),
(66,16,'59a38d028ca49','2017-08-28 03:24:50','2017-08-28 03:25:35',NULL),
(67,1,'59a38d322b87a','2017-08-28 03:25:38','2017-08-28 03:26:18',NULL),
(68,1,'59a38d5be41be','2017-08-28 03:26:19',NULL,NULL),
(69,1,'59a8da13c1923','2017-09-01 03:54:59',NULL,NULL),
(70,1,'59a9a5af74c0f','2017-09-01 18:23:43','2017-09-01 18:28:14',NULL),
(71,1,'59a9a6dccc21d','2017-09-01 18:28:44','2017-09-01 18:29:57',NULL),
(72,1,'59aa38dde3afc','2017-09-02 04:51:41','2017-09-02 07:01:45',NULL),
(73,23,'59aa57651bd65','2017-09-02 07:01:57','2017-09-02 07:55:29',NULL),
(74,1,'59aa588edad28','2017-09-02 07:06:54',NULL,NULL),
(75,23,'59aa64968db54','2017-09-02 07:58:14','2017-09-02 08:01:48',NULL),
(76,23,'59aa6574eb15b','2017-09-02 08:01:56','2017-09-02 08:02:44',NULL),
(77,23,'59aa65ac31a48','2017-09-02 08:02:52','2017-09-02 08:03:30',NULL),
(78,23,'59aa65e5b37e4','2017-09-02 08:03:49','2017-09-02 08:05:55',NULL),
(79,23,'59aa666d3b0a3','2017-09-02 08:06:05','2017-09-02 08:32:02',NULL),
(80,23,'59aa6cd0ba762','2017-09-02 08:33:20','2017-09-02 08:34:09',NULL),
(81,23,'59aa6d08372f3','2017-09-02 08:34:16','2017-09-02 08:34:46',NULL),
(82,23,'59aa6d3fdfa5f','2017-09-02 08:35:11','2017-09-02 08:36:00',NULL),
(83,23,'59aa6d77631b9','2017-09-02 08:36:07','2017-09-02 08:36:17',NULL),
(84,23,'59aa6d983acc4','2017-09-02 08:36:40','2017-09-02 08:37:11',NULL),
(85,23,'59aa6dbe6904f','2017-09-02 08:37:18','2017-09-02 08:38:07',NULL),
(86,23,'59aa6df5aea8c','2017-09-02 08:38:13','2017-09-02 08:39:25',NULL),
(87,23,'59aa6e45288c7','2017-09-02 08:39:33','2017-09-02 08:41:32',NULL),
(88,23,'59aa6ec3e4d5f','2017-09-02 08:41:39','2017-09-02 08:41:46',NULL),
(89,23,'59aa72fa46058','2017-09-02 08:59:38','2017-09-02 09:02:16',NULL),
(90,23,'59aa73a17a3eb','2017-09-02 09:02:25','2017-09-02 09:20:07',NULL),
(91,23,'59aa77da481bb','2017-09-02 09:20:26','2017-09-02 09:22:22',NULL),
(92,23,'59aa785e8b340','2017-09-02 09:22:38','2017-09-02 09:33:29',NULL),
(93,23,'59aa7af17ee82','2017-09-02 09:33:37','2017-09-02 09:55:10',NULL),
(94,23,'59aa8006865b3','2017-09-02 09:55:18','2017-09-02 10:39:05',NULL),
(95,23,'59aa8a5105b09','2017-09-02 10:39:13','2017-09-02 10:41:21',NULL),
(96,23,'59aa8ad9238e0','2017-09-02 10:41:29','2017-09-02 10:41:55',NULL),
(97,23,'59aa8afade4f4','2017-09-02 10:42:02','2017-09-02 10:42:28',NULL),
(98,23,'59aa8b1af2709','2017-09-02 10:42:34','2017-09-02 10:43:00',NULL),
(99,23,'59aa8b415d9e3','2017-09-02 10:43:13','2017-09-02 10:43:50',NULL),
(100,23,'59aa8b6d968c6','2017-09-02 10:43:57','2017-09-02 10:51:23',NULL),
(101,23,'59aa8d33521f6','2017-09-02 10:51:31','2017-09-02 10:52:04',NULL),
(102,23,'59aa8d5bc61ae','2017-09-02 10:52:11','2017-09-02 10:56:52',NULL),
(103,23,'59aa8e7c5189c','2017-09-02 10:57:00','2017-09-02 10:57:32',NULL),
(104,23,'59aa8ea30b7de','2017-09-02 10:57:39','2017-09-02 11:00:54',NULL),
(105,23,'59aa8f79a5be7','2017-09-02 11:01:13','2017-09-02 11:03:02',NULL),
(106,23,'59aa8ff23c35e','2017-09-02 11:03:14','2017-09-02 11:03:51',NULL),
(107,23,'59aa901ed8336','2017-09-02 11:03:58','2017-09-02 11:05:12',NULL),
(108,23,'59aa906f602e4','2017-09-02 11:05:19',NULL,NULL),
(109,23,'59aba1f81b149','2017-09-03 06:32:24','2017-09-03 06:35:47',NULL),
(110,1,'59aba259c8418','2017-09-03 06:34:01','2017-09-03 09:34:10',NULL),
(111,23,'59aba2c95c1eb','2017-09-03 06:35:53','2017-09-03 06:36:42',NULL),
(112,23,'59aba303ddd22','2017-09-03 06:36:51','2017-09-03 06:57:19',NULL),
(113,23,'59aba7d812965','2017-09-03 06:57:28','2017-09-03 06:57:43',NULL),
(114,23,'59aba7ff67bdd','2017-09-03 06:58:07','2017-09-03 06:58:38',NULL),
(115,23,'59aba83504026','2017-09-03 06:59:01','2017-09-03 06:59:07',NULL),
(116,23,'59aba84fdaff2','2017-09-03 06:59:27','2017-09-03 06:59:36',NULL),
(117,23,'59aba87a3e05d','2017-09-03 07:00:10','2017-09-03 07:00:18',NULL),
(118,23,'59aba89b85507','2017-09-03 07:00:43','2017-09-03 07:03:37',NULL),
(119,23,'59aba97f80613','2017-09-03 07:04:31','2017-09-03 07:05:13',NULL),
(120,23,'59aba9b0bb7c0','2017-09-03 07:05:20','2017-09-03 07:06:03',NULL),
(121,23,'59aba9f073a5d','2017-09-03 07:06:24','2017-09-03 07:10:28',NULL),
(122,23,'59abaaebd6bea','2017-09-03 07:10:35','2017-09-03 07:10:43',NULL),
(123,23,'59abab7254fd3','2017-09-03 07:12:50','2017-09-03 07:12:58',NULL),
(124,23,'59abab94e7808','2017-09-03 07:13:24','2017-09-03 07:18:13',NULL),
(125,23,'59abad0942c4d','2017-09-03 07:19:37','2017-09-03 07:20:03',NULL),
(126,23,'59abad2c0eb25','2017-09-03 07:20:12','2017-09-03 07:31:55',NULL),
(127,23,'59abaff33a963','2017-09-03 07:32:03','2017-09-03 07:32:30',NULL),
(128,23,'59abb01677b4d','2017-09-03 07:32:38','2017-09-03 07:33:39',NULL),
(129,23,'59abb059bbd33','2017-09-03 07:33:45','2017-09-03 08:19:36',NULL),
(130,23,'59abbb2124b4c','2017-09-03 08:19:45','2017-09-03 08:20:19',NULL),
(131,23,'59abbb4af0207','2017-09-03 08:20:26','2017-09-03 08:20:43',NULL),
(132,23,'59abbb6fd0958','2017-09-03 08:21:03','2017-09-03 08:30:43',NULL),
(133,23,'59abbdbf05959','2017-09-03 08:30:55','2017-09-03 08:56:11',NULL),
(134,23,'59abc3b57c4c8','2017-09-03 08:56:21','2017-09-03 09:29:17',NULL),
(135,1,'59af2dbebe343','2017-09-05 23:05:34',NULL,NULL),
(136,26,'59af2f852393c','2017-09-05 23:13:09','2017-09-05 23:27:25',NULL),
(137,26,'59af32e497546','2017-09-05 23:27:32','2017-09-05 23:40:20',NULL),
(138,26,'59af7a5d86ca0','2017-09-06 04:32:29',NULL,NULL),
(139,1,'59b0e9a7bb4b0','2017-09-07 06:39:35','2017-09-07 06:44:48',NULL),
(140,27,'59b0ea171bead','2017-09-07 06:41:27','2017-09-07 06:42:26',NULL),
(141,27,'59b0ea5533703','2017-09-07 06:42:29','2017-09-07 06:42:39',NULL),
(142,27,'59b0ea60dba5f','2017-09-07 06:42:40',NULL,NULL),
(143,1,'59b4e04019d7d','2017-09-10 06:48:32','2017-09-10 06:48:47',NULL),
(144,26,'59b4e064400de','2017-09-10 06:49:08',NULL,NULL),
(145,1,'59b4e5055b110','2017-09-10 07:08:53','2017-09-10 09:20:45',NULL),
(146,23,'59b4e5e2ad0a9','2017-09-10 07:12:34','2017-09-10 07:13:06',NULL),
(147,23,'59b4e94fe7f25','2017-09-10 07:27:11','2017-09-10 07:27:22',NULL),
(148,23,'59b4f1ea0ca9d','2017-09-10 08:03:54','2017-09-10 08:03:58',NULL),
(149,23,'59b4f2fc6c98a','2017-09-10 08:08:28','2017-09-10 08:08:41',NULL),
(150,23,'59b4f3fda9217','2017-09-10 08:12:45','2017-09-10 08:13:00',NULL),
(151,23,'59b4f58593c38','2017-09-10 08:19:17','2017-09-10 08:19:46',NULL),
(152,23,'59b4f6848d407','2017-09-10 08:23:32','2017-09-10 09:03:33',NULL),
(153,23,'59b4ffee79bae','2017-09-10 09:03:42',NULL,NULL),
(154,27,'59c1ce2fa2730','2017-09-20 02:10:55','2017-09-20 02:13:29',NULL),
(155,27,'59c1d340e3b95','2017-09-20 02:32:32',NULL,NULL),
(156,27,'59ca440dbf0a1','2017-09-26 12:11:57',NULL,NULL),
(157,1,'59ceff131ce5e','2017-09-30 02:18:59','2017-09-30 02:28:14',NULL),
(158,1,'59cf014045204','2017-09-30 02:28:16',NULL,NULL),
(159,1,'59d2ec6c93b88','2017-10-03 01:48:28',NULL,NULL),
(160,1,'59d9b882e6a9c','2017-10-08 05:32:50',NULL,NULL),
(161,1,'59e9740a976fc','2017-10-20 03:56:58',NULL,NULL);

/*Table structure for table `mail_variables` */

DROP TABLE IF EXISTS `mail_variables`;

CREATE TABLE `mail_variables` (
  `variable_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `variable_name` varchar(25) NOT NULL,
  `variable_description` varchar(100) DEFAULT NULL,
  `variable_datatype` tinyint(4) NOT NULL DEFAULT '2',
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`variable_id`),
  UNIQUE KEY `variable_name` (`variable_name`,`record_status`),
  KEY `mailvars_datatype` (`variable_datatype`),
  KEY `mailvars_status` (`record_status`),
  CONSTRAINT `mailvars_datatype` FOREIGN KEY (`variable_datatype`) REFERENCES `variable_datatypes` (`datatype_id`) ON UPDATE CASCADE,
  CONSTRAINT `mailvars_status` FOREIGN KEY (`record_status`) REFERENCES `record_status` (`status_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `mail_variables` */

insert  into `mail_variables`(`variable_id`,`variable_name`,`variable_description`,`variable_datatype`,`record_status`) values 
(1,'SiteURL','URL of current site',3,1),
(2,'UserUsername','username of selected user',2,1),
(4,'ClientName','Proper full name of selected client',1,1),
(5,'ClientAddress','Full address of selected client',2,1),
(6,'ClientPhone','Default phone of selected client',2,1),
(7,'ClientEmail','Default email of selected client',2,1),
(8,'ClientAppointmentDate',NULL,2,1),
(9,'ClientApointmentTime',NULL,2,1),
(10,'WorkOrderContractAmount',NULL,8,1),
(11,'WorkOrderScope',NULL,2,1),
(12,'LeadType',NULL,2,1),
(13,'EstimatorName',NULL,2,1),
(14,'LeadSource',NULL,2,1),
(15,'SignedContractDate',NULL,6,1);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `page_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) NOT NULL,
  `page_url` varchar(50) NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `permission_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1= view/edit/delete; 2=yes/no',
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `UC_Page` (`page_name`,`page_url`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`page_id`,`page_name`,`page_url`,`section`,`parent`,`permission_type`) values 
(1,'User Roles','admin/roles','Admin',NULL,1),
(2,'Users','admin/users','Admin',NULL,1),
(3,'Email Templates','system/email_templates','System',NULL,1),
(4,'Audit Log','system/audit_log','System',NULL,1),
(5,'Email Log','system/mail_log','System',NULL,1),
(6,'Clients','admin/clients','Admin',NULL,1),
(7,'WorkOrders','admin/Orders','Orders',NULL,1),
(8,'ProductionEmails','system/workflows','System',NULL,1),
(9,'Reports - Estimators Dashboard','reports/estimator_dashboard','Reports',NULL,2),
(14,'Reports - Leads Dashboard','reports/leads_dashboard','Reports',NULL,2),
(15,'Reports - Followup Dashboard','reports/followup_dashboard','Reports',NULL,2),
(16,'Reports - Completed Jobs Dashboard','reports/completed_jobs','Reports',NULL,2),
(17,'Reports - Calculated Reports','',NULL,NULL,2),
(18,'WorkOrders - Admin View','','WorkOrders',NULL,2),
(19,'WorkOrders - Leads View','',NULL,NULL,2),
(20,'WorkOrders - Estimator View','',NULL,NULL,2),
(21,'WorkOrders - Production View','',NULL,NULL,2),
(22,'QuickBooks','admin/Qb','QuickBooks',NULL,1);

/*Table structure for table `password_reset` */

DROP TABLE IF EXISTS `password_reset`;

CREATE TABLE `password_reset` (
  `reset_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `ip` varchar(25) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `token` varchar(50) NOT NULL,
  `token_exp` datetime NOT NULL,
  `token_status` tinyint(4) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`reset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `password_reset` */

insert  into `password_reset`(`reset_id`,`email`,`ip`,`created_at`,`token`,`token_exp`,`token_status`,`user_id`) values 
(1,'sjmcarter4@mailinator.com','::1','2017-06-10 07:02:57','PfDCyCdm7Tl2m2EoCwdC','2017-06-12 07:02:57',1,15);

/*Table structure for table `permission_types` */

DROP TABLE IF EXISTS `permission_types`;

CREATE TABLE `permission_types` (
  `type_id` tinyint(4) NOT NULL,
  `perm_name` varchar(15) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `perm_name` (`perm_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `permission_types` */

insert  into `permission_types`(`type_id`,`perm_name`) values 
(3,'Add'),
(4,'Delete'),
(2,'Edit'),
(0,'NONE'),
(1,'View');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `permission_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(50) NOT NULL,
  `permission_description` varchar(100) DEFAULT NULL,
  `associated_page` tinyint(4) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`permission_id`),
  KEY `perm_page_id` (`associated_page`),
  KEY `perm_record_status` (`record_status`),
  CONSTRAINT `perm_page_id` FOREIGN KEY (`associated_page`) REFERENCES `pages` (`page_id`) ON UPDATE CASCADE,
  CONSTRAINT `perm_record_status` FOREIGN KEY (`record_status`) REFERENCES `record_status` (`status_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `permissions` */

/*Table structure for table `person_types` */

DROP TABLE IF EXISTS `person_types`;

CREATE TABLE `person_types` (
  `person_type_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `person_type` varchar(25) NOT NULL,
  `table_source` varchar(25) NOT NULL,
  PRIMARY KEY (`person_type_id`),
  UNIQUE KEY `person_type` (`person_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `person_types` */

insert  into `person_types`(`person_type_id`,`person_type`,`table_source`) values 
(1,'Employee','employees'),
(2,'Client','clients');

/*Table structure for table `persons` */

DROP TABLE IF EXISTS `persons`;

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `linking_id` int(11) NOT NULL,
  `person_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`person_id`),
  UNIQUE KEY `UC_Person` (`linking_id`,`person_type`),
  KEY `person_ptype` (`person_type`),
  CONSTRAINT `person_ptype` FOREIGN KEY (`person_type`) REFERENCES `person_types` (`person_type_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `persons` */

insert  into `persons`(`person_id`,`linking_id`,`person_type`) values 
(1,1,1),
(4,1,2),
(5,2,1),
(6,3,1),
(7,4,1),
(8,5,1);

/*Table structure for table `production_emails` */

DROP TABLE IF EXISTS `production_emails`;

CREATE TABLE `production_emails` (
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `recipient_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`recipient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `production_emails` */

insert  into `production_emails`(`first_name`,`last_name`,`email`,`recipient_id`) values 
('SJ','Carter','sjmcarter@mailinator.com',1),
('Test','userhjhj','testcustomer100@mailinator.com',4),
('Peter','Piper','sjmcarter@mailinator.com',5);

/*Table structure for table `production_orders` */

DROP TABLE IF EXISTS `production_orders`;

CREATE TABLE `production_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work_order` int(11) NOT NULL,
  `assigned_date` date DEFAULT NULL,
  `handover_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date_original` date DEFAULT NULL,
  `end_date_adjusted` date DEFAULT NULL,
  `end_date_actual` date DEFAULT NULL,
  `total_expenses` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `production_orders` */

insert  into `production_orders`(`id`,`work_order`,`assigned_date`,`handover_date`,`start_date`,`end_date_original`,`end_date_adjusted`,`end_date_actual`,`total_expenses`) values 
(1,1,'2017-06-08','2017-06-07','2017-06-09',NULL,NULL,NULL,0),
(2,2,NULL,NULL,NULL,NULL,NULL,NULL,0),
(3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(4,4,NULL,NULL,NULL,NULL,NULL,NULL,0),
(5,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
(6,6,NULL,NULL,NULL,NULL,NULL,NULL,0),
(7,7,'2017-06-14','2017-06-15','2017-06-16',NULL,NULL,NULL,0),
(8,8,NULL,NULL,NULL,NULL,NULL,NULL,0),
(9,10,'2017-06-14',NULL,NULL,NULL,NULL,NULL,NULL),
(10,11,'0000-00-00','0000-00-00','0000-00-00','0000-00-00',NULL,'0000-00-00',900),
(11,12,NULL,NULL,NULL,NULL,NULL,NULL,1200),
(12,13,NULL,NULL,NULL,NULL,NULL,NULL,0),
(13,14,NULL,NULL,NULL,NULL,NULL,NULL,0),
(14,15,NULL,NULL,NULL,NULL,NULL,NULL,0),
(15,16,'2017-06-20','2017-06-20','2017-06-21','2017-06-22','2017-06-23',NULL,2900),
(16,17,NULL,NULL,NULL,NULL,NULL,NULL,0),
(17,18,NULL,NULL,NULL,NULL,NULL,NULL,0),
(18,19,NULL,NULL,NULL,NULL,NULL,NULL,0),
(19,20,NULL,NULL,NULL,NULL,NULL,NULL,0);

/*Table structure for table `qb_queue` */

DROP TABLE IF EXISTS `qb_queue`;

CREATE TABLE `qb_queue` (
  `queue_id` int(11) NOT NULL AUTO_INCREMENT,
  `target_type` tinyint(4) NOT NULL DEFAULT '1',
  `linking_id` int(11) NOT NULL,
  `queue_start` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `queue_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=pending; 2=completed; 3=error',
  PRIMARY KEY (`queue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `qb_queue` */

insert  into `qb_queue`(`queue_id`,`target_type`,`linking_id`,`queue_start`,`queue_status`) values 
(1,1,1,'2017-06-05 18:18:57',1),
(2,1,2,'2017-06-08 17:54:47',1),
(3,1,4,'2017-06-08 21:50:53',1),
(4,1,8,'2017-06-08 22:19:34',1),
(6,1,15,'2017-06-16 17:47:29',1),
(7,1,19,'2017-06-19 15:25:50',1);

/*Table structure for table `record_status` */

DROP TABLE IF EXISTS `record_status`;

CREATE TABLE `record_status` (
  `status_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(25) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `record_status` */

insert  into `record_status`(`status_id`,`status_name`) values 
(1,'Active'),
(2,'Inactive'),
(3,'Deleted'),
(4,'Pending');

/*Table structure for table `user_permissions` */

DROP TABLE IF EXISTS `user_permissions`;

CREATE TABLE `user_permissions` (
  `user_id` int(11) NOT NULL,
  `page_id` tinyint(4) NOT NULL,
  `permission_type` tinyint(4) NOT NULL DEFAULT '1',
  KEY `up_user_id` (`user_id`),
  KEY `up_permission_id` (`page_id`),
  KEY `up_permission_level` (`permission_type`),
  CONSTRAINT `up_page_id` FOREIGN KEY (`page_id`) REFERENCES `pages` (`page_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `up_permission_level` FOREIGN KEY (`permission_type`) REFERENCES `permission_types` (`type_id`) ON UPDATE CASCADE,
  CONSTRAINT `up_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_permissions` */

insert  into `user_permissions`(`user_id`,`page_id`,`permission_type`) values 
(5,1,2),
(5,2,4),
(5,5,1),
(12,1,0),
(12,2,0),
(12,3,0),
(12,4,0),
(12,5,0),
(12,6,0),
(13,1,0),
(13,2,0),
(13,3,0),
(13,4,0),
(13,5,0),
(13,6,0),
(15,1,4),
(15,2,3),
(15,3,4),
(15,4,1),
(15,5,0),
(15,6,0),
(17,1,0),
(17,2,0),
(17,3,0),
(17,4,1),
(17,5,0),
(17,6,3),
(18,1,4),
(18,2,4),
(18,3,4),
(18,4,4),
(18,5,4),
(18,6,4),
(19,6,1),
(19,8,2),
(19,9,1),
(16,1,0),
(16,2,0),
(16,3,0),
(16,4,0),
(16,5,0),
(16,6,0),
(16,8,0),
(16,9,0),
(16,14,0),
(16,15,0),
(16,16,0),
(16,17,0),
(16,18,0),
(16,19,0),
(16,20,0),
(16,21,0),
(1,1,4),
(1,2,4),
(1,3,4),
(1,4,4),
(1,5,4),
(1,6,4),
(1,8,4),
(1,14,1),
(1,15,1),
(1,16,1),
(1,17,1),
(1,18,1),
(1,19,1),
(1,20,1),
(1,21,1),
(1,9,1),
(25,1,1),
(25,2,0),
(25,3,0),
(25,4,0),
(25,5,0),
(25,6,0),
(25,8,0),
(25,9,0),
(25,14,0),
(25,15,0),
(25,16,0),
(25,17,0),
(25,18,0),
(25,19,0),
(25,20,0),
(25,21,0),
(27,1,0),
(27,2,0),
(27,3,0),
(27,4,0),
(27,5,0),
(27,6,0),
(27,8,0),
(27,9,0),
(27,14,0),
(27,15,0),
(27,16,0),
(27,17,0),
(27,18,0),
(27,19,0),
(27,20,0),
(27,21,0),
(26,3,4),
(26,4,1),
(26,5,1),
(26,16,1),
(26,17,1),
(1,7,4),
(23,1,4),
(23,2,4),
(23,18,1),
(23,19,1),
(23,20,1),
(23,21,1),
(1,22,1);

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `color` varchar(25) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `user_roles` */

insert  into `user_roles`(`role_id`,`role`,`record_status`,`color`,`description`) values 
(1,'Admin',1,'red','System user; this role can not be deleted.  It is '),
(2,'CEO',1,'green',''),
(3,'CEO assistant',1,'blue',''),
(4,'HOA Admin',2,'orange',''),
(5,'Production Manager',1,'GoldenRod',''),
(6,'Production Admin',1,'indigo',''),
(7,'Estimator',1,'violet',''),
(8,'CFO',1,'thistle',''),
(9,'Business Analyst',3,'cyan',''),
(10,'test tole',1,'red','test'),
(11,'HR',1,'red','Human Resourcing');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `user_role` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `last_mod` datetime NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `person_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`,`record_status`),
  KEY `users_userroles` (`user_role`),
  KEY `users_persons` (`person_id`),
  CONSTRAINT `users_persons` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `users_userroles` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`role_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`last_name`,`username`,`email`,`password`,`record_status`,`user_role`,`created`,`last_mod`,`active`,`person_id`) values 
(1,'Admin','User','admin','sjmcarter@mailinator.com','cc03e747a6afbbcbf8be7668acfebee5',1,1,'2017-08-28 03:26:08','2017-06-27 10:29:24',1,NULL),
(2,'Vinod','r','vindo','vinod@mailinator.com','098f6bcd4621d373cade4e832627b4f6',1,7,'2017-05-19 04:41:40','2017-05-18 02:58:54',1,NULL),
(5,'Scott','Summers','scott.summers','test@email.com','098f6bcd4621d373cade4e832627b4f6',1,1,'2017-06-09 12:06:50','0000-00-00 00:00:00',1,NULL),
(12,'Ryan','Van Hammond','Ryan.Van Hammond','sjmcarter2@mailinator.com','cc03e747a6afbbcbf8be7668acfebee5',1,10,'2017-06-09 12:31:31','0000-00-00 00:00:00',1,NULL),
(13,'Tyrion','Lannister','Tyrion.Lannister','sjmcarter3@mailinator.com','68eacb97d86f0c4621fa2b0e17cabd8c',1,2,'2017-06-09 18:25:06','0000-00-00 00:00:00',1,NULL),
(15,'Lorna','Lane','Lorna.Lane','sjmcarter4@mailinator.com','cc03e747a6afbbcbf8be7668acfebee5',1,1,'2017-06-10 03:11:02','2017-06-17 08:37:21',1,NULL),
(16,'Bob','Johnson','Bob.Johnson','bob@mailinator.com','cc03e747a6afbbcbf8be7668acfebee5',1,2,'2017-08-23 01:32:14','2017-08-28 03:24:34',1,NULL),
(17,'Doris','TestUser','doris','doris@mailinator.com','cc03e747a6afbbcbf8be7668acfebee5',1,7,'2017-06-20 00:16:54','0000-00-00 00:00:00',1,NULL),
(18,'Ilan','TestUser','ilan','ilan@mailinator.com','cc03e747a6afbbcbf8be7668acfebee5',1,2,'2017-06-20 00:18:22','0000-00-00 00:00:00',1,NULL),
(19,'Shelly','Kaufman','Shelly.Kaufman','rinat.kaufman@gmail.com','08eb8ac068c5379dd2088fa3331b6489',1,3,'2017-07-09 19:41:45','2017-08-20 02:06:02',1,NULL),
(20,'Josh','KKK','Josh.KKK','rinat@hearttohouse.com','4061863caf7f28c0b0346719e764d561',1,6,'2017-07-09 19:44:05','2017-08-20 02:10:58',1,NULL),
(21,'Rinat','Kaufman','Rinat.Kaufman','rinat_kaufman@hotmail.com','cc03e747a6afbbcbf8be7668acfebee5',1,7,'2017-07-09 19:45:05','0000-00-00 00:00:00',1,NULL),
(22,'Raelene','Test','Raelene.Test','shar.kole1@gmail.com','cc03e747a6afbbcbf8be7668acfebee5',1,1,'2017-07-09 19:48:15','0000-00-00 00:00:00',1,NULL),
(23,'alex','r','alex.r','vinodrev11@gmail.com','e10adc3949ba59abbe56e057f20f883e',1,2,'2017-09-10 08:19:56','2017-09-10 08:07:29',1,NULL),
(24,'email','u','email.u','vinodrev12@gmail.com','e10adc3949ba59abbe56e057f20f883e',1,1,'2017-09-02 07:11:31','0000-00-00 00:00:00',3,NULL),
(25,'email','a','email.a','vinodrev@gmail.com','e10adc3949ba59abbe56e057f20f883e',1,1,'2017-09-02 07:27:19','2017-09-10 08:09:36',1,NULL),
(26,'Test','User','testuser','crm.testuser@mailinator.com','68eacb97d86f0c4621fa2b0e17cabd8c',1,5,'2017-09-07 06:42:21','0000-00-00 00:00:00',1,NULL),
(27,'Test','User','testuser01','testuser@mailinator.com','68eacb97d86f0c4621fa2b0e17cabd8c',1,7,'2017-09-07 06:41:06','0000-00-00 00:00:00',1,NULL);

/*Table structure for table `variable_datatypes` */

DROP TABLE IF EXISTS `variable_datatypes`;

CREATE TABLE `variable_datatypes` (
  `datatype_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `datatype_name` varchar(25) NOT NULL,
  `system_type` varchar(25) NOT NULL,
  `datatype_description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`datatype_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `variable_datatypes` */

insert  into `variable_datatypes`(`datatype_id`,`datatype_name`,`system_type`,`datatype_description`) values 
(1,'string','proper_name','Personal names and place names'),
(2,'sting','general_text',''),
(3,'string','url','For hyperlinks'),
(4,'string','email','For emails'),
(5,'string','address','For addresses; format for GMaps'),
(6,'datetype','date','Holds dates in UTC'),
(7,'datetime','time','Holds time in UTC'),
(8,'numeric','currency','For displaying money values; default to USD'),
(9,'string','pohone_basic','For 10-digit phone numbers'),
(10,'string','phone_ext','For 10 digit numbers with extensions up 5 digits'),
(11,'string','zip_basic','For 5 digit zip codes'),
(12,'string','zip_ext','For 9 digit zip codes');

/*Table structure for table `work_order_status` */

DROP TABLE IF EXISTS `work_order_status`;

CREATE TABLE `work_order_status` (
  `status_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `work_order_status` */

insert  into `work_order_status`(`status_id`,`status_name`,`active`) values 
(1,'New ',1),
(2,'Cold Lead',1),
(3,'Follow Up',1),
(4,'Post Est. Follow Up',1),
(5,'Scheduled for Estimate',1),
(6,'Estimate in Progress',1),
(7,'Estimate Provided',1),
(8,'Provided to Production',1),
(9,'Waiting for Client',1),
(10,'Contract Signed',1),
(11,'In Production',1),
(13,'Work Started',1),
(14,'Closed - Not Sold',1),
(15,'Closed - Cancelled',1),
(16,'Closed - Work Completed',1);

/*Table structure for table `work_order_workflows` */

DROP TABLE IF EXISTS `work_order_workflows`;

CREATE TABLE `work_order_workflows` (
  `workflow_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `workflow_name` varchar(25) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `wf_order` tinyint(4) NOT NULL DEFAULT '0',
  `work_order_status` tinyint(4) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `email_template` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`workflow_id`),
  KEY `FK_wow_email_template` (`email_template`),
  CONSTRAINT `FK_wow_email_template` FOREIGN KEY (`email_template`) REFERENCES `email_templates` (`template_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `work_order_workflows` */

insert  into `work_order_workflows`(`workflow_id`,`workflow_name`,`description`,`wf_order`,`work_order_status`,`record_status`,`email_template`) values 
(1,'Lead Generation',NULL,1,1,1,NULL),
(2,'Initial Contact',NULL,2,1,1,NULL),
(3,'Scheduled for Estimate',NULL,3,1,1,2),
(4,'Estimate in Progress',NULL,5,1,1,NULL),
(5,'Estimate Provided',NULL,6,1,1,NULL),
(6,'Follow Up',NULL,7,1,1,NULL),
(7,'Post Estimate Follow Up',NULL,8,1,1,NULL),
(8,'Contract Signed',NULL,9,1,1,NULL),
(9,'Assigned to Production',NULL,10,1,1,NULL),
(10,'Provided to Production',NULL,11,1,1,4),
(11,'In Production',NULL,12,1,1,NULL),
(12,'Work Started',NULL,13,1,1,NULL),
(13,'QA / Review',NULL,14,1,1,NULL),
(14,'Work Completed',NULL,15,1,1,NULL),
(15,'Production Completed',NULL,16,1,1,NULL),
(16,'Project Completed',NULL,17,1,1,NULL),
(17,'Appointment Changed',NULL,4,1,1,3);

/*Table structure for table `work_orders` */

DROP TABLE IF EXISTS `work_orders`;

CREATE TABLE `work_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` varchar(25) DEFAULT NULL,
  `work_order_status` tinyint(4) NOT NULL,
  `client_id` int(11) NOT NULL,
  `lead_type` tinyint(4) NOT NULL,
  `lead_source` tinyint(4) NOT NULL,
  `lead_date` date NOT NULL,
  `lead_comments` varchar(256) DEFAULT NULL,
  `estimate_scope` varchar(256) NOT NULL,
  `estimate_amount_original` decimal(10,0) DEFAULT NULL,
  `estimate_amount_date` date DEFAULT NULL,
  `follow_up_date` date DEFAULT NULL,
  `follow_up_notes` varchar(256) DEFAULT NULL,
  `contract_signed_date` date DEFAULT NULL,
  `contract_amount` decimal(10,0) DEFAULT NULL,
  `estimate_appointment_date` date DEFAULT NULL,
  `estimate_appointment_time` time DEFAULT NULL,
  `job_foreman` varchar(50) DEFAULT NULL,
  `estimator` int(11) DEFAULT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_ts` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_workorders_leadsources_id` (`lead_source`),
  KEY `fk_workorders_clients_id` (`client_id`),
  KEY `fk_workorders_leadtypes_id` (`lead_type`),
  KEY `fk_workorders_status` (`work_order_status`),
  KEY `FK_workorder_estimator` (`estimator`),
  KEY `fk_workorder_active` (`record_status`),
  CONSTRAINT `FK_workorder_estimator` FOREIGN KEY (`estimator`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_workorder_active` FOREIGN KEY (`record_status`) REFERENCES `record_status` (`status_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_workorders_clients_id` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_workorders_leadsources_id` FOREIGN KEY (`lead_source`) REFERENCES `lead_sources` (`lead_source_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_workorders_leadtypes_id` FOREIGN KEY (`lead_type`) REFERENCES `lead_types` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_workorders_status` FOREIGN KEY (`work_order_status`) REFERENCES `work_order_status` (`status_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `work_orders` */

insert  into `work_orders`(`id`,`job_id`,`work_order_status`,`client_id`,`lead_type`,`lead_source`,`lead_date`,`lead_comments`,`estimate_scope`,`estimate_amount_original`,`estimate_amount_date`,`follow_up_date`,`follow_up_notes`,`contract_signed_date`,`contract_amount`,`estimate_appointment_date`,`estimate_appointment_time`,`job_foreman`,`estimator`,`record_status`,`created_ts`,`last_modified`) values 
(1,'',1,1,1,1,'2017-06-01','','This is a scope. Lorem Ipsum',0,NULL,NULL,'',NULL,0,'2017-07-12','05:30:00','Tom Jones',16,1,'2017-06-05 18:18:57','2017-07-22 01:48:16')