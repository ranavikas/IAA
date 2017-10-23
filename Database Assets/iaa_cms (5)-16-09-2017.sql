-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2017 at 08:53 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iaa_cms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Clear_login_attempts` (IN `user_id` INT(11))  BEGIN
DELETE FROM login_attempts WHERE login_attempts.user_id=user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `audit_id` bigint(20) NOT NULL,
  `page_id` tinyblob NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `action` varchar(50) NOT NULL,
  `record_id` int(11) DEFAULT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

CREATE TABLE `classifications` (
  `classification_id` tinyint(4) NOT NULL,
  `classification` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`classification_id`, `classification`) VALUES
(2, 'good participant'),
(3, 'Cooperative participant');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `default_location` int(11) DEFAULT NULL,
  `default_contact` int(11) DEFAULT NULL,
  `shipping_carrier` varchar(25) DEFAULT NULL,
  `shipping_account` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_name`, `default_location`, `default_contact`, `shipping_carrier`, `shipping_account`) VALUES
(1, 'Faisal', 1, 1, '11', '232323'),
(2, 'Aslam', 1, 2, '2', '222');

-- --------------------------------------------------------

--
-- Table structure for table `client_contacts`
--

CREATE TABLE `client_contacts` (
  `client_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_contacts`
--

INSERT INTO `client_contacts` (`client_id`, `contact_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `title` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `phone_ext` varchar(5) DEFAULT NULL,
  `phone2` varchar(15) DEFAULT NULL,
  `phone2_ext` varchar(5) DEFAULT NULL,
  `organization` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `firstname`, `lastname`, `title`, `email`, `email2`, `phone`, `phone_ext`, `phone2`, `phone2_ext`, `organization`) VALUES
(2, 'Azeeem11', 'khan11', 'Azooo11', 'madni38011@yahoo.com', 'fg11@gmail.com', '435345349911', '123', '43242342399311', '456', 'dsdsd11');

-- --------------------------------------------------------

--
-- Table structure for table `contact_status`
--

CREATE TABLE `contact_status` (
  `status_id` tinyint(4) NOT NULL,
  `contact_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education_status`
--

CREATE TABLE `education_status` (
  `id` tinyint(4) NOT NULL,
  `education_level` varchar(25) NOT NULL,
  `parent_education_level` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_status`
--

INSERT INTO `education_status` (`id`, `education_level`, `parent_education_level`) VALUES
(1, 'K-12', NULL),
(2, 'Kindergarten', 1),
(3, 'Grade 1', 1),
(4, 'Grade 2', 1),
(5, 'Grade 3', 1),
(6, 'Grade 4', 1),
(7, 'Grade 5', 1),
(8, 'Grade 6', 1),
(9, 'Grade 7', 1),
(10, 'Grade 8', 1),
(11, 'Grade 9', 1),
(12, 'Grade 10', 1),
(13, 'Grade 11', 1),
(14, 'Grade 12', 1),
(15, 'High School Diploma', NULL),
(16, 'GED', NULL),
(17, 'Trade School', NULL),
(18, 'Associate Degree', NULL),
(19, 'Bachelor’s Degree', NULL),
(20, 'Master’s Degree', NULL),
(21, 'PhD', NULL),
(22, 'Professional Degree', NULL),
(23, 'MD', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ethnicities`
--

CREATE TABLE `ethnicities` (
  `ethnicity_id` tinyint(4) NOT NULL,
  `ethnicity` varchar(25) NOT NULL,
  `comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ethnicities`
--

INSERT INTO `ethnicities` (`ethnicity_id`, `ethnicity`, `comments`) VALUES
(1, 'White', ''),
(2, 'Black', NULL),
(4, 'Pacific Islander', NULL),
(5, 'Native American', NULL),
(14, 'AAAAA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `gender_id` tinyint(4) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `gender_abbreviation` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`gender_id`, `gender`, `gender_abbreviation`) VALUES
(1, 'Male', 'M'),
(2, 'Female', 'F'),
(3, 'MTF Transexual', 'TM'),
(4, 'FTM Transexual', 'TF');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(50) NOT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` char(2) DEFAULT NULL,
  `zip` varchar(9) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `location_type` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `address1`, `address2`, `city`, `state`, `zip`, `email`, `phone`, `location_type`) VALUES
(1, 'Lahore', 'lhr', 'lhr2', 'lahorry', 'pu', '3600', 'asad@gmail.com', '3442', 1),
(2, 'Multan', 'sfsd', 'sds', 'multan', 'pu', '36000', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `location_contacts`
--

CREATE TABLE `location_contacts` (
  `location_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location_types`
--

CREATE TABLE `location_types` (
  `id` tinyint(4) NOT NULL,
  `location_type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location_types`
--

INSERT INTO `location_types` (`id`, `location_type`) VALUES
(1, 'Lab / Internal'),
(2, 'Offsite'),
(3, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `login_id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(25) NOT NULL,
  `login_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_timestamp` datetime DEFAULT NULL,
  `ip_address` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`login_id`, `user_id`, `session_id`, `login_timestamp`, `logout_timestamp`, `ip_address`) VALUES
(1, 3, '599cfb766c7a1', '2017-08-23 05:50:14', '2017-08-23 05:50:53', NULL),
(2, 3, '599cfc86028d5', '2017-08-23 05:54:46', '2017-08-23 05:55:02', NULL),
(4, 3, '599d0078e8c68', '2017-08-23 06:11:36', '2017-08-23 06:48:53', NULL),
(5, 3, '599d093c821c1', '2017-08-23 06:49:00', NULL, NULL),
(6, 3, '599d77e1763d5', '2017-08-23 14:41:05', NULL, NULL),
(7, 3, '599dacdb7e4ff', '2017-08-23 18:27:07', NULL, NULL),
(8, 3, '599e3fc36850c', '2017-08-24 04:53:55', '2017-08-24 05:07:27', NULL),
(9, 3, '599e42fd0b95b', '2017-08-24 05:07:41', '2017-08-24 05:11:39', NULL),
(10, 3, '599e43ed32550', '2017-08-24 05:11:41', '2017-08-24 05:12:23', NULL),
(11, 3, '599e4418607e7', '2017-08-24 05:12:24', '2017-08-24 12:48:35', NULL),
(12, 3, '599eaf20a32e0', '2017-08-24 12:49:04', '2017-08-24 12:49:10', NULL),
(13, 3, '599eaf2c3881e', '2017-08-24 12:49:16', '2017-08-24 12:49:24', NULL),
(14, 3, '599eaf398f9dd', '2017-08-24 12:49:29', '2017-08-24 12:49:36', NULL),
(15, 3, '599eaf51a9b20', '2017-08-24 12:49:53', NULL, NULL),
(16, 3, '599ffcb9cd55f', '2017-08-25 12:32:25', NULL, NULL),
(17, 3, '59a04d0aa6c84', '2017-08-25 18:15:06', NULL, NULL),
(18, 3, '59a0dd9b34547', '2017-08-26 04:31:55', NULL, NULL),
(19, 3, '59a13d2f63da7', '2017-08-26 11:19:43', NULL, NULL),
(20, 3, '59a18330c2e0b', '2017-08-26 16:18:24', NULL, NULL),
(21, 3, '59a4cb949fc61', '2017-08-29 04:04:04', '2017-08-29 04:52:54', NULL),
(22, 3, '59a4ffb17d68a', '2017-08-29 07:46:25', NULL, NULL),
(23, 3, '59a5a1e983a64', '2017-08-29 19:18:33', NULL, NULL),
(24, 3, '59a624e020293', '2017-08-30 04:37:20', NULL, NULL),
(25, 3, '59a6e002df9ac', '2017-08-30 17:55:46', NULL, NULL),
(26, 3, '59a776275c9ac', '2017-08-31 04:36:23', NULL, NULL),
(27, 3, '59a7cec0bdf8f', '2017-08-31 10:54:24', NULL, NULL),
(28, 3, '59a833217b18f', '2017-08-31 18:02:41', NULL, NULL),
(29, 3, '59a8b3108b312', '2017-09-01 03:08:32', NULL, NULL),
(30, 3, '59a908c53fc29', '2017-09-01 09:14:13', NULL, NULL),
(31, 3, '59abf8d21a147', '2017-09-03 14:42:58', NULL, NULL),
(32, 3, '59ac2a17f0070', '2017-09-03 18:13:11', NULL, NULL),
(33, 3, '59ace113546bb', '2017-09-04 07:13:55', NULL, NULL),
(34, 3, '59ad29db50356', '2017-09-04 12:24:27', NULL, NULL),
(35, 3, '59ad8e4ff15a2', '2017-09-04 19:33:03', NULL, NULL),
(36, 3, '59ae0c7b966cc', '2017-09-05 04:31:23', NULL, NULL),
(37, 3, '59ae4c976cad0', '2017-09-05 09:04:55', NULL, NULL),
(38, 3, '59af651c31037', '2017-09-06 05:01:48', '2017-09-06 05:57:28', NULL),
(39, 3, '59af722a8e91a', '2017-09-06 05:57:30', NULL, NULL),
(40, 3, '59b001d1c5ceb', '2017-09-06 16:10:25', NULL, NULL),
(41, 3, '59b2bef5173a3', '2017-09-08 18:01:57', NULL, NULL),
(42, 3, '59b46cc099d0a', '2017-09-10 00:35:44', NULL, NULL),
(43, 3, '59b5fd9a0ee0f', '2017-09-11 05:06:02', NULL, NULL),
(44, 3, '59b659dbc7384', '2017-09-11 11:39:39', NULL, NULL),
(45, 3, '59b747201000c', '2017-09-12 04:32:00', NULL, NULL),
(46, 3, '59b7b52a232e0', '2017-09-12 12:21:30', NULL, NULL),
(47, 3, '59b8fdf2992eb', '2017-09-13 11:44:18', NULL, NULL),
(48, 3, '59b9ff1cc4850', '2017-09-14 06:01:32', NULL, NULL),
(49, 3, '59bb431bdc12c', '2017-09-15 05:03:55', NULL, NULL),
(50, 3, '59bc97fc56da0', '2017-09-16 05:18:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions`
--

CREATE TABLE `medical_conditions` (
  `id` int(11) NOT NULL,
  `medical_condition` varchar(100) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medical_conditions`
--

INSERT INTO `medical_conditions` (`id`, `medical_condition`, `record_status`) VALUES
(1, 'No Medical Conditions', 1),
(2, 'Acne', 1),
(3, 'Allergies', 1),
(4, 'Alzheimers', 1),
(5, 'Anemia', 1),
(6, 'Ankylosing Spondylitis', 1),
(7, 'Anxiety Disorders', 1),
(8, 'Asthma', 1),
(9, 'Bipolar', 1),
(10, 'Blind', 1),
(11, 'Cancer', 1),
(12, 'Cancer – Chemotherapy', 1),
(13, 'Cancer – Remission', 1),
(14, 'Carpal Tunnel', 1),
(15, 'Cardiac/Heart  Condition', 1),
(16, 'Cataracts', 1),
(17, 'Chronic Pain', 1),
(18, 'Cluster Headache', 1),
(19, 'Cluster Seizure', 1),
(20, 'Color Blind', 1),
(21, 'COPD', 1),
(22, 'Crohn’s Disease', 1),
(23, 'Diabetes', 1),
(24, 'Diabetes – Type 1', 1),
(25, 'Diabetes – Type 2', 1),
(26, 'Diabetes – Pump User', 1),
(27, 'Dialysis/Chronic Kidney Failure', 1),
(28, 'Depression', 1),
(29, 'Dimensia', 1),
(30, 'Eczema', 1),
(31, 'Epilepsy', 1),
(32, 'Erectile Dysfunction', 1),
(33, 'Fertility', 1),
(34, 'Fibromyalgia', 1),
(35, 'Glaucoma', 1),
(36, 'Glucagon Experienced', 1),
(37, 'Growth Hormone', 1),
(38, 'Hemophilia A', 1),
(39, 'Hemophilia B', 1),
(40, 'Hemorrhoids', 1),
(41, 'Hepatitis C', 1),
(42, 'High Blood Pressure', 1),
(43, 'High Cholesterol', 1),
(44, 'Hidradenitis Suppurativa', 1),
(45, 'HIV', 1),
(46, 'Hypertension', 1),
(47, 'JIA (Juvenile Idiopathic Arthritis)', 1),
(48, 'Lupus', 1),
(49, 'LVAD', 1),
(50, 'Mastectomy', 1),
(51, 'Migraine', 1),
(52, 'Multiple Sclerosis (MS)', 1),
(53, 'Neuropathy', 1),
(54, 'Obese', 1),
(55, 'Osteoarthritis', 1),
(56, 'Osteoporosis', 1),
(57, 'Panuveitis (UV)', 1),
(58, 'Parkinson’s Disease', 1),
(59, 'PKU', 1),
(60, 'Platelet Disorder', 1),
(61, 'Prader-Willi Syndrome', 1),
(62, 'Precocious Puberty', 1),
(63, 'Psoriasis', 1),
(64, 'Psoriatic Arthritis', 1),
(65, 'Retinopathy', 1),
(66, 'Rheumatoid Arthritis', 1),
(67, 'Schizophrenia', 1),
(68, 'Seizures', 1),
(69, 'Sjögren''s Syndrome', 1),
(70, 'Skin Disorders/Issues', 1),
(71, 'Thyroid', 1),
(72, 'Ulcerative Colitis', 1);

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL,
  `occupation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `occupation`) VALUES
(1, 'BioMed Tech'),
(2, 'BioTech Lab Researcher'),
(3, 'Caregivers/Home Health'),
(4, 'Dental Assistant'),
(5, 'Dentist'),
(6, 'Dialysis Tech'),
(7, 'EMT'),
(8, 'Fire Fighter'),
(9, 'First Responders'),
(10, 'Gynecologist'),
(11, 'HCP'),
(12, 'HCP – RN'),
(13, 'HCP – LVN'),
(14, 'HCP – MA'),
(15, 'HCP – PA'),
(16, 'HCP – DR'),
(17, 'HCP – Anesthesiology'),
(18, 'HCP – Cardiovascular'),
(19, 'HCP – Critical Care'),
(20, 'HCP – Dermatology'),
(21, 'HCP – Dialysis/Renal'),
(22, 'HCP – ER'),
(23, 'HCP – Family Practice'),
(24, 'HCP – Gastroenterology'),
(25, 'HCP – Geriatric'),
(26, 'HCP  –  Hematology'),
(27, 'HCP – ICU'),
(28, 'HCP – Internal Medicine'),
(29, 'HCP – LVAD'),
(30, 'HCP – Neurology'),
(31, 'HCP – Nephrology'),
(32, 'HCP – OBGYN'),
(33, 'HCP – Oncology'),
(34, 'HCP – OR'),
(35, 'HCP – Outpatient'),
(36, 'HCP – Pediatrics'),
(37, 'HCP – Plastic Surgery'),
(38, 'HCP – Preventive Care'),
(39, 'HCP – Primary Care'),
(40, 'HCP – Pulmonology'),
(41, 'HCP – Public Health'),
(42, 'HCP – Psych'),
(43, 'HCP – Rheumatology'),
(44, 'HCP – Surgical'),
(45, 'HCP – Telemetry/Med Surge'),
(46, 'HCP – Unknown'),
(47, 'HCP – Urology'),
(48, 'IT'),
(49, 'Hygienist'),
(50, 'Lasik Surgeons'),
(51, 'Lasik Techs'),
(52, 'OBGYN'),
(53, 'Ophthalmologist'),
(54, 'Ophthalmology Tech'),
(55, 'Paramedic'),
(56, 'PCT'),
(57, 'Pharmacist'),
(58, 'Pharmacy Tech'),
(59, 'Police Officer'),
(60, 'Reprocessing Tech'),
(61, 'School Nurse'),
(65, 'BioMed Tech'),
(66, 'BioTech Lab Researcher'),
(67, 'Caregivers/Home Health'),
(68, 'Dental Assistant'),
(69, 'Dentist'),
(70, 'Dialysis Tech'),
(71, 'EMT'),
(72, 'Fire Fighter'),
(73, 'First Responders'),
(74, 'Gynecologist'),
(75, 'HCP'),
(76, 'HCP – RN'),
(77, 'HCP – LVN'),
(78, 'HCP – MA'),
(79, 'HCP – PA'),
(80, 'HCP – DR'),
(81, 'HCP – Anesthesiology'),
(82, 'HCP – Cardiovascular'),
(83, 'HCP – Critical Care'),
(84, 'HCP – Dermatology'),
(85, 'HCP – Dialysis/Renal'),
(86, 'HCP – ER'),
(87, 'HCP – Family Practice'),
(88, 'HCP – Gastroenterology'),
(89, 'HCP – Geriatric'),
(90, 'HCP  –  Hematology'),
(91, 'HCP – ICU'),
(92, 'HCP – Internal Medicine'),
(93, 'HCP – LVAD'),
(94, 'HCP – Neurology'),
(95, 'HCP – Nephrology'),
(96, 'HCP – OBGYN'),
(97, 'HCP – Oncology'),
(98, 'HCP – OR'),
(99, 'HCP – Outpatient'),
(100, 'HCP – Pediatrics'),
(101, 'HCP – Plastic Surgery'),
(102, 'HCP – Preventive Care'),
(103, 'HCP – Primary Care'),
(104, 'HCP – Pulmonology'),
(105, 'HCP – Public Health'),
(106, 'HCP – Psych'),
(107, 'HCP – Rheumatology'),
(108, 'HCP – Surgical'),
(109, 'HCP – Telemetry/Med Surge'),
(110, 'HCP – Unknown'),
(111, 'HCP – Urology'),
(112, 'IT'),
(113, 'Hygienist'),
(114, 'Lasik Surgeons'),
(115, 'Lasik Techs'),
(116, 'OBGYN'),
(117, 'Ophthalmologist'),
(118, 'Ophthalmology Tech'),
(119, 'Paramedic'),
(120, 'PCT'),
(121, 'Pharmacist'),
(122, 'Pharmacy Tech'),
(123, 'Police Officer'),
(124, 'Reprocessing Tech'),
(125, 'School Nurse');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL,
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
  `classification` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participant_id`, `firstname`, `middlename`, `lastname`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone`, `phone_ext`, `alternate_phone`, `alternate_phone_ext`, `email`, `alternate_email`, `dob`, `age`, `gender`, `ethnicity`, `education`, `occupation`, `employer`, `transportation`, `contact_status`, `photo_src`, `do_not_call`, `do_not_email`, `decreased`, `classification`) VALUES
(1, 'Faizans', 'asss', 'khansss', NULL, NULL, 'lahore', 'AL', '6700', NULL, '4353453499', 989, '432423423993', 333, 'madni198@gmail.com', 'fg@gmail.com', '2017-08-17', 0, 1, 2, 10, '7', 'Doctor', 1, NULL, 'splash-border-2562.png', NULL, 1, NULL, ''),
(2, 'Almas', 'A', 'Raza', '', '', '', '', '', NULL, '4353453499', 4, '43242342399311', 5, 'almas@gmail.com', '', '2010-08-07', 7, 2, 2, 15, '10', 'Doctor', 2, NULL, 'splash-border-256.png', 1, NULL, 1, ''),
(3, 'Faheem', 'a', 'Ansari', '', '', '', '', '', NULL, '', 0, '', 0, '', '', '0000-00-00', 0, 1, 1, -1, '1', '', 1, NULL, '', NULL, NULL, NULL, 'good'),
(4, 'Adeel', 'a ', 'Khan', 'lhg', 'gojra', 'lahore', 'pu', '36000', NULL, '4353453499', 989, '43242342399', 34343, 'adeel@gmail.com', '', '2010-06-16', 7, 2, 2, 16, '5', 'Doctor', 2, NULL, 'splash-256.png', NULL, NULL, 1, 'good'),
(5, 'Sajjad', 'a', 'Khan', NULL, NULL, 'gojra', 'AL', '36000', NULL, '4353453494', 555, '43242342229', 888, 'sajjad@gmail.com', 'sajjad2@gmail.com', '2010-01-27', 7, 1, 4, 15, '16', 'Teacher', 2, NULL, 'ergonomic-table-height-550x3671.jpg', 1, NULL, NULL, ''),
(6, 'Hamad', 'a', 'Ali', NULL, NULL, 'smiss', 'AL', '345666', NULL, '3334256335', 666, '43342342453', 777, 'hamd@gmail.com', '', '2009-09-01', 8, 1, 5, 21, 'Teacher', 'School', 2, NULL, 'High-standard-height-adjustable-gaming-table-pc2.jpg', 1, NULL, NULL, '2'),
(7, 'Usman', 's', 'Khan', NULL, NULL, 'Gojra', 'AK', '6700', NULL, '4353453499', 0, '43242342399311', 0, 'usman@gmail.com', '', '2009-01-01', 8, 1, 1, 21, 'BioMed Tech', 'Doctor', 1, NULL, '', 1, NULL, NULL, '2'),
(8, 'User1', 'dd', 'ssss', NULL, NULL, '', 'AL', '', NULL, '', 0, '', 0, '', '', '2017-09-12', 0, 1, 1, 15, 'dddoo123', 'Doctor', 1, NULL, 'High-standard-height-adjustable-gaming-table-pc3.jpg', NULL, NULL, NULL, ''),
(10, 'Khurram', 'a', 'Khan', NULL, NULL, '', 'AL', '', NULL, '', 0, '', 0, '', '', '2009-05-11', 8, 1, 1, 20, 'BioMed Tech', 'Doctor', 1, NULL, 'High-standard-height-adjustable-gaming-table-pc4.jpg', 1, 1, NULL, '2'),
(11, 'Hamaaad', 'a', 'aaa', NULL, NULL, '', 'AL', '', NULL, '', 0, '', 0, '', '', '2009-01-06', 8, 1, 1, 20, 'BioMed Tech', 'Doctor', 1, NULL, 'ergonomic-table-height-550x3672.jpg', NULL, NULL, NULL, '2'),
(12, 'Shameem', 'a', 'Khan', NULL, NULL, 'Gojra', 'AL', '6700', NULL, '4353453499', 333, '43242342399', 444, 'shm198@gmail.com', '', '2009-01-06', 8, 1, 1, 15, 'BioMed Tech', 'Doctor', 1, NULL, 'ergonomic-table-height-550x3673.jpg', 1, NULL, NULL, '2'),
(15, 'Aqeel', 'a', 'Khan', NULL, NULL, '', 'AL', '', NULL, '', 0, '', 0, '', '', '2009-01-06', 8, 1, 1, -1, '', '', 1, NULL, '', NULL, NULL, NULL, ''),
(16, 'Fahad', 'a', 'ali', NULL, NULL, 'fsd', 'ME', '6700', NULL, '4353453499', 222, '43242342399', 333, 'madni198@gmail.com', 'fg@gmail.com', '2017-09-12', 0, 2, 2, 12, 'BioMed Tech', 'Doctor', 2, NULL, '', 1, 1, 1, '2'),
(17, 'Faheemm', 'a', 'alwi', NULL, NULL, 'Gojra', 'AL', '', NULL, '22234', 333, '342343', 222, 'faheemq@gmail.com', '', '2017-09-07', 0, 2, 1, 15, 'BioMed Tech', 'Doctor', 1, NULL, '', NULL, NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `participants_autosave`
--

CREATE TABLE `participants_autosave` (
  `participant_autosave_id` int(11) NOT NULL,
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
  `classification` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants_autosave`
--

INSERT INTO `participants_autosave` (`participant_autosave_id`, `user_id`, `firstname`, `middlename`, `lastname`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone`, `phone_ext`, `alternate_phone`, `alternate_phone_ext`, `email`, `alternate_email`, `dob`, `age`, `gender`, `ethnicity`, `education`, `occupation`, `employer`, `transportation`, `contact_status`, `photo_src`, `do_not_call`, `do_not_email`, `decreased`, `classification`) VALUES
(2, 2, '', '', '', NULL, NULL, '', '', '', NULL, '', 0, '', 0, '', '', '0000-00-00', 0, 1, 1, -1, '1', '', 1, NULL, '', NULL, NULL, NULL, ''),
(3, 1, '', '', '', NULL, NULL, '', 'AL', '', NULL, '', 0, '', 0, '', '', NULL, 0, 1, 1, -1, '', '', 1, NULL, '', NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `participant_conditions_autosave`
--

CREATE TABLE `participant_conditions_autosave` (
  `participant_id` int(11) NOT NULL,
  `medical_condition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_conditions_ug`
--

CREATE TABLE `participant_conditions_ug` (
  `participant_id` int(11) NOT NULL,
  `medical_condition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant_conditions_ug`
--

INSERT INTO `participant_conditions_ug` (`participant_id`, `medical_condition`) VALUES
(2, 1),
(4, 2),
(5, 1),
(5, 2),
(1, 1),
(6, 1),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(15, 1),
(16, 1),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `participant_notes`
--

CREATE TABLE `participant_notes` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `note_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant_occupations_autosave`
--

CREATE TABLE `participant_occupations_autosave` (
  `participant_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_occupations_ug`
--

CREATE TABLE `participant_occupations_ug` (
  `participant_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant_occupations_ug`
--

INSERT INTO `participant_occupations_ug` (`participant_id`, `occupation_id`) VALUES
(2, 1),
(4, 2),
(5, 1),
(5, 2),
(1, 1),
(6, 1),
(7, 1),
(7, 2),
(8, 3),
(8, 4),
(10, 2),
(12, 1),
(16, 1),
(17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `participant_photolog`
--

CREATE TABLE `participant_photolog` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `study` varchar(50) NOT NULL,
  `datee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participant_photolog`
--

INSERT INTO `participant_photolog` (`participant_id`, `notes`, `status`, `study`, `datee`) VALUES
(2, 'note1', 'screened', 'stud', '2017-08-22'),
(4, 'notttt', 'scheduled', 'fff', '2017-08-24'),
(5, 'note1', 'screened', '12', '2017-09-07'),
(1, 'notttt', 'screened', 'gggu', '2017-08-17'),
(1, 'notttt', 'scheduled', 'fff', '2017-08-17'),
(6, 'These are study notes', 'New', '1:Faisal Computer Formative', '2017-09-08'),
(6, 'These are study notes', 'New', '1:Faisal Computer Formative', '2017-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `participant_photolog_autosave`
--

CREATE TABLE `participant_photolog_autosave` (
  `participant_id` int(11) NOT NULL,
  `notes` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `study` varchar(10) NOT NULL,
  `datee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_usergroup_autosave`
--

CREATE TABLE `participant_usergroup_autosave` (
  `participant_id` int(11) NOT NULL,
  `usergroup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_usergroup_ug`
--

CREATE TABLE `participant_usergroup_ug` (
  `participant_id` int(11) NOT NULL,
  `usergroup_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participant_usergroup_ug`
--

INSERT INTO `participant_usergroup_ug` (`participant_id`, `usergroup_id`) VALUES
(4, 3),
(5, 1),
(5, 2),
(6, 1),
(7, 1),
(7, 2),
(8, 2),
(10, 1),
(11, 1),
(11, 2),
(12, 1),
(15, 1),
(16, 1),
(17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_type_id`, `product_name`) VALUES
(1, 1, 'Math book'),
(2, 1, 'Computer'),
(3, 1, 'Pen'),
(4, 1, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `product_type`) VALUES
(1, 'Autoinjector');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` tinyint(4) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`) VALUES
(1, 'Lead'),
(2, 'Recruiter'),
(3, 'AV'),
(4, 'Datalogger ');

-- --------------------------------------------------------

--
-- Table structure for table `screener_answers`
--

CREATE TABLE `screener_answers` (
  `study_user_group_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `screener_question` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screener_answers`
--

INSERT INTO `screener_answers` (`study_user_group_id`, `participant_id`, `screener_question`, `answer`) VALUES
(1, 1, 1, 'Yes'),
(1, 1, 2, 'Epilepsy, Cluster Headaches'),
(1, 1, 3, 'Lipitor'),
(94, 1, 1, 'No'),
(94, 2, 1, 'Yes'),
(71, 1, 10, 'one'),
(71, 1, 11, 'asad'),
(71, 2, 10, 'one,two,three'),
(71, 2, 11, 'azar'),
(3920, 3, 1, 'No'),
(3920, 3, 10, 'two,three'),
(3920, 3, 11, 'true'),
(3920, 16, 1, 'Yes'),
(3920, 16, 10, 'two'),
(3920, 16, 11, '1234'),
(3920, 15, 1, 'Yes'),
(3920, 15, 3, 'tredet'),
(3920, 15, 10, 'one,two,three'),
(3920, 15, 11, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `screener_questions`
--

CREATE TABLE `screener_questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_type` tinyint(4) DEFAULT '1' COMMENT '1=single; 2=multi-select; 3=free-text',
  `last_modified` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screener_questions`
--

INSERT INTO `screener_questions` (`id`, `question`, `question_type`, `last_modified`) VALUES
(1, 'Do you have diabetes?', 1, '2017-08-24 13:45:46'),
(2, 'Which neurological conditions do you have?', 2, '2017-08-24 13:45:46'),
(3, 'What medications do you take to treat your condition?', 3, '2017-08-24 13:45:46'),
(10, 'Multiple Choice Question', 2, '2017-08-26 11:56:55'),
(11, 'Free Text Question', 3, '2017-08-26 12:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `screener_question_options`
--

CREATE TABLE `screener_question_options` (
  `id` int(11) NOT NULL,
  `screener_question` int(11) NOT NULL,
  `option` varchar(255) NOT NULL,
  `order` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `screener_question_options`
--

INSERT INTO `screener_question_options` (`id`, `screener_question`, `option`, `order`) VALUES
(1, 1, 'Yes', 1),
(2, 1, 'No', 2),
(3, 2, 'Epilepsy', 1),
(5, 2, 'Migraines', 2),
(6, 2, 'Parkinson''s Disease', 3),
(7, 2, 'Coluster Headaches', 4),
(25, 10, 'one', 1),
(26, 10, 'two', 2),
(27, 10, 'three', 3);

-- --------------------------------------------------------

--
-- Table structure for table `search_options`
--

CREATE TABLE `search_options` (
  `id` smallint(6) NOT NULL,
  `search_field` varchar(25) NOT NULL,
  `display_name` varchar(25) DEFAULT NULL,
  `field_type` varchar(25) DEFAULT 'multi-select',
  `value_type` varchar(25) DEFAULT NULL,
  `linking_table` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `search_options`
--

INSERT INTO `search_options` (`id`, `search_field`, `display_name`, `field_type`, `value_type`, `linking_table`) VALUES
(1, 'medical_condition', 'Medical Condition', 'multi-select', NULL, 'medical_conditions'),
(2, 'age_range', 'Age Range', 'input-range', 'numeric', NULL),
(3, 'gender', 'Gender', 'multi-select', NULL, 'genders'),
(4, 'education', 'Education', 'select', NULL, 'education_status'),
(5, 'participant_name', 'Participant Name', 'input', NULL, NULL),
(6, 'participant_city', 'Participant City', 'multi-select', NULL, NULL),
(7, 'participant_zip', 'Participant Zip', 'multi-select', NULL, NULL),
(8, 'ethnicity', 'Ethnicity', 'multi-select', NULL, 'ethnicities'),
(9, 'occupation', 'Occupation', 'multi-select', NULL, 'occupations'),
(10, 'study', 'Study', 'multi-select', NULL, 'studies'),
(11, 'classification', 'Classification', 'multi-select', NULL, 'classifications'),
(12, 'employer', 'Employer', 'multi-select', NULL, 'vw_ParticipantEmployers'),
(13, 'transportation', 'Transportation', 'multi-select', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studies`
--

CREATE TABLE `studies` (
  `study_id` int(11) NOT NULL,
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
  `created` date NOT NULL,
  `noted_last_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studies`
--

INSERT INTO `studies` (`study_id`, `client_id`, `product_name`, `product_type`, `study_type`, `number_of_usergroups`, `start_date`, `end_date`, `study_status`, `focus_vision`, `recruiter`, `lead`, `datalogger`, `av`, `study_number`, `study_notes`, `study_dnq_notes`, `client_contact_info`, `created`, `noted_last_modified`) VALUES
(1, 1, 2, 1, 1, 3, '2017-09-01', '2017-09-30', 1, 0, 3, 3, 3, 3, '1', 'These are study notes', 'This is a test', '					\r\nName Azeeem11 khan11Email madni38011@yahoo.comPhone 435345349911Organization dsdsd11', '2017-09-08', '0000-00-00'),
(2, 1, 3, 1, 1, 4, '2017-09-01', '2017-09-09', 1, 0, 3, 3, 3, 3, '2', '', '', '					\r\nName Azeeem11 khan11Email madni38011@yahoo.comPhone 435345349911Organization dsdsd11', '2017-09-10', '0000-00-00'),
(3, 1, 2, 1, 1, 2, '2017-09-11', '2017-09-12', 1, 0, 3, 3, 3, 3, '3', 'Study notessssss', 'DNQ text area', '					\r\nName Azeeem11 khan11Email madni38011@yahoo.comPhone 435345349911Organization dsdsd11', '0000-00-00', '0000-00-00'),
(4, 1, 3, 1, 1, 2, '2017-09-12', '2017-09-15', 1, 0, 3, 3, 3, 3, '4', 'Study Notes Area', 'DDDNNNQQQQ', '					\r\nName Azeeem11 khan11Email madni38011@yahoo.comPhone 435345349911Organization dsdsd11', '2017-09-12', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `studies_autosave`
--

CREATE TABLE `studies_autosave` (
  `study_id` int(11) NOT NULL,
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
  `client_contact_info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studies_autosave`
--

INSERT INTO `studies_autosave` (`study_id`, `user_id`, `client_id`, `product_name`, `product_type`, `study_type`, `number_of_usergroups`, `start_date`, `end_date`, `study_status`, `focus_vision`, `recruiter`, `lead`, `datalogger`, `av`, `study_number`, `study_notes`, `study_dnq_notes`, `client_contact_info`) VALUES
(3, 1, 0, 1, 1, 1, 0, '0000-00-00', '0000-00-00', 1, 0, 3, 3, 3, 3, '3', '', '', ''),
(4, 3, 0, 1, 1, 1, 0, '0000-00-00', '0000-00-00', 1, 0, 3, 3, 3, 3, '5', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `studies_view`
--
CREATE TABLE `studies_view` (
`study_id` int(11)
,`study_number` varchar(10)
,`client_name` varchar(50)
,`product_name` varchar(50)
,`study_type` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `study_dnq`
--

CREATE TABLE `study_dnq` (
  `study_id` int(11) NOT NULL,
  `dnq_study_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_dnq`
--

INSERT INTO `study_dnq` (`study_id`, `dnq_study_id`) VALUES
(3, 1),
(4, 1),
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `study_dnq_autosave`
--

CREATE TABLE `study_dnq_autosave` (
  `study_id` int(11) NOT NULL,
  `dnq_study_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `study_group_sessions`
--

CREATE TABLE `study_group_sessions` (
  `study_id` int(11) NOT NULL,
  `study_user_group` int(11) NOT NULL,
  `session_order` tinyint(4) NOT NULL,
  `session_time` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_group_sessions`
--

INSERT INTO `study_group_sessions` (`study_id`, `study_user_group`, `session_order`, `session_time`) VALUES
(1, 2617, 1, 45),
(1, 2618, 1, 60),
(1, 2619, 1, 30),
(2, 3916, 1, 45),
(2, 3917, 1, 30),
(2, 3918, 1, 60),
(2, 3919, 1, 75),
(3, 3920, 2, 12),
(3, 3920, 2, 14),
(3, 3921, 3, 16),
(3, 3921, 3, 18),
(3, 3921, 3, 20),
(4, 3922, 2, 12),
(4, 3922, 2, 16),
(4, 3923, 4, 18),
(4, 3923, 4, 20),
(4, 3923, 4, 22),
(4, 3923, 4, 24);

-- --------------------------------------------------------

--
-- Table structure for table `study_group_sessions_autosave`
--

CREATE TABLE `study_group_sessions_autosave` (
  `study_id` int(11) NOT NULL,
  `study_user_group` int(11) NOT NULL,
  `session_order` tinyint(4) NOT NULL,
  `session_time` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `study_locations`
--

CREATE TABLE `study_locations` (
  `study_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_locations`
--

INSERT INTO `study_locations` (`study_id`, `location_id`) VALUES
(1, 2),
(2, 1),
(3, 1),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `study_locations_autosave`
--

CREATE TABLE `study_locations_autosave` (
  `study_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `study_participants`
--

CREATE TABLE `study_participants` (
  `id` int(11) NOT NULL,
  `study_user_group` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `participant_status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_participants`
--

INSERT INTO `study_participants` (`id`, `study_user_group`, `participant_id`, `participant_status`) VALUES
(1, 1, 3, 1),
(2, 2, 4, 1),
(3, 3, 8, 1),
(4, 2554, 1, 1),
(5, 2554, 2, 1),
(6, 2619, 5, 1),
(7, 2556, 5, 1),
(10, 2556, 1, 1),
(11, 2619, 3, 1),
(12, 2554, 5, 1),
(13, 2619, 6, 1),
(15, 3920, 3, 6),
(17, 3921, 4, 7),
(20, 2554, 6, 1),
(21, 3, 12, 1),
(24, 3920, 15, 6),
(25, 3920, 16, 6),
(26, 3922, 17, 7);

-- --------------------------------------------------------

--
-- Table structure for table `study_participant_status`
--

CREATE TABLE `study_participant_status` (
  `id` tinyint(4) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_participant_status`
--

INSERT INTO `study_participant_status` (`id`, `status`) VALUES
(1, 'New'),
(2, 'Approved'),
(3, 'Screened'),
(4, 'Emailed'),
(5, 'LM'),
(6, 'Scheduled'),
(7, 'DNQ');

-- --------------------------------------------------------

--
-- Table structure for table `study_screener_questions`
--

CREATE TABLE `study_screener_questions` (
  `study_user_group` int(11) NOT NULL,
  `screener_question` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_screener_questions`
--

INSERT INTO `study_screener_questions` (`study_user_group`, `screener_question`) VALUES
(3920, 1),
(3920, 11),
(3920, 10),
(3920, 3);

-- --------------------------------------------------------

--
-- Table structure for table `study_status`
--

CREATE TABLE `study_status` (
  `id` tinyint(4) NOT NULL,
  `status_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_status`
--

INSERT INTO `study_status` (`id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Pending'),
(3, 'Close');

-- --------------------------------------------------------

--
-- Table structure for table `study_types`
--

CREATE TABLE `study_types` (
  `id` int(11) NOT NULL,
  `study_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_types`
--

INSERT INTO `study_types` (`id`, `study_type`) VALUES
(1, 'Formative');

-- --------------------------------------------------------

--
-- Table structure for table `study_user_groups`
--

CREATE TABLE `study_user_groups` (
  `id` int(11) NOT NULL,
  `study_id` int(11) NOT NULL,
  `user_group` int(11) NOT NULL,
  `number_of_participants` smallint(6) NOT NULL,
  `payment_amount` decimal(10,0) NOT NULL,
  `training` tinyint(4) NOT NULL,
  `number_of_sessions` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_user_groups`
--

INSERT INTO `study_user_groups` (`id`, `study_id`, `user_group`, `number_of_participants`, `payment_amount`, `training`, `number_of_sessions`) VALUES
(2554, 1, 1, 10, '100', 2, 1),
(2556, 1, 3, 15, '125', 1, 1),
(2619, 1, 2, 6, '50', 1, 1),
(3916, 2, 1, 10, '15', 1, 1),
(3917, 2, 1, 12, '250', 1, 1),
(3918, 2, 1, 25, '250', 1, 1),
(3919, 2, 1, 10, '75', 1, 1),
(3920, 3, 1, 34, '12', 1, 2),
(3921, 3, 2, 6, '13', 2, 3),
(3922, 4, 2, 2, '12', 1, 2),
(3923, 4, 3, 2, '13', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `study_user_groups_autosave`
--

CREATE TABLE `study_user_groups_autosave` (
  `id` int(11) NOT NULL,
  `study_id` int(11) NOT NULL,
  `user_group` int(11) DEFAULT '1',
  `number_of_participants` smallint(6) DEFAULT NULL,
  `payment_amount` decimal(10,0) DEFAULT NULL,
  `training` tinyint(4) DEFAULT NULL,
  `number_of_sessions` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `study_user_groups_autosave`
--

INSERT INTO `study_user_groups_autosave` (`id`, `study_id`, `user_group`, `number_of_participants`, `payment_amount`, `training`, `number_of_sessions`) VALUES
(261, 3, 1, 0, '0', 1, 1),
(603, 4, 1, 0, '0', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transportation_status`
--

CREATE TABLE `transportation_status` (
  `status_id` tinyint(4) NOT NULL,
  `transportation_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
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
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`, `record_status`, `user_role`, `created`, `last_mod`, `active`, `person_id`) VALUES
(3, 'Faisal', 'Ahmad', 'admin', 'failsa@gmail.com', '68eacb97d86f0c4621fa2b0e17cabd8c', 1, 11, '2017-08-09 00:00:00', '0000-00-00 00:00:00', 1, NULL),
(4, 'Faizaneee', 'aee', 'Faizan.aee', 'fazi@gmail.comee', '3066ae72739e663244a565eebc73612d', 1, NULL, '2017-08-23 18:56:39', '0000-00-00 00:00:00', 3, NULL),
(6, 'Rizwan', 'a', 'rizwanaa', 'fazin@gmail.com', 'eaafad502f93575321978b575b1308ce', 1, NULL, '2017-08-23 14:45:30', '2017-08-23 19:16:09', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_assign_role`
--

CREATE TABLE `user_assign_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_assign_role`
--

INSERT INTO `user_assign_role` (`user_id`, `role_id`) VALUES
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 11),
(6, 12),
(6, 13),
(6, 14),
(7, 12),
(7, 13),
(6, 11),
(6, 12),
(6, 13),
(6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`) VALUES
(1, 'RA patients'),
(2, 'Caregivers'),
(3, 'HCP');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL,
  `record_status` tinyint(4) NOT NULL DEFAULT '1',
  `color` varchar(25) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role`, `record_status`, `color`, `description`) VALUES
(11, 'Recruiter', 1, 'red', NULL),
(12, 'Lead', 1, 'green', NULL),
(13, 'datalogger', 1, 'blue', NULL),
(14, 'AV', 1, 'yellow', NULL),
(15, 'Teacheeee123', 3, 'blue', 'eeee123');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_participant_payment`
--
CREATE TABLE `vw_participant_payment` (
`total_payment_amount` decimal(32,0)
,`participant_id` int(11)
,`participant_status` tinyint(4)
,`study_id` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_participant_tracker`
--
CREATE TABLE `vw_participant_tracker` (
`study_group_id` int(11)
,`study_id` int(11)
,`group_name` varchar(50)
,`number_of_participants` smallint(6)
,`payment_amount` decimal(10,0)
,`total_payment` decimal(15,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_participant_tracker_have`
--
CREATE TABLE `vw_participant_tracker_have` (
`study_id` int(11)
,`study_user_group` int(11)
,`group_name` varchar(50)
,`cnt` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_active_users`
--
CREATE TABLE `v_active_users` (
`user_id` int(11)
,`uname` varchar(51)
,`username` varchar(25)
);

-- --------------------------------------------------------

--
-- Structure for view `studies_view`
--
DROP TABLE IF EXISTS `studies_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `studies_view`  AS  select `studies`.`study_id` AS `study_id`,`studies`.`study_number` AS `study_number`,`clients`.`client_name` AS `client_name`,`products`.`product_name` AS `product_name`,`study_types`.`study_type` AS `study_type` from (((`studies` join `clients` on((`studies`.`client_id` = `clients`.`client_id`))) join `products` on((`studies`.`product_name` = `products`.`product_id`))) join `study_types` on((`studies`.`study_type` = `study_types`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_participant_payment`
--
DROP TABLE IF EXISTS `vw_participant_payment`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_participant_payment`  AS  select sum(`sug`.`payment_amount`) AS `total_payment_amount`,`sp`.`participant_id` AS `participant_id`,`sp`.`participant_status` AS `participant_status`,`sug`.`study_id` AS `study_id` from (`study_participants` `sp` join `study_user_groups` `sug` on((`sug`.`id` = `sp`.`study_user_group`))) where (`sp`.`participant_status` = 6) group by `sp`.`participant_id`,`sug`.`study_id` ;

-- --------------------------------------------------------

--
-- Structure for view `vw_participant_tracker`
--
DROP TABLE IF EXISTS `vw_participant_tracker`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_participant_tracker`  AS  select `sug`.`id` AS `study_group_id`,`sug`.`study_id` AS `study_id`,`ug`.`group_name` AS `group_name`,`sug`.`number_of_participants` AS `number_of_participants`,`sug`.`payment_amount` AS `payment_amount`,(`sug`.`payment_amount` * `sug`.`number_of_participants`) AS `total_payment` from ((`study_user_groups` `sug` join `studies` `s` on((`s`.`study_id` = `sug`.`study_id`))) join `user_groups` `ug` on((`sug`.`user_group` = `ug`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vw_participant_tracker_have`
--
DROP TABLE IF EXISTS `vw_participant_tracker_have`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_participant_tracker_have`  AS  select `sug`.`study_id` AS `study_id`,`sp`.`study_user_group` AS `study_user_group`,`ug`.`group_name` AS `group_name`,count(`sp`.`participant_id`) AS `cnt` from ((`study_participants` `sp` join `study_user_groups` `sug` on((`sp`.`study_user_group` = `sug`.`id`))) join `user_groups` `ug` on((`sug`.`user_group` = `ug`.`id`))) group by `sug`.`study_id`,`sp`.`study_user_group` ;

-- --------------------------------------------------------

--
-- Structure for view `v_active_users`
--
DROP TABLE IF EXISTS `v_active_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_active_users`  AS  select `users`.`user_id` AS `user_id`,concat(`users`.`first_name`,' ',`users`.`last_name`) AS `uname`,`users`.`username` AS `username` from `users` where (`users`.`active` = 1) order by concat(`users`.`first_name`,' ',`users`.`last_name`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`audit_id`);

--
-- Indexes for table `classifications`
--
ALTER TABLE `classifications`
  ADD PRIMARY KEY (`classification_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `FK_client_locations` (`default_location`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `contact_status`
--
ALTER TABLE `contact_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `education_status`
--
ALTER TABLE `education_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ethnicities`
--
ALTER TABLE `ethnicities`
  ADD PRIMARY KEY (`ethnicity_id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `FK_locations_ltypes` (`location_type`);

--
-- Indexes for table `location_contacts`
--
ALTER TABLE `location_contacts`
  ADD KEY `FK_locations` (`location_id`),
  ADD KEY `FK_contacts` (`contact_id`);

--
-- Indexes for table `location_types`
--
ALTER TABLE `location_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medical_conditions`
--
ALTER TABLE `medical_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`);

--
-- Indexes for table `participants_autosave`
--
ALTER TABLE `participants_autosave`
  ADD PRIMARY KEY (`participant_autosave_id`);

--
-- Indexes for table `participant_occupations_ug`
--
ALTER TABLE `participant_occupations_ug`
  ADD KEY `FK_participant_occupations_participant` (`participant_id`),
  ADD KEY `FK_participant_occupations_occupation` (`occupation_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `screener_answers`
--
ALTER TABLE `screener_answers`
  ADD KEY `FK_screener_answers_study` (`study_user_group_id`),
  ADD KEY `FK_screener_answers_participant` (`participant_id`),
  ADD KEY `FK_screener_answers_question` (`screener_question`);

--
-- Indexes for table `screener_questions`
--
ALTER TABLE `screener_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UC_Question` (`question`);

--
-- Indexes for table `screener_question_options`
--
ALTER TABLE `screener_question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_screener_question_options_question` (`screener_question`);

--
-- Indexes for table `search_options`
--
ALTER TABLE `search_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studies`
--
ALTER TABLE `studies`
  ADD PRIMARY KEY (`study_id`);

--
-- Indexes for table `studies_autosave`
--
ALTER TABLE `studies_autosave`
  ADD PRIMARY KEY (`study_id`);

--
-- Indexes for table `study_participants`
--
ALTER TABLE `study_participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_study_participants_user_group` (`study_user_group`),
  ADD KEY `FK_study_participants_participant` (`participant_id`),
  ADD KEY `FK_study_participants_participant_status` (`participant_status`);

--
-- Indexes for table `study_participant_status`
--
ALTER TABLE `study_participant_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_status`
--
ALTER TABLE `study_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_types`
--
ALTER TABLE `study_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_user_groups`
--
ALTER TABLE `study_user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_user_groups_autosave`
--
ALTER TABLE `study_user_groups_autosave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transportation_status`
--
ALTER TABLE `transportation_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`,`record_status`),
  ADD KEY `users_userroles` (`user_role`),
  ADD KEY `users_persons` (`person_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `audit_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classifications`
--
ALTER TABLE `classifications`
  MODIFY `classification_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_status`
--
ALTER TABLE `contact_status`
  MODIFY `status_id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `education_status`
--
ALTER TABLE `education_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ethnicities`
--
ALTER TABLE `ethnicities`
  MODIFY `ethnicity_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `location_types`
--
ALTER TABLE `location_types`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medical_conditions`
--
ALTER TABLE `medical_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `participants_autosave`
--
ALTER TABLE `participants_autosave`
  MODIFY `participant_autosave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `screener_questions`
--
ALTER TABLE `screener_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `screener_question_options`
--
ALTER TABLE `screener_question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `search_options`
--
ALTER TABLE `search_options`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `studies`
--
ALTER TABLE `studies`
  MODIFY `study_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `studies_autosave`
--
ALTER TABLE `studies_autosave`
  MODIFY `study_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `study_participants`
--
ALTER TABLE `study_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `study_participant_status`
--
ALTER TABLE `study_participant_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `study_status`
--
ALTER TABLE `study_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `study_types`
--
ALTER TABLE `study_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `study_user_groups`
--
ALTER TABLE `study_user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3924;
--
-- AUTO_INCREMENT for table `study_user_groups_autosave`
--
ALTER TABLE `study_user_groups_autosave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;
--
-- AUTO_INCREMENT for table `transportation_status`
--
ALTER TABLE `transportation_status`
  MODIFY `status_id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `FK_client_locations` FOREIGN KEY (`default_location`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `FK_locations_ltypes` FOREIGN KEY (`location_type`) REFERENCES `location_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `location_contacts`
--
ALTER TABLE `location_contacts`
  ADD CONSTRAINT `FK_contacts` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_locations` FOREIGN KEY (`location_id`) REFERENCES `locations` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participant_occupations_ug`
--
ALTER TABLE `participant_occupations_ug`
  ADD CONSTRAINT `FK_participant_occupations_occupation` FOREIGN KEY (`occupation_id`) REFERENCES `occupations` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_participant_occupations_participant` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`participant_id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_persons` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_userroles` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`role_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
