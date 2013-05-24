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

-- Volcando estructura para tabla feedfilms.acl_modules
CREATE TABLE IF NOT EXISTS `acl_modules` (
  `id_module` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_module`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla feedfilms.acl_modules: 0 rows
/*!40000 ALTER TABLE `acl_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_modules` ENABLE KEYS */;


-- Volcando estructura para tabla feedfilms.acl_permissions
CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `id_permission` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) CHARACTER SET latin1 NOT NULL,
  `acl_roles_id_rol` int(11) NOT NULL,
  `acl_resources_id_resource` int(11) NOT NULL,
  PRIMARY KEY (`id_permission`),
  KEY `fk_acl_permissions_acl_roles1_idx` (`acl_roles_id_rol`),
  KEY `fk_acl_permissions_acl_resources1_idx` (`acl_resources_id_resource`)
) ENGINE=MyISAM AUTO_INCREMENT=368 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla feedfilms.acl_permissions: 0 rows
/*!40000 ALTER TABLE `acl_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_permissions` ENABLE KEYS */;


-- Volcando estructura para tabla feedfilms.acl_resources
CREATE TABLE IF NOT EXISTS `acl_resources` (
  `id_resource` int(11) NOT NULL AUTO_INCREMENT,
  `resource` varchar(255) CHARACTER SET latin1 NOT NULL,
  `acl_modules_id_module` int(11) NOT NULL,
  PRIMARY KEY (`id_resource`),
  UNIQUE KEY `resource` (`resource`),
  KEY `fk_acl_resources_acl_modules1_idx` (`acl_modules_id_module`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla feedfilms.acl_resources: 0 rows
/*!40000 ALTER TABLE `acl_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_resources` ENABLE KEYS */;


-- Volcando estructura para tabla feedfilms.acl_roles
CREATE TABLE IF NOT EXISTS `acl_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(25) CHARACTER SET latin1 NOT NULL,
  `role_parents` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_rol`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla feedfilms.acl_roles: 0 rows
/*!40000 ALTER TABLE `acl_roles` DISABLE KEYS */;
INSERT INTO `acl_roles` (`id_rol`, `role_name`, `role_parents`) VALUES
	(18, 'Sysadmin', '19,20'),
	(19, 'Administrator', '21'),
	(20, 'User', '21'),
	(21, 'Guest', '0');
/*!40000 ALTER TABLE `acl_roles` ENABLE KEYS */;


-- Volcando estructura para tabla feedfilms.acl_users
CREATE TABLE IF NOT EXISTS `acl_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `photo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(2) NOT NULL DEFAULT '0',
  `validation_code` timestamp NULL DEFAULT NULL,
  `acl_roles_id_rol` int(11) NOT NULL,
  `acl_users_id_user_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_acl_users_acl_roles1_idx` (`acl_roles_id_rol`),
  KEY `fk_acl_users_acl_users1_idx` (`acl_users_id_user_parent`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Volcando datos para la tabla feedfilms.acl_users: 0 rows
/*!40000 ALTER TABLE `acl_users` DISABLE KEYS */;
INSERT INTO `acl_users` (`id_user`, `name`, `email`, `password`, `phone`, `description`, `photo`, `date`, `status`, `validation_code`, `acl_roles_id_rol`, `acl_users_id_user_parent`) VALUES
	(24, 'Agustin', 'agustincl@gmail.com', '1234', NULL, 'Aquí va la descripción', 'images_10.jpg', '2013-05-18 00:00:00', 1, NULL, 1, NULL),
	(25, 'Se', 'asdas2@asd.com', '34534', NULL, 'sdklñhsjkf  skldfjskl lsk klsjdf sdf', 'original.jpg', '2013-05-18 00:00:00', 1, NULL, 21, NULL);
/*!40000 ALTER TABLE `acl_users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
