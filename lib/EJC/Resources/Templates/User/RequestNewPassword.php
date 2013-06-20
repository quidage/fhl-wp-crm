<?php
/**
 * Template fuer \EJC\Controller\UserController->newAction()
 *
 * Formular für die Erstellung eines neuen Users
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Ein neues Passwort anfordern</h1>

<p>Sie haben ihr Passwort vergessen? Lassen Sie sich von uns ein Neues an ihre registrierte E-Mail-Adresse schicken.</p>

<form name="requestNewPassword" method="post" action="<?php $this->getUrl('User', 'sendNewPassword'); ?>">
    <table>
        <tr>
                <td>E-Mail-Adresse:</td>
                <td><input type="text" name="email" value="" placeholder="max@mustermann.de" /></td>
        </tr>
        <tr>
            <td></td><td><input
                        type="submit" value="Absenden" class="submit button-link" /></td>
        </tr>
    </table>
</form>