-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2016 at 04:05 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_sys`
--
CREATE DATABASE IF NOT EXISTS `school_sys` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `school_sys`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
  (1, 1, 'admin', 'd7zDRRjBYSwgOyH1ivA4Z2RRY9VdeYS2', '$2y$13$dvufe8cuRaUQDPXAKUHHve.xkWGH35IRHtBxZty.SPfeb0wZCXMAq', NULL, 'admin@admin.admin', 10, 1476382013, 1476382013),
  (2, 1, 'admin1', 'd7zDRRjBYSwgOyH1ivA4Z2RRY9VdeYS2', '$2y$13$dvufe8cuRaUQDPXAKUHHve.xkWGH35IRHtBxZty.SPfeb0wZCXMAq', NULL, 'admi1n@admin.admin', 10, 1476382013, 1476382013);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `category_title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted` smallint(6) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `modified_by` enum('admin','user') NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_title` (`category_title`),
  KEY `parent_id` (`parent_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `category_title`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted`, `deleted_at`, `deleted_by`, `modified_by`) VALUES
  (2, NULL, 'faculty', '2016-11-22 22:00:13', 1, '2016-11-22 22:00:13', 1, 0, NULL, NULL, 'admin'),
  (3, NULL, 'study_year', '2016-11-22 22:01:09', 1, '2016-11-22 22:01:09', 1, 0, NULL, NULL, 'admin'),
  (4, NULL, 'subject', '2016-11-22 22:01:09', 1, '2016-11-22 22:01:09', 1, 0, NULL, NULL, 'admin'),
  (6, 4, 'lesson', '2016-11-28 03:13:31', 1, '2016-11-28 03:13:31', 1, 0, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
CREATE TABLE IF NOT EXISTS `fields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `field_type` enum('varchar','text','int','double','date','time','date_time','image','file','foreign_key') NOT NULL,
  `fk_table` varchar(255) DEFAULT NULL,
  `has_translate` smallint(6) NOT NULL,
  PRIMARY KEY (`field_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`field_id`, `field_title`, `category_id`, `field_type`, `fk_table`, `has_translate`) VALUES
  (1, 'title', 2, 'varchar', '', 1),
  (2, 'description', 2, 'text', '', 1),
  (3, 'image', 2, 'image', '', 0),
  (4, 'title', 3, 'varchar', '', 1),
  (5, 'description', 3, 'text', '', 1),
  (6, 'description', 4, 'text', '', 1),
  (7, 'title', 4, 'varchar', '', 1),
  (8, 'image', 4, 'image', '', 0),
  (9, 'faculty', 3, 'foreign_key', 'faculty', 0),
  (10, 'study_year', 4, 'foreign_key', 'study_year', 0),
  (12, 'title', 6, 'varchar', '', 1),
  (13, 'description', 6, 'text', '', 1),
  (14, 'image', 6, 'image', '', 0),
  (15, 'subject', 6, 'foreign_key', '4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted` smallint(6) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `modified_by` enum('admin','user') NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted`, `deleted_at`, `deleted_by`, `modified_by`) VALUES
  (1, 2, '2016-11-22 22:21:56', 1, '2016-11-22 22:21:56', 1, 0, NULL, NULL, 'admin'),
  (2, 2, '2016-11-22 22:22:15', 1, '2016-11-22 22:22:15', 1, 0, NULL, NULL, 'admin'),
  (3, 2, '2016-11-22 22:22:23', 1, '2016-11-22 22:22:23', 1, 0, NULL, NULL, 'admin'),
  (6, 3, '2016-11-23 21:01:53', 1, '2016-11-23 21:01:53', 1, 0, NULL, NULL, 'admin'),
  (7, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (8, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (9, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (10, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (11, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (12, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (13, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (14, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (15, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (16, 3, '2016-11-23 21:03:02', 1, '2016-11-23 21:03:02', 1, 0, NULL, NULL, 'admin'),
  (17, 3, '2016-11-23 21:03:03', 1, '2016-11-23 21:03:03', 1, 0, NULL, NULL, 'admin'),
  (18, 3, '2016-11-23 21:03:03', 1, '2016-11-23 21:03:03', 1, 0, NULL, NULL, 'admin'),
  (19, 3, '2016-11-23 21:03:03', 1, '2016-11-23 21:03:03', 1, 0, NULL, NULL, 'admin'),
  (20, 3, '2016-11-23 21:03:03', 1, '2016-11-23 21:03:03', 1, 0, NULL, NULL, 'admin'),
  (21, 3, '2016-11-23 21:03:03', 1, '2016-11-23 21:03:03', 1, 0, NULL, NULL, 'admin'),
  (22, 4, '2016-11-24 05:11:51', 1, '2016-11-24 05:11:51', 1, 0, NULL, NULL, 'admin'),
  (23, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (24, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (25, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (26, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (27, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (28, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (29, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (30, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (31, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (32, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (33, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (34, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (35, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (36, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (37, 4, '2016-11-24 05:12:10', 1, '2016-11-24 05:12:10', 1, 0, NULL, NULL, 'admin'),
  (41, 2, '2016-11-28 03:31:17', 1, '2016-11-28 01:38:12', 1, 1, '2016-11-28 13:38:12', 1, 'admin'),
  (42, 2, '2016-11-28 03:32:53', 1, '2016-11-28 03:32:53', 1, 0, NULL, NULL, 'admin'),
  (43, 2, '2016-11-28 13:41:25', 1, '2016-11-28 01:41:59', 1, 1, '2016-11-28 13:41:59', 1, 'admin'),
  (44, 2, '2016-11-28 13:41:54', 1, '2016-11-28 01:41:54', 1, 0, NULL, NULL, 'admin'),
  (45, 2, '2016-11-28 13:47:58', 1, '2016-11-28 01:47:58', 1, 0, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) NOT NULL,
  `language_code` varchar(2) NOT NULL,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `language_name`, `language_code`) VALUES
  (8, 'Arabic', 'ar'),
  (9, 'English', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `menu_position` enum('top','right','left','bottom') NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `parent_id` (`parent_id`),
  KEY `category_id` (`category_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `parent_id`, `category_id`, `menu_position`, `item_id`, `menu_title`) VALUES
  (1, NULL, 2, 'top', NULL, 'faculties '),
  (2, NULL, 3, 'top', NULL, 'study_years'),
  (3, NULL, 4, 'top', NULL, 'subjects'),
  (4, 1, NULL, 'top', 1, 'ite'),
  (5, 1, NULL, 'top', 2, 'mte'),
  (6, 1, NULL, 'top', 3, 'medicin'),
  (7, 4, NULL, 'top', 6, 'ite-1y'),
  (8, 4, NULL, 'top', 7, 'ite-2y'),
  (9, 4, NULL, 'top', 8, 'ite-3y'),
  (10, 4, NULL, 'top', 9, 'ite-4y'),
  (11, 4, NULL, 'top', 10, 'ite-5y'),
  (12, 5, NULL, 'top', 11, 'mte-1y'),
  (13, 5, NULL, 'top', 12, 'mte-2y'),
  (14, 5, NULL, 'top', 13, 'mte-3y'),
  (15, 5, NULL, 'top', 14, 'mte-4y'),
  (16, 5, NULL, 'top', 15, 'mte-5y'),
  (17, 6, NULL, 'top', 16, 'medicin-1y'),
  (18, 6, NULL, 'top', 17, 'medicin-2y'),
  (19, 6, NULL, 'top', 18, 'medicin-3y'),
  (20, 6, NULL, 'top', 19, 'medicin-4y'),
  (21, 6, NULL, 'top', 20, 'medicin-5y'),
  (22, 6, NULL, 'top', 21, 'medicin-6y');

-- --------------------------------------------------------

--
-- Table structure for table `menu_language`
--

DROP TABLE IF EXISTS `menu_language`;
CREATE TABLE IF NOT EXISTS `menu_language` (
  `menu_language_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_language_id`),
  KEY `menu_id` (`menu_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_language`
--

INSERT INTO `menu_language` (`menu_language_id`, `menu_id`, `language_id`, `title`) VALUES
  (1, 1, 8, 'الكليات'),
  (2, 1, 9, 'Faculties'),
  (3, 2, 8, 'السنوات الدراسية'),
  (4, 2, 9, 'Study Years'),
  (5, 3, 8, 'المواد الدراسية'),
  (6, 3, 9, 'Subjects'),
  (7, 4, 8, 'كلية الهندسة المعلوماتية'),
  (8, 4, 9, 'Faculity of Information Technology'),
  (9, 5, 8, 'كلية الهندسة المدنية'),
  (10, 5, 9, 'Faculity of Civil Engineering'),
  (11, 6, 8, 'كلية الطب البشري'),
  (12, 6, 9, 'Faculity of Medicin'),
  (13, 7, 8, 'السنة الأولى'),
  (14, 7, 9, 'First Year'),
  (15, 8, 8, 'السنة الثانية'),
  (16, 8, 9, 'Second Year'),
  (17, 9, 8, 'السنة الثالثة'),
  (18, 9, 9, 'Third Year'),
  (19, 10, 8, 'السنة الرابعة'),
  (20, 10, 9, 'Forth Year'),
  (21, 11, 8, 'السنة الخامسة'),
  (22, 11, 9, 'Fifth Year'),
  (23, 12, 8, 'لسنة الأولى'),
  (24, 12, 9, 'First Year'),
  (25, 13, 8, 'السنة الثانية'),
  (26, 13, 9, 'Second Year'),
  (27, 14, 8, 'السنة الثالثة'),
  (28, 14, 9, 'Third Year'),
  (29, 15, 8, 'السنة الرابعة'),
  (30, 15, 9, 'Forth Year'),
  (31, 16, 8, 'السنة الخامسة'),
  (32, 16, 9, 'Fifth Year'),
  (33, 17, 8, 'لسنة الأولى'),
  (34, 17, 9, 'First Year'),
  (35, 18, 8, 'السنة الثانية'),
  (36, 18, 9, 'Second Year'),
  (37, 19, 8, 'السنة الثالثة'),
  (38, 19, 9, 'Third Year'),
  (39, 20, 8, 'السنة الرابعة'),
  (40, 20, 9, 'Forth Year'),
  (41, 21, 8, 'السنة الخامسة'),
  (42, 21, 9, 'Fifth Year'),
  (43, 22, 8, 'السنة السادسة'),
  (44, 22, 9, 'Sixth Year');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
  ('m000000_000000_base', 1476381334),
  ('m130524_201442_init', 1476381337);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_page` varchar(255) NOT NULL,
  `permission_action` varchar(255) NOT NULL,
  `permission_description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '1974-12-31 22:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '1974-12-31 22:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
  (1, 'admin', 0, '2016-11-05 12:23:07', 0, '1974-12-31 22:00:00', NULL, NULL),
  (2, 'admin1', 1, '2016-11-06 15:11:03', 1, '1974-12-31 22:00:00', NULL, NULL),
  (3, 'User', 1, '2016-11-14 17:57:21', 1, '1974-12-31 22:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

DROP TABLE IF EXISTS `role_perm`;
CREATE TABLE IF NOT EXISTS `role_perm` (
  `role_perm_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '1974-12-31 22:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_perm_id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
  (2, 1, 'sam', 'VKFTcXrSZcPnUNZjj2QugIZLBORJ04Dq', '$2y$13$43vfd24zJ10DqS30e1JE.eevodPO8Ge/fPoX4SEdEd9GKl6A6xfju', NULL, 'sam@sam.sam', 10, 1476382691, 1476382691);

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

DROP TABLE IF EXISTS `values`;
CREATE TABLE IF NOT EXISTS `values` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`value_id`),
  KEY `item_id` (`item_id`),
  KEY `field_id` (`field_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `values`
--

INSERT INTO `values` (`value_id`, `item_id`, `field_id`, `language_id`, `value`) VALUES
  (2, 1, 1, 8, 'كلية الهندسة المعلوماتية'),
  (3, 1, 1, 9, 'Faculty Of Information Technology'),
  (4, 1, 2, 8, 'شرح كلية الهندسة المعلوماتية'),
  (5, 1, 2, 9, 'Description About IT'),
  (6, 1, 3, NULL, '../../common/web/uploads/fit.jpg'),
  (7, 2, 1, 8, 'كلية الهندسة المدنية'),
  (8, 2, 1, 9, 'Faculty Of Civil Engineering'),
  (9, 2, 2, 8, 'شرح كلية الهندسة المدنية'),
  (10, 2, 2, 9, 'Description About CE'),
  (11, 2, 3, NULL, '../../common/web/uploads/19-2807.jpg'),
  (12, 3, 1, 8, 'كلية الطب البشري'),
  (13, 3, 1, 9, 'Faculty Of Midicin'),
  (14, 3, 2, 8, 'شرح كلية الطب البشري'),
  (15, 3, 2, 9, 'Description About HM'),
  (16, 3, 3, NULL, '../../common/web/uploads/medicine.jpg'),
  (17, 6, 4, 8, 'السنة الأولى'),
  (18, 6, 4, 9, 'First Year'),
  (19, 6, 5, 8, 'سنة تأسيسية بالمواد الأساسية'),
  (20, 6, 5, 9, 'Foundation Year'),
  (21, 6, 9, NULL, '1'),
  (22, 7, 4, 8, 'السنة الثانية'),
  (23, 7, 4, 9, 'Second Year'),
  (24, 7, 5, 8, 'سنة تأسيسية بالمواد الأساسية 2'),
  (25, 7, 5, 9, 'Foundation Year 2'),
  (26, 7, 9, NULL, '1'),
  (27, 8, 4, 8, 'السنة الثالثة'),
  (28, 8, 4, 9, 'Third Year'),
  (29, 8, 5, 8, 'سنة تأسيسية بالمواد الأساسية 3'),
  (30, 8, 5, 9, 'Foundation Year 3'),
  (31, 8, 9, NULL, '1'),
  (32, 9, 4, 8, 'السنة الرابعة'),
  (33, 9, 4, 9, 'Forth Year'),
  (34, 9, 5, 8, 'سنة تأسيسية بالمواد الأساسية 4'),
  (35, 9, 5, 9, 'Foundation Year 4'),
  (36, 9, 9, NULL, '1'),
  (37, 10, 4, 8, 'السنة الخامسة'),
  (38, 10, 4, 9, 'Fifth Year'),
  (39, 10, 5, 8, 'سنة تأسيسية بالمواد الأساسية 5'),
  (40, 10, 5, 9, 'Foundation Year 5'),
  (41, 10, 9, NULL, '1'),
  (42, 11, 4, 8, 'السنة الأولى'),
  (43, 11, 4, 9, 'First Year'),
  (44, 11, 5, 8, 'سنة تأسيسية بالمواد الأساسية'),
  (45, 11, 5, 9, 'Foundation Year'),
  (46, 11, 9, NULL, '2'),
  (47, 12, 4, 8, 'السنة الثانية'),
  (48, 12, 4, 9, 'Second Year'),
  (49, 12, 5, 8, 'سنة تأسيسية بالمواد الأساسية 2'),
  (50, 12, 5, 9, 'Foundation Year 2'),
  (51, 12, 9, NULL, '2'),
  (52, 13, 4, 8, 'السنة الثالثة'),
  (53, 13, 4, 9, 'Third Year'),
  (54, 13, 5, 8, 'سنة تأسيسية بالمواد الأساسية 3'),
  (55, 13, 5, 9, 'Foundation Year 3'),
  (56, 13, 9, NULL, '2'),
  (57, 14, 4, 8, 'السنة الرابعة'),
  (58, 14, 4, 9, 'Forth Year'),
  (59, 14, 5, 8, 'سنة تأسيسية بالمواد الأساسية 4'),
  (60, 14, 5, 9, 'Foundation Year 4'),
  (61, 14, 9, NULL, '2'),
  (62, 15, 4, 8, 'السنة الخامسة'),
  (63, 15, 4, 9, 'Fifth Year'),
  (64, 15, 5, 8, 'سنة تأسيسية بالمواد الأساسية 5'),
  (65, 15, 5, 9, 'Foundation Year 5'),
  (66, 15, 9, NULL, '2'),
  (67, 16, 4, 8, 'السنة الأولى'),
  (68, 16, 4, 9, 'First Year'),
  (69, 16, 5, 8, 'سنة تأسيسية بالمواد الأساسية'),
  (70, 16, 5, 9, 'Foundation Year'),
  (71, 16, 9, NULL, '3'),
  (72, 17, 4, 8, 'السنة الثانية'),
  (73, 17, 4, 9, 'Second Year'),
  (74, 17, 5, 8, 'سنة تأسيسية بالمواد الأساسية 2'),
  (75, 17, 5, 9, 'Foundation Year 2'),
  (76, 17, 9, NULL, '3'),
  (77, 18, 4, 8, 'السنة الثالثة'),
  (78, 18, 4, 9, 'Third Year'),
  (79, 18, 5, 8, 'سنة تأسيسية بالمواد الأساسية 3'),
  (80, 18, 5, 9, 'Foundation Year 3'),
  (81, 18, 9, NULL, '3'),
  (82, 19, 4, 8, 'السنة الرابعة'),
  (83, 19, 4, 9, 'Forth Year'),
  (84, 19, 5, 8, 'سنة تأسيسية بالمواد الأساسية 4'),
  (85, 19, 5, 9, 'Foundation Year 4'),
  (86, 19, 9, NULL, '3'),
  (87, 20, 4, 8, 'السنة الخامسة'),
  (88, 20, 4, 9, 'Fifth Year'),
  (89, 20, 5, 8, 'سنة تأسيسية بالمواد الأساسية 5'),
  (90, 20, 5, 9, 'Foundation Year 5'),
  (91, 20, 9, NULL, '3'),
  (92, 21, 4, 8, 'السنة السادسة'),
  (93, 21, 4, 9, 'Sixth Year'),
  (94, 21, 5, 8, 'سنة تأسيسية بالمواد الأساسية 6'),
  (95, 21, 5, 9, 'Foundation Year 6'),
  (96, 21, 9, NULL, '3'),
  (97, 22, 6, 8, 'شرح موجز'),
  (98, 22, 6, 9, 'Short Description'),
  (99, 22, 7, 8, 'برمجة'),
  (100, 22, 7, 9, 'Programming'),
  (101, 22, 8, NULL, '../../common/web/uploads/ite-programming.png'),
  (102, 22, 10, NULL, '6'),
  (103, 23, 6, 8, 'شرح موجز'),
  (104, 23, 6, 9, 'Short Description'),
  (105, 23, 7, 8, 'ثقافة'),
  (106, 23, 7, 9, 'Culture'),
  (107, 23, 8, NULL, '../../common/web/uploads/ite-culture.png'),
  (108, 23, 10, NULL, '6'),
  (109, 24, 6, 8, 'شرح موجز'),
  (110, 24, 6, 9, 'Short Description'),
  (111, 24, 7, 8, 'عربي'),
  (112, 24, 7, 9, 'Arabic'),
  (113, 24, 8, NULL, '../../common/web/uploads/ite-arabic.png'),
  (114, 24, 10, NULL, '6'),
  (115, 25, 6, 8, 'شرح موجز'),
  (116, 25, 6, 9, 'Short Description'),
  (117, 25, 7, 8, 'خوارزميات'),
  (118, 25, 7, 9, 'Algorithms'),
  (119, 25, 8, NULL, '../../common/web/uploads/ite-algorithms.png'),
  (120, 25, 10, NULL, '7'),
  (121, 26, 6, 8, 'شرح موجز'),
  (122, 26, 6, 9, 'Short Description'),
  (123, 26, 7, 8, 'بنيان حواسيب'),
  (124, 26, 7, 9, 'Computer Architecture'),
  (125, 26, 8, NULL, '../../common/web/uploads/ite-computerarchitecture.png'),
  (126, 26, 10, NULL, '7'),
  (127, 27, 6, 8, 'شرح موجز'),
  (128, 27, 6, 9, 'Short Description'),
  (129, 27, 7, 8, 'حسابات علمية'),
  (130, 27, 7, 9, 'Scientific Calculations'),
  (131, 27, 8, NULL, '../../common/web/uploads/ite-scientificcalculations.png'),
  (132, 27, 10, NULL, '8'),
  (133, 28, 6, 8, 'شرح موجز'),
  (134, 28, 6, 9, 'Short Description'),
  (135, 28, 7, 8, 'أساسيات الشبكات'),
  (136, 28, 7, 9, 'Networking Basics'),
  (137, 28, 8, NULL, '../../common/web/uploads/ite-netwoorkingbasics.png'),
  (138, 28, 10, NULL, '8'),
  (139, 29, 6, 8, 'شرح موجز'),
  (140, 29, 6, 9, 'Short Description'),
  (141, 29, 7, 8, 'قواعد المعطيات'),
  (142, 29, 7, 9, 'Database'),
  (143, 29, 8, NULL, '../../common/web/uploads/ite-database.png'),
  (144, 29, 10, NULL, '9'),
  (145, 30, 6, 8, 'شرح موجز'),
  (146, 30, 6, 9, 'Short Description'),
  (147, 30, 7, 8, 'هندسة البرمجيات'),
  (148, 30, 7, 9, 'Software Engineering'),
  (149, 30, 8, NULL, '../../common/web/uploads/ite-softwareengineering.png'),
  (150, 30, 10, NULL, '9'),
  (151, 31, 6, 8, 'شرح موجز'),
  (152, 31, 6, 9, 'Short Description'),
  (153, 31, 7, 8, 'أمن نظم معلومات'),
  (154, 31, 7, 9, 'Information Security'),
  (155, 31, 8, NULL, '../../common/web/uploads/ite-informationsecurity.png'),
  (156, 31, 10, NULL, '10'),
  (157, 32, 6, 8, 'شرح موجز'),
  (158, 32, 6, 9, 'Short Description'),
  (159, 32, 7, 8, 'تطبيقات الانترنت'),
  (160, 32, 7, 9, 'Internet Applications'),
  (161, 32, 8, NULL, '../../common/web/uploads/ite-internetapplications.png'),
  (162, 32, 10, NULL, '10'),
  (163, 33, 6, 8, 'شرح موجز'),
  (164, 33, 6, 9, 'Short Description'),
  (165, 33, 7, 8, 'الجيولوجيا'),
  (166, 33, 7, 9, 'Geologia'),
  (167, 33, 8, NULL, '../../common/web/uploads/mte-geology.png'),
  (168, 33, 10, NULL, '11'),
  (169, 34, 6, 8, 'شرح موجز'),
  (170, 34, 6, 9, 'Short Description'),
  (171, 34, 7, 8, 'علم البلوك'),
  (172, 34, 7, 9, 'Block Science'),
  (173, 34, 8, NULL, '../../common/web/uploads/mte-block.png'),
  (174, 34, 10, NULL, '12'),
  (175, 35, 6, 8, 'شرح موجز'),
  (176, 35, 6, 9, 'Short Description'),
  (177, 35, 7, 8, 'الأبنية'),
  (178, 35, 7, 9, 'Buildings'),
  (179, 35, 8, NULL, '../../common/web/uploads/mte-buildings.png'),
  (180, 35, 10, NULL, '13'),
  (181, 36, 6, 8, 'شرح موجز'),
  (182, 36, 6, 9, 'Short Description'),
  (183, 36, 7, 8, 'القطارات'),
  (184, 36, 7, 9, 'Trains'),
  (185, 36, 8, NULL, '../../common/web/uploads/mte-trains.png'),
  (186, 36, 10, NULL, '14'),
  (187, 37, 6, 8, 'شرح موجز'),
  (188, 37, 6, 9, 'Short Description'),
  (189, 37, 7, 8, 'المطارات'),
  (190, 37, 7, 9, 'Airports'),
  (191, 37, 8, NULL, '../../common/web/uploads/mte-airports.png'),
  (192, 37, 10, NULL, '15'),
  (199, 41, 1, 8, 'يربسيبسي'),
  (200, 41, 2, 8, 'يسشبسيبسيب'),
  (201, 41, 3, 8, 'stock-photo-113916201.jpg'),
  (202, 42, 1, 8, 'كلية جديدة'),
  (203, 42, 2, 8, 'وصف طويل جدا للكلية الجديدة'),
  (204, 42, 3, 8, '../../common/web/uploads/P_20161121_135837.jpg'),
  (205, 44, 1, 8, 'كلية جديدة ثانية'),
  (206, 44, 2, 8, 'وصف كلية جديدة ثانية'),
  (207, 44, 3, 8, '../../common/web/uploads/speeeeed.png'),
  (208, 45, 1, 8, 'Sas'),
  (209, 45, 2, 8, 'DSdcsad'),
  (210, 45, 3, 8, '../../common/web/uploads/148034807814732232_520972304778345_3121256020441722779_n.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `fields`
--
ALTER TABLE `fields`
ADD CONSTRAINT `fields_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`menu_id`),
ADD CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
ADD CONSTRAINT `menus_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`);

--
-- Constraints for table `menu_language`
--
ALTER TABLE `menu_language`
ADD CONSTRAINT `menu_language_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`),
ADD CONSTRAINT `menu_language_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

--
-- Constraints for table `role_perm`
--
ALTER TABLE `role_perm`
ADD CONSTRAINT `role_perm_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
ADD CONSTRAINT `role_perm_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `values`
--
ALTER TABLE `values`
ADD CONSTRAINT `values_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
ADD CONSTRAINT `values_ibfk_3` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
