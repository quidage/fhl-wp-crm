<?php

// autoloader for classes
function __autoload($className) {
    $filename = "" . str_replace('\\', '/', $className) . '.php';
    require_once $filename;
}

?>
