-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Jun 2013 um 14:28
-- Server Version: 5.5.31-0ubuntu0.13.04.1
-- PHP-Version: 5.4.9-4ubuntu2

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
(2, 2, '0000-00-00 00:00:00', '2013-06-01 12:40:01', 0, 'Testkunde 2', 'Teststraße 2', '24837', 'Schleswig', '', '', ''),
(3, 2, '0000-00-00 00:00:00', '2013-06-01 12:40:07', 0, 'Testkunde 1', 'Teststraße 1', '22177', 'Hamburg', '', '', ''),
(4, 2, '2013-04-17 18:06:45', '2013-06-01 17:35:47', 0, 'Testkunde 3', 'Teststraße 1', '22177', 'Hamburg', '', '', '');

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
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`) VALUES
(1, 2, '2013-06-02 00:00:00', '2013-06-01 15:45:19', 0, 'Projekt 1', 'asdfafsdf', 'offen'),
(2, 2, '2013-06-02 00:00:00', '2013-06-01 12:41:54', 0, 'Projekt 2', 'asdfafsdf', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cr_date` datetime NOT NULL,
  `tstamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `task`
--

INSERT INTO `task` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`) VALUES
(1, 2, '2013-06-02 00:00:00', '2013-06-01 17:09:08', 0, 'Aufgabe 1', 'asdfafsdf', 'offen'),
(2, 2, '2013-06-02 00:00:00', '2013-06-01 17:09:05', 0, 'Task 2', 'asdfafsdf', 'offen');

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
  `admin` tinyint(1) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `password`, `last_login`, `first_name`, `last_name`, `admin`, `email`) VALUES
(1, 0, '2013-04-16 00:00:00', '2013-06-01 12:11:53', 0, 'hans', 'wurst', '0000-00-00 00:00:00', 'Hans', 'Wurst', 0, 'hans.wurst@bockwurstwasser.de'),
(2, 0, '2013-04-19 16:59:43', '2013-06-04 20:00:53', 0, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-04 22:00:53', 'Maximus', 'Mustermann', 1, 'max.mustermann@online.de');
