<?php

/**
 * Index Datei fuer EJC Kunden-/Projektdatenbank
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */

// Starte die Session
session_start();

// Definiere Konstanten
define(__AppRoot__, dirname(__FILE__));

// Lade den Autoloader
require_once __AppRoot__ . '/lib/loader.php';

// Instanziere den Request
$request = new \EJC\Request();
$request->execute();

?>			