<?php
/**
 * Template fuer \EJC\Controller\UserController->startAction()
 * 
 * die Start-Action des Users
 * Zeige offene Projekts und Taks
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<?php 
// Zeige offene Projekte
?>
<?php if (!empty($this->openProjects)): ?>
    <table>
        <thead>
            <caption>
                Offene Projekte
                <span class="new-object"><a href="<?php $this->getUrl('Project', 'new'); ?>" title="Neues Projekt">
                	<img src="images/iconset/plus_white.png">Neues Projekt</a></span>
            </caption>
            <tr>
                <th>Name</th>
                <th>Beschreibung</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->openProjects AS $project): ?>
                <tr>
                    <td><?php echo $project->getName(); ?></td>
                    <td><?php echo $project->getDescription(); ?></td>
                    <td>
                    	<a href="<?php $this->getUrl('Project', 'show', array('project[id]' => $project->getId())); ?>" title="Details">
                    		<img src="images/iconset/information.png"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?> 

<?php 
// Zeige offen Aufgaben
?>
<?php if (!empty($this->openTasks)): ?>
    <table>
        <thead>
            <caption>
                Offene Aufgaben
            </caption>            
            <tr>
                <th>Name</th>
                <th>Beschreibung</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->openTasks AS $task): ?>
                <tr>
                    <td><?php echo $task->getName(); ?></td>
                    <td><?php echo $task->getDescription(); ?></td>
                    <td>
                    	<a href="<?php $this->getUrl('Task', 'show', array('task[id]' => $task->getId())); ?>" title="Details">
                    		<img src="images/iconset/information.png"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?> 