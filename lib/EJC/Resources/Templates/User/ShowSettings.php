<?php
/*
 * View für die Benutzereistellungen
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Benutzereinstellungen von <?php echo $this->user->getName(); ?></h2>


<table>
    <caption>Ihre Daten</caption>
    <tbody>
        <tr>
            <td>Vorname:</td>
            <td><?php echo $this->user->getFirst_name(); ?></td>
        </tr>
        <tr>
            <td>Nachname:</td>
            <td><?php echo $this->user->getLast_name(); ?></td>
        </tr>
        <tr>
            <td>E-Mail Adresse:</td>
            <td><?php echo $this->user->getEmail(); ?></td>
        </tr>
        <tr>
        <td colspan="2"><?php $this->getLink('Daten bearbeiten', 'User', 'edit', array('user[id]' => $this->user->getID())); ?></td>
        </tr>
    </tbody>
</table>