/*
SQLyog Enterprise v12.4.1 (32 bit)
MySQL - 5.6.36-cll-lve : Database - iaa_cms_qa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `iaa_cms_qa`;

/*Table structure for table `classifications` */

DROP TABLE IF EXISTS `classifications`;

CREATE TABLE `classifications` (
  `classification_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `classification` varchar(25) NOT NULL,
  PRIMARY KEY (`classification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `classifications` */

insert  into `classifications`(`classification_id`,`classification`) values 
(1,'Good Participant'),
(2,'Formative Only'),
(3,'DNV'),
(4,'Blacklist');

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
  KEY `FK_client_locations` (`default_location`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `clients` */

insert  into `clients`(`client_id`,`client_name`,`default_location`,`default_contact`,`shipping_carrier`,`shipping_account`) values 
(1,'AmGen',3,1,'',''),
(2,'Mockbert & Sons Manufacturing',0,0,'',''),
(3,'Abbot',5,3,'','');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `contacts` */

insert  into `contacts`(`contact_id`,`firstname`,`lastname`,`title`,`email`,`email2`,`phone`,`phone_ext`,`phone2`,`phone2_ext`,`organization`) values 
(1,'Pema','Corn','Resaerch Coordinator','pcom.amgen@mailinator.com','','(334) 340-8619','','','','AmGen'),
(2,'Toora','Roach','Ergonomics Associate','troach.btech@mailinator.com','','(612) 506-8811','','','','Beveltech'),
(3,'Bryce ','Isaacs','Diagnostics Lab Liaison','fakeemail@mailinator.com','','813-215-8736','','','','Abbot');

/*Table structure for table `education_status` */

DROP TABLE IF EXISTS `education_status`;

CREATE TABLE `education_status` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `education_level` varchar(25) NOT NULL,
  `parent_education_level` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

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
(23,'MD',NULL),
(24,'Doctorate',NULL);

/*Table structure for table `ethnicities` */

DROP TABLE IF EXISTS `ethnicities`;

CREATE TABLE `ethnicities` (
  `ethnicity_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `ethnicity` varchar(25) NOT NULL,
  `comments` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ethnicity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `ethnicities` */

insert  into `ethnicities`(`ethnicity_id`,`ethnicity`,`comments`) values 
(1,'Asian',NULL),
(2,'African American',NULL),
(3,'Caucasian',NULL),
(4,'Hispanic',NULL),
(5,'Indian',NULL),
(6,'Middle Eastern',NULL),
(7,'Mixed',NULL),
(8,'Native American',NULL),
(9,'Pacific Islander',NULL),
(10,'Declined to State',NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `locations` */

insert  into `locations`(`location_id`,`location_name`,`address1`,`address2`,`city`,`state`,`zip`,`email`,`phone`,`location_type`) values 
(1,'Saratoga Testing Facilities','1821 Saratoga Ave ','#200','Saratoga','CA','95070','iaa_saratoga@mailinator.com','(408) 342-',1),
(2,'Hamilton Lab','Westgate Office Center','4950 Hamilton Ave, Suite #104','San Jose','CA','95130','','(408) 866-',1),
(3,'AmGen Headquarters','One Amgen Center Drive','','Thousand Oaks,','CA','91320','','805-447-10',3),
(4,'U.S. CORPORATE HEADQUARTERS','Abbott Laboratories','100 Abbott Park Road','Abbott Park','IL','60064-350','fakeabbotcontact@mailinator.com','(224) 667-',1),
(5,'ABBOTT DIAGNOSTICS','5440 Patrick Henry Dr.','','Santa Clara','ca','95054','','(408) 982-',3);

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

/*Table structure for table `participant_conditions_ug` */

DROP TABLE IF EXISTS `participant_conditions_ug`;

CREATE TABLE `participant_conditions_ug` (
  `participant_id` int(11) NOT NULL,
  `medical_condition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `participant_conditions_ug` */

insert  into `participant_conditions_ug`(`participant_id`,`medical_condition`) values 
(2,25),
(2,46),
(3,5),
(3,42),
(3,43),
(4,11),
(4,12),
(4,15),
(1,2),
(1,3),
(5,15),
(5,25),
(5,26),
(5,27),
(6,18),
(7,14);

/*Table structure for table `participant_employers` */

DROP TABLE IF EXISTS `participant_employers`;

CREATE TABLE `participant_employers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parti_employer` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `participant_employers` */

insert  into `participant_employers`(`id`,`parti_employer`) values 
(1,'JT Metalworks'),
(2,'jt'),
(3,'Bear Sterns'),
(4,'Mercy Hos'),
(5,'Mercy Hospital'),
(6,'Alameda County'),
(7,'N/A'),
(8,'Nix Check Cashing'),
(9,'City of Oakla'),
(10,'City of Oakland');

/*Table structure for table `participant_notes` */

DROP TABLE IF EXISTS `participant_notes`;

CREATE TABLE `participant_notes` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `note_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `participant_notes` */

/*Table structure for table `participant_occupations` */

DROP TABLE IF EXISTS `participant_occupations`;

CREATE TABLE `participant_occupations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parti_occupation` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `participant_occupations` */

insert  into `participant_occupations`(`id`,`parti_occupation`) values 
(1,'Welder'),
(2,'Finan'),
(3,'Financial Analyst'),
(4,'LabAnalyst'),
(5,'EMT'),
(6,'Police Officerq'),
(7,'Police Officer'),
(8,'Retired'),
(9,'Cashier'),
(10,'LIBRARIAN');

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
(2,65),
(3,7),
(4,59);

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

/*Table structure for table `participant_usergroup_ug` */

DROP TABLE IF EXISTS `participant_usergroup_ug`;

CREATE TABLE `participant_usergroup_ug` (
  `participant_id` int(11) NOT NULL,
  `usergroup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `participant_usergroup_ug` */

insert  into `participant_usergroup_ug`(`participant_id`,`usergroup_id`) values 
(2,5),
(2,7),
(2,8),
(3,3),
(5,10),
(6,4),
(7,4);

/*Table structure for table `participants` */

DROP TABLE IF EXISTS `participants`;

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) NOT NULL,
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
  `classification` varchar(22) DEFAULT NULL,
  `phone_msg` tinyint(3) DEFAULT NULL,
  `alt_phone_msg` tinyint(3) DEFAULT NULL,
  `esl` tinyint(3) DEFAULT NULL,
  `need_wheelchair` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `participants` */

insert  into `participants`(`participant_id`,`firstname`,`middlename`,`lastname`,`address1`,`address2`,`city`,`state`,`zip`,`country`,`phone`,`phone_ext`,`alternate_phone`,`alternate_phone_ext`,`email`,`alternate_email`,`dob`,`age`,`gender`,`ethnicity`,`education`,`occupation`,`employer`,`transportation`,`contact_status`,`photo_src`,`do_not_call`,`do_not_email`,`decreased`,`classification`,`phone_msg`,`alt_phone_msg`,`esl`,`need_wheelchair`) values 
(1,'John','Q','Public',NULL,NULL,'Emeryville','CA','90255',NULL,'510-710-0000',0,'415-123-456',123,'jptest@mailinator.com','','1975-02-15',42,1,3,17,'Welder','JT Metalworks',1,NULL,NULL,NULL,1,NULL,'2',1,NULL,1,1),
(2,'Jason','','Chu',NULL,NULL,'San Franciso','CA','94016',NULL,'415-000-0000',0,'0-0-0',0,'jchu@mailinator.com','','1976-05-01',41,1,1,20,'LabAnalyst','Bear Sterns',1,NULL,'',NULL,NULL,NULL,'1',1,NULL,2,1),
(3,'DeShawn','W','Johnson',NULL,NULL,'Oakland','CA','94116',NULL,'510-123-4567',0,'0-0-0',0,'djackson@mailinator.com','','1982-01-01',35,1,2,18,'EMT','Mercy Hospital',3,NULL,'Black_Man_Young.jpg',NULL,NULL,NULL,'1',1,NULL,1,1),
(4,'Allesandro','','Gomez',NULL,NULL,'Walnut Creek','CA','94517',NULL,'669-123-4556',0,'415-987-6543',333,'','','1972-10-06',45,1,4,15,'Police Officer','Alameda County',6,NULL,'',NULL,1,NULL,'3',1,NULL,1,1),
(5,'Maria','','Torres',NULL,NULL,'Moraga','CA','94556',NULL,'0-0-0',0,'0-0-0',0,'','','1945-03-16',72,2,4,16,'Retired','N/A',5,NULL,'Latin_Woman_MiddleAged.jpg',NULL,1,NULL,'1',NULL,NULL,2,2),
(6,'Stephanie','','Miller',NULL,NULL,'West Oakland','CA','94607',NULL,'0-0-0',0,'0-0-0',0,'','','0000-00-00',22,2,3,13,'Cashier','Nix Check Cashing',2,NULL,'',1,1,NULL,'4',NULL,NULL,1,1),
(7,'Jan','S','McCarthy',NULL,NULL,'San Leandro','CA','94577',NULL,'415-123-6666',0,'510-888-8888',88888,'jm@ailinator.com','','1988-07-25',29,2,3,19,'Librarian','City of Oakland',2,NULL,'',NULL,NULL,NULL,'1',1,NULL,1,1);

/*Table structure for table `product_types` */

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `product_types` */

insert  into `product_types`(`id`,`product_type`) values 
(1,'Autoinjector'),
(2,'PFS'),
(3,'System');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`product_id`,`product_type_id`,`product_name`) values 
(1,0,'Test Product ABC'),
(2,0,'Test Product XYZ');

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
(7,12),
(7,13),
(2,11),
(3,12),
(4,13),
(5,14),
(1,11),
(1,12),
(1,13),
(1,14),
(6,1),
(6,2),
(6,3),
(6,4);

/*Table structure for table `user_groups` */

DROP TABLE IF EXISTS `user_groups`;

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `user_groups` */

insert  into `user_groups`(`id`,`group_name`) values 
(1,'Teen (12-17)'),
(2,'Child (Under 12)'),
(3,'iPhone User'),
(4,'Non-iPhone User'),
(5,'PC User'),
(6,'Mac User'),
(7,'Tablet User'),
(8,'Laptop User'),
(9,'Desktop User'),
(10,'Fitbit Users'),
(11,'Garmin Users'),
(12,'Printer Users');

/*Table structure for table `user_roles` */

DROP TABLE IF EXISTS `user_roles`;

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `color` varchar(25) DEFAULT 'black',
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `user_roles` */

insert  into `user_roles`(`role_id`,`role`,`record_status`,`color`,`description`) values 
(1,'Recruiter',1,'black',NULL),
(2,'Lead',1,'black',NULL),
(3,'Datalogger',1,'black',NULL),
(4,'AV',1,'black',NULL);

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
  KEY `users_persons` (`person_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`first_name`,`last_name`,`username`,`email`,`password`,`record_status`,`user_role`,`created`,`last_mod`,`active`,`person_id`) values 
(1,'Admin','User','admin','iaa.admin@mailinator.com','68eacb97d86f0c4621fa2b0e17cabd8c',1,NULL,'2017-10-06 21:16:24','2017-10-06 12:13:41',1,NULL),
(2,'Recruiter','User','Recruiter.User','Recruiter.User@mailinator.com','2956a5fde5fe078188d1d3aae320c02f',1,NULL,'2017-10-06 21:14:30','0000-00-00 00:00:00',1,NULL),
(3,'Lead','User','Lead.User','Lead.User@mailinator.com','2956a5fde5fe078188d1d3aae320c02f',1,NULL,'2017-10-06 21:14:58','0000-00-00 00:00:00',1,NULL),
(4,'Datalogger','User','Datalogger.User','Datalogger.User@mailinator.com','2956a5fde5fe078188d1d3aae320c02f',1,NULL,'2017-10-06 21:15:44','0000-00-00 00:00:00',1,NULL),
(5,'AV','User','AV.User','AV.User@mailinator.com','2956a5fde5fe078188d1d3aae320c02f',1,NULL,'2017-10-06 21:16:09','0000-00-00 00:00:00',1,NULL),
(6,'Test','User1','Test.User1','Test.User1@mailinator.com','2956a5fde5fe078188d1d3aae320c02f',1,NULL,'2017-10-09 16:15:27','0000-00-00 00:00:00',1,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
