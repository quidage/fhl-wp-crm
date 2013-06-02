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
     * Das CustomerRepository
     * 
     * @var \EJC\Repository\CustomerRepository
     */
	protected $customerRepository;

    /**
	 * Konstruktor
	 * 
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
        $this->parentRepository = new CustomerRepository();
		
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
    
    /**
     * Finde alle Projects zu einem User
     * 
     * @param \EJC\Model\User $user
     * @return array
     */
    public function findByUser(\EJC\Model\User $user) {
        return $this->findByGrandParent_id($user->getId());
    }
    
    /**
     * Finde alle offenen Projects zu einem User
     * 
     * @param \EJC\Model\User $user
     * @return array
     */
    public function findOpenByUser(\EJC\Model\User $user) {
        return $this->findByGrandParent_idAndStatus($user->getId(), 'offen');
    }
	
}

?>
