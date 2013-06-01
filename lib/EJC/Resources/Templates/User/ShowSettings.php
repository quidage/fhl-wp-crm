<?php
/*
 * View für die Benutzereistellungen
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Benutzereinstellungen</h2>

<?php foreach ($this->users AS $user):

    echo $user->getName();
    echo $user->getFirst_name();
    echo $user->getLast_name();

endforeach; ?>
