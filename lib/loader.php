<?php

// autoloader for classes
// TODO catch file not found
function __autoload($className) {
    $dirname = dirname(__FILE__);
    $filename = "" . str_replace('\\', '/', $className) . '.php';
    require_once $dirname .  '/' . $filename;
}

// Load Action
function actionLoader() {
    
    // Default Actions for Controllers
    $defaultActions = array(
        'customer' => 'list',
        'user' => 'show',
        'project' => 'list'
    );
    
    // TODO clean up request
    $requestParams = $_GET;
    
    var_dump($requestParams);
    
    if (isset($requestParams['controller'])) { 
        $controller = $requestParams['controller'];

        // Set default action if not set
        if (empty($requestParams['action'])) {
            $action = $defaultActions['controller'];
        } else {
            $action = $requestParams['action'];
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
    $controllerInstance = new $controllerName;
    $controllerInstance->$actionName(); 
    
}
?>
