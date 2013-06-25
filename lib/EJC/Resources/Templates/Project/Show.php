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
<a href="<?php echo $this->getUrl('Project', 'edit', array('project[id]' => $this->project->getId())); ?>" title="Bearbeiten">
	<img src="images/iconset/writeNew_black.png">Projekt Bearbeiten</a>
<p><strong>Status:</strong> <?php echo $this->project->getStatus(); ?><br />
<strong>Beschreibung:</strong><br /><?php echo $this->project->getDescription(); ?></p>

    <table>
        <thead>
            <caption>
                Offene Aufgaben
                <span class="new-object">
                	<?php $this->getLink('<img src="images/iconset/plus_white.png" title="Neuer Eintrag">Neue Aufgabe','Task', 'new', array('ajax' => true,'project[id]' => $this->project->getId()), '.std-btn');?>
                </span>
            </caption>
            <?php if (!empty($tasks)): ?>
                <tr>
                    <th>Name</th>
                    <th class="descTask">Beschreibung</th>
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
                        	<a href="<?php echo $this->getUrl('Task', 'show', array('task[id]' => $task->getId())); ?>" title="Details">
                        		<img src="images/iconset/information.png" /></a>
                        	
                        	<?php $this->getLink('<img src="images/iconset/writeNew_black.png" title="Bearbeiten">','Task', 'edit', array('ajax' => true,'task[id]' => $task->getId()), '.std-btn');?>
                        	
                        	<?php $this->getLink('<img src="images/iconset/check-not-ok.png" title="L&ouml;schen" alt="eintrag l&ouml;schen">','Task', 'deleteMessage', array('ajax' => true,'task[id]' => $task->getId()), '.msg-btn');?>
                        </td>
                    </tr>
                <?php endforeach; ?>
             <?php endif; ?>
        </tbody>
    </table>