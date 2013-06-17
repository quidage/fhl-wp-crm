<?php
/**
 * Template fuer \EJC\Controller\UserController->startAction()
 * 
 * die Start-Action des Users
 * Zeige offene Projekts und Taks
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
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
                <span class="new-object"><?php $this->getLink('neues Projekt erstellen', 'Project', 'new'); ?></span>
            </caption>
            <tr>
                <td>Name</td>
                <td>Beschreibung</td>
                <td></td>
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
                <td>Name</td>
                <td>Beschreibung</td>
                <td></td>
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