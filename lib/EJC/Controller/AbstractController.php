<?php

namespace EJC\Controller;

/**
 * Allgemeine Controller-Methoden
 * 
 * Initialisieren der Repositories und des Views
 * Weiterleiten an andere Actions
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
class AbstractController {

    /**
     *
     * @var string
     */
    protected $controllerName;

    /**
     *
     * @var string
     */
    protected $actionName;

    /**
     *
     * @var boolean
     */
    protected $ajax;

    /**
     *
     * @var \EJC\View
     */
    protected $view;

    /**
     *
     * @var \EJC\Request 
     */
    protected $request;

    /**
     *
     * @var \EJC\Repository\CustomerRepository
     */
    protected $customerRepository;

    /**
     *
     * @var \EJC\Repository\ProjectrRepository
     */
    protected $projectRepository;

    /**
     *
     * @var \EJC\Repository\UserrRepository
     */
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
        $this->userRepository = new \EJC\Repository\UserRepository();
        $this->customerRepository = new \EJC\Repository\CustomerRepository();
        $this->projectRepository = new \EJC\Repository\ProjectRepository();
        $this->taskRepository = new \EJC\Repository\TaskRepository();
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
    }

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
    }

    /**
     * Hole den aktuell eingeloggten User
     * 
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @return \EJC\Model\User
     */
    public function getCurrentUser() {
        return unserialize($_SESSION['user']);
    }

}

?>
