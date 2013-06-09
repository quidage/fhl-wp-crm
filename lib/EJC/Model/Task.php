<?php

namespace EJC\Model;

/**
 * Das Task-Model
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class Task extends AbstractModel {
    
    /**
     * Beschreibung
     * 
     * @var string
     */
    protected $description;

    /**
     * Status des Tasks
     * 
     * @var string
     */
    protected $status;

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

    /**
     * Hole den Status
     * 
     * @return string
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Setze den Status
     * 
     * @param string $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }
    
    /**
     * Hole alle moeglichen Status fuer das Model 
     * 
     * @return array
     */
    public function getPossibleStatus() {
        return array('Offen', 'Geschlossen');
    }    

}
?>
