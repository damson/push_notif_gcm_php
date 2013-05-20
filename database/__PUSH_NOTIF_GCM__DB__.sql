SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `push_notification_gcm`
--
DROP DATABASE `push_notification_gcm`;
CREATE DATABASE `push_notification_gcm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `push_notification_gcm`;

-- --------------------------------------------------------

--
-- Table structure for table `gcm_users`
--

DROP TABLE IF EXISTS `gcm_users`;
CREATE TABLE IF NOT EXISTS `gcm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gcm_regid` text,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
