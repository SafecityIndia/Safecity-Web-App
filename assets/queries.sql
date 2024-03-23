-- Do you have any kind of disability (mental or physical)?*

'{"type":"text","placeholder": "Please type your experience here","validations":[{"required": true,"message": "This field is required"},{"pattern": true,"message": "Only Alphabets Numbers and Space are allowed"}]}

{"type":"text","placeholder": "Please enter a number for you age in years. Example 40.","validations":[{"required": true,"message": "Age is required"},{"type": "number","message": "Please enter a valid number"},{"min": 18,"message": "Age cannot be below 18"},{"max": 40,"message": "Age cannot be greater than 40"}]}

{
	"placeholder": "Please specify",
	"validations":
		[
			{
				"required": true,
				"message": "This field is required"
			},
			{
				"pattern": true,
				"message": "Only Alphabets Numbers and Space are allowed"
			}
		]
}'

-- SELECT * FROM `option_translation` WHERE textbox_placeholder != ''

-- Queries:

ALTER TABLE `option_translation` CHANGE `textbox_placeholder` `textbox_placeholder` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please specify", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id = 57;

-- ========================
-- What religion do you follow?*

UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please specify", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE title='other';

-- ===============================
-- How many perpetrators were there?*

UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please Specify how many", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE title='many';
-- ==============================

-- Who was the perpetrator(s) ? (select all that apply)*

UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please Specify", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id=103;

-- ===================================

-- Do you feel any of the below led to you being attacked?*

UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please elaborate", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id=47;

UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please Specify", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id=50;


-- textfield.js age validation changes
UPDATE `question_translation` SET properties='{ "type":"text", "placeholder": "Please enter a number for you age in years. Example 40.", "validations": [ { "required": true, "message": "Age is required" }, { "type": "number", "message": "Please enter a valid number" }, { "min": 18, "message": "Age cannot be below 18" }, { "max": 75, "message": "Age cannot be greater than 75" } ] }' WHERE question_id=2

-- Added no of forms (to indicate primary/secondary) type  (26-10-2020)
ALTER TABLE `incident_reports` ADD `total_forms` INT NOT NULL DEFAULT '1' AFTER `is_mobile_visible`;

-- Add incident Statuses (26-10-2020)
ALTER TABLE `incident_reports` ADD `status` ENUM('pending_approval','approved','published','saved','rejected','trashed') NOT NULL DEFAULT 'pending_approval' AFTER `id`;

-- Added type of form (26-10-2020)
ALTER TABLE `forms` ADD `name` ENUM('primary','secondary') NOT NULL DEFAULT 'primary' AFTER `thank_you_mobile`;
UPDATE `forms` SET `name` = 'secondary' WHERE `forms`.`id` = 4;
UPDATE `forms` SET `name` = 'secondary' WHERE `forms`.`id` = 5;

ALTER TABLE `incident_details` ADD `form_type` VARCHAR(255) NOT NULL DEFAULT 'primary' AFTER `incident_id`;

ALTER TABLE `incident_details` CHANGE `form_type` `form_type` ENUM('primary','secondary') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'primary';

-- time ot time range validation 26-10-2020 -Mahesh
-- Can you tell us when this happened?
UPDATE `question_translation` SET properties='
{
	"type":"estimate-time-or-rangepicker",
	"validations":
		[
			{
				"timeorrange": "Please select Time OR Time Range.",
				"maintime": "Please select time to proceed.",
				"startendtime": "Please select Start Time and End Time to proceed.",
				"timediff": "End Time should be Greater Than Start Time."
			}
		]
}' WHERE question_id=6;

-- Add UK cities for DEMO
Insert into cities (country_id, state_id, city_name) values (238, 0, 'London');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Birmingham');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Manchester');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Glasgow');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Newcastle');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Sheffield');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Liverpool');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Leeds');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Bristol');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Belfast');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Gloucestershire');
Insert into cities (country_id, state_id, city_name) values (238, 0, 'Gloucester');

