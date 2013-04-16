<?php

namespace EJC\Controller;

/**
 * Description of CustomerController
 *
 * @author christian
 */
class CustomerController extends AbstractController {
    
    protected $customerRepository;

    public function __construct($controllerName = NULL, $actionName = NULL) { 
        parent::__construct($actionName, $controllerName);
        $this->customerRepository = new \EJC\Repository\CustomerRepository();
    }
    
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
     * @param string $customerID
     */
    public function editAction($customerID) {
        
    }
    
    /**
     * Update the customer data
     * 
     * @param array $customer
     */
    public function updateAction($customer) {
        
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
