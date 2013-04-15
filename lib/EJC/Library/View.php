<?php

namespace EJC\Library;

/**
 * Description of View
 *
 * @author Christian Hansen<christian.hansen@stud.fh-luebeck.de>
 */
class View {
    
    protected $template;
    protected $html;
    
    public function __construct($template = NULL) {
        if ($template !== NULL) $this->template = $template;
    }
    
    /**
     * Sets the template paht
     * 
     * @param string $template
     */
    public function setTemplate($template) {
        $this->template = $template;
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
        $this->loadTemplate();
        echo $this->html;
    }
    
    /**
     * Read the content from the template file
     * 
     * @return void
     */
    public function loadTemplate() {
        
        // TODO write template parser
        $templateContent = file_get_contents($this->template);
        $this->html = $templateContent;
    }  
    
}

?>
