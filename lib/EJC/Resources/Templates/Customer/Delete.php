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

<h1>Kunde wurde gelöscht</h1>

<p>Der Kunde <i><strong><?php echo $this->customerData->getName(); ?></strong></i> wurde aus dem System entfernt.</p>
<p><?php $this->getLink('zurück zur Übersicht','Customer', 'listByUser');?></p>