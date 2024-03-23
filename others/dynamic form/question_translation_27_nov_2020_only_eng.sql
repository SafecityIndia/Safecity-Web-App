-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 10:17 AM
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
(1, 1, 1, 'What type of sexual violence did you experience? (select all that apply)', 'This information will help us understand the incident better.', '{\"type\":\"checkbox\"}', 1),
(2, 2, 1, 'Who are you sharing for?', 'In case you are reporting for someone else, please make sure you answer the questions on their behalf', '{\"type\":\"radio\"}', 1),
(3, 3, 1, 'How old are you?', 'In case you are reporting for someone else, please make sure you answer the questions on their behalf', '{\"type\":\"text\",\"placeholder\": \"Please enter your age in years. Example 40.\",\"validations\":[{\"required\": true,\"message\": \"Age is required\"},{\"type\": \"number\",\"message\": \"Please enter a valid number\"},{\"min\": 18,\"message\": \"Age cannot be below 18\"},{\"max\": 120,\"message\": \"Age cannot be greater than 120\"}]}', 1),
(4, 4, 1, 'Please tell us your gender', '', '{\"type\":\"radio\"}', 1),
(5, 5, 1, 'Can you tell us what happened?', '', '{\"type\":\"text\",\"placeholder\":\"Please type your experience here\",\"validations\":[{\"required\":true,\"message\":\"This field is required\"},{\"pattern\":true,\"message\":\"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(6, 6, 1, 'Can you tell us when this happened?', '', '{\"type\":\"estimate-datepicker\"}', 1),
(7, 7, 1, 'Estimated time this happened?', '', '{\"type\":\"estimate-time-or-rangepicker\",\"validations\":[{\"timediff\": \"Please enter a time range within the same day.\",\"startendtime\": \"Please select Start Time and End Time Both.\"}]}', 1),
(8, 8, 1, ' Have you reported the incident to the police?', '', '{\"type\":\"radio\"}', 1),
(9, 9, 1, 'Do you feel any of the below led to you being attacked? (Select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(10, 10, 1, 'Would you like to add anything else about your experience?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(11, 11, 1, 'What’s the highest level of education you’ve completed?', '', '{\"type\":\"radio\"}', 1),
(12, 12, 1, 'Do you have any kind of disability (mental or physical)?', '', '{\"type\":\"radio\"}', 1),
(13, 13, 1, 'What religion do you follow?', '', '{\"type\":\"radio\"}', 1),
(14, 14, 1, 'What is your Caste/Tribe?', '', '{\"type\":\"radio\"}', 1),
(15, 15, 1, 'What were you doing when the incident took place?', '', '{\"type\":\"radio\"}', 1),
(16, 16, 1, 'Where did the incident take place?', '', '{\"type\":\"radio\"}', 1),
(17, 17, 1, 'Who were you with when the incident took place?', '', '{\"type\":\"radio\"}', 1),
(18, 18, 1, 'How many perpetrators were there?', '', '{\"type\":\"radio\"}', 1),
(19, 19, 1, 'What was the gender of the perpetrator(s) ? (Select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(20, 20, 1, 'How old was the perpetrator (s) approximately? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(21, 21, 1, 'Who was the perpetrator(s) ? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(22, 22, 1, 'How did you respond to the perpetrator(s)? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(23, 23, 1, 'What did you do after the incident? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(24, 24, 1, 'If you reached out to the police, please tell us your experience of reporting.', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(25, 25, 1, 'How did you feel after the incident? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(26, 26, 1, 'How did you change your behaviour after the incident? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(27, 27, 1, 'How did others around you react to what was happening?', '', '{\"type\":\"radio\"}', 1),
(28, 28, 1, 'What do you think can help prevent similar incidents like this in the future?', '', '{\"type\":\"radio\"}', 1),
(29, 29, 1, 'Thank you so much for sharing this information with us. You are helping build safer cities. All the information you provided is anonymous and will continue to be.', '', '{\"type\":\"radio\"}', 1),
(30, 30, 1, 'Would you like to add anything else about the incident ?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(31, 31, 1, ' Who was the perpetrator? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(32, 32, 1, 'How many perpetrators were there?', '', '{\"type\":\"radio\"}', 1),
(33, 33, 1, 'What is the gender of perpetrator(s)? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(34, 34, 1, 'What is the age of the perpetrator(s)? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(35, 35, 1, 'What was the nature of the assault? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(36, 36, 1, 'Has anything like this happened before?', '', '{\"type\":\"radio\"}', 1),
(37, 37, 1, 'What made you report this time?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(38, 38, 1, 'When did it first happen?', '', '{\"type\":\"radio\"}', 1),
(39, 39, 1, 'What usually leads to the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(40, 40, 1, 'Did you require medical assistance after the attack?', '', '{\"type\":\"radio\"}', 1),
(41, 41, 1, 'Did you receive medical assistance?', '', '{\"type\":\"radio\"}', 1),
(42, 42, 1, 'What happened just before you were attacked?', '', '{\"type\":\"radio\"}', 1),
(43, 43, 1, 'What do you think led to the attack? (select all that apply)', '', '{\"type\":\"radio\"}', 1),
(44, 44, 1, 'Who were you with when the attack took place?', '', '{\"type\":\"radio\"}', 1),
(45, 45, 1, 'How did you respond to the perpetrator? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(46, 46, 1, 'What did you do after the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(47, 47, 1, 'If you reached out to the police, please tell us your experience of reporting.', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(48, 48, 1, 'How did you feel after the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(49, 49, 1, 'How did you change your behaviour after the incident? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(50, 50, 1, 'How did others around you react to what was happening?', '', '{\"type\":\"radio\"}', 1),
(51, 51, 1, 'Have you ever been divorced?', '', '{\"type\":\"radio\"}', 1),
(52, 52, 1, 'What is your current relationship status?', '', '{\"type\":\"radio\"}', 1),
(53, 53, 1, 'Do you have any children?', '', '{\"type\":\"radio\"}', 1),
(54, 54, 1, 'Did you want to leave but need support to do so?', '', '{\"type\":\"radio\"}', 1),
(55, 55, 1, 'What kind of support would be or would have been most helpful?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(56, 56, 1, 'Would you like to add anything else about the incident?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(57, 57, 1, 'Thank you so much for sharing this information with us. You are helping build safer cities. All the information you provided is anonymous and will continue to be. How did you hear about Safecity?', '', '{\"type\":\"radio\"}', 1),
(58, 58, 1, ' Do you know who the perpetrator was? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(59, 59, 1, 'How many perpetrators were there?', '', '{\"type\":\"radio\"}', 1),
(60, 60, 1, 'What is the gender of perpetrator(s)? (select all that apply)', '', '{\"type\":\"checkbox\"}\r\n', 1),
(61, 61, 1, 'How old was the perpetrator(s) approximately? (select all that apply)', '', '{\"type\":\"radio\"}', 1),
(62, 62, 1, 'Has anything like this happened before?', '', '{\"type\":\"radio\"}', 1),
(63, 63, 1, 'How frequently has this happened to you?', '', '{\"type\":\"radio\"}', 1),
(64, 64, 1, 'When did it first happen?', '', '{\"type\":\"radio\"}', 1),
(65, 65, 1, 'Where were you attacked?', '', '{\"type\":\"radio\"}', 1),
(66, 66, 1, 'How did others at the scene react to what was happening?', '', '{\"type\":\"radio\"}', 1),
(67, 67, 1, 'How did you respond to the perpetrator? (select all that apply) ', '', '{\"type\":\"checkbox\"}', 1),
(68, 68, 1, 'What did you do after the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(69, 69, 1, ' If you reached out to the police, please tell us your experience of reporting.', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(70, 70, 1, 'How did you feel after the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(71, 71, 1, 'How did you change your behaviour after the incident? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(72, 72, 1, 'What kind of support would be or would have been most helpful?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(73, 73, 1, 'Would you like to add anything else about the incident?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(74, 74, 1, 'Thank you so much for sharing this information with us. You are helping build safer cities. All the information you provided is anonymous and will continue to be. How did you hear about Safecity?', '', '{\"type\":\"radio\"}', 1),
(75, 75, 1, 'What was the nature of the harassment?', '', '{\"type\":\"radio\"}', 1),
(76, 76, 1, 'Who was the perpetrator?', '', '{\"type\":\"radio\"}', 1),
(77, 77, 1, 'What is the gender of perpetrator(s)? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(78, 78, 1, 'What do you assume was the age of the harasser(s) (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(79, 79, 1, 'On what platform did the harassment occur?  (Please select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(80, 80, 1, 'For how long has this been happening?', '', '{\"type\":\"radio\"}', 1),
(81, 81, 1, 'How did you respond to the perpetrator? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(82, 82, 1, 'How did you feel after the attack?', '', '{\"type\":\"radio\"}', 1),
(83, 83, 1, 'What did you do after the attack? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(84, 84, 1, 'Did the harassment stop after reporting to the authorities?', '', '{\"type\":\"radio\"}', 1),
(85, 85, 1, ' If you reached out to the police, please tell us your experience of reporting.', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(86, 86, 1, ' What kind of support would be or would have been most helpful?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(87, 87, 1, 'Would you like to add anything else about the incident?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(88, 88, 1, 'Thank you so much for sharing this information with us. You are helping build safer cities. All the information you provided is anonymous and will continue to be. How did you hear about Safecity?', '', '{\"type\":\"radio\"}', 1),
(89, 89, 1, 'What type of trafficking were you a victim of?', '', '{\"type\":\"radio\"}', 1),
(90, 90, 1, 'What is the relationship between you and the trafficker?', '', '{\"type\":\"radio\"}', 1),
(91, 91, 1, 'The traffickers were', '', '{\"type\":\"radio\"}', 1),
(92, 92, 1, 'How did you and the other victims(if any) get involved in the situation?', '', '{\"type\":\"radio\"}', 1),
(93, 93, 1, 'Were you subjected to any of the below? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(94, 94, 1, 'How did you respond to the trafficker? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(95, 95, 1, 'If you reached out to the police, please tell us your experience of reporting.', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(96, 96, 1, 'How were you able to get out of the situation?', '', '{\"type\":\"radio\"}', 1),
(97, 97, 1, 'How did you feel after the attack you escaped/were rescued? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(98, 98, 1, 'How did you change your behaviour after the incident? (select all that apply)', '', '{\"type\":\"checkbox\"}', 1),
(99, 99, 1, 'Did you seek therapy to help you deal with your experience?', '', '{\"type\":\"radio\"}', 1),
(100, 100, 1, 'Is there any other relevant information about you or the trafficker(s)?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(101, 101, 1, 'What kind of support would be or would have been most helpful?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(102, 102, 1, 'Would you like to add anything else about the incident?', '', '{\"type\":\"text\",\"placeholder\": \"Please type your experience here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1),
(103, 103, 1, 'Thank you so much for sharing this information with us. You are helping build safer cities. All the information you provided is anonymous and will continue to be. How did you hear about Safecity?', '', '{\"type\":\"radio\"}', 1),
(104, 104, 1, 'Did you seek/receive medical attention?', '', '{\"type\":\"radio\"}', 1),
(105, 105, 1, 'Were you physically hurt?', '', '{\"type\":\"radio\"}', 1),
(106, 106, 1, 'Who was the perpetrator?', '', '{\"type\":\"radio\"}', 1),
(107, 107, 1, 'You\'re doing great. Just one more step to go!<br>Please tell us where the incident took place', '', '{\"type\":\"incident-address-form\",\"validations\": [{\"required\": true,\"message\": \"This field is required\"}]}', 1),
(108, 108, 1, 'Who were you with when the attack took place?', '', '{\"type\":\"radio\"}', 1),
(110, 109, 1, 'Were the movements of you and the other victims (if any) being restricted? If yes, Please provide details of any control or influence the Trafficker exerted over your movements.', '', '{\"type\":\"text\",\"placeholder\": \"Please type here\",\"validations\":[{\"required\": true,\"message\": \"This field is required\"},{\"pattern\": true,\"message\": \"Only Alphabets Numbers and Space are allowed\"}]}', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question_translation`
--
ALTER TABLE `question_translation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question_translation`
--
ALTER TABLE `question_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
