<?php

namespace EJC\Repository;

/**
 * Repository fuer den Task
 * 
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class TaskRepository extends AbstractRepository {
        
    /**
     * Das CustomerRepository
     * 
     * @var \EJC\Repository\CustomerRepository
     */
	protected $customerRepository;
    
    /**
     * Das ProjectRepository
     * 
     * @var \EJC\Repository\ProjectRepository
     */
	protected $projectRepository;

    /**
	 * Konstruktor
	 * 
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
        $this->customerRepository = new CustomerRepository();
		$this->parentRepository = new ProjectRepository();
        
		// Setze die Tabelle
		$this->table = 'task';
	}	
    
    /**
     * Finde alle Tasks zu einem User
     * 
     * @param \EJC\Model\User $user
     * @return array
     */
    public function findByUser(\EJC\Model\User $user) {
        $projects = array();
        $customers = $this->customerRepository->findByParent_id($user->getId());
        if (!empty($customers)) {   
            foreach ($customers AS $customer) {
                $customerProjects = $this->findByParent_idAndStatus($customer->getId());
                $projects = array_merge($customerProjects, $projects);
            }
        }
        return $projects;
    } // public function findByUser(\EJC\Model\User $user)
    
    /**
     * Finde alle offenen Tasks zu einem User
     * 
     * @param \EJC\Model\User $user
     * @return array
     */
    public function findOpenByUser(\EJC\Model\User $user) {
        return $this->findByGreatGrandParent_idAndStatus($user->getId(), 'offen');
    }        
	
}

?>
