



ALTER TABLE `fields` CHANGE `fk_table` `fk_table` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;


ALTER TABLE `values` DROP FOREIGN KEY `values_ibfk_2`;

ALTER TABLE `items` ADD FOREIGN KEY (`category_id`) REFERENCES `school_sys`.`categories`(`category_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;