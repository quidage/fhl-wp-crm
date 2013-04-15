<?php

namespace EJC\Repository;

/**
 * 
 * @package wp-crm
 */
class ProjectRepository extends AbstractRepository {
	
	/**
	 * Constructor
	 * 
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		
		// Set the table
		$this->table = "project";
	}	
	
	/**
	 * Find all projects of customer
	 * 
	 * @param int $id Customer id
	 * @return array list of projects
	 */
	public function findByCustomer($id) {
		return $this->findByParentId($id);
	}
	
}

?>
