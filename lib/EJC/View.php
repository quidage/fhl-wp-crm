<?php

namespace EJC;

/**
 * The view renders Templates with content
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
    
    protected $errors;
    protected $errorMessages;


    /**
     * Constructor
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
     * Set Path for Templates, etc
     * 
     * @return void
     */
    public function initPaths() {
        $resourcesPath = __AppRoot__ . '/lib/EJC/Resources';
        $this->templatesPath = $resourcesPath .  '/Templates/';
        $this->layoutsPath = $resourcesPath .  '/Layouts/';        
    }

    /**
     * Read the content from the template file
     * 
     * @param string $layout
     * @return void
     */
    public function setLayout($layout) {
        $this->layoutFile = $this->layoutsPath . ucwords($layout) . '.php';
    }      

    /**
     * Sets the template path
     * 
     * @param string $template
     */
    public function setTemplate($template) {
        $this->templateFile = $this->templatesPath . $template;
    }

    /**
     * Assign variable to template
     * 
     * @param string $key
     * @param mixed $value
     */
    public function assign($key, $value) {
        $this->$key = $value;
    }
    
    /**
     * Render the template
     * 
     * @return void;
     */
    public function render() {
        $this->renderErrorMessages();
        ob_start();
        include $this->templateFile;
        $this->template = ob_get_clean();
        
        include $this->layoutFile;
        //echo $this->layout;
    }
    
    /**
     * add a new error to template
     * 
     * @param type $message
     */
    public function addErrorMessage($message) {
        $this->errorMessages[] = $message;
    }
    
    /**
     * render all error messages
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
