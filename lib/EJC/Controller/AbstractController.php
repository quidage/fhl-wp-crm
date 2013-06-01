<?php

namespace EJC\Controller;

/**
 * Allgemeine Controller-Methoden
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class AbstractController {

    protected $controllerName;
    protected $actionName;
    protected $ajax;
    protected $view;
    protected $request;
    protected $customerRepository;    
    protected $projectRepository;    
    protected $userRepository;

    /**
     * Konstruktor
     * 
     * @return void
     */
    public function __construct(\EJC\Request $request, \EJC\View $view = NULL) {
        $this->view = $view;
        $this->request = $request;
        $this->initView();
        $this->initRepositories();
    }
    
    /**
     * Instanziiere die Repositories
     * 
     * @return void
     */
    public function initRepositories() {
        $this->customerRepository = new \EJC\Repository\CustomerRepository();
        $this->projectRepository = new \EJC\Repository\ProjectRepository();
        $this->userRepository = new \EJC\Repository\UserRepository();
    }
    
    /**
     * Initialisiere den View
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
    } // public function initView()

    /**
     * zu einer anderen Action weiterleiten
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
     * zu einer anderen Action als HTTP-Request weiterleiten
     * @todo funktoniert noch nicht richtig
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
    } // public function redirect($controller, $action, array $params = NULL)
    
    /*
     * Hole den aktuell eingeloggten User
     * 
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @return string
     */
    public function getCurrentUser(){
        return unserialize($_SESSION['user']); 
    }
    
}

?>
