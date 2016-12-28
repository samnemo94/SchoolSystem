ALTER TABLE `categories`
  ADD `showing_parent` SMALLINT NOT NULL
  AFTER `category_title`;

UPDATE categories
SET showing_parent = 1;
