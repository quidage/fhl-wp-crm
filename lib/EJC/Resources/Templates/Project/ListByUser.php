<h1>Projekte</h1>

<table>
    <thead>
        <tr>
            <td>Name</td>
            <td>Beschreibung</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->projects AS $project) : ?>
            <tr>
                <td><?php echo $project->getName() ?></td> 
                <td><?php echo $project->getDescription() ?></td> 
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
