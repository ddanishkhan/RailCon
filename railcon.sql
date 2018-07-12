-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 04:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `railcon`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
`id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `oldstudent`
--

CREATE TABLE IF NOT EXISTS `oldstudent` (
`id` int(10) unsigned NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `semester` tinyint(2) unsigned NOT NULL,
  `email` varchar(30) NOT NULL,
  `DOB` date NOT NULL,
  `contact` bigint(15) unsigned NOT NULL,
  `aadhar` bigint(15) unsigned NOT NULL,
  `address` varchar(50) NOT NULL,
  `pincode` mediumint(6) unsigned NOT NULL,
  `source` varchar(20) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `passno` varchar(20) DEFAULT NULL,
  `pass_end` date DEFAULT NULL,
  `voucher` varchar(20) DEFAULT NULL,
  `season` int(20) DEFAULT NULL,
  `classof` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `img_loc` varchar(50) NOT NULL,
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateofentry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetodelete` timestamp NULL DEFAULT NULL,
  `Remark` varchar(50) NOT NULL DEFAULT 'No Remarks'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oldstudent`
--

INSERT INTO `oldstudent` (`id`, `fullname`, `gender`, `semester`, `email`, `DOB`, `contact`, `aadhar`, `address`, `pincode`, `source`, `destination`, `passno`, `pass_end`, `voucher`, `season`, `classof`, `duration`, `branch`, `year`, `img_loc`, `verified`, `dateofentry`, `datetodelete`, `Remark`) VALUES
(28, 'Random Gal1', 1, 5, 'randomgal@gmail.com', '1995-02-02', 9191919191, 123456789121, 'Some', 400016, 'Santacruz', 'Byculla Station', 'passnumber', '2018-04-09', 'voucher', 1234, 'Second', 'Monthly', 'Electronics Engineer', 'T.E', '', 0, '2018-04-09 18:30:00', '2018-05-09 18:30:00', 'No Remarks'),
(29, 'Random Gal2', 1, 5, 'randomgal2@gmail.com', '1995-02-02', 9191919191, 123456789121, 'Some', 400016, 'Santacruz', 'Byculla Station', 'passnumber', '2018-04-09', 'voucher', 1234, 'Second', 'Monthly', 'Electronics Engineer', 'T.E', '', 0, '2018-04-09 18:30:00', '2018-04-07 18:30:00', 'No Remarks'),
(31, 'Random Gal3', 1, 5, 'randomgal3@gmail.com', '1998-03-03', 9191919192, 123456789121, 'Some', 400016, 'Santacruz', 'Byculla Station', 'passnumber', '2018-04-09', 'voucher', 1234, 'Second', 'Monthly', 'Electronics Engineer', 'T.E', '', 0, '2018-04-09 18:30:00', '2018-04-07 18:30:00', 'No Remarks'),
(32, 'Random Gal4', 1, 5, 'randomgal4@gmail.com', '1998-03-03', 9191919192, 123456789121, 'Some', 400016, 'Santacruz', 'Byculla Station', 'passnumber', '2018-04-09', 'voucher', 1234, 'Second', 'Monthly', 'Electronics Engineer', 'T.E', '', 0, '2018-04-09 18:30:00', '2018-04-03 18:30:00', 'No Remarks'),
(33, 'Random Guy2', 0, 5, 'randomguy2@gmail.com', '1998-03-03', 9191919192, 123456789121, 'Some', 400016, 'Santacruz', 'Byculla Station', 'passnumber', '2018-04-09', 'voucher', 1234, 'Second', 'Monthly', 'Electronics Engineer', 'T.E', '', 0, '2018-04-09 18:30:00', '2018-04-01 18:30:00', 'No Remarks');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`id` int(10) unsigned NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `semester` tinyint(2) unsigned NOT NULL,
  `email` varchar(30) NOT NULL,
  `DOB` date NOT NULL,
  `contact` bigint(15) unsigned NOT NULL,
  `aadhar` bigint(15) unsigned NOT NULL,
  `address` varchar(50) NOT NULL,
  `pincode` mediumint(6) unsigned NOT NULL,
  `source` varchar(20) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `passno` varchar(20) DEFAULT NULL,
  `pass_end` date DEFAULT NULL,
  `voucher` varchar(20) DEFAULT NULL,
  `season` int(20) DEFAULT NULL,
  `classof` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `year` varchar(20) NOT NULL,
  `img_loc` varchar(50) NOT NULL,
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dateofentry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datetodelete` timestamp NULL DEFAULT NULL,
  `Remark` varchar(50) NOT NULL DEFAULT 'No Remarks'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fullname`, `gender`, `semester`, `email`, `DOB`, `contact`, `aadhar`, `address`, `pincode`, `source`, `destination`, `passno`, `pass_end`, `voucher`, `season`, `classof`, `duration`, `branch`, `year`, `img_loc`, `verified`, `dateofentry`, `datetodelete`, `Remark`) VALUES
(21, 'Random Guy', 0, 6, 'random@gmail.com', '1997-07-07', 9167386706, 123456789121, 'Khar', 400011, 'Khar', 'Byculla Station', 'SomeNumber', '2017-05-05', 'voucher', 1234, 'First', 'Quarterly', 'Information Technolo', 'T.E', '1523296125IDCARD.jpeg', 0, '2018-04-08 18:30:00', '2018-07-07 18:30:00', 'No Remarks');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oldstudent`
--
ALTER TABLE `oldstudent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `oldstudent`
--
ALTER TABLE `oldstudent`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `clearoldrecords` ON SCHEDULE EVERY 1 DAY STARTS '2018-04-09 23:39:08' ON COMPLETION NOT PRESERVE DISABLE DO DELETE FROM student WHERE datetodelete < (NOW() - INTERVAL 1 DAY)$$

CREATE DEFINER=`root`@`localhost` EVENT `clearrecordseconds` ON SCHEDULE EVERY 1 MINUTE STARTS '2018-04-10 00:00:00' ON COMPLETION PRESERVE DISABLE DO DELETE FROM student WHERE datetodelete < (NOW() - INTERVAL 1 DAY)$$

CREATE DEFINER=`root`@`localhost` EVENT `e_daily` ON SCHEDULE EVERY 10 DAY STARTS '2018-04-09 00:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
INSERT INTO oldstudent(id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark)

SELECT id,fullname,gender,semester,email,DOB,contact,aadhar,address,pincode,source,  destination,passno,pass_end,voucher,season,classof,duration,branch,year,verified,dateofentry,datetodelete,Remark

FROM student

WHERE datetodelete < (NOW() - INTERVAL 1 DAY);

DELETE FROM student WHERE datetodelete < (NOW() - INTERVAL 1 DAY);
END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
