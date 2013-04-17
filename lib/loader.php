<?php

/**
 * Autoloader for classes
 * path defined by namespace
 * 
 * @param type $className
 */
function __autoload($className) {
    $classFile = __AppRoot__ . '/lib/' . str_replace('\\', '/', $className) . '.php';
    // TODO catch file not found
    require_once $classFile;
}

?>