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

<h1>Aufgabe wurde gelöscht</h1>

<p>Die Aufgabe <i><strong><?php echo $this->taskData->getName(); ?></strong></i> wurde aus dem System entfernt.</p>
<p><?php $this->getLink('zurück zur Übersicht','Project', 'show', array('project[id]' => $this->taskData->getParent_id()));?></p>