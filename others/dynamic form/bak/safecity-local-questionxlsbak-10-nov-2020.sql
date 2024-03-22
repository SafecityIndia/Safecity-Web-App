-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 06:32 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safecity`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `is_main` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'used for logical questions',
  `parent_id` int(11) NOT NULL DEFAULT 0 COMMENT 'used for secondary questions',
  `suboption_properties` text DEFAULT NULL,
  `suboption_of` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `question_id`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`) VALUES
(1, 1, 0, 0, NULL, 0),
(2, 1, 0, 0, NULL, 0),
(10, 3, 0, 0, NULL, 0),
(11, 3, 0, 0, NULL, 0),
(12, 3, 0, 0, NULL, 0),
(13, 3, 0, 0, NULL, 0),
(27, 7, 0, 0, NULL, 0),
(28, 8, 0, 0, NULL, 0),
(29, 8, 0, 0, NULL, 0),
(30, 9, 0, 0, NULL, 0),
(31, 9, 0, 0, NULL, 0),
(32, 10, 0, 0, NULL, 0),
(33, 10, 0, 0, NULL, 0),
(34, 10, 0, 0, NULL, 0),
(35, 10, 0, 0, NULL, 0),
(36, 10, 0, 0, NULL, 0),
(38, 11, 0, 0, NULL, 0),
(39, 11, 0, 0, NULL, 0),
(40, 11, 0, 0, NULL, 0),
(41, 11, 0, 0, NULL, 0),
(42, 11, 0, 0, NULL, 0),
(43, 12, 0, 0, NULL, 0),
(44, 12, 0, 0, NULL, 0),
(45, 12, 0, 0, NULL, 0),
(46, 12, 0, 0, NULL, 0),
(47, 12, 0, 0, NULL, 0),
(48, 12, 0, 0, NULL, 0),
(49, 12, 0, 0, NULL, 0),
(50, 12, 0, 0, NULL, 0),
(51, 16, 0, 0, NULL, 0),
(52, 16, 0, 0, NULL, 0),
(53, 16, 0, 0, NULL, 0),
(54, 16, 0, 0, NULL, 0),
(55, 16, 0, 0, NULL, 0),
(56, 16, 0, 0, NULL, 0),
(57, 17, 0, 0, NULL, 0),
(58, 17, 0, 0, NULL, 0),
(59, 18, 0, 0, NULL, 0),
(60, 18, 0, 0, NULL, 0),
(61, 18, 0, 0, NULL, 0),
(62, 18, 0, 0, NULL, 0),
(63, 18, 0, 0, NULL, 0),
(64, 18, 0, 0, NULL, 0),
(65, 19, 0, 0, NULL, 0),
(66, 19, 0, 0, NULL, 0),
(67, 19, 0, 0, NULL, 0),
(68, 19, 0, 0, NULL, 0),
(69, 19, 0, 0, NULL, 0),
(70, 20, 0, 0, NULL, 0),
(71, 20, 0, 0, NULL, 0),
(72, 20, 0, 0, NULL, 0),
(73, 20, 0, 0, NULL, 0),
(74, 20, 0, 0, NULL, 0),
(75, 20, 0, 0, NULL, 0),
(76, 21, 0, 0, NULL, 0),
(77, 21, 0, 0, NULL, 0),
(78, 21, 0, 0, NULL, 0),
(79, 21, 0, 0, NULL, 0),
(80, 21, 0, 0, NULL, 0),
(81, 21, 0, 0, NULL, 0),
(82, 22, 0, 0, NULL, 0),
(83, 22, 0, 0, NULL, 0),
(84, 22, 0, 0, NULL, 0),
(85, 23, 0, 0, NULL, 0),
(86, 23, 0, 0, NULL, 0),
(87, 23, 0, 0, NULL, 0),
(88, 24, 0, 0, NULL, 0),
(89, 24, 0, 0, NULL, 0),
(90, 24, 0, 0, NULL, 0),
(91, 24, 0, 0, NULL, 0),
(92, 25, 0, 0, NULL, 0),
(93, 25, 0, 0, NULL, 0),
(94, 25, 0, 0, NULL, 0),
(95, 25, 0, 0, NULL, 0),
(96, 25, 0, 0, NULL, 0),
(97, 25, 0, 0, NULL, 0),
(98, 25, 0, 0, NULL, 0),
(99, 25, 0, 0, NULL, 0),
(100, 25, 0, 0, NULL, 0),
(101, 26, 0, 0, NULL, 0),
(102, 26, 0, 0, NULL, 0),
(103, 26, 0, 0, NULL, 0),
(104, 26, 0, 0, NULL, 0),
(105, 26, 0, 0, NULL, 0),
(106, 26, 0, 0, NULL, 0),
(107, 26, 0, 0, NULL, 0),
(108, 27, 0, 0, NULL, 0),
(109, 27, 0, 0, NULL, 0),
(110, 27, 0, 0, NULL, 0),
(111, 27, 0, 0, '{\"type\":\"checkbox\"}', 0),
(113, 27, 0, 0, NULL, 0),
(114, 27, 0, 0, '{\"type\":\"checkbox\"}', 0),
(115, 27, 0, 0, NULL, 0),
(116, 27, 0, 0, NULL, 0),
(117, 27, 0, 0, NULL, 0),
(118, 27, 0, 0, NULL, 111),
(119, 27, 0, 0, NULL, 111),
(120, 27, 0, 0, NULL, 114),
(121, 27, 0, 0, NULL, 114),
(122, 27, 0, 0, NULL, 114),
(123, 28, 0, 0, NULL, 0),
(124, 28, 0, 0, NULL, 0),
(125, 28, 0, 0, '{\"type\":\"checkbox\"}', 0),
(126, 28, 0, 0, NULL, 0),
(127, 28, 0, 0, NULL, 0),
(128, 28, 0, 0, NULL, 0),
(129, 28, 0, 0, NULL, 125),
(130, 28, 0, 0, NULL, 125);

