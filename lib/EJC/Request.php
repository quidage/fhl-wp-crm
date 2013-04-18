<?php

namespace EJC;

/**
 * Handle Request
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class Request {
    
    protected $controller;
    protected $action;
    protected $params;
    protected $view;

    /**
     * Konstruktor
     */
    public function __construct($action = NULL, $controller = NULL, $params = NULL, $view = NULL) {
       if ($controller !== NULL && $action !== NULL) {
            // forwarded request
            $this->controller = $controller;
            $this->action = $action;
            $this->params = $params;
            $this->view = $view;
        } else {
            // HTTP-Request
            $getParams = $_GET;
            $postParams = $this->getPost();
            
            $this->controller = ucwords(\EJC\Helper\StringHelper::cleanUp($getParams['controller']));
            $this->action = \EJC\Helper\StringHelper::cleanUp($getParams['action']);   
            unset ($getParams['controller']);
            unset ($getParams['action']);
            
            $this->params = array_merge($getParams, $postParams);
        }
        
       
        // Set defaults, if controller and action not set
        if (empty($this->controller) && empty($this->action)) {
            $this->controller = 'User';
            $this->action = 'start';
        }
    }
    
    /**
     * Call the action
     * 
     * @return
     */
    public function callAction() {
        // Define className of Controler
        $controllerClassName = '\\EJC\\Controller\\' . $this->controller . 'Controller';

        // Instantiate Controller Object
        $controller = new $controllerClassName($this->controller, $this->action, $this->isAjax(), $this->params, $this->view);
               
        // Call action
        $actionName = $this->action . 'Action';
        $controller->$actionName($this->params);
    }
    
   /**
     * Wether is AJAX-Call or not
     * 
     * @return boolean
     */
    public function isAjax() {
        if (isset($_SERVER['XMLHttpRequest'])) {
            return TRUE;
        } else {
            return FALSE;
        }
    } 
    
    /**
     * get data of the http-post
     * 
     * @return array
     */
    public function getPost() {
        return $_POST;
    }    
    
}

?>
