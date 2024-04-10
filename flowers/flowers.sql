-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 26, 2011 at 03:47 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flowers`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_name` varchar(255) collate latin1_general_ci NOT NULL,
  `password` varchar(32) collate latin1_general_ci NOT NULL,
  `email` varchar(255) collate latin1_general_ci NOT NULL,
  `phone` varchar(125) collate latin1_general_ci NOT NULL,
  `address` varchar(255) collate latin1_general_ci NOT NULL,
  `birthday` int(11) unsigned NOT NULL,
  `last_ip` varchar(32) collate latin1_general_ci NOT NULL,
  `activation` varchar(32) collate latin1_general_ci NOT NULL default '-1',
  `approve` int(5) NOT NULL default '-1',
  `balance` int(11) NOT NULL,
  `oncity` int(11) default NULL,
  `group_id` int(5) NOT NULL,
  `creation_date` int(11) NOT NULL,
  `session_life` varchar(125) collate latin1_general_ci NOT NULL,
  `action_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `approve` (`approve`,`balance`,`group_id`),
  KEY `oncity` (`oncity`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` VALUES(1, 'Hany', '202cb962ac59075b964b07152d234b70', 'hany@codexc.com', '', '', 0, '127.0.0.1', '1', 1, 0, NULL, 5, 0, 'ea21709685a885606e5acc86d8221b37', 1296042994);
INSERT INTO `accounts` VALUES(11, 'Hany', '202cb962ac59075b964b07152d234b70', 'hany_alsamman@yahoo.com', '992520310', 'new zahera', 0, '', '5e8575902ad4f47d216545f12910c744', -1, 0, NULL, 1, 1289161020, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `additional_pages`
--

CREATE TABLE `additional_pages` (
  `id` int(11) NOT NULL auto_increment,
  `a_name` varchar(225) NOT NULL default '',
  `a_title` varchar(225) NOT NULL default '',
  `a_content` mediumtext NOT NULL,
  `a_visit` int(11) NOT NULL default '0',
  `in_class` int(11) NOT NULL default '0',
  `last_update` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `in_class` (`in_class`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `additional_pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `ar_products`
--

CREATE TABLE `ar_products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `prodcut_name` varchar(255) NOT NULL,
  `prodcut_details` mediumtext NOT NULL,
  `prodcut_picture` varchar(255) NOT NULL,
  `prodcut_price` int(11) NOT NULL,
  `extra` int(1) NOT NULL default '0',
  `in_dept` int(11) unsigned NOT NULL,
  `available` int(1) NOT NULL default '1',
  `added_by` int(11) unsigned NOT NULL,
  `last_update` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `added_by` (`added_by`,`hits`),
  KEY `available` (`available`),
  KEY `in_dept` (`in_dept`),
  KEY `extra` (`extra`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ar_products`
--


-- --------------------------------------------------------

--
-- Table structure for table `charge_logs`
--

CREATE TABLE `charge_logs` (
  `id` int(11) NOT NULL auto_increment,
  `charged_id` int(11) unsigned NOT NULL,
  `charger_id` int(11) unsigned NOT NULL,
  `charge_amount` int(11) NOT NULL,
  `charge_date` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `charge_logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL auto_increment,
  `city` varchar(90) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` VALUES(1, 'Damascus');
INSERT INTO `cities` VALUES(2, 'Damas side');
INSERT INTO `cities` VALUES(3, 'Kenitra');
INSERT INTO `cities` VALUES(4, 'Dara');
INSERT INTO `cities` VALUES(5, 'Homs');
INSERT INTO `cities` VALUES(6, 'Tartous');
INSERT INTO `cities` VALUES(7, 'Lattakia');
INSERT INTO `cities` VALUES(8, 'Hama');
INSERT INTO `cities` VALUES(9, 'Aleppo');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL auto_increment,
  `en_d_name` varchar(225) NOT NULL,
  `ar_d_name` varchar(255) NOT NULL default 'none',
  `d_type` varchar(225) NOT NULL default 'cat',
  `d_parent` varchar(90) NOT NULL default '0',
  `d_active` int(5) NOT NULL,
  `en_content_sub` mediumtext NOT NULL,
  `ar_content_sub` mediumtext NOT NULL,
  `last_update` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `d_parent` (`d_parent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` VALUES(1, 'ÇáÊÕäíÝÇÊ', 'Categories', 'cat', '0', 1, '', '', '2010-10-04 23:30:50');
INSERT INTO `departments` VALUES(2, 'Birthday', 'ÚíÏ ãíáÇÏ', 'cat', '1', 1, '', '', '2010-10-04 23:37:39');
INSERT INTO `departments` VALUES(3, 'Love', 'ÍÈ', 'cat', '1', 1, '', '', '2010-10-04 23:41:03');
INSERT INTO `departments` VALUES(4, 'Gifts', 'åÏíÉ', 'cat', '1', 1, '', '', '2010-10-04 23:41:58');
INSERT INTO `departments` VALUES(5, 'Wedding', 'ÃÚÑÇÓ', 'cat', '1', 1, '', '', '2010-10-04 23:45:04');

-- --------------------------------------------------------

--
-- Table structure for table `en_products`
--

CREATE TABLE `en_products` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `prodcut_name` varchar(255) NOT NULL,
  `prodcut_details` mediumtext NOT NULL,
  `prodcut_picture` varchar(255) NOT NULL,
  `prodcut_price` int(11) NOT NULL,
  `extra` int(1) NOT NULL default '0',
  `in_dept` int(11) unsigned NOT NULL,
  `available` int(1) NOT NULL default '1',
  `added_by` int(11) unsigned NOT NULL,
  `last_update` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `added_by` (`added_by`,`hits`),
  KEY `available` (`available`),
  KEY `in_dept` (`in_dept`),
  KEY `addtional` (`extra`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `en_products`
--


-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `senderto_address` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `senderto_phone` varchar(50) character set latin1 collate latin1_bin NOT NULL,
  `sender_id` int(11) unsigned NOT NULL,
  `sender_oncard` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `about_order` varchar(255) character set latin1 collate latin1_bin NOT NULL,
  `delivery_date` int(11) NOT NULL,
  `product_id` varchar(255) default NULL,
  `reminder_id` int(11) NOT NULL default '-1',
  `price` int(11) unsigned NOT NULL default '0',
  `order_status` enum('pinding','unpaid','paid','process','delivered') character set latin1 collate latin1_bin NOT NULL,
  `order_date` int(11) NOT NULL,
  `processed_by` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `order_status` (`order_status`),
  KEY `processed_by` (`processed_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` VALUES(1, '', '', 1, '', '', 1289599200, '4,16', -1, 2500, 'pinding', 1289598336, 0);
INSERT INTO `orders` VALUES(11, '', '', 1, '', '', 1289944800, '2', -1, 3244, 'pinding', 1289879121, 0);
INSERT INTO `orders` VALUES(10, '', '', 1, '', '', 1289858400, '1', -1, 41244, 'pinding', 1289778495, 0);
INSERT INTO `orders` VALUES(12, '', '', 1, '', '', 1296079200, '7', -1, 234234, 'pinding', 1296048981, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` int(11) NOT NULL,
  `gatway` enum('mail','sms') NOT NULL,
  `send_on` int(11) NOT NULL,
  `sent_date` int(11) NOT NULL,
  `sent` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `order_id` (`order_id`,`sent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `reminders`
--

