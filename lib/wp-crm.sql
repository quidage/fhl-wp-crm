-- Struktur der Tabellen
--
-- Dump erstellt mit phpmydmin
--
-- created by Christian Hansen <christian.hansen@stud.fh-luebeck.de>

-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 23. Jun 2013 um 15:24
-- Server Version: 5.5.31-0ubuntu0.13.04.1
-- PHP-Version: 5.4.9-4ubuntu2.1

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
(2, 2, '0000-00-00 00:00:00', '2013-06-09 13:39:09', 0, 'Testkunde 2', 'Teststraße 2', '24837', 'Schleswig', '040-479359343', '040-11321231', 'testkunde@testmail.de'),
(3, 2, '0000-00-00 00:00:00', '2013-06-09 16:58:48', 0, 'Testkunde 1', 'Teststraße 1', '22177', 'Hamburg', '', '', 'hans@wurst.de'),
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
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`, `begin`, `end`) VALUES
(1, 2, '2013-06-02 00:00:00', '2013-06-09 16:48:25', 0, 'Projekt 1', 'Testbeschreibung', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, '2013-06-02 00:00:00', '2013-06-09 16:48:32', 0, 'Projekt 2', 'balba asdfa', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, '0000-00-00 00:00:00', '2013-06-09 17:36:05', 0, 'saf', 'adsf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, '0000-00-00 00:00:00', '2013-06-09 17:36:36', 0, 'adsf', 'asfd', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, '0000-00-00 00:00:00', '2013-06-09 17:39:27', 0, 'adsf', 'asfd', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 0, '0000-00-00 00:00:00', '2013-06-09 17:41:51', 0, 'asdf', 'safd', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 4, '0000-00-00 00:00:00', '2013-06-09 17:42:52', 0, 'asdf', 'safd', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, '0000-00-00 00:00:00', '2013-06-09 17:43:04', 0, 'Test12', 'afdsf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 3, '0000-00-00 00:00:00', '2013-06-09 19:24:28', 0, 'Projekt 12', 'Hans Wurst Testprojekt', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 0, '0000-00-00 00:00:00', '2013-06-12 20:37:14', 0, 'neues Ding', 'super kram', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 0, '0000-00-00 00:00:00', '2013-06-12 20:38:45', 0, 'fasfs', 'super ding', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 0, '0000-00-00 00:00:00', '2013-06-12 20:39:42', 0, 'fas', 'fsadsf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 0, '0000-00-00 00:00:00', '2013-06-12 20:39:45', 0, 'fas', 'fsadsf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 0, '0000-00-00 00:00:00', '2013-06-12 20:39:51', 0, 'fas', 'fsadsf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 0, '0000-00-00 00:00:00', '2013-06-12 20:39:51', 0, 'fas', 'fsadsf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 0, '0000-00-00 00:00:00', '2013-06-12 20:40:03', 0, 'dsafa', 'fdsa', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 0, '0000-00-00 00:00:00', '2013-06-12 20:40:55', 0, '', '', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 0, '0000-00-00 00:00:00', '2013-06-12 20:43:04', 0, 'saf', 'saf', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 2, '0000-00-00 00:00:00', '2013-06-12 20:44:07', 0, 'sf', 'sfd', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 4, '0000-00-00 00:00:00', '2013-06-18 19:06:40', 0, 'Projekt 75', 'Dies ist eine Testbeschreibung', 'Geschlossen', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `confirm_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `password`, `last_login`, `first_name`, `last_name`, `admin`, `email`, `confirm_hash`) VALUES
(1, 0, '2013-04-16 00:00:00', '2013-06-01 12:11:53', 0, 'hans', 'wurst', '0000-00-00 00:00:00', 'Hans', 'Wurst', 0, 'hans.wurst@bockwurstwasser.de', ''),
(2, 0, '2013-04-19 16:59:43', '2013-06-23 13:23:40', 0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2013-06-23 15:23:40', 'Max', 'Mustermann', 1, 'quid@gmx.de', ''),
(3, 0, '0000-00-00 00:00:00', '2013-06-21 20:15:01', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:15:01', '', '', 0, '', ''),
(4, 0, '0000-00-00 00:00:00', '2013-06-21 20:18:06', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:18:06', '', '', 0, '', ''),
(5, 0, '0000-00-00 00:00:00', '2013-06-21 20:31:07', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:31:07', '', '', 0, '', ''),
(6, 0, '0000-00-00 00:00:00', '2013-06-21 20:44:51', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:44:51', '', '', 0, '', ''),
(7, 0, '0000-00-00 00:00:00', '2013-06-21 20:44:52', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:44:52', '', '', 0, '', ''),
(8, 0, '0000-00-00 00:00:00', '2013-06-23 12:16:36', 0, '', '06a998cdd13c50b7875775d4e7e9fa74', '2013-06-23 14:16:36', '', '', 0, '', ''),
(9, 0, '0000-00-00 00:00:00', '2013-06-23 12:19:34', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-23 14:19:34', '', '', 0, '', ''),
(10, 0, '0000-00-00 00:00:00', '2013-06-23 12:19:40', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-23 14:19:40', '', '', 0, '', ''),
(11, 0, '0000-00-00 00:00:00', '2013-06-23 13:19:00', 0, 'hansi', '5452eea2e1ff9cefa25f5fb590386dfb', '2013-06-23 15:19:00', 'Hans', 'Bockwurst', 0, 'hans@bockwurst.de', '');
