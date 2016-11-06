
-- ********** permissions table ************

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_page` varchar(255) NOT NULL,
  `permission_action` varchar(255) NOT NULL,
  `permission_description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- ******** role table ******** --

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;



-- ******* role_perm table ********--
CREATE TABLE `role_perm` (
  `role_perm_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role_perm`
--
ALTER TABLE `role_perm`
  ADD PRIMARY KEY (`role_perm_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role_perm`
--
ALTER TABLE `role_perm`
  MODIFY `role_perm_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `role_perm` ADD FOREIGN KEY (`role_id`) REFERENCES `school_system`.`role`(`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `role_perm` ADD FOREIGN KEY (`permission_id`) REFERENCES `school_system`.`permissions`(`permission_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;


--add role(admin and admin1)
INSERT INTO `role` (`role_id`, `role_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'admin', 0, '2016-11-05 14:23:07', 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 'admin1', 1, '2016-11-06 17:11:03', 1, '0000-00-00 00:00:00', NULL, NULL);


--add permissions
INSERT INTO `permissions` (`permission_id`, `permission_page`, `permission_action`, `permission_description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'menus', 'create', 'create menu', 0, '2016-11-06 15:32:13', 0, '0000-00-00 00:00:00', NULL, NULL),
(2, 'categories', 'create', 'create categories', 0, '2016-11-05 14:29:52', 0, '0000-00-00 00:00:00', NULL, NULL),
(5, 'items', 'create', 'create item ', 1, '2016-11-05 18:14:19', 1, '0000-00-00 00:00:00', NULL, NULL),
(6, 'menus', 'index', 'can show all permissions', 1, '2016-11-06 15:32:22', 1, '0000-00-00 00:00:00', NULL, NULL),
(10, 'menus', 'update', 'update a menu', 1, '2016-11-06 16:01:38', 1, '0000-00-00 00:00:00', NULL, NULL),
(11, 'categories', 'index', 'show all categoies', 1, '2016-11-06 16:02:45', 1, '0000-00-00 00:00:00', NULL, NULL),
(12, 'items', 'index', 'show all items', 1, '2016-11-06 16:03:30', 1, '0000-00-00 00:00:00', NULL, NULL);


-- add role-perm
INSERT INTO `role_perm` (`role_perm_id`, `role_id`, `permission_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(11, 1, 1, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(12, 1, 2, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(13, 1, 5, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(14, 1, 6, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(15, 1, 10, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(16, 1, 11, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(17, 1, 12, 1, '2016-11-06 16:05:01', 1, '0000-00-00 00:00:00', NULL, NULL),
(18, 2, 5, 1, '2016-11-06 16:05:24', 1, '0000-00-00 00:00:00', NULL, NULL),
(19, 2, 12, 1, '2016-11-06 16:05:24', 1, '0000-00-00 00:00:00', NULL, NULL),
(21, 2, 11, 1, '2016-11-06 18:21:07', 1, '0000-00-00 00:00:00', NULL, NULL);


ALTER TABLE `user` ADD `role_id` INT(11) NOT NULL AFTER `id`, ADD INDEX (`role_id`);
ALTER TABLE `user` ADD FOREIGN KEY (`role_id`) REFERENCES `school_system`.`role`(`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `admin` ADD `role_id` INT(11) NOT NULL AFTER `id`, ADD INDEX (`role_id`);
ALTER TABLE `admin` ADD FOREIGN KEY (`role_id`) REFERENCES `school_system`.`role`(`role_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
INSERT INTO `admin` (`id`, `role_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES ('2', '2', 'admin1', 'd7zDRRjBYSwgOyH1ivA4Z2RRY9VdeYS2', '$2y$13$dvufe8cuRaUQDPXAKUHHve.xkWGH35IRHtBxZty.SPfeb0wZCXMAq', NULL, 'admin1@admin1.admin1', '10', '1476382013', '1476382013');


