<?php
/**
 * Template fuer \EJC\Controller\ProjectController->deleteMessageAction()
 *
 * Abfrage zur Sicherstellung, dass ein Eintrag nicht versehentlich gelöscht wird
 *
 * @author Julian Hilbers <hilbers.julian@gmail.com>
 * @package wp-crm
 */
?>

<h1>Kunde löschen</h1>

<p>Zum löschen des folgenden Kunden bitte auf Löschen klicken.</p>
<p><strong><?php echo $this->customerData->getName(); ?></strong></p>
<form name="edit" method="post" action="index.php?controller=customer&action=delete">
	<input type="hidden" name="customer[id]" value="<?php echo $this->customerData->getId(); ?>" />
	<input type="submit" value="Löschen" class="submit button-link" />
	<input id="close-wnd" type="submit" value="Abbrechen" class="submit button-link" />
</form>