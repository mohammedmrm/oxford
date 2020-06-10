-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 06:09 PM
-- Server version: 5.7.20
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ox`
--

-- --------------------------------------------------------

--
-- Table structure for table `award_penalty`
--

CREATE TABLE `award_penalty` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `staff_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(1) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `award_penalty`
--

INSERT INTO `award_penalty` (`id`, `amount`, `staff_id`, `status`, `type`, `year`, `month`, `date`, `note`) VALUES
(9, 120, 1, NULL, 1, 2020, 1, '2020-01-26 17:49:59', 'Good work'),
(10, 50, 2, NULL, 1, 2020, 1, '2020-01-26 17:50:42', 'bad'),
(11, 50, 4, NULL, 2, 2020, 1, '2020-01-31 17:00:46', 'delay');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `money` float NOT NULL,
  `branch_id` int(11) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `note` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `date`, `balance`, `status`, `money`, `branch_id`, `reason`, `note`) VALUES
(1, '2020-01-05 20:54:54', 500, 1, 500, 1, 'قسط الطالب - REG-OXF-BAB-0005-19', 'تسديد قسط دراسي'),
(2, '2020-01-05 21:03:48', 800, 1, 300, 1, 'قسط الطالب )REG-OXF-BAB-0007-19(', 'تسديد قسط دراسي'),
(3, '2019-12-05 22:10:34', 900, 1, 100, 1, 'قسط الطالب )REG-OXF-BAB-0007-19(', 'تسديد قسط دراسي'),
(4, '2020-01-05 22:10:45', 1000, 1, 100, 1, 'قسط الطالب )REG-OXF-BAB-0007-19(', 'تسديد قسط دراسي'),
(5, '2020-01-09 23:57:57', -4050, 0, 5050, 1, 'رواتب', ''),
(6, '2020-01-10 13:39:42', -9100, 0, 5050, 1, 'رواتب', ''),
(7, '2020-01-12 23:16:04', -9000, 1, 100, 6, 'قسط الطالب )REG-OXF-BAB-0001-20(', 'تسديد قسط دراسي'),
(8, '2020-01-12 23:19:55', -8900, 1, 100, 6, 'قسط الطالب )REG-OXF-BAB-0001-20(', 'تسديد قسط دراسي'),
(9, '2020-01-12 23:20:17', -8500, 1, 400, 6, 'قسط الطالب )REG-OXF-BAB-0001-20(', 'تسديد قسط دراسي'),
(10, '2020-01-12 23:22:09', -8400, 1, 100, 1, 'قسط الطالب )REG-OXF-BAB-0007-19(', 'تسديد قسط دراسي'),
(11, '2020-01-12 23:22:11', -8300, 1, 100, 1, 'قسط الطالب )REG-OXF-BAB-0007-19(', 'تسديد قسط دراسي'),
(12, '2020-01-12 23:22:13', -7900, 1, 400, 1, 'قسط الطالب )REG-OXF-BAB-0006-19(', 'تسديد قسط دراسي'),
(13, '2020-01-12 23:22:27', -7800, 1, 100, 1, 'قسط الطالب )REG-OXF-BAB-0006-19(', 'تسديد قسط دراسي'),
(14, '2020-01-12 23:22:31', -7200, 1, 600, 1, 'قسط الطالب )REG-OXF-BAG-0001-19(', 'تسديد قسط دراسي'),
(15, '2020-01-12 23:22:34', -6700, 1, 500, 1, 'قسط الطالب )REG-OXF-BAG-0002-19(', 'تسديد قسط دراسي'),
(16, '2020-01-12 23:22:37', -6700, 1, 0, 1, 'قسط الطالب )REG-OXF-BAB-0003-19(', 'تسديد قسط دراسي'),
(17, '2020-01-12 23:22:39', -6700, 1, 0, 1, 'قسط الطالب )REG-OXF-BAB-0007-19(', 'تسديد قسط دراسي'),
(18, '2020-01-12 23:22:45', -6300, 1, 400, 1, 'قسط الطالب )REG-OXF-BAG-0007-19(', 'تسديد قسط دراسي'),
(19, '2020-01-12 23:22:48', -5900, 1, 400, 1, 'قسط الطالب )REG-OXF-BAG-0001-20(', 'تسديد قسط دراسي'),
(20, '2020-01-12 23:22:51', -5500, 1, 400, 1, 'قسط الطالب )REG-OXF-BAG-0004-19(', 'تسديد قسط دراسي'),
(21, '2020-01-12 23:22:54', -5100, 1, 400, 1, 'قسط الطالب )REG-OXF-BAG-0006-19(', 'تسديد قسط دراسي'),
(22, '2020-01-12 23:22:56', -4600, 1, 500, 1, 'قسط الطالب )REG-OXF-BAG-0003-19(', 'تسديد قسط دراسي'),
(23, '2020-01-12 23:23:02', -4300, 1, 300, 1, 'قسط الطالب )REG-OXF-BAG-0005-19(', 'تسديد قسط دراسي'),
(24, '2020-01-12 23:23:24', -4200, 1, 100, 1, 'قسط الطالب )REG-OXF-BAG-0003-19(', 'تسديد قسط دراسي'),
(25, '2020-02-12 23:23:27', -4100, 1, 100, 1, 'قسط الطالب )REG-OXF-BAG-0005-19(', 'تسديد قسط دراسي'),
(26, '2020-01-13 12:59:32', -4300, 0, 200, 1, 'نثرية', ''),
(27, '2020-01-13 17:50:42', -4800, 0, 500, 1, 'نثرية', ''),
(28, '2020-01-19 16:47:03', -4700, 1, 100, 1, 'قسط الطالب )REG-OXF-BAG-0003-20(', 'تسديد قسط دراسي'),
(29, '2020-01-19 17:01:32', -4600, 1, 100, 1, 'قسط الطالب )REG-OXF-BAG-0003-20(', 'تسديد قسط دراسي'),
(30, '2020-01-19 17:01:39', -4300, 1, 300, 1, 'قسط الطالب )REG-OXF-BAG-0002-20(', 'تسديد قسط دراسي'),
(31, '2020-01-26 16:40:54', -4210, 1, 90, 1, 'عقوبة', 'Panelty'),
(32, '2020-01-26 16:45:45', -4300, 0, 90, 1, 'مكافاه', 'Award'),
(33, '2020-01-26 17:49:59', -4420, 0, 120, 1, 'مكافاه', 'Award'),
(34, '2020-01-26 17:50:42', -4470, 0, 50, 1, 'مكافاه', 'Award'),
(35, '2020-01-27 22:11:36', -4420, 1, 50, 1, 'قسط الطالب - REG-OXF-BAB-0004-19', 'تسديد الغرامة دراسي'),
(36, '2020-01-27 22:14:30', -4370, 1, 50, 1, 'قسط الطالب - REG-OXF-BAB-0004-19', 'تسديد الغرامة دراسي'),
(37, '2020-01-27 22:17:24', -4320, 1, 50, 1, 'غرامة الطالب - REG-OXF-BAB-0004-19', 'تسديد الغرامة دراسي'),
(38, '2020-01-31 16:56:42', -4300, 1, 20, 1, 'غرامة الطالب - REG-OXF-BAB-0006-19', 'تسديد الغرامة دراسي'),
(39, '2020-01-31 17:00:46', -4250, 1, 50, 1, 'عقوبة', 'Panelty');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `serial` varchar(4) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(250) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `serial`, `date`, `note`, `name`, `email`, `phone`) VALUES
(1, 'BAG', '2019-11-30 15:32:25', '', 'فرع بغداد', 'bag@oxf.com', '07822816693'),
(5, 'NAJ', '2019-12-18 18:02:57', '', 'فرع النجف', 'Najaf@oxf.com', '07822816693'),
(6, 'BAB', '2020-01-12 22:49:34', '', 'فرع الحلة', 'bab@oxf.org', '09876543211'),
(7, 'DIW', '2020-01-16 17:19:29', '', 'فرع الديوانية', '', '09876543256');

