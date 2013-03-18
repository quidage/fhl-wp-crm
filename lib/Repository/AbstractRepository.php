<?php

/**
 * 
 */
class AbstractRepository {
	
	/**
	 *
	 * @var mysqli
	 */
	protected $mysqli;


	/**
	 * 
	 */
	public function __construct() {
		$this->mysqli = new mysqli('localhost', 'wp-crm', 'aVtUtzruEn2c8EMT', 'wp-crm');
	}
	
}

?>
