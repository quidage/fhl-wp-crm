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
    
    /**
     * Get the class name of the Model
     * 
     * @return string
     */
    public function getModelClassName() {
        return '\\EJC\\Model\\' . ucwords($this->table);
    }
       	 
	/**
	 * find one object by property
     * 
	 * @param string $property
	 * @param string $value
	 */
	public function findOneByProperty($property, $value) {
		$query = $this->buildSelectQuery("*", $this->table, $property . " = '" . $this->prepareString($value) . "'", NULL, NULL, "0,1");
		return $this->getFirstResult($query);
	}   
    
	/**
	 * find objects by property
     * 
	 * @param string $property
	 * @param string $value
	 */
	public function findByProperty($property, $value) {
		$query = $this->buildSelectQuery("*", $this->table, $property . " = '" . $this->prepareString($value) . "'");
		return $this->getResultArray($query);
	}    

	/**
	 * Returns array of all results
	 * 
	 * @return array results
	 */
	public function findAll() {
		$query = $this->buildSelectQuery("*", $this->table, "deleted = 0");
        return $this->getResultArray($query);
	}

	/**
	 * Returns one result by id
	 * 
	 * @param int $id id
	 * @return array result
	 */
	public function findById($id) {
		$query = $this->buildSelectQuery("*", $this->table, "deleted = 0 AND uid = " . intval($id));
		return $this->getFirstByQuery($query);
	}

	/**
	 * Returns one result by id
	 * 
	 * @param int $id id
	 * @return array result
	 */
	public function findByParentId($id) {
        $query = $this->buildSelectQuery("*", $this->table, "deleted = 0 AND parent_id = " . intval($id));
		return $this->getResultArray($query);
	}

}

?>
