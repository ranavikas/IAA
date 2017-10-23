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

/*Table structure for table `audit` */

DROP TABLE IF EXISTS `audit`;

CREATE TABLE `audit` (
  `audit_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `page_id` tinyblob NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `action` varchar(50) NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`audit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `audit` */

/*Table structure for table `classifications` */

DROP TABLE IF EXISTS `classifications`;

CREATE TABLE `classifications` (
  `classification_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `classification` varchar(25) NOT NULL,
  PRIMARY KEY (`classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `classifications` */

insert  into `classifications`(`classification_id`,`classification`) values 
(2,'good participant'),
(3,'Cooperative participant');

/*Table structure for table `client_contacts` */

DROP TABLE IF EXISTS `client_contacts`;

CREATE TABLE `client_contacts` (
  `client_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `client_contacts` */

insert  into `client_contacts`(`client_id`,`contact_id`) values 
(1,2);

/*Table structure for table `clients` */

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) NOT NULL,
  `default_location` int(11) DEFAULT NULL,
  `default_contact` int(11) DEFAULT NULL,
  `shipping_carrier` varchar(25) DEFAULT NULL,
  `shipping_account` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`client_id`),
  KEY `FK_client_locations` (`default_location`),
  CONSTRAINT `FK_client_locations` FOREIGN KEY (`default_location`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `clients` */

insert  into `clients`(`client_id`,`client_name`,`default_location`,`default_contact`,`shipping_carrier`,`shipping_account`) values 
(1,'Catalyst Bio-medical',3,2,'111','46457');

/*Table structure for table `contact_status` */

DROP TABLE IF EXISTS `contact_status`;

CREATE TABLE `contact_status` (
  `status_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `contact_status` varchar(25) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `contact_status` */

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `title` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_ext` varchar(5) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `phone2_ext` varchar(5) DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `contacts` */

insert  into `contacts`(`contact_id`,`firstname`,`lastname`,`title`,`email`,`email2`,`phone`,`phone_ext`,`phone2`,`phone2_ext`,`organization`) values 
(1,'Test','Contact','Clinician Lead','testcontact@mailinator.com','','510-710-0000','','','','Kaiser Research'),
(2,'Ayako E Carrera','Carrera','Research Liason','acarrera@catalystresearch.com','','714-225-3804','','','','Catalyst Bio-Med');

/*Table structure for table `education_status` */

DROP TABLE IF EXISTS `education_status`;

CREATE TABLE `education_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `education_level` varchar(25) NOT NULL,
  `parent_education_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `education_status` */

insert  into `education_status`(`id`,`education_level`,`parent_education_level`) values 
(1,'K-12',NULL),
(2,'Kindergarten',1),
(3,'Grade 1',1),
(4,'Grade 2',1),
(5,'Grade 3',1),
(6,'Grade 4',1),
(7,'Grade 5',1),
(8,'Grade 6',1),
(9,'Grade 7',1),
(10,'Grade 8',1),
(11,'Grade 9',1),
(12,'Grade 10',1),
(13,'Grade 11',1),
(14,'Grade 12',1),
(15,'High School Diploma',NULL),
(16,'GED',NULL),
(17,'Trade School',NULL),
(18,'Associate Degree',NULL),
(19,'Bachelor’s Degree',NULL),
(20,'Master’s Degree',NULL),
(21,'PhD',NULL),
(22,'Professional Degree',NULL),
(23,'MD',NULL);

/*Table structure for table `ethnicities` */

DROP TABLE IF EXISTS `ethnicities`;

CREATE TABLE `ethnicities` (
  `ethnicity_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ethnicity` varchar(25) NOT NULL,
  `comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ethnicity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ethnicities` */

insert  into `ethnicities`(`ethnicity_id`,`ethnicity`,`comments`) values 
(1,'White',NULL),
(2,'Black / African',NULL),
(3,'Native American',NULL),
(4,'Asian',NULL),
(5,'Pacific Islander',NULL);

/*Table structure for table `genders` */

DROP TABLE IF EXISTS `genders`;

CREATE TABLE `genders` (
  `gender_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `gender` varchar(25) NOT NULL,
  `gender_abbreviation` varchar(2) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `genders` */

insert  into `genders`(`gender_id`,`gender`,`gender_abbreviation`) values 
(1,'Male','M'),
(2,'Female','F'),
(3,'MTF Transexual','TM'),
(4,'FTM Transexual','TF');

/*Table structure for table `location_contacts` */

DROP TABLE IF EXISTS `location_contacts`;

CREATE TABLE `location_contacts` (
  `location_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  KEY `FK_locations` (`location_id`),
  KEY `FK_contacts` (`contact_id`),
  CONSTRAINT `FK_contacts` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `location_contacts` */

/*Table structure for table `location_types` */

DROP TABLE IF EXISTS `location_types`;

CREATE TABLE `location_types` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `location_type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `location_types` */

insert  into `location_types`(`id`,`location_type`) values 
(1,'Lab / Internal'),
(2,'Offsite'),
(3,'Client');

/*Table structure for table `locations` */

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` varchar(9) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `location_type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`location_id`),
  KEY `FK_locations_ltypes` (`location_type`),
  CONSTRAINT `FK_locations_ltypes` FOREIGN KEY (`location_type`) REFERENCES `location_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`location_id`,`location_name`,`address1`,`address2`,`city`,`state`,`zip`,`email`,`phone`,`location_type`) values 
(1,'Main Research Facility','3799 Sycamore Street','Suite A','San Francisco','CA','94103','contact@mainresearch.org','408-850-10',1),
(2,'Satelitte Office','48 Brown Street','','Walnut Creek','CA','94596','contact@satelitteoffice.co','925-975-55',2),
(3,'Client Site 1','2272 Green Avenue','uNIT 205','Berkeley','CA','94704',NULL,'510-841-38',3),
(4,'Client Site 2','2966 Marietta Street',NULL,'Santa Rosa','CA','95401','clientlocation2@mailinator.com','707-571-97',3);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `logins` */

insert  into `logins`(`login_id`,`user_id`,`session_id`,`login_timestamp`,`logout_timestamp`,`ip_address`) values 
(1,3,'599cfb766c7a1','2017-08-23 05:50:14','2017-08-23 05:50:53',NULL),
(2,3,'599cfc86028d5','2017-08-23 05:54:46','2017-08-23 05:55:02',NULL),
(4,3,'599d0078e8c68','2017-08-23 06:11:36','2017-08-23 06:48:53',NULL),
(5,3,'599d093c821c1','2017-08-23 06:49:00',NULL,NULL),
(6,3,'599d77e1763d5','2017-08-23 14:41:05',NULL,NULL),
(7,3,'599dacdb7e4ff','2017-08-23 18:27:07',NULL,NULL),
(8,3,'599e3fc36850c','2017-08-24 04:53:55','2017-08-24 05:07:27',NULL),
(9,3,'599e42fd0b95b','2017-08-24 05:07:41','2017-08-24 05:11:39',NULL),
(10,3,'599e43ed32550','2017-08-24 05:11:41','2017-08-24 05:12:23',NULL),
(11,3,'599e4418607e7','2017-08-24 05:12:24','2017-08-24 12:48:35',NULL),
(12,3,'599eaf20a32e0','2017-08-24 12:49:04','2017-08-24 12:49:10',NULL),
(13,3,'599eaf2c3881e','2017-08-24 12:49:16','2017-08-24 12:49:24',NULL),
(14,3,'599eaf398f9dd','2017-08-24 12:49:29','2017-08-24 12:49:36',NULL),
(15,3,'599eaf51a9b20','2017-08-24 12:49:53',NULL,NULL),
(16,3,'599ffcb9cd55f','2017-08-25 12:32:25',NULL,NULL),
(17,3,'59a04d0aa6c84','2017-08-25 18:15:06',NULL,NULL),
(18,3,'59a0dd9b34547','2017-08-26 04:31:55',NULL,NULL),
(19,3,'59a13d2f63da7','2017-08-26 11:19:43',NULL,NULL),
(20,3,'59a18330c2e0b','2017-08-26 16:18:24',NULL,NULL),
(21,3,'59a4cb949fc61','2017-08-29 04:04:04','2017-08-29 04:52:54',NULL);

/*Table structure for table `medical_conditions` */

DROP TABLE IF EXISTS `medical_conditions`;

CREATE TABLE `medical_conditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medical_condition` varchar(100) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

/*Data for the table `medical_conditions` */

insert  into `medical_conditions`(`id`,`medical_condition`,`record_status`) values 
(1,'No Medical Conditions',1),
(2,'Acne',1),
(3,'Allergies',1),
(4,'Alzheimers',1),
(5,'Anemia',1),
(6,'Ankylosing Spondylitis',1),
(7,'Anxiety Disorders',1),
(8,'Asthma',1),
(9,'Bipolar',1),
(10,'Blind',1),
(11,'Cancer',1),
(12,'Cancer – Chemotherapy',1),
(13,'Cancer – Remission',1),
(14,'Carpal Tunnel',1),
(15,'Cardiac/Heart  Condition',1),
(16,'Cataracts',1),
(17,'Chronic Pain',1),
(18,'Cluster Headache',1),
(19,'Cluster Seizure',1),
(20,'Color Blind',1),
(21,'COPD',1),
(22,'Crohn’s Disease',1),
(23,'Diabetes',1),
(24,'Diabetes – Type 1',1),
(25,'Diabetes – Type 2',1),
(26,'Diabetes – Pump User',1),
(27,'Dialysis/Chronic Kidney Failure',1),
(28,'Depression',1),
(29,'Dimensia',1),
(30,'Eczema',1),
(31,'Epilepsy',1),
(32,'Erectile Dysfunction',1),
(33,'Fertility',1),
(34,'Fibromyalgia',1),
(35,'Glaucoma',1),
(36,'Glucagon Experienced',1),
(37,'Growth Hormone',1),
(38,'Hemophilia A',1),
(39,'Hemophilia B',1),
(40,'Hemorrhoids',1),
(41,'Hepatitis C',1),
(42,'High Blood Pressure',1),
(43,'High Cholesterol',1),
(44,'Hidradenitis Suppurativa',1),
(45,'HIV',1),
(46,'Hypertension',1),
(47,'JIA (Juvenile Idiopathic Arthritis)',1),
(48,'Lupus',1),
(49,'LVAD',1),
(50,'Mastectomy',1),
(51,'Migraine',1),
(52,'Multiple Sclerosis (MS)',1),
(53,'Neuropathy',1),
(54,'Obese',1),
(55,'Osteoarthritis',1),
(56,'Osteoporosis',1),
(57,'Panuveitis (UV)',1),
(58,'Parkinson’s Disease',1),
(59,'PKU',1),
(60,'Platelet Disorder',1),
(61,'Prader-Willi Syndrome',1),
(62,'Precocious Puberty',1),
(63,'Psoriasis',1),
(64,'Psoriatic Arthritis',1),
(65,'Retinopathy',1),
(66,'Rheumatoid Arthritis',1),
(67,'Schizophrenia',1),
(68,'Seizures',1),
(69,'Sjögren\'s Syndrome',1),
(70,'Skin Disorders/Issues',1),
(71,'Thyroid',1),
(72,'Ulcerative Colitis',1);

/*Table structure for table `occupations` */

DROP TABLE IF EXISTS `occupations`;

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `occupation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

/*Data for the table `occupations` */

insert  into `occupations`(`id`,`occupation`) values 
(1,'BioMed Tech'),
(2,'BioTech Lab Researcher'),
(3,'Caregivers/Home Health'),
(4,'Dental Assistant'),
(5,'Dentist'),
(6,'Dialysis Tech'),
(7,'EMT'),
(8,'Fire Fighter'),
(9,'First Responders'),
(10,'Gynecologist'),
(11,'HCP'),
(12,'HCP – RN'),
(13,'HCP – LVN'),
(14,'HCP – MA'),
(15,'HCP – PA'),
(16,'HCP – DR'),
(17,'HCP – Anesthesiology'),
(18,'HCP – Cardiovascular'),
(19,'HCP – Critical Care'),
(20,'HCP – Dermatology'),
(21,'HCP – Dialysis/Renal'),
(22,'HCP – ER'),
(23,'HCP – Family Practice'),
(24,'HCP – Gastroenterology'),
(25,'HCP – Geriatric'),
(26,'HCP  –  Hematology'),
(27,'HCP – ICU'),
(28,'HCP – Internal Medicine'),
(29,'HCP – LVAD'),
(30,'HCP – Neurology'),
(31,'HCP – Nephrology'),
(32,'HCP – OBGYN'),
(33,'HCP – Oncology'),
(34,'HCP – OR'),
(35,'HCP – Outpatient'),
(36,'HCP – Pediatrics'),
(37,'HCP – Plastic Surgery'),
(38,'HCP – Preventive Care'),
(39,'HCP – Primary Care'),
(40,'HCP – Pulmonology'),
(41,'HCP – Public Health'),
(42,'HCP – Psych'),
(43,'HCP – Rheumatology'),
(44,'HCP – Surgical'),
(45,'HCP – Telemetry/Med Surge'),
(46,'HCP – Unknown'),
(47,'HCP – Urology'),
(48,'IT'),
(49,'Hygienist'),
(50,'Lasik Surgeons'),
(51,'Lasik Techs'),
(52,'OBGYN'),
(53,'Ophthalmologist'),
(54,'Ophthalmology Tech'),
(55,'Paramedic'),
(56,'PCT'),
(57,'Pharmacist'),
(58,'Pharmacy Tech'),
(59,'Police Officer'),
(60,'Reprocessing Tech'),
(61,'School Nurse'),
(65,'BioMed Tech'),
(66,'BioTech Lab Researcher'),
(67,'Caregivers/Home Health'),
(68,'Dental Assistant'),
(69,'Dentist'),
(70,'Dialysis Tech'),
(71,'EMT'),
(72,'Fire Fighter'),
(73,'First Responders'),
(74,'Gynecologist'),
(75,'HCP'),
(76,'HCP – RN'),
(77,'HCP – LVN'),
(78,'HCP – MA'),
(79,'HCP – PA'),
(80,'HCP – DR'),
(81,'HCP – Anesthesiology'),
(82,'HCP – Cardiovascular'),
(83,'HCP – Critical Care'),
(84,'HCP – Dermatology'),
(85,'HCP – Dialysis/Renal'),
(86,'HCP – ER'),
(87,'HCP – Family Practice'),
(88,'HCP – Gastroenterology'),
(89,'HCP – Geriatric'),
(90,'HCP  –  Hematology'),
(91,'HCP – ICU'),
(92,'HCP – Internal Medicine'),
(93,'HCP – LVAD'),
(94,'HCP – Neurology'),
(95,'HCP – Nephrology'),
(96,'HCP – OBGYN'),
(97,'HCP – Oncology'),
(98,'HCP – OR'),
(99,'HCP – Outpatient'),
(100,'HCP – Pediatrics'),
(101,'HCP – Plastic Surgery'),
(102,'HCP – Preventive Care'),
(103,'HCP – Primary Care'),
(104,'HCP – Pulmonology'),
(105,'HCP – Public Health'),
(106,'HCP – Psych'),
(107,'HCP – Rheumatology'),
(108,'HCP – Surgical'),
(109,'HCP – Telemetry/Med Surge'),
(110,'HCP – Unknown'),
(111,'HCP – Urology'),
(112,'IT'),
(113,'Hygienist'),
(114,'Lasik Surgeons'),
(115,'Lasik Techs'),
(116,'OBGYN'),
(117,'Ophthalmologist'),
(118,'Ophthalmology Tech'),
(119,'Paramedic'),
(120,'PCT'),
(121,'Pharmacist'),
(122,'Pharmacy Tech'),
(123,'Police Officer'),
(124,'Reprocessing Tech'),
(125,'School Nurse');

/*Table structure for table `participant_classifications_autosave` */

DROP TABLE IF EXISTS `participant_classifications_autosave`;

CREATE TABLE `participant_classifications_autosave` (
  `participant_id` int(11) NOT NULL,
  `classification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_classifications_autosave` */

/*Table structure for table `participant_classifications_ug` */

DROP TABLE IF EXISTS `participant_classifications_ug`;

CREATE TABLE `participant_classifications_ug` (
  `participant_id` int(11) NOT NULL,
  `classification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_classifications_ug` */

insert  into `participant_classifications_ug`(`participant_id`,`classification_id`) values 
(2,3),
(1,2),
(4,3);

/*Table structure for table `participant_conditions_autosave` */

DROP TABLE IF EXISTS `participant_conditions_autosave`;

CREATE TABLE `participant_conditions_autosave` (
  `participant_id` int(11) NOT NULL,
  `medical_condition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_conditions_autosave` */

/*Table structure for table `participant_conditions_ug` */

DROP TABLE IF EXISTS `participant_conditions_ug`;

CREATE TABLE `participant_conditions_ug` (
  `participant_id` int(11) NOT NULL,
  `medical_condition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `participant_conditions_ug` */

insert  into `participant_conditions_ug`(`participant_id`,`medical_condition`) values 
(2,1),
(1,1),
(4,2);

/*Table structure for table `participant_notes` */

DROP TABLE IF EXISTS `participant_notes`;

CREATE TABLE `participant_notes` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `note_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `participant_notes` */

/*Table structure for table `participant_occupations_autosave` */

DROP TABLE IF EXISTS `participant_occupations_autosave`;

CREATE TABLE `participant_occupations_autosave` (
  `participant_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_occupations_autosave` */

/*Table structure for table `participant_occupations_ug` */

DROP TABLE IF EXISTS `participant_occupations_ug`;

CREATE TABLE `participant_occupations_ug` (
  `participant_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL,
  KEY `FK_participant_occupations_participant` (`participant_id`),
  KEY `FK_participant_occupations_occupation` (`occupation_id`),
  CONSTRAINT `FK_participant_occupations_occupation` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_participant_occupations_participant` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`participant_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `participant_occupations_ug` */

insert  into `participant_occupations_ug`(`participant_id`,`occupation_id`) values 
(2,1),
(1,1),
(4,2);

/*Table structure for table `participant_photolog` */

DROP TABLE IF EXISTS `participant_photolog`;

CREATE TABLE `participant_photolog` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `study` varchar(50) NOT NULL,
  `datee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_photolog` */

insert  into `participant_photolog`(`participant_id`,`notes`,`status`,`study`,`datee`) values 
(2,'note1','screened','stud','2017-08-22'),
(1,'notttt','screened','gggu','2017-08-17'),
(1,'notttt','scheduled','fff','2017-08-17'),
(4,'notttt','scheduled','fff','2017-08-24');

/*Table structure for table `participant_photolog_autosave` */

DROP TABLE IF EXISTS `participant_photolog_autosave`;

CREATE TABLE `participant_photolog_autosave` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `study` varchar(10) NOT NULL,
  `datee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_photolog_autosave` */

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) NOT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_ext` int(3) DEFAULT NULL,
  `alternate_phone` varchar(15) DEFAULT NULL,
  `alternate_phone_ext` int(3) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alternate_email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `ethnicity` tinyint(4) DEFAULT NULL,
  `education` tinyint(4) DEFAULT NULL,
  `occupation` varchar(25) DEFAULT NULL,
  `employer` varchar(50) DEFAULT NULL,
  `transportation` tinyint(4) NOT NULL,
  `contact_status` tinyint(4) DEFAULT NULL,
  `photo_src` varchar(100) DEFAULT NULL,
  `do_not_call` tinyint(3) DEFAULT NULL,
  `do_not_email` tinyint(3) DEFAULT NULL,
  `decreased` tinyint(3) DEFAULT NULL,
  `classification` varchar(22) NOT NULL,
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `participants` */

insert  into `participants`(`participant_id`,`firstname`,`middlename`,`lastname`,`address1`,`address2`,`city`,`state`,`zip`,`country`,`phone`,`phone_ext`,`alternate_phone`,`alternate_phone_ext`,`email`,`alternate_email`,`dob`,`age`,`gender`,`ethnicity`,`education`,`occupation`,`employer`,`transportation`,`contact_status`,`photo_src`,`do_not_call`,`do_not_email`,`decreased`,`classification`) values 
(1,'Faizans','asss','khansss','CHAK 371 J/B Gojra Teh:Gojra, Distt:Toba Tek Singh','gpjra','lahore','pu','6700',NULL,'4353453499',989,'432423423993',333,'madni198@gmail.com','fg@gmail.com','2017-08-17',0,1,2,10,'7','Doctor',1,NULL,'splash-border-2562.png',NULL,1,NULL,''),
(2,'Almas','A','Raza','','','','','',NULL,'4353453499',4,'43242342399311',5,'almas@gmail.com','','2010-08-07',7,2,2,15,'10','Doctor',2,NULL,'splash-border-256.png',1,NULL,1,''),
(3,'Faheem','a','Ansari','','','','','',NULL,'',0,'',0,'','','0000-00-00',0,1,1,-1,'1','',1,NULL,'',NULL,NULL,NULL,'good'),
(4,'Adeel','a ','Khan','lhg','gojra','lahore','pu','36000',NULL,'4353453499',989,'43242342399',34343,'adeel@gmail.com','','2010-06-16',7,2,2,16,'5','Doctor',2,NULL,'splash-256.png',NULL,NULL,1,'good');

/*Table structure for table `participants_autosave` */

DROP TABLE IF EXISTS `participants_autosave`;

CREATE TABLE `participants_autosave` (
  `participant_autosave_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` char(2) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_ext` int(3) DEFAULT NULL,
  `alternate_phone` varchar(15) DEFAULT NULL,
  `alternate_phone_ext` int(3) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alternate_email` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `ethnicity` tinyint(4) DEFAULT NULL,
  `education` tinyint(4) DEFAULT NULL,
  `occupation` varchar(25) DEFAULT NULL,
  `employer` varchar(50) DEFAULT NULL,
  `transportation` tinyint(4) DEFAULT NULL,
  `contact_status` tinyint(4) DEFAULT NULL,
  `photo_src` varchar(100) DEFAULT NULL,
  `do_not_call` tinyint(3) DEFAULT NULL,
  `do_not_email` tinyint(3) DEFAULT NULL,
  `decreased` tinyint(3) DEFAULT NULL,
  `classification` varchar(22) NOT NULL,
  PRIMARY KEY (`participant_autosave_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `participants_autosave` */

insert  into `participants_autosave`(`participant_autosave_id`,`user_id`,`firstname`,`middlename`,`lastname`,`address1`,`address2`,`city`,`state`,`zip`,`country`,`phone`,`phone_ext`,`alternate_phone`,`alternate_phone_ext`,`email`,`alternate_email`,`dob`,`age`,`gender`,`ethnicity`,`education`,`occupation`,`employer`,`transportation`,`contact_status`,`photo_src`,`do_not_call`,`do_not_email`,`decreased`,`classification`) values 
(1,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,''),
(2,1,'','','','','','','','',NULL,'',0,'',0,'','','0000-00-00',0,1,1,-1,'1','',1,NULL,'',NULL,NULL,NULL,'good');

/*Table structure for table `product_types` */

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `product_types` */

insert  into `product_types`(`id`,`product_type`) values 
(1,'Autoinjector');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`product_id`,`product_type_id`,`product_name`) values 
(1,1,'Product XYZ');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

insert  into `roles`(`role_id`,`role`) values 
(1,'Lead'),
(2,'Recruiter'),
(3,'AV'),
(4,'Datalogger ');

/*Table structure for table `screener_answers` */

DROP TABLE IF EXISTS `screener_answers`;

CREATE TABLE `screener_answers` (
  `study_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `screener_question` int(11) NOT NULL,
  `anwer` varchar(100) NOT NULL,
  KEY `FK_screener_answers_study` (`study_id`),
  KEY `FK_screener_answers_participant` (`participant_id`),
  KEY `FK_screener_answers_question` (`screener_question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `screener_answers` */

insert  into `screener_answers`(`study_id`,`participant_id`,`screener_question`,`anwer`) values 
(1,1,1,'Yes'),
(1,1,2,'Epilepsy, Cluster Headaches'),
(1,1,3,'Lipitor');

/*Table structure for table `screener_question_options` */

DROP TABLE IF EXISTS `screener_question_options`;

CREATE TABLE `screener_question_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `screener_question` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `order` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_screener_question_options_question` (`screener_question`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `screener_question_options` */

insert  into `screener_question_options`(`id`,`screener_question`,`option`,`order`) values 
(1,1,'Yes',1),
(2,1,'No',2),
(3,2,'Epilepsy',1),
(5,2,'Migraines',2),
(6,2,'Parkinson\'s Disease',3),
(7,2,'Coluster Headaches',4),
(25,10,'one',1),
(26,10,'two',2),
(27,10,'three',3);

/*Table structure for table `screener_questions` */

DROP TABLE IF EXISTS `screener_questions`;

CREATE TABLE `screener_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `question_type` tinyint(4) DEFAULT '1' COMMENT '1=single; 2=multi-select; 3=free-text',
  `last_modified` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UC_Question` (`question`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `screener_questions` */

insert  into `screener_questions`(`id`,`question`,`question_type`,`last_modified`) values 
(1,'Do you have diabetes?',1,'2017-08-24 13:45:46'),
(2,'Which neurological conditions do you have?',2,'2017-08-24 13:45:46'),
(3,'What medications do you take to treat your condition?',3,'2017-08-24 13:45:46'),
(10,'Multiple Choice Question',2,'2017-08-26 11:56:55'),
(11,'Free Text Question',3,'2017-08-26 12:15:45');

/*Table structure for table `search_options` */

DROP TABLE IF EXISTS `search_options`;

CREATE TABLE `search_options` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `search_field` varchar(25) NOT NULL,
  `display_name` varchar(25) DEFAULT NULL,
  `field_type` varchar(25) DEFAULT 'multi-select',
  `value_type` varchar(25) DEFAULT NULL,
  `linking_table` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `search_options` */

insert  into `search_options`(`id`,`search_field`,`display_name`,`field_type`,`value_type`,`linking_table`) values 
(1,'medical_condition','Medical Condition','multi-select',NULL,'medical_conditions'),
(2,'age_range','Age Range','input-range','numeric',NULL),
(3,'gender','Gender','multi-select',NULL,'genders'),
(4,'education','Education','select',NULL,'education_status'),
(5,'participant_name','Participant Name','input',NULL,NULL),
(6,'participant_city','Participant City','multi-select',NULL,NULL),
(7,'participant_zip','Participant Zip','multi-select',NULL,NULL),
(8,'ethnicity','Ethnicity','multi-select',NULL,'ethnicities'),
(9,'occupation','Occupation','multi-select',NULL,'occupations'),
(10,'study','Study','multi-select',NULL,'studies'),
(11,'classification','Classification','multi-select',NULL,'classifications'),
(12,'employer','Employer','multi-select',NULL,'vw_ParticipantEmployers'),
(13,'transportation','Transportation','multi-select',NULL,NULL);

/*Table structure for table `studies` */

DROP TABLE IF EXISTS `studies`;

CREATE TABLE `studies` (
  `study_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `product_name` int(11) NOT NULL,
  `product_type` int(11) NOT NULL,
  `study_type` int(11) NOT NULL,
  `number_of_usergroups` smallint(6) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `study_status` tinyint(4) DEFAULT NULL,
  `focus_vision` tinyint(4) DEFAULT '0',
  `recruiter` int(11) DEFAULT NULL,
  `lead` int(11) DEFAULT NULL,
  `datalogger` int(11) DEFAULT NULL,
  `av` int(11) DEFAULT NULL,
  `study_number` varchar(10) DEFAULT NULL,
  `study_notes` text,
  `study_dnq_notes` text,
  `client_contact_info` text NOT NULL,
  PRIMARY KEY (`study_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `studies` */

insert  into `studies`(`study_id`,`client_id`,`product_name`,`product_type`,`study_type`,`number_of_usergroups`,`start_date`,`end_date`,`study_status`,`focus_vision`,`recruiter`,`lead`,`datalogger`,`av`,`study_number`,`study_notes`,`study_dnq_notes`,`client_contact_info`) values 
(1,1,1,1,1,2,'2017-08-22','2017-08-25',1,1,3,3,3,3,'1','sTUDY nOTES TEXT AREAAAA','DNQ','	\r\nName Azeeem11 khan11Email madni38011@yahoo.comPhone 435345349911Organization dsdsd11'),
(2,1,3,1,1,3,'2017-08-24','2017-08-27',1,0,4,3,6,4,'2',' study notes text area','DNQ textare','	\r\nName Azeeem11 khan11Email madni38011@yahoo.comPhone 435345349911Organization dsdsd11'),
(3,1,1,1,1,3,'0000-00-00','0000-00-00',1,0,3,3,3,3,'3','','','	\r\nName Ayako E Carrera CarreraEmail acarrera@catalystresearch.comPhone 714-225-3804Organization Catalyst Bio-Med');

/*Table structure for table `studies_autosave` */

DROP TABLE IF EXISTS `studies_autosave`;

CREATE TABLE `studies_autosave` (
  `study_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_name` int(11) NOT NULL,
  `product_type` int(11) NOT NULL,
  `study_type` int(11) NOT NULL,
  `number_of_usergroups` smallint(6) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `study_status` tinyint(4) DEFAULT NULL,
  `focus_vision` tinyint(4) DEFAULT '0',
  `recruiter` int(11) DEFAULT NULL,
  `lead` int(11) DEFAULT NULL,
  `datalogger` int(11) DEFAULT NULL,
  `av` int(11) DEFAULT NULL,
  `study_number` varchar(10) DEFAULT NULL,
  `study_notes` text,
  `study_dnq_notes` text,
  `client_contact_info` text NOT NULL,
  PRIMARY KEY (`study_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `studies_autosave` */

insert  into `studies_autosave`(`study_id`,`user_id`,`client_id`,`product_name`,`product_type`,`study_type`,`number_of_usergroups`,`start_date`,`end_date`,`study_status`,`focus_vision`,`recruiter`,`lead`,`datalogger`,`av`,`study_number`,`study_notes`,`study_dnq_notes`,`client_contact_info`) values 
(1,1,1,1,1,1,3,'0000-00-00','0000-00-00',1,0,3,3,3,3,'3','','','	\r\nName Ayako E Carrera CarreraEmail acarrera@catalystresearch.comPhone 714-225-3804Organization Catalyst Bio-Med');

/*Table structure for table `study_dnq` */

DROP TABLE IF EXISTS `study_dnq`;

CREATE TABLE `study_dnq` (
  `study_id` int(11) NOT NULL,
  `dnq_study_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_dnq` */

insert  into `study_dnq`(`study_id`,`dnq_study_id`) values 
(1,1),
(2,1),
(2,2);

/*Table structure for table `study_dnq_autosave` */

DROP TABLE IF EXISTS `study_dnq_autosave`;

CREATE TABLE `study_dnq_autosave` (
  `study_id` int(11) NOT NULL,
  `dnq_study_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_dnq_autosave` */

/*Table structure for table `study_group_sessions` */

DROP TABLE IF EXISTS `study_group_sessions`;

CREATE TABLE `study_group_sessions` (
  `study_id` int(11) NOT NULL,
  `study_user_group` int(11) NOT NULL,
  `session_order` tinyint(4) NOT NULL,
  `session_time` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_group_sessions` */

insert  into `study_group_sessions`(`study_id`,`study_user_group`,`session_order`,`session_time`) values 
(1,71,2,17),
(1,71,2,21),
(1,72,2,23),
(1,72,2,27),
(2,91,2,11),
(2,91,2,13),
(2,92,2,15),
(2,92,2,17),
(2,93,2,19),
(2,93,2,21);

/*Table structure for table `study_group_sessions_autosave` */

DROP TABLE IF EXISTS `study_group_sessions_autosave`;

CREATE TABLE `study_group_sessions_autosave` (
  `study_id` int(11) NOT NULL,
  `study_user_group` int(11) NOT NULL,
  `session_order` tinyint(4) NOT NULL,
  `session_time` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_group_sessions_autosave` */

/*Table structure for table `study_locations` */

DROP TABLE IF EXISTS `study_locations`;

CREATE TABLE `study_locations` (
  `study_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_locations` */

insert  into `study_locations`(`study_id`,`location_id`) values 
(1,1),
(1,2),
(2,1),
(2,2);

/*Table structure for table `study_locations_autosave` */

DROP TABLE IF EXISTS `study_locations_autosave`;

CREATE TABLE `study_locations_autosave` (
  `study_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_locations_autosave` */

/*Table structure for table `study_participant_status` */

DROP TABLE IF EXISTS `study_participant_status`;

CREATE TABLE `study_participant_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `study_participant_status` */

insert  into `study_participant_status`(`id`,`status`) values 
(1,'New'),
(2,'Approved'),
(3,'Screened'),
(4,'Emailed'),
(5,'LM');

/*Table structure for table `study_participants` */

DROP TABLE IF EXISTS `study_participants`;

CREATE TABLE `study_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `study_user_group` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `participant_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_study_participants_user_group` (`study_user_group`),
  KEY `FK_study_participants_participant` (`participant_id`),
  KEY `FK_study_participants_participant_status` (`participant_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_participants` */

/*Table structure for table `study_screener_questions` */

DROP TABLE IF EXISTS `study_screener_questions`;

CREATE TABLE `study_screener_questions` (
  `study_user_group` int(11) NOT NULL,
  `screener_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `study_screener_questions` */

insert  into `study_screener_questions`(`study_user_group`,`screener_question`) values 
(71,1),
(71,2),
(72,1),
(72,3),
(71,10),
(72,10);

/*Table structure for table `study_status` */

DROP TABLE IF EXISTS `study_status`;

CREATE TABLE `study_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `study_status` */

insert  into `study_status`(`id`,`status_name`) values 
(1,'Active');

/*Table structure for table `study_types` */

DROP TABLE IF EXISTS `study_types`;

CREATE TABLE `study_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `study_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `study_types` */

insert  into `study_types`(`id`,`study_type`) values 
(1,'Formative');

/*Table structure for table `study_user_groups` */

DROP TABLE IF EXISTS `study_user_groups`;

CREATE TABLE `study_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `study_id` int(11) NOT NULL,
  `user_group` int(11) NOT NULL,
  `number_of_participants` smallint(6) NOT NULL,
  `payment_amount` decimal(10,0) NOT NULL,
  `training` tinyint(4) NOT NULL,
  `number_of_sessions` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;

/*Data for the table `study_user_groups` */

insert  into `study_user_groups`(`id`,`study_id`,`user_group`,`number_of_participants`,`payment_amount`,`training`,`number_of_sessions`) values 
(71,1,1,12,45,1,2),
(72,1,2,13,45,2,2),
(91,2,2,12,5,1,2),
(92,2,3,13,10,2,2),
(93,2,1,14,15,3,2),
(94,3,1,0,0,1,1);

/*Table structure for table `study_user_groups_autosave` */

DROP TABLE IF EXISTS `study_user_groups_autosave`;

CREATE TABLE `study_user_groups_autosave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `study_id` int(11) NOT NULL,
  `user_group` int(11) DEFAULT '1',
  `number_of_participants` smallint(6) DEFAULT NULL,
  `payment_amount` decimal(10,0) DEFAULT NULL,
  `training` tinyint(4) DEFAULT NULL,
  `number_of_sessions` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5173 DEFAULT CHARSET=latin1;

/*Data for the table `study_user_groups_autosave` */

insert  into `study_user_groups_autosave`(`id`,`study_id`,`user_group`,`number_of_participants`,`payment_amount`,`training`,`number_of_sessions`) values 
(834,3,1,0,0,1,1),
(1060,5,1,0,0,1,1),
(1061,5,2,0,0,1,1),
(1062,5,3,0,0,1,1),
(5170,1,1,0,0,1,1),
(5171,1,2,0,0,1,1),
(5172,1,3,0,0,1,1);

/*Table structure for table `transportation_status` */

DROP TABLE IF EXISTS `transportation_status`;

CREATE TABLE `transportation_status` (
  `status_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `transportation_status` varchar(25) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transportation_status` */

/*Table structure for table `user_assign_role` */

DROP TABLE IF EXISTS `user_assign_role`;

CREATE TABLE `user_assign_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_assign_role` */

insert  into `user_assign_role`(`user_id`,`role_id`) values 
(6,11),
(6,12),
(6,13),
(6,14),
(6,11),
(6,12),
(6,13),
(6,14),
(6,11),
(6,12),
(6,13),
(6,14),
(7,12),
(7,13);

/*Table structure for table `user_groups` */

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `user_groups` */

insert  into `user_groups`(`id`,`group_name`) values 
(1,'RA patients'),
(2,'Caregivers'),
(3,'HCP'),
(4,'Adult'),
(5,'Teen (12-17)\r\n'),
(6,'Child (Under 12)\r\n'),
(7,'iPhone User\r\n'),
(8,'iPhone User\r\n'),
(9,'PC User\r\n'),
(10,'Mac User\r\n'),
(11,'Tablet User\r\n'),
(12,'Laptop User\r\n'),
(13,'Desktop User\r\n'),
(14,'Fitbit Users\r\n'),
(15,'Garmin Users\r\n'),
(16,'Printer Users');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `user_roles` */

insert  into `user_roles`(`role_id`,`role`,`record_status`,`color`,`description`) values 
(11,'Recruiter',1,'red',NULL),
(12,'Lead',1,'green',NULL),
(13,'datalogger',1,'blue',NULL),
(14,'AV',1,'yellow',NULL),
(15,'Teacheeee123',3,'blue','eeee123');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`last_name`,`username`,`email`,`password`,`record_status`,`user_role`,`created`,`last_mod`,`active`,`person_id`) values 
(3,'Faisal','Ahmad','admin','failsa@gmail.com','cc03e747a6afbbcbf8be7668acfebee5',1,11,'2017-08-09 00:00:00','0000-00-00 00:00:00',1,NULL),
(4,'Faizaneee','aee','Faizan.aee','fazi@gmail.comee','3066ae72739e663244a565eebc73612d',1,NULL,'2017-08-23 18:56:39','0000-00-00 00:00:00',3,NULL),
(6,'Rizwan','a','rizwanaa','fazin@gmail.com','eaafad502f93575321978b575b1308ce',1,NULL,'2017-08-23 14:45:30','2017-08-23 19:16:09',1,NULL),
(7,'SJ','Carter','SJ.Carter','SJMCARTER@GMAIL.COM','cc03e747a6afbbcbf8be7668acfebee5',1,NULL,'2017-09-05 20:34:55','0000-00-00 00:00:00',1,NULL);

/* Procedure structure for procedure `Clear_login_attempts` */

/*!50003 DROP PROCEDURE IF EXISTS  `Clear_login_attempts` */;

DELIMITER $$

/*!50003 CREATE PROCEDURE `Clear_login_attempts`(IN `user_id` INT(11))
BEGIN
DELETE FROM login_attempts WHERE login_attempts.user_id=user_id;
END */$$
DELIMITER ;

/*Table structure for table `studies_view` */

DROP TABLE IF EXISTS `studies_view`;

/*!50001 DROP VIEW IF EXISTS `studies_view` */;
/*!50001 DROP TABLE IF EXISTS `studies_view` */;

/*!50001 CREATE TABLE  `studies_view`(
 `study_id` int(11) ,
 `client_name` varchar(50) ,
 `product_name` varchar(50) ,
 `study_type` varchar(50) 
)*/;

/*Table structure for table `v_active_users` */

DROP TABLE IF EXISTS `v_active_users`;

/*!50001 DROP VIEW IF EXISTS `v_active_users` */;
/*!50001 DROP TABLE IF EXISTS `v_active_users` */;

/*!50001 CREATE TABLE  `v_active_users`(
 `user_id` int(11) ,
 `uname` varchar(51) ,
 `username` varchar(25) 
)*/;

/*View structure for view studies_view */

/*!50001 DROP TABLE IF EXISTS `studies_view` */;
/*!50001 DROP VIEW IF EXISTS `studies_view` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `studies_view` AS select `studies`.`study_id` AS `study_id`,`clients`.`client_name` AS `client_name`,`products`.`product_name` AS `product_name`,`study_types`.`study_type` AS `study_type` from (((`studies` join `clients` on((`studies`.`client_id` = `clients`.`client_id`))) join `products` on((`studies`.`product_name` = `products`.`product_id`))) join `study_types` on((`studies`.`study_type` = `study_types`.`id`))) */;

/*View structure for view v_active_users */

/*!50001 DROP TABLE IF EXISTS `v_active_users` */;
/*!50001 DROP VIEW IF EXISTS `v_active_users` */;

/*!50001 CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_active_users` AS select `users`.`user_id` AS `user_id`,concat(`users`.`first_name`,' ',`users`.`last_name`) AS `uname`,`users`.`username` AS `username` from `users` where (`users`.`active` = 1) order by concat(`users`.`first_name`,' ',`users`.`last_name`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
