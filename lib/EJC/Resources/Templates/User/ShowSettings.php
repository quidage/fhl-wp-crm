<?php
/*
 * View f&uuml;r die Benutzereistellungen
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Benutzereinstellungen von <?php echo $this->user->getName(); ?></h1>

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
            <td>Password:</td>
            <td>********</td>
        </tr>
        <tr>
        <td colspan="2"><?php $this->getLink('Daten bearbeiten', 'User', 'edit', array('user[id]' => $this->user->getID())); ?></td>
        </tr>
    </tbody>
</table>

<?php
// TODO Formular zum Erstellen eines authKey + Authenfizierung im Request, wenn wenn authKey gesetzt ist
// Api Aufrufe
?>

<?php if ($this->user->getAdmin()): ?>
<h2>Admin</h2>
<?php $this->getLink('Neuen Benutzer erstellen', 'User', 'new'); ?>
<?php endif; ?>

<h2>Export</h2>
<?php $this->getLink('Kundendaten f&uuml;r Backup als XML', 'Api', 'get', array(), '', '_blank'); ?>