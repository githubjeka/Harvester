-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2014 at 08:33 AM
-- Server version: 5.1.40-community-log
-- PHP Version: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `inventar`
--

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Authenticated', '2', NULL, 'N;'),
('Authenticated', '3', NULL, 'N;'),
('Authenticated', '4', NULL, 'N;');

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Admin', 2, NULL, NULL, 'N;'),
('Authenticated', 2, 'Зарегистрированный пользователь', NULL, 'N;'),
('Guest', 2, NULL, NULL, 'N;');

--
-- Dumping data for table `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `firstname`) VALUES
(1, 'Administrator'),
(2, 'user1'),
(3, 'user2'),
(4, 'user3');

--
-- Dumping data for table `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(2, 'firstname', 'First Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3);

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`, `rowPerPage`) VALUES
(1, 'admin', '31ca2a47a67682dde44c5ec7508087fa', 'webmaster@example.com', '9c966491265b0e2fadd211a21c146cf7', 1261146094, 1394441835, '1', 1, 10),
(2, 'asu7', 'fc68c7a6bbbddb19f672c1a97f8f4eee', 'jet@uuu.ru', 'e122c12a54239bcf16825a2aa5445932', 1349155803, 1394094520, '0', 1, 20),
(3, 'dev', '31ca2a47a67682dde44c5ec7508087fa', 'dev@dev.ru', 'c6626a81786d7739859b2dcf074b2023', 1349763616, 1392800818, '1', 1, 100),
(4, 'lincore', '99a750c9b18d68dba279d7639c9d031a', '', '3a16cb81e92005a2ea9dfbd4a48e7584', 1357215848, 0, '0', 0, 10);
