-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2013 at 08:50 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testresult`
--

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE IF NOT EXISTS `summary` (
  `SummaryID` int(11) NOT NULL AUTO_INCREMENT,
  `TestName` varchar(11) NOT NULL,
  `Actual` text NOT NULL,
  `SWID` int(11) NOT NULL,
  PRIMARY KEY (`SummaryID`),
  UNIQUE KEY `SummaryID` (`SummaryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `summary`
--

INSERT INTO `summary` (`SummaryID`, `TestName`, `Actual`, `SWID`) VALUES
(0, 'BB1', 'PASS', 0),
(1, 'BB2', 'FAIL', 0),
(2, 'BB3', 'FAIL', 0),
(4, 'BB1', 'PASS', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
