--- API URL ---
--- http://localhost/SafeCityWebApp/api/ngo-reported-incidents/4?from_date=2021-04-01&to_date=2021-04-30

---- Save for Prod ---

UPDATE `forms` SET `question_ids_json` = '[{\"question_id\": 8, \"on_option_id\":[]}, {\"question_id\": 9, \"on_option_id\":[]}, {\"question_id\": 10, \"on_option_id\":[]},{\"question_id\":107, \"on_option_id\":[]},{\"question_id\":29, \"on_option_id\":[]}]' WHERE `forms`.`id` = 3;

ALTER TABLE `incident_reports` ADD `platform` VARCHAR(190) NULL AFTER `total_forms`, ADD `app_version` VARCHAR(190) NULL AFTER `platform`;

-- New NGO options
-- option id: 642 --
ALTER TABLE `incident_reports` ADD `ngo_id` INT NULL AFTER `client_id`;
ALTER TABLE `incident_reports` ADD INDEX `ngo_index` (`ngo_id`);
UPDATE `questions` SET `tags` = 'how_u_know_us' WHERE `questions`.`id` = 29;
INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '29', '149', '0', '0', NULL, '0', NULL);

UPDATE `options` SET `suboption_properties` = '{\"type\":\"radio\"}' WHERE `options`.`id` = 642;

INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) VALUES (NULL, '642', '1', 'An NGO', NULL, '1');
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) VALUES (NULL, '642', '76', 'एक स्वयंसेवी संस्था', NULL, '0');
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) VALUES (NULL, '642', '42', 'एक एनजीओ', NULL, '0');
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) VALUES (NULL, '642', '77', 'Sebuah NGO', NULL, '0');
-- NewNGO option end

-- NGO supoptions --
INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '29', '150', '0', '0', NULL, '642', NULL);
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '1', 'Other', 'Please specify', '1' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '42', 'अन्य', 'कृपया निर्दिष्ट करें', '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '76', 'इतर', 'कृपया निर्दिष्ट करा', '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '77', 'Yang lain', 'Sila jelaskan', '0' from options order by id desc limit 1;

INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '29', '149', '0', '0', NULL, '642', NULL);
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '1', 'Work for Equality Organisation (Pune)', NULL, '1'from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '42', 'समानता संगठन के लिए कार्य (पुणे)', NULL, '0'from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '76', 'समानतेसाठी काम करणारी संस्था (पुणे)', NULL, '0'from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, id, '77', 'Bekerja untuk Organisasi Kesaksamaan (Pune)', NULL, '0'from options order by id desc limit 1;

INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '29', '148', '0', '0', NULL, '642', NULL);
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '1', 'Swayam Samajik Vikas Sanstha (Satara)', NULL, '1' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '42', 'स्वयं सामाजिक विकास संस्था (सतारा)', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '76', 'स्वयं सामाजिक विकास संस्था (सातारा)', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '77', 'Swayam Samajik Vikas Sanstha (Satara)', NULL, '0' from options order by id desc limit 1;

INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '29', '147', '0', '0', NULL, '642', NULL);
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '1', 'SNEHA (Mumbai)', NULL, '1' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '42', 'स्नेहा (मुंबई)', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '76', 'स्नेहा (मुंबई)', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '77', 'SNEHA (Mumbai)', NULL, '0' from options order by id desc limit 1;

INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '29', '146', '0', '0', NULL, '642', NULL);
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '1', 'CORO (Mumbai)', NULL, '1' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '42', 'कोरो (मुंबई)', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '76', 'कोरो (मुंबई)', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT  NULL, id, '77', 'CORO (Mumbai)', NULL, '0' from options order by id desc limit 1;
-- NGO suboption end --


UPDATE `logic_combinations` SET `comb_json` = '[{"question_id": 11, "on_option_id":[]},{"question_id": 12, "on_option_id":[]},{"question_id": 13, "on_option_id":[]},{"question_id": 14, "on_option_id":[]},{"question_id": 15, "on_option_id":[]}, {"question_id": 16, "on_option_id":[]}, {"question_id": 17, "on_option_id":[]}, {"question_id": 18, "on_option_id":[]}, {"question_id": 19, "on_option_id":[]}, {"question_id": 20, "on_option_id":[]}, {"question_id": 21, "on_option_id":[]}, {"question_id": 22, "on_option_id":[]}, {"question_id": 23, "on_option_id":[]}, {"question_id": 24, "on_option_id":[]}, {"question_id": 25, "on_option_id":[]}, {"question_id": 26, "on_option_id":[]}, {"question_id": 27, "on_option_id":[]}, {"question_id": 28, "on_option_id":[]}, {"question_id": 30, "on_option_id":[]}]' WHERE `logic_combinations`.`id` = 17;

