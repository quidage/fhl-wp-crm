<?php
/**
 * Controller fuer die Projects
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1><?php echo $this->project->getName(); ?></h1>

<?php foreach ($this->project->getTasks() as $task): ?>
    <?php echo $task->getName(); ?>	
<?php endforeach ?>