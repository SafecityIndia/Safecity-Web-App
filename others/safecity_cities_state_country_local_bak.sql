-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 06:53 AM
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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `state_id`, `city_name`) VALUES
(1, 102, 1, 'Mumbai'),
(2, 102, 2, 'Amritsar'),
(3, 238, 0, 'London'),
(4, 238, 0, 'Birmingham'),
(5, 238, 0, 'Manchester'),
(6, 238, 0, 'Glasgow'),
(7, 238, 0, 'Newcastle'),
(8, 238, 0, 'Sheffield'),
(9, 238, 0, 'Liverpool'),
(10, 238, 0, 'Leeds'),
(11, 238, 0, 'Bristol'),
(12, 238, 0, 'Belfast'),
(13, 238, 0, 'Gloucestershire'),
(14, 238, 0, 'Gloucester');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(150) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `iso_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_code`, `iso_code`) VALUES
(1, 'Afghanistan', 'AF', 'AFG'),
(2, 'Åland', 'AX', 'ALA'),
(3, 'Albania', 'AL', 'ALB'),
(4, 'Algeria', 'DZ', 'DZA'),
(5, 'American Samoa', 'AS', 'ASM'),
(6, 'Andorra', 'AD', 'AND'),
(7, 'Angola', 'AO', 'AGO'),
(8, 'Anguilla', 'AI', 'AIA'),
(9, 'Antarctica', 'AQ', 'ATA'),
(10, 'Antigua and Barbuda', 'AG', 'ATG'),
(11, 'Argentina', 'AR', 'ARG'),
(12, 'Armenia', 'AM', 'ARM'),
(13, 'Aruba', 'AW', 'ABW'),
(14, 'Australia', 'AU', 'AUS'),
(15, 'Austria', 'AT', 'AUT'),
(16, 'Azerbaijan', 'AZ', 'AZE'),
(17, 'Bahamas', 'BS', 'BHS'),
(18, 'Bahrain', 'BH', 'BHR'),
(19, 'Bangladesh', 'BD', 'BGD'),
(20, 'Barbados', 'BB', 'BRB'),
(21, 'Belarus', 'BY', 'BLR'),
(22, 'Belgium', 'BE', 'BEL'),
(23, 'Belize', 'BZ', 'BLZ'),
(24, 'Benin', 'BJ', 'BEN'),
(25, 'Bermuda', 'BM', 'BMU'),
(26, 'Bhutan', 'BT', 'BTN'),
(27, 'Bolivia', 'BO', 'BOL'),
(28, 'Bonaire', 'BQ', 'BES'),
(29, 'Bosnia and Herzegovina', 'BA', 'BIH'),
(30, 'Botswana', 'BW', 'BWA'),
(31, 'Bouvet Island', 'BV', 'BVT'),
(32, 'Brazil', 'BR', 'BRA'),
(33, 'British Indian Ocean Territory', 'IO', 'IOT'),
(34, 'British Virgin Islands', 'VG', 'VGB'),
(35, 'Brunei', 'BN', 'BRN'),
(36, 'Bulgaria', 'BG', 'BGR'),
(37, 'Burkina Faso', 'BF', 'BFA'),
(38, 'Burundi', 'BI', 'BDI'),
(39, 'Cambodia', 'KH', 'KHM'),
(40, 'Cameroon', 'CM', 'CMR'),
(41, 'Canada', 'CA', 'CAN'),
(42, 'Cape Verde', 'CV', 'CPV'),
(43, 'Cayman Islands', 'KY', 'CYM'),
(44, 'Central African Republic', 'CF', 'CAF'),
(45, 'Chad', 'TD', 'TCD'),
(46, 'Chile', 'CL', 'CHL'),
(47, 'China', 'CN', 'CHN'),
(48, 'Christmas Island', 'CX', 'CXR'),
(49, 'Cocos [Keeling] Islands', 'CC', 'CCK'),
(50, 'Colombia', 'CO', 'COL'),
(51, 'Comoros', 'KM', 'COM'),
(52, 'Cook Islands', 'CK', 'COK'),
(53, 'Costa Rica', 'CR', 'CRI'),
(54, 'Croatia', 'HR', 'HRV'),
(55, 'Cuba', 'CU', 'CUB'),
(56, 'Curacao', 'CW', 'CUW'),
(57, 'Cyprus', 'CY', 'CYP'),
(58, 'Czech Republic', 'CZ', 'CZE'),
(59, 'Democratic Republic of the Congo', 'CD', 'COD'),
(60, 'Denmark', 'DK', 'DNK'),
(61, 'Djibouti', 'DJ', 'DJI'),
(62, 'Dominica', 'DM', 'DMA'),
(63, 'Dominican Republic', 'DO', 'DOM'),
(64, 'East Timor', 'TL', 'TLS'),
(65, 'Ecuador', 'EC', 'ECU'),
(66, 'Egypt', 'EG', 'EGY'),
(67, 'El Salvador', 'SV', 'SLV'),
(68, 'Equatorial Guinea', 'GQ', 'GNQ'),
(69, 'Eritrea', 'ER', 'ERI'),
(70, 'Estonia', 'EE', 'EST'),
(71, 'Ethiopia', 'ET', 'ETH'),
(72, 'Falkland Islands', 'FK', 'FLK'),
(73, 'Faroe Islands', 'FO', 'FRO'),
(74, 'Fiji', 'FJ', 'FJI'),
(75, 'Finland', 'FI', 'FIN'),
(76, 'France', 'FR', 'FRA'),
(77, 'French Guiana', 'GF', 'GUF'),
(78, 'French Polynesia', 'PF', 'PYF'),
(79, 'French Southern Territories', 'TF', 'ATF'),
(80, 'Gabon', 'GA', 'GAB'),
(81, 'Gambia', 'GM', 'GMB'),
(82, 'Georgia', 'GE', 'GEO'),
(83, 'Germany', 'DE', 'DEU'),
(84, 'Ghana', 'GH', 'GHA'),
(85, 'Gibraltar', 'GI', 'GIB'),
(86, 'Greece', 'GR', 'GRC'),
(87, 'Greenland', 'GL', 'GRL'),
(88, 'Grenada', 'GD', 'GRD'),
(89, 'Guadeloupe', 'GP', 'GLP'),
(90, 'Guam', 'GU', 'GUM'),
(91, 'Guatemala', 'GT', 'GTM'),
(92, 'Guernsey', 'GG', 'GGY'),
(93, 'Guinea', 'GN', 'GIN'),
(94, 'Guinea-Bissau', 'GW', 'GNB'),
(95, 'Guyana', 'GY', 'GUY'),
(96, 'Haiti', 'HT', 'HTI'),
(97, 'Heard Island and McDonald Islands', 'HM', 'HMD'),
(98, 'Honduras', 'HN', 'HND'),
(99, 'Hong Kong', 'HK', 'HKG'),
(100, 'Hungary', 'HU', 'HUN'),
(101, 'Iceland', 'IS', 'ISL'),
(102, 'India', 'IN', 'IND'),
(103, 'Indonesia', 'ID', 'IDN'),
(104, 'Iran', 'IR', 'IRN'),
(105, 'Iraq', 'IQ', 'IRQ'),
(106, 'Ireland', 'IE', 'IRL'),
(107, 'Isle of Man', 'IM', 'IMN'),
(108, 'Israel', 'IL', 'ISR'),
(109, 'Italy', 'IT', 'ITA'),
(110, 'Ivory Coast', 'CI', 'CIV'),
(111, 'Jamaica', 'JM', 'JAM'),
(112, 'Japan', 'JP', 'JPN'),
(113, 'Jersey', 'JE', 'JEY'),
(114, 'Jordan', 'JO', 'JOR'),
(115, 'Kazakhstan', 'KZ', 'KAZ'),
(116, 'Kenya', 'KE', 'KEN'),
(117, 'Kiribati', 'KI', 'KIR'),
(118, 'Kosovo', 'XK', 'XKX'),
(119, 'Kuwait', 'KW', 'KWT'),
(120, 'Kyrgyzstan', 'KG', 'KGZ'),
(121, 'Laos', 'LA', 'LAO'),
(122, 'Latvia', 'LV', 'LVA'),
(123, 'Lebanon', 'LB', 'LBN'),
(124, 'Lesotho', 'LS', 'LSO'),
(125, 'Liberia', 'LR', 'LBR'),
(126, 'Libya', 'LY', 'LBY'),
(127, 'Liechtenstein', 'LI', 'LIE'),
(128, 'Lithuania', 'LT', 'LTU'),
(129, 'Luxembourg', 'LU', 'LUX'),
(130, 'Macao', 'MO', 'MAC'),
(131, 'Macedonia', 'MK', 'MKD'),
(132, 'Madagascar', 'MG', 'MDG'),
(133, 'Malawi', 'MW', 'MWI'),
(134, 'Malaysia', 'MY', 'MYS'),
(135, 'Maldives', 'MV', 'MDV'),
(136, 'Mali', 'ML', 'MLI'),
(137, 'Malta', 'MT', 'MLT'),
(138, 'Marshall Islands', 'MH', 'MHL'),
(139, 'Martinique', 'MQ', 'MTQ'),
(140, 'Mauritania', 'MR', 'MRT'),
(141, 'Mauritius', 'MU', 'MUS'),
(142, 'Mayotte', 'YT', 'MYT'),
(143, 'Mexico', 'MX', 'MEX'),
(144, 'Micronesia', 'FM', 'FSM'),
(145, 'Moldova', 'MD', 'MDA'),
(146, 'Monaco', 'MC', 'MCO'),
(147, 'Mongolia', 'MN', 'MNG'),
(148, 'Montenegro', 'ME', 'MNE'),
(149, 'Montserrat', 'MS', 'MSR'),
(150, 'Morocco', 'MA', 'MAR'),
(151, 'Mozambique', 'MZ', 'MOZ'),
(152, 'Myanmar [Burma]', 'MM', 'MMR'),
(153, 'Namibia', 'NA', 'NAM'),
(154, 'Nauru', 'NR', 'NRU'),
(155, 'Nepal', 'NP', 'NPL'),
(156, 'Netherlands', 'NL', 'NLD'),
(157, 'New Caledonia', 'NC', 'NCL'),
(158, 'New Zealand', 'NZ', 'NZL'),
(159, 'Nicaragua', 'NI', 'NIC'),
(160, 'Niger', 'NE', 'NER'),
(161, 'Nigeria', 'NG', 'NGA'),
(162, 'Niue', 'NU', 'NIU'),
(163, 'Norfolk Island', 'NF', 'NFK'),
(164, 'North Korea', 'KP', 'PRK'),
(165, 'Northern Mariana Islands', 'MP', 'MNP'),
(166, 'Norway', 'NO', 'NOR'),
(167, 'Oman', 'OM', 'OMN'),
(168, 'Pakistan', 'PK', 'PAK'),
(169, 'Palau', 'PW', 'PLW'),
(170, 'Palestine', 'PS', 'PSE'),
(171, 'Panama', 'PA', 'PAN'),
(172, 'Papua New Guinea', 'PG', 'PNG'),
(173, 'Paraguay', 'PY', 'PRY'),
(174, 'Peru', 'PE', 'PER'),
(175, 'Philippines', 'PH', 'PHL'),
(176, 'Pitcairn Islands', 'PN', 'PCN'),
(177, 'Poland', 'PL', 'POL'),
(178, 'Portugal', 'PT', 'PRT'),
(179, 'Puerto Rico', 'PR', 'PRI'),
(180, 'Qatar', 'QA', 'QAT'),
(181, 'Republic of the Congo', 'CG', 'COG'),
(182, 'Réunion', 'RE', 'REU'),
(183, 'Romania', 'RO', 'ROU'),
(184, 'Russia', 'RU', 'RUS'),
(185, 'Rwanda', 'RW', 'RWA'),
(186, 'Saint Barthélemy', 'BL', 'BLM'),
(187, 'Saint Helena', 'SH', 'SHN'),
(188, 'Saint Kitts and Nevis', 'KN', 'KNA'),
(189, 'Saint Lucia', 'LC', 'LCA'),
(190, 'Saint Martin', 'MF', 'MAF'),
(191, 'Saint Pierre and Miquelon', 'PM', 'SPM'),
(192, 'Saint Vincent and the Grenadines', 'VC', 'VCT'),
(193, 'Samoa', 'WS', 'WSM'),
(194, 'San Marino', 'SM', 'SMR'),
(195, 'São Tomé and Príncipe', 'ST', 'STP'),
(196, 'Saudi Arabia', 'SA', 'SAU'),
(197, 'Senegal', 'SN', 'SEN'),
(198, 'Serbia', 'RS', 'SRB'),
(199, 'Seychelles', 'SC', 'SYC'),
(200, 'Sierra Leone', 'SL', 'SLE'),
(201, 'Singapore', 'SG', 'SGP'),
(202, 'Sint Maarten', 'SX', 'SXM'),
(203, 'Slovakia', 'SK', 'SVK'),
(204, 'Slovenia', 'SI', 'SVN'),
(205, 'Solomon Islands', 'SB', 'SLB'),
(206, 'Somalia', 'SO', 'SOM'),
(207, 'South Africa', 'ZA', 'ZAF'),
(208, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS'),
(209, 'South Korea', 'KR', 'KOR'),
(210, 'South Sudan', 'SS', 'SSD'),
(211, 'Spain', 'ES', 'ESP'),
(212, 'Sri Lanka', 'LK', 'LKA'),
(213, 'Sudan', 'SD', 'SDN'),
(214, 'Suriname', 'SR', 'SUR'),
(215, 'Svalbard and Jan Mayen', 'SJ', 'SJM'),
(216, 'Swaziland', 'SZ', 'SWZ'),
(217, 'Sweden', 'SE', 'SWE'),
(218, 'Switzerland', 'CH', 'CHE'),
(219, 'Syria', 'SY', 'SYR'),
(220, 'Taiwan', 'TW', 'TWN'),
(221, 'Tajikistan', 'TJ', 'TJK'),
(222, 'Tanzania', 'TZ', 'TZA'),
(223, 'Thailand', 'TH', 'THA'),
(224, 'Togo', 'TG', 'TGO'),
(225, 'Tokelau', 'TK', 'TKL'),
(226, 'Tonga', 'TO', 'TON'),
(227, 'Trinidad and Tobago', 'TT', 'TTO'),
(228, 'Tunisia', 'TN', 'TUN'),
(229, 'Turkey', 'TR', 'TUR'),
(230, 'Turkmenistan', 'TM', 'TKM'),
(231, 'Turks and Caicos Islands', 'TC', 'TCA'),
(232, 'Tuvalu', 'TV', 'TUV'),
(233, 'U.S. Minor Outlying Islands', 'UM', 'UMI'),
(234, 'U.S. Virgin Islands', 'VI', 'VIR'),
(235, 'Uganda', 'UG', 'UGA'),
(236, 'Ukraine', 'UA', 'UKR'),
(237, 'United Arab Emirates', 'AE', 'ARE'),
(238, 'United Kingdom', 'GB', 'GBR'),
(239, 'United States', 'US', 'USA'),
(240, 'Uruguay', 'UY', 'URY'),
(241, 'Uzbekistan', 'UZ', 'UZB'),
(242, 'Vanuatu', 'VU', 'VUT'),
(243, 'Vatican City', 'VA', 'VAT'),
(244, 'Venezuela', 'VE', 'VEN'),
(245, 'Vietnam', 'VN', 'VNM'),
(246, 'Wallis and Futuna', 'WF', 'WLF'),
(247, 'Western Sahara', 'EH', 'ESH'),
(248, 'Yemen', 'YE', 'YEM'),
(249, 'Zambia', 'ZM', 'ZMB'),
(250, 'Zimbabwe', 'ZW', 'ZWE');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state_name`) VALUES
(1, 102, 'Maharashtra'),
(2, 102, 'Punjab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
