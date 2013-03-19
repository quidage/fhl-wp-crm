<?php

require_once 'AbstractRepository.php';

/**
 * 
 * @package wp-crm
 */
class CustomerRepository extends AbstractRepository {
	
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
