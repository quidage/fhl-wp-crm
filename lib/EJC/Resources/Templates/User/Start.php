<?php
/**
 * Template fuer die Start-Action des Users
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<?php if (!empty($this->openProjects)): ?>

    <h2>Offene Projekte</h2>

    <table>
        <thead>
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
                    <td><?php $this->getLink('Details', 'Project', 'show', array('project[id]' => $project->getId())); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?> 


<?php if (!empty($this->openTasks)): ?>

    <h2>Offene Aufgaben</h2>

    <table>
        <thead>
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
                    <td><?php $this->getLink('Details', 'Task', 'show', array('task[id]' => $task->getId())); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
<?php endif; ?> 