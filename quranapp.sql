-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2018 at 08:27 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quranapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `role`, `username`, `password`) VALUES
(1, 'super', 'admin', 'admin3215');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ayath`
--

DROP TABLE IF EXISTS `tbl_ayath`;
CREATE TABLE IF NOT EXISTS `tbl_ayath` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `surah_no` varchar(20) NOT NULL,
  `ayath_no` varchar(20) NOT NULL,
  `ayath_image` varchar(100) NOT NULL,
  `ayath_video` varchar(100) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surah`
--

DROP TABLE IF EXISTS `tbl_surah`;
CREATE TABLE IF NOT EXISTS `tbl_surah` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `surah_no` varchar(11) NOT NULL,
  `surah_name` varchar(100) NOT NULL,
  `surah_name_ar` varchar(100) NOT NULL DEFAULT '0',
  `juzuh` varchar(11) NOT NULL DEFAULT '0',
  `surah_image` varchar(100) NOT NULL DEFAULT '0',
  `surah_video` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surah`
--

INSERT INTO `tbl_surah` (`s_id`, `surah_no`, `surah_name`, `surah_name_ar`, `juzuh`, `surah_image`, `surah_video`) VALUES
(1, '1', 'Fatiha', '0', '1', '0', '0'),
(2, '2', 'al-bakara', '0', '1', '0', '0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
