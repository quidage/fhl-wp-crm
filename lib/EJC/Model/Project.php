<?php

namespace EJC\Model;

/**
 * Das User-Model
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class Project extends AbstractModel {
    
    /**
     * Beschreibung
     * 
     * @var string
     */
    protected $description;
    
    /**
     * Sorge dafuer, dass die Eigenschaften die richtigen Datentypen bekommen
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Hole die Beschreibung
     * 
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Setze die Beschreibung
     * 
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = trim($description);
    }

}

?>
