ALTER TABLE `menus` ADD `is_private` SMALLINT NOT NULL DEFAULT '1' AFTER `menu_for`;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 29;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 28;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 27;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 26;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 25;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 24;
UPDATE `menus` SET `is_private` = '0' WHERE `menus`.`menu_id` = 23;

