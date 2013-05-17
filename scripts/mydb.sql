-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.11 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             7.0.0.4393
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla mydb.acl_modules
CREATE TABLE IF NOT EXISTS `acl_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla mydb.acl_modules: 0 rows
/*!40000 ALTER TABLE `acl_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_modules` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.acl_permissions
CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(1) NOT NULL,
  `resource_uid` int(4) NOT NULL,
  `permission` varchar(64) CHARACTER SET latin1 NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `menu` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM AUTO_INCREMENT=359 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla mydb.acl_permissions: 0 rows
/*!40000 ALTER TABLE `acl_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_permissions` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.acl_resources
CREATE TABLE IF NOT EXISTS `acl_resources` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `resource` varchar(64) CHARACTER SET latin1 NOT NULL,
  `name_r` varchar(250) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `resource` (`resource`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla mydb.acl_resources: 0 rows
/*!40000 ALTER TABLE `acl_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_resources` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.acl_roles
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `role_parents` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `prefered_uri` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla mydb.acl_roles: 0 rows
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.acl_users
CREATE TABLE IF NOT EXISTS `acl_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(4) NOT NULL,
  `user_name` varchar(64) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `password` varchar(250) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `person_id` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `validation_code` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `phone` varchar(250) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla mydb.acl_users: 0 rows
/*!40000 ALTER TABLE `acl_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_users` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.albums
CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.albums: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` (`id`, `artist`, `title`) VALUES
	(1, 'Paolo Nutine', 'Sunny Side Up'),
	(2, 'Florence + The Machine', 'Lungs'),
	(3, 'Massive Attack', 'Heligoland'),
	(4, 'Andre Rieu', 'Forever Vienna'),
	(5, 'Sade', 'Soldier of Love'),
	(7, 'vfghfgh', 'fghfgh');
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.cities: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.genders
CREATE TABLE IF NOT EXISTS `genders` (
  `id_gender` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(45) NOT NULL,
  PRIMARY KEY (`id_gender`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.genders: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `genders` DISABLE KEYS */;
/*!40000 ALTER TABLE `genders` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id_language` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  PRIMARY KEY (`id_language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.languages: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.pets
CREATE TABLE IF NOT EXISTS `pets` (
  `id_pet` int(11) NOT NULL AUTO_INCREMENT,
  `pet` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.pets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;
/*!40000 ALTER TABLE `pets` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` text,
  `foto` varchar(255) DEFAULT NULL,
  `cities_id_city` int(11) NOT NULL,
  `genders_id_gender` int(11) NOT NULL,
  `pets` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_cities_idx` (`cities_id_city`),
  KEY `fk_users_genders1_idx` (`genders_id_gender`),
  CONSTRAINT `fk_users_cities` FOREIGN KEY (`cities_id_city`) REFERENCES `cities` (`id_city`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_genders1` FOREIGN KEY (`genders_id_gender`) REFERENCES `genders` (`id_gender`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Volcando estructura para tabla mydb.users_has_languages
CREATE TABLE IF NOT EXISTS `users_has_languages` (
  `users_id_user` int(11) NOT NULL,
  `languages_id_language` int(11) NOT NULL,
  PRIMARY KEY (`users_id_user`,`languages_id_language`),
  KEY `fk_users_has_languages_languages1_idx` (`languages_id_language`),
  KEY `fk_users_has_languages_users1_idx` (`users_id_user`),
  CONSTRAINT `fk_users_has_languages_languages1` FOREIGN KEY (`languages_id_language`) REFERENCES `languages` (`id_language`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_languages_users1` FOREIGN KEY (`users_id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.users_has_languages: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users_has_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_has_languages` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
