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
     * 
     * @return void
     */
    public function __construct($action = NULL, $controller = NULL, array $params = array(), View $view = NULL) {
        
        if ($controller !== NULL && $action !== NULL) {
            // Request wird ueber forward-Funktion ausgeloest
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
            unset($getParams['controller']);
            unset($getParams['action']);
            
            // Pruefe ob der User eingeloggt ist, wenn es sich nicht um die login-Action handelt
            if (strtolower($this->action) !== 'login') {
                // Wenn User nicht eingeloggt, schicke ihn auf die Login-Seite
                if (!isset($_SESSION[login]) || $_SESSION['login'] < time() -1800) {
                    $this->controller = 'User';
                    $this->action = 'showLogin';
                    $this->params = array();
                    return;
                } else {
                    $_SESSION['login'] = time();
                }
            }
            
            $this->params = array_merge($getParams, $postParams);

            // Hole den Typen des uebergebenen Objekts
            foreach ($this->params AS $paramName => $paramValues) {

                // Erstelle ein neues Objekt des Typs, wenn der Anfang des 
                // Parameternamens "new" ist
                if (substr($paramName, 0, 3) === 'new') {

                    $newObjectClassName = '\\EJC\\Model\\' . ucWords(substr($paramName, 3));
                    $object = new $newObjectClassName();

                    // Setze die Eigenschaften fuer das neue Objekt, welche in 
                    // den Paramtern uebergeben werden
                    if (is_array($paramValues)) {
                        foreach ($paramValues AS $paramValueKey => $paramValueValue) {
                            call_user_func_array(array($object, 'set' . ucwords($paramValueKey)), array($paramValueValue));
                        }
                    }
                    $this->params[] = $object;
                    unset($this->params[$paramName]);
                } else {
                    // Pruefe ob ein Gegenpart zu dem Request im Repository existiert
                    // und lade diesen
                    $repositoryClassName = '\\EJC\\Repository\\' . ucWords($paramName) . 'Repository';
                    try {

                        $repository = new $repositoryClassName();
                        if (is_array($paramValues)) {

                            // Finde das entsprechende Ojekt in der DB
                            $object = $repository->findById(intval($paramValues['id']));
                            unset($paramValues['id']);

                            if ($object === NULL) {
                                throw new Exception\RepositoryException('object has no counterpart in repository', 1366378567);
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
                        $this->params[] = $object;
                        unset($this->params[$paramName]);
                    } catch (\EJC\Exception\ClassLoaderException $e) {
                        // Es existiert kein Model zu dem Paramter
                        // throw $e;
                    }
                }
            }
        }

        // Rufe default action auf, wenn controller und action nicht gesetzt
        if (empty($this->controller) && empty($this->action)) {
            $this->controller = 'User';
            $this->action = 'showLogin';
        }
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
        call_user_func_array(array($controller, $actionName), $this->params);
    }

    /**
     * Ob es sich um einen Ajax-Aufruf handelt
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

}

?>
