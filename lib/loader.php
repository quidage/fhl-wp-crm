<?php

/**
 * Autoloader
 * 
 * der Klassenpfad definiert sich ueber den Namespace
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 * 
 * @param string $className
 * @return void
 */
function __autoload($className) {
    $classFile = APPROOT . '/lib/' . str_replace('\\', '/', $className) . '.php';
    // TODO catch file not found
    
    if (file_exists($classFile)) {
        require_once $classFile;
    } else {
        throw new \EJC\Exception\ClassLoaderException('Class "' . $classFile . '" not found', 1366377452);
    }
}

?>