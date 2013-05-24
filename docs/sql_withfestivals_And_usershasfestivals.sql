USE feedfilms;
CREATE TABLE `festivals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `feedfilms`.`festivals`
(`id`,
`name`,
`edition`,
`location`,
`date`)
VALUES
('1', 'festival inicio', '2013', 'Barcelona', '2013-05-18'),
('3', 'festival san sebastian', '2013', 'San Sebastian', '2013-05-18'),
('4', 'Feedback', '2013', 'Barcelona', '2013-05-18');
delimiter $$

CREATE TABLE `users_has_festivals` (
  `id_uhf` int(11) NOT NULL AUTO_INCREMENT,
  `acl_users_id` int(11) DEFAULT NULL,
  `festivals_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_uhf`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8$$



