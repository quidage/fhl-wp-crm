<?php
/*
 * View für die Benutzereistellungen
 * 
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Benutzereinstellungen von <?php echo $this->user->getName(); ?></h2>


<table>
    <thead>
        <caption>Ihre Daten</caption>
    </thead>
    <tbody>
        <tr>
            <td>Vorname:</td>
            <td><?php echo $this->user->getFirst_name(); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Nachname:</td>
            <td><?php echo $this->user->getLast_name(); ?></td>
            <td><a href="<?php $this->getUrl('User', 'edit'); ?>" ><img src="images/iconset/writeNew.png" /></a></td>
        </tr>
        <tr>
            <td>E-Mail Adresse:</td>
            <td><?php echo $this->user->getEmail(); ?></td>
            <td><a href="<?php $this->getUrl('User', 'edit'); ?>" ><img src="images/iconset/writeNew.png" /></a></td>
        </tr>
    </tbody>
</table>