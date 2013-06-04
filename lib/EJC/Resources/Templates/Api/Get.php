<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<CUSTOMERS>
    
    <?php foreach ($this->customers AS $customer): ?>
    <CUSTOMER>
        <ID><?php echo $customer->getId(); ?></ID>
        <NAME><?php echo $customer->getName(); ?></NAME>
        <STREET><?php echo $customer->getStreet(); ?></STREET>
        <ZIP><?php echo $customer->getZip(); ?></ZIP>
        <CITY><?php echo $customer->getCity(); ?></CITY>
        <PHONE><?php echo $customer->getPhone(); ?></PHONE>
        <FAX><?php echo $customer->getFax(); ?></FAX>
        <EMAIL><?php echo $customer->getEmail(); ?></EMAIL>
        
        <?php foreach($customer->getProjects() AS $project): ?>
        <PROJECT>
            <ID><?php echo $project->getId(); ?></ID>
            <NAME><?php echo $project->getName(); ?></NAME>
            <DESCRIPTION><?php echo $project->getDescription(); ?></DESCRIPTION>
            <STATUS><?php echo $project->getDescription(); ?></STATUS>
            
            <?php foreach($project->getTasks() AS $task): ?>
            <TASK>
                <ID><?php echo $task->getId(); ?></ID>
                <NAME><?php echo $task->getName(); ?></NAME>
                <DESCRIPTION><?php echo $task->getDescription(); ?></DESCRIPTION>
            </TASK>
            <?php endforeach; ?>
            
        </PROJECT>
        <?php endforeach; ?>
        
    </CUSTOMER>
    <?php endforeach; ?>
    
</CUSTOMERS>