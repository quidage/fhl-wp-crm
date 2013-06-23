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

<h1>Projekt löschen</h1>

<p>Zum löschen des folgenden Projektes bitte auf Löschen klicken.</p>
<p><strong><?php echo $this->projectData->getName(); ?></strong></p>
<form name="edit" method="post" action="index.php?controller=project&action=delete">
	<input type="hidden" name="project[id]" value="<?php echo $this->projectData->getId(); ?>" />
	<input type="submit" value="Löschen" class="submit button-link" />
	<input id="close-wnd" type="submit" value="Abbrechen" class="submit button-link" />
</form>