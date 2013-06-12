<?php
/*
 * Formular f&uuml;r die &Auml;nderung der Benutzerdaten 
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Benutzerdaten &Auml;ndern</h1>

<form name="edit" method="post" action="<?php $this->getUrl('user', 'update'); ?>">
    <input type="hidden" name="user[id]" value="<?php echo $this->user->getId() ?>">
    <table>
        <tr>
                <td>Vorname:</td>
                <td><input type="text" name="user[first_name]" value="<?php echo $this->user->getFirst_name(); ?>" /></td>
        </tr>
        <tr>
                <td>Nachname:</td>
                <td><input type="text" name="user[last_name]" value="<?php echo $this->user->getLast_name(); ?>" /></td>
        </tr>
        <tr>
                <td>E-Mail Adresse:</td>
                <td><input type="text" name="user[email]" value="<?php echo $this->user->getEmail(); ?>" /></td>
        </tr>
        <tr>
            <td></td>
                <td><input type="submit" value="Speichern" class="submit button-link" /></td>
        </tr>
    </table>
</form>