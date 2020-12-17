-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2020 at 11:08 PM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhealth3`
--
CREATE DATABASE IF NOT EXISTS `myhealth3` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `myhealth3`;

-- --------------------------------------------------------

--
-- Table structure for table `Costs`
--

CREATE TABLE `Costs` (
  `Company` varchar(100) NOT NULL,
  `Service` varchar(100) NOT NULL,
  `AllowedCost` decimal(18,2) NOT NULL,
  `InNetCov` decimal(18,2) NOT NULL,
  `OutNetCov` decimal(18,2) NOT NULL,
  `FullDeductible` decimal(18,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Drugs`
--

CREATE TABLE `Drugs` (
  `DrugId` int(11) NOT NULL,
  `Company` varchar(100) NOT NULL,
  `DrugName` varchar(100) NOT NULL,
  `MedicalName` varchar(100) NOT NULL,
  `Price` decimal(18,2) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Enrolled`
--

CREATE TABLE `Enrolled` (
  `PatientId` varchar(50) NOT NULL,
  `PlanId` int(11) NOT NULL,
  `Company` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `InsurancePlans`
--

CREATE TABLE `InsurancePlans` (
  `PlanId` int(11) NOT NULL,
  `Company` varchar(100) NOT NULL,
  `AnnualPremium` decimal(18,2) NOT NULL,
  `AnnualDeductible` decimal(18,2) NOT NULL,
  `AnnualCoverageLimit` decimal(18,2) NOT NULL,
  `LifetimeLimit` decimal(18,2) NOT NULL,
  `Network` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PatientRecords`
--

CREATE TABLE `PatientRecords` (
  `PatientId` varchar(25) NOT NULL,
  `ProviderId` int(11) NOT NULL,
  `Service` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `CostToInsurance` decimal(18,2) DEFAULT NULL,
  `CostToPatient` decimal(18,2) NOT NULL,
  `InsPayment` decimal(18,2) NOT NULL,
  `PatientPayment` decimal(18,2) NOT NULL,
  `DrugId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Patients`
--

CREATE TABLE `Patients` (
  `Name` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Address` varchar(255) NOT NULL,
  `EmployerName` varchar(100) NOT NULL,
  `EmergencyContactName` varchar(100) NOT NULL,
  `EmergencyContactTelNo` int(11) NOT NULL,
  `PatientTelNo` int(11) NOT NULL,
  `PatientEmail` varchar(50) NOT NULL,
  `PatientId` varchar(24) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Providers`
--

CREATE TABLE `Providers` (
  `ProviderId` int(11) NOT NULL,
  `ProviderName` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `LicenseNum` int(11) NOT NULL,
  `ServiceLevel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id` varchar(24) NOT NULL DEFAULT '',
  `UserTypeId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UserTypes`
--

CREATE TABLE `UserTypes` (
  `UserTypeId` int(11) NOT NULL,
  `UserTypeName` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for table `Drugs`
--
ALTER TABLE `Drugs`
  ADD PRIMARY KEY (`DrugId`);

--
-- Indexes for table `Enrolled`
--
ALTER TABLE `Enrolled`
  ADD KEY `PatientId` (`PatientId`),
  ADD KEY `PlanId` (`PlanId`),
  ADD KEY `Company` (`Company`);

--
-- Indexes for table `InsurancePlans`
--
ALTER TABLE `InsurancePlans`
  ADD PRIMARY KEY (`PlanId`,`Company`);

--
-- Indexes for table `PatientRecords`
--
ALTER TABLE `PatientRecords`
  ADD PRIMARY KEY (`PatientId`,`ProviderId`,`Service`,`Date`),
  ADD KEY `DrugId` (`DrugId`),
  ADD KEY `ProviderId` (`ProviderId`),
  ADD KEY `Service` (`Service`);

--
-- Indexes for table `Patients`
--
ALTER TABLE `Patients`
  ADD PRIMARY KEY (`PatientId`);

--
-- Indexes for table `Providers`
--
ALTER TABLE `Providers`
  ADD PRIMARY KEY (`ProviderId`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `UserTypeId` (`UserTypeId`);

--
-- Indexes for table `UserTypes`
--
ALTER TABLE `UserTypes`
  ADD PRIMARY KEY (`UserTypeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Drugs`
--
ALTER TABLE `Drugs`
  MODIFY `DrugId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `InsurancePlans`
--
ALTER TABLE `InsurancePlans`
  MODIFY `PlanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Providers`
--
ALTER TABLE `Providers`
  MODIFY `ProviderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
