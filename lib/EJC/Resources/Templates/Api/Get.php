<?php
/**
 * Template fuer XML-Ausgabe aller Kundendaten eines Users
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' ?>

<customers>
<?php foreach ($this->customers AS $customer): ?>
    <customer>
        <id><?php echo $customer->getId(); ?></id>
        <name><?php echo $customer->getName(); ?></name>
        <street><?php echo $customer->getStreet(); ?></street>
        <zip><?php echo $customer->getZip(); ?></zip>
        <city><?php echo $customer->getCity(); ?></city>
        <phone><?php echo $customer->getPhone(); ?></phone>
        <fax><?php echo $customer->getFax(); ?></fax>
        <email><?php echo $customer->getEmail(); ?></email>
<?php foreach($customer->getProjects() AS $project): ?>
        <project>
            <id><?php echo $project->getId(); ?></id>
            <name><?php echo $project->getName(); ?></name>
            <description><?php echo $project->getDescription(); ?></description>
            <status><?php echo $project->getStatus(); ?></status>
<?php foreach($project->getTasks() AS $task): ?>
            <task>
                <id><?php echo $task->getId(); ?></id>
                <name><?php echo $task->getName(); ?></name>
                <description><?php echo $task->getDescription(); ?></description>
                <status><?php echo $task->getStatus(); ?></status>
            </task>
<?php endforeach; ?>
        </project>
<?php endforeach; ?>
    </customer>
<?php endforeach; ?>
</customers>