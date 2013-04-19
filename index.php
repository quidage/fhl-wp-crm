<?php

/**
 * Index file for EJC CRM
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */

// define constants
define(__AppRoot__, dirname(__FILE__));

// autoloader
require_once __AppRoot__ . '/lib/loader.php';

// Instantiate request and call action
$request = new \EJC\Request();
$request->execute();

?>			