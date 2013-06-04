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
        // Setze MIME-Type fuer Output auf XML
        header('Content-type: application/xml');
        
//        $customers = $this->customerRepository->findByUser($this->getCurrentUser());
//        $projects = $this->projectRepository->findByUser($this->getCurrentUser());
//        $tasks = $this->taskRepository->findByuser($this->getCurrentUser());
//        $this->view->assign('title', 'Startseite');
//        $this->view->assign('cumstomers', $customers);
//        $this->view->assign('projects', $projects);
//        $this->view->assign('tasks', $tasks);
        $this->view->setLayout('ajax');
        $this->view->render();
    }

}

?>