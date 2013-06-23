<?php

namespace EJC\Controller;

/**
 * Methoden fuer den Customer
 *
 * Listen, Darstellen und Bearbeiten der Customer Daten
 *
 * @author Chrstian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class CustomerController extends AbstractController {

    /**
     * Liste alle Customer zu einem User
     *
     * @param \EJC\Model\User $user
     * @return void
     */
    public function listByUserAction(\EJC\Model\User $user = NULL) {
        if ($user === NULL) {
            $user = $this->getCurrentUser();
        }
        if (isset($this->params['filter']) && $this->params['filter'] !== '') {
            $customers = $this->customerRepository->findByUserWithOrFilter($user, $this->params['filter']);
        } else {
            $customers = $this->customerRepository->findByParent_id($user->getId());
        }
        $this->view->assign('customers', $customers);
        $this->view->assign('filterUrl', $this->request->getCurrentUrl());
        $this->view->assign('filter', $this->params['filter']);
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
        if ($this->ajax) {
            echo json_encode(array('status' => 'ok'));
        } else {
            $this->forward('Customer', 'listByUser');
        }
    }

    /**
     * Formular um einen Customer anzulegen
     *
     * @return void
     */
    public function newAction(\EJC\Model\User $user = NULL) {
        if ($user === NULL) {
            $user = $this->getCurrentUser();
        }
        $this->view->assign('user', $user);
        $this->view->assign('newCustomer', new \EJC\Model\Customer());
        $this->view->render();
    }

    /**
     * Erstelle einen neuen Customer
     *
     * @param \EJC\Model\Customer $customer
     * @return void
     */
    public function createAction(\EJC\Model\Customer $newCustomer) {
        $this->customerRepository->add($newCustomer);
        if ($this->ajax) {
            echo json_encode(array('status' => 'ok'));
        } else {
            $this->forward('Customer', 'listByUser');
        }
    }

}

?>
