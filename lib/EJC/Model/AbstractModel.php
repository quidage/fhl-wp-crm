<?php

namespace EJC\Model;

/**
 * Eigenschaften fuer alle Models
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class AbstractModel {

    /**
     * Die ID des Datensatzes
     *
     * @var int
     */
    protected $id;
    
    /**
     * Die ID des Elterndatensatzes
     *
     * @var int
     */
    protected $parent_id;
    
    /**
     * Zeitpunkt der Erstellung 
     * 
     * @var \DateTime
     */
    protected $cr_date;
    
    /**
     * Letzte Aenderung
     *
     * @var \DateTime
     */
    protected $tstamp;
    
    /**
     * Loeschen-Status
     * 
     * @var boolean
     */
    protected $deleted;
    
    /**
     * Name
     * 
     * @var string
     */
    protected $name;

    /**
     * Konstruktor
     * 
     * @return void
     */
    public function __construct() {
        $this->id = intval($this->id);
        $this->parent_id = intval($this->parent_id);
        $this->tstamp = new \DateTime($this->tstamp);
        $this->cr_date = new \DateTime($this->cr_date);
        $this->deleted = filter_var($this->deleted, FILTER_VALIDATE_BOOLEAN);
    }
    
    /**
     * Konvertiere ein Ojekt in ein Array
     * 
     * @return array
     */
    public function toArray() {
        $objectArray = array();
        foreach ($this AS $key => $value) {
            $objectArray[$key] = $value;
        }
        return $objectArray;
    }

    /**
     * Hole die ID
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Hole die ID des Eltern-Datensatzes
     * 
     * @return int
     */
    public function getParent_id() {
        return $this->parent_id;
    }
    
    /**
     * Hole den Zeitpunkt der Erstellung
     * 
     * @return \DateTime
     */
    public function getCr_date() {
        return $this->cr_date;
    }    

    /**
     * Hole den Zeitpunkt der letzten Aenderung
     * 
     * @return \DateTime
     */
    public function getTstamp() {
        return $this->tstamp;
    }

    /**
     * Setze den Zeitpunkt der letzten Aenderung
     * 
     * @param \DateTime $tstamp
     */
    public function setTstamp($tstamp) {
        $this->tstamp = $tstamp;
    }

    /**
     * Hole den Loeschen-Status
     * 
     * @return boolean
     */
    public function getDeleted() {
        return $this->deleted;
    }

    /**
     * Setze den Loeschen-Status
     * 
     * @param boolean $deleted
     */
    public function setDeleted($deleted) {
        $this->deleted = filter_var($deleted, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Hole den Namen
     * 
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Setze den Namen
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = trim($name);
    }
    
}

?>
