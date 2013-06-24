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

<h1>Aufgabe löschen</h1>

<p>Zum löschen der folgenden Aufgabe bitte auf Löschen klicken.</p>
<p><strong><?php echo $this->taskData->getName(); ?></strong></p>
<form name="edit" method="post" action="index.php?controller=task&action=delete">
	<input type="hidden" name="task[id]" value="<?php echo $this->taskData->getId(); ?>" />
	<input type="submit" value="Löschen" class="submit button-link" />
	<input id="close-wnd" type="submit" value="Abbrechen" class="submit button-link" />
</form>