-- --------------------------------------------------------

--
-- Table structure for table `option_translation`
--

CREATE TABLE `option_translation` (
  `option_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL DEFAULT 1,
  `title` text NOT NULL,
  `textbox_placeholder` text DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `option_translation`
--

INSERT INTO `option_translation` (`option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) VALUES
(1, 1, 'Myself', NULL, 1),
(2, 1, 'Someone Else', NULL, 1),
(10, 1, 'Male', NULL, 1),
(11, 1, 'Female', NULL, 1),
(12, 1, 'Gender non-binary', NULL, 1),
(13, 1, 'Prefer not to say', NULL, 1),
(28, 1, 'Yes', NULL, 1),
(29, 1, 'No', NULL, 1),
(30, 1, 'Yes', NULL, 1),
(31, 1, 'No', NULL, 1),
(32, 1, 'Intimate Partner', NULL, 1),
(33, 1, 'Ex-Partner', NULL, 1),
(34, 1, 'Blood relative', NULL, 1),
(35, 1, 'In-laws', NULL, 1),
(36, 1, 'I prefer not to say', NULL, 1),
(38, 1, 'Yes I did', NULL, 1),
(39, 1, 'I will, in the future', NULL, 1),
(40, 1, 'I\'m not sure if I want to', NULL, 1),
(41, 1, 'No', NULL, 1),
(42, 1, 'I tried', '{ \"placeholder\": \"Please Specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(43, 1, 'My gender', NULL, 1),
(44, 1, 'My Sexuality / Perceived Sexuality', NULL, 1),
(45, 1, 'My Ethnicity, Religion or Caste', NULL, 1),
(46, 1, 'The harasser wanted to intimidate me', NULL, 1),
(47, 1, 'My relationship status', '{ \"placeholder\": \"Please elaborate\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(48, 1, 'The harasser wanted to sexually assault me', NULL, 1),
(49, 1, 'Don\'t know', NULL, 1),
(51, 1, 'Less than primary school', NULL, 1),
(52, 1, 'Primary school (grade 8)', NULL, 1),
(53, 1, 'Secondary school (grade 12 or 13)', NULL, 1),
(54, 1, 'Associates degree (2 years university)', NULL, 1),
(55, 1, 'Four year university degree', NULL, 1),
(56, 1, 'Advanced/graduate degree', NULL, 1),
(57, 1, 'Yes', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(58, 1, 'No', NULL, 1),
(59, 1, 'Hinduism', NULL, 1),
(60, 1, 'Islam', NULL, 1),
(61, 1, 'Christianity', NULL, 1),
(62, 1, 'Sikhism', NULL, 1),
(63, 1, 'Atheist', NULL, 1),
(64, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(65, 1, 'Scheduled caste', NULL, 1),
(66, 1, 'Scheduled tribe', NULL, 1),
(67, 1, 'Other backward class', NULL, 1),
(68, 1, 'General', NULL, 1),
(69, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(70, 1, 'On my way to or from school/work', NULL, 1),
(71, 1, 'While I was shopping/running errands', NULL, 1),
(72, 1, 'On my way to or from meeting friends or family', NULL, 1),
(73, 1, 'While I was with friends/family in a public space', NULL, 1),
(74, 1, 'While I was traveling to a different city', NULL, 1),
(75, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(76, 1, 'On transportation', 'Please specify the mode of transportation', 1),
(77, 1, 'At a train,metro or bus station', 'Please specify which station', 1),
(78, 1, 'On the street', NULL, 1),
(79, 1, 'In a public space', 'Please specify', 1),
(80, 1, 'In a market', NULL, 1),
(81, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(82, 1, 'I was alone', NULL, 1),
(83, 1, 'I was with friends/colleagues/family', NULL, 1),
(84, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(85, 1, 'One', NULL, 1),
(86, 1, 'Many', '{ \"placeholder\": \"Please Specify how many\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(87, 1, 'Don\'t Know', NULL, 1),
(88, 1, 'Male', NULL, 1),
(89, 1, 'Female', NULL, 1),
(90, 1, 'Gender non-binary or transgender', NULL, 1),
(91, 1, 'Don\'t Know', NULL, 1),
(92, 1, '>14', NULL, 1),
(93, 1, '14-19', NULL, 1),
(94, 1, '20-29', NULL, 1),
(95, 1, '30-39', NULL, 1),
(96, 1, '40-49', NULL, 1),
(97, 1, '50-59', NULL, 1),
(98, 1, '60-69', NULL, 1),
(99, 1, '70+', NULL, 1),
(100, 1, 'Don\'t Know', NULL, 1),
(101, 1, 'Passerby / stranger', NULL, 1),
(102, 1, 'Driver of public transport', NULL, 1),
(103, 1, 'Someone I know', '{ \"placeholder\": \"Please Specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(104, 1, 'Intimate partner / spouse', NULL, 1),
(105, 1, 'A Person in authority', NULL, 1),
(107, 1, 'Don\'t Know', NULL, 1),
(108, 1, 'Ignored it', NULL, 1),
(109, 1, 'I did not know what to do', NULL, 1),
(110, 1, 'I was unable to respond', NULL, 1),
(111, 1, 'I responded to the perpetrator', NULL, 1),
(113, 1, 'I asked for assistance from people nearby', NULL, 1),
(114, 1, 'I called for assistance', NULL, 1),
(115, 1, 'I screamed', NULL, 1),
(116, 1, 'I ran away from the perpetrator', NULL, 1),
(117, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(118, 1, 'Verbally', NULL, 1),
(119, 1, 'Physically', NULL, 1),
(120, 1, 'Police', NULL, 1),
(121, 1, 'Friend', NULL, 1),
(122, 1, 'Family Member', NULL, 1),
(123, 1, 'I told a friend/colleague', NULL, 1),
(124, 1, 'I told a family member', NULL, 1),
(125, 1, 'I reported the attack to', NULL, 1),
(126, 1, 'I was unable to do anything', NULL, 1),
(128, 1, 'Reported the attack on Safecity', NULL, 1),
(127, 1, 'Others', 'Please Specify', 1),
(129, 1, 'Police', NULL, 1),
(130, 1, 'Organisation', NULL, 1),
(50, 1, 'Other', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(106, 1, 'Others', '{ \"placeholder\": \"Please Specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `has_logic_dependency` tinyint(4) NOT NULL DEFAULT 0,
  `is_category` tinyint(4) NOT NULL DEFAULT 0,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `has_logic_dependency`, `is_category`, `tags`) VALUES
(1, 0, 0, 'sharing_for'),
(2, 0, 0, 'age'),
(3, 0, 0, 'gender'),
(4, 0, 0, 'description'),
(5, 0, 0, 'date'),
(6, 0, 0, 'time_from'),
(7, 1, 1, 'incident_categories'),
(8, 0, 0, 'medical_help'),
(9, 0, 0, 'physically_hurt'),
(10, 0, 0, 'who_was_perpetrator'),
(11, 0, 0, 'reported_to_police'),
(12, 0, 0, 'attack_reason'),
(13, 0, 0, 'additional_detail'),
(14, 0, 0, 'incident_address'),
(15, 0, 0, 'incident_lat_lng'),
(16, 0, 0, ''),
(17, 0, 0, ''),
(18, 0, 0, ''),
(19, 0, 0, ''),
(20, 0, 0, ''),
(21, 0, 0, ''),
(22, 0, 0, ''),
(23, 0, 0, ''),
(24, 0, 0, ''),
(25, 1, 0, ''),
(26, 1, 0, ''),
(27, 1, 0, ''),
(28, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `question_translation`
--

CREATE TABLE `question_translation` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL DEFAULT 1,
  `question` text NOT NULL,
  `subtext` text NOT NULL,
  `properties` text NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_translation`
--

INSERT INTO `question_translation` (`id`, `question_id`, `lang_id`, `question`, `subtext`, `properties`, `is_default`) VALUES
(1, 1, 1, 'Who are you sharing for?', 'In case you are reporting for someone else, please\r\nmake sure you answer the questions on their behalf', '{\"type\":\"radio\"}', 1),
(2, 2, 1, 'How old are you?', 'This information will help us understand the incident better.', '{ \"type\":\"text\", \"placeholder\": \"Please enter a number for you age in years. Example 40.\", \"validations\": [ { \"required\": true, \"message\": \"Age is required\" }, { \"type\": \"number\", \"message\": \"Please enter a valid number\" }, { \"min\": 18, \"message\": \"Age cannot be below 18\" }, { \"max\": 120, \"message\": \"Age cannot be greater than 120\" } ] }', 1),
(3, 3, 1, 'Please tell us your gender', 'This information will help us understand the incident better.', '{\"type\":\"radio\"}', 1),
(4, 4, 1, 'Can you tell us what happened?', 'We know this is hard to revisit. But this information will help us understand the incident better.', '{\r\n\"type\":\"text\",\r\n\"placeholder\": \"Please type your experience here\",\r\n\"validations\":\r\n[\r\n{\r\n\"required\": true,\r\n\"message\": \"This field is required\"\r\n},\r\n{\r\n\"pattern\": true,\r\n\"message\": \"Only Alphabets Numbers and Space are allowed\"\r\n}\r\n]\r\n}', 1),
(5, 5, 1, 'Can you tell us when this happened?', '', '{\"type\":\"estimate-datepicker\"}', 1),
(6, 6, 1, 'Can you tell us when this happened?', '', '\r\n{\r\n	\"type\":\"estimate-time-or-rangepicker\",\r\n	\"validations\":\r\n		[\r\n			{\r\n				\"timeorrange\": \"Please select Time OR Time Range.\",\r\n				\"maintime\": \"Please select time to proceed.\",\r\n				\"startendtime\": \"Please select Start Time and End Time to proceed.\",\r\n				\"timediff\": \"End Time should be Greater Than Start Time.\"\r\n			}\r\n		]\r\n}', 1),
(7, 7, 1, 'What type of sexual violence did you experience?', 'This information will help us understand the incident better.', '{\"type\":\"checkbox\"}', 1),
(8, 8, 1, 'Did you seek/receive medical attention?', '', '{\"type\":\"radio\"}', 1),
(9, 9, 1, 'Were you physically hurt?', '', '{\"type\":\"radio\"}', 1),
(10, 10, 1, 'Who was the perpetrator?', '', '{\"type\":\"radio\"}', 1),
(11, 11, 1, 'Have you reported the incident to the police?', '', '{\"type\":\"radio\"}', 1),
(12, 12, 1, 'Do you feel any of the below led to you being attacked?', '(Select all that Apply)', '{\"type\":\"checkbox\"}', 1),
(13, 13, 1, 'Would you like to add anything else about your experience?', '', '{\r\n	\"type\":\"text\",\r\n	\"placeholder\": \"Please type here.\",\r\n	\"validations\": \r\n		[\r\n			{\r\n				\"required\": true,\r\n				\"message\": \"This field is required\"\r\n			},\r\n			{\r\n				\"pattern\": true,\r\n				\"message\": \"Only Alphabets Numbers and Space are allowed\"\r\n			}\r\n		]\r\n}', 1),
(14, 14, 1, 'You\'re doing great. Just one more step to go!<br>Please tell us where the incident took place<span class=\'error\'>*</span>', '', '{\r\n	\"type\":\"incident-address-form\",\r\n	\"validations\": \r\n		[\r\n			{\r\n				\"required\": true,\r\n				\"message\": \"This field is required\"\r\n			}\r\n		]\r\n}', 1),
(15, 15, 1, 'You\'re doing great. Just one more step to go!', 'Please move the pin to the exact location:\r\n', '{\"type\":\"incident-pin-map\"}', 1),
(16, 16, 1, 'What’s the highest level of education you’ve completed?', '', '{\"type\":\"radio\"}', 1),
(17, 17, 1, 'Do you have any kind of disability (mental or physical)?', '', '{\"type\":\"radio\"}', 1),
(18, 18, 1, 'What religion do you follow?', '', '{\"type\":\"radio\"}', 1),
(19, 19, 1, 'What is your Caste/Tribe?', '', '{\"type\":\"radio\"}', 1),
(20, 20, 1, 'What were you doing when the incident took place?', '', '{\"type\":\"radio\"}', 1),
(21, 21, 1, 'Where did the incident take place?', '', '{\"type\":\"radio\"}', 1),
(22, 22, 1, 'Who were you with when the incident took place?', '', '{\"type\":\"radio\"}', 1),
(23, 23, 1, 'How many perpetrators were there?', '', '{\"type\":\"radio\"}', 1),
(24, 24, 1, 'What was the gender of the perpetrator(s) ?', '', '{\"type\":\"radio\"}', 1),
(25, 25, 1, 'How old was the perpetrator (s) approximately? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(26, 26, 1, 'Who was the perpetrator(s) ? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(27, 27, 1, 'How did you respond to the perpetrator(s)? (select all that apply)', '', '{\"type\":\"radio\"}', 1),
(28, 28, 1, 'What did you do after the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(29, 1, 2, 'test', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `option_translation`
--
ALTER TABLE `option_translation`
  ADD KEY `fk_options` (`option_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_translation`
--
ALTER TABLE `question_translation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `question_translation`
--
ALTER TABLE `question_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `option_translation`
--
ALTER TABLE `option_translation`
  ADD CONSTRAINT `fk_options` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
