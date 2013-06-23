 <?php
/*
 * Template fuer \EJC\Controller\UserController->showLoginAction()
 *
 * Startseite mit Login-Formular
 *
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

 <h1>F&uuml;r Freelancer und Selbstst&auml;ndige</h1>
 <p>Zeitsparen bei der Kunden- und Projektverwaltung</p>
 <a href="<?php $this->getUrl('User', 'register'); ?>" class="button-link">Kostenlos registrieren</a>

 <div id="loginform">
    <form name="login" method="post" action="<?php $this->getUrl('user', 'login'); ?>">
        <fieldset>
        <legend>Anmelden</legend>
	        <table>
	            <tr>
	            	<td>Username:</td>
	            	<td>Passwort:</td>
	            	<td></td>
	            </tr>
	            <tr>
	              	<td><input type="text" name="login[name]" /></td>
	              	<td><input type="password" name="login[password]" /></td>
	              	<td><button class="button-link" type="submit">Login</button></td>
	            </tr>
	            <tr>
	            	<td colspan="3" style="text-align:right; font-size:10px;">Noch nicht angemeldet? <?php $this->getLink('Jetzt registrieren', 'User', 'register'); ?>
	            	| <?php $this->getLink('Passwort vergessen?', 'User', 'requestNewPassword'); ?></td>
	            </tr>
	        </table>
        </fieldset>
    </form>
</div>