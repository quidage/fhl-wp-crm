<?php

/**
 * Autoloader for classes
 * path defined by namespace
 * 
 * @param type $className
 */
function __autoload($className) {
    $dirname = dirname(__FILE__);
    $filename = "" . str_replace('\\', '/', $className) . '.php';
    
    // TODO catch file not found
    require_once $dirname .  '/' . $filename;
}

/**
 * Load Action by Request
 * 
 * Loads default Actions for controllers when action parameter not set
 * 
 * @return void
 */
function actionLoader() {
    
    // Default Actions for Controllers
    $defaultActions = array(
        'customer' => 'list',
        'user' => 'show',
        'project' => 'list'
    );
    
    // TODO clean up request
    $requestParams = $_GET;
    
    if (isset($requestParams['controller'])) { 
        $controller = \EJC\Library\StringFactory::cleanUp($requestParams['controller']);

        // Set default action if not set
        if (empty($requestParams['action'])) {
            $action = $defaultActions['controller'];
        } else {
            $action = \EJC\Library\StringFactory::cleanUp($requestParams['action']);
        }
        
    } else {
        // Frontpage
        $controller = 'user';
        $action = 'start';
    }
   
    // Load action
    // TODO catch Action not found
    $controllerName = '\\EJC\\Controller\\' . ucwords($controller) . 'Controller';
    $actionName = $action . 'Action'; 
    $controllerInstance = new $controllerName($action, ucwords($controller));
    $controllerInstance->$actionName(); 
}

?>