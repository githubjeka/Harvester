-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2014 at 08:32 AM
-- Server version: 5.1.40-community-log
-- PHP Version: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `inventar`
--

-- --------------------------------------------------------

--
-- Table structure for table `antivirus_software`
--

CREATE TABLE IF NOT EXISTS `antivirus_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `antivirus_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `BIOS`
--

CREATE TABLE IF NOT EXISTS `BIOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `BIOS_name` char(70) DEFAULT NULL,
  `Manufacturer_BIOS` char(70) DEFAULT NULL,
  `ReleaseDate_BIOS` date DEFAULT NULL,
  `SMBIOSBIOSVersion` char(70) DEFAULT NULL,
  `SerialNumber_BIOS` char(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Table structure for table `cartridges`
--

CREATE TABLE IF NOT EXISTS `cartridges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cartridge_name` char(255) NOT NULL,
  `count` tinyint(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `cd_drives`
--

CREATE TABLE IF NOT EXISTS `cd_drives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `cd_drive_name` char(100) DEFAULT NULL,
  `cd_drives_label` char(10) DEFAULT NULL,
  `Capabilities` char(30) DEFAULT NULL,
  `SCSIBus` int(11) DEFAULT NULL,
  `SCSILogicalUnit` int(11) DEFAULT NULL,
  `SCSIPort` int(11) DEFAULT NULL,
  `SCSITargetId` int(11) DEFAULT NULL,
  `Manufacturer_cd_drives` char(100) DEFAULT NULL,
  `Description_cd_drives` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

-- --------------------------------------------------------

--
-- Table structure for table `Computers`
--

CREATE TABLE IF NOT EXISTS `Computers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `ip` int(11) DEFAULT NULL,
  `Domain` char(63) DEFAULT NULL,
  `DomainName` char(63) DEFAULT NULL,
  `Department` char(50) DEFAULT NULL,
  `user` char(100) DEFAULT NULL,
  `primary_printer` int(11) DEFAULT NULL,
  `inventar_number` char(6) NOT NULL DEFAULT '000000',
  `year_build` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `ip` (`ip`),
  KEY `Domain` (`Domain`),
  KEY `Department` (`Department`),
  KEY `user` (`user`),
  KEY `primary_printer` (`primary_printer`),
  KEY `inventar_number` (`inventar_number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

-- --------------------------------------------------------

--
-- Table structure for table `Departments`
--

CREATE TABLE IF NOT EXISTS `Departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `Domains`
--

CREATE TABLE IF NOT EXISTS `Domains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` char(63) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Name` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `Input_Device`
--

CREATE TABLE IF NOT EXISTS `Input_Device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `Keyboard` varchar(255) DEFAULT NULL,
  `PointingDevice` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Table structure for table `Memory`
--

CREATE TABLE IF NOT EXISTS `Memory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `model_Memory` char(50) DEFAULT NULL,
  `size_Memory` int(11) DEFAULT NULL,
  `Manufacturer_Memory` char(50) DEFAULT NULL,
  `DataWidth` int(11) DEFAULT NULL,
  `TotalWidth` int(11) DEFAULT NULL,
  `FormFactor_Memory` int(11) DEFAULT NULL,
  `MemoryType_Memory` int(11) DEFAULT NULL,
  `Speed_Memory` int(11) DEFAULT NULL,
  `BankLabel_Memory` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=175 ;

-- --------------------------------------------------------

--
-- Table structure for table `monitors`
--

