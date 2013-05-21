<?php

namespace EJC\Repository;

/**
 * Repository fuer das Project
 * 
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class ProjectRepository extends AbstractRepository {
	
	/**
	 * Konstruktor
	 * 
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		
		// Setze die Tabelle
		$this->table = 'project';
	}	
	
	/**
	 * Finde alle Projects zu einem Customer
	 * 
	 * @param int $id Customer id
	 * @return array 
	 */
	public function findByCustomer($id) {
		return $this->findByParentId($id);
	}
	
}

?>
