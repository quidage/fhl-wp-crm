<table>
    <thead>
        <tr>
            <td>id</td>
            <td>name</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->projects AS $project): ?>
        <tr>
            <td><?php echo $project->getId(); ?></td>
            <td><?php echo $project->getName(); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
 