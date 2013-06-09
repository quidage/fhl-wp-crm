<h1>Projekte</h1>

<?php $this->getLink('Ein neues Projekt erstellen', 'Project', 'new'); ?>

<table width="100%">
    <thead>
        <caption>Projektdaten</caption>
        <tr>
            <td>Name</td>
            <td>Beschreibung</td>
            <td>Status</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->projects AS $project) : ?>
            <tr>
                <td><?php echo $project->getName(); ?></td> 
                <td><?php echo $project->getDescription(); ?></td> 
                <td><?php echo $project->getStatus(); ?></td> 
                <td><?php $this->getLink('Bearbeiten', 'Project', 'edit', array('project[id]' => $project->getId())); ?></td> 
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
