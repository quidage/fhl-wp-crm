<?php

namespace EJC\Model;

/**
 * Das Project-Model
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
     * Status
     *
     * @var string
     */
    protected $status;

    /**
     * Beginn
     *
     * @var \DateTime
     */
    protected $begin;

    /**
     * Ende
     *
     * @var \DateTime
     */
    protected $end;

    /**
     * Sorge dafuer, dass die Eigenschaften die richtigen Datentypen bekommen
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->begin = new \DateTime($this->begin);
        $this->end = new \DateTime($this->end);
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
     * @return void
     */
    public function setStatus($status) {
        $this->status = trim($status);
    }

    /**
     * Hole alle Tasks zu dem Project
     *
     * @return array
     */
    public function getTasks() {
        $taskRepository = new \EJC\Repository\TaskRepository();
        return $taskRepository->findByParent_id($this->getId());
    }

    /**
     * Hole alle moeglichen Status fuer das Model
     *
     * @return array
     */
    public function getPossibleStatus() {
        return array('Offen', 'Geschlossen');
    }

    /**
     * Setze den Beginn
     *
     * @return \DateTime
     */
    public function getBegin() {
        return $this->begin;
    }

    /**
     * Hole den Beginn
     *
     * @param \DateTime $begin
     */
    public function setBegin(\DateTime $begin) {
        $this->begin = $begin;
    }

    /**
     * Hole das Ende
     *
     * @return \DateTime
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Setze das Ende
     *
     * @param \DateTime $end
     */
    public function setEnd(\DateTime $end) {
        $this->end = $end;
    }

}

?>
