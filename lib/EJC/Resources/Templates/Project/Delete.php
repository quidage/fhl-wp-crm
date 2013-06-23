<?php
/**
 * Template fuer \EJC\Controller\ProjectController->deleteAction()
 *
 * Hinweis, das ein Eintrag gelöscht wurde
 *
 * @author Julian Hilbers <hilbers.julian@gmail.com>
 * @package wp-crm
 */
?>

<h1>Der Eintrag wurde gelöscht</h1>

<p>Der Löschvorgang ist noch nicht ganz fertig :)</p>
<p>Der Eintrag <i><strong><?php echo $this->projectData->getName(); ?></strong></i> wurde aus dem System entfernt.</p>
<p><?php $this->getLink('zurück zur Übersicht','User', 'start');?></p>