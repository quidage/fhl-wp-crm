-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 20. Apr 2013 um 16:08
-- Server Version: 5.5.29
-- PHP-Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `wp-crm`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cr_date` datetime NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `street`, `zip`, `city`, `phone`, `fax`, `email`) VALUES
(1, 1, '0000-00-00 00:00:00', '2013-04-19 14:32:53', 0, 'hansi', 'Straße', '01234', 'Hamburg', '40400231', '', ''),
(2, 1, '0000-00-00 00:00:00', '2013-04-17 15:43:11', 0, 'Testkunde 2', 'Teststraße 2', '24837', 'Schleswig', '', '', ''),
(3, 1, '0000-00-00 00:00:00', '2013-04-17 16:03:11', 0, 'Testkunde 1', 'Teststraße 1', '22177', 'Hamburg', '', '', ''),
(4, 1, '2013-04-17 18:06:45', '2013-04-17 16:06:45', 0, 'Testkunde 1', 'Teststraße 1', '22177', 'Hamburg', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cr_date` datetime NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cr_date` datetime NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `password`, `last_login`, `first_name`, `last_name`) VALUES
(1, 0, '2013-04-16 00:00:00', '2013-04-18 19:20:16', 0, 'hans', 'wurst', '0000-00-00 00:00:00', '', ''),
(2, 0, '2013-04-19 16:59:43', '2013-04-19 14:59:43', 0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '0000-00-00 00:00:00', '', '');
