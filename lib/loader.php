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
    
    if (file_exists($classFile)) {
        require_once $classFile;
    } else {
        throw new \EJC\Exception\ClassLoaderException('Class "' . $classFile . '" no found', 1366377452);
    }
}

?>