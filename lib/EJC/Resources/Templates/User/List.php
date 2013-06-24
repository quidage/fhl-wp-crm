<?php
/**
 * Template fuer \EJC\Controller\UserController->listAction()
 *
 * Liste alle User im System - nur fuer den Admin vorgesehen
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

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
            <td>
            	<a href="<?php echo $this->getUrl('User', 'edit', array('user[id]' => $user->getId())); ?>" title="Bearbeiten">
            		<img src="images/iconset/writeNew_black.png" /></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
