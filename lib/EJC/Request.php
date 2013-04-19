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
    public function __construct($action = NULL, $controller = NULL, array $params = NULL, View $view = NULL) {
       if ($controller !== NULL && $action !== NULL) {
            
            // forwarded request
            $this->controller = $controller;
            $this->action = $action;
            $this->params = $params;
            $this->view = $view;
            
        } else {
            
            // HTTP-Request
            // TODO clean up request Params
            $getParams = $this->getGetParams();
            $postParams = $this->getPostParams();
            
            $this->controller = ucwords(\EJC\Helper\StringHelper::cleanUp($getParams['controller']));
            $this->action = \EJC\Helper\StringHelper::cleanUp($getParams['action']);   
            unset ($getParams['controller']);
            unset ($getParams['action']);
            $this->params = array_merge($getParams, $postParams);

            // Get Type of oject
            foreach ($this->params AS $paramName => $paramValues) {
                
                // create new object of given Type
                if (substr($paramName, 0, 3) === 'new') {
                    
                    $newObjectClassName = '\\EJC\\Model\\' . ucWords(substr($paramName, 3));
                    $object = new $newObjectClassName();

                    // set Properties
                    if (is_array($paramValues)) {
                        foreach ($paramValues AS $paramValueKey => $paramValueValue) {
                            call_user_func_array(array($object, 'set' . ucwords($paramValueKey)), array($paramValueValue));
                        }
                    }
                    $this->params[] = $object;
                    unset($this->params[$paramName]);
                    
                } else {
                    
                    // check if user exists in db and
                    $repositoryClassName = '\\EJC\\Repository\\' . ucWords($paramName) . 'Repository';
                    try {
                        
                        $repository = new $repositoryClassName();
                        if (is_array($paramValues)) {

                            // find object in db
                            $object = $repository->findById(intval($paramValues['id']));
                            unset($paramValues['id']);
                            
                            if ($object === NULL) {
                                throw new Exception\RepositoryException('object has no counterpart in repository', 1366378567);
                            }
                            
                            foreach ($paramValues AS $paramValueKey => $paramValueValue) {
                                 call_user_func_array(array($object, 'set' . ucwords($paramValueKey)), array($paramValueValue));
                                
                            }
                        }
                        $this->params[] = $object;
                        unset($this->params[$paramName]);
                        
                    } catch (\EJC\Exception\ClassLoaderException $e) {
                        // parameter is not of type model
                        throw $e;
                    }
                }
            }
        }
        
        // Set defaults, if controller and action not set
        if (empty($this->controller) && empty($this->action)) {
            $this->controller = 'User';
            $this->action = 'showLogin';
        }
    }
    
    /**
     * Call the action
     * 
     * @return
     */
    public function execute() {
        // Define class and action
        $controllerClassName = '\\EJC\\Controller\\' . $this->controller . 'Controller';
        $controller = new $controllerClassName($this, $this->view);
        $actionName = $this->action . 'Action';      
        
        // Call action
        call_user_func_array(array($controller, $actionName), $this->params);
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
    public function getPostParams() {
        return $_POST;
    }    
    
    public function getGetParams() {
        return $_GET;
    }
    
    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }
    
    public function getParams() {
        return $this->params;
    }
    
}

?>
