<?php
/*
 * View für die Benutzereistellungen
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Benutzereinstellungen</h2>

<?php 

    echo $this->user->getName();
    echo $this->user->getFirst_name();
    echo $this->user->getLast_name();

?>
