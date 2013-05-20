<?php

namespace EJC\Repository;

/**
 * Repositoryfunctions for all repositories 
 * 
 * @author Christian Hansen <chrstian.hansen@stud.fh-luebeck.de>
 * 
 * @package wp-crm
 */
class AbstractRepository extends SqlRepository {

    protected $notUpdateableKeys;

    /**
     * Konstruktor
     * 
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->notUpdateableKeys = array('id', 'tstamp', 'cr_date');
    }

    /**
     * Definiere "magische" Repository-Funktionen, wie
     * 
     * findByEigenschaft
     * findOneByEigenschaft
     * 
     * @param string $name
     * @param array $arguments
     * @return void
     */
    public function __call($name, $arguments) {

        if (substr($name, 0, 6) === 'findBy') {
            /*
             * Magic findByProperty-Method
             *
             * examples:    findById(1)
             *              findByName('Testname')
             */
            $property = strtolower(substr($name, 6));
            return $this->findByProperty($property, $arguments[0]);
        } elseif (substr($name, 0, 9) === 'findOneBy') {
            /*
             * Magic findOneByProperty-Method
             *
             * examples:    findOneById(1)
             *              findOneByName('Testname')
             */
            $property = strtolower(substr($name, 9));
            return $this->findOneByProperty($property, $arguments[0]);
        } else {
            throw new \Exception('method "' . $name . '" not available in this repository', 1366208633);
        }
    } // public function __call($name, $arguments)

    /**
     * Get the class name of the Model
     * 
     * @return string
     */
    public function getModelClassName() {
        return 'EJC\\Model\\' . ucwords($this->table);
    }

    /**
     * Fuege ein Objekt dem Repository hinzu
     * 
     * @param type $object
     * @return int Insert ID
     */
    public function add($object) {
        $objectArray = $object->toArray();
        $arrayToInsert = $this->prepareArray($objectArray);
        return $this->insert($arrayToInsert);
    }

    /**
     * Entferne ein Ojekt aus dem Repository
     * 
     * @param type $object
     * @return void
     */
    public function remove($object) {
        $this->delete($object->getId());
    }

    /**
     * Aktulisiere ein Ojekt im Repository
     * 
     * @param object $object
     */
    public function update($object) {
        $objectArray = $object->toArray();
        $arrayToInsert = $this->prepareArray($objectArray);
        $this->updateOneById($object->getId(), $arrayToInsert);
    }
    
    /**
     * Es sollen nicht alle Werte des Objekts ueber das Array geschrieben
     * werden und DateTime muessen erst in einen String konvertiert werden
     * 
     * @param array $arrayToPrepare
     * @return array
     */
    protected function prepareArray($arrayToPrepare) {
        $arrayToInsert = array();
        foreach ($arrayToPrepare AS $key => $value) {
            if (!in_array($key, $this->notUpdateableKeys)) {
                if ($value instanceof \DateTime) {
                    $arrayToInsert[$key] = date("Y-m-d H:i:s", time());
                } else {
                    $arrayToInsert[$key] = $value;
                }
            }
        }
        return $arrayToInsert;
    } // protected function prepareArray($arrayToPrepare)

}

?>
