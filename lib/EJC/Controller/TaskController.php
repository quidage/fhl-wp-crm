<?php

namespace EJC\Controller;

/**
 * Controller fuer die Tasks
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @author Julian Hilbers <hilbers.julian@gmail.com>
 * @package wp-crm
 */
class TaskController extends AbstractController {

    /**
     * Zeige die Detailansicht zu einem Tasks
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
     * Formular fuer einen neuen Taks
     *
     * @param \EJC\Model\Project $project
     * @return void
     */
     public function newAction(\EJC\Model\Project $project) {
         $this->view->assign('title', 'Neue Aufgabe');
         $this->view->assign('project', $project);
         $this->view->assign('newTask', new \EJC\Model\Task());
         $this->view->render();
     }

    /**
     * Erstelle einen neuen Task
     *
     * @param \EJC\Model\Task $newTask
     * @return void
     */
    public function createAction(\EJC\Model\Task $newTask) {
        $this->taskRepository->add($newTask);
        $this->redirect('Project', 'show', array(
            'project' => $this->projectRepository->findById($newTask->getParent_id())
             ));
    }

    /**
     * Formular zum Aendern des Tasks
     *
     * @param \EJC\Model\Task $task
     * @return void
     */
    public function editAction(\EJC\Model\Task $task) {
        $this->view->assign('task', $task);
        $this->view->render();
    }

    /**
    * Aktualisiere die Aufgabe
    *
    * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
    * @param \EJC\Model\Task $task
    * @return void
    */
    public function updateAction(\EJC\Model\Task $task) {
    	$this->taskRepository->update($task);
    	$this->redirect('Project','show', array(
            'project' => $this->projectRepository->findById($task->getParent_id())
            ));
    }


	/**
     * Gibt eine Information zum löschen eines Eintrages aus
     *
     * @author Julian Hilbers <hilbers.julian@gmail.com>
     * @param \EJC\Model\Task $task
     * @return void
     */
    public function deleteMessageAction(\EJC\Model\Task $task) {
		$this->view->assign('taskData', $task);
        $this->view->render();
    }

	/**
     * Löscht eine Aufgabe
     *
     * @author Julian Hilbers <hilbers.julian@gmail.com>
     * @param \EJC\Model\Task $task
     * @return void
     */
    public function deleteAction(\EJC\Model\Task $task) {
    	$this->taskRepository->remove($task);
		$this->view->assign('taskData', $task);
        $this->view->render();
    }
}
?>