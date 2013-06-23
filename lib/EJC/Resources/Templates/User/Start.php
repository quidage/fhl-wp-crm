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
                <span class="new-object">
                	<?php $this->getLink('<img src="images/iconset/plus_white.png" alt="neues projekt">Neues Projekt ','Project', 'new', array('ajax' => true), '.std-btn');?>
                </span>
            </caption>
            <tr>
                <th>Name</th>
                <th>Kunde</th>
                <th>Beschreibung</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->openProjects AS $project): ?>
                <tr>
                    <td><?php echo $project->getName(); ?></td>
                    <td><?php echo $project->getCustomer()->getId() . ' | ' . $project->getCustomer()->getName(); ?></td>
                    <td><?php echo $project->getDescription(); ?></td>
                    <td>
	                	<a href="<?php echo $this->getUrl('Project', 'show', array('project[id]' => $project->getId())); ?>" title="Details">
	                		<img src="images/iconset/information.png" /></a>
	                </td>
                    <td>
                		<?php $this->getLink('<img src="images/iconset/writeNew_black.png" title="Eintrag bearbeiten" alt="bearbeiten">','Project', 'edit', array('ajax' => true,'project[id]' => $project->getId()), '.std-btn');?>
                    </td>
                    <td>
                    	<?php $this->getLink('<img src="images/iconset/check-not-ok.png" title="Eintrag löschen" alt="eintrag löschen">','Project', 'deleteMessage', array('ajax' => true,'project[id]' => $project->getId()), '.msg-btn');?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination-box">
        <?php echo $this->getPagination($this->allOpenProjects, 'limitProjects'); ?>
    </div>

    <?php else: ?>
    	<p>Es sind keine offenen Projekte vorhanden.</p>
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
                <th>Projekt</th>
                <th>Beschreibung</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->openTasks AS $task): ?>
                <tr>
                    <td><?php echo $task->getName(); ?></td>
                    <td><?php echo $task->getProject()->getId() . ' | ' . $task->getProject()->getName(); ?></td>
                    <td><?php echo $task->getDescription(); ?></td>
                    <td>
                    	<a href="<?php echo $this->getUrl('Task', 'show', array('task[id]' => $task->getId())); ?>" title="Details">
                    		<img src="images/iconset/information.png"></a>
                    </td>
                    <td>
                    	<a href="<?php echo $this->getUrl('Task', 'edit', array('task[id]' => $task->getID())); ?>" title="Bearbeiten">
                    		<img src="images/iconset/writeNew_black.png"></a>
                   	</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination-box">
        <?php echo $this->getPagination($this->allOpenTasks, 'limitTasks'); ?>
    </div>

    <?php else: ?>
    	<p>Es sind keine offenen Aufgaben vorhanden.</p>
<?php endif; ?>