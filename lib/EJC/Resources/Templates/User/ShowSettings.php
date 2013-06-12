<?php
/**
 * Template fuer \EJC\Controller\UserController->showSettingsAction() 
 * 
 * zeige Benutzerdaten und Links zu Admin-Funktionen fuer eingeloggte Admins
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>  
<table class="half">
    <caption>
        Ihre Daten
        <span class="new-object"><?php $this->getLink('Bearbeiten', 'User', 'edit'); ?></span>    
    </caption>
    <tbody>
        <tr>
            <td>Benutzername:</td>
            <td><?php echo $this->user->getName(); ?></td>
        </tr>
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
            <td colspan="2">
                <?php $this->getLink('Passwort &auml;ndern', 'User', 'editPassword'); ?>
            </td>
        </tr>        
    </tbody>
</table>

<?php
// TODO Formular zum Erstellen eines authKey + Authenfizierung im Request, wenn wenn authKey gesetzt ist
// Api Aufrufe
?>

<?php if ($this->user->getAdmin()): ?>
<h2>Admin</h2>
<?php $this->getLink('Neuen Benutzer erstellen', 'User', 'new'); ?><br>
<?php $this->getLink('Zeige alle Benutzer', 'User', 'list'); ?>

<?php endif; ?>

<h2>Export</h2>
<?php $this->getLink('Kundendaten f&uuml;r Backup als XML', 'Api', 'get', array(), '', '_blank'); ?>