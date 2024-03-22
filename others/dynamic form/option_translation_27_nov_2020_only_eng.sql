-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 10:18 AM
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
(4, 1, 'Male', NULL, 1),
(5, 1, 'Female', NULL, 1),
(6, 1, 'Gender non-binary', NULL, 1),
(7, 1, 'Prefer not to say', NULL, 1),
(8, 1, 'Yes I did', NULL, 1),
(9, 1, 'I will, in the future', NULL, 1),
(10, 1, 'I’m not sure if I want to', NULL, 1),
(11, 1, 'No', NULL, 1),
(12, 1, 'I tried', 'Can you please tell us what happened when you tried?', 1),
(13, 1, 'My gender', NULL, 1),
(14, 1, 'my sexuality / perceived sexuality', NULL, 1),
(15, 1, 'my ethnicity, religion or caste', NULL, 1),
(16, 1, 'Because the harasser wanted to intimidate me', NULL, 1),
(17, 1, 'Because of my relationship status', 'Please elaborate', 1),
(18, 1, 'Because the harasser wanted to sexually assault me', NULL, 1),
(19, 1, 'Don’t know', NULL, 1),
(20, 1, 'Other', 'Please specify', 1),
(21, 1, 'Less than primary school', NULL, 1),
(22, 1, 'Primary school (grade 8)', NULL, 1),
(23, 1, 'Secondary school (grade 12 or 13)', NULL, 1),
(24, 1, 'Associates degree (2 years university)', NULL, 1),
(25, 1, 'Four year university degree', NULL, 1),
(26, 1, 'Advanced/graduate degree', NULL, 1),
(27, 1, 'Yes', 'please specify', 1),
(28, 1, 'No', NULL, 1),
(29, 1, 'Hinduism', NULL, 1),
(30, 1, 'Islam', NULL, 1),
(31, 1, 'Christianity', NULL, 1),
(32, 1, 'Sikhism', NULL, 1),
(33, 1, 'Atheist', NULL, 1),
(34, 1, 'Other', 'please specify', 1),
(35, 1, 'Scheduled caste', NULL, 1),
(36, 1, 'Scheduled tribe', NULL, 1),
(37, 1, 'Other backward class', NULL, 1),
(38, 1, 'General', NULL, 1),
(39, 1, 'Other', 'please specify', 1),
(40, 1, 'On my way to or from school/work', NULL, 1),
(41, 1, 'While I was shopping/running errands', NULL, 1),
(42, 1, 'On my way to or from meeting friends or family', NULL, 1),
(43, 1, 'While I was with friends/family in a public space', NULL, 1),
(44, 1, 'While I was traveling to a different city', NULL, 1),
(45, 1, 'Other', 'Please specify', 1),
(46, 1, 'On transportation', '{ \"placeholder\": \"Please specify the mode of transportation\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(47, 1, 'At a train, metro or bus station', '{ \"placeholder\": \"Please specify which station\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(48, 1, 'On the street', NULL, 1),
(49, 1, 'In a public space', '{ \"placeholder\": \"Please specify\", \"validations\": [ { \"required\": true, \"message\": \"This field is required\" }, { \"pattern\": true, \"message\": \"Only Alphabets Numbers and Space are allowed\" } ] }', 1),
(50, 1, 'In a market', NULL, 1),
(51, 1, 'Other', 'Please specify', 1),
(52, 1, 'I was alone', NULL, 1),
(53, 1, 'I was with friends/colleagues/family', NULL, 1),
(54, 1, 'Other', 'Please specify', 1),
(55, 1, 'One', NULL, 1),
(56, 1, 'Many', 'Please specify how many', 1),
(57, 1, 'Don’t know', NULL, 1),
(58, 1, 'Male', NULL, 1),
(59, 1, 'Female', NULL, 1),
(60, 1, 'Gender non-binary or transgender', NULL, 1),
(61, 1, 'Don’t Know', NULL, 1),
(62, 1, '>14', NULL, 1),
(63, 1, '14-19', NULL, 1),
(64, 1, '20-29', NULL, 1),
(65, 1, '30-39', NULL, 1),
(66, 1, '40-49', NULL, 1),
(67, 1, '50-59', NULL, 1),
(68, 1, '60-69', NULL, 1),
(69, 1, '70+', NULL, 1),
(70, 1, 'Don’t know', NULL, 1),
(71, 1, 'Passerby / stranger', NULL, 1),
(72, 1, 'Driver of public transport', NULL, 1),
(73, 1, 'Someone I know', 'Please specify', 1),
(74, 1, 'Intimate partner / spouse', NULL, 1),
(75, 1, 'A Person in authority', NULL, 1),
(76, 1, 'Others', 'Please specify', 1),
(77, 1, 'Don’t know', NULL, 1),
(78, 1, 'Ignored it', NULL, 1),
(79, 1, 'I did not know what to do', NULL, 1),
(80, 1, 'I was unable to respond', NULL, 1),
(81, 1, 'I responded to the perpetrator verbally', NULL, 1),
(82, 1, 'I responded to the perpetrator physically', NULL, 1),
(83, 1, 'I asked for assistance from people nearby', NULL, 1),
(84, 1, 'I called for assistance', NULL, 1),
(85, 1, 'I screamed', NULL, 1),
(86, 1, 'I ran away from the perpetrator', NULL, 1),
(87, 1, 'Other', 'Please specify', 1),
(93, 1, 'I told a friend/colleague', NULL, 1),
(94, 1, 'I told a family member', NULL, 1),
(95, 1, 'I reported the incident to the police', NULL, 1),
(96, 1, 'I reported the incident to my organisation', NULL, 1),
(97, 1, 'I was unable to do anything', NULL, 1),
(98, 1, 'Reported on Safecity', NULL, 1),
(99, 1, 'Others', 'Please specify', 1),
(100, 1, 'Scared', NULL, 1),
(101, 1, 'Angry', NULL, 1),
(102, 1, 'Ashamed/Embarrassed', NULL, 1),
(103, 1, 'Strong/Confident', NULL, 1),
(104, 1, 'Violated/Disgusted', NULL, 1),
(105, 1, 'Regretful that I didn\'t respond to the perpetrator', NULL, 1),
(106, 1, 'Regretful that I didn\'t report to the police', NULL, 1),
(107, 1, 'Confused', NULL, 1),
(108, 1, 'I felt it was my fault because of the way people I told reacted', NULL, 1),
(109, 1, 'Lost faith and ability to trust people', NULL, 1),
(110, 1, 'Anxious ', NULL, 1),
(111, 1, 'Depressed', NULL, 1),
(112, 1, 'Wished I didn\'t exist', NULL, 1),
(113, 1, 'The same as I had before the incident', NULL, 1),
(114, 1, 'Other', 'Please specify', 1),
(115, 1, 'I avoided places', 'Which spaces did you avoid?', 1),
(116, 1, 'I started learning self defence or carrying items for self-defense', NULL, 1),
(117, 1, 'I changed how I travel', NULL, 1),
(118, 1, ' the route I walk', NULL, 1),
(119, 1, 'my travel timings', NULL, 1),
(120, 1, 'avoided traveling after dark', NULL, 1),
(121, 1, 'avoided traveling alone', NULL, 1),
(122, 1, 'I stopped going to school or workplace', NULL, 1),
(123, 1, 'I changed my school or workplace', NULL, 1),
(124, 1, 'I did not change my behaviour', NULL, 1),
(125, 1, 'Other', 'Please specify', 1),
(126, 1, 'They did not notice', NULL, 1),
(127, 1, 'They noticed, but did nothing', NULL, 1),
(128, 1, 'A man/men confronted the perpetrator(s)', NULL, 1),
(129, 1, 'A woman/women confronted the perpetrator(s)', NULL, 1),
(130, 1, 'A man/men called the police', NULL, 1),
(131, 1, 'A woman/women called the police', NULL, 1),
(132, 1, 'No one else was around', NULL, 1),
(133, 1, 'Other', 'Please specify', 1),
(134, 1, 'Better Law enforcement', NULL, 1),
(135, 1, 'Stricter laws with harsher punishments', NULL, 1),
(136, 1, 'More police on the streets', NULL, 1),
(137, 1, 'Better education', NULL, 1),
(138, 1, 'Educate men about women\'s rights and gender equality', NULL, 1),
(139, 1, 'Educate women about their rights', NULL, 1),
(140, 1, 'Increase awareness of gender roles and expectations', NULL, 1),
(141, 1, ' Sex Education', NULL, 1),
(142, 1, 'Educate women about how to avoid harassment/ Self Defense education', NULL, 1),
(143, 1, 'Improving infrastructure', 'Please elaborate', 1),
(144, 1, 'Creating a gender equal society', NULL, 1),
(145, 1, 'Censor sexually explicit or violent content from film, TV, and other media', NULL, 1),
(146, 1, 'More job opportunities for men/youth', NULL, 1),
(147, 1, 'More sex-segregated public transportation', NULL, 1),
(148, 1, 'Other', ' Please specify', 1),
(149, 1, 'Facebook/Twitter', NULL, 1),
(150, 1, 'Email', NULL, 1),
(151, 1, 'In-person from acquaintance', NULL, 1),
(152, 1, 'From a Safecity workshop', NULL, 1),
(153, 1, 'I am a volunteer for Safecity filling out for a participant', NULL, 1),
(154, 1, 'Other', 'Please specify', 1),
(155, 1, 'Intimate Partner ', NULL, 1),
(156, 1, 'Ex-Partner', NULL, 1),
(157, 1, 'Blood Relative', NULL, 1),
(158, 1, 'In-Laws', NULL, 1),
(159, 1, 'One', NULL, 1),
(160, 1, 'Many', NULL, 1),
(161, 1, 'Don’t know', NULL, 1),
(162, 1, 'Male', NULL, 1),
(163, 1, 'Female', NULL, 1),
(164, 1, 'Gender non-binary or transgender', NULL, 1),
(165, 1, 'Don’t Know', NULL, 1),
(166, 1, '>14', NULL, 1),
(167, 1, '14-19', NULL, 1),
(168, 1, '20-29', NULL, 1),
(169, 1, '30-39', NULL, 1),
(170, 1, '40-49', NULL, 1),
(171, 1, '50-59', NULL, 1),
(172, 1, '60-69', NULL, 1),
(173, 1, '70+', NULL, 1),
(174, 1, 'Don’t know', NULL, 1),
(175, 1, 'Physical abuse', NULL, 1),
(176, 1, 'Sexual abuse, including but not limited to, rape', NULL, 1),
(177, 1, 'Stalking or tracking your whereabouts', NULL, 1),
(178, 1, 'Verbal Abuse', NULL, 1),
(179, 1, 'blackmail, humiliation in presence of others', NULL, 1),
(180, 1, 'threatening words/messages/letters', NULL, 1),
(181, 1, 'Mental or Emotional Abuse', NULL, 1),
(182, 1, 'Imposing restrictions', NULL, 1),
(183, 1, 'on movement/on leaving the house', NULL, 1),
(184, 1, 'Limiting food / water/ other necessities', NULL, 1),
(185, 1, 'Limiting/withholding financial resources', NULL, 1),
(186, 1, 'Locking in a room/isolating', NULL, 1),
(187, 1, 'Other', 'Please specify', 1),
(188, 1, 'Yes, once ', NULL, 1),
(189, 1, 'Yes, a few times', NULL, 1),
(190, 1, 'Yes, many times', NULL, 1),
(191, 1, 'No', NULL, 1),
(192, 1, 'This month', NULL, 1),
(193, 1, 'This year', NULL, 1),
(194, 1, 'Last year', NULL, 1),
(195, 1, 'Other', 'Please specify the year it started', 1),
(196, 1, 'It happens without reason', NULL, 1),
(197, 1, 'When he/she/they get angry with me', NULL, 1),
(198, 1, 'When he/she/they are under the influence of alcohol/drugs', NULL, 1),
(199, 1, 'When I refuse to do something they ask me to', NULL, 1),
(200, 1, 'Others', 'Please specify', 1),
(201, 1, 'Yes', NULL, 1),
(202, 1, 'No', NULL, 1),
(203, 1, 'Yes', NULL, 1),
(204, 1, 'No', NULL, 1),
(205, 1, 'Sometimes', NULL, 1),
(206, 1, 'He/she/they got angry with me', NULL, 1),
(207, 1, 'Nothing in particular', NULL, 1),
(208, 1, 'He/she/they were under the influence of alcohol/drugs', NULL, 1),
(209, 1, 'I refused to do something they asked me to', NULL, 1),
(210, 1, 'Others', 'Please specify', 1),
(211, 1, 'They wanted a dowry/ more dowry', NULL, 1),
(212, 1, 'They don’t want me to work', NULL, 1),
(213, 1, 'Because of my gender', NULL, 1),
(214, 1, 'Because of my identity', NULL, 1),
(215, 1, 'caste', NULL, 1),
(216, 1, 'religion', NULL, 1),
(217, 1, 'ethnicity/race', NULL, 1),
(218, 1, 'Because of my disability', NULL, 1),
(219, 1, 'Because of my age', NULL, 1),
(220, 1, 'Because I am widowed', NULL, 1),
(221, 1, 'Because of a past relationship/ thought I was having an affair', NULL, 1),
(222, 1, 'Because of my relationship status  ', 'Please elaborate', 1),
(223, 1, 'Because of my sexual identity', NULL, 1),
(224, 1, 'lesbian', NULL, 1),
(225, 1, 'gay', NULL, 1),
(226, 1, ' bisexual', NULL, 1),
(227, 1, 'trans or queer person', NULL, 1),
(228, 1, 'prefer not to say', NULL, 1),
(229, 1, 'Because of my occupation', 'Please specify', 1),
(230, 1, 'Because the perpetrator wanted to sexually assault me', NULL, 1),
(231, 1, 'No specific reason', NULL, 1),
(232, 1, 'Other', ' Please specify', 1),
(233, 1, 'I was alone', NULL, 1),
(234, 1, 'With members of the family', NULL, 1),
(235, 1, 'With friends/acquaintances', NULL, 1),
(236, 1, 'Ignored it', NULL, 1),
(237, 1, 'Froze', NULL, 1),
(238, 1, 'I did not know what to do', NULL, 1),
(239, 1, 'I responded to the perpetrator', NULL, 1),
(240, 1, 'Verbally', NULL, 1),
(241, 1, 'Physically', NULL, 1),
(242, 1, 'I asked for assistance from people around me', NULL, 1),
(243, 1, 'I called for assistance', NULL, 1),
(244, 1, 'police', NULL, 1),
(245, 1, 'friend', NULL, 1),
(246, 1, 'family member', NULL, 1),
(247, 1, 'I screamed', NULL, 1),
(248, 1, 'I ran away from the perpetrator', NULL, 1),
(249, 1, 'Other ', 'Please specify', 1),
(250, 1, 'I told a friend/colleague', NULL, 1),
(251, 1, 'I told a family member', NULL, 1),
(252, 1, 'I reported the attack to', NULL, 1),
(253, 1, 'police', NULL, 1),
(254, 1, 'organisation', NULL, 1),
(255, 1, 'I was unable to do anything', NULL, 1),
(256, 1, 'Others', 'Please specify', 1),
(257, 1, 'Reported the attack on Safecity ', NULL, 1),
(258, 1, 'Scared', NULL, 1),
(259, 1, 'Angry', NULL, 1),
(260, 1, 'Ashamed/Embarrassed', NULL, 1),
(261, 1, 'Strong/Confident', NULL, 1),
(262, 1, 'Violated/Disgusted', NULL, 1),
(263, 1, 'Regretful that I didn\'t respond to the perpetrator', NULL, 1),
(264, 1, 'Regretful that I didn\'t report to the police', NULL, 1),
(265, 1, 'Confused', NULL, 1),
(266, 1, 'I felt it was my fault because of the way people I told reacted', NULL, 1),
(267, 1, 'Lost faith and ability to trust people', NULL, 1),
(268, 1, 'Anxious ', NULL, 1),
(269, 1, 'Depressed', NULL, 1),
(270, 1, 'Wished I didn\'t exist', NULL, 1),
(271, 1, 'The same as I had before the attack ', NULL, 1),
(272, 1, 'Other', 'Please specify', 1),
(273, 1, 'I changed the amount of time I spent at home', NULL, 1),
(274, 1, 'started spending more time out of the house', NULL, 1),
(275, 1, 'avoided going out of the house', NULL, 1),
(276, 1, 'I changed my behaviour towards the perpetrator', NULL, 1),
(277, 1, 'started having more arguments/fights', NULL, 1),
(278, 1, 'avoided arguing with the perpetrator', NULL, 1),
(279, 1, 'stopped/reduced talking in the house', NULL, 1),
(280, 1, 'I started learning self defence or carrying items for self-defense', NULL, 1),
(281, 1, 'Kept items for self defence within close reach', NULL, 1),
(282, 1, 'Can’t change my behaviour', NULL, 1),
(283, 1, 'I did not change my behaviour', NULL, 1),
(284, 1, 'Other', 'Please specify', 1),
(285, 1, 'They did not notice', NULL, 1),
(286, 1, 'They noticed, but did nothing', NULL, 1),
(287, 1, 'Someone confronted the perpetrator(s)', NULL, 1),
(288, 1, 'Man (or men)', NULL, 1),
(289, 1, 'Woman (or women)', NULL, 1),
(290, 1, 'Someone called the police', NULL, 1),
(291, 1, ' Man (or men)', NULL, 1),
(292, 1, 'Woman (or women)', NULL, 1),
(293, 1, 'No one else was around', NULL, 1),
(294, 1, 'Other', 'Please specify', 1),
(295, 1, 'Yes', NULL, 1),
(296, 1, 'No', NULL, 1),
(297, 1, 'I’m in the process of getting a divorce', NULL, 1),
(298, 1, 'I’m considering getting a divorce', NULL, 1),
(299, 1, 'I’m married', NULL, 1),
(300, 1, 'I’m in a civil union/live-in relationship', NULL, 1),
(301, 1, 'I’m in a relationship, but not living with partner', NULL, 1),
(302, 1, 'I’m separated', NULL, 1),
(303, 1, 'I’m divorced', NULL, 1),
(304, 1, 'I’m in process of getting a divorce', NULL, 1),
(305, 1, 'I’m single', NULL, 1),
(306, 1, 'I’m widowed', NULL, 1),
(307, 1, 'Yes', NULL, 1),
(308, 1, 'No', NULL, 1),
(309, 1, 'Yes', NULL, 1),
(310, 1, 'No', NULL, 1),
(311, 1, 'Facebook/Twitter', NULL, 1),
(312, 1, 'Email', NULL, 1),
(313, 1, 'In-person from acquaintance', NULL, 1),
(314, 1, 'From a Safecity workshop', NULL, 1),
(315, 1, 'I am a volunteer for Safecity filling out for a participant', NULL, 1),
(316, 1, 'Other', 'please specify', 1),
(317, 1, 'A stranger', NULL, 1),
(318, 1, 'Someone I know', NULL, 1),
(319, 1, 'acquaintance', NULL, 1),
(320, 1, 'friend', NULL, 1),
(321, 1, 'colleague', NULL, 1),
(322, 1, 'family member', NULL, 1),
(323, 1, 'ex-partner', NULL, 1),
(324, 1, 'My intimate partner / spouse', NULL, 1),
(325, 1, 'A person in authority', NULL, 1),
(326, 1, 'I don’t know', NULL, 1),
(327, 1, 'One', NULL, 1),
(328, 1, 'Many', 'Please specify', 1),
(329, 1, 'Don’t know', NULL, 1),
(330, 1, 'Male', NULL, 1),
(331, 1, 'Female', NULL, 1),
(332, 1, 'Gender non-binary or transgender', NULL, 1),
(333, 1, 'Don’t Know', NULL, 1),
(334, 1, '<14', NULL, 1),
(335, 1, '14-19', NULL, 1),
(336, 1, '20-29', NULL, 1),
(337, 1, '30-39', NULL, 1),
(338, 1, '40-49', NULL, 1),
(339, 1, '50-59', NULL, 1),
(340, 1, '60-69', NULL, 1),
(341, 1, '70+', NULL, 1),
(342, 1, 'Don’t know', NULL, 1),
(343, 1, 'Yes, once before this time', NULL, 1),
(344, 1, 'Yes, more than once', NULL, 1),
(345, 1, 'No', NULL, 1),
(346, 1, 'Very often', NULL, 1),
(347, 1, 'Sometimes', NULL, 1),
(348, 1, 'Rarely', NULL, 1),
(349, 1, 'This month', NULL, 1),
(350, 1, 'This year', NULL, 1),
(351, 1, 'Last year', NULL, 1),
(352, 1, 'Other', 'Please specify year when it first started', 1),
(353, 1, 'On transportation ', 'Please specify mode of transportation', 1),
(354, 1, 'In a public space', 'Please specify', 1),
(355, 1, 'At a social gathering', NULL, 1),
(356, 1, 'At work', NULL, 1),
(357, 1, 'In my house', NULL, 1),
(358, 1, 'At the house of someone I know', NULL, 1),
(359, 1, 'friend’s house', NULL, 1),
(360, 1, 'family member’s house', NULL, 1),
(361, 1, 'Other', 'Please specify', 1),
(362, 1, 'They did not notice', NULL, 1),
(363, 1, 'They noticed, but did nothing', NULL, 1),
(364, 1, 'Someone confronted the perpetrator(s) ', NULL, 1),
(365, 1, 'Man (or men)', NULL, 1),
(366, 1, ' Woman (or women)', NULL, 1),
(367, 1, 'Someone called the police', NULL, 1),
(368, 1, 'Man (or men)', NULL, 1),
(369, 1, 'Woman (or women)', NULL, 1),
(370, 1, 'No one else was around', NULL, 1),
(371, 1, 'Other', ' Please specify', 1),
(372, 1, 'Ignored it', NULL, 1),
(373, 1, 'I did not know what to do', NULL, 1),
(374, 1, 'I was unable to respond', NULL, 1),
(375, 1, 'I responded to the perpetrator', NULL, 1),
(376, 1, 'Verbally', NULL, 1),
(377, 1, 'Physically', NULL, 1),
(378, 1, 'I asked for assistance', NULL, 1),
(379, 1, 'from people nearby who saw the attack', NULL, 1),
(380, 1, 'from people nearby who did not see the attack', NULL, 1),
(381, 1, 'I called for assistance', NULL, 1),
(382, 1, 'police', NULL, 1),
(383, 1, 'friend', NULL, 1),
(384, 1, 'family member', NULL, 1),
(385, 1, 'I screamed', NULL, 1),
(386, 1, 'I ran away from the perpetrator', NULL, 1),
(387, 1, 'Other', 'Please specify', 1),
(388, 1, 'I told a friend/colleague', NULL, 1),
(389, 1, 'I told a family member', NULL, 1),
(390, 1, 'I reported the attack to ', NULL, 1),
(391, 1, 'police', NULL, 1),
(392, 1, 'organisation', NULL, 1),
(393, 1, 'I was unable to do anything', NULL, 1),
(394, 1, 'Reported on Safecity', NULL, 1),
(395, 1, 'Others', 'Please specify', 1),
(396, 1, 'Scared', NULL, 1),
(397, 1, 'Angry', NULL, 1),
(398, 1, 'Ashamed/Embarrassed', NULL, 1),
(399, 1, 'Strong/Confident', NULL, 1),
(400, 1, 'Violated/Disgusted', NULL, 1),
(401, 1, 'Regretful that I didn\'t respond to the perpetrator', NULL, 1),
(402, 1, 'Regretful that I didn\'t report to the police', NULL, 1),
(403, 1, 'Confused', NULL, 1),
(404, 1, 'I felt it was my fault because of the way people I told reacted', NULL, 1),
(405, 1, 'Lost faith and ability to trust people', NULL, 1),
(406, 1, 'Anxious ', NULL, 1),
(407, 1, 'Depressed', NULL, 1),
(408, 1, 'Wished I didn\'t exist', NULL, 1),
(409, 1, 'The same as I had before the attack ', NULL, 1),
(410, 1, 'Other', 'Please specify', 1),
(411, 1, 'I avoided places', 'Which spaces did you avoid?', 1),
(412, 1, 'I started learning self defence or carrying items for self-defense', NULL, 1),
(413, 1, 'I changed how I travel', NULL, 1),
(414, 1, 'the route I walk', NULL, 1),
(415, 1, 'my travel timings', NULL, 1),
(416, 1, 'avoided traveling after dark', NULL, 1),
(417, 1, 'avoided traveling alone', NULL, 1),
(418, 1, 'I stopped/reduced social activity', NULL, 1),
(419, 1, 'stopped/reduced meeting my friends', NULL, 1),
(420, 1, 'stopped/reduced talking to people', NULL, 1),
(422, 1, 'I stopped going to school or work', NULL, 1),
(423, 1, 'I changed my school or work', NULL, 1),
(424, 1, 'I did not change my behaviour', NULL, 1),
(425, 1, 'Other', 'Please specify', 1),
(426, 1, 'Facebook/Twitter', NULL, 1),
(427, 1, 'Email', NULL, 1),
(428, 1, 'In-person from acquaintance', NULL, 1),
(429, 1, 'From a Safecity workshop', NULL, 1),
(430, 1, 'I am a volunteer for Safecity filling out for a participant', NULL, 1),
(431, 1, 'Others', 'Please specify', 1),
(432, 1, 'Threats on a public platform', NULL, 1),
(433, 1, 'False accusations of defamatory nature', NULL, 1),
(434, 1, 'Hacking or vandalising my website/social media', NULL, 1),
(435, 1, 'Sexual remarks', NULL, 1),
(436, 1, 'Publishing materials to defame me/posting revenge porn', NULL, 1),
(437, 1, 'Catfishing (luring someone into a relationship by using a fictional online identity)', NULL, 1),
(438, 1, 'Ridicule or humiliation online', NULL, 1),
(439, 1, 'Stalking or other constant intimidation', NULL, 1),
(440, 1, 'A stranger', NULL, 1),
(441, 1, 'Someone I know', NULL, 1),
(442, 1, 'acquaintance', NULL, 1),
(443, 1, ' friend', NULL, 1),
(444, 1, 'colleague', NULL, 1),
(445, 1, 'family member', NULL, 1),
(446, 1, 'ex-partner', NULL, 1),
(447, 1, 'Someone I met on an online dating site', NULL, 1),
(448, 1, 'Intimate partner/spouse', NULL, 1),
(449, 1, 'A person in authority', NULL, 1),
(450, 1, 'I don’t know', NULL, 1),
(451, 1, 'Male', NULL, 1),
(452, 1, 'Female', NULL, 1),
(453, 1, 'Gender non-binary or transgender', NULL, 1),
(454, 1, 'Don’t Know', NULL, 1),
(457, 1, 'Email', NULL, 1),
(458, 1, 'Phone calls/ messages', NULL, 1),
(459, 1, 'Social Media Platform', NULL, 1),
(460, 1, 'Facebook', NULL, 1),
(462, 1, 'Instagram', NULL, 1),
(463, 1, 'Snapchat', NULL, 1),
(464, 1, 'Twitter', NULL, 1),
(465, 1, 'Whatsapp', NULL, 1),
(467, 1, 'Others', 'Please specify', 1),
(468, 1, 'It only happened once', NULL, 1),
(469, 1, '1-2 weeks', NULL, 1),
(470, 1, '2- 4 weeks', NULL, 1),
(471, 1, '1-2 months', NULL, 1),
(472, 1, '3 - 6 months', NULL, 1),
(473, 1, '6 -11 months', NULL, 1),
(474, 1, '1 year', NULL, 1),
(475, 1, 'More than 1 year', 'Please specify', 1),
(476, 1, 'I ignored it', NULL, 1),
(477, 1, 'I replied', 'Please tell us how you responded', 1),
(478, 1, 'I blocked the person', NULL, 1),
(479, 1, 'I reported the person', NULL, 1),
(480, 1, 'Altered my profile', NULL, 1),
(481, 1, 'Deactivated/deleted my profile/account', NULL, 1),
(482, 1, 'Reduced using the website/app', NULL, 1),
(483, 1, ' Removed images/media from my profile', NULL, 1),
(484, 1, 'Made my profile private', NULL, 1),
(485, 1, 'Renamed my profile', NULL, 1),
(486, 1, 'Scared', NULL, 1),
(487, 1, 'Angry', NULL, 1),
(488, 1, 'Ashamed/Embarrassed', NULL, 1),
(489, 1, 'Strong/Confident', NULL, 1),
(490, 1, 'Violated/Disgusted', NULL, 1),
(491, 1, 'Regret that I didn\'t respond to the harasser', NULL, 1),
(492, 1, 'Regret that I didn\'t report to the police', NULL, 1),
(493, 1, 'Confused/not sure how to feel', NULL, 1),
(494, 1, 'Made to feel that it was my fault', NULL, 1),
(495, 1, 'Lost faith / ability to trust people', NULL, 1),
(496, 1, 'Developed anxious feelings', NULL, 1),
(497, 1, 'Developed depressive feelings [ I have been diagnosed/ I have symptoms ]', NULL, 1),
(498, 1, 'Wished I didn’t exist / Suicidal thoughts', NULL, 1),
(499, 1, 'Others', 'Please specify', 1),
(500, 1, 'The same as I had before the attack ', NULL, 1),
(501, 1, 'Nothing – I didn\'t feel anything', NULL, 1),
(502, 1, 'I told a friend/colleague', NULL, 1),
(503, 1, 'I told a family member', NULL, 1),
(504, 1, 'I reported to', NULL, 1),
(505, 1, 'police', NULL, 1),
(506, 1, 'organisation', NULL, 1),
(507, 1, 'the website/app', NULL, 1),
(508, 1, 'I was unable to do anything', NULL, 1),
(509, 1, 'Others', 'Please specify', 1),
(510, 1, 'I reported the attack on Safecity', NULL, 1),
(511, 1, 'Yes', NULL, 1),
(512, 1, 'No', NULL, 1),
(513, 1, 'Reduced for a while, then started again', NULL, 1),
(514, 1, 'Facebook/Twitter', NULL, 1),
(515, 1, 'Email', NULL, 1),
(516, 1, 'In-person from acquaintance', NULL, 1),
(517, 1, 'From a Safecity workshop', NULL, 1),
(518, 1, 'I am a volunteer for Safecity filling out for a participant', NULL, 1),
(519, 1, 'Others', 'Please specify', 1),
(520, 1, 'Sex', NULL, 1),
(521, 1, 'Labour', NULL, 1),
(522, 1, 'Sex and Labour', NULL, 1),
(523, 1, 'Organ ', NULL, 1),
(524, 1, 'Others', 'Please specify', 1),
(525, 1, 'We were strangers', NULL, 1),
(526, 1, 'I knew them', NULL, 1),
(527, 1, 'acquaintance', NULL, 1),
(528, 1, ' friend', NULL, 1),
(529, 1, 'member of a religious group', NULL, 1),
(530, 1, 'colleague', NULL, 1),
(531, 1, 'family member', NULL, 1),
(532, 1, 'ex-partner', NULL, 1),
(533, 1, 'He/she was my intimate partner / spouse', NULL, 1),
(534, 1, 'They were a person in authority', NULL, 1),
(535, 1, 'I don’t know', NULL, 1),
(536, 1, 'A Business/Company', NULL, 1),
(537, 1, 'An Organisation', NULL, 1),
(538, 1, 'An Individual', NULL, 1),
(539, 1, 'Both', NULL, 1),
(540, 1, 'Others', 'Please specify', 1),
(541, 1, 'I was abducted', NULL, 1),
(542, 1, 'I was employed on false pretenses', NULL, 1),
(543, 1, 'I was sold/given away ', NULL, 1),
(544, 1, 'I was married against my will', NULL, 1),
(545, 1, 'Others', 'Please specify', 1),
(546, 1, 'Mental Abuse', NULL, 1),
(547, 1, 'Physical Abuse', NULL, 1),
(548, 1, 'Sexual Abuse', NULL, 1),
(549, 1, 'Neglect', NULL, 1),
(550, 1, 'None of the above', NULL, 1),
(551, 1, 'I was unable to respond', NULL, 1),
(552, 1, 'I froze, I did not know what to do', NULL, 1),
(553, 1, 'I did what I was told to do', NULL, 1),
(554, 1, 'I responded to the trafficker', NULL, 1),
(555, 1, 'Verbally', NULL, 1),
(556, 1, 'Physically', NULL, 1),
(557, 1, 'I asked for assistance', NULL, 1),
(558, 1, 'from people nearby who saw the who saw what was happening', NULL, 1),
(559, 1, 'from people nearby who did not see the who saw what was happening', NULL, 1),
(560, 1, 'I called for assistance', NULL, 1),
(561, 1, 'police', NULL, 1),
(562, 1, 'friend', NULL, 1),
(563, 1, 'family member', NULL, 1),
(564, 1, 'I screamed', NULL, 1),
(565, 1, 'I ran away from the trafficker', NULL, 1),
(566, 1, 'I felt resigned to the situation', NULL, 1),
(567, 1, 'I accepted my fate', NULL, 1),
(568, 1, 'Other', 'Please specify', 1),
(569, 1, 'I called for assistance', NULL, 1),
(570, 1, 'police', NULL, 1),
(571, 1, 'friend', NULL, 1),
(572, 1, 'family member', NULL, 1),
(573, 1, 'I was rescued by an NGO', 'please specify name of organisation', 1),
(574, 1, 'I was rescued by a friend/ family member', NULL, 1),
(575, 1, 'I escaped by myself', NULL, 1),
(576, 1, 'I escaped with the help of a stranger', NULL, 1),
(577, 1, 'Other', 'Please specify', 1),
(578, 1, 'Scared', NULL, 1),
(579, 1, 'Angry', NULL, 1),
(580, 1, 'Ashamed/Embarrassed', NULL, 1),
(581, 1, 'Strong/Confident', NULL, 1),
(582, 1, 'Violated/Disgusted', NULL, 1),
(583, 1, 'Regretful that I didn\'t respond to the perpetrator', NULL, 1),
(584, 1, 'Regretful that I didn\'t report to the police', NULL, 1),
(585, 1, 'Confused', NULL, 1),
(586, 1, 'I felt it was my fault because of the way people I told reacted', NULL, 1),
(587, 1, 'Lost faith and ability to trust people', NULL, 1),
(588, 1, 'Anxious ', NULL, 1),
(589, 1, 'Depressed', NULL, 1),
(590, 1, 'Wished I didn\'t exist', NULL, 1),
(591, 1, 'The same as I had before the attack ', NULL, 1),
(592, 1, 'Other', 'Please specify', 1),
(593, 1, 'I avoided places', 'Which spaces did you avoid?', 1),
(594, 1, 'I changed how I travel', NULL, 1),
(595, 1, 'the route I walk', NULL, 1),
(596, 1, ' my travel timings', NULL, 1),
(597, 1, 'avoided using public transportation', NULL, 1),
(598, 1, 'my travel timings', NULL, 1),
(599, 1, 'avoided traveling after dark', NULL, 1),
(600, 1, 'avoided traveling alone', NULL, 1),
(601, 1, 'I avoided going out of the house', NULL, 1),
(602, 1, 'I started learning self defence and/or carrying items for self-defense', NULL, 1),
(603, 1, 'I stopped going to school or workplace', NULL, 1),
(604, 1, 'I changed my school or workplace', NULL, 1),
(605, 1, 'I did not change my behaviour', NULL, 1),
(609, 1, 'Other', 'Please specify', 1),
(606, 1, 'I was able to connect with my family but I did not go back home', NULL, 1),
(607, 1, 'I was not able to connect with my family and had to learn to live in the (country/city/location) where I was found', NULL, 1),
(608, 1, 'I was connected with an organisation that helped me', NULL, 1),
(610, 1, 'Yes', NULL, 1),
(611, 1, 'I am considering it', NULL, 1),
(612, 1, 'No', NULL, 1),
(613, 1, 'Facebook/Twitter', NULL, 1),
(614, 1, 'Email', NULL, 1),
(615, 1, 'In-person from acquaintance', NULL, 1),
(616, 1, 'From a Safecity workshop', NULL, 1),
(617, 1, 'I am a volunteer for Safecity filling out for a participant', NULL, 1),
(618, 1, 'Other', ' Please specify', 1),
(619, 1, 'Yes', NULL, 1),
(620, 1, 'No', NULL, 1),
(621, 1, 'Yes', NULL, 1),
(622, 1, 'No', NULL, 1),
(623, 1, 'Intimate Partner', NULL, 1),
(624, 1, 'Ex-Partner', NULL, 1),
(625, 1, 'Blood relative', NULL, 1),
(626, 1, 'In-laws', NULL, 1),
(627, 1, 'I prefer not to say', NULL, 1),
(628, 1, 'Alone', NULL, 1),
(629, 1, 'With family members', NULL, 1),
(630, 1, 'With colleagues', NULL, 1),
(631, 1, 'With friends', NULL, 1),
(632, 1, 'Other', 'Please specify', 1),
(633, 1, '<14', NULL, 1),
(634, 1, '14-19', NULL, 1),
(635, 1, '20-29', NULL, 1),
(636, 1, '30-39', NULL, 1),
(637, 1, '40-49', NULL, 1),
(638, 1, '50-59', NULL, 1),
(639, 1, '60-69', NULL, 1),
(640, 1, '70+', NULL, 1),
(641, 1, 'I don’t know', NULL, 1),
(88, 1, 'people who saw the incident', '', 1),
(89, 1, 'people nearby who did not see the incident', '', 1),
(90, 1, 'police', '', 1),
(91, 1, 'friend', '', 1),
(92, 1, 'a family member', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `option_translation`
--
ALTER TABLE `option_translation`
  ADD KEY `fk_options` (`option_id`);

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