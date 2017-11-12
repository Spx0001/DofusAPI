/*
Navicat MariaDB Data Transfer

Source Server         : Developpement
Source Server Version : 100210
Source Host           : 192.168.99.100:32770
Source Database       : dofusapi

Target Server Type    : MariaDB
Target Server Version : 100210
File Encoding         : 65001

Date: 2017-11-12 23:27:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for accounts_informations
-- ----------------------------
DROP TABLE IF EXISTS `accounts_informations`;
CREATE TABLE `accounts_informations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountId` int(11) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `birthDate` timestamp NULL DEFAULT NULL,
  `sex` text DEFAULT NULL,
  `lang` text DEFAULT NULL,
  `newsletter` text DEFAULT NULL,
  `knowGame` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of accounts_informations
-- ----------------------------

-- ----------------------------
-- Table structure for answers
-- ----------------------------
DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` varchar(255) DEFAULT NULL,
  `cmntt` enum('de','en','es','fr','it','nl','pt') DEFAULT 'fr',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of answers
-- ----------------------------

-- ----------------------------
-- Table structure for gifts
-- ----------------------------
DROP TABLE IF EXISTS `gifts`;
CREATE TABLE `gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `gift` enum('abra','bouloute','croum','dragodinde','dragoune_rose','Feanor','fotome','mini_wa','minimino','Pandala','scarador','tifoux','Tifoux_de_glace','willy') DEFAULT NULL,
  `cmntt` enum('de','en','es','fr','it','nl','pt') DEFAULT 'fr',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gifts
-- ----------------------------

-- ----------------------------
-- Table structure for rss
-- ----------------------------
DROP TABLE IF EXISTS `rss`;
CREATE TABLE `rss` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `icon` enum('Reboot','Dedicaces','News','Event','Shop','Maintenance','Contest','Sondage','Update') DEFAULT 'News',
  `cmntt` enum('de','en','es','fr','it','nl','pt') DEFAULT 'fr',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rss
-- ----------------------------

-- ----------------------------
-- Table structure for serverstatus
-- ----------------------------
DROP TABLE IF EXISTS `serverstatus`;
CREATE TABLE `serverstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` enum('1','2','3') DEFAULT NULL,
  `type` enum('1','2','3','4','5') DEFAULT NULL,
  `visible` int(1) DEFAULT 0,
  `cnx` int(1) DEFAULT 0,
  `servers` text DEFAULT NULL,
  `cmntt` enum('de','en','es','fr','it','nl','pt') DEFAULT 'fr',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of serverstatus
-- ----------------------------

-- ----------------------------
-- Table structure for serverstatus_problems
-- ----------------------------
DROP TABLE IF EXISTS `serverstatus_problems`;
CREATE TABLE `serverstatus_problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` int(11) NOT NULL,
  `event` enum('1','2') DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `translated` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_status` (`id_status`),
  CONSTRAINT `serverstatus_problems_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `serverstatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of serverstatus_problems
-- ----------------------------
