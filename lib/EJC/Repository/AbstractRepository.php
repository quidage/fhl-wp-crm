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
    
    protected  $notUpdateableKeys = array('id', 'tstamp', 'cr_date');
    
    /**
     * define "magic" repository functions
     * 
     * @param string $name
     * @param array $arguments
     * @return
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
            $property = strtolower(substr($name, 6));
            return $this->findOneByProperty($property, $arguments[0]);        
            
            
        } else {
            throw new \Exception('method "' . $name . '" not available in this repository', 1366208633);
        }
    }
    
    /**
     * Get the class name of the Model
     * 
     * @return string
     */
    public function getModelClassName() {
        return 'EJC\\Model\\' . ucwords($this->table);
    }
    
    /**
     * Add object to repository
     * 
     * @param type $object
     * @return int Insert ID
     */
    public function add($object) {
        $objectArray = $object->toArray();
        
        // remove properties from array which should not be inserted in db
        foreach ($this->notUpdateableKeys AS $notUpdateableKey) {
            unset($objectArray[$notUpdateableKey]);
        }        

        // some keys should not be inserted and some values must be converted or set
        $objectArray['cr_date'] = date("Y-m-d H:i:s", time());
        
        return $this->insert($objectArray);
    }
    
    /**
     * remove object from repository
     * 
     * @param type $object
     * @return void
     */
    public function remove($object) {
        $this->delete($object->getId());
    }
    
    /**
     * update object in repository
     * 
     * @param object $object
     */
    public function update($object) {
        $objectArray = $object->toArray();
        
        // remove properties from array which should not be inserted in db
        foreach ($this->notUpdateableKeys AS $notUpdateableKey) {
            unset($objectArray[$notUpdateableKey]);
        }        
        
        $this->updateOneById($object->getId(), $objectArray);
    }

}

?>
