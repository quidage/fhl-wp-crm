<?php

namespace EJC\Controller;

/**
 * Controller fuer die Tasks
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
class TaskController extends AbstractController {
    
    /**
     * 
     * @param \EJC\Model\Task $task
     */
    public function showAction(\EJC\Model\Task $task) {
        $this->view->assign('title', 'Task: ' . $task->getName());
        $this->view->assign('task', $task);
        $this->view->render();
    }

    /**
     * Liste alle Tasks
     * 
     * @return void
     */
    public function listAction() {
        $tasks = $this->taskRepository->findAll();
        $this->view->assign('tasks', $tasks);
        $this->view->render();
    }
    
    /**
     * Liste alle Tasks zu einem User
     * 
     * @return void
     */
    public function listByUserAction(\EJC\Model\User $user = NULL) {
        if ($user === NULL) {
            $user = $this->getCurrentUser();
        }
        $tasks = $this->taskRepository->findByUser($user);
        $this->view->assign('title', 'Aufgaben');
        $this->view->assign('tasks', $tasks);
        $this->view->render();
    }
    
    /**
     * Erstelle einen neuen Taks
     * 
     * @param \EJC\Model\Task $task
     * @return void
     */
    public function createAction(\EJC\Model\Task $task) {
        $this->taskRepository->add($task);
    }
    
    /**
     * Formular zum Aendern des Tasks
     * 
     * @param \EJC\Model\Task $task
     * @return void
     */
    public function editAction(\EJC\Model\Task $task) {
        $this->view->assign('task', $task);
    }
    
}
?>