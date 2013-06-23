<?php

namespace EJC;

/**
 * Anhand der uebergebenen Parameter wird entschieden, welche Action aufgerufen
 * wird und was als Parameter an diese Action uebergeben wird
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Julian Hilbers <hilbers.julian@gmail.com>
 * @package wp-crm
 */
class Request {

    protected $controller;
    protected $action;
    protected $view;
	protected $ajax;
    protected $params = array();
    protected $actionParams = array();

    /**
     * Konstruktor
     *
     * @return void
     */
    public function __construct($action = NULL, $controller = NULL, array $params = array(), View $view = NULL) {

        if ($controller !== NULL && $action !== NULL) {
            // Request wird ueber forward-Methode aus dem AbstractController aufgerufen
            $this->controller = $controller;
            $this->action = $action;
            $this->view = $view;
            foreach ($params AS $param) {
                if (is_object($param)) {
                    $this->actionParams[] = $param;
                } else {
                    $this->params[] = $param;
                }
            }
        } else {
            // HTTP-Request, der Request wird von der index.php instanziiert
            $getParams = $this->getGetParams();
            $postParams = $this->getPostParams();

            $this->controller = ucwords(\EJC\Helper\StringHelper::cleanUp($getParams['controller']));
            $this->action = \EJC\Helper\StringHelper::cleanUp($getParams['action']);
			$this->ajax = (isset($getParams['ajax']) ? (boolean)$getParams['ajax'] : false );
            unset($getParams['controller']);
            unset($getParams['action']);
			unset($getParams['ajax']);

			// View initialisieren unter Beachtung des benötigten Layouts
			$this->view = new \EJC\View($this->isAjax());

            // Fuege GET- und POST-Paramenter zusammen
            $this->params = array_merge($getParams, $postParams);

            // Hole den Typen des uebergebenen Objekts
            foreach ($this->params AS $paramName => $paramValues) {

                // Erstelle ein neues Objekt des Typs, wenn der Anfang des
                // Parameternamens "new" ist
                if (substr($paramName, 0, 3) === 'new') {

                    // Schaue ob ein Model exisitert, wenn ja, dann erstelle neues Objekt
                    $newObjectClassName = '\\EJC\\Model\\' . ucWords(substr($paramName, 3));
                    $classFile = APPROOT . '/lib/' . str_replace('\\', '/', $newObjectClassName) . '.php';
                    if (file_exists($classFile)) {
                        $object = new $newObjectClassName();
                        // Setze die Eigenschaften fuer das neue Objekt, welche in
                        // den Paramtern uebergeben werden
                        if (is_array($paramValues)) {
                            foreach ($paramValues AS $paramValueKey => $paramValueValue) {
                                call_user_func_array(array($object, 'set' . ucwords($paramValueKey)), array($paramValueValue));
                            }
                        }
                        $this->actionParams = array_merge(array($object), $this->actionParams);
                        unset($this->params[$paramName]);
                    }
                } else {
                    // Pruefe ob ein Gegenpart zu dem Request im Repository existiert
                    // und lade diesen
                    $repositoryClassName = '\\EJC\\Repository\\' . ucWords($paramName) . 'Repository';
                    try {
                        // Erstelle ein Objekt der Repository-Klasse
                        $repository = new $repositoryClassName();
                        if (is_array($paramValues)) {

                            // Finde das entsprechende Objekt in der DB
                            $object = $repository->findById(intval($paramValues['id']));
                            unset($paramValues['id']);

                            if ($object === NULL) {
                                throw new \EJC\Exception\RepositoryException('object has no counterpart in repository', 1366378567);
                            } else {
                                if (is_array($paramValues)) {

                                    // Wenn mehrere Paramter uebergeben werden, setze bei
                                    // dem geladenen Objekt die uebergebenen Eigenschaften
                                    foreach ($paramValues AS $paramValueKey => $paramValueValue) {
                                        call_user_func_array(array($object, 'set' . ucwords($paramValueKey)), array($paramValueValue));
                                    }
                                }
                            }
                        }
                        $this->actionParams = array_merge(array($object), $this->actionParams);
                        unset($this->params[$paramName]);
                    } catch (\EJC\Exception\ClassLoaderException $e) {
                        // Es existiert kein Model zu dem Parameter
                        // tue weiter nichts und uebergebe den Parameter
                        //throw $e;

                    }
                }
            }
        }

        // Rufe default action auf, wenn controller und action nicht gesetzt
        if (empty($this->controller) && empty($this->action)) {
            $this->controller = 'User';
            if (isset($_SESSION['user'])) {
                $this->action = 'start';
            } else {
                $this->action = 'showLogin';
            }
        }

        // Pruefe der User eingeloggt ist
        $this->checkLogin();
    }

    /**
     * Rufe die action auf
     *
     * @return void
     */
    public function execute() {
        // Defieniere die aufzurufende Klasse und Action-Methode
        $controllerClassName = '\\EJC\\Controller\\' . $this->controller . 'Controller';
        $controller = new $controllerClassName($this, $this->view);
        $actionName = $this->action . 'Action';

        // Rufe die Action mit den Parametern auf
        call_user_func_array(array($controller, $actionName), $this->actionParams);
    }

    /**
     * Ob es sich um einen Ajax-Aufruf handelt
     *
     * @return boolean
     */
    public function isAjax() {
        if (isset($_SERVER['XMLHttpRequest']) || $this->ajax) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Pruefe ob der User eingeloggt ist, wenn es sich nicht um die login-Action handelt
     * nicht mehr eingeloggte User werden auf die Login-Action weitergeleitet
     *
     * @return void
     */
    public function checkLogin() {
        // Defiere die Actions, fuer welchen kein Login benoetigt wird
        $actionsWithoutNeedForLogin = array(
            'login', 'showLogin', 'register', 'createRegistered', 'requestNewPassword', 'sendNewPassword'
        );

        if (!in_array($this->action, $actionsWithoutNeedForLogin)) {
            // Wenn User nicht eingeloggt, schicke ihn auf die Login-Seite
            if (!isset($_SESSION['login']) ||  $_SESSION['login'] < time() - 1800) {

                session_destroy();
                header('Location: index.php');
            } else {
               // Setze den login-Zeitpunkt neu, dass der User wieder 30min hat, bis er
               // ausgeloggt wird
               $_SESSION['login'] = time();
            }
        }
    }

    /**
     * Hole die Post-Parameter
     *
     * @return array
     */
    public function getPostParams() {
        return $_POST;
    }

    /**
     * Hole die Get-Parameter
     *
     * @return array
     */
    public function getGetParams() {
        return $_GET;
    }

    /**
     * Gib den Controller_Namen zum Request zurueck
     *
     * @return string
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * Gib den Acton-Namen zum Request zurueck
     *
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * Gib alle Paramter in einem Array zurueck
     *
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * Hole die URL der aktuellen Seite
     *
     * @return string
     */
    public function getCurrentUrl() {
        return $_SERVER['REQUEST_URI'];
    }

}

?>
