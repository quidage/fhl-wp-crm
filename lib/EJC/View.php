<?php

namespace EJC;

/**
 * Rendere das Template zu der Action
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class View {
    
    protected $template;
    protected $templateFile;
    protected $templatesPath;
    protected $layout;
    protected $layoutFile;
    protected $layoutsPath;
    protected $partialsPath;
    protected $resourcesPath;
    
    protected $errors;
    protected $errorMessages;


    /**
     * Konstruktor
     * 
     * @return void
     */
    public function __construct($ajax = FALSE) {
        if (!isset($this->errorMessages)) $this->errorMessages = array();
        $this->initPaths();
        // Set layout to default value
        if ($ajax) {
            $this->layoutFile = $this->layoutsPath . 'Ajax.php';
        } else {
            $this->layoutFile = $this->layoutsPath . 'Default.php';
        }
    }
    
    /**
     * Setze die Pfade 
     * 
     * @return void
     */
    public function initPaths() {
        $this->resourcesPath = __AppRoot__ . '/lib/EJC/Resources';
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
        
        include $this->layoutFile;
    }
    
    /**
     * Rendere die Url zum Aufruf einer Action
     * 
     * @param string $controller
     * @param string $action
     * @return void
     */
    public function getUrl($controller, $action) {
        echo 'index.php?controller=' . $controller . '&action=' . $action;
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
     * Füge der Ausgabe einen neuen Fehler hinzu
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
    
}

?>
