-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2018 at 06:21 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgetdept`
--

CREATE TABLE `budgetdept` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budgetdept`
--

INSERT INTO `budgetdept` (`id`, `username`, `created_at`, `updated_at`, `fname`, `mname`, `lname`, `suffix`, `active`, `status`, `email`, `password`, `remember_token`) VALUES
(1, 'budgetdept', '2018-01-29 09:20:58', '2018-01-29 09:20:58', 'Brenda', NULL, 'Pasadas', NULL, 1, 1, 'bd@email.com', '$2y$10$HBgkoPdEz6xlJ/E5Zn9FLu2qKBgOeQ/wNrSVVfYXUNkvkrAKDZNba', 'QSLIHC4jfV');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `username`, `fname`, `mname`, `lname`, `suffix`, `email`, `password`, `active`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'operations', 'Criszel', NULL, 'Murillo', NULL, 'o@email.com', '$2y$10$y.0bMp./2iMG6h3jEKNdguEf.eiij.ftWj4Jsdt5g/7yg/aVlFhPC', 1, 1, 'yF0ZKqu7OQ', '2018-01-29 09:20:57', '2018-01-29 09:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projectmanager`
--

CREATE TABLE `projectmanager` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectmanager`
--

INSERT INTO `projectmanager` (`id`, `username`, `email`, `password`, `fname`, `mname`, `lname`, `suffix`, `active`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'pm', 'pm@email.com', '$2y$10$H5hYzbvRzRzqI9Hj.1uG7OldwqgdbfCQxrPhWuNwdXM.trxPpfbOS', 'Ambrosio', NULL, 'Cruz', NULL, 1, 1, 'Q93tKoWA6k', '2018-01-29 09:20:58', '2018-01-29 09:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblbank`
--

