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
     * Finde alle Projekte mit einem FilterString auf die der Filter passt
     *
     * @param int $id
     * @param string $filterString
     * @return array
     */
    public function findByCustomerFiltered(\EJC\Model\Customer $customer, $filterString) {
        $filter = array(
            'name' => $filterString,
            'id' => $filterString,
            'description' => $filterString
            );
        return $this->findByParent_idWithOrFilter($customer->getId(), $filter);
    }

    /**
     * Finde alle Projects zu einem User
     *
     * @param \EJC\Model\User $user
     * @return array
     */
    public function findByUser(\EJC\Model\User $user, $limit = NULL) {
        return $this->findByGrandParent_id($user->getId(), $limit);
    }

    /**
     * Zaehle alle Projects zu einem User
     *
     * @param \EJC\Model\User $user
     * @return array
     */
    public function countByUser(\EJC\Model\User $user) {
        return count($this->findByGrandParent_id($user->getId()));
    }

    /**
     * Finde alle Projects zu User nach einem String gefiltert
     *
     * @param \EJC\Model\User $user
     * @param string $filterString
     * @return array
     */
    public function findByUserFiltered(\EJC\Model\User $user, $filterString, $limit = NULL) {
        $filter = array(
            'name' => $filterString,
            'id' => $filterString,
            'description' => $filterString,
            'status' => $filterString
            );
        return $this->findByGrandParent_idWithOrFilter($user->getId(), $filter, $limit);
    }

    /**
     * Finde alle offenen Projects zu einem User
     *
     * @param \EJC\Model\User $user
     * @return array
     */
    public function findOpenByUser(\EJC\Model\User $user, $limit = NULL) {
        return $this->findByGrandParent_idAndStatus($user->getId(), 'offen', $limit);
    }

}

?>
