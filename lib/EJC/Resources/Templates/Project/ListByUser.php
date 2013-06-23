<?php
/**
 * Template fuer \EJC\Controller\ProjectController->ListByUserAction()
 *
 * Liste alle Projects eines Users
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<div class="filter-box">
    <form name="filterProject" method="get" action="<?php echo $this->filterUrl; ?>">
        <input type="hidden" name="controller" value="Project" />
        <input type="hidden" name="action" value="listByUser" />
        <input type="text" name="filter" value="<?php echo $this->filter; ?>" placeholder="Filtertext" />
        <input type="submit" value="Filtern" class="submit button-link" />
    </form>
</div>

<table>
    <thead>
        <caption>Projekte
        <span class="new-object"><a href="<?php $this->getUrl('Project', 'new'); ?>" title="Neues Projekt">
    		<img src="images/iconset/plus_white.png" />Neues Projekt</a></span>
        </caption>
        <tr>
            <th>Name</th>
            <th>Kunde</th>
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
                <td><?php echo $project->getCustomer()->getId() . ' | ' . $project->getCustomer()->getName(); ?></td>
                <td><?php echo $project->getDescription(); ?></td>
                <td><?php echo $project->getStatus(); ?></td>
                <td>
                	<a href="<?php $this->getUrl('Project', 'show', array('project[id]' => $project->getId())); ?>" title="Details">
                		<img src="images/iconset/information.png" /></a>
                </td><td>
                	<a href="<?php $this->getUrl('Project', 'edit', array('project[id]' => $project->getId())); ?>" title="Bearbeiten">
                		<img src="images/iconset/writeNew_black.png" /></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
