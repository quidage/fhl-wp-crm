<?php

namespace EJC\Repository;

/**
 * 
 * @package wp-crm
 */
class UserRepository extends AbstractRepository {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct();
		
		// Set the table
		$this->table = "customer";
	}
	
}

?>
