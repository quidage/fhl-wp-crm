
<table>
    <thead>
        <tr>
            <caption>Alle Benutzer</caption>
            <th>Username</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>E-Mail</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->users AS $user): ?>
        <tr>
            <td><?php echo $user->getName(); ?></td>
            <td><?php echo $user->getFirst_name(); ?></td>
            <td><?php echo $user->getLast_name(); ?></td>
            <td><?php echo $user->getEmail(); ?></td>
            <td><?php $this->getLink('Bearbeiten', 'User', 'edit', array('user' => $user->getId())); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
 