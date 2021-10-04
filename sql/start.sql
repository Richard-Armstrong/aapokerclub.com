SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `aapokerclub` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `aapokerclub`;

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'administration', 'Administrators'),
(2, 'unassigned', 'Unassigned');

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `nvp_codes`;
CREATE TABLE `nvp_codes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `context` varchar(45) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `display` varchar(45) DEFAULT NULL,
  `theValue` varchar(45) DEFAULT NULL,
  `altValue` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `nvp_codes` (`id`, `context`, `seq`, `display`, `theValue`, `altValue`) VALUES
(1, 'Yes_No', 1, 'Yes', '1', ''),
(2, 'Yes_No', 2, 'No', '0', '');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `notify_sms` TINYINT(1) NOT NULL DEFAULT '0',
  `notify_email` TINYINT(1) NOT NULL DEFAULT '0',
  `is_admin` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `notify_sms`, `notify_email`, `is_admin`) VALUES
(1, '::1', '$2y$08$Epkbj.pe3Xl9lxKwT1YvWOW.ev3bHPNo3R91QMbUkrltq5XYUrU2i', NULL, 'richard.armstrong@gmail.com', NULL, NULL, NULL, NULL, 1464459128, 1564858599, 1, 'Richard', 'Armstrong', '0', 0, 0, 1);

DROP TABLE IF EXISTS `user_groups`;
CREATE TABLE `user_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO `user_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1);

ALTER TABLE `user_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;