UPDATE `logic_combinations` SET `comb_json` = '[{"question_id": 11, "on_option_id":[]},{"question_id": 12, "on_option_id":[]},{"question_id": 13, "on_option_id":[]},{"question_id": 14, "on_option_id":[]},{"question_id": 31, "on_option_id":[]}, {"question_id": 32, "on_option_id":[]}, {"question_id": 33, "on_option_id":[]}, {"question_id": 34, "on_option_id":[]}, {"question_id": 35, "on_option_id":[]}, {"question_id": 36, "on_option_id":[{"id": 188,"question_id": 37, "on_option_id": [{"question_id": 38, "on_option_id": [{"question_id": 39, "on_option_id": []}]}]},{"id": 189,"question_id": 37, "on_option_id": [{"question_id": 38, "on_option_id": [{"question_id": 39, "on_option_id": []}]}]},{"id": 190,"question_id": 37, "on_option_id": [{"question_id": 38, "on_option_id": [{"question_id": 39, "on_option_id": []}]}]}]}, {"question_id": 40, "on_option_id":[{"id": 201, "question_id": 41, "on_option_id": []}]}, {"question_id": 42, "on_option_id":[]}, {"question_id": 43, "on_option_id":[]}, {"question_id": 44, "on_option_id":[]}, {"question_id": 45, "on_option_id":[]}, {"question_id": 46, "on_option_id":[]},{"question_id": 47, "on_option_id":[]},{"question_id": 48, "on_option_id":[]},{"question_id": 49, "on_option_id":[]},{"question_id": 50, "on_option_id":[]},{"question_id": 51, "on_option_id":[]},{"question_id": 52, "on_option_id":[]},{"question_id": 53, "on_option_id":[]},{"question_id": 54, "on_option_id":[]},{"question_id": 55, "on_option_id":[]},{"question_id": 56, "on_option_id":[]}]' WHERE `logic_combinations`.`id` = 18;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[]},{\"question_id\": 58, \"on_option_id\":[]}, {\"question_id\": 59, \"on_option_id\":[]}, {\"question_id\": 60, \"on_option_id\":[]}, {\"question_id\": 61, \"on_option_id\":[]}, {\"question_id\": 62, \"on_option_id\":[{\"id\": 343, \"question_id\": 63, \"on_option_id\": [{\"id\": 346, \"question_id\": 64, \"on_option_id\":[]}, {\"id\": 347, \"question_id\": 64, \"on_option_id\":[]}, {\"id\": 348, \"question_id\": 64, \"on_option_id\":[]}]},{\"id\": 344, \"question_id\": 63, \"on_option_id\": [{\"id\": 346, \"question_id\": 64, \"on_option_id\":[]},{\"id\": 347, \"question_id\": 64, \"on_option_id\":[]},{\"id\": 348, \"question_id\": 64, \"on_option_id\":[]}]}]}, {\"question_id\": 65, \"on_option_id\":[]}, {\"question_id\": 108, \"on_option_id\":[]}, {\"question_id\": 66, \"on_option_id\":[]}, {\"question_id\": 67, \"on_option_id\":[]}, {\"question_id\": 68, \"on_option_id\":[]}, {\"question_id\": 69, \"on_option_id\":[]}, {\"question_id\": 70, \"on_option_id\":[]}, {\"question_id\": 71, \"on_option_id\":[]}, {\"question_id\": 72, \"on_option_id\":[]}, {\"question_id\": 73, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 19;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[]},{\"question_id\": 75, \"on_option_id\":[]}, {\"question_id\": 76, \"on_option_id\":[]}, {\"question_id\": 77, \"on_option_id\":[]}, {\"question_id\": 78, \"on_option_id\":[]}, {\"question_id\": 79, \"on_option_id\":[]}, {\"question_id\": 80, \"on_option_id\":[]}, {\"question_id\": 81, \"on_option_id\":[]}, {\"question_id\": 82, \"on_option_id\":[]}, {\"question_id\": 83, \"on_option_id\":[]}, {\"question_id\": 84, \"on_option_id\":[]}, {\"question_id\": 85, \"on_option_id\":[]}, {\"question_id\": 86, \"on_option_id\":[]}, {\"question_id\": 87, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 20;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[]},{\"question_id\": 89, \"on_option_id\":[]}, {\"question_id\": 90, \"on_option_id\":[]}, {\"question_id\": 91, \"on_option_id\":[]}, {\"question_id\": 92, \"on_option_id\":[]}, {\"question_id\": 109, \"on_option_id\":[]}, {\"question_id\": 93, \"on_option_id\":[]}, {\"question_id\": 94, \"on_option_id\":[]}, {\"question_id\": 95, \"on_option_id\":[]}, {\"question_id\": 96, \"on_option_id\":[]}, {\"question_id\": 97, \"on_option_id\":[]}, {\"question_id\": 98, \"on_option_id\":[]}, {\"question_id\": 99, \"on_option_id\":[]}, {\"question_id\": 100, \"on_option_id\":[]}, {\"question_id\": 101, \"on_option_id\":[]}, {\"question_id\": 102, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 21;

--- Change option text for specific countries ---
ALTER TABLE `option_translation` ADD `for_countries` VARCHAR(255) NULL AFTER `id`, ADD `not_for_countries` VARCHAR(255) NULL AFTER `for_countries`;
UPDATE option_translation set for_countries='101' where option_id=15;
UPDATE `option_translation` SET `not_for_countries` = '0' WHERE `for_countries` = '101' and option_id=15;

INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) VALUES (0, NULL, '101', '15', '1', 'my ethnicity or religion', NULL, '1'), (0, NULL, '101', '15', '42', 'मेरा धर्म और जाति', NULL, '0'), (0, NULL, '101', '15', '76', 'माझा धर्म आणि जात', NULL, '0'), (0, NULL, '101', '15', '77', 'kaum, suku, agama dan kasta saya ', NULL, '0');

