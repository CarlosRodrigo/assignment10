-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: webdb.uvm.edu
-- Generation Time: Dec 02, 2014 at 03:58 PM
-- Server version: 5.5.40-36.1-log
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CCORDEIR_Time_Sheet_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblCompany`
--

CREATE TABLE IF NOT EXISTS `tblCompany` (
`pmkCompanyId` int(11) NOT NULL,
  `fldCompanyName` varchar(50) NOT NULL,
  `fldFilePath` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblCompany`
--

INSERT INTO `tblCompany` (`pmkCompanyId`, `fldCompanyName`, `fldFilePath`) VALUES
(1, 'Time-Sheet', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblContact`
--

CREATE TABLE IF NOT EXISTS `tblContact` (
`pmkContactId` int(11) NOT NULL,
  `fldEmail` varchar(50) NOT NULL,
  `fldPhone` varchar(20) NOT NULL,
  `fldAddress` varchar(50) NOT NULL,
  `fldState` varchar(20) NOT NULL,
  `fldZipCode` varchar(20) NOT NULL,
  `fldCountry` varchar(20) NOT NULL,
  `fnkUserId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tblProject`
--

CREATE TABLE IF NOT EXISTS `tblProject` (
`pmkProjectId` int(11) NOT NULL,
  `fldName` varchar(50) NOT NULL,
  `fldDescription` varchar(255) NOT NULL,
  `fldBudget` int(11) NOT NULL,
  `fldExpectedHours` int(11) NOT NULL,
  `fnkCompanyId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblProject`
--

INSERT INTO `tblProject` (`pmkProjectId`, `fldName`, `fldDescription`, `fldBudget`, `fldExpectedHours`, `fnkCompanyId`) VALUES
(1, 'Manhattan Project', 'First project test', 50000, 200, NULL),
(2, 'Time-Sheet', 'CS 148 final project', 0, 200, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE IF NOT EXISTS `tblUser` (
`pmkUserId` int(11) NOT NULL,
  `fldEmail` varchar(50) NOT NULL,
  `fldPassword` varchar(50) NOT NULL,
  `fldFirstName` varchar(30) NOT NULL,
  `fldLastName` varchar(30) NOT NULL,
  `fldType` varchar(20) NOT NULL,
  `fldGender` varchar(10) NOT NULL,
  `fldAdmissionDate` date NOT NULL,
  `fldPosition` varchar(20) NOT NULL,
  `fldWorkHours` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`pmkUserId`, `fldEmail`, `fldPassword`, `fldFirstName`, `fldLastName`, `fldType`, `fldGender`, `fldAdmissionDate`, `fldPosition`, `fldWorkHours`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', 'admin', 'admin', 'male', '2014-11-03', 'admin', 8),
(2, 'collaborator', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'collaborator', 'collaborator', 'collaborator', 'male', '2014-11-03', 'collaborator', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblWorksOn`
--

CREATE TABLE IF NOT EXISTS `tblWorksOn` (
`pmkWorksOnId` int(11) NOT NULL,
  `fldDate` date NOT NULL,
  `fldHours` time NOT NULL,
  `fldDescription` varchar(255) NOT NULL,
  `fnkUserId` int(11) NOT NULL,
  `fnkProjectId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblWorksOn`
--

INSERT INTO `tblWorksOn` (`pmkWorksOnId`, `fldDate`, `fldHours`, `fldDescription`, `fnkUserId`, `fnkProjectId`) VALUES
(1, '2014-11-03', '06:00:00', 'admin', 1, 1),
(2, '2014-11-03', '05:00:00', 'collaborator', 2, 1),
(3, '2014-11-04', '03:30:00', 'meeting', 1, 1),
(4, '2014-11-05', '02:45:00', '', 1, 1),
(5, '2014-11-06', '06:00:00', 'site structure', 1, 2),
(6, '2014-11-07', '04:15:00', '', 1, 1),
(7, '2014-11-04', '02:45:00', '', 2, 1),
(8, '2014-11-05', '05:15:00', 'testing', 2, 1),
(9, '2014-11-06', '05:15:00', 'desining', 2, 2),
(10, '2014-11-07', '04:00:00', '', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblCompany`
--
ALTER TABLE `tblCompany`
 ADD PRIMARY KEY (`pmkCompanyId`);

--
-- Indexes for table `tblContact`
--
ALTER TABLE `tblContact`
 ADD PRIMARY KEY (`pmkContactId`), ADD KEY `fnkUserId` (`fnkUserId`);

--
-- Indexes for table `tblProject`
--
ALTER TABLE `tblProject`
 ADD PRIMARY KEY (`pmkProjectId`), ADD KEY `fnkCompanyId` (`fnkCompanyId`);

--
-- Indexes for table `tblUser`
--
ALTER TABLE `tblUser`
 ADD PRIMARY KEY (`pmkUserId`);

--
-- Indexes for table `tblWorksOn`
--
ALTER TABLE `tblWorksOn`
 ADD PRIMARY KEY (`pmkWorksOnId`), ADD KEY `fnkUserId` (`fnkUserId`), ADD KEY `fnkProjectId` (`fnkProjectId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblCompany`
--
ALTER TABLE `tblCompany`
MODIFY `pmkCompanyId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblContact`
--
ALTER TABLE `tblContact`
MODIFY `pmkContactId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblProject`
--
ALTER TABLE `tblProject`
MODIFY `pmkProjectId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblUser`
--
ALTER TABLE `tblUser`
MODIFY `pmkUserId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblWorksOn`
--
ALTER TABLE `tblWorksOn`
MODIFY `pmkWorksOnId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblContact`
--
ALTER TABLE `tblContact`
ADD CONSTRAINT `tblContact_ibfk_1` FOREIGN KEY (`fnkUserId`) REFERENCES `tblUser` (`pmkUserId`);

--
-- Constraints for table `tblProject`
--
ALTER TABLE `tblProject`
ADD CONSTRAINT `tblProject_ibfk_1` FOREIGN KEY (`fnkCompanyId`) REFERENCES `tblCompany` (`pmkCompanyId`);

--
-- Constraints for table `tblWorksOn`
--
ALTER TABLE `tblWorksOn`
ADD CONSTRAINT `tblWorksOn_ibfk_1` FOREIGN KEY (`fnkUserId`) REFERENCES `tblUser` (`pmkUserId`),
ADD CONSTRAINT `tblWorksOn_ibfk_2` FOREIGN KEY (`fnkProjectId`) REFERENCES `tblProject` (`pmkProjectId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
