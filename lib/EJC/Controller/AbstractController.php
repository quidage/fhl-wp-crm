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
    
    protected $userRepository;
    protected $customerRepository;
    

    /**
     * Constructor
     */
    public function __construct($controllerName, $actionName, $ajax = FALSE) {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->ajax = $ajax;
        $this->initView();
        $this->initRepositories();
    }
    
    /**
     * Instantiate the Repositories
     * 
     * @return void
     */
    public function initRepositories() {
        $this->userRepository = new \EJC\Repository\UserRepository();
        $this->customerRepository = new \EJC\Repository\CustomerRepository();
    }
    
    /**
     * Initialize the view
     * 
     * @return void 
     */
    public function initView() {
         // Get path to template File for action
        $template = $this->controllerName . '/' . ucwords($this->actionName) . '.inc';

        // Initialize the view
        $this->view = new \EJC\View($this->ajax);
        $this->view->setTemplate($template);
    }  

    /**
     * Forward to another action
     * 
     * @param string $controller
     * @param string $action
     * @param array $params
     */
    public function forward($controller, $action, $params = NULL) {
        $request = new \EJC\Request($action, $controller, $params);
        $request->callAction();
    }
    
}

?>
