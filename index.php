<?php

/**
 * Index Datei fuer EJC Kunden-/Projektdatenbank
 *
 * Es wird ein Objekt der Request-Klasse instanziiert, welche den Aufruf
 * der Actions steuert und die Parameter an die Funktionen uebergibt
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */

// Starte die Session
session_start();

// Definiere Konstanten
define(APPROOT, dirname(__FILE__));

// Lade den Autoloader
require_once APPROOT . '/lib/loader.php';

// Instanziere den Request
$request = new \EJC\Request();
$request->execute();

?>