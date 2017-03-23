-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2017 at 05:04 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `init`
--
CREATE DATABASE IF NOT EXISTS `init` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `init`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `itemid` decimal(10,0) NOT NULL,
  `itemname` varchar(50) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemid`, `itemname`, `price`) VALUES
('1', 'Cream of Mushroom Soup', '130'),
('2', 'Pasta Salad', '130'),
('3', 'Caesar Salad', '150'),
('4', 'Mexican Nachos', '175'),
('5', 'Chicken and Cheese Poppers', '200'),
('6', 'Fish Fingers', '220'),
('7', 'Vegetable Sizzler', '200');

-- --------------------------------------------------------

--
-- Table structure for table `orders2`
--

CREATE TABLE IF NOT EXISTS `orders2` (
  `ordernum` decimal(10,0) NOT NULL,
  `tablenum` decimal(10,0) DEFAULT NULL,
  `patronid` decimal(10,0) DEFAULT NULL,
  `itemid` decimal(10,0) DEFAULT NULL,
  `qty` decimal(10,0) DEFAULT NULL,
  `paid` decimal(10,0) DEFAULT '0',
  `price` decimal(10,0) DEFAULT NULL,
  `splitwith` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ordernum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patrons`
--

CREATE TABLE IF NOT EXISTS `patrons` (
  `tablenum` decimal(10,0) NOT NULL,
  `patronid` decimal(10,0) NOT NULL,
  PRIMARY KEY (`tablenum`,`patronid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patrons`
--

INSERT INTO `patrons` (`tablenum`, `patronid`) VALUES
('1', '1'),
('1', '2'),
('1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `tablenum` decimal(10,0) NOT NULL,
  `tablesize` decimal(10,0) NOT NULL,
  PRIMARY KEY (`tablenum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`tablenum`, `tablesize`) VALUES
('1', '2'),
('2', '2'),
('3', '2'),
('4', '2'),
('5', '4'),
('6', '4'),
('7', '4'),
('8', '4'),
('9', '10'),
('10', '10');
;
