-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Dump erstellt mit PHPMyAdmin
-- Dieser Dump h�lt die finalen Testdaten
--
--
-- created by Enrico Lauterschlag <enrico.lauterschlag@web.de>
--
-- Host: localhost
-- Erstellungszeit: 25. Jun 2013 um 22:13
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `customer`
--

INSERT INTO `customer` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `street`, `zip`, `city`, `phone`, `fax`, `email`) VALUES
(1, 2, '0000-00-00 00:00:00', '2013-06-25 19:07:44', 1, '', '', '', '', '', '', ''),
(2, 15, '0000-00-00 00:00:00', '2013-06-25 19:09:14', 0, 'Hans Meier', 'Adlerhorst 2', '22309', 'Düsseldorf', '0211 533 688', '0211 533 689', 'hans@meier.de'),
(3, 15, '0000-00-00 00:00:00', '2013-06-25 19:10:34', 0, 'Vera Wagemut', 'Apfelwiese 12', '53894', 'Chemnitz', '05964 4896 245', '05964 4896 250', 'vera.wagemut@web.de'),
(4, 15, '0000-00-00 00:00:00', '2013-06-25 19:11:47', 0, 'Klaus Allofs', 'Hamburgerstr. 259', '18962', 'Wolfsburg', '0459 589 1', '0459 589 2', 'klaus.allofs@vfl-wolfsburg.de'),
(5, 15, '0000-00-00 00:00:00', '2013-06-25 19:12:36', 0, 'Rainer Schmidt', 'Rosenbuschweg 9', '22308', 'Hamburg', '040 2115 895', '040 2115 900', 'rainer-schmidt@gmx.de'),
(6, 15, '0000-00-00 00:00:00', '2013-06-25 19:13:23', 0, 'Max Mustermann', 'Musterstr. 278', '12345', 'Musterstadt', '040 1234567', '040 1234568', 'max.mustermann@online.de'),
(7, 15, '0000-00-00 00:00:00', '2013-06-25 19:14:22', 0, 'Karla Kolumna', 'Spiegelstr. 2a', '59484', 'Koblenz', '069 5894 2569', '069 5894 2570', 'karla.kolumna@spiegel.de'),
(8, 15, '0000-00-00 00:00:00', '2013-06-25 19:27:54', 0, 'David Bowie', 'Orchid Road 34', '49584', 'Deleware', '040 4574 25', '040 4574 26', 'david@bowie.de'),
(9, 15, '0000-00-00 00:00:00', '2013-06-25 19:28:56', 0, 'Rainald Grebe', 'Potsdamer Platz 1', '15894', 'Berlin', '030 9586 1584', '030 9586 2000', 'rainald.grebe@sony.de'),
(10, 15, '0000-00-00 00:00:00', '2013-06-25 19:30:32', 0, 'Heiner Lauterbach', 'Stammwiese 6', '21856', 'Duisburg', '0212 53648', '0212 53650', 'heiner@lauterbach.de'),
(11, 15, '0000-00-00 00:00:00', '2013-06-25 19:31:32', 0, 'Karl Karlsen', 'Karlsenallee 84', '22309', 'Düsseldorf', '0211 1589', '0211 1590', 'karl.karlsen@google.de'),
(12, 15, '0000-00-00 00:00:00', '2013-06-25 19:32:27', 0, 'Frank Richter', 'Osterbekstr. 56', '22083', 'Hamburg', '040 259 84', '040 259 56', 'frank.richter@otto.de'),
(13, 15, '0000-00-00 00:00:00', '2013-06-25 19:33:23', 0, 'Hildegard Müller', 'Hauptstr. 12', '18475', 'Wittenberge', '03884 5678910', '03884 5678911', 'hildegard.mueller@stern.de'),
(14, 15, '0000-00-00 00:00:00', '2013-06-25 19:34:06', 0, 'Volker Voss', 'Lange Reihe 1', '89458', 'München', '089 4895 148', '089 4895 150', 'volker.voss@bmw.de'),
(15, 16, '0000-00-00 00:00:00', '2013-06-25 20:02:41', 0, 'Hein Schrader', 'Kumpelweg 9', '22859', 'Dresden', '02589 156', '02589 157', 'heinschrader@aol.com'),
(16, 16, '0000-00-00 00:00:00', '2013-06-25 20:03:41', 0, 'Horst Rubesch', 'Schweriner Str. 10', '19888', 'Parchim', '03875 4985', '03875 4849', 'horst@rubesch.de'),
(17, 16, '0000-00-00 00:00:00', '2013-06-25 20:04:29', 0, 'Pawel Pipowisch', 'Krakauerweg 8', '15896', 'Cottbus', '0256 48956', '0256 48957', 'pawel@t-online.de'),
(18, 2, '0000-00-00 00:00:00', '2013-06-25 20:07:48', 0, 'Ursula Walter', 'Münstermannstr. 58', '22589', 'Hamburg', '040 2579 215', '040 2579 220', 'ursula.walter@gmx.de'),
(19, 2, '0000-00-00 00:00:00', '2013-06-25 20:08:53', 0, 'Klaus Müller', 'Bramfelder Str. 122', '22315', 'Hamburg', '040 566 655', '040 566 566', 'klaus.mueller@online.de');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `project`
--

