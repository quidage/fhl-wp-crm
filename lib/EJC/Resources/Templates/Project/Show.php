<?php
/**
 * Template fuer \EJC\Controller\ProjectController->showAction()
 *
 * Zeige die Details zu einem Project und
 * eine Liste aller Tasks
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */

 // Schreibe das Tasks-Array in eine Variable zur spateren Verwendung
 $tasks = $this->project->getTasks();

?>

<h1><?php echo $this->project->getName(); ?></h1>
<a href="<?php $this->getUrl('Project', 'edit', array('project[id]' => $this->project->getId())); ?>" title="Bearbeiten">
	<img src="images/iconset/writeNew_black.png">Projekt Bearbeiten</a>
<p><strong>Status:</strong> <?php echo $this->project->getStatus(); ?><br />
<strong>Beschreibung:</strong><br /><?php echo $this->project->getDescription(); ?></p>

    <table>
        <thead>
            <caption>
                Offene Aufgaben
                <span class="new-object"><a href="<?php $this->getUrl('Task', 'new', array('project[id]' => $this->project->getId())); ?>" title="Neue Aufgabe">
                	<img src="images/iconset/plus_white.png">Neue Aufgabe</a></span>
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
                        <td>
                        	<a href="<?php $this->getUrl('Task', 'show', array('task[id]' => $task->getId())); ?>" title="Details">
                        		<img src="images/iconset/information.png" /></a>
                        	<a href="<?php $this->getUrl('Task', 'edit', array('task[id]' => $task->getId(), 'project[id]' => $this->project->getId())); ?>" title="Bearbeiten">
                				<img src="images/iconset/writeNew_black.png" /></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
             <?php endif; ?>
        </tbody>
    </table>