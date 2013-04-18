<?php

namespace EJC\Controller;

/**
 * Controller for user actions, like login, creation of new users
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class UserController extends AbstractController {
    
    /**
     * show the index page
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
     * display form to edit user-data
     * 
     * @param array $user
     */
    public function editAction() {
        echo 'editAction';
    }
    
    /**
     * display page for login form
     * 
     * @return void
     */
    public function showLoginAction() {
        $this->view->assign('title','Login');
        $this->view->render();
    }
    
    /**
     * perform login of user
     * 
     * @return void
     */
    public function loginAction($params) {
        $user = $this->userRepository->findOneByName($params['name']);
               
        // if user not exist show message
        if ($user === NULL) {
            $this->view->addErrorMessage('User nicht gefunden');
            $this->forward('User', 'showLogin');
            return;
        } else {
            // TODO passwort match check and start login-session
            $this->forward('User', 'start');
        }
    }
    
}
?>