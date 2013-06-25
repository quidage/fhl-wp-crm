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
        $this->parentRepository = new UserRepository();
		// setze die Tabelle
		$this->table = "customer";
	}

    /**
     * Finde alle Customer zu User nach einem String gefiltert
     *
     * @param \EJC\Model\User $user
     * @param string $filterString
     * @return array
     */
    public function findByUserWithOrFilter(\EJC\Model\User $user, $filterString) {
        $filter = array(
            'name' => $filterString,
            'email' => $filterString,
            'id' => $filterString,
            'city' => $filterString,
            'zip' => $filterString,
            'street' => $filterString,
            'phone' => $filterString,
            'fax' => $filterString
            );
        return $this->findByParent_idWithOrFilter($user->getId(), $filter);
    }

    /**
     * Loesche Customer mitsamt dessen Projekten
     *
     * @param \EJC\Model\Customer $customer
     */
    public function removeAction(\EJC\Model\Customer $customer) {
        $projectRepository = new \EJC\Repository\ProjectRepository();
        $projects = $projectRepository->findByParent_id($customer->getId());
        foreach ($projects AS $project) {
            $projectRepository->remove($project);
        }
        parent::remove($customer);
    }

}

?>
