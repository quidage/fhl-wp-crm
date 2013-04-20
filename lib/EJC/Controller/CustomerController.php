<?php

namespace EJC\Controller;

/**
 * Description of CustomerController
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class CustomerController extends AbstractController {

    /**
     * Display list of customers
     * 
     */
    public function listAction() {
        $this->view->assign('title', 'test');
        $this->view->render();
    }
    
    /**
     * Display customer data
     * 
     * @param string $customerID
     */
    public function showAction($customerID) {
        
    }

    /**
     * Display form for editing customer data
     * 
     * @param \EJC\Model\Customer $customer
     */
    public function editAction(\EJC\Model\Customer $customer) {
        var_dump($customer);
        $this->view->assign('customer', $customer);
        $this->view->render();
    }
    
    /**
     * Update the customer data
     * 
     * @param array $customer
     */
    public function updateAction(\EJC\Model\Customer $customer) {
        $this->customerRepository->update($customer);
        var_dump($customer);
    }
    
    /**
     * Display form for creating a new custormer
     */
    public function newAction() {
        
    }
    
    /**
     * Create a new customer
     * 
     * @param array $customer
     */
    public function createAction($customer) {
        
    }
    
}

?>
