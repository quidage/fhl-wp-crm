<?php
/**
 * Template fuer \EJC\Controller\TaskController->showAction()
 * 
 * Detaildarstellung eines Tasks
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1><?php echo $this->task->getName(); ?></h1>
<p><strong>Status:</strong> <?php echo $this->task->getStatus(); ?><br />
<strong>Beschreibung:</strong><br /><?php echo $this->task->getDescription(); ?></p>
