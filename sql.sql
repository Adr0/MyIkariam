
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 21, 2012 at 12:59 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `alpha_agora`
--

CREATE TABLE `alpha_agora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autore` text COLLATE latin1_general_ci NOT NULL,
  `contenuto` text COLLATE latin1_general_ci NOT NULL,
  `isola` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `data` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ora` varchar(15) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alpha_alliance`
--

CREATE TABLE `alpha_alliance` (
  `ally_id` int(11) NOT NULL AUTO_INCREMENT,
  `ally_name` text COLLATE latin1_general_ci NOT NULL,
  `ally_tag` text COLLATE latin1_general_ci NOT NULL,
  `ally_description` text COLLATE latin1_general_ci NOT NULL,
  `ally_ext_page` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `ally_int_page` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ally_leader` text COLLATE latin1_general_ci NOT NULL,
  `ally_general` text COLLATE latin1_general_ci NOT NULL,
  `ally_minister` text COLLATE latin1_general_ci NOT NULL,
  `ally_diplo` text COLLATE latin1_general_ci NOT NULL,
  `ally_created` int(11) NOT NULL,
  `ally_founder` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ally_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alpha_alliance_users`
--

CREATE TABLE `alpha_alliance_users` (
  `user_id` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `ally_id` varchar(11) COLLATE latin1_general_ci NOT NULL,
  `user_rank` varchar(11) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



--
-- Table structure for table `alpha_army`
--

CREATE TABLE `alpha_army` (
  `city` int(11) NOT NULL,
  `army_line` varchar(255) CHARACTER SET utf8 NOT NULL,
  `army_start` int(11) NOT NULL,
  `ships_line` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ships_start` int(11) NOT NULL,
  `phalanx` int(11) NOT NULL,
  `steamgiant` int(11) NOT NULL,
  `spearman` int(11) NOT NULL,
  `swordsman` int(11) NOT NULL,
  `slinger` int(11) NOT NULL,
  `archer` int(11) NOT NULL,
  `marksman` int(11) NOT NULL,
  `ram` int(11) NOT NULL,
  `catapult` int(11) NOT NULL,
  `mortar` int(11) NOT NULL,
  `gyrocopter` int(11) NOT NULL,
  `bombardier` int(11) NOT NULL,
  `cook` int(11) NOT NULL,
  `medic` int(11) NOT NULL,
  `barbarian` int(11) NOT NULL,
  `ship_ram` int(11) NOT NULL,
  `ship_flamethrower` int(11) NOT NULL,
  `ship_steamboat` int(11) NOT NULL,
  `ship_ballista` int(11) NOT NULL,
  `ship_catapult` int(11) NOT NULL,
  `ship_mortar` int(11) NOT NULL,
  `ship_submarine` int(11) NOT NULL,
  `ship_transport` int(11) NOT NULL,
  PRIMARY KEY (`city`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `alpha_banners`
--

CREATE TABLE `alpha_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frame` text CHARACTER SET utf8 NOT NULL,
  `image` text CHARACTER SET utf8 NOT NULL,
  `link` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alpha_banners`
--


-- --------------------------------------------------------

--
-- Table structure for table `alpha_banners_right`
--

CREATE TABLE `alpha_banners_right` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frame` text CHARACTER SET utf8 NOT NULL,
  `image` text CHARACTER SET utf8 NOT NULL,
  `link` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alpha_banners_right`
--


-- --------------------------------------------------------

--
-- Table structure for table `alpha_double_login`
--

CREATE TABLE `alpha_double_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_from` int(11) NOT NULL,
  `account_to` int(11) NOT NULL,
  `login_time` int(11) NOT NULL,
  `ip_address` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`,`account_from`,`account_to`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alpha_double_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `alpha_islands`
--

CREATE TABLE `alpha_islands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'Island',
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `trade_resource` int(11) NOT NULL DEFAULT '3',
  `wonder` int(11) NOT NULL DEFAULT '0',
  `wood_level` int(11) NOT NULL DEFAULT '1',
  `trade_level` int(11) NOT NULL DEFAULT '1',
  `wood_count` int(11) NOT NULL DEFAULT '0',
  `trade_count` int(11) NOT NULL DEFAULT '0',
  `wood_start` int(11) NOT NULL DEFAULT '0',
  `trade_start` int(11) NOT NULL DEFAULT '0',
  `city0` int(11) NOT NULL DEFAULT '0',
  `city1` int(11) NOT NULL DEFAULT '0',
  `city2` int(11) NOT NULL DEFAULT '0',
  `city3` int(11) NOT NULL DEFAULT '0',
  `city4` int(11) NOT NULL DEFAULT '0',
  `city5` int(11) NOT NULL DEFAULT '0',
  `city6` int(11) NOT NULL DEFAULT '0',
  `city7` int(11) NOT NULL DEFAULT '0',
  `city8` int(11) NOT NULL DEFAULT '0',
  `city9` int(11) NOT NULL DEFAULT '0',
  `city10` int(11) NOT NULL DEFAULT '0',
  `city11` int(11) NOT NULL DEFAULT '0',
  `city12` int(11) NOT NULL DEFAULT '0',
  `city13` int(11) NOT NULL DEFAULT '0',
  `city14` int(11) NOT NULL DEFAULT '0',
  `city15` int(11) NOT NULL DEFAULT '0',
  `barbarian_village` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`name`,`x`,`y`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alpha_islands`
--

INSERT INTO `alpha_islands` VALUES(1, 'Buvios', 1, 1, 2, 4, 6, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(2, 'Angaios', 1, 4, 1, 4, 7, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(3, 'Queoos', 1, 8, 1, 3, 1, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(4, 'Kelatia', 1, 10, 5, 3, 4, 31, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(5, 'Buratia', 1, 17, 4, 3, 8, 8, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(6, 'Whoriios', 1, 18, 3, 4, 8, 10, 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(7, 'Taiuios', 1, 19, 2, 1, 1, 15, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(8, 'Horios', 1, 20, 2, 2, 4, 17, 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(9, 'Ageitia', 1, 21, 1, 1, 4, 21, 16, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(10, 'Verotia', 2, 2, 4, 4, 6, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(11, 'Sepaios', 2, 3, 5, 4, 5, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(12, 'Croicios', 2, 5, 5, 4, 5, 8, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(13, 'Revios', 2, 7, 2, 4, 8, 9, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(14, 'Rikios', 2, 9, 1, 1, 7, 12, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(15, 'Onaios', 2, 17, 5, 4, 6, 14, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(16, 'Iaaos', 2, 25, 2, 1, 7, 11, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(17, 'Burytia', 3, 2, 2, 2, 5, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(18, 'Blinaios', 3, 5, 3, 1, 2, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 179, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(19, 'Llaynios', 3, 8, 5, 1, 4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(20, 'Foyeos', 3, 13, 5, 1, 1, 12, 12, 0, 0, 0, 0, 131, 573, 384, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(21, 'Urneitia', 3, 17, 1, 4, 6, 19, 17, 0, 0, 0, 0, 44, 569, 52, 0, 0, 0, 643, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(22, 'Striwoios', 3, 23, 5, 2, 5, 11, 9, 0, 0, 0, 0, 430, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 662, 1);
INSERT INTO `alpha_islands` VALUES(23, 'Ineitia', 4, 7, 4, 2, 1, 23, 17, 190953, 0, 0, 0, 147, 0, 562, 0, 0, 731, 0, 0, 0, 0, 0, 343, 0, 122, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(24, 'Rouyios', 4, 8, 5, 1, 7, 11, 10, 0, 0, 0, 0, 434, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 125, 153, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(25, 'Nysetia', 4, 13, 1, 3, 5, 28, 21, 0, 0, 0, 0, 412, 568, 722, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(26, 'Likoios', 4, 14, 3, 2, 6, 38, 555, 0, 0, 0, 1338212083, 565, 0, 571, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 578, 0, 1);
INSERT INTO `alpha_islands` VALUES(27, 'Wubios', 4, 16, 1, 3, 4, 4, 4, 0, 0, 0, 0, 0, 0, 450, 0, 472, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(28, 'Mosautia', 4, 20, 1, 3, 5, 5, 12, 0, 0, 0, 0, 0, 531, 0, 0, 0, 0, 0, 0, 0, 0, 0, 539, 0, 642, 167, 214, 1);
INSERT INTO `alpha_islands` VALUES(29, 'Zenios', 4, 24, 1, 2, 8, 11, 10, 0, 0, 0, 0, 0, 0, 0, 0, 164, 0, 0, 0, 0, 0, 0, 162, 0, 149, 679, 0, 1);
INSERT INTO `alpha_islands` VALUES(30, 'Haunios', 5, 1, 5, 2, 6, 14, 7, 0, 0, 0, 0, 0, 0, 284, 0, 585, 0, 670, 0, 680, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(31, 'Threcios', 5, 2, 1, 4, 5, 3, 3, 0, 0, 0, 0, 0, 0, 391, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(32, 'Janios', 5, 3, 4, 4, 1, 2, 2, 0, 0, 0, 0, 0, 0, 273, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(33, 'Voigios', 5, 4, 4, 3, 8, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(34, 'Vohios', 5, 5, 1, 4, 6, 6, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(35, 'Whoocios', 5, 9, 3, 4, 5, 13, 12, 9099, 0, 0, 0, 487, 0, 0, 0, 690, 691, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(36, 'Daetios', 5, 16, 3, 1, 8, 3, 9, 606, 0, 0, 0, 81, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 474, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(37, 'Miluos', 5, 18, 5, 2, 3, 9, 3, 0, 0, 0, 0, 3, 0, 269, 0, 749, 0, 0, 0, 0, 0, 556, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(38, 'Urnoitia', 5, 23, 3, 1, 1, 3, 3, 0, 0, 0, 0, 53, 0, 276, 165, 0, 0, 0, 0, 0, 0, 0, 0, 203, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(39, 'Adaytia', 5, 25, 4, 1, 2, 2, 2, 0, 0, 0, 0, 107, 0, 763, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(40, 'Swoyuos', 6, 1, 1, 4, 8, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(41, 'Doruios', 6, 2, 5, 3, 7, 2, 2, 0, 0, 0, 0, 399, 0, 671, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 746, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(42, 'Urneos', 6, 7, 5, 3, 8, 15, 11, 0, 0, 0, 0, 102, 0, 604, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(43, 'Zhaisios', 6, 8, 1, 3, 5, 2, 2, 0, 0, 0, 0, 110, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 494, 0, 1);
INSERT INTO `alpha_islands` VALUES(44, 'Emuios', 6, 11, 2, 2, 3, 9, 5, 0, 0, 0, 0, 383, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(45, 'Reerios', 6, 14, 3, 3, 4, 2, 2, 0, 0, 0, 0, 577, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(46, 'Lauroos', 6, 17, 5, 2, 3, 3, 8, 606, 0, 0, 0, 473, 0, 518, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(47, 'Kimayos', 6, 19, 1, 3, 6, 2, 6, 0, 423, 0, 0, 7, 0, 129, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(48, 'Gyrios', 6, 22, 3, 4, 2, 2, 2, 0, 0, 0, 0, 219, 0, 715, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(49, 'Delytia', 6, 23, 4, 4, 2, 8, 6, 0, 0, 0, 0, 20, 0, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(50, 'Vymios', 6, 24, 1, 4, 2, 5, 6, 0, 7423, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(51, 'Ducaios', 7, 3, 3, 2, 7, 31, 19, 1258486, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(52, 'Wybios', 7, 5, 4, 1, 6, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(53, 'Oughatia', 7, 10, 5, 1, 3, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(54, 'Hatieos', 7, 12, 5, 2, 2, 19, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(55, 'Shyiaos', 7, 18, 4, 4, 1, 4, 5, 615, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(56, 'Duneios', 7, 20, 3, 4, 4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(57, 'Entheetia', 7, 23, 4, 4, 5, 8, 2, 0, 0, 0, 0, 0, 0, 360, 0, 534, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(58, 'Sholios', 8, 3, 4, 4, 8, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 751, 332, 0, 650, 1);
INSERT INTO `alpha_islands` VALUES(59, 'Tantuios', 8, 7, 5, 4, 8, 5, 3, 0, 0, 0, 0, 0, 0, 95, 0, 635, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(60, 'Ageoutia', 8, 9, 1, 1, 6, 2, 2, 0, 0, 0, 0, 0, 0, 521, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(61, 'Clauzaios', 8, 12, 4, 1, 2, 2, 2, 0, 0, 0, 0, 227, 0, 555, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(62, 'Taioos', 8, 14, 3, 4, 1, 4, 4, 0, 0, 0, 0, 103, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 352, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(63, 'Syfios', 8, 17, 4, 4, 1, 2, 2, 0, 0, 0, 0, 99, 0, 436, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(64, 'Veuweos', 8, 20, 5, 4, 1, 19, 5, 0, 0, 0, 0, 554, 0, 588, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(65, 'Schuirios', 8, 21, 5, 4, 2, 12, 6, 4522, 4423, 0, 0, 160, 0, 207, 0, 349, 0, 733, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(66, 'Atetia', 9, 1, 2, 1, 4, 2, 2, 0, 0, 0, 0, 39, 0, 478, 0, 657, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(67, 'Rovios', 9, 2, 2, 3, 5, 6, 2, 2212, 0, 0, 0, 370, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(68, 'Chroweios', 9, 3, 1, 1, 3, 2, 2, 0, 0, 0, 0, 594, 747, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 372, 649, 608, 1);
INSERT INTO `alpha_islands` VALUES(69, 'Quaylios', 9, 6, 5, 2, 4, 12, 8, 4312, 16630, 0, 0, 180, 0, 526, 0, 0, 0, 0, 0, 0, 212, 0, 0, 0, 0, 0, 528, 1);
INSERT INTO `alpha_islands` VALUES(70, 'Sninios', 9, 7, 1, 3, 7, 12, 6, 0, 0, 0, 0, 200, 0, 274, 0, 527, 0, 0, 0, 0, 0, 0, 0, 477, 0, 292, 0, 1);
INSERT INTO `alpha_islands` VALUES(71, 'Dakoos', 9, 9, 5, 4, 8, 2, 12, 0, 12355, 0, 0, 16, 0, 353, 0, 447, 0, 582, 118, 281, 0, 686, 0, 714, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(72, 'Honitia', 9, 10, 1, 3, 5, 4, 9, 0, 9002, 0, 0, 12, 0, 351, 0, 367, 0, 400, 0, 429, 0, 689, 0, 713, 126, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(73, 'Tehyios', 9, 14, 5, 4, 7, 2, 2, 0, 0, 0, 0, 437, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(74, 'Rahios', 9, 19, 2, 4, 4, 2, 2, 0, 0, 0, 0, 501, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(75, 'Uskeuos', 9, 22, 1, 3, 6, 2, 2, 0, 0, 0, 0, 79, 0, 500, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(76, 'Straidios', 9, 25, 3, 1, 4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(77, 'Sackyos', 10, 3, 5, 3, 8, 14, 12, 0, 65571, 0, 0, 666, 0, 667, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 202, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(78, 'Peroeos', 10, 4, 2, 3, 2, 2, 2, 0, 0, 0, 0, 26, 0, 220, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(79, 'Untutia', 10, 6, 2, 2, 4, 36, 29, 0, 0, 0, 0, 717, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(80, 'Smakios', 10, 8, 3, 1, 2, 4, 2, 0, 0, 0, 0, 448, 0, 469, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(81, 'Takios', 10, 9, 5, 1, 1, 19, 9, 70088, 9388, 0, 0, 551, 0, 681, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(82, 'Mosuos', 10, 10, 4, 2, 5, 8, 11, 0, 12846, 0, 0, 65, 92, 85, 0, 712, 0, 744, 0, 684, 0, 0, 0, 0, 0, 238, 0, 1);
INSERT INTO `alpha_islands` VALUES(83, 'Swauxuos', 10, 17, 2, 1, 6, 4, 2, 1614, 0, 0, 0, 10, 0, 398, 0, 402, 0, 466, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(84, 'Tysoios', 10, 22, 5, 3, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(85, 'Wotios', 11, 9, 4, 1, 5, 8, 2, 1065, 0, 0, 0, 620, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(86, 'Lihios', 11, 11, 3, 3, 5, 2, 8, 0, 2053, 0, 0, 232, 0, 357, 0, 365, 0, 496, 0, 732, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(87, 'Samootia', 11, 13, 4, 4, 2, 6, 2, 0, 0, 0, 0, 173, 0, 458, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(88, 'Ildetia', 11, 14, 3, 4, 5, 2, 2, 0, 0, 0, 0, 366, 0, 529, 0, 606, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(89, 'Yeritia', 11, 15, 3, 3, 6, 2, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 753, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(90, 'Soixios', 11, 16, 1, 3, 8, 2, 2, 0, 0, 0, 0, 1, 0, 508, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(91, 'Aleeos', 11, 18, 4, 4, 4, 2, 2, 0, 0, 0, 0, 96, 0, 278, 0, 552, 0, 658, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(92, 'Silios', 11, 23, 5, 3, 5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(93, 'Royios', 11, 25, 5, 3, 3, 2, 2, 0, 0, 0, 0, 410, 0, 685, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(94, 'Engoios', 12, 1, 5, 2, 1, 38, 26, 6011000, 0, 0, 0, 77, 0, 241, 0, 240, 296, 290, 139, 325, 0, 0, 195, 0, 235, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(95, 'Skeloos', 12, 2, 1, 3, 1, 19, 18, 0, 0, 0, 0, 0, 0, 0, 0, 611, 0, 0, 0, 0, 0, 0, 0, 297, 124, 293, 396, 1);
INSERT INTO `alpha_islands` VALUES(96, 'Fuyyos', 12, 8, 4, 1, 6, 2, 2, 0, 0, 0, 0, 737, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(97, 'Cedios', 12, 14, 2, 2, 1, 18, 12, 0, 0, 0, 0, 111, 0, 675, 0, 752, 0, 0, 0, 0, 0, 0, 0, 0, 105, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(98, 'Snoduos', 12, 18, 3, 3, 6, 2, 2, 0, 0, 0, 0, 130, 0, 379, 0, 584, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(99, 'Cosios', 12, 19, 3, 4, 8, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 233, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(100, 'Untyos', 12, 20, 4, 3, 8, 11, 5, 0, 0, 0, 0, 172, 0, 272, 0, 346, 0, 381, 0, 523, 0, 647, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(101, 'Threkios', 12, 22, 1, 2, 2, 2, 2, 0, 0, 0, 0, 62, 0, 108, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(102, 'Josios', 12, 23, 1, 4, 2, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(103, 'Lleuhuos', 12, 25, 3, 4, 7, 31, 20, 112137, 305430, 0, 0, 449, 0, 498, 0, 668, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(104, 'Seyckoos', 13, 3, 2, 2, 1, 259, 63, 0, 0, 1348406852, 1348406852, 394, 0, 549, 621, 583, 0, 599, 295, 720, 0, 609, 0, 634, 190, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(105, 'Bloenios', 13, 7, 2, 4, 7, 2, 2, 0, 0, 0, 0, 1, 0, 46, 0, 229, 0, 359, 0, 389, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(106, 'Nusiios', 13, 8, 5, 2, 2, 3, 4, 0, 0, 0, 0, 91, 0, 208, 0, 0, 0, 403, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(107, 'Kuchiios', 13, 11, 5, 4, 4, 9, 9, 4926, 9965, 0, 0, 93, 0, 236, 0, 388, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(108, 'Shyitia', 13, 12, 5, 4, 2, 22, 14, 33313, 5117, 0, 0, 669, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(109, 'Layiios', 13, 13, 5, 4, 4, 9, 8, 4926, 10183, 0, 0, 75, 0, 264, 0, 0, 0, 0, 0, 0, 0, 740, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(110, 'Angouos', 13, 18, 5, 2, 8, 3, 6, 0, 0, 0, 0, 213, 0, 0, 0, 0, 0, 705, 181, 0, 758, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(111, 'Dagios', 13, 19, 5, 3, 1, 25, 10, 115884, 0, 0, 0, 86, 0, 158, 0, 201, 0, 574, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(112, 'Nauyios', 13, 20, 1, 3, 8, 22, 9, 243000, 0, 0, 0, 76, 0, 392, 0, 506, 0, 567, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(113, 'Dagios', 13, 21, 4, 2, 1, 13, 7, 0, 0, 0, 0, 211, 524, 442, 377, 570, 0, 597, 0, 0, 0, 0, 728, 0, 171, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(114, 'Sluzios', 13, 22, 5, 3, 5, 2, 2, 0, 0, 0, 0, 288, 0, 725, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(115, 'Nautoos', 13, 25, 2, 2, 7, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(116, 'Echotia', 14, 1, 1, 2, 1, 8, 12, 0, 0, 0, 0, 104, 242, 243, 0, 244, 0, 558, 563, 0, 0, 0, 0, 0, 199, 312, 0, 1);
INSERT INTO `alpha_islands` VALUES(117, 'Athytia', 14, 2, 3, 3, 4, 26, 19, 563000, 0, 0, 0, 188, 617, 457, 245, 580, 0, 672, 0, 0, 0, 0, 283, 0, 246, 0, 622, 1);
INSERT INTO `alpha_islands` VALUES(118, 'Cukios', 14, 3, 1, 1, 4, 24, 20, 330935, 0, 0, 0, 146, 602, 275, 623, 260, 0, 362, 0, 520, 0, 559, 0, 0, 151, 338, 294, 1);
INSERT INTO `alpha_islands` VALUES(119, 'Zukyos', 14, 5, 5, 1, 7, 25, 16, 232600, 0, 0, 0, 205, 0, 683, 0, 0, 0, 0, 0, 303, 0, 302, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(120, 'Aruos', 14, 6, 4, 2, 5, 23, 17, 49999, 90999, 0, 0, 189, 0, 225, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(121, 'Staltaos', 14, 10, 4, 2, 5, 2, 2, 0, 0, 0, 0, 313, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(122, 'Kaisios', 14, 17, 4, 3, 1, 6, 2, 97, 0, 0, 0, 83, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(123, 'Deleios', 14, 20, 2, 1, 2, 2, 2, 0, 0, 0, 0, 262, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(124, 'Bluldios', 14, 22, 2, 4, 5, 7, 2, 0, 0, 0, 0, 382, 0, 750, 729, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(125, 'Enoitia', 14, 24, 5, 3, 4, 7, 5, 0, 0, 0, 0, 8, 0, 605, 0, 0, 0, 0, 0, 0, 0, 375, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(126, 'Umyos', 14, 25, 4, 2, 4, 17, 17, 34436, 5188, 0, 0, 14, 0, 38, 0, 56, 0, 74, 0, 112, 0, 0, 451, 0, 452, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(127, 'Brivios', 15, 4, 4, 4, 8, 22, 10, 0, 0, 0, 0, 58, 603, 194, 183, 397, 0, 509, 0, 553, 0, 327, 192, 298, 228, 709, 618, 1);
INSERT INTO `alpha_islands` VALUES(128, 'Gerios', 15, 6, 4, 4, 4, 11, 7, 0, 0, 0, 0, 505, 0, 519, 204, 0, 0, 0, 0, 0, 0, 0, 0, 0, 254, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(129, 'Dynatia', 15, 8, 4, 4, 6, 2, 2, 0, 0, 0, 0, 651, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(130, 'Aughatia', 15, 9, 1, 1, 7, 11, 8, 6000, 0, 0, 0, 89, 0, 209, 0, 368, 0, 431, 0, 533, 0, 612, 0, 768, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(131, 'Gepios', 15, 11, 5, 2, 5, 4, 4, 0, 99495, 0, 1350070836, 317, 0, 510, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 386, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(132, 'Staugios', 15, 12, 2, 1, 6, 2, 2, 0, 0, 0, 0, 342, 0, 652, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(133, 'Llisyios', 15, 13, 2, 2, 4, 4, 7, 0, 0, 0, 0, 735, 0, 739, 0, 770, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(134, 'Killoos', 15, 14, 2, 1, 5, 3, 4, 0, 0, 0, 0, 286, 0, 0, 0, 0, 0, 0, 0, 0, 754, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(135, 'Slijios', 15, 17, 4, 3, 8, 2, 2, 0, 0, 0, 0, 29, 0, 48, 0, 590, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(136, 'Smounaos', 15, 19, 1, 3, 1, 2, 4, 0, 0, 0, 0, 350, 0, 413, 0, 0, 0, 0, 0, 0, 0, 0, 759, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(137, 'Lluisaos', 15, 20, 4, 1, 7, 15, 9, 26999, 16388, 0, 0, 704, 0, 0, 762, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(138, 'Yerytia', 15, 21, 2, 4, 4, 14, 11, 16061, 18234, 0, 0, 321, 0, 354, 0, 761, 0, 0, 0, 0, 0, 0, 706, 169, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(139, 'Toneaos', 15, 23, 5, 4, 5, 18, 15, 234, 0, 0, 0, 376, 0, 764, 0, 0, 0, 0, 0, 0, 0, 484, 0, 0, 344, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(140, 'Ritaos', 15, 24, 3, 1, 7, 5, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(141, 'Zhecios', 16, 1, 4, 3, 2, 34, 16, 0, 0, 0, 0, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 616, 0, 1);
INSERT INTO `alpha_islands` VALUES(142, 'Echuitia', 16, 3, 1, 4, 4, 7, 5, 0, 0, 0, 0, 459, 0, 0, 0, 0, 0, 765, 0, 0, 0, 560, 0, 311, 0, 49, 223, 1);
INSERT INTO `alpha_islands` VALUES(143, 'Yimios', 16, 4, 4, 2, 2, 5, 4, 0, 0, 0, 0, 57, 140, 0, 141, 0, 0, 655, 766, 561, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(144, 'Ageotia', 16, 6, 1, 2, 5, 9, 9, 6540, 4388, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(145, 'Nysaeos', 16, 8, 4, 2, 7, 29, 27, 0, 0, 0, 0, 152, 0, 0, 0, 0, 0, 465, 461, 673, 0, 677, 224, 699, 261, 693, 700, 1);
INSERT INTO `alpha_islands` VALUES(146, 'Phojios', 16, 9, 3, 3, 6, 3, 10, 0, 0, 0, 0, 28, 702, 337, 718, 628, 698, 416, 0, 701, 741, 462, 347, 440, 696, 486, 640, 1);
INSERT INTO `alpha_islands` VALUES(147, 'Oldooos', 16, 13, 3, 1, 1, 24, 13, 0, 0, 0, 0, 287, 0, 385, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(148, 'Nedios', 16, 17, 4, 3, 7, 5, 2, 0, 0, 0, 0, 2, 0, 258, 0, 340, 0, 428, 0, 456, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(149, 'Issaos', 16, 19, 4, 1, 1, 7, 6, 0, 0, 0, 0, 163, 0, 755, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(150, 'Aughuos', 16, 21, 2, 3, 8, 2, 2, 0, 0, 0, 0, 63, 0, 579, 0, 726, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(151, 'Rabios', 16, 22, 1, 2, 8, 16, 19, 0, 227666, 0, 0, 94, 0, 109, 0, 601, 0, 723, 0, 0, 0, 0, 0, 0, 326, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(152, 'Esteutia', 16, 23, 5, 1, 1, 34, 25, 375000, 0, 0, 0, 120, 0, 547, 632, 734, 0, 0, 0, 0, 0, 0, 0, 633, 625, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(153, 'Imaytia', 16, 24, 2, 2, 2, 26, 17, 466800, 0, 0, 0, 170, 0, 373, 0, 387, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(154, 'Wavios', 17, 2, 4, 4, 7, 2, 2, 0, 0, 0, 0, 490, 0, 517, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 215, 1);
INSERT INTO `alpha_islands` VALUES(155, 'Trodyos', 17, 5, 1, 2, 7, 34, 25, 1082376, 1226166, 0, 0, 35, 37, 70, 114, 34, 0, 230, 247, 255, 259, 446, 0, 30, 4, 24, 9, 1);
INSERT INTO `alpha_islands` VALUES(156, 'Enieos', 17, 7, 1, 2, 4, 20, 19, 0, 195000, 0, 0, 6, 638, 40, 645, 433, 646, 548, 0, 0, 0, 0, 0, 445, 444, 0, 641, 1);
INSERT INTO `alpha_islands` VALUES(157, 'Layrios', 17, 8, 5, 4, 3, 13, 14, 1099, 62656, 0, 0, 128, 0, 0, 697, 0, 0, 253, 0, 0, 0, 0, 639, 0, 0, 443, 0, 1);
INSERT INTO `alpha_islands` VALUES(158, 'Voofios', 17, 9, 1, 1, 3, 29, 18, 0, 0, 0, 0, 637, 0, 767, 0, 0, 0, 257, 0, 0, 0, 0, 0, 0, 695, 439, 492, 1);
INSERT INTO `alpha_islands` VALUES(159, 'Oriaos', 17, 11, 5, 2, 7, 14, 14, 15973, 27656, 0, 0, 106, 0, 401, 0, 480, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(160, 'Swaishoios', 17, 12, 1, 4, 2, 4, 2, 0, 0, 0, 0, 66, 0, 393, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 322, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(161, 'Beyreios', 17, 14, 3, 4, 4, 20, 17, 0, 0, 0, 0, 0, 0, 0, 0, 123, 0, 0, 0, 0, 0, 0, 418, 0, 231, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(162, 'Burauos', 17, 17, 5, 1, 5, 31, 20, 0, 0, 0, 0, 69, 0, 390, 0, 499, 0, 644, 0, 0, 0, 0, 0, 414, 197, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(163, 'Zyhiios', 17, 18, 4, 3, 8, 25, 16, 0, 0, 0, 0, 47, 0, 512, 155, 550, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 196, 1);
INSERT INTO `alpha_islands` VALUES(164, 'Llafios', 17, 23, 2, 2, 2, 14, 7, 0, 0, 0, 0, 629, 0, 631, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(165, 'Smaeghiios', 17, 25, 3, 3, 5, 2, 7, 0, 3386, 0, 0, 136, 0, 525, 0, 661, 0, 721, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(166, 'Ashaos', 18, 2, 3, 4, 5, 24, 13, 0, 0, 0, 0, 42, 0, 316, 0, 423, 0, 710, 0, 719, 0, 0, 0, 0, 615, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(167, 'Drorios', 18, 11, 1, 2, 5, 14, 5, 0, 0, 0, 0, 127, 0, 315, 0, 336, 0, 369, 0, 406, 0, 454, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(168, 'Wutios', 18, 12, 5, 1, 8, 8, 2, 0, 0, 0, 0, 318, 0, 356, 0, 467, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(169, 'Nysytia', 18, 13, 2, 2, 4, 2, 2, 0, 0, 0, 0, 589, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(170, 'Solios', 18, 14, 1, 2, 5, 1, 1, 0, 0, 1350315481, 0, 221, 0, 724, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(171, 'Caniios', 18, 16, 4, 3, 6, 13, 10, 13099, 17639, 0, 0, 33, 0, 576, 417, 0, 0, 0, 0, 0, 0, 0, 0, 0, 291, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(172, 'Chaeitia', 18, 17, 2, 2, 7, 37, 27, 192333, 581000, 0, 0, 0, 0, 60, 0, 72, 0, 0, 0, 419, 0, 289, 0, 117, 267, 174, 265, 1);
INSERT INTO `alpha_islands` VALUES(173, 'Llocoios', 18, 18, 4, 2, 2, 2, 2, 0, 0, 0, 0, 536, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 546, 0, 1);
INSERT INTO `alpha_islands` VALUES(174, 'Wareatia', 18, 21, 3, 3, 1, 11, 9, 12790, 9388, 0, 0, 50, 0, 0, 0, 743, 0, 0, 193, 0, 0, 0, 0, 0, 206, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(175, 'Woretia', 18, 24, 2, 3, 2, 14, 17, 0, 532, 0, 0, 90, 0, 0, 0, 0, 0, 736, 0, 0, 0, 0, 0, 483, 341, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(176, 'Lliaruios', 18, 25, 5, 2, 4, 19, 13, 36854, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 489, 0, 515, 339, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(177, 'Enaeos', 19, 1, 3, 4, 8, 2, 2, 0, 0, 0, 0, 581, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(178, 'Phynaos', 19, 2, 3, 1, 3, 15, 15, 0, 0, 0, 0, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 614, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(179, 'Clizios', 19, 3, 4, 2, 7, 20, 18, 0, 0, 0, 0, 32, 0, 0, 0, 530, 0, 610, 0, 738, 0, 0, 424, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(180, 'Leiboios', 19, 4, 3, 2, 5, 2, 11, 0, 364, 0, 0, 87, 0, 177, 0, 0, 0, 0, 420, 0, 0, 0, 0, 0, 0, 185, 299, 1);
INSERT INTO `alpha_islands` VALUES(181, 'Newios', 19, 6, 2, 3, 6, 6, 11, 0, 0, 0, 0, 176, 0, 0, 0, 0, 0, 0, 374, 307, 305, 408, 237, 304, 45, 252, 217, 1);
INSERT INTO `alpha_islands` VALUES(182, 'Dopyios', 19, 10, 3, 1, 8, 2, 2, 0, 0, 0, 0, 54, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(183, 'Fusios', 19, 12, 5, 2, 3, 2, 2, 0, 0, 0, 0, 266, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(184, 'Zaujios', 19, 16, 5, 2, 7, 2, 2, 0, 0, 0, 0, 427, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(185, 'Aduos', 19, 20, 2, 2, 3, 17, 13, 61844, 0, 0, 0, 61, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 166, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(186, 'Rhoesios', 19, 25, 2, 1, 5, 23, 17, 162008, 0, 0, 0, 0, 0, 334, 0, 511, 0, 654, 0, 0, 0, 0, 0, 488, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(187, 'Oreos', 20, 2, 3, 4, 1, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 222, 0, 1);
INSERT INTO `alpha_islands` VALUES(188, 'Taweios', 20, 5, 2, 1, 1, 6, 6, 0, 0, 0, 0, 43, 134, 0, 143, 142, 0, 0, 0, 0, 0, 0, 0, 0, 132, 36, 135, 1);
INSERT INTO `alpha_islands` VALUES(189, 'Oughyos', 20, 9, 3, 1, 1, 8, 2, 4679, 0, 0, 0, 330, 0, 0, 0, 653, 0, 0, 218, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(190, 'Recios', 20, 13, 1, 1, 2, 2, 2, 0, 0, 0, 0, 121, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(191, 'Rookios', 20, 17, 5, 1, 4, 2, 2, 0, 0, 0, 0, 210, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(192, 'Sossyos', 20, 18, 1, 2, 6, 2, 2, 0, 0, 0, 0, 279, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(193, 'Drichuos', 20, 22, 1, 1, 4, 25, 19, 281954, 0, 0, 0, 21, 0, 27, 0, 363, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);
INSERT INTO `alpha_islands` VALUES(194, 'Neyduos', 20, 25, 2, 1, 8, 2, 2, 0, 0, 0, 0, 68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `alpha_missions`
--

CREATE TABLE `alpha_missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `loading_from_start` int(11) NOT NULL,
  `loading_to_start` int(11) NOT NULL,
  `mission_type` int(11) NOT NULL,
  `mission_start` int(11) NOT NULL,
  `return_start` int(11) NOT NULL,
  `wood` int(11) NOT NULL,
  `wine` int(11) NOT NULL,
  `marble` int(11) NOT NULL,
  `crystal` int(11) NOT NULL,
  `sulfur` int(11) NOT NULL,
  `gold` int(11) NOT NULL DEFAULT '0',
  `peoples` int(11) NOT NULL,
  `phalanx` int(11) NOT NULL,
  `steamgiant` int(11) NOT NULL,
  `spearman` int(11) NOT NULL,
  `swordsman` int(11) NOT NULL,
  `slinger` int(11) NOT NULL,
  `archer` int(11) NOT NULL,
  `marksman` int(11) NOT NULL,
  `ram` int(11) NOT NULL,
  `catapult` int(11) NOT NULL,
  `mortar` int(11) NOT NULL,
  `gyrocopter` int(11) NOT NULL,
  `bombardier` int(11) NOT NULL,
  `cook` int(11) NOT NULL,
  `medic` int(11) NOT NULL,
  `barbarian` int(11) NOT NULL,
  `ship_ram` int(11) NOT NULL,
  `ship_flamethrower` int(11) NOT NULL,
  `ship_steamboat` int(11) NOT NULL,
  `ship_ballista` int(11) NOT NULL,
  `ship_catapult` int(11) NOT NULL,
  `ship_mortar` int(11) NOT NULL,
  `ship_submarine` int(11) NOT NULL,
  `ship_transport` int(11) NOT NULL,
  `percent` varchar(11) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `trade_wood_count` int(11) NOT NULL,
  `trade_wine_count` int(11) NOT NULL,
  `trade_marble_count` int(11) NOT NULL,
  `trade_crystal_count` int(11) NOT NULL,
  `trade_sulfur_count` int(11) NOT NULL,
  `trade_gold_count` int(11) NOT NULL,
  `trade_wood_cost` int(11) NOT NULL,
  `trade_wine_cost` int(11) NOT NULL,
  `trade_marble_cost` int(11) NOT NULL,
  `trade_crystal_cost` int(11) NOT NULL,
  `trade_sulfur_cost` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user`,`from`,`to`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alpha_notes`
--

CREATE TABLE `alpha_notes` (
  `user` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alpha_notes`
--

-- --------------------------------------------------------

--
-- Table structure for table `alpha_research`
--

CREATE TABLE `alpha_research` (
  `user` int(11) NOT NULL,
  `points` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `res1_1` int(11) NOT NULL,
  `res1_2` int(11) NOT NULL,
  `res1_3` int(11) NOT NULL,
  `res1_4` int(11) NOT NULL,
  `res1_5` int(11) NOT NULL,
  `res1_6` int(11) NOT NULL,
  `res1_7` int(11) NOT NULL,
  `res1_8` int(11) NOT NULL,
  `res1_9` int(11) NOT NULL,
  `res1_10` int(11) NOT NULL,
  `res1_11` int(11) NOT NULL,
  `res1_12` int(11) NOT NULL,
  `res1_13` int(11) NOT NULL,
  `res1_14` int(11) NOT NULL,
  `res2_1` int(11) NOT NULL,
  `res2_2` int(11) NOT NULL,
  `res2_3` int(11) NOT NULL,
  `res2_4` int(11) NOT NULL,
  `res2_5` int(11) NOT NULL,
  `res2_6` int(11) NOT NULL,
  `res2_7` int(11) NOT NULL,
  `res2_8` int(11) NOT NULL,
  `res2_9` int(11) NOT NULL,
  `res2_10` int(11) NOT NULL,
  `res2_11` int(11) NOT NULL,
  `res2_12` int(11) NOT NULL,
  `res2_13` int(11) NOT NULL,
  `res2_14` int(11) NOT NULL,
  `res2_15` int(11) NOT NULL,
  `res3_1` int(11) NOT NULL,
  `res3_2` int(11) NOT NULL,
  `res3_3` int(11) NOT NULL,
  `res3_4` int(11) NOT NULL,
  `res3_5` int(11) NOT NULL,
  `res3_6` int(11) NOT NULL,
  `res3_7` int(11) NOT NULL,
  `res3_8` int(11) NOT NULL,
  `res3_9` int(11) NOT NULL,
  `res3_10` int(11) NOT NULL,
  `res3_11` int(11) NOT NULL,
  `res3_12` int(11) NOT NULL,
  `res3_13` int(11) NOT NULL,
  `res3_14` int(11) NOT NULL,
  `res3_15` int(11) NOT NULL,
  `res3_16` int(11) NOT NULL,
  `res4_1` int(11) NOT NULL,
  `res4_2` int(11) NOT NULL,
  `res4_3` int(11) NOT NULL,
  `res4_4` int(11) NOT NULL,
  `res4_5` int(11) NOT NULL,
  `res4_6` int(11) NOT NULL,
  `res4_7` int(11) NOT NULL,
  `res4_8` int(11) NOT NULL,
  `res4_9` int(11) NOT NULL,
  `res4_10` int(11) NOT NULL,
  `res4_11` int(11) NOT NULL,
  `res4_12` int(11) NOT NULL,
  `res4_13` int(11) NOT NULL,
  `res4_14` int(11) NOT NULL,
  `way1_checked` int(11) NOT NULL,
  `way2_checked` int(11) NOT NULL,
  `way3_checked` int(11) NOT NULL,
  `way4_checked` int(11) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alpha_spyes`
--

CREATE TABLE `alpha_spyes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `risk` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  `mission_type` int(11) NOT NULL,
  `mission_start` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user`,`from`,`to`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Table structure for table `alpha_spy_messages`
--

CREATE TABLE `alpha_spy_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `spy` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `mission` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `desc` text CHARACTER SET utf8 NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `checked` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user`,`spy`,`from`,`to`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Table structure for table `alpha_towns`
--

CREATE TABLE `alpha_towns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `island` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `last_update` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'Polis',
  `wood` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '500',
  `wine` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `marble` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `crystal` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `sulfur` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `pos0_type` int(11) NOT NULL DEFAULT '1',
  `pos0_level` int(11) NOT NULL DEFAULT '1',
  `pos1_type` int(11) NOT NULL DEFAULT '0',
  `pos1_level` int(11) NOT NULL DEFAULT '0',
  `pos2_type` int(11) NOT NULL DEFAULT '0',
  `pos2_level` int(11) NOT NULL DEFAULT '0',
  `pos3_type` int(11) NOT NULL DEFAULT '0',
  `pos3_level` int(11) NOT NULL DEFAULT '0',
  `pos4_type` int(11) NOT NULL DEFAULT '0',
  `pos4_level` int(11) NOT NULL DEFAULT '0',
  `pos5_type` int(11) NOT NULL DEFAULT '0',
  `pos5_level` int(11) NOT NULL DEFAULT '0',
  `pos6_type` int(11) NOT NULL DEFAULT '0',
  `pos6_level` int(11) NOT NULL DEFAULT '0',
  `pos7_type` int(11) NOT NULL DEFAULT '0',
  `pos7_level` int(11) NOT NULL DEFAULT '0',
  `pos8_type` int(11) NOT NULL DEFAULT '0',
  `pos8_level` int(11) NOT NULL DEFAULT '0',
  `pos9_type` int(11) NOT NULL DEFAULT '0',
  `pos9_level` int(11) NOT NULL,
  `pos10_type` int(11) NOT NULL DEFAULT '0',
  `pos10_level` int(11) NOT NULL DEFAULT '0',
  `pos11_type` int(11) NOT NULL DEFAULT '0',
  `pos11_level` int(11) NOT NULL DEFAULT '0',
  `pos12_type` int(11) NOT NULL DEFAULT '0',
  `pos12_level` int(11) NOT NULL DEFAULT '0',
  `pos13_type` int(11) NOT NULL DEFAULT '0',
  `pos13_level` int(11) NOT NULL DEFAULT '0',
  `pos14_type` int(11) NOT NULL DEFAULT '0',
  `pos14_level` int(11) NOT NULL DEFAULT '0',
  `build_line` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `build_start` int(11) NOT NULL DEFAULT '0',
  `peoples` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '40',
  `workers` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `tradegood` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `scientists` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `templer` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `spyes` int(11) NOT NULL,
  `spyes_start` int(11) NOT NULL,
  `workers_wood` int(11) NOT NULL DEFAULT '0',
  `tradegood_wood` int(11) NOT NULL DEFAULT '0',
  `actions` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '3',
  `tavern_wine` int(11) NOT NULL DEFAULT '0',
  `branch_search_type` int(11) NOT NULL DEFAULT '0',
  `branch_search_resource` int(11) NOT NULL DEFAULT '0',
  `branch_search_radius` int(11) NOT NULL DEFAULT '1',
  `branch_trade_wood_type` int(11) NOT NULL DEFAULT '1',
  `branch_trade_wine_type` int(11) NOT NULL DEFAULT '1',
  `branch_trade_marble_type` int(11) NOT NULL DEFAULT '1',
  `branch_trade_crystal_type` int(11) NOT NULL DEFAULT '1',
  `branch_trade_sulfur_type` int(11) NOT NULL DEFAULT '1',
  `branch_trade_wood_count` int(11) NOT NULL DEFAULT '0',
  `branch_trade_wine_count` int(11) NOT NULL DEFAULT '0',
  `branch_trade_marble_count` int(11) NOT NULL DEFAULT '0',
  `branch_trade_crystal_count` int(11) NOT NULL DEFAULT '0',
  `branch_trade_sulfur_count` int(11) NOT NULL DEFAULT '0',
  `branch_trade_wood_cost` int(11) NOT NULL DEFAULT '0',
  `branch_trade_wine_cost` int(11) NOT NULL DEFAULT '0',
  `branch_trade_marble_cost` int(11) NOT NULL DEFAULT '0',
  `branch_trade_crystal_cost` int(11) NOT NULL DEFAULT '0',
  `branch_trade_sulfur_cost` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`user`,`island`,`position`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Table structure for table `alpha_town_messages`
--

CREATE TABLE `alpha_town_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `town` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `checked` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`user`,`town`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `alpha_trade_routes`
--

CREATE TABLE `alpha_trade_routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `start_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `send_resource` int(11) NOT NULL,
  `send_time` int(11) NOT NULL,
  `send_count` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user`,`from`,`to`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `alpha_users`
--

CREATE TABLE `alpha_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `register_key` varchar(255) CHARACTER SET utf8 NOT NULL,
  `register_complete` int(11) NOT NULL DEFAULT '0',
  `last_visit` int(11) NOT NULL,
  `double_login` int(11) NOT NULL DEFAULT '0',
  `blocked_time` int(11) NOT NULL DEFAULT '0',
  `blocked_why` text CHARACTER SET utf8 NOT NULL,
  `town` int(11) NOT NULL,
  `capital` int(11) NOT NULL,
  `gold` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '100',
  `ambrosy` int(11) NOT NULL DEFAULT '50',
  `transports` int(11) NOT NULL DEFAULT '0',
  `tutorial` int(11) NOT NULL DEFAULT '0',
  `premium_account` int(11) NOT NULL DEFAULT '0',
  `premium_wood` int(11) NOT NULL DEFAULT '0',
  `premium_marble` int(11) NOT NULL DEFAULT '0',
  `premium_sulfur` int(11) NOT NULL DEFAULT '0',
  `premium_crystal` int(11) NOT NULL DEFAULT '0',
  `premium_wine` int(11) NOT NULL DEFAULT '0',
  `premium_capacity` int(11) NOT NULL DEFAULT '0',
  `options_select` int(11) NOT NULL DEFAULT '1',
  `points` float(11,0) NOT NULL DEFAULT '0',
  `points_buildings` float(11,0) NOT NULL DEFAULT '0',
  `points_levels` float(11,0) NOT NULL DEFAULT '0',
  `points_peoples` float(11,0) NOT NULL DEFAULT '0',
  `points_research` float(11,0) NOT NULL DEFAULT '0',
  `points_complete` float(11,0) NOT NULL DEFAULT '0',
  `points_army` float(11,0) NOT NULL DEFAULT '0',
  `points_gold` float(11,0) NOT NULL DEFAULT '0',
  `points_transports` float(11,0) NOT NULL DEFAULT '0',
  `punti_diplo` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`login`,`town`,`capital`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Table structure for table `alpha_user_messages`
--

CREATE TABLE `alpha_user_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `checked_from` int(11) NOT NULL,
  `checked_to` int(11) NOT NULL,
  `deleted_from` int(11) NOT NULL,
  `deleted_to` int(11) NOT NULL,
  `archived_from` int(11) NOT NULL,
  `archived_to` int(11) NOT NULL,
  PRIMARY KEY (`id`,`from`,`to`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;