-- Updated Secondary form thank you page
UPDATE `forms` SET `thank_you_web` = '{\r\n \"title\": \"\",\r\n \"content\": \"<p>Thank you for sharing more about your experince with us</p>\",\r\n \"links\": [\r\n {\r\n \"title\": \"FINISH\",\r\n \"is_next\": false,\r\n \"redirect_url\": \"/help_pf\"\r\n }\r\n ]\r\n}' WHERE `forms`.`id` = 5;

-- Updated Max age (27-10-2020/Alok)
UPDATE `question_translation` SET `properties` = '{ \"type\":\"text\", \"placeholder\": \"Please enter a number for you age in years. Example 40.\", \"validations\": [ { \"required\": true, \"message\": \"Age is required\" }, { \"type\": \"number\", \"message\": \"Please enter a valid number\" }, { \"min\": 18, \"message\": \"Age cannot be below 18\" }, { \"max\": 120, \"message\": \"Age cannot be greater than 120\" } ] }' WHERE `question_translation`.`question_id` = 2;

-- Updated Last primary question text (29-10-2020/Alok)
UPDATE question_translation SET question="You\'re doing great. Just one more step to go!<br>Please tell us where the incident took place<span class='error'>*</span>" where question_id=14
UPDATE question_translation SET subtext='' where question_id=14;

-- Fix date format in incident_details table (29-10-2020/Alok)
Update incident_details icd JOIN incident_reports ir ON icd.incident_id=ir.id AND icd.question_type="estimate-datepicker" SET answer=ir.date;

-- Removed last primary question (30-10-2020/Alok)
UPDATE `forms` SET `question_ids_json` = '[{\"question_id\": 11, \"on_option_id\":[]}, {\"question_id\": 12, \"on_option_id\":[]}, {\"question_id\": 13, \"on_option_id\":[]},{\"question_id\":14, \"on_option_id\":[]}]' WHERE `forms`.`id` = 3;

-- (Start 29-10-2020/Mahesh)
-- On transportation - Please specify the mode of transportation
UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please specify the mode of transportation", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE title='On transportation';

-- At a train,metro or bus station - Please specify which station
UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please specify which station", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id=77;

-- In a public space - Please specify
UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please specify", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id=79;

-- Others - Please Specify
UPDATE `option_translation` SET textbox_placeholder='{ "placeholder": "Please specify", "validations": [ { "required": true, "message": "This field is required" }, { "pattern": true, "message": "Only Alphabets Numbers and Space are allowed" } ] }' WHERE option_id=127;

ALTER TABLE `client_resources` ADD `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `footer`, ADD `updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_on`, ADD `updated_by` INT(11) NULL DEFAULT NULL AFTER `updated_on`;
-- (End 29-10-2020/Mahesh)

-- Change latitude/longitude Datatypes (02-11-2020/Alok)
ALTER TABLE `incident_reports` CHANGE `latitude` `latitude` DECIMAL(8,6) NULL DEFAULT NULL;
ALTER TABLE `incident_reports` CHANGE `longitude` `longitude` DECIMAL(9,6) NULL DEFAULT NULL;
-- Safety tips
ALTER TABLE `safety_tips_report` CHANGE `map_lat` `map_lat` DECIMAL(8,6) NOT NULL;
ALTER TABLE `safety_tips_report` CHANGE `map_lon` `map_lon` DECIMAL(9,6) NOT NULL;

--add created on column in form table
ALTER TABLE `forms` ADD `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `name`;

