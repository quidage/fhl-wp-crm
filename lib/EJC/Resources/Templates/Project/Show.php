<?php
/**
 * Controller fuer die Projects
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
 
 // Schreibe das Tasks-Array in eine Variable zur spateren Verwendung
 $tasks = $this->project->getTasks();
 
?>

<h1><?php echo $this->project->getName(); ?></h1>

    <table>
        <thead>
            <caption>
                Offene Aufgaben
                <span class="new-object"><?php $this->getLink('neue Aufgabe erstellen', 'Task', 'new', array('project[id]' => $this->project->getId())); ?></span>
            </caption> 
            <?php if (!empty($tasks)): ?>           
                <tr>
                    <th>Name</th>
                    <th>Beschreibung</th>
                    <th></th>
                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php if (empty($tasks)): ?>
                <tr>
                    <td colspan="3">keine Aufgaben erstellt</td>
                </tr>
            <?php else: ?>
                <?php foreach ($this->project->getTasks() AS $task): ?>
                    <tr>
                        <td><?php echo $task->getName(); ?></td>
                        <td><?php echo $task->getDescription(); ?></td>
                        <td><?php $this->getLink('Details', 'Task', 'show', array('task[id]' => $task->getId())); ?></td>
                    </tr>
                <?php endforeach; ?>
             <?php endif; ?>
        </tbody>
    </table>