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
        $this->view->assign('title', 'Startseite');
        $this->view->render();
    }
    
    /**
     * list all users
     * 
     * @return void
     */
    public function listAction() {
        $users = $this->userRepository->findAll();
        $this->view->assign('users', $users);
        $this->view->render();
    }
    
    /**
     * show user settings
     * 
     * @return void
     */
    public function showSettingsAction() {
        $this->view->render();
    }
    
    /**
     * create a new user
     * 
     * @param \EJC\Model\User $user
     */
    public function createAction(\EJC\Model\User $user) {
        $this->userRepository->add($user);
        var_dump($user);
    }
    
    /**
     * display form to edit user-data
     * 
     * @param \EJC\Model\User $user
     */
    public function editAction(\EJC\Model\User $user) {
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
    public function loginAction(array $login) {
        
        $this->forward('User', 'start');
        
//        // Get matching user from repository
//        try {
//            $user = $this->userRepository->findOneByName($login['name']);
//        } catch (EJC\Exception\RepositoryException $e) {
//            $user = NULL;
//        }
//               
//        // if user not exist show message
//        if ($user === NULL) {
//            $this->view->addErrorMessage('User nicht gefunden');
//            $this->forward('User', 'showLogin');
//            return;
//        } else {
//            // forward to overview if password matches
//            if ($user->getPassword() === md5($login['password'])) {
//                $this->forward('User', 'start');
//            } else {
//                // wrong password -> show login + error message
//                $this->view->addErrorMessage('Falsches Passwort');
//                $this->forward('User', 'showLogin');
//                return;                
//            }
//        }
    }
    
}
?>