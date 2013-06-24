<?php
/**
 * Template fuer \EJC\Controller\UserController->confirmRegistrationAction()
 *
 * Bestaetigung fuer die erfogreiche endgueltige Registrierung
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1><?php echo $this->title ?></h1>

<?php if ($this->registered): ?>
<p>Sie k&ouml;nnen sich nun einloggen und das System uneingeschr&auml;nkt nutzen.</p>
<a href="/">Zum Login</a>
<?php else: ?>
<p>Leider konnte ihre Registrierung nicht best&auml;tigt werden.</p>
<?php endif; ?>

