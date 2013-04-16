<?php

namespace EJC\Controller;

/**
 * Description of CustomerController
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class AbstractController {
    
    protected $controllerName;
    protected $actionName;
    protected $view;
    protected $ajax;


    public function __construct() {
        $this->initRequest();
        $this->initView();
    }
    
    /**
     * Get the variables of the request
     * 
     * 
     */
    public function initRequest() {
        $getParams = $_GET;
        
        $this->controllerName = ucwords(\EJC\Library\StringFactory::cleanUp($getParams['controller']));
        $this->actionName = \EJC\Library\StringFactory::cleanUp($getParams['action']);
        unset($getParams['controller']);
        unset($getParams['action']);
        
        // Set properties for each other parameter
        foreach ($getParams AS $key => $value) {
            if (is_string($value)) {
                $this->$key = \EJC\Library\StringFactory::cleanUp($value);
            } else {
                
            }
        };
    }
    
    /**
     * Wether is AJAX-Call or not
     * 
     * @return boolean
     */
    public function isAjax() {
        return $this->ajax;
    }
    
    /**
     * Initialize the view
     * 
     * @return void 
     */
    public function initView() {
         // Get path to template File for action
        $dirname = dirname(__FILE__);
        $templatesPath = substr($dirname, 0, (strripos($dirname, '/'))) . '/Ressources/Templates';
        $template = $templatesPath . '/' . $this->controllerName . '/' . ucwords($this->actionName) . '.inc';
        
        // Initialize the view
        $this->view = new \EJC\Library\View($template);
       
    }
    
}

?>
