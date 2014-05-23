-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2013 at 03:21 PM
-- Server version: 5.0.96
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maxwe`
--

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE IF NOT EXISTS `drinks` (
  `drink_id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`drink_id`),
  UNIQUE KEY `name` (`name`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `drinks_ingredients`
--

CREATE TABLE IF NOT EXISTS `drinks_ingredients` (
  `drink_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `amount` varchar(30) NOT NULL,
  KEY `drink_id` (`drink_id`,`ingredient_id`),
  KEY `ingredient_id` (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `ingredient_id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY  (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------



--
-- Constraints for dumped tables
--

--
-- Constraints for table `drinks`
--
ALTER TABLE `drinks`
  ADD CONSTRAINT `drinks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION;

--
-- Constraints for table `drinks_ingredients`
--
ALTER TABLE `drinks_ingredients`
  ADD CONSTRAINT `drinks_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `drinks_ingredients_ibfk_1` FOREIGN KEY (`drink_id`) REFERENCES `drinks` (`drink_id`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
