/*Updates for 'ohs_dev'*/


DROP TABLE IF EXISTS `ests`;
CREATE TABLE IF NOT EXISTS `ests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `certifications` ADD `estId` INT(11) NOT NULL DEFAULT '0' AFTER `id`;