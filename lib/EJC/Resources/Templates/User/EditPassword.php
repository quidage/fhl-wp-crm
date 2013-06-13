<?php
/**
 * Template fuer \EJC\Controller\UserController->editPasswordAction()   
 *
 * Formular fuer die Aenderung der des User-Passworts
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Passwort &auml;ndern</h1>

<form name="ediPassword" method="post" action="<?php $this->getUrl('User', 'updatePassword'); ?>">
    <input type="hidden" name="user[id]" value="<?php echo $this->user->getId() ?>">
    <table>
        <tr>
                <td>Altes Passwort:</td>
                <td><input type="password" name="oldPassword" placeholder="********" /></td>
        </tr>
        <tr>
                <td>Neues Passwort:</td>
                <td><input type="password" name="newPassword" placeholder="********" /></td>
        </tr>
        <tr>
                <td>Neues Passwort:</td>
                <td><input type="password" name="newPasswordConfirm" placeholder="********" /></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Speichern" class="submit button-link" /></td>
        </tr>
    </table>
</form>