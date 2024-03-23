-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 11:59 AM
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
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `type` enum('primary','logic','secondary','') NOT NULL,
  `question_ids_json` longtext NOT NULL,
  `is_submit` tinyint(4) NOT NULL DEFAULT 0,
  `thank_you_web` text DEFAULT NULL,
  `thank_you_mobile` text DEFAULT NULL,
  `name` enum('primary','secondary') NOT NULL DEFAULT 'primary'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `client_id`, `lang_id`, `type`, `question_ids_json`, `is_submit`, `thank_you_web`, `thank_you_mobile`, `name`) VALUES
(1, 1, 1, 'primary', '[{\"question_id\": 1, \"on_option_id\":[]}, {\"question_id\": 2, \"on_option_id\":[]}, {\"question_id\": 3, \"on_option_id\":[]}, {\"question_id\": 4, \"on_option_id\":[]}, {\"question_id\": 5, \"on_option_id\":[]}, {\"question_id\":6, \"on_option_id\":[]}, {\"question_id\":7, \"on_option_id\":[]}]', 0, NULL, NULL, 'primary'),
(2, 1, 1, 'logic', '{  \"dependant_question_id\": 7,  \"answer_type\": \"main\" }', 0, NULL, NULL, 'primary'),
(3, 1, 1, 'primary', '[{\"question_id\": 11, \"on_option_id\":[]}, {\"question_id\": 12, \"on_option_id\":[]}, {\"question_id\": 13, \"on_option_id\":[]},{\"question_id\":14, \"on_option_id\":[]}]', 1, '{\r\n	\"title\": \"Thank you for submitting your report!\",\r\n	\"content\": \"<p>By sharing your experience with us, you are helping prevent 3 others from experiencing something similar.</p><p>If you have 5-10 minutes, we would like to know more about the incident to understand other factors that play a role in sexual violence. By answering a few questions, you will help us build safer cities.</p>\",\r\n	\"links\": [\r\n		{\r\n			\"title\": \"YES, I WANT TO HELP\",\r\n			\"is_next\": true\r\n		},\r\n		{\r\n			\"title\": \"NO, I WOULD LIKE TO EXIT\",\r\n			\"is_next\": false,\r\n			\"redirect_url\": \"/help_pf\"\r\n		}\r\n	]\r\n}', NULL, 'primary'),
(4, 1, 1, 'primary', '[{\"question_id\": 16, \"on_option_id\":[]},{\"question_id\": 17, \"on_option_id\":[]},{\"question_id\": 18, \"on_option_id\":[]},{\"question_id\": 19, \"on_option_id\":[]}]', 0, NULL, NULL, 'secondary'),
(5, 1, 1, 'logic', '{  \"dependant_question_id\": 7,  \"answer_type\": \"parent\" }', 1, '{\r\n	\"title\": \"\",\r\n	\"content\": \"<p>Thank you for sharing more about your experince with us</p>\",\r\n	\"links\": [\r\n		{\r\n			\"title\": \"FINISH\",\r\n			\"is_next\": false,\r\n			\"redirect_url\": \"/help_pf\"\r\n		}\r\n	]\r\n}', NULL, 'secondary');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
