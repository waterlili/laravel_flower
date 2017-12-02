/*
Navicat MySQL Data Transfer

Source Server         : localhoat
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : gol

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-11-30 19:13:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for composit
-- ----------------------------
DROP TABLE IF EXISTS `composit`;
CREATE TABLE `composit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` tinyint(4) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `session` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_level` tinyint(4) DEFAULT NULL,
  `exp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product` int(10) unsigned NOT NULL,
  `flower` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `composit_product_foreign` (`product`),
  KEY `composit_flower_foreign` (`flower`),
  CONSTRAINT `composit_flower_foreign` FOREIGN KEY (`flower`) REFERENCES `const` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `composit_product_foreign` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of composit
-- ----------------------------
INSERT INTO `composit` VALUES ('1', '2016-11-15 00:13:55', '2016-11-15 00:13:55', 'رز هلندی', '10', null, null, null, null, '4', '4');
INSERT INTO `composit` VALUES ('2', '2016-11-15 00:13:56', '2016-11-15 00:13:56', 'رز هلندی', '25', null, null, null, null, '4', '4');
INSERT INTO `composit` VALUES ('3', '2016-11-15 00:13:56', '2016-11-15 00:13:56', 'رز', '25', null, null, null, null, '4', '3');

-- ----------------------------
-- Table structure for const
-- ----------------------------
DROP TABLE IF EXISTS `const`;
CREATE TABLE `const` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `w` tinyint(4) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of const
-- ----------------------------
INSERT INTO `const` VALUES ('1', '1', 'آلستر', null);
INSERT INTO `const` VALUES ('2', '1', 'لیلیوم ', null);
INSERT INTO `const` VALUES ('3', '1', 'رز', null);
INSERT INTO `const` VALUES ('4', '1', 'رز هلندی', null);
INSERT INTO `const` VALUES ('5', '1', 'آنتالیوم', null);
INSERT INTO `const` VALUES ('6', '1', 'مریم ', null);
INSERT INTO `const` VALUES ('7', '1', 'نرگس', null);
INSERT INTO `const` VALUES ('8', '1', 'ختمی', null);
INSERT INTO `const` VALUES ('9', '1', 'لیندا', null);
INSERT INTO `const` VALUES ('10', '1', 'بنفشه', null);
INSERT INTO `const` VALUES ('11', '2', 'یاقوت ساده', null);
INSERT INTO `const` VALUES ('12', '2', 'یاقوت سلفنی', null);
INSERT INTO `const` VALUES ('13', '2', 'بسته بزرگ', null);
INSERT INTO `const` VALUES ('14', '2', 'الماس ساده', null);
INSERT INTO `const` VALUES ('15', '2', 'یاقوت غیر ساده', null);
INSERT INTO `const` VALUES ('16', '2', 'گلسفات', null);
INSERT INTO `const` VALUES ('17', '2', 'گلسفات سلفنی', null);
INSERT INTO `const` VALUES ('18', '3', 'تن خواه', null);
INSERT INTO `const` VALUES ('19', '3', 'جاری', null);
INSERT INTO `const` VALUES ('20', '3', 'اداری', null);

-- ----------------------------
-- Table structure for cost
-- ----------------------------
DROP TABLE IF EXISTS `cost`;
CREATE TABLE `cost` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paraph` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uid` int(10) unsigned DEFAULT NULL,
  `reviewer` int(10) unsigned DEFAULT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `sts` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cost_uid_foreign` (`uid`),
  KEY `cost_reviewer_foreign` (`reviewer`),
  CONSTRAINT `cost_reviewer_foreign` FOREIGN KEY (`reviewer`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cost_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cost
-- ----------------------------
INSERT INTO `cost` VALUES ('1', 'سند اول', 'پاراف سند', 'شرح سند', '2500', 'تن خواه', '1', null, null, '-1', '2016-11-27 21:08:02', '2016-11-27 21:08:02');
INSERT INTO `cost` VALUES ('2', 'سند دوم', '', 'شرح سند', '12500', 'جاری', '8', null, null, '2', '2016-11-27 21:13:57', '2016-11-27 21:13:57');
INSERT INTO `cost` VALUES ('3', 'سند سوم', '21250', 'شرح سمد', '12500', 'تن خواه', '8', null, null, '2', '2016-11-27 21:16:22', '2016-11-27 21:16:22');

-- ----------------------------
-- Table structure for customer_group
-- ----------------------------
DROP TABLE IF EXISTS `customer_group`;
CREATE TABLE `customer_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group` int(10) unsigned NOT NULL,
  `customer` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_group_group_foreign` (`group`),
  KEY `customer_group_customer_foreign` (`customer`),
  CONSTRAINT `customer_group_customer_foreign` FOREIGN KEY (`customer`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_group_group_foreign` FOREIGN KEY (`group`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of customer_group
-- ----------------------------
INSERT INTO `customer_group` VALUES ('1', '3', '12');
INSERT INTO `customer_group` VALUES ('2', '4', '12');
INSERT INTO `customer_group` VALUES ('3', '2', '12');
INSERT INTO `customer_group` VALUES ('4', '6', '12');
INSERT INTO `customer_group` VALUES ('5', '1', '12');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `depth` tinyint(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES ('1', 'بازاری', null, null);
INSERT INTO `group` VALUES ('2', 'بدون کار', null, null);
INSERT INTO `group` VALUES ('3', 'دیربازده ', '1', '1');
INSERT INTO `group` VALUES ('4', 'زودبازده', '1', '1');
INSERT INTO `group` VALUES ('5', 'عنوان', '3', '2');
INSERT INTO `group` VALUES ('6', 'بی دنیا', null, null);
INSERT INTO `group` VALUES ('7', 'sd', null, null);
INSERT INTO `group` VALUES ('8', 'عنوان گروه', null, null);
INSERT INTO `group` VALUES ('9', 'بیدار', '5', '1');
INSERT INTO `group` VALUES ('10', 'عنوان زیر مجموعه', '8', null);
INSERT INTO `group` VALUES ('11', 'گروه سوم', '8', null);
INSERT INTO `group` VALUES ('12', 'عنوان کار', '2', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of jobs
-- ----------------------------
INSERT INTO `jobs` VALUES ('1', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950825051755.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1479217737', '1479217677');
INSERT INTO `jobs` VALUES ('2', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950827072817.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1479398359', '1479398299');
INSERT INTO `jobs` VALUES ('3', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950901100539.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1479753401', '1479753341');
INSERT INTO `jobs` VALUES ('4', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950907095139.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1480270961', '1480270901');
INSERT INTO `jobs` VALUES ('5', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950907095141.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1480270961', '1480270901');
INSERT INTO `jobs` VALUES ('6', 'default', '{\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"data\":{\"commandName\":\"App\\\\Jobs\\\\RemoveExcelForm\",\"command\":\"O:24:\\\"App\\\\Jobs\\\\RemoveExcelForm\\\":5:{s:7:\\\"\\u0000*\\u0000name\\\";s:17:\\\"950908095555.xlsx\\\";s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:5:\\\"delay\\\";i:60;s:6:\\\"\\u0000*\\u0000job\\\";N;}\"}}', '0', '0', null, '1480357617', '1480357557');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `message` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `severity` tinyint(4) DEFAULT NULL,
  `hostname` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of log
-- ----------------------------

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
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2016_08_18_094252_create_jobs_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_composit_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_log_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_options_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_order_list_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_order_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_permission_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_price_history_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_product_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_term_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_transaction_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_user_info_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154818_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2016_11_09_154828_create_foreign_keys', '1');
INSERT INTO `migrations` VALUES ('2016_11_14_232236_flower-table', '2');
INSERT INTO `migrations` VALUES ('2016_11_15_000006_add_product_composit', '3');
INSERT INTO `migrations` VALUES ('2016_11_15_144517_add_total_order_list', '4');
INSERT INTO `migrations` VALUES ('2016_11_15_170054_add_visitor_order', '5');
INSERT INTO `migrations` VALUES ('2016_11_24_194703_add_table_group', '6');
INSERT INTO `migrations` VALUES ('2016_11_27_160117_cost_table', '7');

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` blob NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `options_uid_foreign` (`uid`),
  CONSTRAINT `options_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of options
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `when` tinyint(4) DEFAULT NULL,
  `day` tinyint(4) DEFAULT NULL,
  `total_product` tinyint(4) DEFAULT NULL,
  `automate` tinyint(1) DEFAULT NULL,
  `creator` int(10) unsigned DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `closed` tinyint(1) DEFAULT NULL,
  `feedback` text COLLATE utf8_unicode_ci,
  `sts` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `visitor` int(10) unsigned DEFAULT NULL,
  `sender` int(10) unsigned DEFAULT NULL,
  `submit` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_uid_foreign` (`uid`),
  KEY `order_creator_foreign` (`creator`),
  KEY `order_visitor_foreign` (`visitor`),
  KEY `order_sender_foreign` (`sender`),
  CONSTRAINT `order_creator_foreign` FOREIGN KEY (`creator`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_sender_foreign` FOREIGN KEY (`sender`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_visitor_foreign` FOREIGN KEY (`visitor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('2', '75100', '9', '1', '1', '1', '3', null, '1', 'توضیحات فاکتور', null, null, 'این محصول را ن\\سنیدیم', '-1', '2016-11-15 14:47:43', '2016-11-29 12:30:08', null, '8', null, null);
INSERT INTO `order` VALUES ('3', '12510', '9', '1', '1', '2', '1', null, '1', 'بر اساس اطلاعات ایستگاه‌های سنجش کیفیت هوای تهران، میزان غلظت آلاینده‌ها در شهر تهران امروز 11 واحد افزایش داشته که نشان دهنده شرایط قرمز کیفیت هوای پایتخت است.', null, null, null, '-1', '2016-11-15 14:49:31', '2016-11-29 23:50:11', null, null, null, null);
INSERT INTO `order` VALUES ('4', '12500', '10', '1', '1', '2', '1', null, '1', null, null, null, null, '-1', '2016-11-28 13:19:16', '2016-11-30 00:18:48', null, '8', null, '-1');
INSERT INTO `order` VALUES ('5', '12510', '12', '1', '2', '3', '2', null, '1', null, null, null, null, '-1', '2016-11-29 11:02:44', '2016-11-29 11:02:58', '2016-11-29 11:02:58', '8', null, '-1');

-- ----------------------------
-- Table structure for order_list
-- ----------------------------
DROP TABLE IF EXISTS `order_list`;
CREATE TABLE `order_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `oid` int(10) unsigned NOT NULL,
  `price` int(11) DEFAULT NULL,
  `total` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_list_pid_foreign` (`pid`),
  KEY `order_list_oid_foreign` (`oid`),
  CONSTRAINT `order_list_oid_foreign` FOREIGN KEY (`oid`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_list_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of order_list
-- ----------------------------
INSERT INTO `order_list` VALUES ('1', '3', '2', '12500', '5');
INSERT INTO `order_list` VALUES ('2', '4', '2', '10', '10');
INSERT INTO `order_list` VALUES ('3', '2', '2', '12500', '1');
INSERT INTO `order_list` VALUES ('6', '4', '5', '10', '1');
INSERT INTO `order_list` VALUES ('7', '3', '5', '12500', '1');
INSERT INTO `order_list` VALUES ('21', '3', '4', '12500', '1');
INSERT INTO `order_list` VALUES ('22', '2', '3', '12500', '1');
INSERT INTO `order_list` VALUES ('23', '4', '3', '10', '1');

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
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `utid` tinyint(4) NOT NULL,
  `rid` bigint(20) NOT NULL,
  `sts` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission
-- ----------------------------
INSERT INTO `permission` VALUES ('21', '3', '1010', null);
INSERT INTO `permission` VALUES ('22', '3', '10', null);

-- ----------------------------
-- Table structure for price_history
-- ----------------------------
DROP TABLE IF EXISTS `price_history`;
CREATE TABLE `price_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `price` int(11) NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `price_history_pid_foreign` (`pid`),
  CONSTRAINT `price_history_pid_foreign` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of price_history
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `code` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `price` int(11) DEFAULT NULL,
  `pack_type` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `thumb` int(10) unsigned NOT NULL,
  `sales` int(11) NOT NULL,
  `sts` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_uid_foreign` (`uid`),
  CONSTRAINT `product_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('2', '1', null, 'عنوان محصول', 'توضیح محصول', null, '12500', '2', null, '0', '5', '1', '2016-11-14 16:45:45', '2016-11-14 16:45:45', null);
INSERT INTO `product` VALUES ('3', '1', '102500', 'عنوان محصول', null, null, '12500', '3', '1', '0', '2', '1', '2016-11-14 23:57:48', '2016-11-14 23:57:48', null);
INSERT INTO `product` VALUES ('4', '1', '10', '10', null, null, '10', '2', '1', '0', '0', '1', '2016-11-15 00:13:55', '2016-11-15 00:13:55', null);

-- ----------------------------
-- Table structure for term
-- ----------------------------
DROP TABLE IF EXISTS `term`;
CREATE TABLE `term` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `sts` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of term
-- ----------------------------

-- ----------------------------
-- Table structure for transaction
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sts` tinyint(4) DEFAULT NULL,
  `bank` tinyint(4) DEFAULT NULL,
  `send_at` timestamp NULL DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `response_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `has_error` tinyint(1) DEFAULT NULL,
  `order` int(10) unsigned NOT NULL,
  `cid` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_order_foreign` (`order`),
  KEY `transaction_cid_foreign` (`cid`),
  CONSTRAINT `transaction_cid_foreign` FOREIGN KEY (`cid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaction_order_foreign` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `fname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `personal_picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sts` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'احمد رضا', 'عزیزان', 'ar.azizan@gmail.com', '1', 'ar.azizan@gmail.com', '$2y$10$9o.xVzJ1pPvtyu7zEnFZ1.Pn0lBcX23iFnDpkoHKTD8PDPZClD7WS', '2016-11-28 23:54:03', '1', '', 'uploads/user/profile/ar.azizan@gmail.com.jpg', '1', null, '2016-11-28 23:54:03', null);
INSERT INTO `users` VALUES ('8', 'احمد', 'عزیزان', 'ar.azizan@gmail.comgm', '2', 'عسثق', '', '2016-11-14 16:14:33', null, '', null, null, '2016-11-14 16:14:33', '2016-11-14 16:14:33', null);
INSERT INTO `users` VALUES ('9', 'محمد', 'رحیمی', 'rahgimi@gmail.com', '10', '', '', '2016-11-17 19:23:43', '1', '', null, '1', '2016-11-15 11:18:51', '2016-11-29 00:17:15', null);
INSERT INTO `users` VALUES ('10', 'نام', 'نام خانوادگی', '', '11', '', '', '2016-11-29 11:41:34', null, '', null, '-1', '2016-11-24 22:30:19', '2016-11-29 00:17:25', null);
INSERT INTO `users` VALUES ('12', 'فرزین', 'احمدی', null, '11', '', '', '2016-11-25 10:27:11', null, '', null, '-1', '2016-11-25 10:27:11', '2016-11-25 10:27:11', null);

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `job` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_type` tinyint(4) DEFAULT NULL,
  `skill` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sts` tinyint(4) DEFAULT NULL,
  `softDeletes` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_info_uid_foreign` (`uid`),
  CONSTRAINT `user_info_uid_foreign` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user_info
-- ----------------------------
INSERT INTO `user_info` VALUES ('4', '9', 'as', '2', null, null, 'خیابان ابن سینا ', null, '', '09135631472', '1', null, '2016-11-15 11:18:51', '2016-11-15 11:18:51');
INSERT INTO `user_info` VALUES ('5', '10', null, null, null, null, null, null, null, null, '-1', null, '2016-11-24 22:30:19', '2016-11-24 22:30:19');
INSERT INTO `user_info` VALUES ('7', '12', null, '2', null, null, null, null, null, null, '-1', null, '2016-11-25 10:27:11', '2016-11-25 10:27:11');
