<?php
/**
 * Template fuer \EJC\Controller\ProjectController->ListByUserAction()
 * 
 * Liste alle Projects eines Users
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<table>
    <thead>
        <caption>Projekte
        <span class="new-object"><?php $this->getLink('neues Projekt erstellen', 'Project', 'new'); ?></span>
        </caption>
        <tr>
            <th>Name</th>
            <th>Beschreibung</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->projects AS $project) : ?>
            <tr>
                <td><?php echo $project->getName(); ?></td> 
                <td><?php echo $project->getDescription(); ?></td> 
                <td><?php echo $project->getStatus(); ?></td> 
                <td><?php $this->getLink('Details', 'Project', 'show', array('project[id]' => $project->getId())); ?></td>
                <td><?php $this->getLink('Bearbeiten', 'Project', 'edit', array('project[id]' => $project->getId())); ?></td> 
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
