<?php

namespace EJC\Repository;

/**
 * Repository fuer den Customer
 * 
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class CustomerRepository extends AbstractRepository {
	
	/**
	 * Konstruktor
     * 
     * @return void
	 */
	public function __construct() {
		parent::__construct();
		// setze die Tabelle
		$this->table = "customer";
	}
	
}

?>
