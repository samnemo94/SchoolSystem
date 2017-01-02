-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2017 at 12:24 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_title` varchar(255) NOT NULL,
  `showing_parent` smallint(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `deleted` smallint(6) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `modified_by` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `category_title`, `showing_parent`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted`, `deleted_at`, `deleted_by`, `modified_by`) VALUES
(2, NULL, 'faculty', 1, '2016-12-25 10:41:23', 1, '2016-12-16 00:24:25', 1, 0, NULL, NULL, 'admin'),
(3, 2, 'study_year', 1, '2016-12-25 10:41:28', 1, '2016-12-16 00:25:38', 1, 0, NULL, NULL, 'admin'),
(4, 3, 'subject', 1, '2016-12-25 10:41:36', 1, '2016-12-16 00:26:15', 1, 0, NULL, NULL, 'admin'),
(6, 4, 'lesson', 1, '2017-01-01 22:19:26', 1, '2017-01-01 08:19:26', 1, 0, NULL, NULL, 'admin'),
(7, NULL, 'students', 1, '2016-12-30 17:18:25', 1, '2016-12-30 03:18:25', 1, 0, NULL, NULL, 'admin'),
(8, NULL, 'teachers', 1, '2017-01-01 19:42:44', 1, '2017-01-01 05:42:44', 1, 0, NULL, NULL, 'admin'),
(9, NULL, 'teacher_subject', 1, '2016-12-25 10:41:57', 1, '2016-12-16 00:29:38', 1, 0, NULL, NULL, 'admin'),
(10, 7, 'student_subject', 1, '2016-12-30 21:24:15', 1, '2016-12-30 07:24:15', 1, 0, NULL, NULL, 'admin'),
(11, 6, 'lesson_questions', 0, '2017-01-02 13:56:27', 1, '2017-01-01 23:56:27', 1, 0, NULL, NULL, 'admin'),
(12, 6, 'lesson_files', 1, '2016-12-25 10:42:05', 1, '2016-12-16 01:27:16', 1, 0, NULL, NULL, 'admin'),
(13, 4, 'exam_template', 1, '2017-01-01 22:23:28', 1, '2017-01-01 08:23:28', 1, 0, NULL, NULL, 'admin'),
(14, 4, 'exam', 1, '2017-01-02 05:01:27', 1, '2017-01-02 03:01:27', 1, 0, NULL, NULL, 'admin'),
(15, 4, 'exam_questions', 1, '2017-01-02 14:52:45', 1, '2017-01-02 00:52:45', 1, 0, NULL, NULL, 'admin'),
(16, 13, 'questions_template', 1, '2017-01-02 15:14:14', 1, '2017-01-02 01:14:14', 1, 0, NULL, NULL, 'admin'),
(17, NULL, 'general_informations', 1, '2016-12-29 12:00:40', 1, '2016-12-28 23:00:40', 1, 0, NULL, NULL, 'admin'),
(18, NULL, 'New_Events', 1, '2016-12-30 06:23:21', 1, '2016-12-30 05:23:21', 1, 0, NULL, NULL, 'admin'),
(19, NULL, 'user', 0, '2016-12-30 15:17:59', 1, '2016-12-30 03:17:59', 1, 0, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `field_id` int(11) NOT NULL,
  `field_title` varchar(255) NOT NULL,
  `field_title_ar` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `field_type` enum('varchar','text','int','double','date','time','date_time','image','file','foreign_key') NOT NULL,
  `fk_table` varchar(255) DEFAULT NULL,
  `has_translate` smallint(6) NOT NULL,
  `is_null` smallint(6) NOT NULL,
  `is_show` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`field_id`, `field_title`, `field_title_ar`, `category_id`, `field_type`, `fk_table`, `has_translate`, `is_null`, `is_show`) VALUES
