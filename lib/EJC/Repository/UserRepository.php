<?php

namespace EJC\Repository;

/**
 * Repository fuer den User
 * 
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class UserRepository extends AbstractRepository {
	
	/**
	 * Konstruktor
     * 
     * @return void
	 */
	public function __construct() {
		parent::__construct();
		
		// Setze die Tabelle
		$this->table = "user";
	}
	
}

?>
