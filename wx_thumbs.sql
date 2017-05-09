# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.35)
# Database: wx_thumbs
# Generation Time: 2017-05-09 10:09:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_users`;

CREATE TABLE `admin_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login_name` varchar(30) DEFAULT NULL,
  `passwd` varchar(40) DEFAULT NULL,
  `permission` varchar(500) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;

INSERT INTO `admin_users` (`id`, `login_name`, `passwd`, `permission`, `name`)
VALUES
	(1,'admin','21232f297a57a5a743894a0e4a801fc3',NULL,'admin');

/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `star` int(11) NOT NULL DEFAULT '0',
  `text` varchar(500) NOT NULL DEFAULT '0',
  `comment_admin` varchar(500) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `staff_id` int(11) NOT NULL,
  `reply` varchar(500) DEFAULT NULL,
  `wx_name` varchar(50) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;

INSERT INTO `comment` (`id`, `star`, `text`, `comment_admin`, `admin_id`, `staff_id`, `reply`, `wx_name`, `time`)
VALUES
	(32,3,'sdfdf','',0,4,'0','user_3012261557',1494310893),
	(33,3,'dfdf','',0,4,'0','user_2071972727',1494310896),
	(34,0,'回复<b>user_2071972727:</b>df','',0,0,'33','user_3461021614',1494310900),
	(36,0,'回复<b>user_2071972727:</b>df','',0,0,'33','user_2327229944',1494310906),
	(37,0,'回复<b>user_3012261557:</b>df','',0,0,'32','user_2478651075',1494310909),
	(38,0,'回复undefined:dfdfdfdfdfdffdfdfdfdfdfdfdfdfdfdf','',0,0,'undefined','店长',1494312691),
	(39,0,'回复user_2071972727:dfdfdfdfdfd','',0,0,'33','店长',1494312706),
	(40,0,'回复undefined:fgfgsfgfgadf','',0,0,'undefined','店长',1494312715),
	(41,0,'回复user_2071972727:风格是大法官帝国帝国帝国帝国帝国敌方个','',0,0,'33','店长',1494312777),
	(42,0,'回复user_2071972727:dfg','',0,0,'33','店长',1494313200),
	(43,0,'回复店长:df','',0,0,'33','店长',1494313247);

/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `thumb_limit` int(11) DEFAULT NULL,
  `welcome` varchar(500) DEFAULT NULL,
  `thumb_bg` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;

INSERT INTO `setting` (`id`, `thumb_limit`, `welcome`, `thumb_bg`)
VALUES
	(1,1,'欢迎您对我们的员工进行点赞!','thumb_bg.png');

/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shop`;

CREATE TABLE `shop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `des` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `shop` WRITE;
/*!40000 ALTER TABLE `shop` DISABLE KEYS */;

INSERT INTO `shop` (`id`, `name`, `des`)
VALUES
	(40,'df',''),
	(41,'er','');

/*!40000 ALTER TABLE `shop` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table staffs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `staffs`;

CREATE TABLE `staffs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `des` text,
  `job` varchar(100) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `header` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `staffs` WRITE;
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;

INSERT INTO `staffs` (`id`, `name`, `des`, `job`, `shop_id`, `header`)
VALUES
	(1,'敌方','','',41,NULL),
	(2,'d','','',41,NULL),
	(3,'4','','',41,''),
	(4,'fg','','22',41,'ce579c9e1d37bbf79aee811e96a4db2a.png');

/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