-- --------------------------------------------------------

--
-- Table structure for table `branch_balance`
--

CREATE TABLE `branch_balance` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` double NOT NULL,
  `status` int(11) NOT NULL,
  `money` double NOT NULL,
  `reason` varchar(250) DEFAULT NULL,
  `note` varchar(250) DEFAULT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch_balance`
--

INSERT INTO `branch_balance` (`id`, `date`, `balance`, `status`, `money`, `reason`, `note`, `branch_id`) VALUES
(3, '2020-01-13 17:50:42', 500, 1, 500, NULL, '', 1),
(4, '2020-02-13 17:52:12', 400, 0, 100, 'Stuff', '', 1),
(5, '2020-01-13 17:55:39', 350, 0, 50, 'Award', '', 1),
(6, '2020-01-19 16:53:28', 300, 0, 100, 'Stuff', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `money` double NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirm` int(11) NOT NULL DEFAULT '0',
  `note` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `branch_id`, `money`, `date`, `confirm`, `note`) VALUES
(23, 1, 500, '2020-01-13 17:49:32', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `maxDiscount` int(11) NOT NULL DEFAULT '100',
  `logo` varchar(250) NOT NULL DEFAULT 'logos/logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `maxDiscount`, `logo`) VALUES
(1, 100, 'logos/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` varchar(250) NOT NULL DEFAULT ' ',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `note`, `date`, `branch_id`) VALUES
(2, 'A', '', '2019-12-02 23:09:08', 1),
(3, 'A', '', '2020-01-06 12:52:38', 7),
(4, 'A', '', '2020-01-06 12:54:54', 3),
(5, 'B', '', '2020-01-13 18:01:49', 1),
(6, 'Group mirage', '', '2020-01-19 16:42:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` varchar(11) DEFAULT ' ',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `name`, `note`, `date`, `price`) VALUES
(1, 'Kids', ' ', '2019-11-30 15:37:38', 300),
(2, 'A', ' ', '2019-11-30 15:38:56', 400),
(4, 'B', '', '2019-11-30 17:25:19', 500),
(5, 'C', '', '2019-12-10 14:47:13', 600);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_id` int(11) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `date`, `student_id`, `confirm`) VALUES
(5, 500, '2019-12-06 00:00:00', 18, 2),
(7, 300, '2019-12-14 00:00:00', 20, 2),
(8, 100, '2019-12-28 00:00:00', 20, 2),
(9, 100, '2019-12-28 00:00:00', 20, 2),
(10, 400, '2019-12-21 00:00:00', 19, 2),
(11, 100, '2019-12-14 00:00:00', 19, 2),
(14, 50, '2019-12-07 00:00:00', 7, 0),
(15, 50, '2019-12-21 00:00:00', 7, 0),
(16, 600, '2019-12-19 00:00:00', 21, 2),
(19, 500, '2019-12-26 00:00:00', 22, 2),
(20, 100, '2019-12-28 00:00:00', 23, 2),
(21, 500, '2019-12-31 00:00:00', 23, 2),
(22, 400, '2019-12-27 00:00:00', 24, 2),
(24, 400, '2019-12-27 00:00:00', 26, 2),
(25, 400, '2019-12-27 00:00:00', 27, 2),
(28, 100, '2020-01-12 00:00:00', 25, 2),
(29, 300, '2020-01-25 00:00:00', 25, 2),
(30, 400, '2020-01-12 00:00:00', 28, 2),
(32, 100, '2020-01-18 00:00:00', 29, 2),
(33, 400, '2020-01-31 00:00:00', 29, 2),
(45, 100, '2020-01-16 00:00:00', 10, 0),
(46, 450, '2020-01-30 00:00:00', 10, 0),
(47, 100, '2020-01-30 00:00:00', 30, 0),
(48, 300, '2020-01-31 00:00:00', 30, 2),
(52, 100, '2020-01-20 00:00:00', 31, 2),
(53, 400, '2020-01-30 00:00:00', 31, 0),
(54, 100, '2020-01-31 00:00:00', 32, 0),
(55, 350, '2020-02-01 00:00:00', 32, 0),
(56, 0, '2020-01-28 00:00:00', 19, 0),
(57, 400, '2020-01-28 00:00:00', 33, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `note`) VALUES
(1, 'مدير عام', ''),
(2, 'محاسب', ''),
(3, 'مدير الموارد البشرية', ''),
(4, 'مدير فرع', ''),
(5, 'تدريسي', '');

-- --------------------------------------------------------

--
-- Table structure for table `salary_pays`
--

CREATE TABLE `salary_pays` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `money` double NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirm` tinyint(4) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `staff_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `salary` float NOT NULL,
  `role_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(250) DEFAULT ' ',
  `password` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '1',
  `address` varchar(250) NOT NULL,
  `documents` varchar(200) NOT NULL,
  `img` varchar(100) NOT NULL,
  `end_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `phone`, `salary`, `role_id`, `date`, `note`, `password`, `branch_id`, `address`, `documents`, `img`, `end_date`) VALUES
(1, 'محمد رضا محمد', '', '07822816693', 600, 1, '2019-11-05 00:00:00', NULL, '$2a$07$gNZLR1QnLimdSYRFibKDFO2yCvQG6tjn3leuanoy96FB5g0WTOPpO', 1, 'Babil- alshawy', '', 'img/5e008735a9c86.jpg', '2029-12-13 20:45:27'),
(2, 'علي جاسم حسن', 'moh@oxf.com', '09876544423', 600, 2, '2019-11-23 11:32:28', ' ', '$2a$07$oPXzvtwaps1X42qPztewQ.CTTFuiJeWMViBHOpr888mrY40uwHrVq', 1, 'الحلة- نادر 2', 'documents/5e18c5af677c4.jpg', 'img/5e1c7b0cf31f9.jpg', '2029-01-13 00:00:00'),
(3, 'Zainab alwaisi', '', '009647822816693', 800, 3, '2019-11-28 16:18:52', ' ', '$2a$07$SnuTLg24eX3jscVbDx5rN.i//1ije5v.P9fnQ/PEXjPZQDysDMOJi', 1, 'حلة بابل', 'documents/5e1ad471de811.jpg', 'img/5e064b0cee732.jpg', '2029-12-13 20:45:27'),
(6, 'محمد غازي سموم', 'mohammed.rbn4@yhaoo.com', '7519135964', 600, 5, '2019-12-10 14:31:50', ' ', '$2a$07$BtsLkDS5PM4TNLYVmTZfvOy09asK1dNhKJTHfAw9J6UdRWH7bQWxC', 1, 'حلة', 'documents/5e1ad463e265d.jpg', 'img/5e064c2d513bf.jpg', '2029-12-13 20:45:27'),
(7, 'احمد حسن علي', 'ahmmed@oxf.net', '07822815593', 780, 4, '2019-12-12 21:45:12', ' ', '$2a$07$n3g5ul8i8cq5Y4noADYlweBkD02kxjQ33mYcxgCEG.bZsCAciKOcO', 1, 'بابل', 'documents/5e1ad4436c88d.jpg', 'img/5e244d0d16915.jpg', '2029-12-13 20:45:27'),
(9, 'Mohammed Ridha', 'mohammed.rbn4@yhaoo.com', '00979722816693', 500, 5, '2020-01-10 17:38:54', ' ', '$2a$07$vHdESIY0UgggIqPuTul91uWuRVLLv9AcFvagyr8bGrjWQgeZnPDbK', 6, 'babel', 'documents/5e188c7e9bcba.jpg', 'img/5e188c7e9b948.jpg', '2021-03-18 17:38:54'),
(10, 'وائل بكر الحسني', 'wal@oxf.org', '123456654321', 800, 4, '2020-01-12 22:51:47', ' ', '$2a$07$Wd2CKRXt8LqoP3FFvNH6rud8d3U7G74bYJ38FtSOD1ZuYbOnXaz9y', 6, 'بابل  الخسروية', 'documents/5e1b78d3bc226.jpg', 'img/5e1b78d3bbec1.jpg', '2020-01-12 22:51:47'),
(11, 'علي كريم', '', '098765432333', 800, 2, '2020-01-13 17:12:45', ' ', '$2a$07$n5ezjmopip4tzDLsyQbf6eDhDNl4GsBBdJPFqGYwo9SKCIJ1thdae', 1, 'بغداد - الكرادة', 'documents/5e1c7add3ff42.jpg', 'img/5e1c7add3f74e.jpg', '2020-01-13 00:00:00'),
(12, 'جميل طالب', 'd@oxf.net', '1346544654668', 900, 4, '2020-01-28 20:05:52', ' ', '$2a$07$YRlmhkT0r1IwKmMtDqTyJeuoe5rdnMA57BmMUedLXbaDWgUjSa33O', 7, 'ديوانية', '_', 'img/5e3069f02f80c.jpg', '2025-06-18 00:00:00'),
(13, 'Mohammed', 'mohammed.rbn4@yhaoo.com', '0096478228166', 800, 3, '2020-01-28 20:40:28', ' ', '$2a$07$F6oZBJ4MRAO03El2SuhbLOqsfoMutyo9e0.uaPM09Rtd/mNy2Cr/y', 1, 'hnubn', '_', '_', '2020-01-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_leave`
--

CREATE TABLE `staff_leave` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `with_salary` int(1) NOT NULL DEFAULT '0',
  `confirm` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_leave`
--

INSERT INTO `staff_leave` (`id`, `staff_id`, `start_date`, `end_date`, `with_salary`, `confirm`) VALUES
(4, 1, '2020-04-20', '2020-04-23', 2, 0),
(5, 2, '2020-04-02', '2020-04-05', 2, 1),
(6, 2, '2020-01-09', '2020-01-30', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `birthday` date NOT NULL,
  `student_number` varchar(100) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `level_id` int(11) DEFAULT NULL,
  `payment_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `manager_id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL DEFAULT ' _',
  `passport` varchar(100) NOT NULL DEFAULT '_',
  `id1` varchar(100) DEFAULT '_',
  `id2` varchar(100) NOT NULL DEFAULT '_',
  `id3` varchar(100) NOT NULL DEFAULT '_',
  `phone` varchar(18) NOT NULL,
  `serial` int(4) NOT NULL,
  `students_status_id` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` double NOT NULL DEFAULT '0',
  `gran_name` varchar(200) NOT NULL DEFAULT '_',
  `gran_phone` varchar(20) NOT NULL DEFAULT '0',
  `address` varchar(250) NOT NULL DEFAULT '_',
  `discount` double NOT NULL DEFAULT '0',
  `reg_fee` double NOT NULL DEFAULT '0',
  `extra_fee` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `gender`, `birthday`, `student_number`, `payment_type`, `level_id`, `payment_id`, `branch_id`, `date`, `update_date`, `manager_id`, `img`, `passport`, `id1`, `id2`, `id3`, `phone`, `serial`, `students_status_id`, `group_id`, `start_date`, `total_price`, `gran_name`, `gran_phone`, `address`, `discount`, `reg_fee`, `extra_fee`) VALUES
