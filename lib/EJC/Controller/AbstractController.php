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
     * Limit fuer die Darstellung in den Listen
     *
     * @var int
     */
    protected $limit;

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
     * Paramter welche vom Request uebergeben werden
     *
     * @var array
     */
    protected $params;

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
        $this->request = $request;
        $this->params = $this->request->getParams();
        $this->view = $view;
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
        // Setze den Template Pfad
        $template = $this->request->getController() . '/' . ucwords($this->request->getAction()) . '.php';

        // Initialisiere den View
        if ($this->view === NULL) {
            $this->view = new \EJC\View($this->request, $this->ajax);
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
     * zu einer anderen Action als HTTP-Redirect weiterleiten
     *
     * @param string $controller
     * @param string $action
     * @param string $params
     */
    public function redirect($controller, $action, array $params = NULL) {
        $paramString = '';
        if (is_array($params)) {
            foreach ($params AS $key => $value) {
                if (is_object($value)) {
                    $paramString .= '&' . strtolower($key) . '[id]=' . $value->getId();
                } else {
                    $paramString .= '&' . $key . '=' . $value;
                }
            }
        }
        header('Location: ' . $this->view->getUrl($controller, $action) . $paramString);
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

    /**
     * Versende eine E-Mail
     *
     * @param string $content
     * @param string $receiver
     * @param string $cc
     * @param string $bcc
     * @return void
     */
    public function sendMail($receiver, $subject, $content) {
        include_once APPROOT . '/lib/config.php';
        //$mailSent = mail($receiver, $subject, $content, "From: " . $config['sender'] . "\r\n");
        $mailSent = mail($receiver, $subject, $content);
        if(!$mailSent) {
            $this->view->addErrorMessage('Die E-Mail konnte nicht verschickt werden.');
        }
        return $mailSent;
    }

}

?>