--- Remove Caste question for outside India ---
UPDATE `questions` SET `tags` = 'caste' WHERE `questions`.`id` = 14;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[], \"for_countries\":[101]},{\"question_id\": 15, \"on_option_id\":[]}, {\"question_id\": 16, \"on_option_id\":[]}, {\"question_id\": 17, \"on_option_id\":[]}, {\"question_id\": 18, \"on_option_id\":[]}, {\"question_id\": 19, \"on_option_id\":[]}, {\"question_id\": 20, \"on_option_id\":[]}, {\"question_id\": 21, \"on_option_id\":[]}, {\"question_id\": 22, \"on_option_id\":[]}, {\"question_id\": 23, \"on_option_id\":[]}, {\"question_id\": 24, \"on_option_id\":[]}, {\"question_id\": 25, \"on_option_id\":[]}, {\"question_id\": 26, \"on_option_id\":[]}, {\"question_id\": 27, \"on_option_id\":[]}, {\"question_id\": 28, \"on_option_id\":[]}, {\"question_id\": 30, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 17;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[], \"for_countries\":[101]},{\"question_id\": 31, \"on_option_id\":[]}, {\"question_id\": 32, \"on_option_id\":[]}, {\"question_id\": 33, \"on_option_id\":[]}, {\"question_id\": 34, \"on_option_id\":[]}, {\"question_id\": 35, \"on_option_id\":[]}, {\"question_id\": 36, \"on_option_id\":[{\"id\": 188,\"question_id\": 37, \"on_option_id\": [{\"question_id\": 38, \"on_option_id\": [{\"question_id\": 39, \"on_option_id\": []}]}]},{\"id\": 189,\"question_id\": 37, \"on_option_id\": [{\"question_id\": 38, \"on_option_id\": [{\"question_id\": 39, \"on_option_id\": []}]}]},{\"id\": 190,\"question_id\": 37, \"on_option_id\": [{\"question_id\": 38, \"on_option_id\": [{\"question_id\": 39, \"on_option_id\": []}]}]}]}, {\"question_id\": 40, \"on_option_id\":[{\"id\": 201, \"question_id\": 41, \"on_option_id\": []}]}, {\"question_id\": 42, \"on_option_id\":[]}, {\"question_id\": 43, \"on_option_id\":[]}, {\"question_id\": 44, \"on_option_id\":[]}, {\"question_id\": 45, \"on_option_id\":[]}, {\"question_id\": 46, \"on_option_id\":[]},{\"question_id\": 47, \"on_option_id\":[]},{\"question_id\": 48, \"on_option_id\":[]},{\"question_id\": 49, \"on_option_id\":[]},{\"question_id\": 50, \"on_option_id\":[]},{\"question_id\": 51, \"on_option_id\":[]},{\"question_id\": 52, \"on_option_id\":[]},{\"question_id\": 53, \"on_option_id\":[]},{\"question_id\": 54, \"on_option_id\":[]},{\"question_id\": 55, \"on_option_id\":[]},{\"question_id\": 56, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 18;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[], \"for_countries\":[101]},{\"question_id\": 58, \"on_option_id\":[]}, {\"question_id\": 59, \"on_option_id\":[]}, {\"question_id\": 60, \"on_option_id\":[]}, {\"question_id\": 61, \"on_option_id\":[]}, {\"question_id\": 62, \"on_option_id\":[{\"id\": 343, \"question_id\": 63, \"on_option_id\": [{\"id\": 346, \"question_id\": 64, \"on_option_id\":[]}, {\"id\": 347, \"question_id\": 64, \"on_option_id\":[]}, {\"id\": 348, \"question_id\": 64, \"on_option_id\":[]}]},{\"id\": 344, \"question_id\": 63, \"on_option_id\": [{\"id\": 346, \"question_id\": 64, \"on_option_id\":[]},{\"id\": 347, \"question_id\": 64, \"on_option_id\":[]},{\"id\": 348, \"question_id\": 64, \"on_option_id\":[]}]}]}, {\"question_id\": 65, \"on_option_id\":[]}, {\"question_id\": 108, \"on_option_id\":[]}, {\"question_id\": 66, \"on_option_id\":[]}, {\"question_id\": 67, \"on_option_id\":[]}, {\"question_id\": 68, \"on_option_id\":[]}, {\"question_id\": 69, \"on_option_id\":[]}, {\"question_id\": 70, \"on_option_id\":[]}, {\"question_id\": 71, \"on_option_id\":[]}, {\"question_id\": 72, \"on_option_id\":[]}, {\"question_id\": 73, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 19;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[], \"for_countries\":[101]},{\"question_id\": 75, \"on_option_id\":[]}, {\"question_id\": 76, \"on_option_id\":[]}, {\"question_id\": 77, \"on_option_id\":[]}, {\"question_id\": 78, \"on_option_id\":[]}, {\"question_id\": 79, \"on_option_id\":[]}, {\"question_id\": 80, \"on_option_id\":[]}, {\"question_id\": 81, \"on_option_id\":[]}, {\"question_id\": 82, \"on_option_id\":[]}, {\"question_id\": 83, \"on_option_id\":[]}, {\"question_id\": 84, \"on_option_id\":[]}, {\"question_id\": 85, \"on_option_id\":[]}, {\"question_id\": 86, \"on_option_id\":[]}, {\"question_id\": 87, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 20;