(7, 'زينب علي', 2, '2019-11-22', 'REG-OXF-BAB-0002-19', 2, 5, 0, 5, '2019-11-22 17:43:22', '2020-01-13 12:35:16', 1, 'img/5e00c346973ce.jpg', 'passport/5e19c337b76cd.jpg', 'id1/5decfaeb79bfc.jpg', '_', '_', '07822816690', 2, 1, 2, '2017-01-06 00:00:00', 100, '_', '0', '_', 0, 25, 0),
(10, 'حسن محسن', 1, '2019-11-26', 'REG-OXF-BAB-0003-19', 2, 3, 0, 5, '2019-11-26 17:34:02', '2020-01-19 15:15:23', 1, 'img/5e00c3364fb00.jpg', 'passport/5e1c4579d8c14.jpg', 'id1/5e20726fe1600.jpg', '_', '_', '07822816693', 3, 2, 2, '2020-01-19 00:00:00', 500, '_', '0', '_', 0, 0, 50),
(11, 'حسن محسن', 1, '2019-02-26', 'REG-OXF-BAB-0004-19', 1, 2, 0, 1, '2020-02-14 17:43:26', '2020-01-29 01:44:53', 1, 'img/5e00c32c8e86a.jpg', '_', '_', '_', '_', '07822816693', 4, 2, 5, '2020-02-29 00:00:00', 0, '_', '0', '_', 0, 0, 0),
(18, 'Mohammed Ridha', 1, '2019-12-06', 'REG-OXF-BAB-0005-19', 1, 4, 0, 1, '2019-12-06 12:52:12', '2020-01-28 17:03:54', 1, 'img/5e00c301e2cff.jpg', '_', '_', '_', '_', '07822816693', 5, 3, 2, '2020-01-28 00:00:00', 0, '_', '0', '_', 0, 0, 0),
(19, 'Information Technology', 1, '2019-12-06', 'REG-OXF-BAB-0006-19', 1, 2, 0, 1, '2019-12-06 15:40:35', '2020-01-31 17:32:51', 1, 'img/5e00c31aa3168.jpg', '_', '_', '_', '_', '07822816693', 6, 4, 2, '2019-12-06 15:40:35', 500, '_', '0', '_', 0, 0, 0),
(20, 'Information Technology', 1, '2019-12-06', 'REG-OXF-BAB-0007-19', 2, 4, 0, 1, '2019-12-06 15:49:28', '2020-01-13 12:48:56', 1, 'img/5e00c2f5d3e26.jpg', '_', '_', '_', 'id3/5dea4e5852f4c.jpg', '07822816693', 7, 1, 2, '2019-12-06 15:49:28', 500, '_', '0', '_', 0, 0, 10),
(21, 'محمد غازي سموم', 2, '2004-01-05', 'REG-OXF-BAG-0001-19', 1, 5, 0, 1, '2019-12-19 19:11:44', '2019-12-23 16:36:42', 1, 'img/5e00c2ea36fc2.jpg', '_', '_', '_', '_', '07822816693', 1, 1, 2, '2019-12-19 19:11:44', 600, '_', '0', '_', 0, 0, 0),
(22, 'زيد باسم', 2, '2001-02-06', 'REG-OXF-BAG-0002-19', 1, 4, 0, 1, '2019-12-27 00:09:03', '2019-12-27 00:09:03', 1, 'img/5e05216fbb485.jpg', '_', '_', '_', '_', '07822816693', 2, 1, 0, '2019-12-27 00:09:03', 500, 'علي جعفر', '07855816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(23, 'باسم جاسم علي', 1, '1993-06-08', 'REG-OXF-BAG-0003-19', 2, 5, 0, 1, '2019-12-27 00:22:50', '2019-12-27 00:22:50', 1, 'img/5e0524aaa4a2e.jpg', '_', '_', '_', '_', '07822816693', 3, 1, 0, '2019-12-27 00:22:50', 600, 'محسن علي جبير', '07824816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(24, 'سالم حسن عبود', 1, '2019-12-04', 'REG-OXF-BAG-0004-19', 1, 2, 0, 1, '2019-12-27 21:27:48', '2019-12-27 22:27:20', 1, 'img/5e065b1808791.jpg', '_', '_', '_', '_', '07822816693', 4, 1, 2, '2019-12-27 21:27:48', 400, 'باسم بلاسم', '07822816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(25, 'سالم حسن عبود', 1, '2019-12-04', 'REG-OXF-BAG-0005-19', 2, 2, 0, 1, '2019-12-27 21:28:29', '2020-01-11 16:00:47', 1, 'img/5e064d4d0952e.jpg', '_', '_', '_', '_', '07822816693', 5, 1, 0, '2019-12-27 21:28:29', 400, 'باسم بلاسم', '07822816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(26, 'سالم حسن عبود', 1, '2019-12-04', 'REG-OXF-BAG-0006-19', 1, 2, 0, 1, '2019-12-27 21:28:30', '2019-12-27 22:27:06', 1, 'img/5e065b0a98f0f.jpg', '_', '_', '_', '_', '07822816693', 6, 1, 2, '2019-12-27 21:28:30', 400, 'باسم بلاسم', '07822816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(27, 'سالم حسن عبود', 1, '2019-12-04', 'REG-OXF-BAG-0007-19', 1, 2, 0, 1, '2019-12-27 21:28:30', '2019-12-27 22:27:38', 1, 'img/5e065b2a38326.jpg', '_', '_', '_', '_', '07822816693', 7, 1, 2, '2019-12-27 21:28:30', 400, 'باسم بلاسم', '07822816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(28, 'حسين كامل حسن', 1, '2007-03-01', 'REG-OXF-BAG-0001-20', 1, 2, 0, 1, '2020-01-12 11:43:48', '2020-01-12 11:43:48', 1, 'img/5e1adc44b1189.jpg', 'passport/5e1adc44b1641.jpg', '_', '_', '_', '0987899879', 1, 1, 0, '2020-01-12 11:43:48', 400, 'علي جابر', '1234432122', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(29, 'شيماء علي', 2, '2009-03-12', 'REG-OXF-BAB-0001-20', 2, 4, 0, 6, '2020-01-12 22:59:06', '2020-01-12 23:13:31', 10, 'img/5e1b7a8abf779.jpg', '_', '_', '_', '_', '07822816693', 1, 1, 0, '2020-01-12 22:59:06', 500, 'جاسم كاظم', '1234678987654', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(30, 'محمد احمد علي', 1, '1979-01-07', 'REG-OXF-BAG-0002-20', 2, 2, 0, 1, '2020-01-16 17:43:10', '2020-01-16 17:43:10', 7, 'img/5e20767e86951.jpg', '_', '_', '_', '_', '07812265040', 2, 1, 0, '2020-01-16 17:43:10', 400, 'علي ', '0988906445', 'Hillah - 30st - Al Gadeer District', 0, 25, 0),
(31, 'علي جاسم محمد', 1, '2009-01-04', 'REG-OXF-BAG-0003-20', 2, 2, 0, 1, '2020-01-19 16:06:49', '2020-01-19 16:26:35', 7, 'img/5e24546956f2d.jpg', 'passport/5e24546957282.jpg', 'id1/5e24560911a8a.jpg', '_', '_', '07822816693', 3, 3, 2, '2020-01-31 00:00:00', 400, 'حسن علي', '07822816693', 'Hillah - 30st - Al Gadeer District', 100, 25, 100),
(32, 'علي علي', 1, '2020-01-04', 'REG-OXF-BAG-0004-20', 2, 2, 0, 1, '2020-01-28 17:23:14', '2020-01-28 17:23:14', 7, '_', '_', '_', '_', '_', '07822816693', 4, 1, 0, '2020-01-28 17:23:14', 400, 'حسن حسن', '07822816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 50),
(33, 'Mohammed', 1, '2020-01-10', 'REG-OXF-BAG-0005-20', 1, 2, 0, 1, '2020-01-28 18:58:59', '2020-01-28 18:58:59', 7, '_', '_', '_', '_', '_', '07822816693', 5, 1, 6, '2020-01-28 18:58:59', 400, 'ممم', '07822816693', 'Hillah - 30st - Al Gadeer District', 0, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_evalution`
--

CREATE TABLE `students_evalution` (
  `id` int(11) NOT NULL,
  `attendance` int(1) NOT NULL,
  `homework` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `lecture` int(11) NOT NULL,
  `lecture_date` datetime NOT NULL,
  `note` varchar(250) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_evalution`
--

INSERT INTO `students_evalution` (`id`, `attendance`, `homework`, `grade`, `lecture`, `lecture_date`, `note`, `date`, `student_id`) VALUES
(5, 1, 1, 9, 7, '2020-01-22 00:00:00', '', '2020-01-23 00:38:57', 11),
(6, 1, 2, 10, 4, '2020-01-20 00:00:00', '', '2020-01-23 00:40:27', 7),
(7, 1, 1, 8, 4, '2020-01-20 00:00:00', '', '2020-01-23 00:40:27', 10),
(8, 1, 1, 9, 4, '2020-01-20 00:00:00', '', '2020-01-23 00:40:27', 19),
(9, 0, 1, 0, 4, '2020-01-20 00:00:00', '', '2020-01-23 00:40:27', 20),
(10, 1, 1, 10, 4, '2020-01-20 00:00:00', '', '2020-01-23 01:23:12', 27),
(11, 1, 1, 10, 5, '2020-01-20 00:00:00', '', '2020-01-23 01:54:03', 11),
(12, 1, 1, 5, 4, '2020-01-20 00:00:00', '', '2020-01-23 01:54:16', 24),
(13, 0, 1, 1, 4, '2020-01-20 00:00:00', '', '2020-01-23 01:54:48', 21),
(14, 2, 1, 2, 4, '2020-01-20 00:00:00', '', '2020-01-23 01:54:56', 26),
(15, 1, 0, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 7),
(16, 1, 0, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 10),
(17, 1, 1, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 19),
(18, 1, 1, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 20),
(19, 1, 1, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 21),
(20, 1, 1, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 24),
(21, 1, 1, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 26),
(22, 1, 1, 6, 1, '2020-01-19 00:00:00', '', '2020-01-29 00:56:59', 27);

-- --------------------------------------------------------

--
-- Table structure for table `students_leave`
--

CREATE TABLE `students_leave` (
  `id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` varchar(250) DEFAULT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_leave`
--

INSERT INTO `students_leave` (`id`, `start`, `end`, `date`, `note`, `student_id`) VALUES
(12, '2020-02-14', '2020-02-15', '2020-01-27 21:30:16', NULL, 19),
(13, '2020-01-20', '2020-01-20', '2020-01-22 21:31:28', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `students_penalty`
--

CREATE TABLE `students_penalty` (
  `id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 suspend,2 leave, 3 others',
  `note` varchar(250) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_id` int(11) NOT NULL,
  `confirm` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_penalty`
--

INSERT INTO `students_penalty` (`id`, `amount`, `type`, `note`, `date`, `student_id`, `confirm`) VALUES
(14, 50, 2, 'غرامة بسب اجازة لمدة 5', '2020-01-27 21:28:27', 11, 2),
(15, 20, 2, 'غرامة بسب اجازة لمدة 2', '2020-01-27 21:29:55', 19, 2),
(16, 20, 2, 'غرامة بسب اجازة لمدة 2', '2020-01-27 21:30:16', 19, 0),
(18, 50, 1, 'غرمة بسب التأجيل لمدة 26 يوم', '2020-01-29 01:44:53', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_status`
--

CREATE TABLE `students_status` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` varchar(250) NOT NULL DEFAULT ' ',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_status`
--

INSERT INTO `students_status` (`id`, `name`, `note`, `date`) VALUES
(1, 'باشر', ' ', '2019-12-01 13:46:35'),
(2, 'مؤجل', ' ', '2019-12-01 13:46:35'),
(3, 'مفصول', ' ', '2020-01-16 15:40:36'),
(4, 'متخرج', ' ', '2020-01-24 18:11:06'),
(5, 'نقل', ' ', '2020-01-28 18:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `students_status_tracking`
--

CREATE TABLE `students_status_tracking` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_id` int(11) NOT NULL,
  `students_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students_status_tracking`
--

INSERT INTO `students_status_tracking` (`id`, `date`, `student_id`, `students_status_id`) VALUES
(1, '2020-01-28 18:58:59', 33, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `day` varchar(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `note` varchar(250) NOT NULL DEFAULT ' ',
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `teacher_id`, `group_id`, `start`, `end`, `day`, `name`, `note`, `branch_id`) VALUES
(1, 6, 2, '13:00:00', '14:00:00', '1', 'writing', ' ', 1),
(4, 6, 2, '13:00:00', '14:00:00', '2', 'reading', ' ', 1),
(5, 6, 2, '10:00:00', '11:00:00', '7', 'writing', ' ', 1),
(6, 6, 5, '10:00:00', '12:00:00', '5', 'reading', ' ', 1),
(7, 6, 5, '10:00:00', '12:00:00', '4', 'reading', ' ', 1),
(8, 9, 5, '10:00:00', '11:00:00', '1', 'reading', ' ', 1),
(9, 9, 5, '10:00:00', '11:00:00', '2', 'reading', ' ', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `award_penalty`
--
ALTER TABLE `award_penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_balance`
--
ALTER TABLE `branch_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_pays`
--
ALTER TABLE `salary_pays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_leave`
--
ALTER TABLE `staff_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_evalution`
--
ALTER TABLE `students_evalution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_leave`
--
ALTER TABLE `students_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_penalty`
--
ALTER TABLE `students_penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_status`
--
ALTER TABLE `students_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_status_tracking`
--
ALTER TABLE `students_status_tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `award_penalty`
--
ALTER TABLE `award_penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `branch_balance`
--
ALTER TABLE `branch_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salary_pays`
--
ALTER TABLE `salary_pays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staff_leave`
--
ALTER TABLE `staff_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `students_evalution`
--
ALTER TABLE `students_evalution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `students_leave`
--
ALTER TABLE `students_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `students_penalty`
--
ALTER TABLE `students_penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `students_status`
--
ALTER TABLE `students_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_status_tracking`
--
ALTER TABLE `students_status_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