CREATE TABLE IF NOT EXISTS `monitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `monitor_name` char(50) DEFAULT NULL,
  `MonitorManufacturer` char(50) DEFAULT NULL,
  `Bandwidth` int(10) unsigned DEFAULT NULL,
  `ScreenHeight_monitors` int(7) DEFAULT NULL,
  `ScreenWidth_monitors` int(7) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123 ;

-- --------------------------------------------------------

--
-- Table structure for table `motherboards`
--

CREATE TABLE IF NOT EXISTS `motherboards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `board_name` char(50) DEFAULT NULL,
  `Manufacturer_motherboards` char(255) DEFAULT NULL,
  `SerialNumber_motherboards` char(255) DEFAULT NULL,
  `Version_motherboards` char(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

-- --------------------------------------------------------

--
-- Table structure for table `network_adapters`
--

CREATE TABLE IF NOT EXISTS `network_adapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `adapter_name` char(150) DEFAULT NULL,
  `DefaultIPGateway` char(150) DEFAULT NULL,
  `DefaultTTL` int(8) DEFAULT NULL,
  `DHCPEnabled` enum('1','0') DEFAULT NULL,
  `DHCPServer` char(20) DEFAULT NULL,
  `DNSDomain` char(255) DEFAULT NULL,
  `IPSubnet` char(15) DEFAULT NULL,
  `MACAddress_adapters` bigint(20) unsigned DEFAULT NULL,
  `AdapterType` char(50) DEFAULT NULL,
  `adapter_linkspeed` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=211 ;

-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE IF NOT EXISTS `os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `os_name` char(150) DEFAULT NULL,
  `os_product_key` char(50) DEFAULT NULL,
  `date_install` date DEFAULT NULL,
  `Path` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

-- --------------------------------------------------------

--
-- Table structure for table `physical_drives`
--

CREATE TABLE IF NOT EXISTS `physical_drives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `model_physical_drives` char(70) DEFAULT NULL,
  `InterfaceType_physical_drives` char(70) DEFAULT NULL,
  `Manufacturer_physical_drives` char(70) DEFAULT NULL,
  `MediaType_physical_drives` char(70) DEFAULT NULL,
  `Partitions_physical_drives` int(3) unsigned DEFAULT NULL,
  `TotalCylinders` int(11) DEFAULT NULL,
  `TotalHeads` int(11) DEFAULT NULL,
  `TotalSectors` int(11) DEFAULT NULL,
  `TotalTracks` int(11) DEFAULT NULL,
  `TracksPerCylinder` int(11) DEFAULT NULL,
  `Size_physical_drives` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE IF NOT EXISTS `printers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `printer_name` char(255) DEFAULT NULL,
  `Capabilities` char(42) DEFAULT NULL,
  `PortName_printers` char(255) DEFAULT NULL,
  `PrintProcessor` char(255) DEFAULT NULL,
  `HorizontalResolution_printers` int(11) unsigned DEFAULT NULL,
  `VerticalResolution_printers` int(11) unsigned DEFAULT NULL,
  `type_printers` varchar(255) DEFAULT NULL,
  `kartridje_printer` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`),
  KEY `kartridje_printer` (`kartridje_printer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=331 ;

-- --------------------------------------------------------

--
-- Table structure for table `printer_cartridge`
--

CREATE TABLE IF NOT EXISTS `printer_cartridge` (
  `id_relation` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_printer` int(10) NOT NULL,
  `id_cartridge` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_relation`),
  KEY `id_printer` (`id_printer`,`id_cartridge`),
  KEY `id_cartridge` (`id_cartridge`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=160 ;

-- --------------------------------------------------------

--
-- Table structure for table `processors`
--

CREATE TABLE IF NOT EXISTS `processors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `processor_name` char(50) DEFAULT NULL,
  `Architecture` enum('1','2','3','6','9','0') DEFAULT NULL,
  `DataWidth` enum('32','64') DEFAULT NULL,
  `processor_socket_designation` char(50) DEFAULT NULL,
  `processor_speed` int(7) DEFAULT NULL,
  `MaxClockSpeed_processors` int(7) DEFAULT NULL,
  `ExtClock_processors` int(5) DEFAULT NULL,
  `Level_processors` int(2) DEFAULT NULL,
  `Description_processors` char(50) DEFAULT NULL,
  `Manufacturer_processors` char(50) DEFAULT NULL,
  `Status_processors` char(2) DEFAULT NULL,
  `Stepping` char(10) DEFAULT NULL,
  `L2CacheSize_processors` int(7) DEFAULT NULL,
  `L2CacheSpeed_processors` int(7) DEFAULT NULL,
  `L3CacheSize` int(7) DEFAULT NULL,
  `L3CacheSpeed` int(7) DEFAULT NULL,
  `CurrentVoltage_processors` char(5) DEFAULT NULL,
  `Version` char(50) DEFAULT NULL,
  `num_proc` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE IF NOT EXISTS `software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(1) NOT NULL,
  `software_name1` varchar(255) DEFAULT NULL,
  `software_name2` varchar(255) DEFAULT NULL,
  `software_name3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `SoundDevice`
--

CREATE TABLE IF NOT EXISTS `SoundDevice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `name_SoundDevice` char(70) DEFAULT NULL,
  `Manufacturer_SoundDevice` char(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `lastvisit` int(10) unsigned NOT NULL DEFAULT '0',
  `superuser` enum('1','0') NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `rowPerPage` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `videoadapters`
--

CREATE TABLE IF NOT EXISTS `videoadapters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comp_id` int(11) NOT NULL,
  `AcceleratorCapabilities` tinyint(1) unsigned DEFAULT NULL,
  `CapabilityDescriptions` varchar(255) DEFAULT NULL,
  `CurrentScanMode` enum('1','2','3','4') NOT NULL,
  `AdapterCompatibility` char(70) DEFAULT NULL,
  `VideoProcessor` char(70) DEFAULT NULL,
  `AdapterDACType` char(70) DEFAULT NULL,
  `videoadapter_name` char(70) DEFAULT NULL,
  `AdapterRAM` int(6) unsigned DEFAULT NULL,
  `VideoMemoryType` int(11) DEFAULT NULL,
  `VideoModeDescription` char(70) DEFAULT NULL,
  `CurrentBitsPerPixel` int(4) unsigned DEFAULT NULL,
  `InstalledDisplayDrivers` char(70) DEFAULT NULL,
  `DriverVersion_videoadapters` char(70) DEFAULT NULL,
  `MaxRefreshRate_videoadapters` int(4) unsigned DEFAULT NULL,
  `MinRefreshRate_videoadapters` int(4) unsigned DEFAULT NULL,
  `VideoArchitecture` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comp_id` (`comp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=116 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antivirus_software`
--
ALTER TABLE `antivirus_software`
  ADD CONSTRAINT `antivirus_software_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `BIOS`
--
ALTER TABLE `BIOS`
  ADD CONSTRAINT `bios_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cd_drives`
--
ALTER TABLE `cd_drives`
  ADD CONSTRAINT `cd_drives_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Computers`
--
ALTER TABLE `Computers`
  ADD CONSTRAINT `computers_ibfk_1` FOREIGN KEY (`primary_printer`) REFERENCES `printers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `Input_Device`
--
ALTER TABLE `Input_Device`
  ADD CONSTRAINT `input_device_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Memory`
--
ALTER TABLE `Memory`
  ADD CONSTRAINT `memory_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monitors`
--
ALTER TABLE `monitors`
  ADD CONSTRAINT `monitors_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `motherboards`
--
ALTER TABLE `motherboards`
  ADD CONSTRAINT `motherboards_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `network_adapters`
--
ALTER TABLE `network_adapters`
  ADD CONSTRAINT `network_adapters_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `os`
--
ALTER TABLE `os`
  ADD CONSTRAINT `os_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `physical_drives`
--
ALTER TABLE `physical_drives`
  ADD CONSTRAINT `physical_drives_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `printers`
--
ALTER TABLE `printers`
  ADD CONSTRAINT `printers_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `printers_ibfk_4` FOREIGN KEY (`kartridje_printer`) REFERENCES `cartridges` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `printer_cartridge`
--
ALTER TABLE `printer_cartridge`
  ADD CONSTRAINT `printer_cartridge_ibfk_3` FOREIGN KEY (`id_printer`) REFERENCES `printers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `printer_cartridge_ibfk_4` FOREIGN KEY (`id_cartridge`) REFERENCES `cartridges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `processors`
--
ALTER TABLE `processors`
  ADD CONSTRAINT `processors_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `software_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SoundDevice`
--
ALTER TABLE `SoundDevice`
  ADD CONSTRAINT `sounddevice_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videoadapters`
--
ALTER TABLE `videoadapters`
  ADD CONSTRAINT `videoadapters_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `computers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
