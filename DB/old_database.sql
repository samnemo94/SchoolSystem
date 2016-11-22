-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2016 at 05:07 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_system`
--
CREATE DATABASE IF NOT EXISTS `school_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `school_system`;

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
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `category_title`) VALUES
(5, NULL, 'page'),
(6, NULL, 'main menu');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_title` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`item_id`),
  KEY `category_id` (`category_id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_title`, `category_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'about us', 5, 1, '2016-11-09 17:15:03', 1, '2016-11-09 17:15:03', NULL, NULL),
(2, 'contact us', 5, 1, '2016-11-09 17:17:37', 1, '2016-11-09 17:17:37', NULL, NULL),
(3, 'TTitem', 5, 1, '2016-11-14 19:18:49', 1, '2016-11-14 19:18:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_language`
--

DROP TABLE IF EXISTS `item_language`;
CREATE TABLE IF NOT EXISTS `item_language` (
  `item_language_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `item_title` varchar(255) NOT NULL,
  `item_description` text,
  `item_short_description` text,
  `item_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`item_language_id`),
  KEY `item_id` (`item_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_language`
--

INSERT INTO `item_language` (`item_language_id`, `item_id`, `language_id`, `item_title`, `item_description`, `item_short_description`, `item_image`) VALUES
(1, 1, 8, 'من نحن !', '<p><strong>نحن جماعة ما بيعلم فينا ولا حدا حتى نحنا ما منعرف حالنا<img alt="" src="https://fbcdn-photos-b-a.akamaihd.net/hphotos-ak-xtp1/v/t1.0-0/p206x206/15032884_990400754438872_5714725895147745778_n.jpg?oh=aaf4f0d69f219912f77be502db83c8d4&amp;oe=58CC39A1&amp;__gda__=1485240886_c47265c7147778c5cb6a57afa15dc570" style="border-style:solid; border-width:3px; float:right; height:206px; width:480px" /></strong></p>\r\n', 'نحن وما أدراك ما نحن', 'items_photos/11478729357.jpg'),
(2, 1, 9, 'About Us !', '<p>Hello&nbsp;<br />\r\nIt is me</p>\r\n', 'this short description describe short description', 'items_photos/21478760559.jpg'),
(3, 2, 8, 'اتصل بنا', '<p>أذا بدك تدق اتصل على الأرقام التالية:</p>\r\n\r\n<p>]سيش</p>\r\n\r\n<p>يشي</p>\r\n\r\n<p>312312</p>\r\n\r\n<p>234234<br />\r\n23423</p>\r\n\r\n<p>2342</p>\r\n', 'إذا بدك دق', 'items_photos/1478729451.png'),
(4, 2, 9, 'Contact Us', '<p>Please Contact us on this&nbsp;<a href="https://www.facebook.com/sam.nemo.505" onclick="window.open(this.href, '''', ''resizable=no,status=no,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no''); return false;">Link</a></p>\r\n\r\n<p>Contact 1: 26565616</p>\r\n\r\n<p>Contact 2: 65+5+62262</p>\r\n', '', 'items_photos/1478760832.jpg'),
(5, 3, 8, 'الورقة', '<p><img src="file:///C:\\Users\\like-\\AppData\\Local\\Temp\\msohtmlclip1\\01\\clip_image001.jpg" /> جامعة دمشق</p>\r\n\r\n<p>كلية الهندسة المعلوماتية</p>\r\n\r\n<p><strong><u>إلى من يهمه الأمر</u></strong></p>\r\n\r\n<p>إن ميكرو خط <strong><u>مزة فيلات غربية</u></strong> رقم \\ <strong><u>608951</u></strong> \\ والذي يقوده السائق \\ <strong><u>أحمد عنبره بن محمد خير</u></strong> \\ يقوم بنقل الطلاب الواردة أسمائهم و ذلك من الساعة <strong><u>7:30</u></strong> صباحاً وحتى الساعة <strong><u>4:00</u></strong> مساءً ضمن أيام الدوام الرسمي .</p>\r\n\r\n<p><strong><u>وعلى ذلك يرجى تسهيل مرور الطلاب للوصول في الوقت المناسب</u></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>الاسم</strong></p>\r\n\r\n<p><strong>السنة الدراسية</strong></p>\r\n\r\n<p><strong>الكلية</strong></p>\r\n\r\n<p><strong>1</strong></p>\r\n\r\n<p><strong>محمد سامي الناعمي</strong></p>\r\n\r\n<p><strong>الخامسة</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>2</strong></p>\r\n\r\n<p><strong>آلاء الشيخ</strong></p>\r\n\r\n<p><strong>الثالثة</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>3</strong></p>\r\n\r\n<p><strong>لجين مرمر</strong></p>\r\n\r\n<p><strong>الثالثة</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>4</strong></p>\r\n\r\n<p><strong>مزنة الخن</strong></p>\r\n\r\n<p><strong>الثالثة</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>5</strong></p>\r\n\r\n<p><strong>طارق شيخ الأرض</strong></p>\r\n\r\n<p><strong>الثالثة</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>6</strong></p>\r\n\r\n<p><strong>ريما مظلوم</strong></p>\r\n\r\n<p><strong>الثالثة</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>7</strong></p>\r\n\r\n<p><strong>رهف النسر</strong></p>\r\n\r\n<p><strong>الثانية</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>8</strong></p>\r\n\r\n<p><strong>احمد شهاب</strong></p>\r\n\r\n<p><strong>الثانية</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>9</strong></p>\r\n\r\n<p><strong>محمد أنس الصعيدي</strong></p>\r\n\r\n<p><strong>الثانية</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>10</strong></p>\r\n\r\n<p><strong>دلال الحفار</strong></p>\r\n\r\n<p><strong>الثانية</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>11</strong></p>\r\n\r\n<p><strong>تمام مزهر</strong></p>\r\n\r\n<p><strong>الثانية</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>12</strong></p>\r\n\r\n<p><strong>بيان سقى</strong></p>\r\n\r\n<p><strong>الأولى</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>13</strong></p>\r\n\r\n<p><strong>فاطمة سيروان</strong></p>\r\n\r\n<p><strong>الأولى</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>14</strong></p>\r\n\r\n<p><strong>رؤى التكريتي</strong></p>\r\n\r\n<p><strong>الأولى</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>15</strong></p>\r\n\r\n<p><strong>شذا البودي</strong></p>\r\n\r\n<p><strong>الأولى</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p><strong>16</strong></p>\r\n\r\n<p><strong>زينب عيسى</strong></p>\r\n\r\n<p><strong>الأولى</strong></p>\r\n\r\n<p><strong>الهندسة المعلوماتية</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>عميد كلية الهندسة المعلوماتية</p>\r\n\r\n<p>الدكتور صلاح الدوه جي<img alt="" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/AES-SubBytes.svg/420px-AES-SubBytes.svg.png" style="height:218px; width:420px" /></p>\r\n', '', 'items_photos/1479159227.jpg');

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
  `category_id` int(11) NOT NULL,
  `menu_position` enum('top','right','left','bottom') NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `parent_id` (`parent_id`),
  KEY `category_id` (`category_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `parent_id`, `category_id`, `menu_position`, `item_id`, `menu_title`) VALUES
(2, NULL, 6, 'top', NULL, 'Home'),
(3, NULL, 6, 'top', NULL, 'about'),
(4, 3, 5, 'top', 1, 'about us'),
(5, 3, 5, 'top', 2, 'contact us'),
(6, NULL, 6, 'left', NULL, 'Students'),
(7, NULL, 6, 'left', NULL, 'Teachers');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_language`
--

INSERT INTO `menu_language` (`menu_language_id`, `menu_id`, `language_id`, `title`) VALUES
(6, 2, 9, 'Home'),
(7, 2, 8, 'الرئيسية'),
(8, 3, 8, 'عنا'),
(9, 3, 9, 'About'),
(10, 4, 8, 'من نحن'),
(11, 4, 9, 'about us'),
(12, 5, 8, 'اتصل بنا'),
(13, 5, 9, 'Contact Us');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_page`, `permission_action`, `permission_description`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'menus', 'create', 'create menu', 0, '2016-11-06 13:32:13', 0, '1974-12-31 22:00:00', NULL, NULL),
(2, 'categories', 'create', 'create categories', 0, '2016-11-05 12:29:52', 0, '1974-12-31 22:00:00', NULL, NULL),
(5, 'items', 'create', 'create item ', 1, '2016-11-05 16:14:19', 1, '1974-12-31 22:00:00', NULL, NULL),
(6, 'menus', 'index', 'can show all permissions', 1, '2016-11-06 13:32:22', 1, '1974-12-31 22:00:00', NULL, NULL),
(10, 'menus', 'update', 'update a menu', 1, '2016-11-06 14:01:38', 1, '1974-12-31 22:00:00', NULL, NULL),
(11, 'categories', 'index', 'show all categoies', 1, '2016-11-06 14:02:45', 1, '1974-12-31 22:00:00', NULL, NULL),
(12, 'items', 'index', 'show all items', 1, '2016-11-06 19:07:15', 1, '1974-12-31 22:00:00', NULL, NULL),
(13, 'menus', 'view', 'view existing menus', 1, '2016-11-08 04:53:59', 1, '1974-12-31 22:00:00', NULL, NULL),
(14, 'categories', 'view', 'view Category', 1, '2016-11-14 14:55:49', 1, '1974-12-31 22:00:00', NULL, NULL),
(15, 'items', 'view', 'items view', 1, '2016-11-14 17:32:00', 1, '1974-12-31 22:00:00', NULL, NULL),
(16, 'languages', 'index', 'languages index', 1, '2016-11-14 17:32:36', 1, '1974-12-31 22:00:00', NULL, NULL),
(17, 'languages', 'view', 'index', 1, '2016-11-14 17:32:57', 1, '1974-12-31 22:00:00', NULL, NULL),
(18, 'languages', 'create', 'languages', 1, '2016-11-14 17:33:18', 1, '1974-12-31 22:00:00', NULL, NULL),
(19, 'languages', 'delete', 'languages', 1, '2016-11-14 17:33:31', 1, '1974-12-31 22:00:00', NULL, NULL),
(20, 'languages', 'update', 'languages', 1, '2016-11-14 17:33:46', 1, '1974-12-31 22:00:00', NULL, NULL),
(21, 'site', 'index', 'site', 1, '2016-11-14 17:34:20', 1, '1974-12-31 22:00:00', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_perm`
--

INSERT INTO `role_perm` (`role_perm_id`, `role_id`, `permission_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(19, 2, 12, 1, '2016-11-06 14:05:24', 1, '1974-12-31 22:00:00', NULL, NULL),
(21, 2, 11, 1, '2016-11-06 16:21:07', 1, '1974-12-31 22:00:00', NULL, NULL),
(23, 2, 6, 1, '2016-11-10 09:14:32', 1, '1974-12-31 22:00:00', NULL, NULL),
(26, 1, 12, 1, '2016-11-06 14:05:24', 1, '1974-12-31 22:00:00', NULL, NULL),
(27, 1, 1, 1, '2016-11-14 15:47:18', 1, '1974-12-31 22:00:00', NULL, NULL),
(28, 1, 6, 1, '2016-11-14 15:47:18', 1, '1974-12-31 22:00:00', NULL, NULL),
(29, 1, 10, 1, '2016-11-14 15:47:18', 1, '1974-12-31 22:00:00', NULL, NULL),
(30, 1, 14, 1, '2016-11-14 15:47:24', 1, '1974-12-31 22:00:00', NULL, NULL),
(31, 1, 5, 1, '2016-11-14 15:47:24', 1, '1974-12-31 22:00:00', NULL, NULL),
(32, 1, 13, 1, '2016-11-14 15:47:30', 1, '1974-12-31 22:00:00', NULL, NULL),
(33, 1, 2, 1, '2016-11-14 15:47:30', 1, '1974-12-31 22:00:00', NULL, NULL),
(34, 3, 13, 1, '2016-11-14 17:57:21', 1, '1974-12-31 22:00:00', NULL, NULL),
(35, 3, 15, 1, '2016-11-14 17:57:21', 1, '1974-12-31 22:00:00', NULL, NULL),
(36, 3, 17, 1, '2016-11-14 17:57:21', 1, '1974-12-31 22:00:00', NULL, NULL);

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
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `items_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `items_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `item_language`
--
ALTER TABLE `item_language`
  ADD CONSTRAINT `item_language_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `item_language_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `languages` (`language_id`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
