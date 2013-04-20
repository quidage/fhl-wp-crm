<?php

namespace EJC\Controller;

/**
 * Description of CustomerController
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class AbstractController {

    protected $controllerName;
    protected $actionName;
    protected $view;
    protected $request;
    protected $customerRepository;    
    protected $projectRepository;    
    protected $userRepository;

    /**
     * Constructor
     */
    public function __construct(\EJC\Request $request, \EJC\View $view = NULL) {
        $this->view = $view;
        $this->request = $request;
        $this->initView();
        $this->initRepositories();
    }
    
    /**
     * Instantiate the Repositories
     * 
     * @return void
     */
    public function initRepositories() {
        $this->customerRepository = new \EJC\Repository\CustomerRepository();
        $this->projectRepository = new \EJC\Repository\ProjectRepository();
        $this->userRepository = new \EJC\Repository\UserRepository();
    }
    
    /**
     * Initialize the view
     * 
     * @return void 
     */
    public function initView() {
         // Get path to template File for action
        $template = $this->request->getController() . '/' . ucwords($this->request->getAction()) . '.php';
        
        // Initialize the view
        if ($this->view === NULL) {
            $this->view = new \EJC\View($this->ajax);
        }
        $this->view->setTemplate($template);
    }  

    /**
     * Forward to another action
     * 
     * @param string $controller
     * @param string $action
     * @param array $params
     */
    public function forward($controller, $action, array $params = array()) {
        $request = new \EJC\Request($action, $controller, $params, $this->view);
        $request->execute();
    }
    
    /**
     * http-redirect on action
     * 
     * @param string $controller
     * @param string $action
     * @param string $params
     */
    public function redirect($controller, $action, array $params = NULL) {
        $paramString = '';
        if (is_array($params)) {
            foreach ($params AS $key => $value) {
                $paramString .= '&' . $key . '=' . $value; 
            }
        }
        header('index.php?controller=' . strtolower($controller) . '&action=' . $action . $paramString);
        return;
    }
    
}

?>
