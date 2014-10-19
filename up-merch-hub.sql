-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2014 at 11:45 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `up-merch-hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `acc_id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acc_type` varchar(4) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `username`, `password`, `acc_type`) VALUES
(1, 'jemhunter', '97be0a2774793b2a95ba9b1aa9d505a533e07d01', 'user'),
(2, 'upcsi', 'b6a69a216afca8d5a9e628991df50fb24831f992', 'org'),
(3, 'acm', '856c5388bec324b86d5fb9acf0cc386418284ea1', 'org'),
(4, 'user01', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) NOT NULL,
  `acc_id` tinyint(3) unsigned NOT NULL,
  `item_price` int(10) unsigned NOT NULL,
  `item_description` text NOT NULL,
  `item_expiration` date NOT NULL,
  `item_categories` text NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `acc_id`, `item_price`, `item_description`, `item_expiration`, `item_categories`) VALUES
(1, 'Sample Item.', 2, 299, 'Just a sample item.', '2014-11-05', 'category1, category2, category3'),
(2, 'Another Sample Item.', 3, 500, '', '0000-00-00', ''),
(3, 'Yet Another Sample Item.', 3, 1299, '', '2000-01-01', ''),
(4, 'Item Name!', 2, 123123, '', '0000-00-00', ''),
(5, 'item!', 2, 0, '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `acc_id` tinyint(3) unsigned NOT NULL,
  `item_id` tinyint(3) unsigned NOT NULL,
  `order_date` date NOT NULL,
  `order_quantity` tinyint(3) unsigned NOT NULL,
  `order_specs` text NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `acc_id`, `item_id`, `order_date`, `order_quantity`, `order_specs`) VALUES
(1, 1, 1, '2014-10-19', 6, 'size po is large :3'),
(2, 1, 1, '2014-10-19', 3, '2nd order'),
(3, 1, 2, '2014-10-19', 32, '122'),
(4, 1, 3, '2014-10-19', 25, 'small');

-- --------------------------------------------------------

--
-- Table structure for table `orgs`
--

CREATE TABLE IF NOT EXISTS `orgs` (
  `acc_id` tinyint(3) unsigned NOT NULL,
  `org_name` varchar(100) NOT NULL,
  `number` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`acc_id`, `org_name`, `number`, `email`) VALUES
(2, 'UP CSI', '091111111', 'upcsi@gmail.com'),
(3, 'ACM', '099999999', 'acm@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `acc_id` tinyint(3) unsigned NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `number` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`acc_id`, `first_name`, `last_name`, `number`, `email`) VALUES
(1, 'Jerome', 'Indefenzo', '091111111', 'jeromeindefenzo@gmail.com'),
(4, 'User', '01', '090000000', 'user01@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
