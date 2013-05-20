<?php

namespace EJC\Controller;

/**
 * Methoden fuer den Customer
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class CustomerController extends AbstractController {

    /**
     * Zeige eine Liste aller Customer
     * 
     * @return void
     */
    public function listAction() {
        $this->view->assign('title', 'Kundenliste');
        $this->view->render();
    }
    
    /**
     * Zeige alle Daten zu einem Customer
     * 
     * @param string $customerID
     * @return void
     */
    public function showAction(\EJC\Model\Customer $customer) {
        $this->view->assign('customer', $customer);
        $this->view->render();
    }

    /**
     * Formular zum aendern der Customer-Daten
     * 
     * @param \EJC\Model\Customer $customer
     * @return void
     */
    public function editAction(\EJC\Model\Customer $customer) {
        $this->view->assign('customer', $customer);
        $this->view->render();
    }
    
    /**
     * Aktualisiere die Daten des Customer
     * 
     * @param array $customer
     */
    public function updateAction(\EJC\Model\Customer $customer) {
        $this->customerRepository->update($customer);
    }
    
    /**
     * Formular um einen Customer anzulegen
     * 
     * @return void
     */
    public function newAction() {
        
    }
    
    /**
     * Erstelle einen neuen Customer
     * 
     * @param \EJC\Model\Customer $customer
     * @return void
     */
    public function createAction(\EJC\Model\Customer $customer) {
        $this->customerRepository->add($customer);
    }
    
}

?>