-- add admin_id (04-11-2020/Alok)
ALTER TABLE `incident_reports` ADD `admin_id` INT NOT NULL DEFAULT '0' AFTER `user_id`;
ALTER TABLE `safety_tips_report` ADD `admin_id` INT NOT NULL DEFAULT '0' AFTER `user_id`;
ALTER TABLE `safety_tips_report` ADD `updated_by` INT NOT NULL DEFAULT '0' AFTER `updated_date`;
ALTER TABLE `safety_tips_report` CHANGE `status` `status_bak` ENUM('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1' COMMENT '0=>Inactive, 1=>Active, 2=>Delete';
ALTER TABLE `safety_tips_report` ADD `status` ENUM('pending_approval','approved','published','saved','rejected','trashed') NOT NULL DEFAULT 'pending_approval' AFTER `id`;

-- Updated logic_combinations structure (10-11-2020/Alok)
ALTER TABLE `logic_combinations` ADD `parent_id` INT NOT NULL DEFAULT '0' AFTER `comb_json`;
ALTER TABLE `logic_combinations` CHANGE `comb_json` `comb_json` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;

-- Updated country id as per updated country db (21-11-2020/Alok)
Update emergency_helpline SET country_id=214 where country_id=218;
Update emergency_helpline SET country_id=101 where country_id=102;

-- Added Categories in hindi language
INSERT INTO `categories_translation` (`category_id`, `lang_id`, `title`, `is_default`) VALUES
(1, 42, 'बलात्कार / यौन उत्पीड़न', 0),
(2, 42, 'चैन स्नेचिंग / डकैती', 0),
(3, 42, 'घरेलु हिंसा', 0),
(4, 42, 'शारीरिक हमला', 0),
(5, 42, 'स्टॉकिंग', 0),
(6, 42, 'Ogling / चेहरे की अभिव्यक्तियाँ / घूर', 0),
(7, 42, 'बिना अनुमति के फोटो लेना', 0),
(8, 42, 'सार्वजनिक रूप से असुरक्षित एक्सपोजर / हस्तमैथुन', 0),
(9, 42, 'स्पर्श करना / टटोलना', 0),
(10, 42, 'बिना सहमति के पोर्नोग्राफी दिखाना', 0),
(11, 42, 'टिप्पणी / यौन निमंत्रण', 0),
(12, 42, 'ऑनलाइन उत्पीड़न', 0),
(13, 42, 'मानव तस्करी', 0),
(14, 42, 'अन्य', 0);

-- Update Client resource (30-11-2020/Alok)
ALTER TABLE `client_resources` ADD `admin_id` INT NOT NULL DEFAULT '1' AFTER `id`;
ALTER TABLE `client_resources` ADD `mode` ENUM('single','multiple') NOT NULL DEFAULT 'single' AFTER `type`;
Update client_resources SET mode='multiple' where type IN ('legal', 'fir', 'faq');

-- Chat related queries - (02-12-2020/Mahesh)

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

CREATE TABLE `guest_login_details` (
  `login_details_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `guest_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `users_guest` (
  `guest_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `client_id` int NOT NULL DEFAULT 1,
  `guest_name` varchar(50) NOT NULL,
  `guest_address` varchar(50) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `chat_sync_user_guest` (
  `sync_id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `user_id` int NOT NULL,
  `guest_id` int NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--add status
ALTER TABLE `users_guest` ADD `status` ENUM('active','history','trashed') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active' AFTER `guest_address`;

-- Add column for old id in incident (01-12-2020/Alok)
ALTER TABLE `incident_reports` ADD `old_id` INT NULL AFTER `id`;

-- Add tags column to options (02-12-2020/Alok)
ALTER TABLE `options` ADD `tags` VARCHAR(255) NULL AFTER `suboption_of`;
ALTER TABLE `incident_details` ADD `answer_tag` VARCHAR(255) NULL AFTER `answer_id`;
UPDATE `options` SET `tags` = 'reported_police_yes' WHERE `options`.`id` = 8;
UPDATE `options` SET `tags` = 'reported_police_i_will' WHERE `options`.`id` = 9;
UPDATE `options` SET `tags` = 'reported_police_not_sure' WHERE `options`.`id` = 10;
UPDATE `options` SET `tags` = 'reported_police_no' WHERE `options`.`id` = 11;
UPDATE `options` SET `tags` = 'reported_police_i_tried' WHERE `options`.`id` = 12;

-- Updated Resources with correct country id for India (04-12-2020/Alok)
Update `client_resources` set country_id=101 where country_id=102;

-- Optimized Performance (08-12-2020/Alok)
ALTER TABLE `option_translation` ADD INDEX(`option_id`);

-- Fixes For Client Resources query (10-12-202/Alok)
ALTER TABLE `client_resources` ADD `is_default` TINYINT(1) NOT NULL DEFAULT '0' AFTER `id`;
UPDATE `client_resources` SET is_default=1;

-- Fixes for Language (10-12-2020/Alok)
ALTER TABLE `languages` ADD `native_name` VARCHAR(255) NULL AFTER `short_name`;
UPDATE `languages` SET `native_name` = 'हिंदी' WHERE `languages`.`id` = 42;
UPDATE `languages` SET `native_name` = 'English' WHERE `languages`.`id` = 1;

-- Add City ID in Helpline (11-12-2020/Mahesh)
ALTER TABLE `emergency_helpline` ADD `city_id` INT(11) NULL DEFAULT NULL AFTER `country_id`;

-- Option ordering (14-12-2020/Alok)
ALTER TABLE `options` ADD `order_no` TINYINT(2) NOT NULL AFTER `question_id`;
ALTER TABLE `options` CHANGE `order_no` `order_no` INT NOT NULL;
-- Set incrementing options
SET @i = 0;
UPDATE options
SET order_no =  @i:=@i+1;
SELECT * FROM options;

-- Hindi Translation (17-12-2020/Mahesh)
UPDATE `question_translation` SET properties='{"type":"text","placeholder": "कृपया वर्ष में अपनी आयु दर्ज करें। उदाहरण 40.","validations":[{"required": true,"message": "आयु की जानकारी अनिवार्य है।"},{"type": "number","message": "कृपया उचित उम्र डालिये।"},{"min": 18,"message": "आयु 18 वर्ष से कम नहीं हो सकती।"},{"max": 120,"message": "आयु 120 से अधिक नहीं हो सकती।"}]}' WHERE question_id=3 AND lang_id=42;
UPDATE `question_translation` SET properties='{"type":"text","placeholder":"कृपया अपना अनुभव यहाँ लिखें।","validations":[{"required":true,"message":"यह जानकारी अनिवार्य है।"},{"pattern":true,"message":"केवल अक्षर संख्या और रिक्त स्थान की अनुमति है।"}]}' WHERE question_id IN (5,10,24,30,37,47,55,56,69,72,73,85,86,87,95,100,101,102) AND lang_id=42;
UPDATE `question_translation` SET properties='{"type":"estimate-time-or-rangepicker","validations":[{"timediff": "कृपया चयनित तिथि की समय सीमा दर्ज करें।","startendtime": "कृपया प्रारंभ समय और अंत समय दोनों का चयन करें।"}]}' WHERE question_id=7 AND lang_id=42;
UPDATE `question_translation` SET properties='{"type":"incident-address-form","validations":  [  {   "required": true,   "message": "यह जानकारी अनिवार्य है।"  } ]}' WHERE question_id=107 AND lang_id=42;
UPDATE `question_translation` SET properties='{"type":"text","placeholder": "कृप्या जानकारी दें।","validations":[{"required": true,"message": "यह जानकारी अनिवार्य है।"}]}' WHERE question_id=109 AND lang_id=42;

UPDATE `question_translation` SET properties='{"type":"text","placeholder": "कृप्या जानकारी दें।","validations":[{"required": true,"message": "यह जानकारी अनिवार्य है।"}]}' WHERE question_id=109 AND lang_id=42;

-- Query for Tableau (18-12-2020/Alok)
CREATE VIEW `tableau_data` AS SELECT ir.id, ir.lang_id, ir.age, ir.description, ir.date, ir.is_date_estimate, ir.time_from, ir.time_to, ir.is_time_estimate, ir.incident_category_ids, ir.attack_reason, ir.building, ir.landmark, ir.area, ir.city, ir.state, ir.country, ir.latitude, ir.longitude, id.question_id, qt.question, id.answer_id, ot.title as answer FROM `incident_reports` as ir LEFT JOIN incident_details as id ON id.incident_id=ir.id LEFT JOIN question_translation as qt ON id.question_id=qt.question_id AND qt.is_default=1 LEFT JOIN option_translation as ot ON id.answer_id=ot.option_id AND ot.is_default=1;

-- Client updates (28-12-2020/Alok)
ALTER TABLE `clients` ADD `name` VARCHAR(255) NULL AFTER `id`;
ALTER TABLE `clients` ADD `created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `type_id`;
ALTER TABLE `clients` ADD `deleted_on` TIMESTAMP NULL AFTER `created_on`;
-- guest admin sync changes (28-12-2020/Mahesh)
ALTER TABLE `users_guest` CHANGE `guest_address` `admin_id` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `users_guest` ADD `sync_status` INT(1) NOT NULL DEFAULT '0' COMMENT '0-unsync, 1-sync' AFTER `last_activity`;
-- Client id in users_guest (29-12-2020/Alok)
ALTER TABLE `users_guest` ADD `client_id` INT NOT NULL DEFAULT '1' AFTER `guest_id`;
ALTER TABLE `guest_login_details` ADD `client_id` INT(11) NOT NULL DEFAULT '1' AFTER `login_details_id`;
ALTER TABLE `chat_message` ADD `client_id` INT(11) NOT NULL DEFAULT '1' AFTER `chat_message_id`;
-- Added logo for client (29-12-2020/Alok)
ALTER TABLE `clients` ADD `logo` VARCHAR(255) NULL AFTER `name`;
ALTER TABLE `chat_message` ADD `sent_by` VARCHAR(10) NOT NULL DEFAULT 'web' AFTER `chat_message`;
ALTER TABLE `users_guest` ADD `is_deleted` INT(1) NOT NULL DEFAULT '1' COMMENT '0-Deleted, 1-Active' AFTER `sync_status`;
-- Test client (31-12-2020/Alok)
INSERT INTO `clients` (`id`, `name`, `logo`, `type`, `type_id`, `created_on`, `deleted_on`) VALUES (NULL, 'Goa Police', NULL, 'city', '1104906', current_timestamp(), NULL);
-- Question type change (04-01-2021/Alok)
UPDATE `question_translation` SET `properties` = '{\"type\":\"checkbox\"}' WHERE `question_translation`.`id` = 43;

-- Client updates (02-06-2021/Mahesh)
INSERT INTO `client_languages` (`client_id`, `language_id`) VALUES ('1', '77');
ALTER TABLE `categories_translation` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);
ALTER TABLE `option_translation` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);
UPDATE `languages` SET `native_name` = 'Malay' WHERE `languages`.`id` = 77;
INSERT INTO `client_resources` (`id`, `is_default`, `admin_id`, `type`, `mode`, `client_id`, `country_id`, `lang_id`, `title`, `footer`, `created_on`, `updated_on`, `updated_by`) VALUES (NULL, '1', '1', 'consent', 'single', '77', '101', '42', 'Persetujuan', '', '2020-11-30 13:23:16', '2020-11-30 13:23:16', NULL);
INSERT INTO `client_resource_contents` (`id`, `order_no`, `content_for`, `client_resource_id`, `title`, `content`) VALUES (NULL, '1', 'web', '27', '', '<div class=\"text mx-auto shareIncident\"><p>हम समझते हैं कि किसी के दर्दनाक अनुभवों को याद करना मुश्किल है। यदि आप किसी भी समय असहज महसूस करते हैं, तो जान लें कि आप बाहर निकल सकते हैं। यदि आपने सबमिट बटन नहीं मारा है, तो आपका डेटा सहेजा नहीं जाएगा.</p><p>भले ही आप अपना अनुभव गुमनाम रूप से साझा कर रहे हों, लेकिन हमें अपने अनुभव को क्राउडसोर्स डेटा के हमारे डेटाबेस में शामिल करने के लिए आपकी सहमति की आवश्यकता है.</p><div class=\"proceedError\"></div></div>');
UPDATE `client_resource_contents` SET `content` = '<div class=\"text mx-auto shareIncident\"><p style=\"text-align:justify;\">Kami faham sukar mengingat pengalaman trauma seseorang. Sekiranya anda merasa tidak selesa pada bila-bila masa, ketahuilah bahawa anda boleh keluar. Sekiranya anda tidak menekan butang kirim, data anda tidak akan disimpan.</p><p style=\"text-align:justify;\">Walaupun anda berkongsi pengalaman tanpa nama, kami memerlukan persetujuan anda untuk menyertakan pengalaman anda dalam pangkalan data data sumber kami.</p><div class=\"proceedError\"></div></div>' WHERE `client_resource_contents`.`id` = 2181;
UPDATE `client_resources` SET `client_id` = '1' WHERE `client_resources`.`id` = 27;
UPDATE `client_resources` SET `lang_id` = '77' WHERE `client_resources`.`id` = 27;
INSERT INTO `forms` (`id`, `client_id`, `lang_id`, `type`, `question_ids_json`, `is_submit`, `thank_you_web`, `thank_you_mobile`, `name`, `created_on`) VALUES (NULL, '1', '77', 'primary', '[{\"question_id\": 8, \"on_option_id\":[]}, {\"question_id\": 9, \"on_option_id\":[]}, {\"question_id\": 10, \"on_option_id\":[]},{\"question_id\":107, \"on_option_id\":[]}]', '1', '{\"title\": \"Terima kasih kerana menghantar laporan anda!\",\"content\": \"<p>Dengan berkongsi pengalaman anda dengan kami, anda membantu mengelakkan 3 orang lain mengalami sesuatu yang serupa.</p><p>Sekiranya anda mempunyai masa 5-10 minit, kami ingin mengetahui lebih lanjut mengenai kejadian itu untuk memahami faktor-faktor lain yang berperanan dalam keganasan seksual. Dengan menjawab beberapa soalan, anda akan membantu kami membina bandar yang lebih selamat.</p>\",\"links\": [{\"title\": \"YA, SAYA INGIN MEMBANTU\",\"is_next\": true},{\"title\": \"TIDAK, SAYA INGIN KELUAR\",\"is_next\": false,\"redirect_url\": \"/help_pf\"}]}', '', 'primary', '2020-11-17 06:47:28');
INSERT INTO `forms` (`id`, `client_id`, `lang_id`, `type`, `question_ids_json`, `is_submit`, `thank_you_web`, `thank_you_mobile`, `name`, `created_on`) VALUES (NULL, '1', '77', 'logic', '{ \"dependant_question_id\": 1, \"answer_type\": \"parent\" }', '1', '{\r\n \"title\": \"\",\r\n \"content\": \"<p>Terima kasih kerana berkongsi pengalaman anda dengan kami</p>\",\r\n \"links\": [\r\n {\r\n \"title\": \"SELESAI\",\r\n \"is_next\": false,\r\n \"redirect_url\": \"/help_pf\"\r\n }\r\n ]\r\n}', '', 'secondary', '2020-11-17 06:47:28');

-- Please upload form_translation file before next 2 queries
UPDATE `question_translation` SET `properties` = '{\"type\": \"estimate-time-or-rangepicker\", \"validations\": [{\"timediff\": \"Sila masukkan julat waktu dalam hari yang sama.\", \"startendtime\": \"Sila pilih Waktu Mula dan Waktu Akhir Kedua-duanya. \"}]}' WHERE `question_translation`.`id` = 347;
UPDATE `question_translation` SET `properties` = '{\"type\": \"incident-address-form\", \"validations\": [{\"required\": \"benar\", \"message\": \"Medan ini diperlukan\"}]}' WHERE `question_translation`.`id` = 447;
