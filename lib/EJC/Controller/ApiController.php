<?php

namespace EJC\Controller;

/**
 * Controller fuer Api-Funktionen
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class ApiController extends AbstractController {
    
    /**
     * Gib XML-Baum aller Daten des Users zurueck
     * 
     * @return void
     */
    public function getAction() {
        $customers = $this->customerRepository->findByUser($this->getCurrentUser());
        $projects = $this->projectRepository->findByUser($this->getCurrentUser());
        $tasks = $this->taskRepository->findByuser($this->getCurrentUser());
        $this->view->assign('title', 'Startseite');
        $this->view->assign('cumstomers', $customers);
        $this->view->assign('projects', $projects);
        $this->view->assign('tasks', $tasks);
        $this->view->render();
    }
    
    /**
     * Logge den User ein
     * 
     * @return void
     */
    public function loginAction(array $login) {
        
        // Hole passenden User aus dem Repository
        try {
            $user = $this->userRepository->findOneByName($login['name']);
        } catch (EJC\Exception\RepositoryException $e) {
            $user = NULL;
        }
               
        // Wenn User nicht gefunden, gib Fehlermeldung aus
        if ($user === NULL) {
            $this->view->addErrorMessage('User nicht gefunden');
            $this->forward('User', 'showLogin');
            return;
        } else {
            // Wenn Username + Passwort passen, leite auf User-Startseite weiter
            // Setze Login-Status in der User-Session            
            if ($user->getPassword() === md5($login['password'])) {
                $_SESSION['user'] = serialize($user);
                $_SESSION['login'] = time();
                $this->forward('User', 'start');
            } else {
                // Falsches Passwort - Fehlermeldung anzeigen
                $this->view->addErrorMessage('Falsches Passwort');
                $this->forward('User', 'showLogin');
                return;                
            }
        }
    } // public function loginAction(array $login)
    
    /*
     * Hole den aktuell eingeloggten User
     * 
     * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
     * @return Object
     */
    public function getCurrentUser(){
        return unserialize($_SESSION['user']); 
    }
}
?>