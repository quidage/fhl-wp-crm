<?php if (!empty($this->projects)): ?>

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
            <?php foreach ($this->projects AS $project): ?>
            <tr>
                <td><?php echo $project->getName(); ?></td>
                <td><?php echo $project->getDescription(); ?></td>
                <td><?php $this->getLink('Project', 'edit', array('project[id]' => $project->getId())); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?> 

<br><br>

<a href="css/css-elemente.html">Eine Übersicht aller CSS-Elemente</a>