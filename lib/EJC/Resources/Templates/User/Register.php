<?php
/**
 * Template fuer \EJC\Controller\UserController->registerAction()
 *
 * Formular für die Registrierung eines neuen Users
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Registrierung</h1>

<form name="registerUser" method="post" action="<?php echo $this->getUrl('User', 'createRegistered'); ?>">
    <table>
        <tr>
                <td>Username:</td>
                <td><input type="text" name="newUser[name]" value="<?php echo $this->newUser->getName(); ?>" placeholder="musteruser" /></td>
        </tr>
        <tr>
                <td>Vorname:</td>
                <td><input type="text" name="newUser[first_name]" value="<?php echo $this->newUser->getFirst_name(); ?>" placeholder="Max" /></td>
        </tr>
        <tr>
                <td>Nachname:</td>
                <td><input type="text" name="newUser[last_name]" value="<?php echo $this->newUser->getLast_name(); ?>" placeholder="Mustermann" /></td>
        </tr>
        <tr>
                <td>E-Mail Adresse:</td>
                <td><input type="text" name="newUser[email]" value="<?php echo $this->newUser->getEmail(); ?>" placeholder="max@mustermann.de" /></td>
        </tr>
        <tr>
                <td>Passwort:</td>
                <td><input type="password" name="newUser[password]" placeholder="********" /></td>
        </tr>
        <tr>
                <td>Passwort best&auml;tigen:</td>
                <td><input type="password" name="passwordConfirm" placeholder="********" /></td>
        </tr>
        <tr>
            <td></td><td><input type="submit" value="Absenden" class="submit button-link" /></td>
        </tr>
    </table>
</form>