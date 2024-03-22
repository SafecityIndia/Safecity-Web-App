-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 12:36 PM
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
-- Table structure for table `logic_combinations`
--

CREATE TABLE `logic_combinations` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `ans_ids` varchar(255) NOT NULL,
  `comb_json` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logic_combinations`
--

INSERT INTO `logic_combinations` (`id`, `form_id`, `question_id`, `ans_ids`, `comb_json`) VALUES
(1, 2, 7, '1', '[{\"question_id\": 8, \"on_option_id\":[]}]'),
(2, 2, 7, '2', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[]}]}]'),
(3, 2, 7, '3', '[{\"question_id\": 10, \"on_option_id\":[]}]'),
(4, 2, 7, '4', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[]}]}]'),
(5, 2, 7, '1,2', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[]}]}]'),
(6, 2, 7, '1,3', '[{\"question_id\": 8, \"on_option_id\":[]}, {\"question_id\":10, \"on_option_id\": []}]'),
(7, 2, 7, '1,4', '[{\"question_id\": 8, \"on_option_id\":[]}]'),
(8, 2, 7, '2,3', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[{\"id\":28, \"question_id\":10, \"on_option_id\":[]},{\"id\":29, \"question_id\":10, \"on_option_id\":[]}]},{\"id\": 31, \"question_id\":10, \"on_option_id\":[]}]}]'),
(9, 2, 7, '2,4', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[]}]}]'),
(10, 2, 7, '3,4', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[{\"id\":28, \"question_id\":10, \"on_option_id\":[]},{\"id\":29, \"question_id\":10, \"on_option_id\":[]}]},{\"id\": 31, \"question_id\":10, \"on_option_id\":[]}]}]'),
(11, 2, 7, '1,2,3', '[{\"question_id\": 8, \"on_option_id\":[]}, {\"question_id\": 10, \"on_option_id\":[]}]'),
(12, 2, 7, '1,2,4', '[{\"question_id\": 8, \"on_option_id\":[]}]'),
(13, 2, 7, '1,3,4', '[{\"question_id\": 8, \"on_option_id\":[]}, {\"question_id\": 10, \"on_option_id\":[]}]'),
(14, 2, 7, '2,3,17', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[{\"id\":28, \"question_id\":10, \"on_option_id\":[]},{\"id\":29, \"question_id\":10, \"on_option_id\":[]}]},{\"id\": 31, \"question_id\":10, \"on_option_id\":[]}]}]'),
(15, 2, 7, '1,2,3,4', '[{\"question_id\": 8, \"on_option_id\":[]}, {\"question_id\": 10, \"on_option_id\":[]}]'),
(16, 5, 7, '4', '[{\"question_id\": 20, \"on_option_id\":[]}, {\"question_id\": 21, \"on_option_id\":[]}, {\"question_id\": 22, \"on_option_id\":[]}, {\"question_id\": 23, \"on_option_id\":[]}, {\"question_id\": 24, \"on_option_id\":[]}, {\"question_id\": 25, \"on_option_id\":[]}, {\"question_id\": 26, \"on_option_id\":[]}, {\"question_id\": 27, \"on_option_id\":[]}, {\"question_id\": 28, \"on_option_id\":[]}]'),
(17, 5, 7, '1', '[]'),
(18, 5, 7, '3', '[]'),
(19, 5, 7, '13', '[]'),
(20, 5, 7, '12', '[]'),
(21, 2, 7, '2,3,4', '[{\"question_id\": 9, \"on_option_id\":[{\"id\": 30, \"question_id\":8, \"on_option_id\":[{\"id\":28, \"question_id\":10, \"on_option_id\":[]},{\"id\":29, \"question_id\":10, \"on_option_id\":[]}]},{\"id\": 31, \"question_id\":10, \"on_option_id\":[]}]}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logic_combinations`
--
ALTER TABLE `logic_combinations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logic_combinations`
--
ALTER TABLE `logic_combinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