UPDATE `logic_combinations` SET `comb_json` = '[{\"question_id\": 11, \"on_option_id\":[]},{\"question_id\": 12, \"on_option_id\":[]},{\"question_id\": 13, \"on_option_id\":[]},{\"question_id\": 14, \"on_option_id\":[], \"for_countries\":[101]},{\"question_id\": 89, \"on_option_id\":[]}, {\"question_id\": 90, \"on_option_id\":[]}, {\"question_id\": 91, \"on_option_id\":[]}, {\"question_id\": 92, \"on_option_id\":[]}, {\"question_id\": 109, \"on_option_id\":[]}, {\"question_id\": 93, \"on_option_id\":[]}, {\"question_id\": 94, \"on_option_id\":[]}, {\"question_id\": 95, \"on_option_id\":[]}, {\"question_id\": 96, \"on_option_id\":[]}, {\"question_id\": 97, \"on_option_id\":[]}, {\"question_id\": 98, \"on_option_id\":[]}, {\"question_id\": 99, \"on_option_id\":[]}, {\"question_id\": 100, \"on_option_id\":[]}, {\"question_id\": 101, \"on_option_id\":[]}, {\"question_id\": 102, \"on_option_id\":[]}]' WHERE `logic_combinations`.`id` = 21;

--- Add new religion options ---

INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '13', '6', '0', '0', NULL, '0', NULL);
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '1', 'Judaism', NULL, '1' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '42', 'यहूदी धर्म', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '77', 'Agama Yahudi', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '76', 'यहूदी धर्म', NULL, '0' from options order by id desc limit 1; 

INSERT INTO `options` (`id`, `question_id`, `order_no`, `is_main`, `parent_id`, `suboption_properties`, `suboption_of`, `tags`) VALUES (NULL, '13', '2', '0', '0', NULL, '0', NULL);
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '1', 'Buddhism', NULL, '1' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '42', 'बुद्ध धर्म', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '77', 'Agama Buddha', NULL, '0' from options order by id desc limit 1;
INSERT INTO `option_translation` (`id`, `for_countries`, `not_for_countries`, `option_id`, `lang_id`, `title`, `textbox_placeholder`, `is_default`) SELECT NULL, NULL, NULL, id, '76', 'बौद्ध धर्म', NULL, '0' from options order by id desc limit 1;

---puru new queries----
ALTER TABLE `cities` ADD `ngo_id` VARCHAR(255) NOT NULL DEFAULT '0' AFTER `country_code`;
UPDATE `cities` SET `ngo_id` = '3,4' WHERE `cities`.`id` = 1325873;
UPDATE `cities` SET `ngo_id` = '1' WHERE `cities`.`id` = 1247969;
UPDATE `cities` SET `ngo_id` = '2' WHERE `cities`.`id` = 1280520;
INSERT INTO `ngo` (`id`, `name`, `logo`) VALUES (NULL, 'Work for Equality Organisation', 'uploads/ngo/pune-ngo.png'), (NULL, 'Swayam Samajik Vikas Sanstha', 'uploads/ngo/satara-ngo.png');
INSERT INTO `ngo` (`id`, `name`, `logo`) VALUES (NULL, 'SNEHA', 'uploads/ngo/sneha-mumbai-ngo.png'), (NULL, 'CORO', 'uploads/ngo/coro-mumbai-ngo.png');
--- Order religion options ---
UPDATE `options` SET `order_no` = '1' WHERE `options`.`id` = 33;
UPDATE `options` SET `order_no` = '3' WHERE `options`.`id` = 31;
UPDATE `options` SET `order_no` = '4' WHERE `options`.`id` = 29;
UPDATE `options` SET `order_no` = '5' WHERE `options`.`id` = 30;
UPDATE `options` SET `order_no` = '7' WHERE `options`.`id` = 32;
--UPDATE `options` SET `order_no` = '6' WHERE `options`.`id` = 645;
--UPDATE `options` SET `order_no` = '2' WHERE `options`.`id` = 646;

