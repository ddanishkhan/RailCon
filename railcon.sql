-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2018 at 12:13 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password'),
(2, 'majid', 'majid@mhsscoe2018');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=471 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fullname`, `gender`, `semester`, `email`, `DOB`, `contact`, `aadhar`, `address`, `pincode`, `source`, `destination`, `passno`, `pass_end`, `voucher`, `season`, `classof`, `duration`, `branch`, `year`, `img_loc`, `verified`, `dateofentry`, `datetodelete`, `Remark`) VALUES
(301, 'Arbaaz Tamboli', 0, 7, 'arbaazt21@gmail.com', '1997-05-21', 8600203263, 123456789, 'A-103, Shrenik Park, Agashi Road, Virar West.', 401301, 'Virar', 'Mumbai Central', '', '2018-07-12', 'H795374', 2123, 'First', 'Quarterly', 'Information Technolo', 'B.E', '153168579311.jpg', 1, '2018-07-15 04:00:00', '2018-10-13 04:00:00', 'OKAY'),
(302, 'Mulla Mohammed Sufiyan', 0, 7, 'mullasufiyan79@gmail.com', '1997-09-27', 9821650500, 123456789, 'B/506, Asmita Regency-2, Naya Nagar, Mira Road Eas', 401107, 'Mira Road', 'Mumbai Central', '', '2018-05-16', '', 165, 'Second', 'Quarterly', 'Information Technolo', 'B.E', '1531775920_20180717_024634.jpg', 1, '2018-07-16 04:00:00', '2018-10-14 04:00:00', 'No Remarks'),
(303, 'Sharief Wajeed Faheem', 0, 7, 'wajeed54isred@gmail.com', '1998-02-19', 9833159603, 123456789, 'Oracle Residency,304,Plot No:11,Sector:44A, Seawoo', 400706, 'Seawoods Darave', 'Sandhurst Road Stati', '72005834', '2018-07-13', 'H664417', 5834, 'First', 'Monthly', 'Information Technolo', 'B.E', '15318130831531812794417.jpg', 1, '2018-07-17 04:00:00', '2018-08-16 04:00:00', 'No Remarks'),
(304, 'Shaikh Abdul Majid Moiz Hasan', 0, 3, 'majid3467@gmail.com', '1999-12-13', 9320099916, 123456789, 'Room no2 chawl no 7 Noor Mohammad Compd Opp Vikhro', 400086, 'Vikhroli', 'Byculla Station', '9926', '2018-05-17', '', 9926, 'First', 'Quarterly', 'Information Technolo', 'S.E', '1531813386ID1.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(305, 'Khan abdul karim abdur rasheed', 0, 7, 'khankarim920@gmail.com', '1997-04-11', 9029326435, 123456789, 'A-605 bhoomi classic sai nagar nallasopara west', 401203, 'Nallasopara', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'B.E', '1531814418New Doc 2018-07-17_1.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(306, 'Yadav Ajay Subhash', 0, 3, 'yadav199924@gmail.com', '1999-03-03', 9082146151, 123456789, 'Indira nagar lalji pada new link road kandivali We', 400067, 'Kandivali', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'S.E', '1531814506IMG_20180717_132822_133.JPG', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(307, 'JADHAV VARSHA ANKUSH', 1, 5, 'varshajadhav1118@gmail.com', '1994-04-15', 9222221118, 123456789, 'Room no. 2,  Zeenat Memon C, D.N. Dube road, Ambaw', 400068, 'Dahisar', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'T.E', '153181467515318145231341666267862.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(308, 'Yadav Ajay Subhash', 0, 3, 'yadavajay199924@gmail.com', '1999-03-03', 9082146151, 123456789, 'Indira nagar lalji pada new link road kandivali We', 400067, 'Kandivali', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Monthly', 'Electronics Engineer', 'S.E', '1531814908IMG_20180717_132822_133.JPG', 1, '2018-07-17 04:00:00', '2018-08-16 04:00:00', 'Duplicate Entry'),
(309, 'Jagrala zahir javed', 0, 7, 'zaheerjagrala12@gmail.com', '1996-02-29', 8879256342, 123456789, 'Rm 25,Amina yusuf chawl,RS marg,pathanwadi, malad ', 400097, 'Malad', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'B.E', '1531814925IMG-20180717-WA0003.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(310, 'SONKAR AMARJEET BALKISHAN', 1, 7, 'amarjeetsonkar786@gmail.com', '1997-10-12', 9867770167, 123456789, 'Room no 5 Jovan Jyoti chawl naupada Kurla west mum', 400070, 'Vidyavihar', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '153181513615318149537621440535355.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(311, 'Ambar Ritesh Sharad', 1, 5, 'ritesh1498@gmail.com', '1998-12-14', 9820727326, 123456789, 'B/14 Om Ganesh Darshan Nandivali Road Dombivli Eas', 421201, 'Dombivali', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics Engineer', 'T.E', '1531815333colg green id_1.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(312, 'Kadiri Zaid Ashfaque ', 0, 5, 'kadirizaid97@yahoo.com', '1997-12-27', 9769251164, 123456789, 'B-17, SAHIL BUILDING, ANA SAGAR MARG, Kurla (W) - ', 400070, 'Kurla ', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'T.E', '1531815404ID CARD PIC_1.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(313, 'SINGH ATUL DEVENDRA', 0, 7, 'atul.devendra95@gmail.com', '1996-09-05', 9702929093, 123456789, '502,Windsor tower shastri Nagar Andheri West mumba', 400053, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '153181541715318153022751114158650.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(314, 'Mohd Sarfraz mohd shafique', 0, 3, 'sarfrazshaikh930@gmail.com', '1996-03-22', 7506154309, 123456789, 'M P nagar dholwada mariyaman chawl DHARAVI Cross r', 400017, 'Sion', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'S.E', '1531815516IMG_20180717_134627.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(315, 'Singh deepak ravindra', 0, 3, 'singhd301099@gmail.com', '1999-10-30', 8600464942, 123456789, '207, shiv sai apartment vijay nagar narangi road v', 401305, 'Virar', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531815589IMG-20180717-WA0017.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(316, 'Shaikh sameer Karim ', 0, 3, 'ss122929@gmail.com', '1999-09-21', 8411991318, 123456789, 'B-cabin road,ambedkarnagar,ambernath,east', 421501, 'Ambernath ', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531815769IMG-20180717-WA0002.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(317, 'Khan israr ahmed', 0, 3, 'israr.khan.78686@gmail.com', '1999-09-01', 8692851541, 123456789, '201, bldg no.6, lily annex, jogeshwari west', 400102, 'Jogeshwari', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'S.E', '1531815901Screenshot_20180717-135135__01.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(318, 'Khan mohd arif mohd meraj', 0, 3, 'arifkhan9826@gmail.com', '1997-10-25', 7666515935, 123456789, 'Mahim DHARAVI Cross road banwari compound plot no ', 400017, 'Mahim', 'Mumbai Central', '65286036', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'S.E', '1531816070IMG_20180717_135339.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(319, 'Shaikh Abuhamza Javedalam', 0, 7, 'abushaikh514@gmail.com', '1996-09-12', 8898695892, 123456789, 'Room no 24, pathanwadi,eani sati marg, malad(east)', 400097, 'Malad', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'B.E', '1531816132IMG-20180717-WA0005.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(320, 'Mansoori Abubakar Mohd hanif', 0, 3, 'abubakarmansoori333@gmail.com', '1999-01-01', 8693020983, 123456789, '102 rohila apt opp tanwarnagar kausa mumbra  thane', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'S.E', '1531816519IMG-20180717-WA0005.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(321, 'Shaikh Shoaib Bahauddin', 0, 3, 'shoaibbhavans@gmail.com', '1999-11-16', 8433767223, 123456789, 'Room no 1 , makhdumiya society tilak nagar sakinak', 400072, 'Ghatkopar', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'S.E', '1531817035ShoaibID.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(322, 'Singh Vikas Surender ', 0, 5, 'vs687570@gmail.com', '1998-07-16', 9561694157, 123456789, 'Ayodhya Nagar, B. K. No. 1060, near CHM college, U', 421003, 'Ulhasnagar ', 'Byculla Station', '6077', '2018-07-23', '', 0, 'Second', 'Quarterly', 'Mechanical', 'T.E', '1531817484IMG_20180717_141056496.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(323, 'Shaikh Danish Mohammad Ayub', 0, 7, 'danish3197@gmail.com', '1997-01-31', 7021540014, 123456789, '401, B-23, Sector 11, Shanti Nagar, Mira Road (Eas', 401107, 'Mira Road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'B.E', '1531817913IMG-20180717-WA0000.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(324, 'Tripathi SaurabhKumar', 0, 7, 'saurabh31tripathi@gmail.com', '1998-01-31', 8879633969, 123456789, 'Near jost building,Indira Nagar,Rupadevi,Road no 2', 400604, 'Thane', 'Byculla Station', '25174348', '2018-05-09', 'H664372', 4348, 'Second', 'Quarterly', 'Information Technolo', 'B.E', '15318181511531818056657.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(325, 'patel mohammed zeeshan imam', 1, 5, 'zeeshanpatel87@gmail.com', '1999-05-29', 8454981557, 123456789, '613, b wing, ekta society, gillbert hill road andh', 400058, 'andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'T.E', '1531821125IMG-20180717-WA0015.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(326, 'QURAISHI MD SOHEL MD ISLAM ', 0, 3, 'sohelq987@gmail.com', '2000-02-10', 8976236472, 123456789, 'B/210, AADARSH NIWAS, NEAR JBS HIGH SCHOOL, ALKAPU', 401209, 'NALLASOPARA ', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'S.E', '1531822480Ty8MWd8DVLVYPU8bd56910h1.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(327, 'Khan Numer Nasir', 0, 7, 'numerkhan29@gmail.com', '1996-12-29', 7977216766, 123456789, 'Rehman cottage pailipada azadnagar trombay Mumbai', 400088, 'Mankhurd Station', 'Byculla Station', '', '2018-05-01', 'H664549', 9640, 'First', 'Quarterly', 'Electronics & Teleco', 'B.E', '153182299634A19F69-3A89-4C5F-B6E3-FCD3047D9C98.jpe', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(328, 'siddiqui mohd zaid', 0, 3, 'mohdzaidsiddiqui2@gmail.com', '2000-06-20', 9892720504, 123456789, 'B/205,saikrupa building,opp.hariom plaza ,mg road,', 400066, 'borivali', 'Mumbai Central', '86635624', '2018-04-17', 'H460390', 5624, 'Second', 'Quarterly', 'Computer Science', 'S.E', '1531830547IMG-20180717-WA0043.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(329, 'KINKALE SHRUTI SUDHIR', 1, 7, 'skinkale97@gmail.com', '1997-10-14', 9867089724, 123456789, '101, SURYAKANT APT. ,OPP. SAMPADA HOSPITAL, MHASOB', 421301, 'KALYAN', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'B.E', '153183139220180717_180830 (1).jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(330, 'SHAIKH ABDUL SAMAD ADAMALI', 0, 3, 'ssamad7864@gmail.com', '1999-05-07', 9702947644, 123456789, 'Q -BLOCK ANDHERI PLOT JOGESHWARI EAST MUMBAI -4000', 400060, 'Jogeshwari', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531831739IMG-20180717-WA0007.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(331, 'Hussain Usaid', 0, 3, 'usaidh99@gmail.com', '1999-11-15', 7506909574, 123456789, '404 B-WING, BLG NO 12, PMGP COLONY, MANKURD', 400094, 'Mankurd', 'Byculla Station', '', '2018-04-17', 'H460391', 9691, 'First', 'Quarterly', 'Computer Science', 'S.E', '1531834506scanner_20180717_190128', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(332, 'khan sadique riyaz', 0, 3, 'sadiquekhan786.sk@gmail.com', '2000-04-09', 9867835135, 123456789, 'room no 13, barsha budhya chawl, rahat nagar, rm r', 400102, 'jogeshwari', 'Mumbai Central', '14341094', '2018-04-15', 'H460207', 1094, 'First', 'Quarterly', 'Automobile', 'S.E', '1531835547IMG_20180717_190328~2.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(333, 'Salmani Arman husein', 0, 3, 'armaansalmani505@gmail.com', '1999-04-29', 9769902971, 123456789, 'Room no. 5,umpire chawl,bismillah nagar,gate no.7 ', 400095, 'Malad', 'Mumbai Central', '05818981', '2018-04-17', 'H460208', 8981, 'Second', 'Quarterly', 'Automobile', 'S.E', '1531836603IMG_20180717_193829.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(334, 'RAORANE DARSHAN SANTOSH', 0, 5, 'darshanraorane1@gmail.com', '1998-07-14', 8879343594, 123456789, '6, Anand Sukur Rajput Chawl, Shukla Compound, Shiv', 400068, 'DAHISAR', 'Mumbai Central', '79647803', '2018-07-23', 'H795325', 7803, 'Second', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531836903id.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(335, 'Arif sarwar shaikh', 0, 3, 'arifshaikh199@gmail.com', '1999-09-01', 8652162174, 123456789, 'Mansarovar building near iit market powai mumbai ', 400076, 'Kanjur marg', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'S.E', '1531837097A8AD8790-6F4B-4834-804B-8D6D918E5128.jpe', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(336, 'bootwala youhaan karim', 0, 3, 'youhaanbootwala.yb@gmail.com', '1999-10-16', 7030882780, 123456789, 'Bungalow no. 2, ayappa mandir marg, Stella, Vasai(', 401202, 'Vasai road', 'Mumbai Central', '', '2018-07-18', 'H795319', 83567844, 'First', 'Quarterly', 'Computer Science', 'S.E', '1531837459IMG-20180717-WA0000.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(337, 'siddesh sachin gavande', 0, 1, 'higuysitssidx@gmail.com', '1999-04-12', 8652506195, 123456789, 'room no.4,momoya park , village road Bhandup west', 400078, 'bhandup', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'S.E', '1531837566Snapchat-1303734378.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(338, 'ALAM AMIR KHURSHID', 0, 5, 'amirkhurshidalam@gmail.com', '1998-01-09', 9834002823, 123456789, 'Room no.125,7th floor,anand krupa building A-2,haj', 400604, 'Thane', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531837609IMG_20180717_154953-962x2058.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(339, 'PATHAN FAISALKHAN ARIFKHAN', 0, 7, 'fkp755@gmail.com', '1997-08-23', 9930749460, 123456789, '402 / D-1  Mahavir Apartment, Opposite Railway Sta', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'B.E', '1531838361IMG-20180717-WA0019.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(340, 'VIrani Somil Sultan', 0, 3, 'somilvirani@gmail.com', '1998-12-28', 8983462824, 123456789, 'A 303 Pravin Palace Dindayal Nagar Vasai West ', 401202, 'Vasai Road ', 'Mumbai Central', '19438479', '2018-04-16', 'H460392', 8479, 'First', 'Quarterly', 'Computer Science', 'S.E', '1531838924567481DA-863C-4721-9EA1-92218F771B6D.jpe', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(341, 'Ansari Abdullah', 0, 7, 'abdullahansari2405@gmail.com', '1997-05-24', 9773189651, 123456789, 'Room no 401 united plaza A/3    kausa Mumbra Thane', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Monthly', 'Electronics & Teleco', 'B.E', '1531839172new doc 2018-05-25 18.40.12_1.jpg', 0, '2018-07-17 04:00:00', '2018-08-16 04:00:00', 'No Remarks'),
(342, 'Patel Piyush Nanji', 0, 5, 'piyushpatel280798@gmail.com', '1998-07-28', 9819121691, 123456789, 'Room number 8, Kamala cottage, Saibaba road, Jawah', 400051, 'Khar Road', 'Mumbai Central', '', '2018-04-16', 'H460353', 9414, 'Second', 'Quarterly', 'Automobile', 'T.E', '1531840528IMG_20180717_204203-1.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(343, 'Shaikh Sharique akil', 0, 5, 'shariquenoori52@gmail.com', '1998-11-26', 9892213356, 123456789, '7,SHIVENERY COLONY,NEW BALAJI NAGAR ,AMBERNATH', 421501, 'Ambernath', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'T.E', '1531841691New Doc 2018-07-17_1.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(344, 'Siddique Zaid Akhlaq', 0, 5, 'zaidsecond@gmail.com', '1998-08-03', 8070607988, 123456789, 'Baba chawal 2 , Tagore nagar 4 , Vikhroli east , M', 400083, 'Vikhroli', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'T.E', '1531841875IMG_20180717_210530.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(345, 'shaikh mohd tahmeed iftekhar ', 0, 7, 'sunnyf676@gmail.com', '1997-11-29', 8108109776, 123456789, 'plot no: 101 ,marwa tower ,sec 50 (E)  ,seawoods  ', 400706, 'seawoods', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'B.E', '1531842107edit.jpg', 0, '2018-07-17 04:00:00', '2018-08-16 04:00:00', 'No Remarks'),
(346, 'Kari Hamza Mustafa', 0, 5, 'hamzakari043@gmail.com', '1998-03-13', 7039779597, 123456789, '115/C, Firdous BLDG., Accord Complex, Near Darul F', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531844997New Doc 2018-07-17.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(347, 'Shaikh Mohammed Akib Abdulgaff', 1, 3, 'kna292521@gmail.com', '1999-08-18', 7303051595, 123456789, 'Room no :104, Building no : 23/A, MMRDA COLONY, Go', 400043, 'Govandi', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'S.E', '1531851282IMG-20180717-WA0052.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(348, 'Ansari Mohd Aamir', 0, 7, 'aamiransari8898@gmail.com', '1997-11-30', 8898446906, 123456789, 'Madarsa talimul quran trikoni maidan masjid motila', 400104, 'Goregaon', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'B.E', '1531880985New Doc 2018-07-13_1.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(349, 'Shaikh Zaid Zakir', 0, 7, 'zaidshaikh.1998@yahoo.in', '1998-01-05', 9757092376, 123456789, '9/16 LIG Colony, Pipe Road, VB Nagar, Kurla(W), Mu', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'B.E', '1531883151New Doc 2018-07-18.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(350, 'SHAIKH OWAIS NAZIMUDDIN', 0, 3, 'shaikhowais294@gmail.com', '1999-10-17', 8652234036, 123456789, '5/B 54 narendra park venus naya nager', 401107, 'mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531885050IMG_20180717_135606.jpg', 0, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(351, 'Patel Saba Hujur ', 1, 5, 'sabapatel.029@gmail.com', '1997-09-20', 9029847325, 123456789, 'C/4, Jai ambe niwas akruli Cross road no.1 , Kandi', 400101, 'Kandivali', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531885985New Doc 2018-07-18_1.jpg', 1, '2018-07-17 04:00:00', '2018-10-15 04:00:00', 'No Remarks'),
(352, 'Shaikh sara sajid ali', 1, 5, 'shaikhsarah803@gmail.com', '1997-06-09', 8291417809, 123456789, '3/9 LIG colony pipe road kurla west mumbai', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Monthly', 'Computer Science', 'T.E', '1531886065IMG-20180718-WA0001.jpg', 0, '2018-07-17 04:00:00', '2018-08-16 04:00:00', 'No Remarks'),
(353, 'BAGWAN AFSAR MEHBOOB ', 0, 3, 'afsarbagwan9768@gmail.com', '1999-06-24', 8369214902, 123456789, 'ROOM NO :1,SARASWATI CHAWL,NITYANAND NAGAR,NEAR NO', 400086, 'Ghatkopar', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'S.E', '1531889598Screenshot_2018-07-18-10-11-03-757_com.m', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(354, 'SHAIKH HALIMA GULAM ABID', 1, 3, 'halima11298@gmail.com', '1998-12-01', 9699431817, 123456789, '3/706, JAI HIND BUDDHA VIKAS SOCIETY, JAGRUTI NAGA', 400024, 'MUMBAI', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Monthly', 'Electronics Engineer', 'S.E', '1531889652SAVE_20180717_143245.jpeg', 0, '2018-07-18 04:00:00', '2018-08-17 04:00:00', 'No Remarks'),
(355, 'Ziya mansion shaikh', 0, 3, 'ziyashaikh1432@gmail.com', '1999-04-07', 9221717263, 123456789, 'Mykadam Ali behind gram Panchayat job gaon', 421311, 'Kalyan', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531889967IMG-20180717-WA0038.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(356, 'SONAWANE SAGAR MACHINDRA', 0, 5, 'ssonawane708@gmail.com', '1997-12-05', 8286006499, 123456789, 'Room no. 13 , gangaram bhoir bldg , ghanshyam gupt', 421202, 'Dombivili', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'T.E', '1531891262IMG_20180718_104723.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(357, 'Pakale Rutvik Santosh', 0, 3, 'rutvikaka@gmail.com', '1999-08-22', 9594808488, 123456789, 'Dreams 4/B 1203, LBS Road, Bhandup(W), Mumabi', 400078, 'Bhandup', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'S.E', '1531891707Snapchat-979688247.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(358, 'Shaikh Abdul Azeem Abdul wahee', 0, 3, 'abdulazeemshaikh8@gmail.com', '1999-04-07', 9819137961, 123456789, 'A/304 Noorani Tower Near virani petrol pump Kausa ', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'S.E', '1531892756IMG_20180717_184403.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(359, 'Khan Mohd Danish Mohd Yusuf', 0, 3, 'khanmaxmcg@gmail.com', '2000-01-15', 8070601510, 123456789, 'Room 53 Plot 60 Gate 7 Malvani Malad west', 400095, 'Malad', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'S.E', '1531893678IMG-20180718-WA0002.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(360, 'Shaikh Mohammad sajid', 0, 3, 'sajidshaikh56789@gmail.com', '1999-05-07', 9892181584, 123456789, 'Jamaluddin chawl Bandra plot Jogeshwari East', 400060, 'Jogeshwari', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'S.E', '1531895380IMG_20180718_115637.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(361, 'Siddiquee mohd saeed', 0, 3, 'saeedbromim@gmail.com', '1999-12-09', 8169310736, 123456789, 'Roopji kanji chawl, Gaddi adds sewri (E)', 40005, 'Sewri', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'S.E', '1531895743IMG_20180718_115602_HHT.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(362, 'Maurya Avnish Raysaheb', 0, 3, 'avnishmaurya561999@gmail.com', '1999-06-05', 8691889638, 123456789, 'R 203, D wing, yashwant empire, nalla sopara east', 401209, 'Nalla sopara', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'S.E', '1531900187IMG-20180718-WA0002.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(363, 'GOLEY RUSHIKESH GAJANAN', 1, 3, 'rushigoley@gmail.com', '1998-06-12', 9657586709, 123456789, 'B-1/31/SHUBHKARMA HOUSING SOCIETY, KARMASHETA BUIL', 400037, 'King circle', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'S.E', '1531902148PicsArt_07-18-01.46.53.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(364, 'Ansari Ashfi', 0, 7, 'ashfiansari1417@gmail.com', '1998-01-17', 9004901847, 123456789, 'Ashley  towers-1104,near PVR CInemax,Beverley park', 401107, 'Mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Computer Science', 'B.E', '1531902160IMG-20180718-WA0008.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(365, 'Pandey Dilip Dinanath', 0, 5, 'dilip.d.pandey1710@gmail.com', '1997-10-17', 8097281486, 123456789, 'New Ganesh Nagar,Netivali Suchak Naka,Kalyan(E)', 421306, 'Kalyan', 'Byculla Station', '6048', '2018-07-24', '', 0, 'Second', 'Quarterly', 'Mechanical', 'T.E', '1531902335IMG_20180718_135331.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(366, 'Shaikh Mohammad zameer', 0, 3, 'zameer7972@gmail.com', '1999-07-11', 9028747098, 123456789, 'Netaji market k.B.road ambarnath (w)', 420501, 'Ambarnath', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'S.E', '1531902370zameer7972@gmail.com_1.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(367, 'Qureshi sharukh mohammed hanif', 0, 3, 'sharukhqureshipdf@gmail.com', '2000-01-29', 9987138106, 123456789, 'Carvan complex,b''wing,3rd flr,R.No 19,govindwadi,k', 421301, 'Kalyan', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531903786IMG_20180718_141347_573.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(368, 'Kapadia Huzefa Shabbir', 0, 5, 'huzefahandsome@gmail.com', '1997-06-09', 7738437352, 123456789, 'A/301 badri building Mathuradas extn road Kandival', 400067, 'Kandivali', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'T.E', '1531903961IMG_20180718_131917.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(369, 'Ammar Husain Badawala', 0, 5, 'ammar.husain8404@gmail.com', '1997-04-10', 8806093153, 123456789, 'New mhada colony, 2B-601, swadeshi Mills, chunabha', 400022, 'Chunabhatti', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'T.E', '15319045081531901162425419161205.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(370, 'Mulani Ameer Aslam', 1, 7, 'aameermulani619@gmail.com', '1996-12-30', 9594772903, 123456789, 'Trimurti chawl,jaihind nagar,sonapur,mankhurd,mumb', 400043, 'Mankhurd', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'B.E', '1531910907IMG-20180718-WA0013.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(371, 'PATHAN MOHSINKHAN TASLIMKHAN', 0, 7, 'mohasin.khan96@gmail.com', '1996-03-03', 9665931361, 123456789, 'Pawar House no.906,koparkhairne sector 1,navi mumb', 400709, 'Koparkhaine', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'B.E', '1531911931IMG-20180718-WA0015.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(372, 'Hashmi Mohammed Asif Arif', 0, 7, 'arifhashmi1996@gmail.com', '1997-03-08', 9987324994, 123456789, 'Room no 1 ,Israel Chawl,Baitul Wadi,M.M.C Road,Mah', 400016, 'Mahim Jn', 'Mumbai Central', '', '2017-10-26', 'M205609', 8975, 'Second', 'Quarterly', 'Automobile', 'B.E', '1531921421IMG_20180718_185958_1531921162389.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(373, 'FAKI SAAD KAMAL', 0, 3, 'fakisaad03@gmail.com', '2000-03-03', 9137839197, 123456789, 'Bldg no 46 room no 2 , LIG colony ,V B Nagar , Kur', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'S.E', '1531921687PicsArt_07-18-07.45.23.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(374, 'Shaikh Mohammed Aadil Muzaffar', 0, 3, 'm.aadilsheikh21@gmail.com', '1999-07-21', 8879128486, 123456789, '002, isa height , moulvi compound, Kalyan ', 421301, 'Kalyan', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531921737IMG-20180718-WA0011.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(375, 'Patel Kaif Hussain Sadique', 0, 5, 'pkaif007@gmail.com', '1999-01-28', 8291428420, 123456789, '18, trio society, hire nagar, waala road, Nashik.', 422011, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'T.E', '1531924047Webp.net-compress-image.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(376, 'AGA MOHAMMAD SWALEH ARIF', 0, 3, 'swaleh877@gmail.com', '1999-07-27', 8286566158, 123456789, 'Anand krupa tower B1 704 hajuri dargha near LIC th', 400604, 'Thane', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'S.E', '1531924256IMG_20180718_195555.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(377, 'Syed Shayan Shaukat Ali', 0, 5, 'ashayan234@gmail.com', '1998-12-22', 9833914729, 123456789, '601 Jasmin green park,Shil Mumbra.', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531927682IMG_20180718_204135.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(378, 'Sharma neha rajdeo', 1, 3, 'neha40111@gmail.com', '1999-12-01', 9969015794, 123456789, '2/2 Vaishali niwas, Hariyali village,  Vikhroli Ea', 400083, 'Vikhroli station', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'S.E', '153192823215319281016221123533166.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(379, 'Bagdadi Ammar Bashir', 0, 5, 'bagdadiamma@gmail.com', '1998-12-06', 9821114058, 123456789, 'A-12/503, AL-ARAFAT CHS LTD, MILLAT NAGAR,  ANDHER', 400053, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'T.E', '1531930489IMG_20180718_211135.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(380, 'Nakhwa Mohammed Anas Sajid', 0, 5, 'anasnakhwa12@gmail.com', '1998-09-06', 9987272527, 123456789, '201/A-wing Asmita Orchid-1 Naya nagar Mira road ea', 401107, 'Mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'T.E', '1531932726C037D4F8-5A96-4693-AE57-3B3D99EC9F95.jpe', 0, '2018-07-18 04:00:00', '2018-08-17 04:00:00', 'No Remarks'),
(381, 'yadav rahul baliram', 0, 5, 'yadavrahul24x7@gmail.com', '1999-04-21', 8291075875, 123456789, '401/1 Shree tirupati balaji chs ltd koldongari sah', 400069, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'T.E', '1531934501IMG_20180718_220643.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(382, 'Shaikh Faisal ahmed', 0, 2, 'iamfs786@gmail.com', '1998-12-22', 8454861332, 123456789, 'Behind new diamond garrage room no 301/1 lower dep', 400079, 'Mumbai', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'S.E', '1531934628IMG-20180718-WA0008.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'station not proper'),
(383, 'Chachiya shahahanawaz Altaf', 0, 5, 'chachiyashahanawaz1@gmail.com', '1998-12-10', 7977885789, 123456789, '3/303 Datta krupa Apt anand koliwada mumbra', 400612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 27002759, 'First', 'Quarterly', 'Information Technolo', 'T.E', '153193491120180718_224508.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(384, 'Talekar hrishikesh ravinath', 0, 5, 'hrishikeshtalekar555@gmail.com', '1998-05-13', 9987369119, 123456789, '603 navrang heights sector 8 charkop kandivali(w)', 400067, 'kandivali', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'T.E', '1531935305hrishi.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(385, 'Chaudhary Parvez Ahmed', 0, 3, 'parvezchaudhary29@gmail.com', '1998-05-30', 7977766170, 123456789, '6, Shiv niwas chawl Govind Nagar gaodevi road bhan', 400078, 'Bhandup', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'S.E', '1531935368New Doc 2018-07-18_1.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(386, 'Satam om laxman', 1, 3, 'omsatam1005@gmail.com', '1999-10-29', 7045813329, 123456789, 'Pathanwadi,filter padta,aarey road,powai,mumbai 40', 400087, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1531962401IMG_20180718_215645.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(387, 'Khan Yusuf', 0, 3, 'kyusuf455@yahoo.com', '1998-11-28', 8291042993, 123456789, 'B 307 aasmi plaza haidri chowk Naya nagar mira roa', 401107, 'Mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'S.E', '153196721215319671140311888246129.jpg', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(388, 'PARDESHI YASH RAVI', 0, 5, 'yashpardeshi1152@gmail.com', '1998-12-19', 7506537345, 123456789, 'Room no. C/51, Janta sevak society,\r\nMori road,mah', 400016, 'Mahim', 'Mumbai Central', '7009', '2018-06-04', 'H664446', 7009, 'Second', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531970863IMG_20180719_073755762_BURST000_COVER_TO', 0, '2018-07-18 04:00:00', '2018-10-16 04:00:00', 'No Remarks'),
(389, 'Shaikh kashaan ahmed', 0, 7, 'kashaanshaikh24042@gmail.com', '1998-06-12', 8108824042, 123456789, 'Bldg no 7C 04 taximens colony kurla west mumbai ', 400070, 'Kurla Station', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'F.E', '1531974534682D9C4F-21D1-4E2B-AD98-ABE06DB875A9.jpe', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(390, 'Mohammad irfan abdul vahid', 0, 7, 'mohammadirfan109h@gmail.com', '1996-06-05', 8693870617, 123456789, 'D-08,gupta compound,road no.11,andheri east Mumbai', 400093, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'B.E', '1531974909B01C08D7-D7F5-4B95-9BFE-4432391A5342.jpe', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(391, 'SHAIKH KASHAAN AHMAD', 0, 7, 'kashaan1212@gmail.com', '1998-06-12', 8108824042, 123456789, 'Bldg no 7C 04 Taximens Colony Lbs marg kurla west ', 400070, 'Kurla station', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'B.E', '15319751213AC6869A-42E1-46C0-84B2-96BE14F1E14E.jpe', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'already applied on no.306'),
(392, 'Patel azhan ahamad', 0, 3, 'azhanpatel77@gmail.com', '2000-03-14', 7021553402, 123456789, '6B/304,Maitri Co-op HSG SoC., Damodar Park, Ghatko', 400086, 'Ghatkopar', 'Byculla Station', '97216382', '2018-04-22', 'H460438', 6382, 'First', 'Quarterly', 'Computer Science', 'S.E', '1531983825New Doc 2018-07-19_1.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(393, 'Sayyed Danish Rizwanullah', 0, 7, 'sayyeddanishsd@gmail.com', '1997-07-24', 9322277244, 123456789, 'Room 16, Chawl 5, Vinoba bhave nagar, Kurla west, ', 400070, 'Kurla', 'Byculla Station', '99067593', '2018-04-21', 'H460443', 7593, 'Second', 'Quarterly', 'Mechanical', 'B.E', '1531987018ID Card_1.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(394, 'KHAN NOOR MOHAMMAD MEHBOOB', 0, 5, 'noork240798@gmail.com', '1998-07-24', 7506212623, 123456789, '47/5 manbai keshvaji wadi ,village road bhandup we', 400078, 'Bhandup', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'T.E', '1531989656IMG_20180719_140249584.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(395, 'Pujare Kalpesh Manohar', 0, 7, 'pujarekalpesh@gmail.com', '1998-06-23', 9768972750, 123456789, 'J/1, Panchashil Nagar, manvel pada road ,Virar eas', 401305, 'Virar', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'B.E', '1531994528IMG-20180719-WA0001.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(396, 'SHAIKH TAUSIF REHAN MOHD. AZIM', 0, 3, 'tausifasif0803@gmail.com', '2000-03-08', 7678083882, 123456789, 'ROOM NO.6, INDIRA NAGAR, JARIMARI, KURLA(W) ,MUMBA', 400072, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1532007783IMG-20180719-WA0001.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(397, 'Ahmed Sohail Vakil Seema', 0, 7, 'sohailtitolia@gmail.com', '1997-03-01', 7678051547, 123456789, 'AFFWA Boys Hostel, Air Force station, Maratha Colo', 400055, 'Santacruz', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'B.E', '1532009005scanner_20180719_193154', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(398, 'SHETTY SIDHANT UMESH', 0, 5, 'sidshetty06@gmail.com', '1998-09-06', 7710836471, 123456789, '401, CHOKSI APARTMENTS, SHIVAJI NAGAR, VAKOLA\r\nSAN', 400055, 'Santacruz', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics Engineer', 'T.E', '153201222020180719_202254.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(399, 'Patil Rushikesh Hiraji', 0, 3, 'rushikeshpatil333@gmail.com', '1998-08-28', 7218684333, 123456789, 'Riddhi-siddhi society,Chinchpada,pen', 402107, 'Panvel', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'S.E', '1532015436057A175F-00A7-41E8-B20B-7AB8A3715CC6.jpe', 0, '2018-07-19 04:00:00', '2018-08-18 04:00:00', 'No Remarks'),
(400, 'Pathan zaid fazalur rehman', 0, 3, 'zaidpathan9772391813@gmail.com', '1998-10-27', 9702114389, 123456789, 'A-104 noor mahal co op housing society off sonapur', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'S.E', '1532018329IMG-20180719-WA0001.jpg', 0, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(401, 'yadav rahul santram', 0, 5, 'rahulsyadav63636@gmail.com', '1999-08-15', 9619866544, 123456789, '206/2 Shree tirupati balaji chs ltd koldongari sah', 400069, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'T.E', '1532019789IMG-20180719-WA0001.jpg', 1, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(402, 'shivam singh ', 0, 5, 'shivamsingh3380@gmail.com', '1998-01-04', 7021989408, 123456789, '701 7th flr diamond 3 royal palms mayur nagar near', 400075, 'goregaon', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics Engineer', 'T.E', '153202177913953b6e-3289-4591-b4a8-9478f28c8b8f.jpg', 1, '2018-07-19 04:00:00', '2018-10-17 04:00:00', 'No Remarks'),
(403, 'Sayed Mohd kaif', 0, 3, 'smkaif392@gmail.com', '1999-12-21', 7506039802, 123456789, 'E-204 Shaan apt, pipe road Kurla West Mumbai -70', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'S.E', '1532071997IMG-20180719-WA0001.jpg', 1, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'No Remarks'),
(404, 'Shelar Mandar Mahesh', 0, 5, 'mandarshelar59@gmail.com', '1998-09-05', 9833321102, 123456789, '201,mohini apt, gherapde chowk, katrap, badlapur, ', 421503, 'Badlapur ', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'T.E', '1532072745IMG_20180720_131317.jpg', 0, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'No Remarks'),
(405, 'Shaikh shabuddin akhtaruddin', 0, 5, 'armanshaikh98677@gmail.com', '1998-06-19', 9867791967, 123456789, '8/77,aehanak nagar, near LIG, kurla west ', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'T.E', '1532075641IMG_20180720_132013.jpg', 0, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'No Remarks'),
(406, 'Kha Iram Majeed ', 1, 5, 'bushrak99517@gmail.com', '1998-03-20', 9892361112, 123456789, '301,Melwin CHS,Kâ€™Villa,Thane (west)', 400601, 'Thane', 'Byculla Station', '0', '0000-00-00', '0', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'T.E', '1532076653BFCCADF8-6B58-42C2-B6AC-49C283D87019.jpe', 1, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'Detail not fill properly'),
(407, 'Khan Mohd Rihan Mohd Riyaz', 0, 7, 'mohammadrihanriyazkhan@gmail.c', '2000-03-05', 7977224152, 123456789, '40/1, shiv Sangam market, neta ji nagar, Khadi no.', 400072, 'Ghatkopar', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'B.E', '1532078927id - Page 1.jpg', 1, '2018-07-20 04:00:00', NULL, 'No Remarks'),
(408, 'sheikh bilal alihasan', 0, 3, 'bilal261099@gmail.com', '1999-10-26', 9594928736, 123456789, 'jose nagar, mohilli village, kheraniroad, sakinaka', 400072, 'ghatkopar', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'S.E', '1532081323bilalll id.JPG', 1, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'No Remarks'),
(409, 'Shaikh Mohammad Taufiq', 0, 7, 'shaikhtaufiq12.ts@gmail.com', '1997-04-02', 9987612422, 123456789, '3B/602 Dheeraj Dreams Society,L.B.S Marg, Bhandup ', 400078, 'Mumbai', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'B.E', '1532086766New Doc 2018-07-20_1.jpg', 1, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'No Remarks'),
(410, 'CHAVAN KAUSHAL KAILASH', 0, 5, 'kaushal.mj98@gmail.com', '1998-03-06', 8424847075, 123456789, '004, Jituraj CHS, Desale Pada, near Guardian Schoo', 421204, 'Dombivli E', 'Byculla Station', '93434800', '2018-04-21', 'H664280', 4800, 'First', 'Quarterly', 'Automobile', 'T.E', '1532092718Snapchat-98786644.jpg', 1, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'Detail not fill properly'),
(411, 'Fareedi Afreen Abad', 1, 5, 'afreenfareedi94@gmail.com', '1998-02-20', 8689835341, 123456789, 'Subhadra park,Flat no-101,B-wing,Naya Nagar,Mira r', 401107, 'Mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'T.E', '1532095933IMG-20180720-WA0004.jpg', 1, '2018-07-20 04:00:00', '2018-10-18 04:00:00', 'No Remarks'),
(412, 'AKBAR Ali Gulam Hussain ', 0, 7, 'akbarali.automobile@gmail.com', '1995-12-13', 9820760590, 123456789, '12,Indira Gandhi Nagar ,Kherwadi Bandra East ', 400051, 'Bandra', 'Byculla Station', '', '2018-04-30', 'H664358', 3578, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532151692568233E4-A8A6-438D-9014-4C9E001E5303.jpe', 1, '2018-07-21 04:00:00', '2018-10-19 04:00:00', 'Detail not fill properly'),
(413, 'Khan Abdul Hamid Mohd Hasib', 0, 5, 'zeeshank1011@gmail.com', '1996-12-08', 8097607786, 123456789, '401/13, Rambachan Chawl, Friend''s Colony, Near Kar', 400070, 'kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'T.E', '1532155277New Doc 2018-07-21_1.jpg', 0, '2018-07-21 04:00:00', '2018-10-19 04:00:00', 'No Remarks'),
(414, 'Belkare Ashwini Krishna', 1, 3, 'ashwinikbelkare99@gmail.com', '1999-07-08', 9130145894, 123456789, 'Jijamata apt. Ghodvinde nagar,vasind', 421601, 'Vasind', 'Byculla Station', '', '2018-07-17', 'H795168', 6781, 'Second', 'Quarterly', 'Mechanical', 'S.E', '15321876931532187508600479273176.jpg', 0, '2018-07-21 04:00:00', '2018-10-19 04:00:00', 'No Remarks'),
(415, 'Gund jyotsna pankaj', 1, 3, 'jyotsnapgund@gmail.com', '1999-12-11', 9769852569, 123456789, 'Shree damodar krupa,ayre road,dombivli(E)', 421201, 'Dombivli ', 'Byculla Station', '', '2018-07-18', 'H795166', 7065, 'Second', 'Quarterly', 'Mechanical', 'S.E', '1532189370IMG-20180721-WA0000.jpg', 0, '2018-07-21 04:00:00', '2018-10-19 04:00:00', 'No Remarks'),
(416, 'Kunnath Panhikkayil Mohammed S', 0, 5, 'samerkp1@gmail.com', '1998-10-21', 8169341928, 123456789, '604 Englewood, Hiranandani Estate, Thane West', 400607, 'Thane', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Computer Science', 'T.E', '1532227452PhotoPictureResizer_180721_180124916_cro', 0, '2018-07-21 04:00:00', '2018-10-19 04:00:00', 'Detail not fill properly'),
(417, 'Shamsheer Ahmed', 0, 5, 'shamsheer1998@gmail.com', '1999-03-05', 8779726582, 123456789, 'AFFWA Boys Hostel, Air Force station, Maratha Colo', 400055, 'Santacruz', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Computer Science', 'T.E', '1532244274IMG_20180722_125141.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(418, 'Aqeel Ahmed', 0, 7, 'khanaqeel0976@gmail.com', '1996-12-27', 9769477996, 123456789, 'A 605, alfalah, bldg, krantinagar, behrambaug, jog', 400102, 'Jogeshwari', 'Mumbai Central', '97694683', '2018-07-16', 'H795380', 4683, 'Second', 'Quarterly', 'Mechanical', 'B.E', '1532244716IMG-20180722-WA0002.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(419, 'Iraqui Shamshad Alam Mehmud Al', 0, 7, 'shamshad1840@gmail.com', '1997-09-02', 9594753132, 123456789, 'B/84, Lakde Wali Gali, A.K. Marg, Behram Nagar, Ba', 400051, 'Bandra', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Computer Science', 'B.E', '1532255472New Doc 2018-07-22_1.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(420, 'SHAIKH RIYAZ YUSUF', 0, 7, 'shaikhriyazm004014@gmail.com', '1997-05-08', 8879393042, 123456789, '281 sai krupa chawl\r\nshashtrinagar ,near kanta soc', 400605, 'kalwa', 'Byculla Station', '80570215', '2018-07-28', 'H664166', 215, 'Second', 'Quarterly', 'Information Technolo', 'B.E', '1532272856id card.jpeg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(421, 'Momin Shahzin Sharif', 1, 5, 'shahzin20144@gmail.com', '1998-03-28', 9326987097, 123456789, 'B/18 Mitradham CHS, Deonar Municipal Colony, near ', 400043, 'Govandi ', 'Sandhurst Road Stati', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'T.E', '1532274917PicsArt_07-22-09.22.57.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(422, 'Shaikh Mohammed Shoaib Rafiq', 0, 3, 'mohammedshoiab038@gmail.com', '1999-12-06', 9869477922, 123456789, '1st, B-Wing, Flat No:101, Sarvoday Park, Near patr', 421301, 'Kalyan station', 'Byculla Station', '', '2018-07-16', 'H795349', 7733, 'Second', 'Quarterly', 'Electronics & Teleco', 'S.E', '1532276381New Doc 2018-07-22_1.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(423, 'Sinha Rahul Ramesh', 0, 7, 'rahulrameshsinha@gmail.com', '1997-09-26', 9004141194, 123456789, '102, New Central, D-1, Golden Park, Phase-1, Betur', 421301, 'Kalyan', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Electronics & Teleco', 'B.E', '1532276944IMG_4150__1532276519_43770.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(424, 'Shaikh Shadab Mahemud', 1, 3, 'shadabs9599@gmail.com', '1999-05-09', 9167696636, 123456789, 'Plot No. 374, New Mhada Colony, Pokhran Road No. 1', 400606, 'Thane', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'S.E', '1532278929IMG_20180722_210158-min.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(425, 'NAIR SREEJITH RAVEENDRAN à¤¨à¤', 0, 3, '1999sreejith098@gmail.com', '1999-09-25', 9022827822, 123456789, '1/17, GANESH NIWAS, NEAR ANJALI MEDICAL, L.N.M. RO', 400072, 'GHATKOPAR', 'Byculla Station', '16406283', '2018-04-22', 'H460437', 6283, 'First', 'Quarterly', 'Computer Science', 'S.E', '1532315788sabooid.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(426, 'Fakih arib farhan', 0, 5, 'aribfakih789@gmail.com', '1998-11-22', 8655103337, 123456789, 'Summaiya apt Govind wadi kalyan west', 421301, 'Kalyan ', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'T.E', '1532316823IMG_20180719_085725-1.jpg', 0, '2018-07-22 04:00:00', '2018-10-20 04:00:00', 'No Remarks'),
(427, 'KHAN ISHTIYAK AHMED', 0, 7, 'k.ishtiyak@gmail.com', '1993-10-27', 8080202508, 123456789, 'Kamraj Nagar, Masjid Galli, Madina masjid, Ghatkop', 400077, 'Ghatkopar station', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '153232894285kb_122338.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(428, 'Asamdi umer Mohamad saeed', 0, 7, 'umerasamdi@gmail.com', '1998-03-08', 9833082061, 123456789, 'K D paradise, western park, kashimira, Mira  road(', 401107, 'Mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'B.E', '1532329224IMG-20180723-WA0006.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(429, 'Asamdi umer Mohamad saeed', 0, 7, 'umerasamdi8398@gmail.com', '1998-03-08', 9833082061, 123456789, 'K D paradise, western park, kashimira, Mira  road(', 401107, 'Mira road', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Automobile', 'B.E', '1532329507IMG-20180723-WA0006.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'Duplicate Entry'),
(430, 'Khan Sofiyan Sohil', 0, 5, 'salmaan0015@gmail.com', '1997-08-10', 9987248240, 123456789, 'Rajiv Nagar Gaz dhar bandh Santacruz (west) ', 400054, 'Santacruz ', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'T.E', '1532332036IMG-20180723-WA0003.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'Detail not fill properly'),
(431, 'Hira khan', 1, 3, 'callinghira8@gmail.com', '1999-08-16', 8097805563, 123456789, '173/A3 TALAV BUILDING ,LBS MARG NEAR SHEETAL CINEM', 400070, 'Vidyavihar', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Information Technolo', 'S.E', '1532332044New Doc 2018-07-23_1.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(432, 'Ansari Zahir Ahmad Sarfraz Ahm', 0, 7, 'zahir.ansari1708@gmail.com', '1997-08-17', 9664392871, 123456789, '17 B -2, Takshila Colony, Mahakali Caves Road, And', 400093, 'Andheri', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532332450IMG-20180723-WA0001.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(433, 'Sayyed Naziya Ajaz', 1, 7, 'nsnazi786@gmail.com', '1997-10-07', 8286115064, 123456789, 'J/102, Chandresh Residency, Lodha Road, Naya Nagar', 401107, 'Mira Road', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Monthly', 'Computer Science', 'B.E', '1532333467IMG_20180723_133841.jpg', 0, '2018-07-23 04:00:00', '2018-08-22 04:00:00', 'No Remarks'),
(434, 'Naik Rushikesh Mohan', 0, 7, 'rushikeshnaik779@gmail.com', '1997-03-28', 9545442394, 123456789, 'C/o mukund magare ,403B Harmony CHS ,Ovaripada aut', 400068, 'Dahisar', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'B.E', '15323386621532338553452.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks');
INSERT INTO `student` (`id`, `fullname`, `gender`, `semester`, `email`, `DOB`, `contact`, `aadhar`, `address`, `pincode`, `source`, `destination`, `passno`, `pass_end`, `voucher`, `season`, `classof`, `duration`, `branch`, `year`, `img_loc`, `verified`, `dateofentry`, `datetodelete`, `Remark`) VALUES
(435, 'Pasha Mohd  Saklain ', 0, 7, 'saklainkhan32@gmail.com', '1997-12-07', 8104249220, 123456789, 'Room no. 30, Opp union bank of India , Narayan Nag', 400086, 'Ghatkopar station', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532343793rps20180723_162810.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(436, 'Shaikh Naved Noor Mohammed', 0, 5, 'navedshaikh1996@gmail.com', '1996-09-11', 8097340120, 123456789, 'B/12,Cosmos Apartment shamshuddin Nagar,jari Mari ', 400072, 'Vidya vihar', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Computer Science', 'T.E', '1532344310rps20180723_164001.jpg', 0, '2018-07-23 04:00:00', '2018-08-22 04:00:00', 'No Remarks'),
(437, 'Choure Aditya Jagannath', 0, 7, 'choureaditya@gmail.com', '1997-04-08', 7506052939, 123456789, '206,Abode residency,Near Orchids complex,Majiwada,', 400601, 'Thane', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532344827rps20180723_164853.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(438, 'KALMANI ABUBAKAR NAUSHADALI ', 0, 5, 'kalmanibubakar@gmail.com', '1998-05-26', 9004404059, 123456789, 'AG NAGAR, A-1/101, A.G.NAGAR, KASHIMIRA,', 401107, 'BORIVALI ', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Civil', 'T.E', '1532354343IMG_20180723_192255210.jpg', 0, '2018-07-23 04:00:00', '2018-08-22 04:00:00', 'No Remarks'),
(439, 'kanoje aditya ramdas', 0, 7, 'adityakanoje01@gmail.com', '1998-12-06', 9833527779, 123456789, 'ROOM NO. 2,KAUSALYA NIWAS\r\nRAMDASWADI, SINDHIGATE', 421301, 'KALYAN', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532360374IMG-20180723-WA0013.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(440, 'sayed muntaha iqbal', 1, 7, 'muntaha1507@gmail.com', '1996-07-15', 8693836186, 123456789, 'room no 19th,first floor,kasinath building,cadell ', 400016, 'mahim', 'Mumbai Central', '', '2022-07-23', 'H460430', 9684, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532360383IMG-20180723-WA0012[1].jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(441, 'Wakle Azeem Dadamiya', 0, 5, 'azeemwakle@gmail.com', '1997-05-31', 8554813552, 123456789, '116, Ambika Apartment, Birla Gate, Shiv Road, Shah', 421001, 'Shahad', 'Byculla Station', '64608189', '2018-07-16', 'H795305', 8189, 'Second', 'Quarterly', 'Mechanical', 'T.E', '1532366758IMG-20180723-WA0016.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(442, 'KATHULA PREMKUMAR NARSIMHA', 0, 3, 'kathulap0657@gmail.com', '2000-01-25', 9594476099, 123456789, 'shivshankar Galli,laljipada,Kandivali west', 400067, 'kandivali', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Information Technolo', 'S.E', '1532403026Webp.net-compress-image.jpg', 0, '2018-07-23 04:00:00', '2018-10-21 04:00:00', 'No Remarks'),
(443, 'Chaudhary waseem Ahmed ', 0, 7, 'ahmedwaseem1997@gmail.com', '1997-05-26', 9619111752, 123456789, 'A-2/11 zafar compound near noorani masjid hill no.', 400072, 'Ghatkoper ', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Mechanical', 'B.E', '1532409098SI_20180724_103804.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(444, 'Khan Tarique', 0, 3, 'khantarique42@gmail.com', '1999-08-14', 8082000710, 123456789, 'Gulistan apartment,B wing,2/201,quresh Nagar , Kur', 400070, 'Kurla', 'Sandhurst Road Stati', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'S.E', '1532410524IMG_20180724_110243_1532410436630.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(445, 'Shaikh Hamza Rais Ahmed', 0, 5, 'shaikhhamza157@gmail.com', '1997-11-28', 8767553506, 123456789, 'Room.No.49, 4th floor, V.K.Wadi, Dharavi', 400017, 'Mahim', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Computer Science', 'T.E', '1532416248rsz_img_20180724_123445.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(446, 'sayyed ammar irfan', 0, 5, 'ammarsayyed11@gmail.com', '1999-01-24', 9619645275, 123456789, 'room no 4 , jumma hasan chawl , makrani pada , mal', 400097, 'malad', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'T.E', '1532418364New Doc 2018-07-24_1.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(447, 'Hadkar Ramdas Shrinivas', 0, 5, 'ramdashd97@gmail.com', '1997-11-07', 7977032565, 123456789, 'Room No. 5\r\nRupali Nivas Chawl, Near Railway cross', 400042, 'Nahur Station', 'Byculla Station', '19647891', '2018-05-06', 'H460347', 7891, 'Second', 'Quarterly', 'Mechanical', 'T.E', '1532419884IMG_20180724_133649081.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(448, 'Yadav Rohit sahajram', 0, 7, '96rohity@gmail.com', '1996-12-27', 7208825038, 123456789, 'Om Sai Nagar mahral society shahad', 421301, 'Shahad', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'B.E', '1532420908rps20180724_135439.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(449, 'Walve Priyanka Suresh', 1, 7, 'priyankawalve11@gmail.com', '1997-10-12', 7738493440, 123456789, '2/245, Vanrai colony, W.E Highway, Goregaon (E) ', 400063, 'Goregaon', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics & Teleco', 'B.E', '1532422180IMG-20180724-WA0004.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(450, 'Asar Abdulrafe', 0, 5, 'rafeeeeasar@gmail.com', '1998-07-27', 8080015297, 123456789, '101,b-2,galaxy complex, kadar palace, kausa Mumbra', 4000612, 'Mumbra', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Mechanical', 'T.E', '1532431866IMG-20180724-WA0018.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(451, 'Syed faizan syer irfan', 0, 3, 'faizansyed2020@gmail.com', '2000-07-21', 8483975886, 123456789, 'Nai nagri lonar dist buldhana 443302', 400001, 'CST', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'S.E', '1532432286IMG_20180724_170339~3.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(452, 'Saifi Mujeeb Mufeed', 1, 7, 'saifi.mujeeb2@gmail.com', '1998-03-14', 9702586283, 123456789, 'Room No. 16, Laxmi Chawl P.L. Lokhande Marg, Chemb', 400089, 'Chembur', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Electronics Engineer', 'B.E', '153243762720180724_183509.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(453, 'KHAN YASMIN ZAINUDDIN', 1, 5, 'yasminkhan9896@gmail.com', '1998-08-18', 9768152590, 123456789, 'G100 JANTA SEVAK SOCIETY MORI ROAD MAHIM MUMBAI ', 400016, 'MAHIM', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Monthly', 'Electronics & Teleco', 'T.E', '1532438620img000262.jpg', 0, '2018-07-24 04:00:00', '2018-08-23 04:00:00', 'No Remarks'),
(454, 'KHAN FARHAD AKLAM', 0, 7, 'farhadakhan69@gmail.com', '1997-06-12', 8805510322, 123456789, 'RAM BHAOU MALGI CHOWK AZADNAGAR ULHASNAGAR', 421002, 'ULHASNAGAR', 'Byculla Station', '01004686', '2018-04-09', 'H664386', 4686, 'Second', 'Quarterly', 'Civil', 'B.E', '15324410671532440882940.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(455, 'SHAIKH ABDUL SAMEER SAMAD', 0, 7, 'SAMEERSAMAD1997@GMAIL.COM', '1997-08-16', 9220992938, 123456789, 'MASJID CHAWL ANJUMAN RESALATE HAQ MASJID AZADNAGAR', 400086, 'GHATKOPAR', 'Byculla Station', '8231', '2018-07-24', '', 8231, 'First', 'Quarterly', 'Mechanical', 'B.E', '1532446400idcard_1.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(456, 'KHAN MOHD WASIM', 0, 7, 'wasimakramkhan777@gmail.com', '1995-08-20', 7208786596, 123456789, '6/6,Vibha bhave Nagar,Kunti Devi chapel, KURLA-WES', 400070, 'Kurla', 'Byculla Station', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Civil', 'B.E', '1532446420New Doc 2018-07-24_1.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(457, 'Momin Shahzin Sharif ', 1, 5, 'shahzin20144@email.com', '1998-03-28', 9326987097, 123456789, 'B wing /18rm no. Mitradham chs, Deonar Municipal C', 400043, 'Govandi', 'Sandhurst Road Stati', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Civil', 'T.E', '1532447694IMG_20180724_212302.JPG', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(458, 'dubey ankit rajkumar', 0, 1, 'dubeankit07@gmail.com', '1998-10-08', 8446568357, 123456789, '12 c 303 ostwal nagari next to central park nallas', 401209, 'nallasopara', 'Mumbai Central', '', '0000-00-00', '', 0, 'Second', 'Quarterly', 'Automobile', 'F.E', '1532451098im.jpg', 0, '2018-07-24 04:00:00', '2018-10-22 04:00:00', 'No Remarks'),
(460, 'Danish Khan', 0, 7, 'danissh20@gmail.com', '1997-05-01', 9167386706, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'T.E', '1532513346IDCARD.jpeg', 0, '2018-07-24 18:30:00', '2018-10-22 18:30:00', 'No Remarks'),
(461, 'Danish Khan', 0, 7, 'danissh21@gmail.com', '1997-05-01', 9167386706, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Quarterly', 'Information Technolo', 'T.E', '1532513838IDCARD.jpeg', 0, '2018-07-24 18:30:00', '2018-10-22 18:30:00', 'No Remarks'),
(462, 'Danish Khan', 0, 1, 'danissh20@gmail.com1', '1997-01-01', 9167386706, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'F.E', '1532514385IDCARD.jpeg', 0, '2018-07-24 18:30:00', '2018-08-23 18:30:00', 'No Remarks'),
(464, 'Danish Khan', 0, 1, 'danissh20@gmail.co1', '1997-05-01', 9167386706, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'F.E', '1532617809IDCARD.jpeg', 0, '2018-07-25 18:30:00', '2018-08-24 18:30:00', 'No Remarks'),
(466, 'Danish Khan', 0, 1, 'danissh20@gmail.co2', '1997-05-01', 9167386706, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Mumbai Central', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'F.E', '1532617830IDCARD.jpeg', 0, '2018-07-25 18:30:00', '2018-08-24 18:30:00', 'No Remarks'),
(467, 'Danish Khan', 0, 7, 'danissh20@gmail.co1mb', '1997-05-01', 9167386706, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'T.E', '1532618600dk.jpg', 0, '2018-07-25 18:30:00', '2018-08-24 18:30:00', 'No Remarks'),
(470, 'Danish Khan', 1, 1, 'danissh20@gmail.co15', '1997-05-01', 9136758974, 123456789, 'Veer Sawarkar Marg\r\nZaitoon Apartment', 400016, 'Mahim', 'Byculla Station', '', '0000-00-00', '', 0, 'First', 'Monthly', 'Automobile', 'F.E', '1532618759dk.jpg', 0, '2018-07-25 18:30:00', '2018-08-24 18:30:00', 'No Remarks');

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oldstudent`
--
ALTER TABLE `oldstudent`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=471;
DELIMITER $$
--
-- Events
--
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
