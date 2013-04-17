<?php

namespace EJC\Controller;

/**
 * Description of UserController
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 */
class UserController extends AbstractController {
    
    /**
     * Action for the index page
     * 
     * @return void
     */
    public function startAction() {
//        $customers = $this->customerRepository->findAll();
//        $customers[0]->setName('Wurst');
//        $customers[0]->setStreet('Straße');
//        $this->customerRepository->update($customers[0]);
        
        $this->view->assign('title', 'Startseite');
        $this->view->render();
    }
    
    /**
     * Display form to edit user-data
     * 
     * @param array $user
     */
    public function editAction() {
        echo 'editAction';
    }
    
}
?>