INSERT INTO `project` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`, `begin`, `end`) VALUES
(1, 2, '0000-00-00 00:00:00', '2013-06-25 19:36:27', 0, 'BMW kaufen', 'Im August muss ich mir unbedingt einen BMW kaufen.', 'Offen', '2013-06-25 21:36:27', '2013-06-25 21:36:27'),
(2, 2, '0000-00-00 00:00:00', '2013-06-25 19:38:26', 0, 'Haus bauen', 'Herr Meier möchte endlich aus seiner Mietwohnung ausziehen und ein Eigenheim bauen.', 'Offen', '2013-06-25 21:38:26', '2013-06-25 21:38:26'),
(3, 6, '0000-00-00 00:00:00', '2013-06-25 19:39:09', 0, 'Website gestalten', 'Für die Website von Herrn Mustermann muss ein neues Layout erstellt werden', 'Geschlossen', '2013-06-25 21:39:09', '2013-06-25 21:39:09'),
(4, 11, '0000-00-00 00:00:00', '2013-06-25 19:40:16', 0, 'Datenbankentwurf anfertigen', 'Für die geplante Applikation von Herrn Karlsen wurden wir damit beauftragt, einen Datenbankentwurf zu erstellen.', 'Offen', '2013-06-25 21:40:16', '2013-06-25 21:40:16'),
(5, 15, '0000-00-00 00:00:00', '2013-06-25 20:04:55', 0, 'Android-App entwickeln', '', 'Offen', '2013-06-25 22:04:55', '2013-06-25 22:04:55'),
(6, 18, '0000-00-00 00:00:00', '2013-06-25 20:09:42', 0, 'Computer zusammenstellen', 'Für Frau Walter soll ein PC zum surfen im Internet zusammengestellt werden.', 'Offen', '2013-06-25 22:09:42', '2013-06-25 22:09:42'),
(7, 18, '0000-00-00 00:00:00', '2013-06-25 20:12:19', 0, 'Wartungsvertrag für den PC aufsetzen', '', 'Offen', '2013-06-25 22:12:19', '2013-06-25 22:12:19'),
(8, 19, '0000-00-00 00:00:00', '2013-06-25 20:13:05', 0, 'SEO Optimierung', 'Die Seite www.test.de soll für Suchmaschinen optimiert werden.', 'Geschlossen', '2013-06-25 22:13:05', '2013-06-25 22:13:05');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `task`
--

INSERT INTO `task` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `description`, `status`) VALUES
(1, 1, '0000-00-00 00:00:00', '2013-06-25 19:43:35', 0, 'Geld sparen', 'Zuerst muss Geld gespart werden.', 'Geschlossen'),
(2, 1, '0000-00-00 00:00:00', '2013-06-25 19:44:49', 0, 'Termin vereinbaren', 'Es muss ein Termin mit dem Autohändler vereinbart werden.', 'Offen'),
(3, 1, '0000-00-00 00:00:00', '2013-06-25 19:45:34', 0, 'BMW abholen', 'Der BMW kann nach dem Unterschreiben des Kaufvertrages abgeholt werden.', 'Offen'),
(4, 1, '0000-00-00 00:00:00', '2013-06-25 19:45:54', 0, 'Auto anmelden', 'Das Auto muss bei der Zulassungsstelle angemeldet werden.', 'Offen'),
(5, 2, '0000-00-00 00:00:00', '2013-06-25 19:47:13', 0, 'Architekturzeichnung', 'Der Architekt muss die Zeichnung anfertigen', 'Offen'),
(6, 2, '0000-00-00 00:00:00', '2013-06-25 19:47:37', 0, 'Fundament legen', 'Das Fundament wird gelegt', 'Offen'),
(7, 2, '0000-00-00 00:00:00', '2013-06-25 19:48:11', 0, 'Wände', 'Die Wände müssen gemauert werden.', 'Offen'),
(8, 2, '0000-00-00 00:00:00', '2013-06-25 19:48:46', 0, 'Dachdecker beauftragen', 'Eine Dachdeckerfirma muss beauftragt werden', 'Offen'),
(9, 2, '0000-00-00 00:00:00', '2013-06-25 19:48:55', 0, 'Dach eindecken', '', 'Offen'),
(10, 2, '0000-00-00 00:00:00', '2013-06-25 19:49:18', 0, 'Richtfest organisieren', 'Wenn das Dach fertig ist, wird gefeiert :)', 'Offen'),
(11, 2, '0000-00-00 00:00:00', '2013-06-25 19:49:32', 0, 'Innenausbaue beginnen', '', 'Offen'),
(12, 2, '0000-00-00 00:00:00', '2013-06-25 19:50:20', 0, 'Fliesen kaufen', 'Es müssen passende Fliesen ausgewählt werden.', 'Offen'),
(13, 2, '0000-00-00 00:00:00', '2013-06-25 19:50:55', 0, 'Weiter Sanitäreeinrichtungen kaufen', '- Toilette\r\n- Waschbecken\r\n- Badewanne', 'Offen'),
(14, 2, '0000-00-00 00:00:00', '2013-06-25 19:51:15', 0, 'Inneneinrichtung', 'Möbel müssen gekauft werden', 'Offen'),
(15, 2, '0000-00-00 00:00:00', '2013-06-25 19:51:28', 0, 'Türen kaufen', '', 'Offen'),
(16, 2, '0000-00-00 00:00:00', '2013-06-25 19:51:36', 0, 'Fenster kaufen', '', 'Offen'),
(17, 6, '0000-00-00 00:00:00', '2013-06-25 20:10:12', 0, 'Hardware kaufen', 'Die Hardware muss über Online-Versandhändler bestellt werden', 'Geschlossen'),
(18, 6, '0000-00-00 00:00:00', '2013-06-25 20:10:37', 0, 'Hardware einbauen', 'Hardware-Komponenten müssen in das Gehäuse gebaut werden.', 'Offen'),
(19, 6, '0000-00-00 00:00:00', '2013-06-25 20:11:00', 0, 'Software installieren', 'Betriebssystem und gängige Software installieren', 'Offen'),
(20, 6, '0000-00-00 00:00:00', '2013-06-25 20:11:22', 0, 'System testen', 'Das System auf Performance testen und Stabilität testen', 'Offen');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `parent_id`, `cr_date`, `tstamp`, `deleted`, `name`, `password`, `last_login`, `first_name`, `last_name`, `admin`, `email`, `confirm_hash`, `disable`) VALUES
(2, 0, '2013-04-19 16:59:43', '2013-06-24 19:56:41', 0, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2013-06-24 21:53:44', 'Max', 'Mustermann', 1, 'quid@gmx.de', '', 0),
(15, 0, '2013-06-25 21:00:00', '2013-06-25 19:01:55', 0, 'Enrico.Lauterschlag', 'e10adc3949ba59abbe56e057f20f883e', '2013-06-25 21:01:11', 'Enrico', 'Lauterschlag', 0, 'enrico.lauterschlag@web.de', '', 0),
(16, 0, '2013-06-25 21:03:20', '2013-06-25 19:05:30', 0, 'Christian.Hansen', 'e10adc3949ba59abbe56e057f20f883e', '2013-06-25 21:03:51', 'Christian', 'Hansen', 0, 'quid@gmx.de', '', 0),
(17, 0, '2013-06-25 21:04:23', '2013-06-25 19:05:30', 0, 'Julian.Hilbers', 'e10adc3949ba59abbe56e057f20f883e', '2013-06-25 21:05:21', 'Julian', 'Hilbers', 0, 'julian@hilbers.de', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
