/*
Navicat MySQL Data Transfer

Source Server         : localhoat
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : arz

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-09-29 22:44:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bank
-- ----------------------------
DROP TABLE IF EXISTS `bank`;
CREATE TABLE `bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trid` int(11) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `close` tinyint(1) NOT NULL,
  `bank_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `response_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bank
-- ----------------------------

-- ----------------------------
-- Table structure for bid
-- ----------------------------
DROP TABLE IF EXISTS `bid`;
CREATE TABLE `bid` (
  `bid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned DEFAULT NULL,
  `tbl` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of bid
-- ----------------------------
INSERT INTO `bid` VALUES ('1', '2', '1');
INSERT INTO `bid` VALUES ('2', '3', '1');
INSERT INTO `bid` VALUES ('3', '3', '2');
INSERT INTO `bid` VALUES ('4', '4', '2');
INSERT INTO `bid` VALUES ('5', '12', '3');
INSERT INTO `bid` VALUES ('6', '5', '2');
INSERT INTO `bid` VALUES ('7', '13', '3');
INSERT INTO `bid` VALUES ('8', '6', '2');
INSERT INTO `bid` VALUES ('9', '14', '3');
INSERT INTO `bid` VALUES ('10', '7', '2');
INSERT INTO `bid` VALUES ('11', '4', '1');
INSERT INTO `bid` VALUES ('12', '5', '1');
INSERT INTO `bid` VALUES ('13', '1', '2');
INSERT INTO `bid` VALUES ('14', '6', '1');
INSERT INTO `bid` VALUES ('15', '7', '1');
INSERT INTO `bid` VALUES ('16', '8', '1');
INSERT INTO `bid` VALUES ('17', '9', '1');
INSERT INTO `bid` VALUES ('18', '3', '2');
INSERT INTO `bid` VALUES ('19', '4', '2');
INSERT INTO `bid` VALUES ('20', '5', '2');
INSERT INTO `bid` VALUES ('21', '6', '2');
INSERT INTO `bid` VALUES ('22', '8', '2');
INSERT INTO `bid` VALUES ('23', '10', '1');
INSERT INTO `bid` VALUES ('24', '11', '1');
INSERT INTO `bid` VALUES ('25', '12', '1');
INSERT INTO `bid` VALUES ('26', '13', '1');
INSERT INTO `bid` VALUES ('27', '14', '1');
INSERT INTO `bid` VALUES ('28', '15', '1');
INSERT INTO `bid` VALUES ('29', '16', '1');
INSERT INTO `bid` VALUES ('30', '17', '1');

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of coupon
-- ----------------------------

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) unsigned NOT NULL,
  `fname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone3` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count_transaction` int(11) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `personal_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ncode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', '13', 'asd', 'asd', 'ar.azizan@gmail.com', '0', 'aslmmasm ', '09124522125', null, null, '0', '0', null, null, '2016-09-24 10:52:44', '2016-09-24 10:52:44', null, '');
INSERT INTO `customer` VALUES ('3', '18', 'ahma', 'azizan', 'ar.azizan@gmail.co', '0', '$2y$10$tBBGQX.kX0vnZA/meEF4temf2Nv2DNcH7rYXmHVCBomSD0dIVjf7S', '09124531254', null, null, '0', '0', null, null, '2016-09-25 08:54:06', '2016-09-25 08:54:06', null, '1270058673');
INSERT INTO `customer` VALUES ('4', '19', 'ahmadreza', 'azizan', 'ar.azizan@gmail', '0', '$2y$10$1ReqpxVAL29IGaQvHSiqzOE6qFupMSl3wkK1RCNBdbUoEn6ZVb46O', '09125631472', null, null, '0', '0', null, null, '2016-09-25 13:40:07', '2016-09-25 13:40:07', null, '1250070586');
INSERT INTO `customer` VALUES ('5', '20', 'ahmadreza', 'azizan', 'ar.azizan@gm', '0', '$2y$10$xmHJu/Z/JUaW6mFZGvPX7u1Fdk.M7mFV2Tkg975djzJrzlAFDFJyS', '09125631452', null, null, '0', '0', null, null, '2016-09-25 13:41:00', '2016-09-26 10:28:44', null, '2505055500');
INSERT INTO `customer` VALUES ('6', '21', 'ahmadreza', 'azizan', 'ar.azizan@gmas', '0', '$2y$10$SUqg90umAnUgIr.nFRxAHew06rDc/dS8pgt9d0DppS5RZVm9pc4Kq', '09125631472', null, null, '0', '0', null, null, '2016-09-25 13:42:08', '2016-09-26 00:12:14', null, '250505551250');
INSERT INTO `customer` VALUES ('8', '22', 'ahmas', 'asas', 'ar.azizan@gmai.com', '1', 'as', '989135631472', '', '', '0', '0', '1', null, '2016-09-25 23:52:08', '2016-09-25 23:52:08', null, '125');

-- ----------------------------
-- Table structure for email
-- ----------------------------
DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of email
-- ----------------------------

-- ----------------------------
-- Table structure for fee
-- ----------------------------
DROP TABLE IF EXISTS `fee`;
CREATE TABLE `fee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` mediumint(9) NOT NULL,
  `percent` double(8,2) NOT NULL,
  `max` int(11) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `to` mediumint(9) NOT NULL,
  `to_title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_icon` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fee
-- ----------------------------
INSERT INTO `fee` VALUES ('1', '2016-09-24 21:18:00', '2016-09-24 21:18:39', '3', '12500.00', '12500', '1', 'Iran', '4', 'United States', 'ir', 'us');
INSERT INTO `fee` VALUES ('2', '2015-09-03 23:19:00', '2016-09-03 23:19:34', '4', '12.25', '122020', '1', '', '0', '', null, null);
INSERT INTO `fee` VALUES ('3', '2016-09-06 09:26:00', '2016-09-06 09:26:45', '2', '2500.00', '12220', '1', 'lsd', '0', '', null, null);
INSERT INTO `fee` VALUES ('4', '2016-09-06 09:27:00', '2016-09-06 09:27:22', '1', '250000.00', '12540', '1', 'usd', '0', '', null, null);
INSERT INTO `fee` VALUES ('6', '2016-09-25 10:01:00', '2016-09-25 10:02:19', '3', '12500.00', '225000', '1', 'Iran', '2', 'Australia', 'ir', 'au');
INSERT INTO `fee` VALUES ('7', '2016-09-24 15:38:00', '2016-09-24 15:41:17', '0', '1250.00', '1125', '1', 'Australia', '0', 'Afghanistan', null, null);
INSERT INTO `fee` VALUES ('8', '2016-09-06 10:32:00', '2016-09-06 10:32:28', '1', '250.00', '10000', '1', 'usd', '2', 'lsd', null, null);
INSERT INTO `fee` VALUES ('9', '2016-09-06 10:36:00', '2016-09-25 11:01:29', '3', '25000.00', '10000', '1', 'rils', '3', 'rils', null, null);
INSERT INTO `fee` VALUES ('10', '2016-09-23 17:39:00', '2016-09-25 10:59:10', '3', '25000.00', '1000000', '1', 'rils', '5', 'uoro', null, null);
INSERT INTO `fee` VALUES ('11', '2016-09-24 15:38:00', '2016-09-25 10:59:21', '2', '1350.00', '1125', '1', 'Australia', '1', 'Afghanistan', null, null);

-- ----------------------------
-- Table structure for fee_history
-- ----------------------------
DROP TABLE IF EXISTS `fee_history`;
CREATE TABLE `fee_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency` mediumint(9) NOT NULL,
  `percent` double(8,2) NOT NULL,
  `max` int(11) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `to` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of fee_history
-- ----------------------------
INSERT INTO `fee_history` VALUES ('1', '2015-06-06 10:20:00', '2016-09-04 23:25:10', '2', '12500.00', '122000', '1', '0');
INSERT INTO `fee_history` VALUES ('2', '2016-09-04 23:32:00', '2016-09-04 23:33:06', '3', '25500.00', '2250000', '1', '0');
INSERT INTO `fee_history` VALUES ('3', '2016-09-06 09:26:00', '2016-09-06 09:26:45', '2', '2500.00', '12220', '1', '0');
INSERT INTO `fee_history` VALUES ('4', '2016-09-06 09:27:00', '2016-09-06 09:27:22', '1', '250000.00', '12540', '1', '0');
INSERT INTO `fee_history` VALUES ('5', '2016-09-06 10:05:00', '2016-09-06 10:08:03', '3', '10.25', '100250', '1', '0');
INSERT INTO `fee_history` VALUES ('6', '2016-10-22 10:20:00', '2016-09-06 10:08:37', '3', '25000.00', '1000', '1', '0');
INSERT INTO `fee_history` VALUES ('7', '2016-10-20 10:20:00', '2016-09-06 10:09:57', '3', '255000.00', '11000', '1', '0');
INSERT INTO `fee_history` VALUES ('8', '2016-10-20 10:20:00', '2016-09-06 10:12:29', '2', '25000.00', '1000', '1', '0');
INSERT INTO `fee_history` VALUES ('9', '2016-09-06 10:32:00', '2016-09-06 10:32:28', '1', '250.00', '10000', '1', '2');
INSERT INTO `fee_history` VALUES ('10', '2016-09-06 10:36:00', '2016-09-06 10:36:37', '3', '2500.00', '10000', '1', '3');
INSERT INTO `fee_history` VALUES ('11', '2016-09-06 10:47:00', '2016-09-06 10:47:57', '3', '250000.00', '1000', '1', '2');
INSERT INTO `fee_history` VALUES ('12', '2016-09-23 17:39:00', '2016-09-23 17:39:26', '3', '2500.00', '1000000', '1', '5');
INSERT INTO `fee_history` VALUES ('13', '2016-09-24 15:38:00', '2016-09-24 15:42:54', '2', '1250.00', '1125', '1', '1');
INSERT INTO `fee_history` VALUES ('14', '2016-09-24 21:16:00', '2016-09-24 21:16:37', '3', '120.00', '10000', '1', '4');
INSERT INTO `fee_history` VALUES ('15', '2016-09-24 21:18:00', '2016-09-24 21:18:39', '3', '12500.00', '12500', '1', '4');
INSERT INTO `fee_history` VALUES ('16', '2016-09-25 10:01:00', '2016-09-25 10:02:19', '3', '12500.00', '225000', '1', '2');

-- ----------------------------
-- Table structure for file
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `file_order_foreign` (`order`),
  KEY `file_cid_foreign` (`cid`),
  CONSTRAINT `file_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `file_order_foreign` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of file
-- ----------------------------
INSERT INTO `file` VALUES ('1', '2016-09-24 23:51:28', '2016-09-24 23:51:28', '/storage/orders/1/1474748409.png', '9', '1');
INSERT INTO `file` VALUES ('2', '2016-09-26 10:53:52', '2016-09-26 10:53:52', '/storage/orders/1/1474874621.jpg', '10', '1');
INSERT INTO `file` VALUES ('3', '2016-09-26 11:58:59', '2016-09-26 11:58:59', '/storage/orders/1/1474878537.png', '11', '1');

-- ----------------------------
-- Table structure for iban
-- ----------------------------
DROP TABLE IF EXISTS `iban`;
CREATE TABLE `iban` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iban` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iban_cid_foreign` (`cid`),
  CONSTRAINT `iban_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of iban
-- ----------------------------
INSERT INTO `iban` VALUES ('3', '12505025025002500125', '', '', '6', '2016-09-25 13:42:09', '2016-09-25 13:42:09', 'ahmadreza', 'azizan');
INSERT INTO `iban` VALUES ('4', '124521254512545412254551', '12as', '', '8', '2016-09-25 23:52:08', '2016-09-25 23:52:08', 'ahmas', 'asas');

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
INSERT INTO `jobs` VALUES ('1', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950612120305.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1472801862', '1472801802');
INSERT INTO `jobs` VALUES ('2', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950614111843.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1472971784', '1472971724');
INSERT INTO `jobs` VALUES ('3', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950702055912.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1474641013', '1474640953');
INSERT INTO `jobs` VALUES ('4', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950702055914.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1474641015', '1474640955');
INSERT INTO `jobs` VALUES ('5', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950708102500.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1475175362', '1475175302');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creator` int(10) unsigned DEFAULT NULL,
  `severity` tinyint(4) DEFAULT NULL,
  `blob` blob NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `where` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `w` tinyint(4) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'sad', 'asd', '3', '0', '1', null);
INSERT INTO `menu` VALUES ('2', 'asd', 'adsad', '3', '0', '1', '1');
INSERT INTO `menu` VALUES ('3', 'in the name', 'adsasddsad', '3', '0', '1', null);
INSERT INTO `menu` VALUES ('4', 'Find', 'url', '2', '0', '1', null);
INSERT INTO `menu` VALUES ('5', 'Two Menu', 'Iran', '2', '0', '1', '4');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2016_03_17_185510_create_bid_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_094252_create_jobs_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101031_create_customer_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101050_create_transaction_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101106_create_log_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101125_create_sms_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101134_create_email_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101200_create_payment_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101210_create_fee_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101226_create_fee_history_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101241_create_setting_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101251_create_file_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101317_create_coupon_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101353_create_permission_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_101421_create_node_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_27_101811_create_bank_gate_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_30_175338_menus', '1');
INSERT INTO `migrations` VALUES ('2016_09_01_222731_node_table', '2');
INSERT INTO `migrations` VALUES ('2016_09_03_102532_fee_table', '3');
INSERT INTO `migrations` VALUES ('2016_09_04_124208_add_parent_to_menu', '4');
INSERT INTO `migrations` VALUES ('2016_09_04_232314_fee_history', '5');
INSERT INTO `migrations` VALUES ('2016_09_06_092246_add_currency_title', '6');
INSERT INTO `migrations` VALUES ('2016_09_06_100111_add_to_fee', '7');
INSERT INTO `migrations` VALUES ('2016_09_06_101114_add_to_title', '8');
INSERT INTO `migrations` VALUES ('2016_09_06_101522_add_to_fee_history', '9');
INSERT INTO `migrations` VALUES ('2016_09_06_135641_order_table', '10');
INSERT INTO `migrations` VALUES ('2016_09_06_225804_add_close_at', '11');
INSERT INTO `migrations` VALUES ('2016_09_06_231407_add_close_type', '12');
INSERT INTO `migrations` VALUES ('2016_09_23_174342_persmission_table', '13');
INSERT INTO `migrations` VALUES ('2016_09_24_211248_icon_fee', '14');
INSERT INTO `migrations` VALUES ('2016_09_24_212818_iban_table', '15');
INSERT INTO `migrations` VALUES ('2016_09_24_233046_file_table', '16');
INSERT INTO `migrations` VALUES ('2016_09_24_235918_iban_order', '17');
INSERT INTO `migrations` VALUES ('2016_09_25_081429_fname_iban', '18');
INSERT INTO `migrations` VALUES ('2016_09_26_124933_customer_order', '19');

-- ----------------------------
-- Table structure for node
-- ----------------------------
DROP TABLE IF EXISTS `node`;
CREATE TABLE `node` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of node
-- ----------------------------
INSERT INTO `node` VALUES ('1', '2016-09-01 22:38:49', '2016-09-01 22:38:49', 'in the name of allah', '<p>url is the best commonly target&nbsp;</p>\n', '0', 'url', '1', '1');
INSERT INTO `node` VALUES ('2', '2016-09-02 10:41:30', '2016-09-02 10:41:30', 'Page Two Example', '<p>the Body&nbsp;</p>\n', '0', 'Url in list', '1', '1');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `from` mediumint(9) NOT NULL,
  `from_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` mediumint(9) NOT NULL,
  `to_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fee` double(8,2) NOT NULL,
  `price` double NOT NULL,
  `closed` tinyint(1) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `creator` int(10) unsigned DEFAULT NULL,
  `acceptor` int(10) unsigned DEFAULT NULL,
  `rollback` tinyint(1) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `close_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `close_type` tinyint(4) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iban` int(10) unsigned DEFAULT NULL,
  `cid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_bid_foreign` (`bid`),
  KEY `order_creator_foreign` (`creator`),
  KEY `order_acceptor_foreign` (`acceptor`),
  KEY `order_iban_foreign` (`iban`),
  KEY `order_cid_foreign` (`cid`),
  CONSTRAINT `order_acceptor_foreign` FOREIGN KEY (`acceptor`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_bid_foreign` FOREIGN KEY (`bid`) REFERENCES `bid` (`bid`) ON DELETE CASCADE,
  CONSTRAINT `order_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_creator_foreign` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_iban_foreign` FOREIGN KEY (`iban`) REFERENCES `iban` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', null, '2016-09-06 14:13:21', '2016-09-06 14:13:21', '3', '', '4', '', '25000.00', '2500', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '0', '', null, null);
INSERT INTO `order` VALUES ('2', null, '2016-09-06 14:13:48', '2016-09-06 14:13:48', '3', '', '4', '', '25000.00', '2500', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '0', '', null, null);
INSERT INTO `order` VALUES ('3', null, '2016-09-06 17:37:09', '2016-09-06 23:19:26', '3', 'lsd', '4', 'usd', '25000.00', '2500', '0', '0', '1', '1', '0', '1', '', null, '2016-09-06 23:19:26', '2', 'asdasd', null, null);
INSERT INTO `order` VALUES ('4', null, '2016-09-09 23:02:34', '2016-09-09 23:02:34', '1', 'rils', '2', 'lsd', '250000.00', '25000', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '0', '', null, null);
INSERT INTO `order` VALUES ('5', null, '2016-09-09 23:26:52', '2016-09-09 23:26:52', '3', 'lsd', '1', 'usd', '25000.00', '1120', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '0', '', null, null);
INSERT INTO `order` VALUES ('6', null, '2016-09-24 23:28:17', '2016-09-24 23:28:17', '1', 'Iran', '2', 'lsd', '250.00', '1250', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '0', '', null, null);
INSERT INTO `order` VALUES ('7', null, '2016-09-24 23:50:11', '2016-09-24 23:50:11', '1', 'Iran', '2', 'lsd', '250.00', '123', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '3', '', null, null);
INSERT INTO `order` VALUES ('8', null, '2016-09-24 23:50:31', '2016-09-24 23:50:31', '1', 'Iran', '2', 'lsd', '250.00', '123', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '3', '', null, null);
INSERT INTO `order` VALUES ('9', null, '2016-09-24 23:51:28', '2016-09-25 00:32:52', '1', 'Iran', '2', 'lsd', '250.00', '123', '0', '0', '1', '1', '0', '1', '', null, '2016-09-25 00:32:52', '2', '', null, null);
INSERT INTO `order` VALUES ('10', null, '2016-09-26 10:53:51', '2016-09-26 10:53:51', '1', 'Afghanistan', '2', 'lsd', '250.00', '1250500', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', null, null);
INSERT INTO `order` VALUES ('11', null, '2016-09-26 11:58:59', '2016-09-26 11:58:59', '3', 'Iran', '3', 'rils', '25000.00', '12500', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', '4', null);
INSERT INTO `order` VALUES ('12', null, '2016-09-26 12:36:23', '2016-09-26 12:36:23', '3', 'Iran', '4', 'United States', '12500.00', '12250', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', '4', null);
INSERT INTO `order` VALUES ('13', null, '2016-09-26 12:37:24', '2016-09-26 12:37:24', '3', 'Iran', '4', 'United States', '12500.00', '12250', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', '4', null);
INSERT INTO `order` VALUES ('14', null, '2016-09-26 12:46:27', '2016-09-26 12:46:27', '3', 'Iran', '4', 'United States', '12500.00', '12250', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', '4', null);
INSERT INTO `order` VALUES ('15', null, '2016-09-26 13:09:27', '2016-09-26 13:09:27', '3', 'Iran', '4', 'United States', '12500.00', '250', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', '3', null);
INSERT INTO `order` VALUES ('16', null, '2016-09-26 13:16:39', '2016-09-26 13:16:39', '3', 'Iran', '2', 'Australia', '12500.00', '22500', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '2', '', '4', null);
INSERT INTO `order` VALUES ('17', null, '2016-09-26 13:17:49', '2016-09-26 13:17:49', '3', 'Iran', '2', 'Australia', '12500.00', '110', '0', '0', '1', null, '0', '-1', '', null, '0000-00-00 00:00:00', '1', '', '4', '8');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of payment
-- ----------------------------

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `utid` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission
-- ----------------------------

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of setting
-- ----------------------------

-- ----------------------------
-- Table structure for sms
-- ----------------------------
DROP TABLE IF EXISTS `sms`;
CREATE TABLE `sms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `is_group` tinyint(1) NOT NULL,
  `mobile` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `send` tinyint(1) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of sms
-- ----------------------------

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bid` bigint(20) unsigned NOT NULL,
  `type` tinyint(4) NOT NULL,
  `close` tinyint(1) DEFAULT NULL,
  `currency` int(10) unsigned DEFAULT NULL,
  `currency_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` int(10) unsigned DEFAULT NULL,
  `nerkh` double(8,2) DEFAULT NULL,
  `creator` int(10) unsigned NOT NULL,
  `acceptor` int(10) unsigned DEFAULT NULL,
  `rollback` tinyint(1) DEFAULT NULL,
  `msg` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sts` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of transaction
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` int(10) unsigned DEFAULT NULL,
  `bid` bigint(20) unsigned NOT NULL,
  `fname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `sts` tinyint(4) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `active_key` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '0', 'ahmadreza', 'azizanx', 'programmer', 'ar.azizan@gmail.com', '$2y$10$9o.xVzJ1pPvtyu7zEnFZ1.Pn0lBcX23iFnDpkoHKTD8PDPZClD7WS', '1', null, '0', null, null, null, 'TAqAe22NI1WI2gaMLAB2OYkiEWGhYLFUznNKLdu1dOG4UAHbU0YJfIKbo4oQ', '2016-09-01 17:57:27', '2016-09-29 22:43:23', null);
