<?php

namespace EJC\Controller;

/**
 * Controller fuer die Projects
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class ProjectController extends AbstractController {
    
    /**
     * 
     * @param \EJC\Model\Project $project
     */
    public function showAction(\EJC\Model\Project $project) {
        $this->view->assign('title', 'Projekt: ' . $project->getName());
        $this->view->assign('project', $project);
        $this->view->render();
    }

    /**
     * Liste alle Projekte
     * 
     * @return void
     */
    public function listAction() {
        $projects = $this->projectRepository->findAll();
        $this->view->assign('projects', $projects);
        $this->view->render();
    }
    
    /**
     * Liste alle Projekte zu einem User
     * 
     * @return void
     */
    public function listByUserAction(\EJC\Model\User $user = NULL) {
        if ($user === NULL) {
            $user = $this->getCurrentUser();
        }
        $projects = $this->projectRepository->findByUser($user);
        $this->view->assign('title', 'Projekte');
        $this->view->assign('projects', $projects);
        $this->view->render();
    }
    
    /**
     * Liste alle Projekte zu einem User
     * 
     * @return void
     */
    public function listByCustomerAction() {
        $projects = $this->projectRepository->findByParent_id();
        $this->view->assign('projects', $projects);
        $this->view->render();
    }
    
    /**
     * Erstelle ein neues Project
     * 
     * @param \EJC\Model\Project $project
     * @return void
     */
    public function createAction(\EJC\Model\Project $project) {
        $this->projectRepository->add($project);
    }
    
    /**
     * Formular zum Aendern des Projekts
     * 
     * @param \EJC\Model\Project $project
     * @return void
     */
    public function editAction(\EJC\Model\Project $project) {
        $this->view->assign('project', $project);
    }
    
}
?>