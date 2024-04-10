-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 10, 2012 at 01:25 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `storage`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `customers`
-- 

CREATE TABLE `customers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `phone` varchar(50) default NULL,
  `mobile` varchar(50) default NULL,
  `note` varchar(255) default NULL,
  `act` int(11) default '1',
  `company` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=124 ;

-- 
-- Dumping data for table `customers`
-- 

INSERT INTO `customers` VALUES (39, 'Wu', '416388-5779', '', '', 1, 'Canada Feung Tai');
INSERT INTO `customers` VALUES (38, 'David', '416616-8388', '', '', 1, 'Bo de Dueyen');
INSERT INTO `customers` VALUES (37, 'Ricky', '647388-8271', '905699-5108', '', 1, 'Bestwin Supermarket');
INSERT INTO `customers` VALUES (36, 'Chon', '647898-8993', '', 'p/u', 1, 'Bestco Food Mart');
INSERT INTO `customers` VALUES (35, 'Awa', '416688-0983', '416688-9938', '', 1, 'B Trust Supermarket');
INSERT INTO `customers` VALUES (34, 'Peter', '416670-6888', '', '', 1, 'Blue sky Supermarket');
INSERT INTO `customers` VALUES (33, 'Suki', '416450-6630', '', '', 1, 'Asian Food Center');
INSERT INTO `customers` VALUES (32, 'Zikar', '416834-3786', '', '', 0, 'AM Produce');
INSERT INTO `customers` VALUES (30, '', '647975-4598', '', '', 1, 'Fresh king');
INSERT INTO `customers` VALUES (31, 'Antee Aneta', '647933-6092', '647230-3718', '', 1, 'Antee Aneta');
INSERT INTO `customers` VALUES (40, 'Jean Paul', '1877431-6554', '1514532-6554', '', 1, 'CDS');
INSERT INTO `customers` VALUES (41, 'Ivan', '416939-9950', '416417-2169', 'p/u fri', 1, 'Coco tea');
INSERT INTO `customers` VALUES (42, 'Tomas', '416875-3186', '', '', 0, 'Danforth tomas');
INSERT INTO `customers` VALUES (43, 'Fong', '416740-9870', '416456-2818', '', 0, 'Danforth');
INSERT INTO `customers` VALUES (44, 'Eraa', '416897-8067', '', '', 1, 'Eraa');
INSERT INTO `customers` VALUES (45, 'Robert', '1613260-1155*221', '', '', 1, 'Farm Boy Inc.');
INSERT INTO `customers` VALUES (46, 'Fred', '416820-8726', '', '', 0, 'Afgan juice');
INSERT INTO `customers` VALUES (47, 'Vicent', '416662-1888', '416388-5779', '', 0, 'Foody Mart');
INSERT INTO `customers` VALUES (48, 'Jing', '647234-8836', '647-213-1888', '', 1, 'First Choice Supermarket');
INSERT INTO `customers` VALUES (49, 'Agree', '416918-9619', '', '', 1, 'Fresh Value');
INSERT INTO `customers` VALUES (50, 'Fu Yao', '416318-5882', '647835-5677', '', 1, 'Fu Yao Supermarket');
INSERT INTO `customers` VALUES (51, 'Eugene', '416259-6391', '', '', 1, 'Gambles Ontario Produce');
INSERT INTO `customers` VALUES (52, 'Soi', '647861-7586', '', '', 1, 'Green Ice Tea');
INSERT INTO `customers` VALUES (53, 'Yong', '416 811-7959', '', '', 1, 'Grants Foodmart');
INSERT INTO `customers` VALUES (54, 'Michel', '416 242-8838', '647 618-6168', '', 1, 'Greenland Farm');
INSERT INTO `customers` VALUES (55, 'Gurjeet', '647 887- 4421', '', 'no answer.', 0, 'Gurjeet');
INSERT INTO `customers` VALUES (56, 'Gurmit', '416 989-9308', '647 406-4748', 'no answer.', 0, 'Gurmit');
INSERT INTO `customers` VALUES (57, 'Haji', '416 834-2087', '', '', 1, 'Haji');
INSERT INTO `customers` VALUES (58, 'Hat', '416 286-0768', '', '', 1, 'Hat');
INSERT INTO `customers` VALUES (59, 'Loui', '416 332-1290', '647 992-1290', '', 1, 'Hat s Nephew');
INSERT INTO `customers` VALUES (60, 'Lina', '416 291-9188', '', '', 1, 'Hawaii Produce');
INSERT INTO `customers` VALUES (61, 'Joe', '647 238-2485', '', '', 1, 'Joe (coconuts)');
INSERT INTO `customers` VALUES (62, 'Justin', '416 885-4686', '', '', 1, 'Justin');
INSERT INTO `customers` VALUES (63, 'King', '647 887-8006', '', 'p/u Fri', 1, 'Jian Hing Supermarket');
INSERT INTO `customers` VALUES (64, 'Don', '416 278-1968 ', '', '', 1, 'Kazcanna');
INSERT INTO `customers` VALUES (65, 'Quality  meat', '416 302-1661', '', '', 0, 'Quality  meat');
INSERT INTO `customers` VALUES (66, 'Kevin', '416 893-6734', '416 977-7878', '', 0, 'Kevin');
INSERT INTO `customers` VALUES (67, 'Son', '416 896-8036', '', 'ordered already sam', 1, 'Lone Tai Supermarket');
INSERT INTO `customers` VALUES (68, 'Norm', '416 251-6887', '', '', 1, 'Lee Chum Procude Ltd.');
INSERT INTO `customers` VALUES (69, 'Ling', '905 305-0288', '', '', 1, 'L&M Quality Produce');
INSERT INTO `customers` VALUES (70, 'Azub', '416 837-5296', '', '', 1, 'Memon Produce');
INSERT INTO `customers` VALUES (71, 'Rex', '416 412-6188', '416 721-3082', '', 1, 'Manley Sales');
INSERT INTO `customers` VALUES (72, 'M&D', '416 331-8333', '', '', 0, 'M&D');
INSERT INTO `customers` VALUES (73, 'Mac', '647 710-5053', '', '', 0, 'Mango');
INSERT INTO `customers` VALUES (74, 'Michael', '416 838-1363', '', '', 1, 'Michael');
INSERT INTO `customers` VALUES (75, 'James', '416 270-9552', '', '', 1, 'Mr.Johns Food');
INSERT INTO `customers` VALUES (76, 'Pauline', '1514856-2828', '', '', 1, 'M&S Produce Inc. Montreal');
INSERT INTO `customers` VALUES (77, 'Jeny', '416 759-6668', '', '', 1, 'M&S Toronto');
INSERT INTO `customers` VALUES (78, 'Edy or Joe', '416 259-5481 ext 267', '', '', 1, 'Meschino Banana Co.');
INSERT INTO `customers` VALUES (79, 'Jhony', '416 593-0297', '416 358-5693', '', 1, 'Natural bubble tea');
INSERT INTO `customers` VALUES (80, 'Najer', '416 754-7830', '', '', 1, 'Najer');
INSERT INTO `customers` VALUES (81, 'Jefrey', '416 824-3507', '', '', 1, 'New Asia Supermarket');
INSERT INTO `customers` VALUES (82, 'Jack/Kerry', '416 561-7680', '905 270-2009 *21', '', 1, 'Oriental Food Center');
INSERT INTO `customers` VALUES (83, 'Provincial Fruit Inc', '905 856-9064', '', '', 1, 'Provincial Fruit Inc.');
INSERT INTO `customers` VALUES (84, 'Quader', '416 856-6186', '', 'p/u fri', 1, 'Quader');
INSERT INTO `customers` VALUES (85, 'Donald', '416 569-1977', '416 298-1224', '', 1, 'Sam s International');
INSERT INTO `customers` VALUES (86, 'Francin', '1514 858-6363 ext 239', '', '', 1, 'Sami Fruit Inc.');
INSERT INTO `customers` VALUES (87, 'Mark', '416 275-4618', '416 674-1850', '', 1, 'Sanjay Enterprise');
INSERT INTO `customers` VALUES (88, 'Humar/Jula', '416 909-5668', '', '', 1, 'SNNA');
INSERT INTO `customers` VALUES (89, 'Rosik', '647 406-4748', '', NULL, 1, 'Subzi Mandi');
INSERT INTO `customers` VALUES (90, 'Wei', '416 627-7886', '', '', 1, 'Sunny Foodmart');
INSERT INTO `customers` VALUES (91, 'Kugan/Soon', '416 568-2363', '647 857-3881', '', 1, 'SP Importers');
INSERT INTO `customers` VALUES (92, 'Sam', '416 897-8582', '', '', 1, 'Taza Market');
INSERT INTO `customers` VALUES (93, 'Andy', '416 752-2907', '416 727-8891', 'Ray p/u friday', 1, 'Tamisha');
INSERT INTO `customers` VALUES (94, 'season', '416 902-6283', '', '', 1, 'Season Food Mart');
INSERT INTO `customers` VALUES (95, 'Wayen', '647 532-2268', '', '', 1, 'Smart Choice');
INSERT INTO `customers` VALUES (96, 'lin', '416 503-2100', '', '', 1, 'Sunnyview Int l Trading');
INSERT INTO `customers` VALUES (97, 'Norris', '416-726-9463', '', '', 1, 'Tropical Harvest');
INSERT INTO `customers` VALUES (98, 'allen', '416 821-2103', '', '', 0, 'Tropic Trading');
INSERT INTO `customers` VALUES (99, 'Chan', '416 752-3666', '416 837-7918', '', 1, 'Top Food Mkt');
INSERT INTO `customers` VALUES (100, 'Susan', '905 903-0786', '416 850-4073', 'p/u', 1, 'Trymore');
INSERT INTO `customers` VALUES (101, 'Tyler', '416 638-6977', '416 697-6977', '', 1, 'Tyler');
INSERT INTO `customers` VALUES (102, 'Doriee', '416 259-4686', '', '', 1, 'Veg Pak Produce');
INSERT INTO `customers` VALUES (103, 'Wai Keong', '416 834-8292', '', 'ordered already,Ray p/u friday', 1, 'Wai Keong');
INSERT INTO `customers` VALUES (104, 'Huiai', '416 670-6696', '', '', 1, 'Welcome Foodmart');
INSERT INTO `customers` VALUES (105, 'jack', '416 747-5900', '647 883-2448', '', 1, 'Win farm');
INSERT INTO `customers` VALUES (106, 'Said', '416 688-0135', '', '', 1, 'Said');
INSERT INTO `customers` VALUES (107, 'Wally', '647 295-0777', '', NULL, 1, 'Wally');
INSERT INTO `customers` VALUES (108, 'Siva', '416 300-2416', '', '', 1, 'Yal Market');
INSERT INTO `customers` VALUES (109, 'jemmie', '647893-3677', '', 'p/u', 1, 'Yuan Ming Supermarket');
INSERT INTO `customers` VALUES (110, 'walter or david', '905 940-3888', '', '', 1, 'Yung Soon Farm');
INSERT INTO `customers` VALUES (111, 'reymond', '416 999-2809', '905 216-0216', '', 1, 'Yummie');
INSERT INTO `customers` VALUES (112, 'Matthew Catania', '416 236-9394', '905 599-8239', '', 1, 'Catania');
INSERT INTO `customers` VALUES (113, 'Daud', '(416)826-7114', '(416)826-7114', '', 1, 'Daud');
INSERT INTO `customers` VALUES (120, 'Bhavesh', '647-228-1767', '', '', 1, 'Bhavesh');
INSERT INTO `customers` VALUES (114, 'Starwind', '', '', '', 1, 'Starwind');
INSERT INTO `customers` VALUES (123, 'Eid Mohamed', '647 886-3156', '', NULL, 1, 'Eid Mohamed');
INSERT INTO `customers` VALUES (121, 'cash sale', '', '', NULL, 1, 'cash sale');
INSERT INTO `customers` VALUES (119, 'Khan', '416-565-6478', '', '', 1, 'Khan');
INSERT INTO `customers` VALUES (115, 'Skyland', '', '', '', 1, 'Skyland');
INSERT INTO `customers` VALUES (118, 'zham', '905 598 3525', '', '', 1, 'zham');
INSERT INTO `customers` VALUES (116, 'Fazal', '416-302-1661 ', '', '', 1, 'quality meat ');
INSERT INTO `customers` VALUES (117, 'Frank', '', '', '', 1, 'Franzco');
INSERT INTO `customers` VALUES (122, '416 845-2335', '', '', 'ordered already,Ray', 1, 'Manjit');

-- --------------------------------------------------------

-- 
-- Table structure for table `dmg_opr`
-- 

CREATE TABLE `dmg_opr` (
  `id` int(11) NOT NULL auto_increment,
  `ord_id` int(11) default NULL,
  `it_id` int(11) default NULL,
  `qunt` int(11) default NULL,
  `user_id` int(11) default NULL,
  `date` int(80) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `dmg_opr`
-- 

INSERT INTO `dmg_opr` VALUES (1, 13, 46, 9, 5, 1343757012);
INSERT INTO `dmg_opr` VALUES (2, 21, 80, 1, 7, 1344009779);
INSERT INTO `dmg_opr` VALUES (3, 13, 46, 3, 5, 1344260012);
INSERT INTO `dmg_opr` VALUES (4, 10, 38, 11, 5, 1344260683);
INSERT INTO `dmg_opr` VALUES (5, 10, 38, 1, 5, 1344260818);
INSERT INTO `dmg_opr` VALUES (6, 11, 64, 3, 5, 1344260940);
INSERT INTO `dmg_opr` VALUES (7, 11, 62, 30, 5, 1344342641);
INSERT INTO `dmg_opr` VALUES (8, 5, 42, 10, 5, 1344364336);
INSERT INTO `dmg_opr` VALUES (9, 16, 60, 12, 5, 1344364349);
INSERT INTO `dmg_opr` VALUES (10, 5, 42, 10, 5, 1344368995);
INSERT INTO `dmg_opr` VALUES (11, 28, 57, 384, 5, 1344441320);
INSERT INTO `dmg_opr` VALUES (12, 6, 38, 69, 5, 1344543852);
INSERT INTO `dmg_opr` VALUES (13, 16, 60, 7, 5, 1344601971);

-- --------------------------------------------------------

-- 
-- Table structure for table `invices`
-- 

CREATE TABLE `invices` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `c_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fin` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=194 ;

-- 
-- Dumping data for table `invices`
-- 

INSERT INTO `invices` VALUES (2, '2012-07-30 08:53:04', 38, 8, 1);
INSERT INTO `invices` VALUES (3, '2012-07-30 08:54:52', 101, 8, 1);
INSERT INTO `invices` VALUES (4, '2012-07-30 08:56:50', 58, 8, 1);
INSERT INTO `invices` VALUES (5, '2012-07-30 09:03:46', 33, 8, 1);
INSERT INTO `invices` VALUES (102, '2012-08-03 15:27:07', 63, 7, 1);
INSERT INTO `invices` VALUES (7, '2012-07-30 09:07:21', 74, 7, 1);
INSERT INTO `invices` VALUES (8, '2012-07-30 09:09:11', 59, 7, 1);
INSERT INTO `invices` VALUES (9, '2012-07-30 09:25:19', 54, 7, 1);
INSERT INTO `invices` VALUES (10, '2012-07-30 09:28:48', 91, 8, 1);
INSERT INTO `invices` VALUES (11, '2012-07-30 09:33:43', 49, 7, 1);
INSERT INTO `invices` VALUES (13, '2012-07-30 09:38:53', 116, 7, 1);
INSERT INTO `invices` VALUES (14, '2012-07-30 09:44:30', 91, 8, 1);
INSERT INTO `invices` VALUES (15, '2012-07-30 09:46:14', 79, 5, 1);
INSERT INTO `invices` VALUES (16, '2012-07-30 09:47:53', 94, 7, 1);
INSERT INTO `invices` VALUES (17, '2012-07-30 09:49:32', 30, 5, 1);
INSERT INTO `invices` VALUES (18, '2012-07-30 09:50:48', 114, 7, 1);
INSERT INTO `invices` VALUES (19, '2012-07-30 10:30:25', 31, 8, 1);
INSERT INTO `invices` VALUES (20, '2012-07-30 10:36:35', 51, 5, 1);
INSERT INTO `invices` VALUES (21, '2012-07-30 10:44:23', 82, 5, 1);
INSERT INTO `invices` VALUES (22, '2012-07-30 10:47:12', 78, 5, 1);
INSERT INTO `invices` VALUES (23, '2012-07-30 10:47:22', 35, 8, 1);
INSERT INTO `invices` VALUES (24, '2012-07-30 10:50:32', 50, 5, 1);
INSERT INTO `invices` VALUES (25, '2012-07-30 10:58:18', 71, 5, 1);
INSERT INTO `invices` VALUES (26, '2012-07-30 10:59:05', 90, 5, 1);
INSERT INTO `invices` VALUES (27, '2012-07-30 11:10:41', 60, 7, 1);
INSERT INTO `invices` VALUES (28, '2012-07-30 11:15:30', 90, 5, 1);
INSERT INTO `invices` VALUES (29, '2012-07-30 11:16:17', 115, 7, 1);
INSERT INTO `invices` VALUES (30, '2012-07-30 11:28:44', 76, 5, 1);
INSERT INTO `invices` VALUES (31, '2012-07-30 11:30:25', 81, 5, 1);
INSERT INTO `invices` VALUES (32, '2012-07-30 11:35:06', 84, 5, 1);
INSERT INTO `invices` VALUES (33, '2012-07-30 11:36:34', 87, 5, 1);
INSERT INTO `invices` VALUES (34, '2012-07-30 11:39:41', 69, 5, 1);
INSERT INTO `invices` VALUES (35, '2012-07-30 11:40:44', 77, 5, 1);
INSERT INTO `invices` VALUES (36, '2012-07-30 11:42:43', 96, 5, 1);
INSERT INTO `invices` VALUES (37, '2012-07-30 11:47:47', 95, 7, 1);
INSERT INTO `invices` VALUES (38, '2012-07-30 11:57:42', 103, 7, 1);
INSERT INTO `invices` VALUES (39, '2012-07-30 11:59:54', 44, 5, 1);
INSERT INTO `invices` VALUES (40, '2012-07-30 12:01:10', 106, 8, 1);
INSERT INTO `invices` VALUES (41, '2012-07-30 12:05:53', 53, 5, 1);
INSERT INTO `invices` VALUES (42, '2012-07-30 12:06:44', 57, 8, 1);
INSERT INTO `invices` VALUES (43, '2012-07-30 12:06:50', 36, 7, 1);
INSERT INTO `invices` VALUES (44, '2012-07-30 12:12:49', 63, 5, 1);
INSERT INTO `invices` VALUES (45, '2012-07-30 12:13:58', 48, 7, 1);
INSERT INTO `invices` VALUES (46, '2012-07-30 12:16:30', 100, 5, 1);
INSERT INTO `invices` VALUES (47, '2012-07-30 12:20:28', 34, 5, 1);
INSERT INTO `invices` VALUES (48, '2012-07-30 12:27:04', 81, 5, 1);
INSERT INTO `invices` VALUES (49, '2012-07-30 12:40:21', 49, 7, 1);
INSERT INTO `invices` VALUES (50, '2012-07-30 12:47:09', 92, 5, 1);
INSERT INTO `invices` VALUES (51, '2012-07-30 12:51:33', 62, 5, 1);
INSERT INTO `invices` VALUES (53, '2012-07-30 12:56:11', 37, 7, 1);
INSERT INTO `invices` VALUES (54, '2012-07-30 12:57:36', 93, 5, 1);
INSERT INTO `invices` VALUES (55, '2012-07-30 13:07:46', 61, 8, 1);
INSERT INTO `invices` VALUES (56, '2012-07-30 13:22:12', 99, 7, 1);
INSERT INTO `invices` VALUES (57, '2012-07-30 13:23:11', 97, 8, 1);
INSERT INTO `invices` VALUES (58, '2012-07-30 13:48:22', 82, 5, 1);
INSERT INTO `invices` VALUES (59, '2012-07-30 13:52:31', 52, 7, 1);
INSERT INTO `invices` VALUES (60, '2012-07-30 13:57:57', 82, 5, 1);
INSERT INTO `invices` VALUES (61, '2012-07-30 14:12:24', 71, 5, 1);
INSERT INTO `invices` VALUES (62, '2012-07-30 14:36:13', 41, 5, 1);
INSERT INTO `invices` VALUES (64, '2012-07-31 08:21:01', 102, 5, 1);
INSERT INTO `invices` VALUES (65, '2012-07-31 08:45:24', 105, 7, 1);
INSERT INTO `invices` VALUES (66, '2012-07-31 08:51:04', 117, 8, 1);
INSERT INTO `invices` VALUES (67, '2012-07-31 11:11:32', 115, 7, 1);
INSERT INTO `invices` VALUES (68, '2012-07-31 12:09:07', 109, 7, 1);
INSERT INTO `invices` VALUES (69, '2012-07-31 12:12:00', 64, 7, 1);
INSERT INTO `invices` VALUES (70, '2012-07-31 12:34:02', 88, 5, 1);
INSERT INTO `invices` VALUES (71, '2012-07-31 12:52:56', 113, 5, 1);
INSERT INTO `invices` VALUES (72, '2012-07-31 12:58:00', 78, 5, 1);
INSERT INTO `invices` VALUES (73, '2012-07-31 13:32:59', 76, 7, 1);
INSERT INTO `invices` VALUES (74, '2012-07-31 13:34:46', 39, 8, 1);
INSERT INTO `invices` VALUES (75, '2012-08-01 09:47:13', 60, 7, 1);
INSERT INTO `invices` VALUES (76, '2012-08-01 10:32:03', 44, 7, 1);
INSERT INTO `invices` VALUES (95, '2012-08-02 14:17:04', 37, 7, 1);
INSERT INTO `invices` VALUES (78, '2012-08-01 10:41:37', 113, 5, 1);
INSERT INTO `invices` VALUES (79, '2012-08-01 11:08:51', 91, 8, 1);
INSERT INTO `invices` VALUES (80, '2012-08-01 11:44:43', 76, 7, 1);
INSERT INTO `invices` VALUES (81, '2012-08-01 12:13:25', 113, 5, 1);
INSERT INTO `invices` VALUES (82, '2012-08-01 12:21:59', 85, 7, 1);
INSERT INTO `invices` VALUES (89, '2012-08-01 15:58:08', 86, 8, 1);
INSERT INTO `invices` VALUES (91, '2012-08-02 09:43:28', 59, 7, 1);
INSERT INTO `invices` VALUES (88, '2012-08-01 15:25:43', 108, 7, 1);
INSERT INTO `invices` VALUES (92, '2012-08-02 11:15:22', 101, 8, 1);
INSERT INTO `invices` VALUES (93, '2012-08-02 12:13:41', 119, 7, 1);
INSERT INTO `invices` VALUES (94, '2012-08-02 12:29:19', 38, 7, 1);
INSERT INTO `invices` VALUES (96, '2012-08-02 15:32:02', 116, 5, 1);
INSERT INTO `invices` VALUES (97, '2012-08-02 15:56:37', 59, 5, 1);
INSERT INTO `invices` VALUES (98, '2012-08-03 11:52:40', 113, 7, 1);
INSERT INTO `invices` VALUES (166, '2012-08-08 08:11:22', 117, 5, 1);
INSERT INTO `invices` VALUES (100, '2012-08-03 14:53:21', 119, 7, 1);
INSERT INTO `invices` VALUES (137, '2012-08-07 10:20:39', 76, 5, 1);
INSERT INTO `invices` VALUES (104, '2012-08-03 16:57:09', 113, 5, 1);
INSERT INTO `invices` VALUES (105, '2012-08-03 16:59:28', 121, 7, 1);
INSERT INTO `invices` VALUES (106, '2012-08-05 11:49:11', 113, 5, 1);
INSERT INTO `invices` VALUES (107, '2012-08-05 12:00:44', 91, 5, 1);
INSERT INTO `invices` VALUES (108, '2012-08-06 08:14:21', 113, 5, 1);
INSERT INTO `invices` VALUES (109, '2012-08-06 09:17:48', 82, 5, 1);
INSERT INTO `invices` VALUES (110, '2012-08-06 09:58:02', 60, 8, 1);
INSERT INTO `invices` VALUES (111, '2012-08-06 10:00:32', 101, 8, 1);
INSERT INTO `invices` VALUES (112, '2012-08-06 10:02:25', 59, 8, 0);
INSERT INTO `invices` VALUES (113, '2012-08-06 11:06:28', 95, 5, 1);
INSERT INTO `invices` VALUES (114, '2012-08-06 11:07:55', 48, 5, 1);
INSERT INTO `invices` VALUES (115, '2012-08-06 11:10:07', 57, 8, 0);
INSERT INTO `invices` VALUES (116, '2012-08-06 12:33:06', 113, 5, 1);
INSERT INTO `invices` VALUES (117, '2012-08-06 13:23:46', 79, 8, 1);
INSERT INTO `invices` VALUES (118, '2012-08-06 13:55:14', 87, 8, 1);
INSERT INTO `invices` VALUES (119, '2012-08-06 16:08:43', 86, 5, 1);
INSERT INTO `invices` VALUES (120, '2012-08-07 09:11:30', 78, 5, 1);
INSERT INTO `invices` VALUES (121, '2012-08-07 09:19:50', 106, 8, 1);
INSERT INTO `invices` VALUES (122, '2012-08-07 09:23:09', 54, 8, 0);
INSERT INTO `invices` VALUES (123, '2012-08-07 09:25:30', 33, 8, 1);
INSERT INTO `invices` VALUES (124, '2012-08-07 09:27:26', 58, 8, 1);
INSERT INTO `invices` VALUES (125, '2012-08-07 09:28:11', 35, 7, 1);
INSERT INTO `invices` VALUES (126, '2012-08-07 09:29:23', 96, 7, 1);
INSERT INTO `invices` VALUES (127, '2012-08-07 09:29:29', 74, 8, 1);
INSERT INTO `invices` VALUES (128, '2012-08-07 09:33:09', 36, 7, 0);
INSERT INTO `invices` VALUES (129, '2012-08-07 09:35:13', 111, 8, 1);
INSERT INTO `invices` VALUES (130, '2012-08-07 09:48:02', 94, 8, 0);
INSERT INTO `invices` VALUES (131, '2012-08-07 09:49:17', 49, 7, 1);
INSERT INTO `invices` VALUES (132, '2012-08-07 09:54:02', 114, 8, 0);
INSERT INTO `invices` VALUES (133, '2012-08-07 09:58:33', 41, 8, 0);
INSERT INTO `invices` VALUES (134, '2012-08-07 10:00:47', 34, 7, 1);
INSERT INTO `invices` VALUES (135, '2012-08-07 10:07:05', 95, 7, 1);
INSERT INTO `invices` VALUES (136, '2012-08-07 10:08:00', 82, 5, 1);
INSERT INTO `invices` VALUES (138, '2012-08-07 10:29:57', 51, 7, 1);
INSERT INTO `invices` VALUES (139, '2012-08-07 10:34:58', 103, 8, 0);
INSERT INTO `invices` VALUES (140, '2012-08-07 10:36:44', 102, 5, 1);
INSERT INTO `invices` VALUES (141, '2012-08-07 10:39:59', 84, 8, 0);
INSERT INTO `invices` VALUES (142, '2012-08-07 10:44:27', 110, 5, 1);
INSERT INTO `invices` VALUES (143, '2012-08-07 10:47:54', 69, 5, 1);
INSERT INTO `invices` VALUES (144, '2012-08-07 10:54:22', 48, 5, 1);
INSERT INTO `invices` VALUES (145, '2012-08-07 11:04:00', 122, 8, 1);
INSERT INTO `invices` VALUES (146, '2012-08-07 11:05:48', 71, 8, 1);
INSERT INTO `invices` VALUES (147, '2012-08-07 11:19:56', 77, 5, 1);
INSERT INTO `invices` VALUES (148, '2012-08-07 11:23:14', 99, 7, 1);
INSERT INTO `invices` VALUES (149, '2012-08-07 11:24:39', 92, 5, 1);
INSERT INTO `invices` VALUES (150, '2012-08-07 11:38:19', 81, 7, 0);
INSERT INTO `invices` VALUES (151, '2012-08-07 11:47:58', 44, 7, 1);
INSERT INTO `invices` VALUES (152, '2012-08-07 11:54:09', 30, 5, 0);
INSERT INTO `invices` VALUES (153, '2012-08-07 12:06:09', 63, 5, 0);
INSERT INTO `invices` VALUES (154, '2012-08-07 12:07:07', 115, 7, 1);
INSERT INTO `invices` VALUES (155, '2012-08-07 12:08:49', 31, 7, 1);
INSERT INTO `invices` VALUES (156, '2012-08-07 12:10:01', 87, 5, 1);
INSERT INTO `invices` VALUES (157, '2012-08-07 12:19:50', 61, 8, 0);
INSERT INTO `invices` VALUES (158, '2012-08-07 12:20:55', 75, 5, 1);
INSERT INTO `invices` VALUES (159, '2012-08-07 12:43:15', 109, 5, 0);
INSERT INTO `invices` VALUES (160, '2012-08-07 12:46:07', 50, 5, 0);
INSERT INTO `invices` VALUES (161, '2012-08-07 12:52:43', 76, 5, 1);
INSERT INTO `invices` VALUES (162, '2012-08-07 13:03:42', 53, 7, 1);
INSERT INTO `invices` VALUES (163, '2012-08-07 13:07:16', 49, 7, 1);
INSERT INTO `invices` VALUES (188, '2012-08-10 10:10:42', 113, 5, 1);
INSERT INTO `invices` VALUES (165, '2012-08-07 13:38:06', 67, 5, 0);
INSERT INTO `invices` VALUES (167, '2012-08-08 08:49:04', 95, 5, 0);
INSERT INTO `invices` VALUES (168, '2012-08-08 10:01:33', 113, 5, 1);
INSERT INTO `invices` VALUES (169, '2012-08-08 10:02:25', 96, 5, 1);
INSERT INTO `invices` VALUES (170, '2012-08-08 10:13:22', 113, 8, 1);
INSERT INTO `invices` VALUES (171, '2012-08-08 10:24:16', 113, 5, 1);
INSERT INTO `invices` VALUES (172, '2012-08-08 11:32:15', 110, 5, 1);
INSERT INTO `invices` VALUES (173, '2012-08-08 12:06:28', 82, 5, 1);
INSERT INTO `invices` VALUES (174, '2012-08-08 12:25:57', 100, 7, 0);
INSERT INTO `invices` VALUES (175, '2012-08-08 12:52:49', 39, 8, 1);
INSERT INTO `invices` VALUES (176, '2012-08-08 12:57:07', 60, 7, 0);
INSERT INTO `invices` VALUES (177, '2012-08-08 15:05:23', 91, 8, 0);
INSERT INTO `invices` VALUES (178, '2012-08-08 16:18:29', 93, 8, 0);
INSERT INTO `invices` VALUES (179, '2012-08-08 16:36:21', 37, 8, 1);
INSERT INTO `invices` VALUES (180, '2012-08-09 10:28:08', 101, 5, 0);
INSERT INTO `invices` VALUES (181, '2012-08-09 11:04:40', 64, 7, 1);
INSERT INTO `invices` VALUES (182, '2012-08-09 11:28:40', 113, 5, 1);
INSERT INTO `invices` VALUES (186, '2012-08-10 09:55:00', 116, 5, 0);
INSERT INTO `invices` VALUES (184, '2012-08-09 16:08:26', 87, 5, 0);
INSERT INTO `invices` VALUES (185, '2012-08-10 09:50:21', 113, 5, 1);
INSERT INTO `invices` VALUES (187, '2012-08-10 10:07:40', 112, 5, 1);
INSERT INTO `invices` VALUES (189, '2012-08-10 10:13:42', 30, 5, 0);
INSERT INTO `invices` VALUES (190, '2012-08-10 10:54:46', 101, 5, 0);
INSERT INTO `invices` VALUES (191, '2012-08-10 11:07:50', 85, 5, 0);
INSERT INTO `invices` VALUES (192, '2012-08-10 11:40:49', 49, 7, 0);
INSERT INTO `invices` VALUES (193, '2012-08-10 13:06:44', 123, 5, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `inv_opr`
-- 

CREATE TABLE `inv_opr` (
  `id` int(11) NOT NULL auto_increment,
  `inv_id` int(11) default NULL,
  `ord_id` int(11) default NULL,
  `it_id` int(11) default NULL,
  `qunt` int(11) default NULL,
  `price` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2650 ;

-- 
-- Dumping data for table `inv_opr`
-- 

INSERT INTO `inv_opr` VALUES (1300, 49, 11, 62, 60, 13.5);
INSERT INTO `inv_opr` VALUES (1189, 93, 10, 38, 1, 16);
INSERT INTO `inv_opr` VALUES (1156, 92, 8, 38, 20, 16);
INSERT INTO `inv_opr` VALUES (1155, 3, 6, 43, 13, 17);
INSERT INTO `inv_opr` VALUES (1154, 4, 8, 38, 10, 16);
INSERT INTO `inv_opr` VALUES (1153, 4, 3, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (1381, 5, 3, 35, 15, 15.5);
INSERT INTO `inv_opr` VALUES (1472, 102, 13, 46, 5, 10);
INSERT INTO `inv_opr` VALUES (1085, 7, 7, 43, 20, 17);
INSERT INTO `inv_opr` VALUES (1174, 91, 8, 38, 10, 15);
INSERT INTO `inv_opr` VALUES (1289, 8, 4, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (1356, 9, 6, 43, 2, 22);
INSERT INTO `inv_opr` VALUES (1355, 9, 16, 44, 10, 35);
INSERT INTO `inv_opr` VALUES (1354, 9, 7, 41, 5, 33);
INSERT INTO `inv_opr` VALUES (1353, 9, 14, 36, 6, 17.5);
INSERT INTO `inv_opr` VALUES (1352, 9, 2, 35, 6, 19.5);
INSERT INTO `inv_opr` VALUES (113, 10, 8, 38, 24, 16);
INSERT INTO `inv_opr` VALUES (112, 10, 2, 35, 20, 15.5);
INSERT INTO `inv_opr` VALUES (111, 10, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (1299, 49, 21, 75, 211, 5.5);
INSERT INTO `inv_opr` VALUES (1298, 49, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (1297, 49, 8, 38, 6, 16);
INSERT INTO `inv_opr` VALUES (1296, 49, 16, 44, 18, 31);
INSERT INTO `inv_opr` VALUES (1295, 49, 7, 41, 6, 29);
INSERT INTO `inv_opr` VALUES (232, 11, 5, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (231, 11, 8, 38, 24, 16);
INSERT INTO `inv_opr` VALUES (1188, 2, 10, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (787, 27, 3, 35, 24, 14);
INSERT INTO `inv_opr` VALUES (1286, 13, 7, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (1391, 79, 6, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (1390, 79, 2, 35, 48, 14.5);
INSERT INTO `inv_opr` VALUES (70, 15, 3, 43, 6, 17);
INSERT INTO `inv_opr` VALUES (1417, 16, 2, 35, 26, 14.5);
INSERT INTO `inv_opr` VALUES (1416, 16, 7, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (1415, 16, 8, 38, 30, 15);
INSERT INTO `inv_opr` VALUES (1422, 17, 3, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (1421, 17, 8, 38, 42, 15);
INSERT INTO `inv_opr` VALUES (1420, 17, 2, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (1461, 18, 13, 39, 6, 19);
INSERT INTO `inv_opr` VALUES (1460, 18, 1, 36, 12, 12.5);
INSERT INTO `inv_opr` VALUES (1459, 18, 7, 41, 6, 28);
INSERT INTO `inv_opr` VALUES (1458, 18, 16, 44, 12, 30);
INSERT INTO `inv_opr` VALUES (1457, 18, 2, 35, 30, 14.5);
INSERT INTO `inv_opr` VALUES (1456, 18, 8, 38, 24, 15);
INSERT INTO `inv_opr` VALUES (998, 14, 11, 62, 60, 14.5);
INSERT INTO `inv_opr` VALUES (926, 19, 10, 38, 18, 16);
INSERT INTO `inv_opr` VALUES (87, 20, 16, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (88, 20, 14, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (105, 21, 11, 63, 120, 13);
INSERT INTO `inv_opr` VALUES (104, 21, 20, 69, 30, 125);
INSERT INTO `inv_opr` VALUES (1489, 104, 21, 78, 147, 5);
INSERT INTO `inv_opr` VALUES (655, 22, 11, 64, 60, 13.5);
INSERT INTO `inv_opr` VALUES (654, 22, 11, 62, 60, 13);
INSERT INTO `inv_opr` VALUES (653, 22, 21, 75, 384, 6);
INSERT INTO `inv_opr` VALUES (652, 22, 21, 54, 384, 6);
INSERT INTO `inv_opr` VALUES (700, 23, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (699, 23, 7, 41, 12, 29);
INSERT INTO `inv_opr` VALUES (698, 23, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (697, 23, 3, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (696, 23, 2, 35, 24, 15.5);
INSERT INTO `inv_opr` VALUES (695, 23, 13, 39, 24, 20);
INSERT INTO `inv_opr` VALUES (1242, 24, 10, 38, 30, 15);
INSERT INTO `inv_opr` VALUES (1241, 24, 16, 35, 30, 15);
INSERT INTO `inv_opr` VALUES (109, 25, 20, 69, 10, 125);
INSERT INTO `inv_opr` VALUES (122, 26, 11, 62, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1388, 75, 9, 36, 48, 12);
INSERT INTO `inv_opr` VALUES (786, 27, 20, 69, 3, 125);
INSERT INTO `inv_opr` VALUES (785, 27, 19, 73, 1, 125);
INSERT INTO `inv_opr` VALUES (784, 27, 6, 44, 11, 30);
INSERT INTO `inv_opr` VALUES (783, 27, 8, 38, 6, 15);
INSERT INTO `inv_opr` VALUES (121, 26, 17, 71, 40, 9);
INSERT INTO `inv_opr` VALUES (1116, 28, 16, 44, 3, 31);
INSERT INTO `inv_opr` VALUES (782, 27, 16, 44, 15, 30);
INSERT INTO `inv_opr` VALUES (1372, 29, 11, 63, 60, 13);
INSERT INTO `inv_opr` VALUES (1371, 29, 7, 43, 18, 17);
INSERT INTO `inv_opr` VALUES (1370, 29, 8, 38, 108, 15);
INSERT INTO `inv_opr` VALUES (1369, 29, 7, 41, 12, 29);
INSERT INTO `inv_opr` VALUES (1368, 29, 2, 43, 7, 17);
INSERT INTO `inv_opr` VALUES (1367, 29, 16, 35, 30, 15.5);
INSERT INTO `inv_opr` VALUES (1366, 29, 13, 39, 18, 20);
INSERT INTO `inv_opr` VALUES (997, 14, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (1115, 28, 6, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (1114, 28, 3, 35, 21, 14.5);
INSERT INTO `inv_opr` VALUES (1113, 28, 16, 35, 39, 14.5);
INSERT INTO `inv_opr` VALUES (1112, 28, 8, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (1111, 28, 13, 39, 12, 20);
INSERT INTO `inv_opr` VALUES (1110, 28, 14, 36, 108, 12.5);
INSERT INTO `inv_opr` VALUES (1307, 80, 7, 41, 24, 28);
INSERT INTO `inv_opr` VALUES (1057, 73, 7, 37, 60, 34);
INSERT INTO `inv_opr` VALUES (1056, 73, 6, 43, 50, 17);
INSERT INTO `inv_opr` VALUES (584, 30, 11, 62, 22, 14.5);
INSERT INTO `inv_opr` VALUES (583, 30, 14, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (386, 48, 8, 38, 36, 16);
INSERT INTO `inv_opr` VALUES (385, 48, 14, 36, 15, 14.5);
INSERT INTO `inv_opr` VALUES (384, 48, 2, 35, 10, 15.5);
INSERT INTO `inv_opr` VALUES (383, 48, 7, 41, 9, 29);
INSERT INTO `inv_opr` VALUES (226, 31, 11, 63, 60, 13.5);
INSERT INTO `inv_opr` VALUES (1488, 32, 8, 38, 34, 15);
INSERT INTO `inv_opr` VALUES (1487, 32, 6, 43, 13, 17);
INSERT INTO `inv_opr` VALUES (1032, 33, 12, 42, 100, 15);
INSERT INTO `inv_opr` VALUES (1031, 33, 2, 35, 180, 14.5);
INSERT INTO `inv_opr` VALUES (1030, 33, 14, 36, 162, 12.5);
INSERT INTO `inv_opr` VALUES (1305, 34, 2, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (585, 35, 14, 36, 108, 12.5);
INSERT INTO `inv_opr` VALUES (176, 36, 14, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1497, 54, 5, 42, 50, 16);
INSERT INTO `inv_opr` VALUES (1429, 37, 8, 38, 3, 16);
INSERT INTO `inv_opr` VALUES (2394, 141, 6, 38, 14, 16);
INSERT INTO `inv_opr` VALUES (1430, 38, 7, 43, 52, 17);
INSERT INTO `inv_opr` VALUES (192, 39, 2, 35, 120, 14);
INSERT INTO `inv_opr` VALUES (1304, 42, 7, 43, 8, 17);
INSERT INTO `inv_opr` VALUES (194, 41, 8, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (195, 41, 14, 36, 108, 12.5);
INSERT INTO `inv_opr` VALUES (196, 41, 2, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (197, 41, 7, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (198, 41, 13, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (1303, 42, 7, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (1455, 43, 10, 38, 4, 16);
INSERT INTO `inv_opr` VALUES (1454, 43, 7, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (1453, 43, 9, 36, 6, 13.5);
INSERT INTO `inv_opr` VALUES (1452, 43, 7, 37, 6, 35);
INSERT INTO `inv_opr` VALUES (1451, 43, 7, 41, 6, 29);
INSERT INTO `inv_opr` VALUES (1450, 43, 12, 42, 50, 16);
INSERT INTO `inv_opr` VALUES (1449, 43, 16, 35, 24, 15.5);
INSERT INTO `inv_opr` VALUES (207, 44, 8, 38, 30, 16);
INSERT INTO `inv_opr` VALUES (208, 44, 14, 36, 16, 13.5);
INSERT INTO `inv_opr` VALUES (209, 44, 16, 44, 8, 31);
INSERT INTO `inv_opr` VALUES (210, 44, 7, 41, 4, 29);
INSERT INTO `inv_opr` VALUES (211, 44, 2, 35, 18, 15.5);
INSERT INTO `inv_opr` VALUES (212, 44, 13, 39, 20, 20);
INSERT INTO `inv_opr` VALUES (1196, 45, 13, 39, 6, 20);
INSERT INTO `inv_opr` VALUES (216, 46, 2, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (217, 47, 13, 39, 6, 20);
INSERT INTO `inv_opr` VALUES (218, 47, 2, 35, 60, 14);
INSERT INTO `inv_opr` VALUES (219, 47, 16, 44, 6, 31);
INSERT INTO `inv_opr` VALUES (220, 47, 14, 36, 18, 12.5);
INSERT INTO `inv_opr` VALUES (239, 50, 8, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (240, 50, 2, 35, 14, 15.5);
INSERT INTO `inv_opr` VALUES (241, 50, 7, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (242, 50, 7, 41, 6, 29);
INSERT INTO `inv_opr` VALUES (243, 50, 16, 44, 4, 31);
INSERT INTO `inv_opr` VALUES (244, 50, 14, 36, 10, 13.5);
INSERT INTO `inv_opr` VALUES (245, 50, 6, 44, 4, 31);
INSERT INTO `inv_opr` VALUES (246, 51, 8, 38, 324, 15);
INSERT INTO `inv_opr` VALUES (1268, 53, 11, 61, 60, 14);
INSERT INTO `inv_opr` VALUES (1267, 53, 13, 39, 14, 20);
INSERT INTO `inv_opr` VALUES (1266, 53, 2, 35, 13, 15.5);
INSERT INTO `inv_opr` VALUES (1265, 53, 7, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (1264, 53, 10, 38, 51, 15);
INSERT INTO `inv_opr` VALUES (1496, 54, 2, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1495, 54, 13, 37, 60, 34);
INSERT INTO `inv_opr` VALUES (1494, 54, 1, 36, 27, 12.5);
INSERT INTO `inv_opr` VALUES (1493, 54, 10, 38, 108, 15);
INSERT INTO `inv_opr` VALUES (1492, 54, 7, 41, 33, 28);
INSERT INTO `inv_opr` VALUES (2072, 149, 10, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (1483, 55, 4, 46, 10, 5);
INSERT INTO `inv_opr` VALUES (647, 56, 11, 62, 60, 14.5);
INSERT INTO `inv_opr` VALUES (646, 56, 6, 44, 12, 31);
INSERT INTO `inv_opr` VALUES (645, 56, 8, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (644, 56, 13, 39, 20, 20);
INSERT INTO `inv_opr` VALUES (643, 56, 2, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (642, 56, 14, 36, 30, 13.5);
INSERT INTO `inv_opr` VALUES (796, 57, 21, 79, 192, 5);
INSERT INTO `inv_opr` VALUES (1195, 45, 14, 36, 18, 13.5);
INSERT INTO `inv_opr` VALUES (1194, 45, 7, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (317, 58, 21, 77, 544, 5.25);
INSERT INTO `inv_opr` VALUES (318, 59, 7, 43, 20, 17);
INSERT INTO `inv_opr` VALUES (1081, 60, 6, 44, 6, 31);
INSERT INTO `inv_opr` VALUES (1080, 60, 7, 41, 9, 29);
INSERT INTO `inv_opr` VALUES (1079, 60, 13, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (1078, 60, 8, 38, 18, 16);
INSERT INTO `inv_opr` VALUES (1077, 60, 7, 37, 13, 34);
INSERT INTO `inv_opr` VALUES (1076, 60, 13, 37, 47, 34);
INSERT INTO `inv_opr` VALUES (1075, 60, 2, 35, 24, 15.5);
INSERT INTO `inv_opr` VALUES (1074, 60, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1262, 61, 4, 39, 12, 20);
INSERT INTO `inv_opr` VALUES (1261, 61, 2, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (1260, 61, 15, 45, 12, 29);
INSERT INTO `inv_opr` VALUES (1259, 61, 9, 36, 1, 12.5);
INSERT INTO `inv_opr` VALUES (338, 62, 2, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (1258, 61, 14, 36, 29, 12.5);
INSERT INTO `inv_opr` VALUES (1285, 64, 6, 44, 54, 30);
INSERT INTO `inv_opr` VALUES (1365, 29, 14, 36, 18, 13.5);
INSERT INTO `inv_opr` VALUES (781, 27, 13, 39, 24, 19);
INSERT INTO `inv_opr` VALUES (925, 19, 8, 38, 2, 16);
INSERT INTO `inv_opr` VALUES (1284, 64, 15, 45, 36, 29);
INSERT INTO `inv_opr` VALUES (1283, 64, 10, 38, 30, 15);
INSERT INTO `inv_opr` VALUES (1282, 64, 7, 37, 60, 34);
INSERT INTO `inv_opr` VALUES (1281, 64, 3, 35, 90, 14.5);
INSERT INTO `inv_opr` VALUES (1280, 64, 2, 35, 30, 14.5);
INSERT INTO `inv_opr` VALUES (1279, 64, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (496, 65, 16, 60, 6, 41);
INSERT INTO `inv_opr` VALUES (497, 65, 6, 44, 6, 31);
INSERT INTO `inv_opr` VALUES (498, 65, 3, 35, 18, 15.5);
INSERT INTO `inv_opr` VALUES (514, 66, 21, 78, 384, 5);
INSERT INTO `inv_opr` VALUES (582, 30, 11, 61, 158, 15);
INSERT INTO `inv_opr` VALUES (581, 30, 13, 39, 120, 19);
INSERT INTO `inv_opr` VALUES (528, 67, 11, 64, 60, 13.5);
INSERT INTO `inv_opr` VALUES (1428, 37, 22, 61, 35, 13);
INSERT INTO `inv_opr` VALUES (1419, 68, 13, 39, 12, 20);
INSERT INTO `inv_opr` VALUES (979, 69, 13, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (978, 69, 3, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (977, 69, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1207, 70, 21, 54, 192, 5.5);
INSERT INTO `inv_opr` VALUES (1206, 70, 22, 61, 60, 13);
INSERT INTO `inv_opr` VALUES (1205, 70, 10, 38, 5, 16);
INSERT INTO `inv_opr` VALUES (795, 57, 14, 36, 10, 13.5);
INSERT INTO `inv_opr` VALUES (565, 71, 21, 54, 673, 5.5);
INSERT INTO `inv_opr` VALUES (566, 71, 21, 76, 192, 5.5);
INSERT INTO `inv_opr` VALUES (567, 71, 12, 42, 2, 16);
INSERT INTO `inv_opr` VALUES (1387, 75, 13, 39, 6, 19);
INSERT INTO `inv_opr` VALUES (1364, 29, 16, 44, 18, 31);
INSERT INTO `inv_opr` VALUES (1060, 72, 2, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1418, 68, 9, 36, 27, 13.5);
INSERT INTO `inv_opr` VALUES (1257, 74, 22, 62, 22, 14);
INSERT INTO `inv_opr` VALUES (1256, 74, 11, 62, 43, 14);
INSERT INTO `inv_opr` VALUES (1255, 74, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1254, 74, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (780, 27, 16, 35, 30, 14);
INSERT INTO `inv_opr` VALUES (720, 76, 3, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (721, 76, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (722, 76, 17, 71, 40, 5);
INSERT INTO `inv_opr` VALUES (1302, 40, 7, 43, 12, 17);
INSERT INTO `inv_opr` VALUES (1477, 78, 4, 46, 65, 19);
INSERT INTO `inv_opr` VALUES (1476, 78, 0, 71, 157, 5);
INSERT INTO `inv_opr` VALUES (1475, 78, 7, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (779, 27, 14, 36, 54, 12);
INSERT INTO `inv_opr` VALUES (1294, 49, 13, 39, 18, 20);
INSERT INTO `inv_opr` VALUES (1293, 49, 13, 37, 12, 35);
INSERT INTO `inv_opr` VALUES (1292, 49, 14, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1474, 78, 11, 63, 72, 12);
INSERT INTO `inv_opr` VALUES (983, 81, 17, 71, 3, 5);
INSERT INTO `inv_opr` VALUES (1029, 82, 7, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (1482, 55, 10, 38, 162, 15);
INSERT INTO `inv_opr` VALUES (982, 81, 11, 63, 10, 12);
INSERT INTO `inv_opr` VALUES (1301, 88, 3, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (1263, 53, 8, 38, 3, 15);
INSERT INTO `inv_opr` VALUES (1028, 82, 10, 38, 10, 16);
INSERT INTO `inv_opr` VALUES (1027, 82, 8, 38, 20, 16);
INSERT INTO `inv_opr` VALUES (1389, 79, 6, 70, 48, 15);
INSERT INTO `inv_opr` VALUES (1240, 24, 14, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1073, 89, 13, 39, 180, 19);
INSERT INTO `inv_opr` VALUES (1082, 60, 21, 76, 192, 5.5);
INSERT INTO `inv_opr` VALUES (1173, 91, 4, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (1288, 8, 8, 38, 50, 15);
INSERT INTO `inv_opr` VALUES (1473, 78, 2, 43, 40, 17);
INSERT INTO `inv_opr` VALUES (1204, 70, 3, 35, 30, 14.5);
INSERT INTO `inv_opr` VALUES (1203, 70, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (1271, 94, 6, 43, 50, 17);
INSERT INTO `inv_opr` VALUES (1291, 49, 2, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (1380, 5, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (1253, 74, 13, 39, 28, 20);
INSERT INTO `inv_opr` VALUES (1269, 95, 7, 43, 8, 17);
INSERT INTO `inv_opr` VALUES (1270, 95, 16, 35, 2, 15.5);
INSERT INTO `inv_opr` VALUES (1287, 96, 6, 38, 60, 15);
INSERT INTO `inv_opr` VALUES (1290, 97, 4, 43, 50, 17);
INSERT INTO `inv_opr` VALUES (1306, 34, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (1414, 16, 16, 35, 4, 14.5);
INSERT INTO `inv_opr` VALUES (1379, 5, 3, 43, 50, 17);
INSERT INTO `inv_opr` VALUES (1386, 75, 7, 41, 48, 28);
INSERT INTO `inv_opr` VALUES (1382, 5, 13, 46, 30, 20);
INSERT INTO `inv_opr` VALUES (1392, 79, 13, 46, 10, 20);
INSERT INTO `inv_opr` VALUES (1427, 37, 13, 37, 6, 35);
INSERT INTO `inv_opr` VALUES (1410, 98, 21, 80, 6, 5);
INSERT INTO `inv_opr` VALUES (1409, 98, 21, 79, 115, 5.25);
INSERT INTO `inv_opr` VALUES (1408, 98, 21, 76, 384, 5.5);
INSERT INTO `inv_opr` VALUES (1448, 43, 8, 38, 2, 16);
INSERT INTO `inv_opr` VALUES (1462, 100, 10, 38, 4, 16);
INSERT INTO `inv_opr` VALUES (1500, 105, 8, 38, 1, 0);
INSERT INTO `inv_opr` VALUES (1481, 55, 7, 43, 4, 17);
INSERT INTO `inv_opr` VALUES (1498, 54, 8, 38, 13, 15);
INSERT INTO `inv_opr` VALUES (1499, 54, 6, 38, 41, 15);
INSERT INTO `inv_opr` VALUES (1509, 106, 2, 43, 24, 17);
INSERT INTO `inv_opr` VALUES (1510, 107, 10, 38, 108, 14);
INSERT INTO `inv_opr` VALUES (1514, 108, 21, 76, 32, 5.15);
INSERT INTO `inv_opr` VALUES (1513, 108, 21, 54, 191, 5.15);
INSERT INTO `inv_opr` VALUES (2189, 109, 28, 57, 342, 6);
INSERT INTO `inv_opr` VALUES (2236, 116, 28, 58, 100, 6.25);
INSERT INTO `inv_opr` VALUES (2262, 176, 2, 35, 12, 14);
INSERT INTO `inv_opr` VALUES (2292, 175, 4, 39, 24, 20);
INSERT INTO `inv_opr` VALUES (2291, 175, 23, 36, 104, 12.5);
INSERT INTO `inv_opr` VALUES (2341, 110, 6, 44, 15, 30);
INSERT INTO `inv_opr` VALUES (2340, 110, 13, 39, 12, 19);
INSERT INTO `inv_opr` VALUES (2633, 180, 10, 38, 14, 16);
INSERT INTO `inv_opr` VALUES (2487, 111, 6, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (2151, 112, 6, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (2150, 112, 10, 38, 7, 16);
INSERT INTO `inv_opr` VALUES (1532, 113, 29, 81, 104, 16.5);
INSERT INTO `inv_opr` VALUES (1533, 113, 2, 35, 18, 15.5);
INSERT INTO `inv_opr` VALUES (1534, 113, 1, 36, 20, 12.5);
INSERT INTO `inv_opr` VALUES (1802, 144, 11, 64, 57, 12);
INSERT INTO `inv_opr` VALUES (1801, 144, 27, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (1800, 114, 5, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (1799, 114, 1, 36, 108, 12.5);
INSERT INTO `inv_opr` VALUES (2631, 115, 6, 43, 6, 17);
INSERT INTO `inv_opr` VALUES (2630, 115, 10, 38, 1, 16);
INSERT INTO `inv_opr` VALUES (2629, 115, 25, 43, 34, 17);
INSERT INTO `inv_opr` VALUES (2339, 110, 9, 36, 54, 12);
INSERT INTO `inv_opr` VALUES (2235, 116, 28, 57, 353, 6.5);
INSERT INTO `inv_opr` VALUES (2234, 116, 28, 58, 180, 6.5);
INSERT INTO `inv_opr` VALUES (2265, 117, 25, 43, 8, 17);
INSERT INTO `inv_opr` VALUES (1591, 118, 3, 35, 120, 14.5);
INSERT INTO `inv_opr` VALUES (1630, 119, 4, 39, 77, 19);
INSERT INTO `inv_opr` VALUES (1629, 119, 9, 36, 540, 12.5);
INSERT INTO `inv_opr` VALUES (1628, 119, 13, 39, 43, 19);
INSERT INTO `inv_opr` VALUES (1613, 120, 9, 36, 15, 12.5);
INSERT INTO `inv_opr` VALUES (1614, 120, 3, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1615, 120, 28, 55, 353, 6.75);
INSERT INTO `inv_opr` VALUES (1616, 120, 28, 56, 192, 6.5);
INSERT INTO `inv_opr` VALUES (2157, 121, 6, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (2156, 121, 3, 43, 9, 17);
INSERT INTO `inv_opr` VALUES (2645, 122, 7, 44, 7, 35);
INSERT INTO `inv_opr` VALUES (2644, 122, 27, 41, 5, 33);
INSERT INTO `inv_opr` VALUES (2643, 122, 9, 36, 6, 17.5);
INSERT INTO `inv_opr` VALUES (2642, 122, 3, 35, 6, 19.5);
INSERT INTO `inv_opr` VALUES (2397, 123, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (2396, 123, 25, 43, 40, 17);
INSERT INTO `inv_opr` VALUES (2288, 124, 10, 38, 7, 16);
INSERT INTO `inv_opr` VALUES (2287, 124, 25, 43, 12, 17);
INSERT INTO `inv_opr` VALUES (2614, 179, 30, 62, 60, 14.5);
INSERT INTO `inv_opr` VALUES (2409, 125, 10, 38, 6, 16);
INSERT INTO `inv_opr` VALUES (2408, 125, 7, 37, 54, 31);
INSERT INTO `inv_opr` VALUES (2407, 125, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (2406, 125, 4, 39, 30, 20);
INSERT INTO `inv_opr` VALUES (2405, 125, 3, 35, 30, 15.5);
INSERT INTO `inv_opr` VALUES (1846, 126, 3, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1845, 126, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (2541, 127, 25, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (1982, 128, 9, 36, 12, 13.5);
INSERT INTO `inv_opr` VALUES (1981, 128, 25, 37, 12, 32);
INSERT INTO `inv_opr` VALUES (1980, 128, 3, 35, 24, 15.5);
INSERT INTO `inv_opr` VALUES (1979, 128, 27, 41, 6, 29);
INSERT INTO `inv_opr` VALUES (1978, 128, 25, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (1977, 128, 4, 39, 3, 20);
INSERT INTO `inv_opr` VALUES (1976, 128, 10, 38, 6, 16);
INSERT INTO `inv_opr` VALUES (2395, 129, 25, 43, 20, 17);
INSERT INTO `inv_opr` VALUES (2354, 130, 27, 41, 6, 28);
INSERT INTO `inv_opr` VALUES (2353, 130, 7, 44, 2, 30);
INSERT INTO `inv_opr` VALUES (2352, 130, 9, 36, 36, 12.5);
INSERT INTO `inv_opr` VALUES (2351, 130, 25, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (2350, 130, 10, 38, 36, 15);
INSERT INTO `inv_opr` VALUES (1911, 163, 29, 81, 100, 16.5);
INSERT INTO `inv_opr` VALUES (2523, 131, 3, 35, 12, 15.5);
INSERT INTO `inv_opr` VALUES (2522, 131, 10, 38, 18, 16);
INSERT INTO `inv_opr` VALUES (2521, 131, 25, 37, 4, 32);
INSERT INTO `inv_opr` VALUES (2520, 131, 7, 37, 14, 32);
INSERT INTO `inv_opr` VALUES (2519, 131, 7, 44, 6, 31);
INSERT INTO `inv_opr` VALUES (2518, 131, 4, 39, 6, 20);
INSERT INTO `inv_opr` VALUES (2517, 131, 30, 63, 120, 14);
INSERT INTO `inv_opr` VALUES (2567, 132, 31, 37, 54, 31);
INSERT INTO `inv_opr` VALUES (2566, 132, 3, 35, 18, 14.5);
INSERT INTO `inv_opr` VALUES (2565, 132, 9, 36, 12, 12.5);
INSERT INTO `inv_opr` VALUES (2564, 132, 25, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (2563, 132, 10, 38, 36, 15);
INSERT INTO `inv_opr` VALUES (2321, 133, 6, 43, 11, 17);
INSERT INTO `inv_opr` VALUES (2320, 133, 25, 43, 9, 17);
INSERT INTO `inv_opr` VALUES (1711, 134, 10, 38, 6, 16);
INSERT INTO `inv_opr` VALUES (1710, 134, 3, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (1709, 134, 4, 39, 6, 20);
INSERT INTO `inv_opr` VALUES (2649, 193, 27, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (2168, 135, 3, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (1744, 136, 27, 41, 5, 29);
INSERT INTO `inv_opr` VALUES (1743, 136, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (1742, 136, 10, 38, 12, 16);
INSERT INTO `inv_opr` VALUES (1741, 136, 25, 37, 60, 31);
INSERT INTO `inv_opr` VALUES (1740, 136, 3, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1739, 136, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2054, 137, 27, 43, 54, 17);
INSERT INTO `inv_opr` VALUES (2053, 137, 10, 38, 12, 15);
INSERT INTO `inv_opr` VALUES (2052, 137, 1, 36, 91, 12.5);
INSERT INTO `inv_opr` VALUES (2051, 137, 9, 36, 17, 12.5);
INSERT INTO `inv_opr` VALUES (2050, 137, 16, 60, 18, 40);
INSERT INTO `inv_opr` VALUES (2049, 137, 4, 39, 120, 19);
INSERT INTO `inv_opr` VALUES (1748, 138, 27, 35, 22, 14.5);
INSERT INTO `inv_opr` VALUES (1747, 138, 3, 35, 15, 14.5);
INSERT INTO `inv_opr` VALUES (1749, 138, 31, 35, 11, 14.5);
INSERT INTO `inv_opr` VALUES (1750, 138, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2393, 141, 27, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (2319, 139, 6, 43, 50, 17);
INSERT INTO `inv_opr` VALUES (2048, 137, 3, 35, 60, 14.5);
INSERT INTO `inv_opr` VALUES (1761, 140, 10, 38, 42, 15);
INSERT INTO `inv_opr` VALUES (1762, 140, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (1763, 140, 31, 35, 108, 14.5);
INSERT INTO `inv_opr` VALUES (1764, 140, 25, 37, 54, 31);
INSERT INTO `inv_opr` VALUES (1765, 140, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2392, 141, 25, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (2391, 141, 10, 38, 11, 16);
INSERT INTO `inv_opr` VALUES (2603, 172, 27, 41, 24, 29);
INSERT INTO `inv_opr` VALUES (2337, 142, 0, 45, 4, 29);
INSERT INTO `inv_opr` VALUES (2336, 142, 7, 44, 4, 30);
INSERT INTO `inv_opr` VALUES (2335, 142, 4, 39, 48, 19);
INSERT INTO `inv_opr` VALUES (1788, 143, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (1798, 114, 4, 39, 6, 20);
INSERT INTO `inv_opr` VALUES (2113, 145, 27, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (2604, 146, 31, 37, 30, 32);
INSERT INTO `inv_opr` VALUES (1833, 147, 31, 35, 30, 15);
INSERT INTO `inv_opr` VALUES (1834, 147, 1, 36, 108, 12.5);
INSERT INTO `inv_opr` VALUES (1835, 147, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (2616, 184, 5, 42, 49, 15);
INSERT INTO `inv_opr` VALUES (2602, 148, 28, 56, 508, 6);
INSERT INTO `inv_opr` VALUES (2071, 149, 27, 43, 15, 17);
INSERT INTO `inv_opr` VALUES (2070, 149, 27, 41, 8, 29);
INSERT INTO `inv_opr` VALUES (2069, 149, 7, 44, 10, 31);
INSERT INTO `inv_opr` VALUES (2068, 149, 1, 36, 8, 13.5);
INSERT INTO `inv_opr` VALUES (2067, 149, 31, 35, 16, 15.5);
INSERT INTO `inv_opr` VALUES (2305, 150, 25, 37, 5, 32);
INSERT INTO `inv_opr` VALUES (2304, 150, 4, 39, 5, 20);
INSERT INTO `inv_opr` VALUES (2553, 151, 31, 35, 108, 14.5);
INSERT INTO `inv_opr` VALUES (2624, 152, 27, 43, 30, 17);
INSERT INTO `inv_opr` VALUES (2623, 152, 10, 38, 42, 16);
INSERT INTO `inv_opr` VALUES (1852, 153, 10, 38, 30, 16);
INSERT INTO `inv_opr` VALUES (1853, 153, 4, 39, 20, 20);
INSERT INTO `inv_opr` VALUES (1854, 153, 31, 35, 18, 15.5);
INSERT INTO `inv_opr` VALUES (1855, 153, 27, 41, 4, 29);
INSERT INTO `inv_opr` VALUES (1856, 153, 7, 44, 8, 31);
INSERT INTO `inv_opr` VALUES (1857, 153, 1, 36, 18, 13.5);
INSERT INTO `inv_opr` VALUES (2420, 154, 27, 43, 25, 17);
INSERT INTO `inv_opr` VALUES (2419, 154, 27, 41, 12, 29);
INSERT INTO `inv_opr` VALUES (2418, 154, 4, 39, 12, 20);
INSERT INTO `inv_opr` VALUES (2417, 154, 1, 36, 12, 13.5);
INSERT INTO `inv_opr` VALUES (2416, 154, 31, 35, 30, 15.5);
INSERT INTO `inv_opr` VALUES (2415, 154, 25, 37, 24, 31);
INSERT INTO `inv_opr` VALUES (2414, 154, 31, 37, 30, 31);
INSERT INTO `inv_opr` VALUES (2115, 155, 10, 38, 10, 16);
INSERT INTO `inv_opr` VALUES (2648, 167, 4, 39, 10, 20);
INSERT INTO `inv_opr` VALUES (2596, 156, 5, 42, 50, 15);
INSERT INTO `inv_opr` VALUES (2595, 156, 31, 35, 120, 14.5);
INSERT INTO `inv_opr` VALUES (2594, 156, 1, 36, 162, 12.5);
INSERT INTO `inv_opr` VALUES (2307, 157, 27, 43, 2, 17);
INSERT INTO `inv_opr` VALUES (2180, 158, 31, 35, 225, 14.5);
INSERT INTO `inv_opr` VALUES (1883, 159, 16, 60, 3, 41);
INSERT INTO `inv_opr` VALUES (1884, 159, 10, 38, 6, 16);
INSERT INTO `inv_opr` VALUES (1885, 159, 27, 43, 3, 18);
INSERT INTO `inv_opr` VALUES (1886, 159, 27, 41, 6, 29);
INSERT INTO `inv_opr` VALUES (1887, 159, 1, 36, 24, 13.5);
INSERT INTO `inv_opr` VALUES (2646, 122, 27, 43, 2, 22);
INSERT INTO `inv_opr` VALUES (2641, 160, 31, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (2640, 160, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (2537, 161, 30, 62, 120, 14.5);
INSERT INTO `inv_opr` VALUES (2592, 162, 27, 43, 20, 17);
INSERT INTO `inv_opr` VALUES (2591, 162, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (2590, 162, 10, 38, 54, 15);
INSERT INTO `inv_opr` VALUES (2589, 162, 31, 35, 108, 14.5);
INSERT INTO `inv_opr` VALUES (2588, 162, 1, 36, 108, 12.5);
INSERT INTO `inv_opr` VALUES (2627, 188, 4, 46, 38, 20);
INSERT INTO `inv_opr` VALUES (2551, 165, 31, 35, 18, 15.5);
INSERT INTO `inv_opr` VALUES (2550, 165, 7, 37, 12, 31);
INSERT INTO `inv_opr` VALUES (2549, 165, 0, 45, 6, 29);
INSERT INTO `inv_opr` VALUES (2548, 165, 7, 44, 6, 31);
INSERT INTO `inv_opr` VALUES (2547, 165, 16, 60, 2, 40);
INSERT INTO `inv_opr` VALUES (2546, 165, 10, 38, 36, 15);
INSERT INTO `inv_opr` VALUES (2545, 165, 27, 43, 6, 18);
INSERT INTO `inv_opr` VALUES (2544, 165, 27, 41, 3, 29);
INSERT INTO `inv_opr` VALUES (2543, 165, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2601, 148, 31, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (2600, 148, 1, 36, 12, 13.5);
INSERT INTO `inv_opr` VALUES (2599, 148, 27, 41, 12, 29);
INSERT INTO `inv_opr` VALUES (2598, 148, 4, 46, 49, 19);
INSERT INTO `inv_opr` VALUES (2303, 150, 1, 36, 8, 13.5);
INSERT INTO `inv_opr` VALUES (2302, 150, 27, 41, 10, 29);
INSERT INTO `inv_opr` VALUES (2301, 150, 10, 38, 24, 16);
INSERT INTO `inv_opr` VALUES (2167, 135, 12, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (2238, 166, 28, 58, 384, 5.5);
INSERT INTO `inv_opr` VALUES (2390, 141, 6, 43, 7, 17);
INSERT INTO `inv_opr` VALUES (2171, 168, 3, 35, 6, 14.5);
INSERT INTO `inv_opr` VALUES (2172, 168, 1, 36, 6, 12.5);
INSERT INTO `inv_opr` VALUES (2173, 168, 4, 39, 6, 19);
INSERT INTO `inv_opr` VALUES (2174, 168, 7, 44, 12, 30);
INSERT INTO `inv_opr` VALUES (2175, 168, 4, 39, 10, 19);
INSERT INTO `inv_opr` VALUES (2176, 169, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2338, 170, 27, 43, 4, 17);
INSERT INTO `inv_opr` VALUES (2237, 171, 28, 58, 180, 6);
INSERT INTO `inv_opr` VALUES (2404, 125, 9, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2245, 173, 28, 57, 384, 6);
INSERT INTO `inv_opr` VALUES (2253, 174, 31, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (2263, 176, 3, 35, 42, 14);
INSERT INTO `inv_opr` VALUES (2264, 176, 27, 41, 12, 28);
INSERT INTO `inv_opr` VALUES (2293, 175, 23, 36, 4, 12.5);
INSERT INTO `inv_opr` VALUES (2597, 148, 13, 46, 113, 19);
INSERT INTO `inv_opr` VALUES (2306, 150, 30, 63, 30, 14);
INSERT INTO `inv_opr` VALUES (2593, 177, 31, 35, 54, 14.5);
INSERT INTO `inv_opr` VALUES (2383, 178, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2382, 178, 25, 37, 15, 31);
INSERT INTO `inv_opr` VALUES (2381, 178, 27, 37, 38, 31);
INSERT INTO `inv_opr` VALUES (2613, 179, 31, 35, 12, 15.5);
INSERT INTO `inv_opr` VALUES (2612, 179, 27, 43, 10, 17);
INSERT INTO `inv_opr` VALUES (2611, 179, 25, 37, 6, 32);
INSERT INTO `inv_opr` VALUES (2610, 179, 25, 37, 6, 32);
INSERT INTO `inv_opr` VALUES (2609, 179, 6, 38, 10, 16);
INSERT INTO `inv_opr` VALUES (2608, 179, 4, 39, 6, 20);
INSERT INTO `inv_opr` VALUES (2607, 179, 1, 36, 18, 13.5);
INSERT INTO `inv_opr` VALUES (2583, 181, 31, 37, 6, 32);
INSERT INTO `inv_opr` VALUES (2582, 181, 27, 41, 6, 29);
INSERT INTO `inv_opr` VALUES (2581, 181, 5, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (2580, 181, 31, 35, 6, 15.5);
INSERT INTO `inv_opr` VALUES (2579, 181, 31, 35, 6, 15.5);
INSERT INTO `inv_opr` VALUES (2578, 181, 23, 36, 4, 12.5);
INSERT INTO `inv_opr` VALUES (2524, 131, 27, 43, 2, 17);
INSERT INTO `inv_opr` VALUES (2525, 182, 30, 62, 25, 14);
INSERT INTO `inv_opr` VALUES (2526, 182, 30, 63, 20, 14);
INSERT INTO `inv_opr` VALUES (2647, 167, 6, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (2639, 160, 1, 36, 54, 12.5);
INSERT INTO `inv_opr` VALUES (2542, 127, 27, 43, 3, 17);
INSERT INTO `inv_opr` VALUES (2554, 151, 5, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (2555, 151, 30, 63, 60, 13.75);
INSERT INTO `inv_opr` VALUES (2577, 181, 1, 36, 32, 12.5);
INSERT INTO `inv_opr` VALUES (2576, 181, 4, 39, 60, 19);
INSERT INTO `inv_opr` VALUES (2622, 186, 6, 38, 10, 0);
INSERT INTO `inv_opr` VALUES (2615, 184, 12, 42, 1, 15);
INSERT INTO `inv_opr` VALUES (2617, 185, 28, 58, 192, 6);
INSERT INTO `inv_opr` VALUES (2618, 185, 30, 63, 50, 14);
INSERT INTO `inv_opr` VALUES (2625, 187, 30, 63, 370, 15);
INSERT INTO `inv_opr` VALUES (2626, 187, 30, 62, 120, 15);
INSERT INTO `inv_opr` VALUES (2628, 189, 6, 38, 5, 0);
INSERT INTO `inv_opr` VALUES (2632, 115, 27, 43, 7, 17);
INSERT INTO `inv_opr` VALUES (2634, 180, 27, 43, 1, 17);
INSERT INTO `inv_opr` VALUES (2635, 190, 6, 38, 2, 0);
INSERT INTO `inv_opr` VALUES (2636, 191, 5, 42, 25, 16);
INSERT INTO `inv_opr` VALUES (2637, 191, 27, 43, 5, 17);
INSERT INTO `inv_opr` VALUES (2638, 192, 27, 41, 24, 29);

-- --------------------------------------------------------

-- 
-- Table structure for table `inv_porx`
-- 

CREATE TABLE `inv_porx` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) default NULL,
  `ord_id` int(11) default NULL,
  `it_id` int(11) default NULL,
  `qunt` int(11) default NULL,
  `price` float default NULL,
  `date` int(120) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `inv_porx`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `inv_text`
-- 

CREATE TABLE `inv_text` (
  `id` int(11) NOT NULL auto_increment,
  `header` varchar(255) default NULL,
  `footer` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `inv_text`
-- 

INSERT INTO `inv_text` VALUES (1, 'ARC-EN-CIEL PRODUCE INC.\r\n\r\nTel. (416)236-4949\r\nFax (416)236-4915\r\n\r\n123 Eastside Dr. unit 1\r\nToronto Ontario M8Z 5S5\r\n\r\n\r\n', '\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nNAME:______________________');

-- --------------------------------------------------------

-- 
-- Table structure for table `items`
-- 

CREATE TABLE `items` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `price` float default NULL,
  `act` int(11) default '1',
  `ord` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

-- 
-- Dumping data for table `items`
-- 

INSERT INTO `items` VALUES (38, 'Green cocount', 15, 1, 1);
INSERT INTO `items` VALUES (37, 'Eddoes', 31, 1, 29);
INSERT INTO `items` VALUES (36, 'Chayote', 12.5, 1, 30);
INSERT INTO `items` VALUES (35, 'Cassava', 14.5, 1, 16);
INSERT INTO `items` VALUES (39, 'Green papaya', 19, 1, 5);
INSERT INTO `items` VALUES (40, 'Dry cocount', 25, 0, 33);
INSERT INTO `items` VALUES (41, 'Malanga lila', 28, 1, 24);
INSERT INTO `items` VALUES (42, 'pumpkin', 16, 1, 22);
INSERT INTO `items` VALUES (43, 'Suger cane', 17, 1, 20);
INSERT INTO `items` VALUES (44, 'White yam', 30, 1, 26);
INSERT INTO `items` VALUES (45, 'Yellow yam', 29, 1, 27);
INSERT INTO `items` VALUES (46, 'Sweet papaya C.R.', 20, 1, 17);
INSERT INTO `items` VALUES (47, 'Ginger ', 10, 0, 16);
INSERT INTO `items` VALUES (48, 'Guava', 22, 0, 14);
INSERT INTO `items` VALUES (49, 'Jicama', 17, 0, 12);
INSERT INTO `items` VALUES (50, 'Aloe vera', 20, 0, 11);
INSERT INTO `items` VALUES (51, 'Banana leaf', 28, 0, 8);
INSERT INTO `items` VALUES (52, 'Manzano peper', 32, 0, 10);
INSERT INTO `items` VALUES (53, 'sweet potates C.R', 15, 0, 6);
INSERT INTO `items` VALUES (54, 'Mango kent size 6', 6.5, 0, 0);
INSERT INTO `items` VALUES (55, 'Mango kent size 7', 7, 1, 14);
INSERT INTO `items` VALUES (56, 'Mango kent size 8', 6.75, 1, 15);
INSERT INTO `items` VALUES (57, 'Mango kent size 9', 6.5, 1, 18);
INSERT INTO `items` VALUES (58, 'Mango kent size 10', 6.5, 1, 13);
INSERT INTO `items` VALUES (59, 'Mango kent size 12', 5, 0, 19);
INSERT INTO `items` VALUES (60, 'yampi', 40, 1, 1);
INSERT INTO `items` VALUES (61, 'Limes Size 150', 15, 0, 28);
INSERT INTO `items` VALUES (62, 'Limes Size 175', 14.5, 1, 9);
INSERT INTO `items` VALUES (63, 'Limes Size 200', 14, 1, 32);
INSERT INTO `items` VALUES (64, 'limes Size 230', 13.5, 1, 2);
INSERT INTO `items` VALUES (65, 'Mango Tommy Size 8', 4.5, 0, 21);
INSERT INTO `items` VALUES (66, 'Mango Tommy Size 9', 4.5, 0, 23);
INSERT INTO `items` VALUES (67, 'Mango kent Size 10', 6.5, 0, 31);
INSERT INTO `items` VALUES (68, 'Mango Tommy Size 14', 4.5, 0, 38);
INSERT INTO `items` VALUES (69, 'Ct 60 Watermelon', 125, 0, 7);
INSERT INTO `items` VALUES (70, 'Yellow Coconut', 15, 0, 0);
INSERT INTO `items` VALUES (73, 'Ct 45 Watermelon', 125, 0, 0);
INSERT INTO `items` VALUES (72, 'Manzano Pepper', 23, 0, 0);
INSERT INTO `items` VALUES (81, 'mandarin 10kg', 16.5, 1, 0);
INSERT INTO `items` VALUES (71, 'Cauliflower', 9.25, 0, 0);
INSERT INTO `items` VALUES (74, 'mango ket size 6', 6, 0, 0);
INSERT INTO `items` VALUES (75, 'mango ket size 7', 6, 0, 0);
INSERT INTO `items` VALUES (76, 'mango ket size 8', 5.5, 0, 0);
INSERT INTO `items` VALUES (77, 'mango ket size 9', 5.25, 0, 0);
INSERT INTO `items` VALUES (78, 'mango ket size 10', 5, 0, 0);
INSERT INTO `items` VALUES (79, 'mango ket size 12', 5, 0, 0);
INSERT INTO `items` VALUES (80, 'mango ket size 14', 5, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `orders`
-- 

CREATE TABLE `orders` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(120) default NULL,
  `date` datetime default NULL,
  `expenses` int(11) default NULL,
  `user_id` int(11) default NULL,
  `fin` int(11) default '0',
  `num` varchar(80) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `orders`
-- 

INSERT INTO `orders` VALUES (1, '3271', '2012-07-30 08:02:40', 0, 5, 0, 'DFIU 423263-0');
INSERT INTO `orders` VALUES (2, '3272', '2012-07-30 08:03:34', 0, 5, 0, 'FSCU 568169-4');
INSERT INTO `orders` VALUES (3, '3273', '2012-07-30 08:04:38', 0, 5, 0, 'TGHU 991627-0');
INSERT INTO `orders` VALUES (4, '3274', '2012-07-30 08:05:48', 0, 5, 0, 'SZLU 980335-1');
INSERT INTO `orders` VALUES (5, '3275', '2012-07-30 08:06:36', 502, 5, 0, 'GESU 932864-9');
INSERT INTO `orders` VALUES (6, '3276', '2012-07-30 08:09:06', 0, 5, 0, 'TRIU 819444-0');
INSERT INTO `orders` VALUES (7, '3277', '2012-07-30 08:10:27', 0, 5, 0, 'GESU 940978-2');
INSERT INTO `orders` VALUES (8, '3264', '2012-07-30 08:46:59', 0, 5, 0, 'GESU 949014-0');
INSERT INTO `orders` VALUES (9, '3267', '2012-07-30 08:47:39', 0, 5, 0, 'GESU 932550-5');
INSERT INTO `orders` VALUES (10, '3265', '2012-07-30 08:48:30', 0, 5, 0, 'GESU 949555-9');
INSERT INTO `orders` VALUES (11, '3263', '2012-07-30 08:59:33', 0, 5, 0, '331479853');
INSERT INTO `orders` VALUES (12, '3250', '2012-07-30 09:04:40', 0, 5, 0, 'Inventory for week July 23');
INSERT INTO `orders` VALUES (13, '3266', '2012-07-30 09:07:44', 0, 5, 0, 'Inventory from July 23rd');
INSERT INTO `orders` VALUES (14, '3255', '2012-07-30 09:09:10', 0, 5, 1, 'Inventory from July 23rd');
INSERT INTO `orders` VALUES (15, '3231', '2012-07-30 09:12:42', 0, 5, 1, 'Inventory from July 23rd.');
INSERT INTO `orders` VALUES (16, '3268', '2012-07-30 09:13:29', 0, 5, 0, 'Inventory from July 23rd');
INSERT INTO `orders` VALUES (17, '3270', '2012-07-30 09:29:50', 0, 5, 1, 'Inventory from July 23rd.');
INSERT INTO `orders` VALUES (18, '3247', '2012-07-30 09:31:24', 0, 5, 0, 'Inventory from July 23rd');
INSERT INTO `orders` VALUES (19, '3262', '2012-07-30 09:33:28', 0, 5, 1, 'Inventory from July 23rd');
INSERT INTO `orders` VALUES (20, '3278', '2012-07-30 09:35:40', 0, 5, 1, 'Inventory from July 23rd.');
INSERT INTO `orders` VALUES (21, '3279', '2012-07-30 10:42:16', 0, 5, 0, 'exotikampo ');
INSERT INTO `orders` VALUES (22, '3263 A', '2012-08-02 11:16:15', 0, 5, 0, 'm & S monteral');
INSERT INTO `orders` VALUES (23, '3280', '2012-08-06 08:38:39', 0, 5, 0, 'DFIU710644-6');
INSERT INTO `orders` VALUES (31, '3281  Dole', '2012-08-07 10:21:45', 0, 5, 0, 'CAIU 542163-7');
INSERT INTO `orders` VALUES (25, '3282', '2012-08-06 08:44:42', 0, 5, 0, 'FSCU568254-0');
INSERT INTO `orders` VALUES (27, '3284', '2012-08-06 08:49:01', 0, 5, 0, 'GESU936359-4');
INSERT INTO `orders` VALUES (28, '3286', '2012-08-06 09:16:09', 0, 5, 0, 'worldwide food corp.');
INSERT INTO `orders` VALUES (29, '106', '2012-08-06 11:04:14', 0, 5, 0, 'Frunk');
INSERT INTO `orders` VALUES (30, '3285', '2012-08-07 08:30:02', 0, 5, 0, 'Agrodry');

-- --------------------------------------------------------

-- 
-- Table structure for table `ord_opr`
-- 

CREATE TABLE `ord_opr` (
  `id` int(11) NOT NULL auto_increment,
  `ord_id` int(11) default NULL,
  `it_id` int(11) default NULL,
  `qunt` int(11) default NULL,
  `price` float default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=199 ;

-- 
-- Dumping data for table `ord_opr`
-- 

INSERT INTO `ord_opr` VALUES (58, 1, 36, 1152, 10.59);
INSERT INTO `ord_opr` VALUES (127, 2, 35, 1067, 13.79);
INSERT INTO `ord_opr` VALUES (126, 2, 43, 100, 11);
INSERT INTO `ord_opr` VALUES (160, 3, 35, 987, 13.83);
INSERT INTO `ord_opr` VALUES (159, 3, 43, 108, 11);
INSERT INTO `ord_opr` VALUES (67, 4, 43, 100, 10.41);
INSERT INTO `ord_opr` VALUES (66, 4, 46, 162, 16.64);
INSERT INTO `ord_opr` VALUES (65, 4, 39, 1014, 14.22);
INSERT INTO `ord_opr` VALUES (164, 5, 42, 858, 11.76);
INSERT INTO `ord_opr` VALUES (74, 6, 44, 108, 28.03);
INSERT INTO `ord_opr` VALUES (73, 6, 38, 378, 11.63);
INSERT INTO `ord_opr` VALUES (196, 16, 44, 94, 27.98);
INSERT INTO `ord_opr` VALUES (195, 16, 60, 62, 33.07);
INSERT INTO `ord_opr` VALUES (72, 6, 70, 48, 11.88);
INSERT INTO `ord_opr` VALUES (84, 7, 44, 162, 28.04);
INSERT INTO `ord_opr` VALUES (83, 7, 43, 250, 11);
INSERT INTO `ord_opr` VALUES (82, 7, 38, 324, 11.64);
INSERT INTO `ord_opr` VALUES (81, 7, 37, 219, 30.08);
INSERT INTO `ord_opr` VALUES (80, 7, 41, 180, 24.98);
INSERT INTO `ord_opr` VALUES (85, 8, 38, 1056, 12.11);
INSERT INTO `ord_opr` VALUES (86, 9, 36, 1152, 10.32);
INSERT INTO `ord_opr` VALUES (88, 10, 38, 1068, 12.05);
INSERT INTO `ord_opr` VALUES (92, 11, 64, 180, 11.8755);
INSERT INTO `ord_opr` VALUES (91, 11, 63, 322, 11.86);
INSERT INTO `ord_opr` VALUES (90, 11, 62, 395, 11.867);
INSERT INTO `ord_opr` VALUES (89, 11, 61, 158, 11.867);
INSERT INTO `ord_opr` VALUES (100, 12, 42, 428, 10.92);
INSERT INTO `ord_opr` VALUES (106, 13, 39, 749, 15.53);
INSERT INTO `ord_opr` VALUES (109, 14, 36, 1019, 11.44);
INSERT INTO `ord_opr` VALUES (111, 15, 45, 58, 25.29);
INSERT INTO `ord_opr` VALUES (194, 16, 35, 213, 13.44);
INSERT INTO `ord_opr` VALUES (32, 17, 71, 240, 9.25);
INSERT INTO `ord_opr` VALUES (33, 18, 72, 55, 25);
INSERT INTO `ord_opr` VALUES (115, 19, 73, 1, 125);
INSERT INTO `ord_opr` VALUES (35, 20, 69, 43, 140);
INSERT INTO `ord_opr` VALUES (71, 6, 43, 231, 11);
INSERT INTO `ord_opr` VALUES (125, 21, 80, 7, 4.13);
INSERT INTO `ord_opr` VALUES (124, 21, 79, 307, 4.13);
INSERT INTO `ord_opr` VALUES (123, 21, 78, 531, 4.13);
INSERT INTO `ord_opr` VALUES (122, 21, 77, 544, 4.13);
INSERT INTO `ord_opr` VALUES (121, 21, 76, 800, 4.13);
INSERT INTO `ord_opr` VALUES (120, 21, 75, 595, 4.13);
INSERT INTO `ord_opr` VALUES (119, 21, 54, 1440, 4.13);
INSERT INTO `ord_opr` VALUES (105, 13, 46, 170, 17.44);
INSERT INTO `ord_opr` VALUES (104, 13, 37, 125, 30.02);
INSERT INTO `ord_opr` VALUES (165, 23, 36, 1152, 10.58);
INSERT INTO `ord_opr` VALUES (130, 22, 61, 155, 11);
INSERT INTO `ord_opr` VALUES (162, 31, 37, 120, 28.55);
INSERT INTO `ord_opr` VALUES (161, 31, 35, 1032, 13.3);
INSERT INTO `ord_opr` VALUES (134, 25, 43, 161, 10.62);
INSERT INTO `ord_opr` VALUES (135, 25, 38, 267, 11.48);
INSERT INTO `ord_opr` VALUES (136, 25, 39, 480, 14.42);
INSERT INTO `ord_opr` VALUES (137, 25, 37, 186, 28.9);
INSERT INTO `ord_opr` VALUES (138, 25, 44, 120, 25.84);
INSERT INTO `ord_opr` VALUES (140, 27, 35, 22, 13.43);
INSERT INTO `ord_opr` VALUES (141, 27, 43, 375, 10.7);
INSERT INTO `ord_opr` VALUES (142, 27, 38, 540, 11.56);
INSERT INTO `ord_opr` VALUES (143, 27, 37, 38, 29);
INSERT INTO `ord_opr` VALUES (144, 27, 41, 180, 24.91);
INSERT INTO `ord_opr` VALUES (191, 28, 56, 700, 4.75);
INSERT INTO `ord_opr` VALUES (190, 28, 58, 1420, 4.75);
INSERT INTO `ord_opr` VALUES (163, 29, 81, 204, 16);
INSERT INTO `ord_opr` VALUES (189, 28, 57, 1463, 4.75);
INSERT INTO `ord_opr` VALUES (188, 28, 55, 353, 4.75);
INSERT INTO `ord_opr` VALUES (198, 30, 62, 450, 12.77);
INSERT INTO `ord_opr` VALUES (197, 30, 63, 650, 12.77);

-- --------------------------------------------------------

-- 
-- Table structure for table `payments`
-- 

CREATE TABLE `payments` (
  `id` int(11) NOT NULL auto_increment,
  `pay` float default NULL,
  `cus` int(11) default NULL,
  `inv` int(11) default NULL,
  `note` varchar(255) default NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `payments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `fname` varchar(120) default NULL,
  `un` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `act` int(11) NOT NULL default '1',
  `user_type` int(11) NOT NULL default '1',
  `short` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (8, 'raymundo', 'raymundo', '266575d3c2b8a34f83817458f96152b1', 1, 1, '');
INSERT INTO `users` VALUES (5, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 2, '');
INSERT INTO `users` VALUES (7, 'nila', 'nila', '4cf49ed737012a026800eaf4607da43a', 1, 1, '');
INSERT INTO `users` VALUES (9, 'debbie', 'debbie', '7407d8acae1d050e3efdcef9e7db097a', 1, 1, '');
INSERT INTO `users` VALUES (10, 'sam hak', 'sam', '7407d8acae1d050e3efdcef9e7db097a', 1, 1, '');
INSERT INTO `users` VALUES (11, 'sam hak', 'sam', '7407d8acae1d050e3efdcef9e7db097a', 1, 3, '');
INSERT INTO `users` VALUES (12, 'debbie', 'debbie', '7407d8acae1d050e3efdcef9e7db097a', 1, 2, '');
INSERT INTO `users` VALUES (13, 'mike', 'mike', '4c3e1ec04215f69d6a8e9c023c9e4572', 1, 1, '');
INSERT INTO `users` VALUES (14, 'test', 't', 'e358efa489f58062f10dd7316b65649e', 1, 3, '');
