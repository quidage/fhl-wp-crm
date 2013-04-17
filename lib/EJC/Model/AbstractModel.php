<?php

namespace EJC\Model;

/**
 * Description of AbstractModel
 *
 * @author christian
 */
class AbstractModel {

    protected $id;
    protected $parent_id;
    protected $cr_date;
    protected $tstamp;
    protected $deleted;
    protected $name;

    public function __construct() {
        $this->id = intval($this->id);
        $this->parent_id = intval($this->parent_id);
        $this->cr_date = intval($this->cr_date);
        $this->deleted = filter_var($this->deleted, FILTER_VALIDATE_BOOLEAN);
    }

    public function getId() {
        return intval($this->id);
    }

    public function getParent_id() {
        return $this->parent_id;
    }
    
    public function getCr_date() {
        return $this->cr_date;
    }    

    public function getTstamp() {
        return $this->tstamp;
    }

    public function setTstamp($tstamp) {
        $this->tstamp = $tstamp;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
}

?>