CREATE TABLE `tblbank` (
  `id` int(11) NOT NULL,
  `BankName` varchar(100) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclient`
--

CREATE TABLE `tblclient` (
  `strCompClientID` varchar(100) NOT NULL,
  `strCompClientImage` varchar(100) DEFAULT NULL,
  `strCompClientName` varchar(45) NOT NULL,
  `strCompClientRepresentative` varchar(100) NOT NULL,
  `strCompClientPosition` varchar(30) NOT NULL,
  `strCompClientTIN` varchar(20) NOT NULL,
  `strCompClientContactNo` varchar(20) NOT NULL,
  `strCompClientEmail` varchar(45) NOT NULL,
  `strCompClientAddress` varchar(100) NOT NULL,
  `strCompClientCity` varchar(30) NOT NULL,
  `strCompClientProv` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `todelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclientidutil`
--

CREATE TABLE `tblclientidutil` (
  `strClientIDUtil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclientidutil`
--

INSERT INTO `tblclientidutil` (`strClientIDUtil`) VALUES
('Client0000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompanyutil`
--

CREATE TABLE `tblcompanyutil` (
  `intCompanyUtilID` int(10) NOT NULL,
  `strCompanyName` varchar(100) NOT NULL,
  `strCompanyTIN` varchar(20) NOT NULL,
  `strCompanyAddress` varchar(100) NOT NULL,
  `strCompanyEmail` varchar(50) NOT NULL,
  `strGeneralManagerName` varchar(100) NOT NULL,
  `strCompanyLogo` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontract`
--

CREATE TABLE `tblcontract` (
  `id` varchar(100) NOT NULL,
  `ClientID` varchar(100) NOT NULL,
  `TaxID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `datesigned` date NOT NULL,
  `location` varchar(100) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `term` int(11) NOT NULL,
  `termdate` varchar(45) NOT NULL,
  `active` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractidutil`
--

CREATE TABLE `tblcontractidutil` (
  `strContractIDUtil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcontractidutil`
--

INSERT INTO `tblcontractidutil` (`strContractIDUtil`) VALUES
('Contract0000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontractorder`
--

CREATE TABLE `tblcontractorder` (
  `ContractID` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontracttask`
--

CREATE TABLE `tblcontracttask` (
  `id` int(11) NOT NULL,
  `ContractID` varchar(100) NOT NULL,
  `ServID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliveryrec`
--

CREATE TABLE `tbldeliveryrec` (
  `id` int(11) NOT NULL,
  `number` varchar(45) NOT NULL,
  `stockMatID` int(10) NOT NULL,
  `SuppID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliverytruck`
--

CREATE TABLE `tbldeliverytruck` (
  `id` int(10) NOT NULL,
  `DeliTruckPlateNo` varchar(8) NOT NULL,
  `DeliTruckVINNo` varchar(17) NOT NULL,
  `DeliTruckCapacity` double NOT NULL,
  `DeliTruckGrossWeight` double NOT NULL,
  `todelete` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldetailuom`
--

CREATE TABLE `tbldetailuom` (
  `id` int(10) NOT NULL,
  `GroupUOMID` int(10) NOT NULL,
  `DetailUOMText` varchar(50) NOT NULL,
  `UOMUnitSymbol` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldownpayment`
--

CREATE TABLE `tbldownpayment` (
  `id` int(11) NOT NULL,
  `ContractID` varchar(100) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `status` int(11) NOT NULL,
  `initialtax` decimal(11,2) NOT NULL,
  `taxValue` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblempidutil`
--

CREATE TABLE `tblempidutil` (
  `strEmpIDUtil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment`
--

CREATE TABLE `tblequipment` (
  `id` int(10) NOT NULL,
  `EquipName` varchar(30) NOT NULL,
  `EquipLeaser` varchar(50) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `EquipKey` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL,
  `EquipPrice` decimal(11,2) DEFAULT NULL,
  `EquipTypeDesc` varchar(45) NOT NULL,
  `rent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblfee`
--

CREATE TABLE `tblfee` (
  `id` int(10) NOT NULL,
  `FeeDesc` varchar(100) NOT NULL,
  `FeeValue` decimal(11,2) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfee`
--

INSERT INTO `tblfee` (`id`, `FeeDesc`, `FeeValue`, `todelete`, `status`) VALUES
(1, 'Service Markup', '18.00', 1, 1),
(2, 'Handling Fee', '4.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgroupuom`
--

CREATE TABLE `tblgroupuom` (
  `id` int(10) NOT NULL,
  `GroupUOMText` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblincurrences`
--

CREATE TABLE `tblincurrences` (
  `id` int(11) NOT NULL,
  `desc` text NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `user` varchar(45) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoiceidutil`
--

CREATE TABLE `tblinvoiceidutil` (
  `strInvoiceIDUtil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinvoiceidutil`
--

INSERT INTO `tblinvoiceidutil` (`strInvoiceIDUtil`) VALUES
('Inv0000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterial`
--

CREATE TABLE `tblmaterial` (
  `id` int(10) NOT NULL,
  `MatClassID` int(10) NOT NULL,
  `MatUOM` int(10) NOT NULL,
  `MaterialName` varchar(50) NOT NULL,
  `MaterialBrand` varchar(50) DEFAULT NULL,
  `MaterialSize` varchar(15) DEFAULT NULL,
  `MaterialColor` varchar(30) DEFAULT NULL,
  `MaterialDimension` varchar(40) DEFAULT NULL,
  `MaterialUnitPrice` decimal(11,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterialclass`
--

CREATE TABLE `tblmaterialclass` (
  `id` int(10) NOT NULL,
  `MatTypeID` int(10) NOT NULL,
  `MatClassName` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmaterialtype`
--

CREATE TABLE `tblmaterialtype` (
  `id` int(10) NOT NULL,
  `MatTypeName` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmiscellaneous`
--

CREATE TABLE `tblmiscellaneous` (
  `id` int(11) NOT NULL,
  `MiscDesc` varchar(100) NOT NULL,
  `MiscValue` decimal(11,2) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbloridutil`
--

CREATE TABLE `tbloridutil` (
  `strOrIDUtil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbloridutil`
--

INSERT INTO `tbloridutil` (`strOrIDUtil`) VALUES
('OR0000000');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `OrID` varchar(100) NOT NULL,
  `InvID` varchar(100) NOT NULL,
  `amountpaid` decimal(11,2) NOT NULL,
  `date` date NOT NULL,
  `change` decimal(11,2) NOT NULL,
  `remarks` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymentmode`
--

CREATE TABLE `tblpaymentmode` (
  `id` int(11) NOT NULL,
  `ModeValue` float NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpaymentmode`
--

INSERT INTO `tblpaymentmode` (`id`, `ModeValue`, `todelete`, `status`) VALUES
(1, 10, 1, 1),
(2, 20, 1, 1),
(3, 30, 1, 1),
(4, 40, 1, 1),
(5, 50, 1, 1),
(6, 60, 1, 1),
(7, 70, 1, 1),
(8, 80, 1, 1),
(9, 90, 1, 1),
(10, 100, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblprogressbill`
--

CREATE TABLE `tblprogressbill` (
  `id` int(11) NOT NULL,
  `ContractID` varchar(100) NOT NULL,
  `ModeID` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `RecID` int(11) NOT NULL,
  `RetID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblprogressdetail`
--

CREATE TABLE `tblprogressdetail` (
  `id` int(11) NOT NULL,
  `recValue` decimal(11,2) NOT NULL,
  `retValue` decimal(11,2) NOT NULL,
  `initial` decimal(11,2) NOT NULL,
  `initialtax` decimal(11,2) NOT NULL,
  `taxValue` decimal(11,2) NOT NULL,
  `PB_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrate`
--

CREATE TABLE `tblrate` (
  `id` int(11) NOT NULL,
  `RateDesc` varchar(50) NOT NULL,
  `RateValue` decimal(11,2) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblrecoupment`
--

CREATE TABLE `tblrecoupment` (
  `id` int(11) NOT NULL,
  `RecValue` decimal(11,2) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrecoupment`
--

INSERT INTO `tblrecoupment` (`id`, `RecValue`, `todelete`, `status`) VALUES
(1, '30.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblretention`
--

CREATE TABLE `tblretention` (
  `id` int(11) NOT NULL,
  `RetValue` decimal(11,2) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblretention`
--

INSERT INTO `tblretention` (`id`, `RetValue`, `todelete`, `status`) VALUES
(1, '10.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblservequip`
--

CREATE TABLE `tblservequip` (
  `id` int(11) NOT NULL,
  `EquipID` int(10) NOT NULL,
  `todelete` int(11) NOT NULL,
  `ServID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservfee`
--

CREATE TABLE `tblservfee` (
  `id` int(11) NOT NULL,
  `ServID` int(10) NOT NULL,
  `FeeID` int(11) NOT NULL,
  `todelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblserviceinvoicedetail`
--

CREATE TABLE `tblserviceinvoicedetail` (
  `InvID` varchar(100) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `subtotal` decimal(11,2) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblserviceinvoiceheader`
--

CREATE TABLE `tblserviceinvoiceheader` (
  `id` varchar(100) NOT NULL,
  `ContractID` varchar(100) NOT NULL,
  `date` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `duedate` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservicesoffered`
--

CREATE TABLE `tblservicesoffered` (
  `id` int(10) NOT NULL,
  `ServiceOffName` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `todelete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservmaterial`
--

CREATE TABLE `tblservmaterial` (
  `id` int(11) NOT NULL,
  `ServID` int(11) NOT NULL,
  `MatID` int(10) NOT NULL,
  `todelete` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservmatfee`
--

CREATE TABLE `tblservmatfee` (
  `ServID` int(11) NOT NULL,
  `FeeID` int(10) NOT NULL,
  `amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservtask`
--

CREATE TABLE `tblservtask` (
  `id` int(11) NOT NULL,
  `ServOffID` int(10) NOT NULL,
  `ServTask` text NOT NULL,
  `duration` float NOT NULL,
  `total` decimal(11,2) NOT NULL,
  `remarks` text,
  `status` int(11) NOT NULL,
  `todelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservtaskdue`
--

CREATE TABLE `tblservtaskdue` (
  `ServTaskID` int(11) NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservwfee`
--

CREATE TABLE `tblservwfee` (
  `ServWID` int(11) NOT NULL,
  `FeeID` int(10) NOT NULL,
  `amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblservworker`
--

CREATE TABLE `tblservworker` (
  `id` int(11) NOT NULL,
  `ServID` int(11) NOT NULL,
  `SpecID` int(10) NOT NULL,
  `todelete` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblspecdate`
--

CREATE TABLE `tblspecdate` (
  `id` int(11) NOT NULL,
  `SpecID` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `up_rpd` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblspecialization`
--

CREATE TABLE `tblspecialization` (
  `id` int(10) NOT NULL,
  `SpecDesc` varchar(45) NOT NULL,
  `rpd` decimal(11,2) NOT NULL,
  `todelete` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstockcard`
--

CREATE TABLE `tblstockcard` (
  `MatID` int(10) NOT NULL,
  `quantity` float NOT NULL,
  `date` datetime NOT NULL,
  `method` varchar(3) NOT NULL,
  `stock` float NOT NULL,
  `cost` decimal(11,2) NOT NULL,
  `totalcost` decimal(11,2) NOT NULL,
  `SuppID` int(11) DEFAULT NULL,
  `number` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstocks`
--

CREATE TABLE `tblstocks` (
  `MatID` int(10) NOT NULL,
  `stocks` float NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `id` int(11) NOT NULL,
  `SuppDesc` varchar(100) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltax`
--

CREATE TABLE `tbltax` (
  `id` int(11) NOT NULL,
  `TaxValue` int(11) NOT NULL,
  `todelete` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltax`
--

INSERT INTO `tbltax` (`id`, `TaxValue`, `todelete`, `status`) VALUES
(1, 12, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgetdept`
--
ALTER TABLE `budgetdept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `operations_email_unique` (`email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projectmanager`
--
ALTER TABLE `projectmanager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projectmanager_email_unique` (`email`);

--
-- Indexes for table `tblbank`
--
ALTER TABLE `tblbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclient`
--
ALTER TABLE `tblclient`
  ADD PRIMARY KEY (`strCompClientID`);

--
-- Indexes for table `tblclientidutil`
--
ALTER TABLE `tblclientidutil`
  ADD PRIMARY KEY (`strClientIDUtil`);

--
-- Indexes for table `tblcompanyutil`
--
ALTER TABLE `tblcompanyutil`
  ADD PRIMARY KEY (`intCompanyUtilID`);

--
-- Indexes for table `tblcontract`
--
ALTER TABLE `tblcontract`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblcontract_tblClient1_idx` (`ClientID`),
  ADD KEY `fk_tblcontract_tbltax1_idx` (`TaxID`);

--
-- Indexes for table `tblcontractidutil`
--
ALTER TABLE `tblcontractidutil`
  ADD PRIMARY KEY (`strContractIDUtil`);

--
-- Indexes for table `tblcontractorder`
--
ALTER TABLE `tblcontractorder`
  ADD KEY `fk_tblcontractorder_tblcontract1_idx` (`ContractID`);

--
-- Indexes for table `tblcontracttask`
--
ALTER TABLE `tblcontracttask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblcontractdetail_tblcontract1_idx` (`ContractID`),
  ADD KEY `fk_tblcontractdetail_tblservtask1_idx` (`ServID`);

--
-- Indexes for table `tbldeliveryrec`
--
ALTER TABLE `tbldeliveryrec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbldeliveryrec_tblstocks1_idx` (`stockMatID`),
  ADD KEY `fk_tbldeliveryrec_tblsupplier1_idx` (`SuppID`);

--
-- Indexes for table `tbldeliverytruck`
--
ALTER TABLE `tbldeliverytruck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldetailuom`
--
ALTER TABLE `tbldetailuom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblDetailUOM_tblGroupUOM1_idx` (`GroupUOMID`);

--
-- Indexes for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbldownpayment_tblcontract1_idx` (`ContractID`);

--
-- Indexes for table `tblempidutil`
--
ALTER TABLE `tblempidutil`
  ADD PRIMARY KEY (`strEmpIDUtil`);

--
-- Indexes for table `tblequipment`
--
ALTER TABLE `tblequipment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `EquipKey_UNIQUE` (`EquipKey`);

--
-- Indexes for table `tblfee`
--
ALTER TABLE `tblfee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgroupuom`
--
ALTER TABLE `tblgroupuom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblincurrences`
--
ALTER TABLE `tblincurrences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinvoiceidutil`
--
ALTER TABLE `tblinvoiceidutil`
  ADD PRIMARY KEY (`strInvoiceIDUtil`);

--
-- Indexes for table `tblmaterial`
--
ALTER TABLE `tblmaterial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblMaterial_tblDetailUOM1_idx` (`MatUOM`),
  ADD KEY `fk_tblMaterial_tblMaterialClass1_idx` (`MatClassID`);

--
-- Indexes for table `tblmaterialclass`
--
ALTER TABLE `tblmaterialclass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblMaterialClass_tblMaterialType1_idx` (`MatTypeID`);

--
-- Indexes for table `tblmaterialtype`
--
ALTER TABLE `tblmaterialtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmiscellaneous`
--
ALTER TABLE `tblmiscellaneous`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbloridutil`
--
ALTER TABLE `tbloridutil`
  ADD PRIMARY KEY (`strOrIDUtil`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`OrID`),
  ADD KEY `fk_tblpayment_tblserviceinvoiceheader1_idx` (`InvID`);

--
-- Indexes for table `tblpaymentmode`
--
ALTER TABLE `tblpaymentmode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblprogressbill`
--
ALTER TABLE `tblprogressbill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblprogressbill_tblrecoupment1_idx` (`RecID`),
  ADD KEY `fk_tblprogressbill_tblretention1_idx` (`RetID`),
  ADD KEY `fk_tblprogressbill_tblcontract1_idx` (`ContractID`),
  ADD KEY `fk_tblprogressbill_tblpaymentmode1_idx` (`ModeID`);

--
-- Indexes for table `tblprogressdetail`
--
ALTER TABLE `tblprogressdetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblprogressdetail_tblprogressbill1_idx` (`PB_ID`);

--
-- Indexes for table `tblrate`
--
ALTER TABLE `tblrate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrecoupment`
--
ALTER TABLE `tblrecoupment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblretention`
--
ALTER TABLE `tblretention`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservequip`
--
ALTER TABLE `tblservequip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblservequip_tblequipment1_idx` (`EquipID`),
  ADD KEY `fk_tblservequip_tblservtask1_idx` (`ServID`);

--
-- Indexes for table `tblservfee`
--
ALTER TABLE `tblservfee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblservfee_tblservicesoffered1_idx` (`ServID`),
  ADD KEY `fk_tblservfee_tblfee1_idx` (`FeeID`);

--
-- Indexes for table `tblserviceinvoicedetail`
--
ALTER TABLE `tblserviceinvoicedetail`
  ADD KEY `fk_tblserviceinvoicedetail_tblserviceinvoiceheader1_idx` (`InvID`);

--
-- Indexes for table `tblserviceinvoiceheader`
--
ALTER TABLE `tblserviceinvoiceheader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblserviceinvoiceheader_tblcontract1_idx` (`ContractID`);

--
-- Indexes for table `tblservicesoffered`
--
ALTER TABLE `tblservicesoffered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblservmaterial`
--
ALTER TABLE `tblservmaterial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblservmaterial_tblmaterial1_idx` (`MatID`),
  ADD KEY `fk_tblservmaterial_tblservtask1_idx` (`ServID`);

--
-- Indexes for table `tblservmatfee`
--
ALTER TABLE `tblservmatfee`
  ADD KEY `fk_tblservmatfee_tblfee1_idx` (`FeeID`),
  ADD KEY `fk_tblservmatfee_tblservtask1_idx` (`ServID`);

--
-- Indexes for table `tblservtask`
--
ALTER TABLE `tblservtask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblservtask_tblservicesoffered1_idx` (`ServOffID`);

--
-- Indexes for table `tblservtaskdue`
--
ALTER TABLE `tblservtaskdue`
  ADD KEY `fk_tblservtaskdue_tblservtask1_idx` (`ServTaskID`);

--
-- Indexes for table `tblservwfee`
--
ALTER TABLE `tblservwfee`
  ADD KEY `fk_tblservwfee_tblservworker1_idx` (`ServWID`),
  ADD KEY `fk_tblservwfee_tblfee1_idx` (`FeeID`);

--
-- Indexes for table `tblservworker`
--
ALTER TABLE `tblservworker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblservworker_tblspecialization1_idx` (`SpecID`),
  ADD KEY `fk_tblservworker_tblservtask1_idx` (`ServID`);

--
-- Indexes for table `tblspecdate`
--
ALTER TABLE `tblspecdate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tblspecrate_tblspecialization1_idx` (`SpecID`);

--
-- Indexes for table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstockcard`
--
ALTER TABLE `tblstockcard`
  ADD KEY `fk_tblstockcard_tblmaterial1_idx` (`MatID`),
  ADD KEY `fk_tblstockcard_tblsupplier1_idx` (`SuppID`);

--
-- Indexes for table `tblstocks`
--
ALTER TABLE `tblstocks`
  ADD PRIMARY KEY (`MatID`),
  ADD KEY `fk_tblstocks_tblmaterial1_idx` (`MatID`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltax`
--
ALTER TABLE `tbltax`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgetdept`
--
ALTER TABLE `budgetdept`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projectmanager`
--
ALTER TABLE `projectmanager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbank`
--
ALTER TABLE `tblbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcompanyutil`
--
ALTER TABLE `tblcompanyutil`
  MODIFY `intCompanyUtilID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcontracttask`
--
ALTER TABLE `tblcontracttask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldeliveryrec`
--
ALTER TABLE `tbldeliveryrec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldeliverytruck`
--
ALTER TABLE `tbldeliverytruck`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldetailuom`
--
ALTER TABLE `tbldetailuom`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblequipment`
--
ALTER TABLE `tblequipment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblfee`
--
ALTER TABLE `tblfee`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblgroupuom`
--
ALTER TABLE `tblgroupuom`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblincurrences`
--
ALTER TABLE `tblincurrences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmaterial`
--
ALTER TABLE `tblmaterial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmaterialclass`
--
ALTER TABLE `tblmaterialclass`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmaterialtype`
--
ALTER TABLE `tblmaterialtype`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblmiscellaneous`
--
ALTER TABLE `tblmiscellaneous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpaymentmode`
--
ALTER TABLE `tblpaymentmode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tblprogressbill`
--
ALTER TABLE `tblprogressbill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblprogressdetail`
--
ALTER TABLE `tblprogressdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblrate`
--
ALTER TABLE `tblrate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblrecoupment`
--
ALTER TABLE `tblrecoupment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblretention`
--
ALTER TABLE `tblretention`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblservequip`
--
ALTER TABLE `tblservequip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblservfee`
--
ALTER TABLE `tblservfee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblservicesoffered`
--
ALTER TABLE `tblservicesoffered`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblservmaterial`
--
ALTER TABLE `tblservmaterial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblservtask`
--
ALTER TABLE `tblservtask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblservworker`
--
ALTER TABLE `tblservworker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblspecdate`
--
ALTER TABLE `tblspecdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblspecialization`
--
ALTER TABLE `tblspecialization`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbltax`
--
ALTER TABLE `tbltax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcontract`
--
ALTER TABLE `tblcontract`
  ADD CONSTRAINT `fk_tblcontract_tblClient1` FOREIGN KEY (`ClientID`) REFERENCES `tblclient` (`strCompClientID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblcontract_tbltax1` FOREIGN KEY (`TaxID`) REFERENCES `tbltax` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcontractorder`
--
ALTER TABLE `tblcontractorder`
  ADD CONSTRAINT `fk_tblcontractorder_tblcontract1` FOREIGN KEY (`ContractID`) REFERENCES `tblcontract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblcontracttask`
--
ALTER TABLE `tblcontracttask`
  ADD CONSTRAINT `fk_tblcontractdetail_tblcontract1` FOREIGN KEY (`ContractID`) REFERENCES `tblcontract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblcontractdetail_tblservtask1` FOREIGN KEY (`ServID`) REFERENCES `tblservtask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbldeliveryrec`
--
ALTER TABLE `tbldeliveryrec`
  ADD CONSTRAINT `fk_tbldeliveryrec_tblstocks1` FOREIGN KEY (`stockMatID`) REFERENCES `tblstocks` (`MatID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbldeliveryrec_tblsupplier1` FOREIGN KEY (`SuppID`) REFERENCES `tblsupplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbldetailuom`
--
ALTER TABLE `tbldetailuom`
  ADD CONSTRAINT `fk_tblDetailUOM_tblGroupUOM1` FOREIGN KEY (`GroupUOMID`) REFERENCES `tblgroupuom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbldownpayment`
--
ALTER TABLE `tbldownpayment`
  ADD CONSTRAINT `fk_tbldownpayment_tblcontract1` FOREIGN KEY (`ContractID`) REFERENCES `tblcontract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblmaterial`
--
ALTER TABLE `tblmaterial`
  ADD CONSTRAINT `fk_tblMaterial_tblDetailUOM1` FOREIGN KEY (`MatUOM`) REFERENCES `tbldetailuom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblMaterial_tblMaterialClass1` FOREIGN KEY (`MatClassID`) REFERENCES `tblmaterialclass` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblmaterialclass`
--
ALTER TABLE `tblmaterialclass`
  ADD CONSTRAINT `fk_tblMaterialClass_tblMaterialType1` FOREIGN KEY (`MatTypeID`) REFERENCES `tblmaterialtype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD CONSTRAINT `fk_tblpayment_tblserviceinvoiceheader1` FOREIGN KEY (`InvID`) REFERENCES `tblserviceinvoiceheader` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblprogressbill`
--
ALTER TABLE `tblprogressbill`
  ADD CONSTRAINT `fk_tblprogressbill_tblcontract1` FOREIGN KEY (`ContractID`) REFERENCES `tblcontract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblprogressbill_tblpaymentmode1` FOREIGN KEY (`ModeID`) REFERENCES `tblpaymentmode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblprogressbill_tblrecoupment1` FOREIGN KEY (`RecID`) REFERENCES `tblrecoupment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblprogressbill_tblretention1` FOREIGN KEY (`RetID`) REFERENCES `tblretention` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblprogressdetail`
--
ALTER TABLE `tblprogressdetail`
  ADD CONSTRAINT `fk_tblprogressdetail_tblprogressbill1` FOREIGN KEY (`PB_ID`) REFERENCES `tblprogressbill` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservequip`
--
ALTER TABLE `tblservequip`
  ADD CONSTRAINT `fk_tblservequip_tblequipment1` FOREIGN KEY (`EquipID`) REFERENCES `tblequipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblservequip_tblservtask1` FOREIGN KEY (`ServID`) REFERENCES `tblservtask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservfee`
--
ALTER TABLE `tblservfee`
  ADD CONSTRAINT `fk_tblservfee_tblfee1` FOREIGN KEY (`FeeID`) REFERENCES `tblfee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblservfee_tblservicesoffered1` FOREIGN KEY (`ServID`) REFERENCES `tblservicesoffered` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblserviceinvoicedetail`
--
ALTER TABLE `tblserviceinvoicedetail`
  ADD CONSTRAINT `fk_tblserviceinvoicedetail_tblserviceinvoiceheader1` FOREIGN KEY (`InvID`) REFERENCES `tblserviceinvoiceheader` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblserviceinvoiceheader`
--
ALTER TABLE `tblserviceinvoiceheader`
  ADD CONSTRAINT `fk_tblserviceinvoiceheader_tblcontract1` FOREIGN KEY (`ContractID`) REFERENCES `tblcontract` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservmaterial`
--
ALTER TABLE `tblservmaterial`
  ADD CONSTRAINT `fk_tblservmaterial_tblmaterial1` FOREIGN KEY (`MatID`) REFERENCES `tblmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblservmaterial_tblservtask1` FOREIGN KEY (`ServID`) REFERENCES `tblservtask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservmatfee`
--
ALTER TABLE `tblservmatfee`
  ADD CONSTRAINT `fk_tblservmatfee_tblfee1` FOREIGN KEY (`FeeID`) REFERENCES `tblfee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblservmatfee_tblservtask1` FOREIGN KEY (`ServID`) REFERENCES `tblservtask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservtask`
--
ALTER TABLE `tblservtask`
  ADD CONSTRAINT `fk_tblservtask_tblservicesoffered1` FOREIGN KEY (`ServOffID`) REFERENCES `tblservicesoffered` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservtaskdue`
--
ALTER TABLE `tblservtaskdue`
  ADD CONSTRAINT `fk_tblservtaskdue_tblservtask1` FOREIGN KEY (`ServTaskID`) REFERENCES `tblservtask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservwfee`
--
ALTER TABLE `tblservwfee`
  ADD CONSTRAINT `fk_tblservwfee_tblfee1` FOREIGN KEY (`FeeID`) REFERENCES `tblfee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblservwfee_tblservworker1` FOREIGN KEY (`ServWID`) REFERENCES `tblservworker` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblservworker`
--
ALTER TABLE `tblservworker`
  ADD CONSTRAINT `fk_tblservworker_tblservtask1` FOREIGN KEY (`ServID`) REFERENCES `tblservtask` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblservworker_tblspecialization1` FOREIGN KEY (`SpecID`) REFERENCES `tblspecialization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblspecdate`
--
ALTER TABLE `tblspecdate`
  ADD CONSTRAINT `fk_tblspecrate_tblspecialization1` FOREIGN KEY (`SpecID`) REFERENCES `tblspecialization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblstockcard`
--
ALTER TABLE `tblstockcard`
  ADD CONSTRAINT `fk_tblstockcard_tblmaterial1` FOREIGN KEY (`MatID`) REFERENCES `tblmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblstockcard_tblsupplier1` FOREIGN KEY (`SuppID`) REFERENCES `tblsupplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tblstocks`
--
ALTER TABLE `tblstocks`
  ADD CONSTRAINT `fk_tblstocks_tblmaterial1` FOREIGN KEY (`MatID`) REFERENCES `tblmaterial` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
