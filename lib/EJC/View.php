<?php

namespace EJC;

/**
 * Rendere das Template zu der Action
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class View {

	/**
	 * Der Inhalt des Templates
	 *
	 * @var string
	 */
    protected $template;

	/**
	 * Name der Template-Datei
	 *
	 * @var sting
	 */
    protected $templateFile;

	/**
	 * Pfad des Template-Ordners
	 *
	 * @var string
	 */
    protected $templatesPath;

    /**
     * Inhalt des Layouts
     *
     * @var string
     */
    protected $layout;

    /**
     * Pfad der Layout-Datei
     *
     * @var string
     */
    protected $layoutFile;

    /**
     * Pfad des Ordners der Layout-Dateien
     *
     * @var string
     */
    protected $layoutsPath;

	/**
	 * Pfad des Partial Ordners
	 *
	 * @var string
	 */
    protected $partialsPath;

	/**
	 * Pfad zum Ressources Ordner
	 *
	 * @var string
	 */
    protected $resourcesPath;

	/**
	 * Alle Fehlermeldungen in HTML gerendert
	 *
	 * @var string
	 */
    protected $errors;

	/**
	 * Array der Fehlermeldungen
	 *
	 * @var array
	 */
    public $errorMessages;

    /**
     * Der Request
     *
     * @var \EJC\Request
     */
    protected $request;

    /**
     * parameter
     *
     * @var array
     */
    protected $params;

    /**
     * Konstruktor
     *
     * @return void
     */
    public function __construct(\EJC\Request $request, $ajax = FALSE) {
        $this->request = $request;
        if (!isset($this->errorMessages)) $this->errorMessages = array();
        $this->initPaths();
        // Set layout to default value
        if ($ajax) {
            $this->layoutFile = $this->layoutsPath . 'Ajax.php';
        } else {
            $this->layoutFile = $this->layoutsPath . 'Default.php';
        }
        $this->params = $this->request->getGetParams();
    }

    /**
     * Setze das Limit
     *
     * @param int $limit
     */
    public function setLimit($limit) {
        $this->limit = (int) $limit;
    }

    /**
     * Setze die Pfade
     *
     * @return void
     */
    public function initPaths() {
        $this->resourcesPath = APPROOT . '/lib/EJC/Resources';
        $this->templatesPath = $this->resourcesPath .  '/Templates/';
        $this->layoutsPath = $this->resourcesPath .  '/Layouts/';
        $this->partialsPath = $this->resourcesPath .  '/Partials/';
    }

    /**
     * Lese den Inhalt auf dem Layout-File
     *
     * @param string $layout
     * @return void
     */
    public function setLayout($layout) {
        $this->layoutFile = $this->layoutsPath . ucwords($layout) . '.php';
    }

    /**
     * Setze Template-Pfad
     *
     * @param string $template
     */
    public function setTemplate($template) {
        $this->templateFile = $this->templatesPath . $template;
    }

    /**
     * Setze eien Variable zur Uebergabe an das Templdate
     *
     * @param string $key
     * @param mixed $value
     */
    public function assign($key, $value) {
        $this->$key = $value;
    }

    /**
     * Render das Template
     *
     * @return void;
     */
    public function render() {
        $this->renderErrorMessages();
        ob_start();
        include $this->templateFile;
        $this->template = ob_get_clean();
        ob_start();
        include $this->layoutFile;
        echo ob_get_clean();
    }


    /**
     * @author Julian Hilbers <hilbers.julian@gmail.com>
     * Generiert &uuml;ber die Methode getUrl einen kompletten a Tag
	 *
	 * @param string $title
     * @param string $controller
     * @param string $action
	 * @param array $params
     * @param string $ident			// Klasse als .Klassenname und Id als #id
	 * @param target $target
     * @return void
     */
    public function getLink($title, $controller, $action, $params = array(), $ident = '', $target = '') {
    	$fchar = substr($ident, 0, 1);
		$iVal = substr($ident, 1, strlen($ident));
		$url = $this->getUrl($controller, $action, $params);
		echo '<a '.($ident !== '' ? ( $fchar == '#' ? 'id' : 'class' ).'="'.$iVal.'"' : '').' href="'.$url.'"'.($target !== '' ? ' target="'.$target.'"':'').'>'.$title.'</a>';
    }

    /**
     * Rendere die Url zum Aufruf einer Action
     *
     * @param string $controller
     * @param string $action
	 * @param array $params
     * @return void
     */
    public function getUrl($controller, $action, $params = array()) {
        $url = 'index.php?controller=' . $controller . '&action=' . $action;
        foreach($params AS $key => $value) {
           $url .= '&' . $key . '=' . $value;
        }
        return $url;
    }

    /**
     *
     * @param string $numElements
     * @param string $limit
     */
    public function getPagination($numElements, $limitName) {
        if(isset($this->params[$limitName])) {
            $this->limit = (int) $this->params[$limitName];
        } else {
            $this->limit = 0;
        }
        ob_start();
        if ($numElements > 10) {
            if ($this->limit >= 10) {
                $this->getLink('Vorige', $this->request->getController(), $this->request->getAction(), array($limitName => $this->limit - 10));
            } else {
                echo 'Vorige';
            }
            echo " - ";
            if ($numElements - $this->limit - 10 > 0) {
                $this->getLink('N&auml;chste', $this->request->getController(), $this->request->getAction(), array($limitName => $this->limit + 10));
            } else {
                echo 'N&auml;chste';
            }
        }
        return ob_get_clean();
    }

    /**
     * Rendere ein Partial
     *
     * @param string $controller
     * @param string $partial
     * @return string rendered partial
     */
    public function renderPartial($controller, $partial) {
        ob_start();
        include $this->partialsPath . ucwords($controller) . '/' . ucwords($partial);
        return ob_get_clean();
    }

    /**
     * F&uuml;ge der Ausgabe einen neuen Fehler hinzu
     *
     * @param type $message
     */
    public function addErrorMessage($message) {
        $this->errorMessages[] = $message;
    }

    /**
     * Rendere die Fehlermeldungen
     *
     * @return void
     */
    public function renderErrorMessages() {
        $this->errors = '';
        foreach ($this->errorMessages AS $errorMessage) {
            $this->errors .= '<div class="error">' . $errorMessage . '</div>';
        }
    }

    /**
     * Hole den Admin-Status des eingeloggten Users
     *
     * @return boolean
     */
    public function getAdmin() {
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            return $user->getAdmin();
        }else{
            return false;
        }

    }

}

?>
