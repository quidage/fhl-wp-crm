<?php

namespace EJC\Controller;

/**
 * Description of CustomerController
 *
 * @author christian
 */
class CustomerController extends AbstractController {
    
    protected $customerRepository;

    public function __construct() {
        $this->customerRepository = new \EJC\Repository\CustomerRepository();
    }
    
    /**
     * 
     * 
     * @return void
     */
    public function listAction() {
       echo 'listAction'; 
    }
    
}

?>
