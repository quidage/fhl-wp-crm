<?php

require_once './AbstractRepository.php';

/**
 * 
 */
class CustomerRepository extends AbstractRepository {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Returns array of all customer result-objects
	 */
	public function findAll() {
		$results = array();
		$query = "SELECT * FROM cumstomer WHERE deleted = 0";
		$res = $this->mysqli->query($query);
		while ($row = $res->fetch_object()) {
			$results[] = $row;
		}
		return $results;
	}
	
}

?>
