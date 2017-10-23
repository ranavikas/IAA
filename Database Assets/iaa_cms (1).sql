-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2017 at 01:04 PM
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
(2, 'aazaz');

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

-- --------------------------------------------------------

--
-- Table structure for table `client_contacts`
--

CREATE TABLE `client_contacts` (
  `client_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'Azeeem11', 'khan11', 'Azooo11', 'madni38011@yahoo.com', 'fg11@gmail.com', '435345349911', '123', '43242342399311', '456', 'dsdsd11');

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
(13, 'test2', NULL),
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
(1, 'Male', 'm');

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
(61, 'School Nurse');

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
  `decreased` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `decreased` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `participant_classifications_autosave`
--

CREATE TABLE `participant_classifications_autosave` (
  `participant_id` int(11) NOT NULL,
  `classification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `participant_classifications_ug`
--

CREATE TABLE `participant_classifications_ug` (
  `participant_id` int(11) NOT NULL,
  `classification_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(4, 'Electronics');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` tinyint(4) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'Computers');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `study_types`
--
ALTER TABLE `study_types`
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
  MODIFY `classification_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `gender_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location_types`
--
ALTER TABLE `location_types`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `medical_conditions`
--
ALTER TABLE `medical_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `participants_autosave`
--
ALTER TABLE `participants_autosave`
  MODIFY `participant_autosave_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `study_types`
--
ALTER TABLE `study_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transportation_status`
--
ALTER TABLE `transportation_status`
  MODIFY `status_id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
