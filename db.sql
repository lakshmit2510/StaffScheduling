-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 23, 2020 at 03:31 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `Airport_Pass_Details`
--

CREATE TABLE `Airport_Pass_Details` (
  `PassID` int(11) NOT NULL,
  `PassNumber` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateOfExpiry` date NOT NULL,
  `AccessControlAreas` varchar(255) NOT NULL,
  `Attachments` varchar(30) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Airport_Pass_Details`
--

INSERT INTO `Airport_Pass_Details` (`PassID`, `PassNumber`, `UserID`, `DateOfExpiry`, `AccessControlAreas`, `Attachments`, `CreatedBy`, `CreatedOn`, `Active`) VALUES
(1, '12356', 3, '2020-02-10', '', '', 2, '2020-03-05 09:17:00', 1),
(3, '12332', 1, '2020-03-20', 'Red/White-(A),Green-(C)', '', 0, '2020-03-18 07:24:57', 1),
(4, '12343', 2, '2020-03-10', 'Red/White-(A),Yellow-(D)', 'AirportPass_Doc/Screenshot 202', 0, '2020-03-18 07:24:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `BookingRefNo` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ShiftNumber` int(11) NOT NULL,
  `ShiftStartTime` time NOT NULL,
  `ShiftEndTime` time NOT NULL,
  `IC_Number` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  `Status` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `BookingRefNo`, `FullName`, `UserID`, `ShiftNumber`, `ShiftStartTime`, `ShiftEndTime`, `IC_Number`, `StartDate`, `Active`, `Status`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'EZ20200004', 'Thaniparthi Lakshmi', 2, 2, '09:00:00', '21:00:00', 1, '2020-03-10', 1, 0, '2020-03-10 03:39:55', 3),
(2, 'EZ20200002', 'Thaniparthi Lakshmi', 2, 2, '09:00:00', '21:00:00', 1, '2020-03-12', 1, 0, '2020-03-10 03:39:55', 3),
(3, 'EZ20200003', 'Thaniparthi Lakshmi', 2, 2, '09:00:00', '21:00:00', 1, '2020-03-11', 1, 0, '2020-03-10 03:39:55', 3),
(4, 'EZ20200004', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-13', 1, 0, '2020-03-10 04:38:49', 3),
(5, 'EZ20200005', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-16', 1, 0, '2020-03-13 04:23:06', 4),
(6, 'EZ20200006', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-09', 1, 0, '2020-03-13 04:23:12', 4),
(7, 'EZ20200007', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-12', 1, 0, '2020-03-13 04:23:18', 4),
(8, 'EZ20200008', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-13', 1, 0, '2020-03-13 04:23:24', 4),
(9, 'EZ20200009', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-18', 1, 0, '2020-03-18 07:56:23', 1),
(10, 'EZ20200010', 'Thaniparthi Lakshmi', 2, 3, '00:00:00', '01:00:00', 1, '1970-01-01', 1, 0, '2020-03-18 14:59:11', 1),
(11, 'EZ20200011', 'Thaniparthi Lakshmi', 2, 2, '09:00:00', '21:00:00', 1, '0000-00-00', 1, 0, '2020-03-18 15:09:55', 1),
(12, 'EZ20200012', 'Thaniparthi Lakshmi', 2, 2, '09:00:00', '21:00:00', 1, '2020-03-19', 1, 0, '2020-03-18 15:12:15', 1),
(13, 'EZ20200013', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-25', 1, 0, '2020-03-19 02:24:11', 1),
(14, 'EZ20200014', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-24', 1, 0, '2020-03-19 02:24:11', 1),
(15, 'EZ20200015', 'Lakshmi Prasanna ', 3, 1, '05:00:00', '09:00:00', 3, '2020-03-20', 1, 0, '2020-03-19 02:24:11', 1),
(16, 'EZ20200016', 'Lakshmi Prasanna ', 3, 2, '09:00:00', '21:00:00', 3, '2020-03-23', 1, 0, '2020-03-19 02:24:11', 1),
(17, 'EZ20200017', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-20', 1, 0, '2020-03-19 06:37:27', 2),
(19, 'EZ20200018', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-26', 1, 0, '2020-03-23 04:08:56', 1),
(20, 'EZ20200019', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-27', 1, 0, '2020-03-23 04:09:52', 1),
(21, 'EZ20200020', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-30', 1, 0, '2020-03-23 04:11:08', 1),
(22, 'EZ20200021', 'Thaniparthi Lakshmi', 2, 1, '05:00:00', '09:00:00', 1, '2020-03-24', 1, 0, '2020-03-23 04:11:32', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bookingmode`
--

CREATE TABLE `bookingmode` (
  `ModeID` int(11) NOT NULL,
  `Mode` varchar(255) DEFAULT NULL,
  `Hrs` int(11) DEFAULT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingmode`
--

INSERT INTO `bookingmode` (`ModeID`, `Mode`, `Hrs`, `Active`) VALUES
(1, 'Green\n', NULL, 0),
(2, 'Normal\n', NULL, 1),
(3, 'Express', NULL, 0),
(4, 'Priority', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `CompanyUID` int(11) NOT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `BuildingAddress` text,
  `WebsiteName` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(255) DEFAULT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`CompanyUID`, `CompanyName`, `BuildingAddress`, `WebsiteName`, `PhoneNumber`, `CreatedOn`, `CreatedBy`, `Active`) VALUES
(1, 'Elizabeth-Zion Asia Pacific Pte Ltd', 'Trade HUB@21, 18 Boon Lay Way', 'www.elizabeth-zion.com', '97777640', '2020-01-06 20:28:13', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Flight_KPI_information`
--

CREATE TABLE `Flight_KPI_information` (
  `ID` int(11) NOT NULL,
  `FlightNumber` varchar(255) NOT NULL,
  `EmployeeID` varchar(255) NOT NULL,
  `Weight` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Time` time NOT NULL,
  `Date` date NOT NULL,
  `AttachedFiles` varchar(255) DEFAULT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Flight_KPI_information`
--

INSERT INTO `Flight_KPI_information` (`ID`, `FlightNumber`, `EmployeeID`, `Weight`, `Type`, `Time`, `Date`, `AttachedFiles`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'B1 423', '11', '2345', 'ETA', '01:00:00', '2020-02-12', NULL, '2020-02-12 11:29:29', 59),
(2, 'B1 453', '11', '2377', 'ETA', '02:00:00', '2020-02-12', NULL, '2020-02-12 11:29:58', 59);

-- --------------------------------------------------------

--
-- Table structure for table `IC_Details`
--

CREATE TABLE `IC_Details` (
  `ID` int(11) NOT NULL,
  `ICNumber` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ICTypeID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `CountryOfBirth` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `DateOfIssue` date DEFAULT NULL,
  `Gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Race` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `AttachedFiles` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `IC_Details`
--

INSERT INTO `IC_Details` (`ID`, `ICNumber`, `ICTypeID`, `UserID`, `DateOfBirth`, `CountryOfBirth`, `DateOfIssue`, `Gender`, `Race`, `AttachedFiles`, `CreatedBy`, `CreatedOn`) VALUES
(1, 'G3466612T', 5, 2, '1995-06-10', 'Indian', '2018-07-24', 'Female', '', NULL, 0, '2020-01-15 04:04:03'),
(3, '12324', 5, 1, '1995-06-10', 'India', '2018-07-20', 'Female', '', 'IC_Documents/Screenshot.png', 3, '2020-03-10 06:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `Projects`
--

CREATE TABLE `Projects` (
  `ProjectCode` int(11) NOT NULL,
  `ProjectName` varchar(255) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `ProjectSupervisor` varchar(255) NOT NULL,
  `ProjectManager` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT '1',
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Projects`
--

INSERT INTO `Projects` (`ProjectCode`, `ProjectName`, `Location`, `ProjectSupervisor`, `ProjectManager`, `Active`, `CreatedBy`, `CreatedOn`) VALUES
(1, 'SATS Load Control', 'T2', 'Virgil', 'Virgil', 1, 2, '2020-03-05 08:41:29'),
(2, 'SATS Fuel Management', 'T2', 'Sharone', 'Virgil', 1, 2, '2020-03-05 06:43:46'),
(3, 'SATS Express Courier Centre (ECC)', 'T2', 'Nagi', 'Virgil', 1, 2, '2020-03-05 06:43:46'),
(4, 'SATS-APS-RAMP-Baggage', 'T2', 'Chee Chin', 'Virgil', 1, 2, '2020-03-05 09:19:51'),
(5, 'IT', 'T2', 'Lakshmi', 'Virgil', 0, 2, '2020-03-05 07:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `Shifts`
--

CREATE TABLE `Shifts` (
  `ShiftID` int(11) NOT NULL,
  `AvailableBookings` int(11) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Shifts`
--

INSERT INTO `Shifts` (`ShiftID`, `AvailableBookings`, `StartTime`, `EndTime`, `CreatedBy`, `CreatedOn`, `Active`) VALUES
(1, 3, '05:00:00', '09:00:00', 2, '2020-01-16 03:12:14', 1),
(2, 4, '09:00:00', '21:00:00', 2, '2020-01-16 03:12:14', 1),
(3, 3, '00:00:00', '01:00:00', 0, '2020-01-20 14:12:54', 1),
(4, 43, '02:00:00', '04:00:00', 2, '2020-01-20 14:28:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusID` int(11) NOT NULL,
  `StatusName` varchar(50) NOT NULL,
  `StatusColor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusID`, `StatusName`, `StatusColor`) VALUES
(1, 'Not Arrived', '#08d9d6'),
(2, 'Checked-In', '#1fab89'),
(3, 'Checked-Out', '#d01257'),
(4, 'QC Completed', '#240041'),
(5, 'QC Rejected', '#900048');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserUID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `EmailAddress1` varchar(255) DEFAULT NULL,
  `EmailAddress2` varchar(250) NOT NULL,
  `PhoneNumber` bigint(10) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserType` enum('Internal','External') NOT NULL,
  `CompanyUID` int(11) NOT NULL,
  `Role` enum('1','2','3') NOT NULL COMMENT '1-Admin, 2-Employee, 3- Incharge',
  `IsApproved` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Approval Pending,1-Approved, 2-Declined',
  `Active` tinyint(1) NOT NULL DEFAULT '1',
  `CreatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserUID`, `FullName`, `EmailAddress1`, `EmailAddress2`, `PhoneNumber`, `UserName`, `Password`, `UserType`, `CompanyUID`, `Role`, `IsApproved`, `Active`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'Venkat', 'aws.admin@elizabeth-zion.com.sg', 'aws.admin@elizabeth-zion.com.sg', 860942222, 'Venkat', 'a44e5d68141752ad3705489cf16f3893', 'Internal', 1, '1', 1, 1, '2019-07-14 12:17:22', 0),
(2, 'Thaniparthi Lakshmi', 'lakshmi.t2510@gmail.com', 'lakshmi.t2510@gmail.com', 90869493, 'Lakshmi store(EZ test)', '2b4db9e3f31d35c3e570eea2fde40c27', 'Internal', 1, '2', 1, 1, '2019-08-29 03:31:54', 0),
(3, 'Lakshmi Prasanna ', 'lakshmiprasannard@gmail.com', 'lakshmiprasannard@gmail.com', 12345678, 'Lakshmi(test)', 'e10adc3949ba59abbe56e057f20f883e', 'Internal', 1, '2', 1, 1, '2020-02-24 09:59:14', 2),
(4, 'Lakshmi', 'lakshimi@team-ez.com', 'lakshimi@team-ez.com', 1234567, 'Lakshmi', 'b1e8052fd4723f1375ac531bb4a85f5e', 'Internal', 1, '3', 1, 1, '2020-03-19 04:21:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `visatypes`
--

CREATE TABLE `visatypes` (
  `TypeID` int(11) NOT NULL,
  `Type` varchar(255) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visatypes`
--

INSERT INTO `visatypes` (`TypeID`, `Type`, `Active`) VALUES
(1, 'Singapore Citizens ', 1),
(2, 'Singapore Permanent Residents', 1),
(3, 'Work Permit Visa', 1),
(4, 'SPASS', 1),
(5, 'Dependent Pass', 1),
(6, 'Employment Pass', 1),
(7, 'LTVP', 1),
(8, 'Long-Term Visit Pass', 1),
(9, 'Company need to apply', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Airport_Pass_Details`
--
ALTER TABLE `Airport_Pass_Details`
  ADD PRIMARY KEY (`PassID`),
  ADD KEY `slot_idx` (`PassID`,`UserID`) USING BTREE,
  ADD KEY `SlotID` (`PassID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD UNIQUE KEY `NoDuplicate` (`UserID`,`ShiftNumber`,`StartDate`),
  ADD KEY `BookingID` (`BookingID`) USING BTREE,
  ADD KEY `CreatedBy` (`CreatedBy`) USING BTREE,
  ADD KEY `VType` (`IC_Number`,`Active`) USING BTREE,
  ADD KEY `ForginKey` (`UserID`);

--
-- Indexes for table `bookingmode`
--
ALTER TABLE `bookingmode`
  ADD PRIMARY KEY (`ModeID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`CompanyUID`);

--
-- Indexes for table `Flight_KPI_information`
--
ALTER TABLE `Flight_KPI_information`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EmployeeID` (`EmployeeID`) USING BTREE;

--
-- Indexes for table `IC_Details`
--
ALTER TABLE `IC_Details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Projects`
--
ALTER TABLE `Projects`
  ADD PRIMARY KEY (`ProjectCode`);

--
-- Indexes for table `Shifts`
--
ALTER TABLE `Shifts`
  ADD PRIMARY KEY (`ShiftID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserUID`),
  ADD KEY `Company` (`CompanyUID`);

--
-- Indexes for table `visatypes`
--
ALTER TABLE `visatypes`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Airport_Pass_Details`
--
ALTER TABLE `Airport_Pass_Details`
  MODIFY `PassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bookingmode`
--
ALTER TABLE `bookingmode`
  MODIFY `ModeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `CompanyUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Flight_KPI_information`
--
ALTER TABLE `Flight_KPI_information`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `IC_Details`
--
ALTER TABLE `IC_Details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Projects`
--
ALTER TABLE `Projects`
  MODIFY `ProjectCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Shifts`
--
ALTER TABLE `Shifts`
  MODIFY `ShiftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visatypes`
--
ALTER TABLE `visatypes`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `Type` FOREIGN KEY (`IC_Number`) REFERENCES `visatypes` (`TypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
