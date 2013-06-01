<table>
    <thead>
        <tr>
            <td>username</td>
            <td>Vorname</td>
            <td>Nachname</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->users AS $user): ?>
        <tr>
            <td><?php echo $user->getName(); ?></td>
            <td><?php echo $user->getFirst_name(); ?></td>
            <td><?php echo $user->getLast_name(); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php $this->getUrl('User', 'list'); ?>" ><?php $this->getUrl('User', 'list'); ?></a>
 