CREATE TABLE `languages` (
  `language_id`   INT(11)      NOT NULL AUTO_INCREMENT,
  `language_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`language_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `categories` (
  `category_id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `parent_id`      INT(11)      NOT NULL,
  `category_title` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `menus` (
  `menu_id`     INT(11)      NOT NULL AUTO_INCREMENT,
  `parent_id`   INT(11)               DEFAULT NULL,
  `category_id` INT(11)      NOT NULL,
  `item_id`     INT(11)               DEFAULT NULL,
  `menu_title`  VARCHAR(255) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `parent_id` (`parent_id`),
  KEY `category_id` (`category_id`),
  KEY `item_id` (`item_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `menu_language` (
  `menu_language_id` INT(11)      NOT NULL AUTO_INCREMENT,
  `menu_id`          INT(11)      NOT NULL,
  `language_id`      INT(11)      NOT NULL,
  `title`            VARCHAR(255) NOT NULL,
  PRIMARY KEY (`menu_language_id`),
  KEY `menu_id` (`menu_id`),
  KEY `language_id` (`language_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

CREATE TABLE `items` (
  `item_id`     INT(11)      NOT NULL AUTO_INCREMENT,
  `item_title`  VARCHAR(255) NOT NULL,
  `category_id` INT(11)      NOT NULL,
  `created_by`  INT(11)      NOT NULL,
  `created_at`  TIMESTAMP    NOT NULL,
  `updated_by`  INT(11)      NOT NULL,
  `updated_at`  TIMESTAMP    NOT NULL,
  `deleted_by`  INT(11)               DEFAULT NULL,
  `deleted_at`  TIMESTAMP    NULL     DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `menus` ADD `menu_position` ENUM('top', 'right', 'left', 'bottom') NOT NULL
AFTER `category_id`;

CREATE TABLE `item_language` (
  `item_language_id`       INT(11)      NOT NULL AUTO_INCREMENT,
  `item_id`                INT(11)      NOT NULL,
  `language_id`            INT(11)      NOT NULL,
  `item_title`             VARCHAR(255) NOT NULL,
  `item_description`       TEXT,
  `item_short_description` TEXT,
  `item_image`             VARCHAR(255)          DEFAULT NULL,
  PRIMARY KEY (`item_language_id`),
  KEY `item_id` (`item_id`),
  KEY `language_id` (`language_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `categories` ADD FOREIGN KEY (`parent_id`) REFERENCES `school_system`.`categories` (`category_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE `items` ADD FOREIGN KEY (`category_id`) REFERENCES `school_system`.`categories` (`category_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `items` ADD FOREIGN KEY (`created_by`) REFERENCES `school_system`.`admin` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `items` ADD FOREIGN KEY (`updated_by`) REFERENCES `school_system`.`admin` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `items` ADD FOREIGN KEY (`deleted_by`) REFERENCES `school_system`.`admin` (`id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE `item_language` ADD FOREIGN KEY (`item_id`) REFERENCES `school_system`.`items` (`item_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `item_language` ADD FOREIGN KEY (`language_id`) REFERENCES `school_system`.`languages` (`language_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE `menus` ADD FOREIGN KEY (`parent_id`) REFERENCES `school_system`.`menus` (`menu_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `menus` ADD FOREIGN KEY (`category_id`) REFERENCES `school_system`.`categories` (`category_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `menus` ADD FOREIGN KEY (`item_id`) REFERENCES `school_system`.`items` (`item_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE `menu_language` ADD FOREIGN KEY (`menu_id`) REFERENCES `school_system`.`menus` (`menu_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;
ALTER TABLE `menu_language` ADD FOREIGN KEY (`language_id`) REFERENCES `school_system`.`languages` (`language_id`)
  ON DELETE RESTRICT
  ON UPDATE RESTRICT;

ALTER TABLE `categories` CHANGE `parent_id` `parent_id` INT(11) NULL;

ALTER TABLE `items` CHANGE `category_id` `category_id` INT(11) NULL;