(1, 'title', 'اسم الكلية', 2, 'varchar', '', 1, 0, 1),
(2, 'description', 'الوصف', 2, 'text', '', 1, 0, 1),
(3, 'image', 'صورة', 2, 'image', '', 0, 1, 1),
(4, 'title', 'السنة الدراسية', 3, 'varchar', '', 1, 0, 1),
(5, 'description', 'الوصف', 3, 'text', '', 1, 0, 1),
(6, 'description', 'الوصف', 4, 'text', '', 1, 0, 1),
(7, 'title', 'اسم المادة', 4, 'varchar', '', 1, 0, 1),
(8, 'image', 'صورة', 4, 'image', '', 0, 1, 1),
(9, 'faculty', 'الكلية', 3, 'foreign_key', '2', 0, 0, 1),
(10, 'study_year', 'السنة الدراسية', 4, 'foreign_key', '3', 0, 0, 1),
(11, 'subject_id', NULL, 4, 'int', '', 0, 0, 1),
(28, 'teacher_id', 'المدرس', 9, 'foreign_key', '8', 0, 0, 1),
(29, 'subject_id', 'المادة', 9, 'foreign_key', '4', 0, 0, 1),
(30, 'form_date', 'من تاريخ', 9, 'date', '', 0, 0, 1),
(31, 'to_date', 'الى', 9, 'date', '', 0, 0, 1),
(44, 'file_id', NULL, 12, 'int', '', 0, 0, 1),
(45, 'lesson_id', 'الدرس', 12, 'foreign_key', '6', 0, 0, 1),
(46, 'file_link', 'الملف', 12, 'file', '', 0, 0, 1),
(76, 'title', 'العنوان', 17, 'varchar', '', 1, 0, 1),
(77, 'image', 'صورة', 17, 'image', '', 0, 1, 1),
(78, 'description', 'الوصف', 17, 'text', '', 1, 0, 1),
(83, 'title', 'العنوان', 18, 'varchar', '', 1, 0, 1),
(84, 'description', 'الوصف', 18, 'text', '', 1, 0, 1),
(85, 'image', 'صورة', 18, 'image', '', 0, 1, 1),
(86, 'user', NULL, 19, 'int', '', 0, 0, 0),
(88, 'first_name', 'الاسم', 7, 'varchar', '', 0, 0, 1),
(89, 'last_name', 'الكنية', 7, 'varchar', '', 0, 0, 1),
(90, 'age', 'العمر', 7, 'int', '', 0, 0, 1),
(91, 'address', 'العنوان', 7, 'text', '', 0, 0, 1),
(92, 'year', 'السنة الدراسية', 7, 'int', '', 0, 0, 1),
(93, 'phone', 'الهاتف', 7, 'varchar', '', 0, 1, 1),
(94, 'photo', 'الصورة الشخصية', 7, 'image', '', 0, 1, 1),
(95, 'user_id', 'المستخدم', 7, 'foreign_key', '19', 0, 0, 0),
(111, 'student_id', 'الطالب', 10, 'foreign_key', '7', 0, 0, 0),
(112, 'subject_id', 'المادة', 10, 'foreign_key', '4', 0, 0, 1),
(113, 'registration_date', 'تاريخ التسجيل', 10, 'date_time', '', 0, 0, 1),
(114, 'lessons_finished', 'عدد الدروس المنتهية', 10, 'int', '', 0, 1, 0),
(115, 'exam_mark', 'علامة الامتحان', 10, 'double', '', 0, 1, 0),
(116, 'teacher_evaluate', 'تقييم المدرس', 10, 'varchar', '', 0, 1, 0),
(118, 'is_active', 'مفعل', 7, 'int', NULL, 0, 0, 0),
(119, 'first_name', 'الاسم', 8, 'varchar', '', 0, 0, 1),
(120, 'last_name', 'الكنية', 8, 'varchar', '', 0, 0, 1),
(121, 'age', 'العمر', 8, 'int', '', 0, 0, 1),
(122, 'address', 'العنوان', 8, 'text', '', 0, 0, 1),
(123, 'phone', 'الهاتف', 8, 'varchar', '', 0, 1, 1),
(124, 'photo', 'الصورة الشخصية', 8, 'image', '', 0, 1, 1),
(125, 'is_active', 'مفعل', 8, 'int', '', 0, 0, 0),
(126, 'user_id', NULL, 8, 'int', '', 0, 0, 0),
(131, 'title', 'اسم الدرس', 6, 'varchar', '', 1, 0, 1),
(132, 'description', 'الوصف', 6, 'text', '', 1, 0, 1),
(133, 'image', 'صورة', 6, 'image', '', 0, 0, 0),
(134, 'subject', 'المادة', 6, 'foreign_key', '4', 0, 0, 0),
(138, 'subject_id', 'المادة', 13, 'foreign_key', '4', 0, 0, 0),
(139, 'title', 'العنوان', 13, 'varchar', '', 1, 0, 1),
(143, 'subject_id', 'المادة', 14, 'foreign_key', '4', 0, 0, 0),
(144, 'template_id', 'نموذج الامتحان', 14, 'foreign_key', '13', 0, 0, 1),
(145, 'exam_date', 'تاريخ الامتحان', 14, 'date_time', '', 0, 0, 1),
(146, 'title', 'العنوان', 14, 'varchar', '4', 1, 0, 1),
(177, 'question_id', 'السؤال', 11, 'int', '', 0, 0, 1),
(178, 'lesson_id', 'الامتحان', 11, 'foreign_key', '6', 0, 0, 1),
(179, 'question_text', 'نص السؤال', 11, 'text', '', 1, 0, 1),
(180, 'choice1', 'الخيار الأول', 11, 'text', '', 1, 0, 1),
(181, 'choice2', 'الخيار الثاني', 11, 'text', '', 1, 0, 1),
(182, 'choice3', 'الخيار الثالث', 11, 'varchar', '', 1, 0, 1),
(183, 'choice4', 'الخيار الرابع', 11, 'text', '', 1, 0, 1),
(184, 'question_text', 'تص السؤال', 15, 'text', '', 1, 0, 1),
(185, 'choice1', 'الخيار الأول', 15, 'text', '', 1, 0, 1),
(186, 'choice2', 'الخيار الثاني', 15, 'text', '', 1, 0, 1),
(187, 'choice3', 'الخيار الثالث', 15, 'text', '', 1, 0, 1),
(188, 'choice4', 'الخيار الرابع', 15, 'text', '', 1, 0, 1),
(189, 'subject_id', NULL, 15, 'foreign_key', '4', 0, 0, 0),
(190, 'answer', 'الجواب', 15, 'text', '', 1, 0, 1),
(191, 'title', 'العنوان', 15, 'varchar', '', 1, 0, 1),
(196, 'question_id', 'السؤال', 16, 'foreign_key', '15', 0, 0, 1),
(197, 'template_id', 'نموذج الامتحان', 16, 'foreign_key', '13', 0, 0, 0),
(198, 'mark', 'علامة السؤال', 16, 'double', '', 0, 0, 1),
(199, 'order', 'الترتيب', 16, 'int', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `deleted` smallint(6) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `modified_by` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(44, 2, '2016-12-30 12:09:03', 1, '2016-12-30 10:09:03', 1, 0, NULL, NULL, 'admin'),
(45, 2, '2016-11-28 13:47:58', 1, '2016-11-28 01:47:58', 1, 0, NULL, NULL, 'admin'),
(47, 2, '2016-11-29 03:16:33', 1, '2016-11-29 03:16:33', 1, 0, NULL, NULL, 'admin'),
(48, 2, '2016-11-29 03:27:25', 1, '2016-11-29 03:27:25', 1, 0, NULL, NULL, 'admin'),
(49, 17, '2016-12-29 11:51:08', 1, '2016-12-29 10:51:08', 1, 1, '2016-12-29 10:51:08', 1, 'admin'),
(50, 17, '2016-12-29 11:51:01', 1, '2016-12-29 10:51:01', 1, 1, '2016-12-29 10:51:01', 1, 'admin'),
(51, 17, '2016-12-29 11:50:57', 1, '2016-12-29 10:50:57', 1, 1, '2016-12-29 10:50:57', 1, 'admin'),
(52, 2, '2016-12-29 11:46:19', 1, '2016-12-28 23:46:19', 1, 0, NULL, NULL, 'admin'),
(53, 17, '2016-12-29 11:52:11', 1, '2016-12-28 23:52:11', 1, 0, NULL, NULL, 'admin'),
(54, 17, '2016-12-29 12:09:15', 1, '2016-12-29 00:09:15', 1, 0, NULL, NULL, 'admin'),
(55, 17, '2016-12-29 13:12:20', 1, '2016-12-29 01:12:20', 1, 0, NULL, NULL, 'admin'),
(56, 17, '2016-12-29 14:27:39', 1, '2016-12-29 02:27:39', 1, 0, NULL, NULL, 'admin'),
(57, 17, '2016-12-29 15:42:07', 1, '2016-12-29 03:42:07', 1, 0, NULL, NULL, 'admin'),
(58, 18, '2016-12-29 16:02:51', 1, '2016-12-29 04:02:51', 1, 0, NULL, NULL, 'admin'),
(59, 18, '2016-12-29 16:10:04', 1, '2016-12-29 04:10:04', 1, 0, NULL, NULL, 'admin'),
(60, 18, '2016-12-29 16:15:13', 1, '2016-12-29 04:15:13', 1, 0, NULL, NULL, 'admin'),
(62, 8, '2016-12-30 08:41:20', 1, '2016-12-30 08:41:20', 1, 0, NULL, NULL, 'admin'),
(63, 8, '2016-12-30 08:43:20', 1, '2016-12-30 08:43:20', 1, 0, NULL, NULL, 'admin'),
(64, 8, '2016-12-30 08:44:13', 1, '2016-12-30 08:44:13', 1, 0, NULL, NULL, 'admin'),
(67, 7, '2016-12-30 15:19:06', 10, '2016-12-30 15:19:06', 10, 0, NULL, NULL, 'admin'),
(68, 10, '2016-12-31 18:39:43', 1, '2016-12-31 05:39:43', 1, 1, '2016-12-31 17:39:43', 1, 'admin'),
(69, 10, '2016-12-31 18:39:38', 1, '2016-12-31 05:39:38', 1, 1, '2016-12-31 17:39:38', 1, 'admin'),
(70, 10, '2016-12-30 19:59:07', 10, '2016-12-30 21:59:07', 10, 0, NULL, NULL, 'admin'),
(71, 8, '2016-12-31 06:46:05', 1, '2016-12-31 06:46:05', 1, 0, NULL, NULL, 'admin'),
(72, 9, '2016-12-31 11:14:25', 4, '2016-12-31 12:14:25', 4, 0, NULL, NULL, 'admin'),
(73, 8, '2016-12-31 19:34:28', 1, '2016-12-31 20:34:28', NULL, 0, NULL, NULL, 'admin'),
(74, 10, '2017-01-01 06:16:30', 1, '2017-01-01 06:16:30', 1, 0, NULL, NULL, 'admin'),
(75, 10, '2017-01-01 06:17:24', 1, '2017-01-01 06:17:24', 1, 0, NULL, NULL, 'admin'),
(76, 8, '2017-01-01 09:08:05', 1, '2017-01-01 11:08:05', NULL, 0, NULL, NULL, 'admin'),
(77, 8, '2017-01-01 09:08:05', 1, '2017-01-01 11:08:05', NULL, 0, NULL, NULL, 'admin'),
(78, 10, '2017-01-01 09:21:07', 1, '2017-01-01 11:21:07', 10, 0, NULL, NULL, 'admin'),
(79, 10, '2017-01-01 14:45:58', 1, '2017-01-01 16:45:58', 10, 0, NULL, NULL, 'admin'),
(80, 8, '2017-01-01 19:26:10', 1, '2017-01-01 21:26:10', NULL, 0, NULL, NULL, 'admin'),
(81, 8, '2017-01-01 19:26:10', 1, '2017-01-01 21:26:10', NULL, 0, NULL, NULL, 'admin'),
(82, 8, '2017-01-01 19:26:58', 1, '2017-01-01 21:26:58', NULL, 0, NULL, NULL, 'admin'),
(83, 9, '2017-01-01 19:44:46', 1, '2017-01-01 21:44:46', 4, 0, NULL, NULL, 'admin'),
(84, 6, '2017-01-01 20:19:51', 1, '2017-01-01 22:19:51', 13, 0, NULL, NULL, 'admin'),
(85, 13, '2017-01-01 20:23:38', 1, '2017-01-01 22:23:38', 13, 0, NULL, NULL, 'admin'),
(86, 13, '2017-01-01 20:23:38', 1, '2017-01-01 22:23:38', 13, 0, NULL, NULL, 'admin'),
(87, 13, '2017-01-01 20:23:54', 1, '2017-01-01 22:23:54', 13, 0, NULL, NULL, 'admin'),
(88, 14, '2017-01-01 20:24:43', 1, '2017-01-01 22:24:43', 13, 0, NULL, NULL, 'admin'),
(89, 14, '2017-01-02 03:02:23', 1, '2017-01-02 05:02:23', 13, 0, NULL, NULL, 'admin'),
(90, 14, '2017-01-02 09:17:57', 1, '2017-01-02 11:17:57', 13, 0, NULL, NULL, 'admin'),
(91, 9, '2017-01-02 09:28:00', 1, '2017-01-02 09:28:00', 1, 0, NULL, NULL, 'admin'),
(92, 13, '2017-01-02 09:28:17', 1, '2017-01-02 11:28:17', 13, 0, NULL, NULL, 'admin'),
(93, 13, '2017-01-02 09:29:47', 1, '2017-01-02 11:29:47', 13, 0, NULL, NULL, 'admin'),
(94, 6, '2017-01-02 11:44:06', 1, '2017-01-02 13:44:06', 13, 0, NULL, NULL, 'admin'),
(95, 13, '2017-01-02 11:44:22', 1, '2017-01-02 13:44:22', 13, 0, NULL, NULL, 'admin'),
(96, 14, '2017-01-02 11:44:47', 1, '2017-01-02 13:44:47', 13, 0, NULL, NULL, 'admin'),
(97, 15, '2017-01-02 11:46:13', 1, '2017-01-02 13:46:13', 13, 0, NULL, NULL, 'admin'),
(98, 16, '2017-01-02 13:17:17', 1, '2017-01-02 15:17:17', 13, 0, NULL, NULL, 'admin'),
(99, 16, '2017-01-02 13:18:15', 1, '2017-01-02 15:18:15', 13, 0, NULL, NULL, 'admin'),
(100, 9, '2017-01-02 19:43:58', 1, '2017-01-02 07:43:58', 1, 0, NULL, NULL, 'admin'),
(101, 6, '2017-01-02 20:49:33', 1, '2017-01-02 21:49:33', 13, 0, NULL, NULL, 'admin'),
(102, 6, '2017-01-02 21:54:36', 1, '2017-01-02 22:54:36', 13, 0, NULL, NULL, 'admin'),
(103, 15, '2017-01-02 22:01:47', 1, '2017-01-02 23:01:47', 13, 0, NULL, NULL, 'admin'),
(104, 15, '2017-01-02 22:06:10', 1, '2017-01-02 23:06:10', 13, 0, NULL, NULL, 'admin'),
(105, 15, '2017-01-02 22:13:03', 1, '2017-01-02 23:13:03', 13, 0, NULL, NULL, 'admin'),
(106, 13, '2017-01-02 22:14:53', 1, '2017-01-02 23:14:53', 13, 0, NULL, NULL, 'admin'),
(107, 14, '2017-01-02 22:22:02', 1, '2017-01-02 23:22:02', 13, 0, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `language_code` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `menu_position` enum('top','right','left','bottom') NOT NULL,
  `menu_for` enum('Admin','Student','Teacher') DEFAULT NULL,
  `is_private` smallint(6) NOT NULL DEFAULT '1',
  `item_id` int(11) DEFAULT NULL,
  `menu_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `parent_id`, `category_id`, `menu_position`, `menu_for`, `is_private`, `item_id`, `menu_title`) VALUES
(1, NULL, 2, 'top', NULL, 1, NULL, 'faculties '),
(2, NULL, 3, 'top', NULL, 1, NULL, 'study_years'),
(3, NULL, 4, 'top', NULL, 1, NULL, 'subjects'),
(4, 1, NULL, 'top', NULL, 1, 1, 'ite'),
(5, 1, NULL, 'top', NULL, 1, 2, 'mte'),
(6, 1, NULL, 'top', NULL, 1, 3, 'medicin'),
(7, 4, NULL, 'top', NULL, 1, 6, 'ite-1y'),
(8, 4, NULL, 'top', NULL, 1, 7, 'ite-2y'),
(9, 4, NULL, 'top', NULL, 1, 8, 'ite-3y'),
(10, 4, NULL, 'top', NULL, 1, 9, 'ite-4y'),
(11, 4, NULL, 'top', NULL, 1, 10, 'ite-5y'),
(12, 5, NULL, 'top', NULL, 1, 11, 'mte-1y'),
(13, 5, NULL, 'top', NULL, 1, 12, 'mte-2y'),
(14, 5, NULL, 'top', NULL, 1, 13, 'mte-3y'),
(15, 5, NULL, 'top', NULL, 1, 14, 'mte-4y'),
(16, 5, NULL, 'top', NULL, 1, 15, 'mte-5y'),
(17, 6, NULL, 'top', NULL, 1, 16, 'medicin-1y'),
(18, 6, NULL, 'top', NULL, 1, 17, 'medicin-2y'),
(19, 6, NULL, 'top', NULL, 1, 18, 'medicin-3y'),
(20, 6, NULL, 'top', NULL, 1, 19, 'medicin-4y'),
(21, 6, NULL, 'top', NULL, 1, 20, 'medicin-5y'),
(22, 6, NULL, 'top', NULL, 1, 21, 'medicin-6y'),
(23, NULL, 17, 'top', NULL, 0, NULL, 'General Informations'),
(24, 23, NULL, 'top', NULL, 0, 54, 'about_university'),
(25, 23, NULL, 'top', NULL, 0, 53, 'rector''s_message'),
(26, 23, NULL, 'top', NULL, 0, 55, 'mission&vission'),
(27, 23, NULL, 'top', NULL, 0, 56, 'FAQS'),
(28, 23, NULL, 'top', NULL, 0, 57, 'Contact-Info'),
(29, NULL, 18, 'top', NULL, 0, NULL, 'New Events'),
(30, NULL, NULL, 'left', 'Admin', 1, NULL, 'Teachers'),
(31, 30, 9, 'left', 'Admin', 1, NULL, 'Teachers And Subjects'),
(32, 30, 8, 'left', 'Admin', 1, NULL, 'See All Teachers'),
(33, NULL, NULL, 'left', 'Admin', 1, NULL, 'Students'),
(34, 33, 7, 'left', 'Admin', 1, NULL, 'See All Students'),
(35, NULL, NULL, 'left', 'Admin', 1, NULL, 'General Info'),
(36, 35, 17, 'left', 'Admin', 1, NULL, 'View All informations'),
(37, 35, 17, 'left', 'Admin', 1, NULL, 'Add information'),
(38, NULL, NULL, 'left', 'Admin', 1, NULL, 'Events'),
(39, 38, 18, 'left', 'Admin', 1, NULL, 'View All Events'),
(40, 38, 18, 'left', 'Admin', 1, NULL, 'Add event'),
(42, 33, 10, 'left', 'Admin', 1, NULL, 'Students Marks'),
(43, NULL, 10, 'left', 'Student', 1, NULL, 'My Subjects'),
(44, NULL, 10, 'left', 'Student', 1, NULL, 'My Marks'),
(45, NULL, 9, 'left', 'Teacher', 1, NULL, 'my subjects');

-- --------------------------------------------------------

--
-- Table structure for table `menu_language`
--

CREATE TABLE `menu_language` (
  `menu_language_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(44, 22, 9, 'Sixth Year'),
(45, 23, 8, 'معلومات عامة'),
(46, 24, 8, 'عن الجامعة'),
(47, 25, 8, 'رسالة رئيس الجامعة'),
(48, 26, 8, 'الرؤية والرسالة'),
(49, 27, 8, 'الأسئلة الشائعة'),
(50, 28, 8, 'معلومات التواصل'),
(51, 29, 8, 'الأحداث الجديدة'),
(52, 30, 8, 'المدرسين'),
(53, 31, 8, 'اسناد مواد للمدرسين'),
(54, 32, 8, 'جميع المدرسين'),
(55, 33, 8, 'الطلاب'),
(56, 34, 8, 'جميع الطلاب'),
(57, 35, 8, 'المعلومات العامة'),
(58, 36, 8, 'رؤية المعلومات العامة'),
(59, 37, 8, 'اضافة معلومة عامة'),
(60, 38, 8, 'الأحداث'),
(61, 39, 8, 'رؤية الأحداث'),
(62, 40, 8, 'اضافة حدث جديد'),
(63, 42, 8, 'علامات الطلاب'),
(64, 43, 8, 'موادي'),
(65, 44, 8, 'علاماتي الامتحانية'),
(66, 45, 8, 'موادي');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
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

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_page` varchar(255) NOT NULL,
  `permission_action` varchar(255) NOT NULL,
  `permission_description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '1974-12-31 22:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '1974-12-31 22:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'admin', 0, '2016-11-05 12:23:07', 0, '1974-12-31 22:00:00', NULL, NULL),
(2, 'student', 1, '2016-12-30 17:09:32', 1, '1974-12-31 22:00:00', NULL, NULL),
(3, 'User', 1, '2016-11-14 17:57:21', 1, '1974-12-31 22:00:00', NULL, NULL),
(4, 'teacher', 1, '2016-12-31 20:44:16', 1, '1974-12-31 22:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_perm`
--

CREATE TABLE `role_perm` (
  `role_perm_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '1974-12-31 22:00:00',
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'sam', 'VKFTcXrSZcPnUNZjj2QugIZLBORJ04Dq', '$2y$13$43vfd24zJ10DqS30e1JE.eevodPO8Ge/fPoX4SEdEd9GKl6A6xfju', NULL, 'sam@sam.sam', 10, 1476382691, 1476382691),
(3, 2, 'student', 'yM3ap3v3anPvUQP0PgbBH6GNjWEQVPR0', '$2y$13$gH0TiGDWmTe6J4hYWoZCjO4v7NftCK6wGUdW3Ktn8JoppWxziIFsC', NULL, 'nsadada@asda.com', 10, 1482966657, 1482966657),
(4, 1, 'admin', 'd7zDRRjBYSwgOyH1ivA4Z2RRY9VdeYS2', '$2y$13$dvufe8cuRaUQDPXAKUHHve.xkWGH35IRHtBxZty.SPfeb0wZCXMAq', NULL, 'admin@gmail.com', 10, 0, 0),
(10, 2, 'student1', 'NrV1z0bMURyw5q2eygj7wIXwK7y2HEUv', '$2y$13$Lj7yFy4wN3V9NjOP/m1qjeveK5gMbMmn8JOp3fIeRZIjJrqQx3mKS', NULL, 'sadsads@dss.com', 10, 1483118346, 1483118346),
(11, 4, 'teacher73', 'J5MfTzojOaBYgrw4aF8lNQ0g76egnfsN', '$2y$13$Gjt2nUUza/Tphd7cONcHXureGun7K.OXiNLv76M96c/EHKjgen0kK', NULL, 'teacher73@gmail.com', 10, 1483217640, 1483217640),
(12, 4, 'teacher77', 'FXLoVmfv4AxAtO1OhXQ2xC0DBLb8FcuQ', '$2y$13$QgH1/LS.bA7y2QOAkAqx.OUO1c40e5CMZD.xJqTR8ygUQojouDfX2', NULL, 'teacher77@gmail.com', 10, 1483268931, 1483268931),
(13, 4, 'teacher82', 'LUQL_eirfgEhprxicC26w5TFycoBQ6zI', '$2y$13$nn/BV410BZLDuDzrQVptc.ZzqzDy61XD59FXtNBYid1CXSgweB2K6', NULL, 'teacher82@gmail.com', 10, 1483306115, 1483306115);

-- --------------------------------------------------------

--
-- Table structure for table `values`
--

CREATE TABLE `values` (
  `value_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `language_id` int(11) DEFAULT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(202, 42, 1, 8, 'كلية جديدة جدا'),
(203, 42, 2, 8, '<p>وصف طويل جدا للكلية الجديدة جدا</p>'),
(204, 42, 3, 8, '../../common/web/uploads/1483115154'),
(205, 44, 1, 8, 'كلية جديدة ثانية'),
(206, 44, 2, 8, 'وصف كلية جديدة ثانية'),
(207, 44, 3, 8, '../../common/web/uploads/speeeeed.png'),
(208, 45, 1, 8, 'Sas'),
(209, 45, 2, 8, 'DSdcsad'),
(210, 45, 3, 8, '../../common/web/uploads/148034807814732232_520972304778345_3121256020441722779_n.jpg'),
(213, 47, 1, 8, 'كلية الصيدلة'),
(214, 47, 2, 8, 'سيبسيبلي سيبلسي بلسث بسيب\r\nسيبسي\r\n بسي\r\nب '),
(215, 47, 1, 9, 'Faculty Of Pharmacy'),
(216, 47, 2, 9, 'FASDcf Ad adf ad ad'),
(217, 47, 3, NULL, '../../common/web/uploads/14803965931-8f9-275.jpg'),
(218, 48, 1, 8, 'كلية الصيدلة'),
(219, 48, 2, 8, 'سيبسيبلي سيبلسي بلسث بسيب\r\nسيبسي\r\n بسي\r\nب '),
(220, 48, 1, 9, 'Faculty Of Pharmacy'),
(221, 48, 2, 9, 'FASDcf Ad adf ad ad'),
(222, 48, 3, NULL, '../../common/web/uploads/14803972461-8f9-275.jpg'),
(231, 53, 76, 8, 'كلمة رئيس الجامعة'),
(232, 53, 78, 8, 'مرحبا بكم في أسرع المجتمع الأكاديمي نموا في البلد - الجامعة الافتراضيةفي دمشق. في غضون بضع سنوات أصبحت هذه الجامعة الاتحادية حكومة واحدة من أكبر مؤسسات التعليم العالي في البلاد. ويعمل خريجيها بأجر من قبل المؤسسات الصناعية والتجارية البارزة والعديد منهم أيضا أنشأوا مشاريعهم الخاصة، ووفروا فرص العمل للآخرين. وهناك عدد كبير من الخريجين مستمرة دراستهم في الجامعات الأخرى الطبقة العليا داخل وخارج سوريا على حد سواء.\r\nيجب أن تكون على علم بأن الجامعة الافتراضية ستكون الرائد في التعليم القائم على تكنولوجيا المعلومات والاتصالات في سوريا. ويعمل نظام تعليمي فريد من نوعه يشمل محتوى الفيديو المقدمة من خلال وسائط متعددة بما في ذلك البث التلفزيوني، الشبكة العالمية وأقراص الفيديو الرقمية. وتقدم شامل التفاعل بين الطالب والمعلم والدعم عبر الإنترنت وتستكمل باستخدام الأجهزة النقالة. وقد وضعت جامعة الدورات على مستوى العالم بالنسبة لك، ومن أجل الاستفادة الكاملة منها، يجب أن تصبح مألوفة تماما مع نظام إدارة التعلم في الجامعة (LMS). وستقدم لك التوجه مفصلة من أجل مساعدتك على البدء في دراستك في الجامعة الافتراضية.'),
(233, 53, 76, 9, 'Rector''s Message'),
(234, 53, 78, 9, 'Welcome to the fastest growing academic community in the Country – the Virtual University of Damascus. In just a few years this Federal Government University has become one of the largest higher education institutions of the country. Its graduates are gainfully employed by prominent industrial and business concerns and many have established their own enterprises and are providing employment to others. A large number of VU graduates are continuing their studies at other top tier universities both within and outside Syria.\r\n\r\nYou must be aware that VU is the pioneer in Information and Communications Technology based education in Syria. It employs a unique pedagogy involving video content delivered through multiple modes including broadcast television, the World Wide Web and DVDs. Comprehensive student-teacher interaction and support is provided over the Internet and supplemented using mobile devices. The University has developed world-class courses for you and in order to fully benefit from them, you should become completely familiar with the University’s Learning Management System (LMS). You will be provided a detailed orientation in order to help you get started with your studies at VU.'),
(235, 53, 77, NULL, '../../common/web/uploads/1483015931sami.jpg'),
(236, 54, 76, 8, 'عن الجامعة'),
(237, 54, 78, 8, 'الجامعة الافتراضية، وهي أول جامعة في سورية تستند كليا على تكنولوجيا المعلومات والاتصالات الحديثة، وقد تم تأسيسها من قبل الحكومة والقطاع العام ولم يكن الهدف منها الربح المؤسساتي فحسب بل كانت مع مهمة واضحة وهي توفير التعليم على مستوى عالمي بأسعار معقولة للغاية للطلاب الراغبين في جميع أنحاء بلد.\r\nتسمح الجامعة الافتراضية للطلاب بمتابعة برامجها بغض النظر عن مواقعهم وأماكنهم عن طريق البث التلفزيوني مجانا على الهواء الفضائية والإنترنت، وبالتالي فهي تهدف إلى تخفيف نقص القدرات في الجامعات، في حين التصدي في الوقت نفسه للنقص الحاد من الأساتذة المؤهلين في البلاد. \r\nوتهدف الجامعة الافتراضية إلى توفير أفضل الدورات ليست فقط لطلابها الخاصة ولكن أيضا للطلاب من جميع الجامعات في بعض البلدان.\r\n'),
(238, 54, 76, 9, 'About university '),
(239, 54, 78, 9, 'The Virtual University, Syria''s first University based completely on modern Information and Communication Technologies, was established by the Government as a public sector, not-for-profit institution with a clear mission: to provide extremely affordable world class education to aspiring students all over the country.\r\nUsing free-to-air satellite television broadcasts and the Internet, the Virtual University allows students to follow its rigorous programs regardless of their physical locations. It thus aims at alleviating the lack of capacity in the existing universities while simultaneously tackling the acute shortage of qualified professors in the country. By identifying the top Professors of the country, regardless of their institutional affiliations, and requesting them to develop and deliver hand-crafted courses, the Virtual University aims at providing the very best courses to not only its own students but also to students of all other universities in the country.\r\n'),
(240, 54, 77, NULL, '../../common/web/uploads/1483016956vu.jpg'),
(241, 55, 76, 8, 'الرؤية و الرسالة'),
(242, 55, 78, 8, 'الرؤية:\r\nتسعى الجامعة لأن تكون ضمن الجامعات المصنفة عالميا تصنيفاً مرموقاً وأن تكون رائدة لمسيرة\r\nالتعلم الإلكتروني في المنطقة وفي تأهيل الموارد البشرية بشكل منسجم مع السويات الأآاديمية والمهنية\r\nالعالمية وملبية لحاجات سوق العمل الوطنية والإقليمية وفي مجالات متنوعة. آما تسعى إلى استقطاب\r\nأفضل الخبرات التعليمية والبحثية ووضعها في شبكة علمية يتفاعل فيها المتعلم والمعلم والخريج. \r\n\r\n\r\nالرسالة:\r\nوفير منظومة تعلم وتدريب وبحث حديثة في المجال الأآاديمي والمهني تمكن المتعلم والمتدرب من\r\nالانخراط الفعال والمباشر في سوق العمل عبر تطوير مهاراته ومعارفه في مجالات متنوعة حديثة\r\nمتلائمة مع احتياجات وتطور الاقتصاد المحلي والإقليمي وتنامي استخدام الشبكة الدولية في النشاطات\r\nوالأعمال محليا وإقليميا ودوليا . '),
(243, 55, 76, 9, 'Vision & Mission'),
(244, 55, 78, 9, 'the Vision: \r\nUniversity seeks to be part of a global seed prominent universities rated and be a leader of the march\r\nE-learning in the region and rehabilitation of human resources harmoniously with Sueat academic and professional\r\nGlobal and responsive to the needs of national and regional labor market and in a variety of fields. It also seeks to attract\r\nBetter educational and research experiences and put them in a scientific network which reacts learner, teacher and graduate.\r\n\r\n\r\nThe Mission:\r\nProvide learning and training system and a modern look in the academic and professional field and enables the learner trainee\r\nEffective and direct involvement in the labor market through the development of skills and knowledge in the modern variety of fields\r\nCompatible with the needs and the evolution of the local and regional economy and the growing use of the international network activities\r\nAnd acts locally, regionally and internationally.\r\n'),
(245, 55, 77, NULL, '../../common/web/uploads/1483020741'),
(246, 56, 76, 8, 'الأسئلة الشائعة'),
(247, 56, 78, 8, 'هل الجامعة الافتراضية مؤسسة خاصة أو الحكومة؟\r\nالجامعة الافتراضية السورية جامعة حكومة هي إلى حد كبير. تأسست من قبل الحكومة السورية لتوفير التعليم على مستوى عالمي لطلابها الراغبين في جميع أنحاء البلاد بأسعار معقولة للغاية.\r\nهل الجامعة لديها معايير مختلفة لمختلف المحافظات؟\r\nبالطبع لا. توفر الجامعة الافتراضية التعليم المطابق لجميع طلابها بغض النظر عن موقعها الجغرافي. جميع طلبة الجامعة الافتراضية، بغض النظر عما إذا كانوا يعيشون في المدن الكبيرة أو المدن الصغيرة أو حتى المناطق النائية يتم تدريسها من قبل نفس الأساتذة، على نفس المواد الدراسية. حتى الامتحانات متطابقة في جميع أنحاء البلاد.\r\n\r\nهل التعليم في الجامعة الافتراضية مكلفة للغاية!\r\nسوف تتفاجأ على تحمل تكاليف برامج الجامعة الافتراضية. فعلى الرغم من توفير التعليم على مستوى عالي تبلغ تكلفة الرسوم لبرنامج دبلوم MCS(معهد ماساتشوستس للتكنولوجيا وماجستير في إدارة الأعمال) فقط 1000 ليرة سورية لكل ساعة معتمدة. وتبلغ الرسوم لبرنامج الماجستير في علوم الحاسوب هو 2000 ليرة سورية لكل ساعة معتمدة.\r\nهل يعترف بشهادة الجامعة الافتراضية؟\r\nأنشئت الجامعة الافتراضية من قبل الحكومة السورية، أي أنه يتم التعرف على شهادة الجامعة الافتراضية وطنيا ودوليا.\r\n'),
(248, 56, 76, 9, 'FAQS'),
(249, 56, 78, 9, 'Q.  Is the Virtual University a private or Government institution? \r\nAns. Virtual University of Syria is very much a Government University. It was established by the Government of Syria to provide extremely affordable world class education to aspiring students all over the country.\r\nQ.  Does the University have different standards for the various provinces? \r\nAns. Absolutely not. The Virtual University provides an identical education to all its students regardless of their geographical location. All Virtual University students, regardless of whether they live in large cities or small towns or even remote areas are taught by the same professors, receive the same study materials. Even examinations are identical throughout the country.\r\nQ.  Then Virtual University education must be very expensive! \r\nAns. You will be surprised at the affordability of Virtual University programs. Despite the provision of world-class facilities and education, the cost of a BS program is only  SP. 650  /- per credit hour. The fee for the Diploma program, MCS, MIT and MBA fees are only SP. 1000/- per credit hour. The fee for the MS program in Computer Science is SP. 2,000/- per credit hour.\r\nQ.  Is the VU degree recognized? \r\nAns. The Virtual University has been established by the Government of Syria. As such, its degrees are recognized nationally as well as internationally.'),
(250, 56, 77, NULL, '../../common/web/uploads/1483025260'),
(251, 57, 76, 8, 'معلومات التواصل'),
(252, 57, 78, 8, 'الجامعة الافتراضية السورية \r\nمبنى وزارة التعليم العالي \r\nدمشق \r\nهاتف : 00963112113469\r\nفاكس : 00963112113469\r\nصندوق البريد:35329 \r\nالبريد الالكتروني:  info@svuonline.org'),
(253, 57, 76, 9, 'Contact Information'),
(254, 57, 78, 9, 'Syrian Virtual University \r\nMinistry of Higher Education building\r\nDamascus\r\nTel: + 963 11 2113469+ 963 11 2113469\r\nFax: + 963 11 2113469+ 963 11 2113469\r\nP.O.Box : 35329\r\nEmail : info@svuonline.org\r\n\r\n'),
(255, 57, 77, NULL, '../../common/web/uploads/1483029727'),
(256, 58, 83, 8, 'صدور برنامج الامتحان 2016-2017'),
(257, 58, 84, 8, 'تم صدور برامج امتحان الفصل الأول لعام 2016-2017 لجميع الكليات و السنوات. '),
(258, 58, 83, 9, 'publishing the exam program 2016-2017'),
(259, 58, 84, 9, 'published the first semester exam program for the year 2016-2017 for all colleges and years.'),
(260, 59, 83, 8, 'تمديد موعد انتهاء التسجيل'),
(261, 59, 84, 8, 'يمدد موعد انتهاء التسجيل للطلاب الجدد و القدامى الى التاريخ : 1/1/2017'),
(262, 59, 83, 9, 'Extend the registration expiration date.'),
(263, 59, 84, 9, 'Extend the registration deadline for new and old students to date: 01/01/2017'),
(264, 60, 83, 8, 'إعلان افتتـاح المعهـد التقـاني للحاسوب في الجامعـة الافتـراضيـة السـوريـة'),
(265, 60, 84, 8, 'تعـلـن الجامعة الافتراضية السـورية عن افتتاح "المعهد التقاني للحاسوب TIC " اختصاص برمجيات ونظم المعلومات لطلاب حملة الشهادة الثانوية بمعـدل 50% ومافوق\r\nوذلـك للثانـويات التالـية:  العامة : الفرع العـلمي الصنـاعية والمهنية : تقنيات الحاسوب - المعلوماتية - البرمجة وأنظمة التشغيل - صيانة الحواسب والتجهيزات الحاسوبية - الشبكات الحاسوبية- كهرباء الطيران - ميكانيك الطيران - ميكانيك السيارات - التقنيات الالكترونية - التقنيات الكهربائية - كهرباء والكترون المركبات - ميكانيك المركبات - التكييف والتبريد - المحركـات والآليات - التدفئة والتمديدات - الكهرباء - التلمذة الصناعية - التصنيع الميكانيكي - الآليات والمعدات الزراعية - آلات زراعية - صيانة الآلات والمعدات الزراعية - ميكاترونيكس-  مهن نفطية (أجهزة القياس والتحكم - كهرباء صناعية) - صيانة الأجهزة الطبية - كافـة الثانـويـات الصناعيـة التقـانيـة- تقنيات الحاسوب - المعلوماتية - البرمجة وأنظمة التشغيل - صيانة الحواسب والتجهيزات الحاسوبية - الشبكات الحاسوبية\r\n مدة الدراســة : سـنتان كحـد أدنـى '),
(266, 60, 83, 9, 'opening Technical Institute for the computer in the Syrian Virtual University'),
(267, 60, 84, 9, 'Syrian Virtual University announces the opening of "Technical Institute for Computer TIC" the jurisdiction of the software and information systems for students of high school graduates at a rate of 50% and above\r\nFor the following high schools: public: the scientific branch Industrial and professional: computer techniques - Informatics - programming and operating systems - maintenance and computer equipment computers - Alhessobh- networks Aviation electricity - Mechanical flight - car mechanics - the electronic technology - electrical engineering - Electricity and Electron vehicles - Mechanical vehicles - air conditioning and refrigeration - motor vehicles - heating and extensions - Electricity - apprenticeships - mechanical manufacturing - machinery and agricultural equipment - agricultural machinery - maintenance of agricultural machinery and equipment - Makatronieks- oil occupations (measurement and control devices - Industrial electricity) - Medical equipment maintenance - all industrial high schools, technological - computer technology - Informatics - programming and operating systems - maintenance of computers and computer equipment - computer networks\r\n Duration of study: two years minimum'),
(268, 58, 85, NULL, '../../common/web/uploads/1483029727'),
(269, 59, 85, NULL, '../../common/web/uploads/1483029727'),
(270, 60, 85, NULL, '../../common/web/uploads/1483029727'),
(271, 44, 1, 8, 'كلية جديدة ثثثانية'),
(272, 44, 2, 8, '<p>وصف كلية جديدة ثثثانية</p>'),
(273, 44, 1, 9, 'Tanie'),
(274, 44, 2, 9, '<p>Tanie Desc</p>'),
(275, 44, 3, NULL, '../../common/web/uploads/1483099713'),
(276, 44, 1, 8, 'كلية جديدة ثثثانية'),
(277, 44, 2, 8, '<p>وصف كلية جديدة ثثثانية</p>'),
(278, 44, 1, 9, 'Tanie'),
(279, 44, 2, 9, '<p>Tanie Desc</p>'),
(280, 44, 3, NULL, '../../common/web/uploads/1483099743'),
(281, 44, 1, 8, 'كلية جديدة ثثثانية'),
(282, 44, 2, 8, '<p>وصف كلية جديدة ثثثانية</p>'),
(283, 44, 1, 9, 'Tanie'),
(284, 44, 2, 9, '<p>Tanie Desc</p>'),
(285, 44, 3, NULL, '../../common/web/uploads/1483099743'),
(286, 42, 1, 9, 'Bbb'),
(287, 42, 2, 9, '<p>KLNL</p>'),
(330, 67, 88, NULL, 'student1'),
(331, 67, 89, NULL, 'student1'),
(332, 67, 90, NULL, '2332'),
(333, 67, 91, NULL, '45'),
(334, 67, 92, NULL, '545'),
(335, 67, 93, NULL, '54'),
(336, 67, 94, NULL, '54'),
(337, 67, 95, NULL, '10'),
(338, 68, 33, NULL, '67'),
(339, 68, 34, NULL, '22'),
(340, 68, 35, NULL, '2016-12-01T01:00'),
(341, 69, 104, NULL, '67'),
(342, 69, 105, NULL, '23'),
(343, 69, 106, NULL, '2016-02-01T01:00'),
(344, 70, 112, NULL, '31'),
(345, 70, 113, NULL, '2016-01-01T01:00'),
(346, 70, 111, NULL, '67'),
(347, 62, 119, NULL, 'omar'),
(348, 62, 120, NULL, 'alsabbagh'),
(349, 62, 122, NULL, 'damascus-almidan'),
(350, 62, 121, NULL, '30'),
(351, 62, 123, NULL, '0987654321'),
(352, 62, 124, NULL, '../../common/web/uploads/1483098081t1.png'),
(353, 63, 119, NULL, 'taym'),
(354, 63, 120, NULL, 'alhulaibi'),
(355, 63, 122, NULL, 'damascus'),
(356, 63, 121, NULL, '30'),
(357, 63, 123, NULL, '098765432'),
(358, 63, 124, NULL, '../../common/web/uploads/1483098201t2.jpg'),
(359, 64, 119, NULL, 'haya'),
(360, 64, 120, NULL, 'hamoud'),
(361, 64, 122, NULL, 'damascus'),
(362, 64, 121, NULL, '22'),
(363, 64, 123, NULL, '098765543'),
(364, 64, 124, NULL, '../../common/web/uploads/1483098254t3.png'),
(365, 62, 125, NULL, '1'),
(366, 63, 125, NULL, '1'),
(367, 64, 125, NULL, '1'),
(368, 71, 119, NULL, 'maya'),
(369, 71, 120, NULL, 'hamoud'),
(370, 71, 121, NULL, '25'),
(371, 71, 122, NULL, '<p>damascus-kafarsose</p>'),
(372, 71, 123, NULL, '0987654321'),
(373, 71, 124, NULL, '../../common/web/uploads/1483170365t3.png'),
(374, 71, 125, NULL, '1'),
(375, 72, 28, NULL, '62'),
(376, 72, 29, NULL, '22'),
(377, 72, 30, NULL, '2016-12-31'),
(379, 67, 118, NULL, '1'),
(380, 73, 119, NULL, 'basel'),
(381, 73, 120, NULL, 'hamoud'),
(382, 73, 121, NULL, '30'),
(383, 73, 122, NULL, '<p>damascus</p>'),
(384, 73, 123, NULL, '098765432'),
(385, 73, 124, NULL, '../../common/web/uploads/1483216468t1.png'),
(386, 73, 125, NULL, '1'),
(387, 74, 111, NULL, '67'),
(388, 74, 112, NULL, '23'),
(389, 74, 113, NULL, '2017-01-01T11:11'),
(390, 74, 114, NULL, '10'),
(391, 74, 115, NULL, '70'),
(392, 74, 116, NULL, 'good'),
(393, 75, 111, NULL, '67'),
(394, 75, 112, NULL, '25'),
(395, 75, 113, NULL, '2017-02-01T00:00'),
(396, 75, 114, NULL, '10'),
(397, 75, 115, NULL, '60'),
(398, 75, 116, NULL, 'good'),
(399, 76, 119, NULL, 'teacher'),
(400, 76, 120, NULL, 'teacher'),
(401, 76, 121, NULL, '20'),
(402, 76, 122, NULL, '<p>Mezzeh</p>'),
(403, 76, 123, NULL, '3423423'),
(404, 76, 124, NULL, '../../common/web/uploads/1483268885wallhaven-339672.jpg'),
(405, 77, 119, NULL, 'teacher'),
(406, 77, 120, NULL, 'teacher'),
(407, 77, 121, NULL, '20'),
(408, 77, 122, NULL, '<p>Mezzeh</p>'),
(409, 77, 123, NULL, '3423423'),
(410, 77, 124, NULL, '../../common/web/uploads/1483268886wallhaven-339672.jpg'),
(411, 77, 125, NULL, '1'),
(412, 78, 112, NULL, '22'),
(413, 78, 113, NULL, '2017-02-01T02:00'),
(414, 78, 111, NULL, '67'),
(415, 79, 112, NULL, '37'),
(416, 79, 113, NULL, '2017-01-01T01:00'),
(417, 79, 111, NULL, '67'),
(418, 80, 119, NULL, 'Tea'),
(419, 80, 120, NULL, 'Dsa'),
(420, 80, 121, NULL, '32'),
(421, 80, 122, NULL, '<p>dcvVSDVS</p>'),
(422, 80, 123, NULL, '2423423'),
(423, 80, 124, NULL, '../../common/web/uploads/1483305970a1.JPG'),
(424, 81, 119, NULL, 'Tea'),
(425, 81, 120, NULL, 'Dsa'),
(426, 81, 121, NULL, '32'),
(427, 81, 122, NULL, '<p>dcvVSDVS</p>'),
(428, 81, 123, NULL, '2423423'),
(429, 81, 124, NULL, '../../common/web/uploads/1483305970a1.JPG'),
(430, 82, 119, NULL, 'Samy'),
(431, 82, 120, NULL, 'qwd'),
(432, 82, 121, NULL, '23'),
(433, 82, 122, NULL, '<p>dw</p>'),
(434, 82, 123, NULL, '234423'),
(435, 82, 124, NULL, '../../common/web/uploads/14833781581483015931sami.jpg'),
(436, 82, 125, NULL, '1'),
(437, 82, 126, NULL, '13'),
(438, 83, 28, NULL, '82'),
(439, 83, 29, NULL, '22'),
(440, 83, 30, NULL, '2017-01-01'),
(441, 83, 31, NULL, '2018-01-01'),
(442, 84, 131, 8, 'SSS'),
(443, 84, 132, 8, '<p>DDWAD</p>'),
(444, 84, 131, 9, 'aSD'),
(445, 84, 132, 9, '<p>dxadDSSD</p>'),
(446, 84, 134, NULL, '22'),
(447, 85, 139, 8, 'DD'),
(448, 85, 139, 9, 'WSW'),
(449, 85, 138, NULL, '22'),
(450, 86, 139, 8, 'DD'),
(451, 86, 139, 9, 'WSW'),
(452, 86, 138, NULL, '22'),
(453, 87, 139, 8, 'D'),
(454, 87, 139, 9, 'qwed'),
(455, 87, 138, NULL, '22'),
(456, 88, 145, NULL, '2017-01-01T01:00'),
(457, 88, 143, NULL, '22'),
(458, 88, 146, 8, 'dxad'),
(459, 88, 146, 9, 'dqwd'),
(460, 89, 146, 8, 'asedc'),
(461, 89, 146, 9, 'dasddd'),
(462, 89, 145, NULL, '2017-01-01T01:00'),
(463, 89, 143, NULL, '22'),
(464, 90, 146, 8, '2342'),
(465, 90, 146, 9, 'vdsfvsd'),
(466, 90, 145, NULL, '2017-01-01T02:00'),
(467, 90, 143, NULL, '22'),
(468, 91, 28, NULL, '82'),
(469, 91, 29, NULL, '23'),
(470, 91, 30, NULL, '2018-03-02'),
(471, 91, 31, NULL, '2017-01-01'),
(472, 92, 139, 8, 'SSS'),
(473, 92, 138, NULL, '23'),
(474, 93, 139, 8, 'SSSSSS'),
(475, 93, 138, NULL, '22'),
(476, 92, 139, 9, 'sss'),
(477, 93, 139, 9, 'sssssss'),
(478, 94, 131, 8, 'Sasdcas'),
(479, 94, 132, 8, '<p>CDASCsdac</p>'),
(480, 94, 131, 9, 'ADDC'),
(481, 94, 132, 9, '<p>SDXD</p>'),
(482, 94, 134, NULL, '22'),
(483, 95, 139, 8, 'ADXADCA'),
(484, 95, 139, 9, 'DASDXAS'),
(485, 95, 138, NULL, '22'),
(486, 96, 146, 8, 'DASDXA'),
(487, 96, 146, 9, 'CASDCA'),
(488, 96, 144, NULL, '95'),
(489, 96, 145, NULL, '2017-01-01T01:00'),
(490, 96, 143, NULL, '22'),
(491, 97, 184, 8, '<p>DASdc</p>'),
(492, 97, 185, 8, '<p>DCA</p>'),
(493, 97, 186, 8, '<p>acsd</p>'),
(494, 97, 187, 8, '<p>adxas</p>'),
(495, 97, 188, 8, '<p>adaw</p>'),
(496, 97, 190, 8, '<p>wdqa</p>'),
(497, 97, 184, 9, '<p>dwdw</p>'),
(498, 97, 185, 9, '<p>dwqd</p>'),
(499, 97, 186, 9, '<p>wfde</p>'),
(500, 97, 187, 9, '<p>wfw</p>'),
(501, 97, 188, 9, '<p>wef</p>'),
(502, 97, 190, 9, '<p>wf</p>'),
(503, 97, 189, NULL, '22'),
(504, 97, 191, 8, '<p>DSADX</p>'),
(505, 97, 191, 9, 'DSDSDAS'),
(506, 98, 196, NULL, '97'),
(507, 98, 198, NULL, '12'),
(508, 98, 199, NULL, '1'),
(509, 98, 197, NULL, '85'),
(510, 99, 196, NULL, '97'),
(511, 99, 198, NULL, '21'),
(512, 99, 199, NULL, '12'),
(513, 99, 197, NULL, '85'),
(514, 100, 28, NULL, '82'),
(515, 100, 29, NULL, '32'),
(516, 100, 30, NULL, '2016-01-01'),
(517, 100, 31, NULL, '2018-01-01'),
(518, 101, 131, 8, 'الوسائط الفائقة'),
(519, 101, 132, 8, '<p style="text-align: right;"><br /><strong>الوسائط الفائقة</strong>، هو امتدادا من <a href="https://ar.wikipedia.org/wiki/%D9%86%D8%B5_%D9%81%D8%A7%D8%A6%D9%82" target="_blank" rel="noopener noreferrer">النص التشعبي</a> وهو وسيلة غير خطية للمعلومات التي تتضمن الرسومات والصوت والفيديو والنص الذي يحتوي على الارتباطات التشعبية. وهذا يتناقض تماما مع مفهوم <a href="https://ar.wikipedia.org/wiki/%D9%88%D8%B3%D8%A7%D8%A6%D8%B7_%D9%85%D8%AA%D8%B9%D8%AF%D8%AF%D8%A9" target="_blank" rel="noopener noreferrer">الوسائط المتعددة</a> الواسعة الانتشار، والتي قد تشمل العروض الخطية غير التفاعلية فضلا .عن الوسائط الفائقة<br />ارتبط مفهوم الوسائط الفائقة بالكثير من المحاضرات العلمية الالكترونية، وقد استخدم لأول مرة في عام 1965 من قبل تيد نيلسون..<br />تعتبر <a href="https://ar.wikipedia.org/wiki/%D8%B4%D8%A8%D9%83%D8%A9_%D8%B9%D9%86%D9%83%D8%A8%D9%88%D8%AA%D9%8A%D8%A9_%D8%B9%D8%A7%D9%84%D9%85%D9%8A%D8%A9" target="_blank" rel="noopener noreferrer">شبكة الويب العالمية</a> مثال كلاسيكي من الوسائط الفائقة، بينما تعتبر .العروض السينمائية غير التفاعلية مثال للوسائط المتعددة</p>\r\n<h1 style="text-align: right;"><strong>أدوات التطوير:</strong></h1>\r\n<p>يمكن تطوير تطبيقات الوسائط الفائقة على الأجهزة المدمجة و استخدامها في صناعة الموبايل والاشارات الرقمية وذلك باستخدام &nbsp;تقنية (<a href="https://ar.wikipedia.org/wiki/%D8%B1%D8%B3%D9%88%D9%85%D9%8A%D8%A7%D8%AA_%D9%85%D8%AA%D8%AC%D9%87%D9%8A%D8%A9_%D9%85%D8%AA%D8%BA%D9%8A%D8%B1%D8%A9" target="_blank" rel="noopener noreferrer">SVG</a>) الموصفة من قبل <a href="https://www.w3.org/" target="_blank" rel="noopener noreferrer">W3C</a> (رابطة الشبكة العالمية) .</p>\r\n<p>تعتبر التطبيقات البرمجية كتطبيق <a href="https://en.wikipedia.org/wiki/Ikivo_Animator" target="_blank" rel="noopener noreferrer">Ikivo Animator</a> و &nbsp;<a href="https://en.wikipedia.org/wiki/Inkscape" target="_blank" rel="noopener noreferrer">Inkscape</a> امثلة مبسطة عن تطوير محتوى الوسائط الفائقة بالاعتماد على SVG.</p>\r\n<p>&nbsp;الأجهزة المدمجة مثل <a href="https://en.wikipedia.org/wiki/IPhone" target="_blank" rel="noopener noreferrer">iPhone</a> يدعم أصلا مواصفات SVG، ويمكن استخدامه لإنشاء تطبيقات الوسائط الفائقة.</p>\r\n<h1 style="text-align: right;"><strong>التعلم والوسائط الفائقة:</strong></h1>\r\n<p style="text-align: right;">هناك العديد من النظريات المتعلقة بالوسائط الفائقة والتعلم و أحد أهم هذه النظريات المطروحة المتعلقة بالوسائط الفائقة والتعلم هو أنه يوفر المزيد من السيطرة على البيئة التعليمية للقارئ أو للطالب. وهناك نظرية أخرى هي أنه الوسائط الفائقة تجعل الطلاب على مستوى تنافسي &nbsp;فيما بينهم وذلك لما لديهم من قدرات متفاوتة ويعزز التعلم التعاوني. وهناك أيضا فكرة مطروحة من علم النفس هو أن الوسائط التشعبية تشبه بشكل كبير بنية الدماغ، مقارنة مع النص المطبوع.</p>'),
(520, 101, 131, 9, 'The Hypermedia'),
(521, 101, 132, 9, '<p><strong>Hypermedia</strong>, an extension of the term <a href="https://en.wikipedia.org/wiki/Hypertext" target="_blank" rel="noopener noreferrer">hypertext</a>, is a nonlinear medium of information which includes graphics, audio, video, plain text and hyperlinks. This contrasts with the broader term <a href="https://en.wikipedia.org/wiki/Multimedia" target="_blank" rel="noopener noreferrer">multimedia</a>, which may include non-interactive linear presentations as well as hypermedia. It is also related to the field of electronic literature. The term was first used in a 1965 article by Ted Nelson.<br /><a href="https://en.wikipedia.org/wiki/World_Wide_Web" target="_blank" rel="noopener noreferrer">The World Wide Web</a> is a classic example of hypermedia, whereas a non-interactive cinema presentation is an example of standard multimedia due to the absence of hyperlinks.</p>\r\n<h2><strong><span id="Development_tools" class="mw-headline">Development tools:</span></strong></h2>\r\n<p>&nbsp;</p>\r\n<p>Hypermedia applications may be developed on embedded devices for the mobile and the&nbsp;<a href="https://en.wikipedia.org/wiki/Digital_signage" target="_blank" rel="noopener noreferrer">digital signage</a>&nbsp;industries using the&nbsp;<a href="https://en.wikipedia.org/wiki/Scalable_Vector_Graphics" target="_blank" rel="noopener noreferrer">Scalable Vector Graphics</a>&nbsp;(SVG) specification from W3C (<a href="https://en.wikipedia.org/wiki/World_Wide_Web_Consortium" target="_blank" rel="noopener noreferrer">World Wide Web Consortium</a>). Software applications such as&nbsp;<a href="https://en.wikipedia.org/wiki/Ikivo_Animator" target="_blank" rel="noopener noreferrer">Ikivo Animator</a>&nbsp;and&nbsp;<a href="https://en.wikipedia.org/wiki/Inkscape" target="_blank" rel="noopener noreferrer">Inkscape</a>&nbsp;simplify the development of hypermedia content based on SVG. Embedded devices such as&nbsp;<a href="https://en.wikipedia.org/wiki/IPhone" target="_blank" rel="noopener noreferrer">iPhone</a>&nbsp;natively support SVG specifications and may be used to create mobile and distributed hypermedia applications.</p>\r\n<h1>Learning And Hypermedia:</h1>\r\n<p>There have been a number of theories concerning hypermedia and learning. One important claim in the literature on hypermedia and learning is that it offers more control over the instructional environment to the reader or student. Another claim is that it makes level the playing field among students of varying abilities and enhances collaborative learning. A claim from psychology includes the notion that hypermedia more closely models the structure of the brain, in comparison with printed text.</p>'),
(522, 101, 134, NULL, '32'),
(523, 101, 133, NULL, ''),
(524, 102, 131, 8, 'الويب الدلالي'),
(525, 102, 132, 8, '<p style="text-align: right;">ا<strong>لويب الدلالي:</strong>&nbsp;هو ثورة جديدة في عالم <a href="https://ar.wikipedia.org/wiki/%D8%B4%D8%A8%D9%83%D8%A9_%D8%B9%D9%86%D9%83%D8%A8%D9%88%D8%AA%D9%8A%D8%A9_%D8%B9%D8%A7%D9%84%D9%85%D9%8A%D8%A9" target="_blank" rel="noopener noreferrer">الويب</a> حيث تصبح المعلومات والبيانات قابلة للمعالجة منطقياً من قِبل برامج الحاسوب بحيث تتحول تلك المعلومات والبيانات إلى شبكة بيانات ذات معنى ،"أي أنه يمكن للبرامج الحاسوبية الخاصة أن تعرف ماذا تعني هذه البيانات و يعرف ايضا بأنه التعريف الصريح عن المعلومات الموجودة في العديد من تطبيقات الويب، ودمج المعلومات بطريقة ذكية، وتوفير الوصول المعنوي الدلالي إلى الإنترنت، واستخراج المعرفة من النصوص.</p>\r\n<h2 style="text-align: right;">&nbsp;المشكلة :</h2>\r\n<p style="text-align: right;"><br />تعتبر شبكة الوب أغنى المصادر المعلوماتية بما تحويه من مستندات ومعلومات ومصادر منوعة يمكن الوصول إليها عن طريق <a href="https://www.google.com/url?sa=t&amp;rct=j&amp;q=&amp;esrc=s&amp;source=web&amp;cd=4&amp;cad=rja&amp;uact=8&amp;sqi=2&amp;ved=0ahUKEwjh6sj5waTRAhVEjCwKHUa0BSMQFggnMAM&amp;url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D9%2585%25D8%25AD%25D8%25B1%25D9%2583_%25D8%25A8%25D8%25AD%25D8%25AB&amp;usg=AFQjCNGzFuxO4LAViGsvPnW0UvDRrISn-A&amp;sig2=5rf6S9plEkYM_WdSiS9e2w&amp;bvm=bv.142059868,d.bGg" target="_blank" rel="noopener noreferrer">محركات البحث التقليدية</a>. غير أن تنظيم هذه المعلومات والمستندات بصورة تسهل عملية البحث فيها والوصول إليها، يعتبر أمراً غاية في الصعوبة. يضاف إلى ذلك، أنه في ظل التزايد المستمر في حجم المعلومات المنشورة في شبكة الويب أصبح من الصعب قيام محركات البحث بإيجاد المعلومات المناسبة.<br />ومن هذه المشكلة ظهرت فكرة "الويب ذات الدلالات والمعاني اللفظية"،</p>\r\n<h2 style="text-align: right;">لبحث في الويب الدلالي:</h2>\r\n<ul>\r\n<li style="text-align: right;">\r\n<h3>كيف نستطيع أن نمثل المعرفة بطريقة تجعلها قابلة للفهم والمعالجة أوتوماتيكياً من قبل الحواسيب؟</h3>\r\n<br />ظهر مصطلح <a href="https://www.google.com/url?sa=t&amp;rct=j&amp;q=&amp;esrc=s&amp;source=web&amp;cd=4&amp;cad=rja&amp;uact=8&amp;ved=0ahUKEwjp8OeMw6TRAhWD2CwKHccPBb8QFggpMAM&amp;url=https%3A%2F%2Far.wikipedia.org%2Fwiki%2F%25D8%25A3%25D9%2586%25D8%25B7%25D9%2588%25D9%2584%25D9%2588%25D8%25AC%25D9%258A%25D8%25A9_(%25D8%25B9%25D9%2584%25D9%2585_%25D8%25A7%25D9%2584%25D9%2585%25D8%25B9%25D9%2584%25D9%2588%25D9%2585%25D8%25A7%25D8%25AA)&amp;usg=AFQjCNFQypFs4Bsz0OjVCqPMDurMUUUXkw&amp;sig2=XufVfo9s05eT1NrD1gezZw&amp;bvm=bv.142059868,d.bGg" target="_blank" rel="noopener noreferrer">الأنطولوجيا</a> الذي له أصله في علم الفلسفة، ففي الفلسفة يعني دراسة الكيانات والعلاقات بينها واسقط الباحثون في مجال الويب الدلالي هذا المصطلح في حل مشاكلهم فاستخدموه للتعبير عن تمثيل رسمي للمعرفة على أنها مجموعة من المفاهيم .في مجال محدد، والعلاقات بين هذه المفاهيم</li>\r\n<li style="text-align: right;">\r\n<h3>عندما نحصل على هذه المعلومات؛ كيف يمكننا أن نستفيد منها في التطبيقات الواقعية العملية؟</h3>\r\n</li>\r\n</ul>\r\n<p style="text-align: right;"><br />لنفرض نظام ويب دلالي مهمته إدارة بيع وشراء سيارت مستعملة عبر الإنترنت. فهذا النظام سوف يحتوي على برنامجين رئيسيين:<br />واحد من أجل الذين يريدون شراء سيارة<br />وآخر من أجل الذين يريدون بيع سيارة<br />في البرنامج الأول يستخدم المستخدم تطبيقاً يكتب فيه اسم شركة وموديل السيارة التي يريد شراءها ويجب في هذا البرنامج سؤال المستخدم عن اسمه وعنوانه وبريده الإلكتروني وتخزينها في ملفات RDF أما في البرنامج الثاني فيستخدم المستخدم تطبيقاً يكتب فيه اسم شركة وموديل السيارة التي يريد بيعها وعندما يرسل المستخدم الطلب سوف يطلب التطبيق منه المزيد من المعلومات وتخزينها في ملف (<a href="https://ar.wikipedia.org/wiki/%D8%A5%D8%B7%D8%A7%D8%B1_%D8%AA%D9%88%D8%B5%D9%8A%D9%81_%D8%A7%D9%84%D9%85%D9%88%D8%A7%D8%B1%D8%AF" target="_blank" rel="noopener noreferrer">RDF</a>)إن ما يفعله هذا البرنامج وراء الكواليس هو إنشاء ملف (RDF) يحوي العديد من مؤشرات الـ (RDF) فهو يضع مؤشراً للمعلومات عن المستخدم ومؤشراً للشركة المصنعة للسيارة وموديلاتها ووتجار الشركة في منطقة المستخدم ومؤشراً لقطع الغيار والأسعار وغيرها.</p>\r\n<h2 style="text-align: right;"><br />أهمية الويب الدلالي:</h2>\r\n<p style="text-align: right;">الويب الدلالي هو الحل الطبيعي لمشاكل الويب، وهو الطريقة التي لا بد منها لجعل إيراد المعلومات الهائل على الويب مفيداً ومستجيباً للبشر؛ حيث لا نستطيع بعد الآن أن نعرض العقل البشري لهذه الكمية الهائلة من البيانات وأن نتوقع منه أن يتعامل معها وو يحللها ويستخرج ويركب المعرفة منها. بدلاً من ذلك، يجب أن نكون قادرين على أن نعالج المعلومات أوتوماتيكياً ونقدمها للمستخدم منمذجة ومرتبة لغرض معين، والويب الدلالي يسهل علينا هذه المهمة فهو يصف العلاقات بين الأشياء وخصائصها عن طريق استخدام مجموعة من الأدوات التي تساعد في تحقيق ذلك </p>'),
(526, 102, 131, 9, 'The Semantic Web'),
(527, 102, 132, 9, '<p><strong>The Semantic Web</strong> :It is a new revolution in the world of the <a href="https://en.wikipedia.org/wiki/World_Wide_Web" target="_blank" rel="noopener noreferrer">Web</a>, where information and data that they can be logically for processing by the computer programs so that information and data into a meaningful that is, it can own computer programs that know what this data means data network.</p>\r\n<p>The problem:</p>\r\n<p>Wide Web richest information sources including content of the documents and information and sources of variety can be accessed through traditional search engines are considered. However, such information and documents in the organization facilitates the search process and the access to it, is considered extremely difficult. In addition, that in light of the ever-growing volume of information published on the web has become more difficult for the <a href="https://en.wikipedia.org/wiki/Search_engine_(computing)" target="_blank" rel="noopener noreferrer">search engines</a> to find the appropriate information.<br />It is this problem appeared idea "with connotations and meanings verbal Web".</p>\r\n<h2>Search in the Semantic Web:</h2>\r\n<ul style="list-style-type: circle;">\r\n<li>\r\n<h3>How can we represent knowledge in a way makes it understandable automatically and processing by computers?</h3>\r\n<a href="https://www.google.com/url?sa=t&amp;rct=j&amp;q=&amp;esrc=s&amp;source=web&amp;cd=2&amp;cad=rja&amp;uact=8&amp;ved=0ahUKEwj9mqHUxaTRAhUCWSwKHXR3AKIQFggmMAE&amp;url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FOntology&amp;usg=AFQjCNHym2TphODvbecbaicgAKIEMQcVCA&amp;sig2=0yo-dENkkRP0lwPl_uIkCQ&amp;bvm=bv.142059868,d.bGg" target="_blank" rel="noopener noreferrer">ontology</a> term, which has its origin in philosophy, in philosophy means the study of entities and the relationships between them, the researchers dropped the Semantic Web field of this term in solving their problems Fastkhaddmoh to express a formal representation of knowledge as a set of .In concepts specific area, and the relationships between these concepts.</li>\r\n<li>\r\n<h3>When we get this information; how we can benefit from them in real practical applications?</h3>\r\nSuppose a semantic web system management task sale and purchase of used cars over the Internet. This system will contain two major programs:</li>\r\n<li>One for those who want to buy a car</li>\r\n<li>And another for those who want to sell a car<br />In the first program the user uses the application writes it and model of the car company that wants to purchase and must be in the program the user a question about his name, address, e-mail and stored in <a href="https://en.wikipedia.org/wiki/Resource_Description_Framework" target="_blank" rel="noopener noreferrer">RDF </a>files, while in the second program uses the user application writes it and model of the car company that wants to sell, and when the user sends the request name the application of it will ask for more information and store it in a file (RDF) that what this is doing the program behind the scenes is to create a file (RDF) Includes many indicators of (RDF) it puts an indication of the information about the user and an indication of the manufacturer of the car models and the company''s dealers in the area user and an indication of the spare parts and prices, among others.</li>\r\n</ul>\r\n<h2>The importance of the Semantic Web:</h2>\r\n<p>Semantic Web is a natural solution to the problems of the web, a method which is a must to make revenue tremendous information on the web useful and responsive to humans; where we can not anymore to show the human mind to this enormous quantitative data and expect him to deal with Wu analyzed and extracted and riding a knowledge of them . Instead, we should be able to process information automatically and our user modeled and arranged for a particular purpose, and the Semantic Web easier for us this task it describes relationships between objects and their properties by using a set of tools that will help to achieve it.</p>'),
(528, 102, 134, NULL, '32'),
(529, 103, 184, 8, '<p style="text-align: right;">متى ظهر مفهوم الوسائط الفائقة؟</p>'),
(530, 103, 185, 8, '<p style="text-align: right;">1820</p>'),
(531, 103, 186, 8, '<p style="text-align: right;">1865</p>'),
(532, 103, 187, 8, '<p style="text-align: right;">1965</p>'),
(533, 103, 188, 8, '<p style="text-align: right;">2000</p>'),
(534, 103, 190, 8, '<p style="text-align: right;">2000</p>'),
(535, 103, 191, 8, 'ظهور مصطلح الوسائط الفائقة'),
(536, 103, 184, 9, '<p>when was the term "hypermedia" first used?</p>'),
(537, 103, 185, 9, '<p>1820</p>'),
(538, 103, 186, 9, '<p>1865</p>'),
(539, 103, 187, 9, '<p>1965</p>'),
(540, 103, 188, 9, '<p>2000</p>'),
(541, 103, 190, 9, '<p>1965</p>'),
(542, 103, 191, 9, 'the term of hypermedia'),
(543, 103, 189, NULL, '32'),
(544, 104, 184, 8, '<p style="text-align: right;">يعتبر الويب الدلالي</p>'),
(545, 104, 185, 8, '<p style="text-align: right;">w1.0</p>'),
(546, 104, 186, 8, '<p style="text-align: right;">w2.0</p>'),
(547, 104, 187, 8, '<p style="text-align: right;">w3.0</p>'),
(548, 104, 188, 8, '<p style="text-align: right;">w4.0</p>'),
(549, 104, 190, 8, '<p style="text-align: right;">w3.0</p>'),
(550, 104, 191, 8, 'الويب الدلالي'),
(551, 104, 184, 9, '<p>the Semantic Web is?</p>'),
(552, 104, 185, 9, '<p>w1.0</p>'),
(553, 104, 186, 9, '<p>w2.0</p>'),
(554, 104, 187, 9, '<p>w3.0</p>'),
(555, 104, 188, 9, '<p>w4.0</p>'),
(556, 104, 190, 9, '<p>w3.0</p>'),
(557, 104, 191, 9, 'the semantic web'),
(558, 104, 189, NULL, '32'),
(559, 105, 184, 8, '<p style="text-align: right;">تعتبر الشبكة العنكبوتية العالمية</p>'),
(560, 105, 185, 8, '<p style="text-align: right;">مثال عن الوسائط الفائقة</p>'),
(561, 105, 186, 8, '<p style="text-align: right;">مثال عن الويب الدلالي</p>'),
(562, 105, 187, 8, '<p style="text-align: right;">الخيار الأول و الثاني</p>'),
(563, 105, 188, 8, '<p style="text-align: right;">ولا خيار مما سبق</p>'),
(564, 105, 190, 8, '<p style="text-align: right;">مثال عن الوسائط الفائقة</p>'),
(565, 105, 191, 8, 'الشبكة العنكبوتية العالمية'),
(566, 105, 184, 9, '<p>the world wide web is&nbsp;</p>'),
(567, 105, 185, 9, '<p>hypermedia example</p>'),
(568, 105, 186, 9, '<p>symantic web example</p>'),
(569, 105, 187, 9, '<p>both</p>'),
(570, 105, 188, 9, '<p>none of them</p>'),
(571, 105, 190, 9, '<p>hypermedia example</p>'),
(572, 105, 191, 9, 'the world wide web'),
(573, 105, 189, NULL, '32'),
(574, 106, 139, 8, 'الأول'),
(575, 106, 139, 9, 'first'),
(576, 106, 138, NULL, '32'),
(577, 107, 146, 8, 'امتحان تطبيقات الويب'),
(578, 107, 146, 9, 'internet application exam'),
(579, 107, 144, NULL, '106'),
(580, 107, 145, NULL, '2017-01-03T10:00'),
(581, 107, 143, NULL, '32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_title` (`category_title`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `menu_language`
--
ALTER TABLE `menu_language`
  ADD PRIMARY KEY (`menu_language_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `language_id` (`language_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

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
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `values`
--
ALTER TABLE `values`
  ADD PRIMARY KEY (`value_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `field_id` (`field_id`),
  ADD KEY `language_id` (`language_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `menu_language`
--
ALTER TABLE `menu_language`
  MODIFY `menu_language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_perm`
--
ALTER TABLE `role_perm`
  MODIFY `role_perm_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `values`
--
ALTER TABLE `values`
  MODIFY `value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=582;
--
-- Constraints for dumped tables
--

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
