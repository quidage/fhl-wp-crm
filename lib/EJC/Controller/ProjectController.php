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
     * Zeige alle Einzelheiten zu einem Project
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
        if (isset($this->params['filter']) && $this->params['filter'] !== '') {
            $projects = $this->projectRepository->findByUserFiltered($user, $this->params['filter']);
        } else {
            $projects = $this->projectRepository->findByUser($user);
        }
        $this->view->assign('title', 'Projekte');
        $this->view->assign('filter', $this->params['filter']);
        $this->view->assign('filterUrl', $this->request->getCurrentUrl());
        $this->view->assign('projects', $projects);
        $this->view->render();
    }

    /**
     * Liste alle Projekte zu einem Customer
     *
     * @return void
     */
    public function listByCustomerAction(\EJC\Model\Customer $customer) {
        if (isset($this->params['filter'])) {
            $projects = $this->projectRepository->findByCustomerFiltered($customer, $this->params['filter']);
        } else {
            $projects = $this->projectRepository->findByParent_id($customer->getId());
        }
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
        $this->forward('Project', 'listByUser');
    }

    /**
     * Formular zum Aendern des Projekts
     *
     * @param \EJC\Model\Project $project
     * @return void
     */
    public function editAction(\EJC\Model\Project $project) {
        $this->view->assign('project', $project);
        $this->view->render();
    }

    /**
     * Formalar fuer ein neues Project
     *
     * @return void
     */
    public function newAction(\EJC\Model\Customer $customer = NULL) {
        if ($customer === NULL) {
            $this->view->assign('customers', $this->getCurrentUser()->getCustomers());
        } else {
            $this->view->assign('customers', array($customer));
        }
        $this->view->assign('newProject', new \EJC\Model\Project());
        $this->view->render();
    }

    /**
     * Aktualisiere das Projekt
     *
     * @param \EJC\Model\Project $project
     * @return void
     */
    public function updateAction(\EJC\Model\Project $project) {
        $this->projectRepository->update($project);
        $this->forward('Project', 'listByUser');
    }

}
?>