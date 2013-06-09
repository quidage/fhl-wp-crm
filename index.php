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
define(APPROOT, dirname(__FILE__));

// Lade den Autoloader
require_once APPROOT . '/lib/loader.php';

// Instanziere den Request
$request = new \EJC\Request();
$request->execute();

?>			