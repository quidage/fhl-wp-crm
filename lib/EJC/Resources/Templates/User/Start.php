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
                <th class="descUserStart">Beschreibung</th>
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
                		<?php $this->getLink('<img src="images/iconset/writeNew_black.png" title="Eintrag bearbeiten" alt="bearbeiten">','Project', 'edit', array('ajax' => true,'project[id]' => $project->getId()), '.std-btn');?>
                    	<?php $this->getLink('<img src="images/iconset/check-not-ok.png" title="Eintrag l&ouml;schen" alt="eintrag l&ouml;schen">','Project', 'deleteMessage', array('ajax' => true,'project[id]' => $project->getId()), '.msg-btn');?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination-box">
        <?php echo $this->getPagination($this->allOpenProjects, 'limitProject'); ?>
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
                <th class="descTaskStart">Beschreibung</th>
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
                    	<?php $this->getLink('<img src="images/iconset/writeNew_black.png" title="Eintrag bearbeiten" alt="bearbeiten">','Task', 'edit', array('ajax' => true,'task[id]' => $task->getId()), '.std-btn');?>
                   	</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pagination-box">
        <?php echo $this->getPagination($this->allOpenTasks, 'limitTask'); ?>
    </div>

    <?php else: ?>
    	<p>Es sind keine offenen Aufgaben vorhanden.</p>
<?php endif; ?>