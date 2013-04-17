<?php

namespace EJC\Library;

/**
 * Description of View
 *
 * @author Christian Hansen<christian.hansen@stud.fh-luebeck.de>
 */
class View {
    
    protected $template;
    protected $templateFile;
    protected $layout;
    protected $layoutFile;
    
    /**
     * Konstruktor
     * 
     * @param string $template
     * @param string $layout
     */
    public function __construct($template = NULL, $layout = NULL) {
        $this->templateFile = $template;
        $layoutDir = '/var/www/fhl-wp-crm/lib/EJC/Ressources/Layouts/';
        
        if ($layout !== NULL) {
            $this->layoutFile = $layoutDir . ucwords($layout) . '.inc';
        }
            $this->layoutFile = $layoutDir . 'Default.inc';
    }
    
    /**
     * Sets the template paht
     * 
     * @param string $template
     */
    public function setTemplateFile($templateFile) {
        $this->templateFile = $templateFile;
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
        
        include $this->templateFile;
        include $this->layoutFile;
                
        echo $this->layout;
    }
    
    /**
     * Read the content from the template file
     * 
     * @param string $layout
     * @return void
     */
    public function setLayout($layout) {
        $this->layoutFile = $layout;
    }  
    
}

?>