--- Marathi translation ---
-- Import the translation sheet then continue with further queries
INSERT INTO `client_languages` (`client_id`, `language_id`) VALUES ('1', '76');
INSERT INTO `form_thankyou` (`id`, `form_id`, `lang_id`, `content`, `created_on`) VALUES (NULL, '3', '76', '{\r\n \"title\": \"आपला अहवाल सबमिट केल्याबद्दल धन्यवाद!\", \r\n \"content\": \"<p> आपला अनुभव आमच्याबरोबर सामायिक करून, आपण 3 इतरांना असे काहीतरी होण्यापासून प्रतिबंधित करण्यास मदत करत आहात. </p> <p> आपल्याकडे -५ -१० मिनिटे असल्यास लैंगिक हिंसाचारात भूमिका निभावणार्या इतर घटकांना समजून घेण्यासाठी आम्ही या घटनेबद्दल अधिक जाणून घेऊ इच्छितो. काही प्रश्नांची उत्तरे देऊन, आपण सुरक्षित शहरांची निर्मिती करण्यात मदत करा. </p>\", \r\n \"links\": [\r\n {\"title\": \"होय, मला मदत करायची आहे\", \"is_next\": true}, \r\n {\"title\": \"नाही , मी बाहेर पडायला आवडेल \", \"is_next\": false, \"redirect_url\": \"/help_pf\"}\r\n ]\r\n}', '2021-06-11 10:40:50'), (NULL, '4', '76', '{\r\n \"title\": \"\",\r\n \"content\": \"<p>शीर्षक आपला अहवाल सबमिट केल्या बद्धल धन्यवाद.</p>\",\r\n \"links\": [\r\n {\r\n \"title\": \"समाप्त\",\r\n \"is_next\": false,\r\n \"redirect_url\": \"/help_pf\"\r\n }\r\n ]\r\n}', '2021-06-11 10:40:50');
INSERT INTO `client_resources` (`id`, `is_default`, `admin_id`, `type`, `mode`, `client_id`, `country_id`, `lang_id`, `title`, `footer`, `created_on`, `updated_on`, `updated_by`) VALUES (NULL, '1', '1', 'consent', 'single', '1', '101', '76', 'संमती', '', '2020-11-30 13:23:16', '2020-11-30 13:23:16', NULL);
INSERT INTO `client_resource_contents` (`id`, `order_no`, `content_for`, `client_resource_id`, `title`, `content`) VALUES (NULL, '1', 'web', '28', '', '<div class=\"text mx-auto shareIncident\"><p style=\"text-align:justify;\">एखाद्याचे आघातजन्य अनुभव आठवणे कठीण आहे हे आम्हास समजले आहे. आपण कधीही अस्वस्थ असल्यास, जाणून घ्या की आपण बाहेर पडू शकता. आपण सबमिट बटणावर दाबा नसल्यास आपला डेटा जतन केला जाणार नाही.</p><p style=\"text-align:justify;\">आपण आपला अनुभव निनावीपणे सामायिक करत असलात तरी आम्ही आपल्या अनुभवाची माहिती आमच्या गर्दीच्या माहितीच्या डेटाबेसमध्ये समाविष्ट करण्यासाठी आपल्या संमतीची आवश्यकता आहे.</p><div class=\"proceedError\"></div></div>');
INSERT INTO `client_resources` (`id`, `is_default`, `admin_id`, `type`, `mode`, `client_id`, `country_id`, `lang_id`, `title`, `footer`, `created_on`, `updated_on`, `updated_by`) VALUES (NULL, '1', '1', 'incident_desc', 'single', '1', '101', '76', 'Incident Description', '', '2020-11-30 18:53:16', '2020-12-09 08:16:26', '1');
INSERT INTO `client_resource_contents` (`id`, `order_no`, `content_for`, `client_resource_id`, `title`, `content`) VALUES (NULL, '1', 'web', '29', '', '<p>23000+ लोकांमध्ये सामील व्हा ज्यांनी सार्वजनिक ठिकाणे सुरक्षित करण्यासाठी त्यांचे अनुभव शेअर केले आहेत. तुमचे अनुभव शेअर करणे आम्हाला नमुने ओळखण्यास आणि सुरक्षित जागा तयार करण्यात मदत करते. निराकरणे शोधण्यासाठी आणि आमच्या नागरी आणि पोलिस अधिका policies्यांना चांगली धोरणे आणि पायाभूत सुविधा उपलब्ध करुन देण्यास जबाबदार ठेवण्यासाठी आमच्या समुदायांना गुंतवून ठेवण्यासाठी माहितीचे विश्लेषण केले जाते. तुमची माहिती निनावी राहते.</p>');
INSERT INTO `client_resources` (`id`, `is_default`, `admin_id`, `type`, `mode`, `client_id`, `country_id`, `lang_id`, `title`, `footer`, `created_on`, `updated_on`, `updated_by`) VALUES (NULL, '1', '1', 'safetytip_desc', 'single', '1', '101', '76', 'Safety Tip Description', '', '2020-11-30 18:53:16', '2020-11-30 18:53:16', NULL);
INSERT INTO `client_resource_contents` (`id`, `order_no`, `content_for`, `client_resource_id`, `title`, `content`) VALUES (NULL, '1', 'web', '30', '', 'तुम्हाला संभाव्य क्लेशकारक अनुभवातून मार्ग सापडला आहे का? आपण आपल्या शहराद्वारे सुरक्षितपणे प्रवास करण्याचे मार्ग ओळखले आहेत? आपल्या सुरक्षिततेसाठी आपण काय करता ते आम्हाला सांगा जेणेकरुन इतरही ते करु शकतील.');
