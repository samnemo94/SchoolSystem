-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2017 at 04:45 PM
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
(21, 'first_name', 'الاسم', 8, 'varchar', '', 0, 0, 1),
(22, 'last_name', 'الكنية', 8, 'varchar', '', 0, 0, 1),
(23, 'age', 'العمر', 8, 'int', '', 0, 0, 1),
(24, 'address', 'العنوان', 8, 'text', '', 0, 0, 1),
(25, 'phone', 'الهاتف', 8, 'varchar', '', 0, 1, 1),
(26, 'photo', 'الصورة الشخصية', 8, 'image', '', 0, 1, 1),
(28, 'teacher_id', 'المدرس', 9, 'foreign_key', '8', 0, 0, 1),
(29, 'subject_id', 'المادة', 9, 'foreign_key', '4', 0, 0, 1),
(30, 'form_date', 'من تاريخ', 9, 'date', '', 0, 0, 1),
(31, 'to_date', 'الى', 9, 'date', '', 0, 0, 1),
(39, 'title', 'اسم الدرس', 6, 'varchar', '', 1, 0, 1),
(40, 'description', 'الوصف', 6, 'text', '', 1, 0, 1),
(41, 'image', 'صورة', 6, 'image', '', 0, 0, 0),
(42, 'subject', 'المادة', 6, 'foreign_key', '4', 0, 0, 1),
(43, 'lesson_id', NULL, 6, 'int', '', 0, 0, 1),
(44, 'file_id', NULL, 12, 'int', '', 0, 0, 1),
(45, 'lesson_id', 'الدرس', 12, 'foreign_key', '6', 0, 0, 1),
(46, 'file_link', 'الملف', 12, 'file', '', 0, 0, 1),
(47, 'template_id', NULL, 13, 'int', '', 0, 0, 1),
(48, 'subject_id', 'المادة', 13, 'foreign_key', '4', 0, 0, 1),
(49, 'exam_id', NULL, 14, 'int', '', 0, 0, 1),
(50, 'subject_id', 'المادة', 14, 'foreign_key', '4', 0, 0, 1),
(51, 'template_id', 'نموذج الامتحان', 14, 'foreign_key', '13', 0, 0, 1),
(52, 'exam_date', 'تاريخ الامتحان', 14, 'date', '', 0, 0, 1),
(53, 'question_id', NULL, 15, 'int', '', 0, 0, 1),
(54, 'question_text', 'تص السؤال', 15, 'text', '', 1, 0, 1),
(55, 'choice1', 'الخيار الأول', 15, 'text', '', 1, 0, 1),
(56, 'choice2', 'الخيار الثاني', 15, 'text', '', 1, 0, 1),
(57, 'choice3', 'الخيار الثالث', 15, 'text', '', 1, 0, 1),
(58, 'choice4', 'الخيار الرابع', 15, 'text', '', 1, 0, 1),
(63, 'question_id', 'السؤال', 11, 'int', '', 0, 0, 1),
(64, 'lesson_id', 'الامتحان', 11, 'foreign_key', '6', 0, 0, 1),
(65, 'question_text', 'نص السؤال', 11, 'text', '', 1, 0, 1),
(66, 'choice1', 'الخيار الأول', 11, 'text', '', 1, 0, 1),
(67, 'choice2', 'الخيار الثاني', 11, 'text', '', 1, 0, 1),
(68, 'choice3', 'الخيار الثالث', 11, 'varchar', '', 1, 0, 1),
(69, 'choice4', 'الخيار الرابع', 11, 'text', '', 1, 0, 1),
(76, 'title', 'العنوان', 17, 'varchar', '', 1, 0, 1),
(77, 'image', 'صورة', 17, 'image', '', 0, 1, 1),
(78, 'description', 'الوصف', 17, 'text', '', 1, 0, 1),
(83, 'title', 'العنوان', 18, 'varchar', '', 1, 0, 1),
(84, 'description', 'الوصف', 18, 'text', '', 1, 0, 1),
(85, 'image', 'صورة', 18, 'image', '', 0, 1, 1),
(86, 'user', NULL, 19, 'int', '', 0, 0, 0),
(88, 'first_name', 'الاسم ', 7, 'varchar', '', 0, 0, 1),
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
(117, 'is_active', 'مفعل', 8, 'int', NULL, 0, 0, 0),
(118, 'is_active', 'مفعل', 7, 'int', NULL, 0, 0, 0),
(119, 'answer', 'الجواب', 15, 'text', NULL, 1, 0, 1),
(120, 'question_id', 'السؤال', 16, 'foreign_key', '15', 0, 0, 1),
(121, 'template_id', 'نموذج الامتحان', 16, 'foreign_key', '13', 0, 0, 1),
(122, 'mark', 'علامة السؤال', 16, 'double', '', 0, 0, 1),
(123, 'order', 'الترتيب', 16, 'int', '', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`field_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fields_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
