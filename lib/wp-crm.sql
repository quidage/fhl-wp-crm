-- Struktur der Tabellen
--
-- Dump erstellt mit phpmydmin
--
-- Dieser Dump enthaelt einige Beispieldaten
--
-- created by Christian Hansen <christian.hansen@stud.fh-luebeck.de>

-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 24. Jun 2013 um 22:37
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `street`, `zip`, `city`, `phone`, `fax`, `email`) VALUES
(1, 1, '0000-00-00 00:00:00', '2013-04-19 14:32:53', 0, 'hansi', 'Straße', '01234', 'Hamburg', '40400231', '', ''),
(2, 2, '0000-00-00 00:00:00', '2013-06-09 13:39:09', 0, 'Testkunde 2', 'Teststraße 2', '24837', 'Schleswig', '040-479359343', '040-11321231', 'testkunde@testmail.de'),
(3, 2, '0000-00-00 00:00:00', '2013-06-09 16:58:48', 0, 'Testkunde 1', 'Teststraße 1', '22177', 'Hamburg', '', '', 'hans@wurst.de'),
(4, 2, '2013-04-17 18:06:45', '2013-06-01 17:35:47', 0, 'Testkunde 3', 'Teststraße 1', '22177', 'Hamburg', '', '', ''),
(5, 0, '0000-00-00 00:00:00', '2013-06-23 21:01:44', 0, 'dsadf', 'asdf', '21', 'sfa', '', '', ''),
(6, 2, '0000-00-00 00:00:00', '2013-06-23 21:03:57', 0, 'af', 'asdf', 'asdf', 'afds', 'adsf', 'f', ''),
(7, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:06', 0, 'asdf', 'dsaf', '21321', 'dafs', 'asdf', 'safasdf', ''),
(8, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:14', 0, 'afs', 'adsf', 'asf', 'asdf', 'adsf', 'sadf', ''),
(9, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:21', 0, 'adsf', 'adsf', 'adsf', 'adsf', 'afsd', 'asdf', ''),
(10, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:27', 0, 'asdf', 'afds', 'asdf', 'asdf', 'asdf', 'asdf', ''),
(11, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:34', 0, 'afds', 'asfd', 'asf', 'dsaf', 'asdf', 'adsf', ''),
(12, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:40', 0, 'adsf', 'asdf', 'adsf', 'adsf', 'dfasd', 'asfd', ''),
(13, 2, '0000-00-00 00:00:00', '2013-06-23 21:04:48', 0, 'asfd', 'adsf', 'asdf', 'fasdf', 'dsaf', 'asdf', ''),
(14, 2, '0000-00-00 00:00:00', '2013-06-23 21:05:01', 0, 'adsf', 'asdf', 'adsf', 'adsf', 'dfasd', 'asfd', ''),
(15, 2, '0000-00-00 00:00:00', '2013-06-23 21:09:26', 0, 'asdfa', '', '', '', '', '', ''),
(16, 2, '0000-00-00 00:00:00', '2013-06-23 21:12:50', 0, 'asdfa', '', '', '', '', '', ''),
(17, 2, '0000-00-00 00:00:00', '2013-06-23 21:13:24', 0, 'asdfa', '', '', '', '', '', ''),
(18, 2, '0000-00-00 00:00:00', '2013-06-23 21:15:00', 0, 'fsa', '', '', '', '', '', ''),
(19, 2, '0000-00-00 00:00:00', '2013-06-23 21:16:24', 0, 'fsa', '', '', '', '', '', ''),
(20, 2, '0000-00-00 00:00:00', '2013-06-23 21:22:52', 0, 'asdf', '', '', '', '', '', ''),
(21, 2, '0000-00-00 00:00:00', '2013-06-23 21:23:55', 0, 'sadf', 'dsaf', 'fas', '', '', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`, `begin`, `end`) VALUES
(1, 2, '2013-06-02 00:00:00', '2013-06-23 22:01:10', 1, 'Projekt 1', 'Testbeschreibung', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, '2013-06-02 00:00:00', '2013-06-23 22:08:04', 1, 'Projekt 2', 'balba asdfa', 'Offen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
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
(19, 2, '0000-00-00 00:00:00', '2013-06-23 22:21:38', 0, 'sfasfasdfasdfasdf', 'sfd', 'Offen', '2013-06-24 00:21:38', '2013-06-24 00:21:38'),
(20, 4, '0000-00-00 00:00:00', '2013-06-18 19:06:40', 0, 'Projekt 75', 'Dies ist eine Testbeschreibung', 'Geschlossen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 2, '0000-00-00 00:00:00', '2013-06-23 22:21:31', 0, 'adsf', 'adfs', 'Offen', '2013-06-24 00:21:31', '2013-06-24 00:21:31'),
(22, 2, '0000-00-00 00:00:00', '2013-06-23 18:33:33', 0, 'gdsf', 'dgs', 'Offen', '2013-06-23 20:33:33', '2013-06-23 20:33:33'),
(23, 4, '0000-00-00 00:00:00', '2013-06-23 19:20:06', 0, 'adsf', 'asaf', 'Offen', '2013-06-23 21:20:06', '2013-06-23 21:20:06'),
(24, 3, '0000-00-00 00:00:00', '2013-06-23 19:20:11', 0, 'asdfa', 'asdfasdf', 'Offen', '2013-06-23 21:20:11', '2013-06-23 21:20:11'),
(25, 2, '0000-00-00 00:00:00', '2013-06-23 19:20:14', 0, 'asfd', 'afdssdf', 'Offen', '2013-06-23 21:20:14', '2013-06-23 21:20:14'),
(26, 2, '0000-00-00 00:00:00', '2013-06-23 19:20:20', 0, 'adsfa', 'fasfsdf', 'Offen', '2013-06-23 21:20:20', '2013-06-23 21:20:20'),
(27, 2, '0000-00-00 00:00:00', '2013-06-23 19:20:25', 0, 'afdsf', 'adsfsf', 'Offen', '2013-06-23 21:20:25', '2013-06-23 21:20:25'),
(28, 2, '0000-00-00 00:00:00', '2013-06-23 19:23:39', 0, 'afdsf', 'adsfsf', 'Offen', '2013-06-23 21:23:39', '2013-06-23 21:23:39'),
(29, 2, '0000-00-00 00:00:00', '2013-06-23 19:29:02', 0, 'afdsf', 'adsfsf', 'Offen', '2013-06-23 21:29:02', '2013-06-23 21:29:02'),
(30, 2, '0000-00-00 00:00:00', '2013-06-23 20:47:34', 0, 'asf', 'adsf', 'Offen', '2013-06-23 22:47:34', '2013-06-23 22:47:34'),
(31, 2, '0000-00-00 00:00:00', '2013-06-23 20:47:54', 0, 'asdfa', 'safs', 'Offen', '2013-06-23 22:47:54', '2013-06-23 22:47:54'),
(32, 2, '0000-00-00 00:00:00', '2013-06-23 21:55:11', 0, 'asdf', 'sadf', 'Offen', '2013-06-23 23:55:11', '2013-06-23 23:55:11'),
(33, 9, '0000-00-00 00:00:00', '2013-06-23 21:55:24', 0, 'testtet', 'testes', 'Offen', '2013-06-23 23:55:24', '2013-06-23 23:55:24'),
(34, 2, '0000-00-00 00:00:00', '2013-06-23 21:58:47', 0, '', '', 'Offen', '2013-06-23 23:58:47', '2013-06-23 23:58:47'),
(35, 2, '0000-00-00 00:00:00', '2013-06-23 21:59:19', 0, 'f', 'asdfasdf', 'Geschlossen', '2013-06-23 23:59:19', '2013-06-23 23:59:19');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Daten für Tabelle `task`
--

INSERT INTO `task` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`) VALUES
(1, 2, '2013-06-02 00:00:00', '2013-06-01 17:09:08', 0, 'Aufgabe 1', 'asdfafsdf', 'offen'),
(2, 2, '2013-06-02 00:00:00', '2013-06-01 17:09:05', 0, 'Task 2', 'asdfafsdf', 'offen'),
(3, 1, '0000-00-00 00:00:00', '2013-06-23 18:41:36', 0, '', '', 'Offen'),
(4, 1, '0000-00-00 00:00:00', '2013-06-23 18:43:36', 0, 'afdsfa', 'sfsadf', 'Offen'),
(5, 1, '0000-00-00 00:00:00', '2013-06-23 18:44:28', 0, 'afdsfa', 'sfsadf', 'Offen'),
(6, 1, '0000-00-00 00:00:00', '2013-06-23 18:45:08', 0, 'afdsfa', 'sfsadf', 'Offen'),
(7, 1, '0000-00-00 00:00:00', '2013-06-23 18:45:10', 0, 'afdsfa', 'sfsadf', 'Offen'),
(8, 1, '0000-00-00 00:00:00', '2013-06-23 18:45:32', 0, 'afdsfa', 'sfsadf', 'Offen'),
(9, 1, '0000-00-00 00:00:00', '2013-06-23 18:46:15', 0, 'afdsfa', 'sfsadf', 'Offen'),
(10, 1, '0000-00-00 00:00:00', '2013-06-23 18:46:29', 0, 'afdsfa', 'sfsadf', 'Offen'),
(11, 1, '0000-00-00 00:00:00', '2013-06-23 18:46:51', 0, 'asdf', 'daf', 'Offen'),
(12, 1, '0000-00-00 00:00:00', '2013-06-23 18:48:19', 0, 'asdf', 'daf', 'Offen'),
(13, 1, '0000-00-00 00:00:00', '2013-06-23 18:50:09', 0, 'adsf', 'dsaf', 'Offen'),
(14, 1, '0000-00-00 00:00:00', '2013-06-23 18:50:51', 0, 'adsf', 'dsaf', 'Offen'),
(15, 1, '0000-00-00 00:00:00', '2013-06-23 18:52:13', 0, 'adsf', 'dsaf', 'Offen'),
(16, 1, '0000-00-00 00:00:00', '2013-06-23 18:53:01', 0, 'adsf', 'dsaf', 'Offen'),
(17, 1, '0000-00-00 00:00:00', '2013-06-23 18:54:52', 0, 'adsf', 'dsaf', 'Offen'),
(18, 1, '0000-00-00 00:00:00', '2013-06-23 18:55:29', 0, 'adsf', 'dsaf', 'Offen'),
(19, 1, '0000-00-00 00:00:00', '2013-06-23 21:52:50', 0, 'asdf', 'sadf', 'Offen'),
(20, 7, '0000-00-00 00:00:00', '2013-06-23 22:23:02', 0, 'fasd', 'asdf', 'Offen'),
(21, 7, '0000-00-00 00:00:00', '2013-06-23 22:23:05', 0, 'sfdasdfsdf', 'adsfa', 'Offen'),
(22, 7, '0000-00-00 00:00:00', '2013-06-23 22:23:09', 0, 'fsdfsdfa', 'dsafsd', 'Offen'),
(23, 20, '0000-00-00 00:00:00', '2013-06-23 22:24:02', 0, 'xasdf', 'sfsdfasfd', 'Offen'),
(24, 20, '0000-00-00 00:00:00', '2013-06-23 22:24:05', 0, 'afs', 'asfadsf', 'Offen'),
(25, 20, '0000-00-00 00:00:00', '2013-06-23 22:24:09', 0, 'asdf', 'sadf', 'Offen');

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
  `disable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `password`, `last_login`, `first_name`, `last_name`, `admin`, `email`, `confirm_hash`, `disable`) VALUES
(1, 0, '2013-04-16 00:00:00', '2013-06-01 12:11:53', 0, 'hans', 'wurst', '0000-00-00 00:00:00', 'Hans', 'Wurst', 0, 'hans.wurst@bockwurstwasser.de', '', 0),
(2, 0, '2013-04-19 16:59:43', '2013-06-24 19:56:41', 0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2013-06-24 21:53:44', 'Max', 'Mustermann', 1, 'quid@gmx.de', '', 0),
(3, 0, '0000-00-00 00:00:00', '2013-06-24 19:58:40', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-24 21:58:40', 'adsaf', 'asdf', 0, '', '', 1),
(4, 0, '0000-00-00 00:00:00', '2013-06-24 19:57:34', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-24 21:57:34', '', '', 0, '', '', 0),
(5, 0, '0000-00-00 00:00:00', '2013-06-21 20:31:07', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:31:07', '', '', 0, '', '', 0),
(6, 0, '0000-00-00 00:00:00', '2013-06-21 20:44:51', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-21 22:44:51', '', '', 0, '', '', 0),
(7, 0, '0000-00-00 00:00:00', '2013-06-24 20:04:29', 0, 'hanse', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-24 22:04:29', 'saf', 'adsf', 0, '', '', 0),
(8, 0, '0000-00-00 00:00:00', '2013-06-23 12:16:36', 0, '', '06a998cdd13c50b7875775d4e7e9fa74', '2013-06-23 14:16:36', '', '', 0, '', '', 0),
(9, 0, '0000-00-00 00:00:00', '2013-06-23 12:19:34', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-23 14:19:34', '', '', 0, '', '', 0),
(10, 0, '0000-00-00 00:00:00', '2013-06-23 12:19:40', 0, '', 'd41d8cd98f00b204e9800998ecf8427e', '2013-06-23 14:19:40', '', '', 0, '', '', 0),
(11, 0, '0000-00-00 00:00:00', '2013-06-23 13:19:00', 0, 'hansi', '5452eea2e1ff9cefa25f5fb590386dfb', '2013-06-23 15:19:00', 'Hans', 'Bockwurst', 0, 'hans@bockwurst.de', '', 0),
(12, 0, '0000-00-00 00:00:00', '2013-06-24 20:12:10', 0, 'hansiae', '098f6bcd4621d373cade4e832627b4f6', '2013-06-24 22:12:10', 'adsf', 'sfda', 0, 'test@test.de', '80c0641b690a1db7ffb7f57d4d713da2', 1),
(13, 0, '0000-00-00 00:00:00', '2013-06-24 20:33:26', 0, 'hansiqewr', '098f6bcd4621d373cade4e832627b4f6', '2013-06-24 22:33:26', 'asdf', 'safd', 0, 'quid@gmx.de', '2a4329ce489e9cca3d1e31b2785a9a27', 0);
