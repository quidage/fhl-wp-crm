<?php
/**
 * Template fuer \EJC\Controller\CustomerController->listByUserAction()
 * 
 * Liste alle Customer zu einem User
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @author Julian Hilbers <hilbers.julian@gmail.com>
 * @package wp-crm
 */
?>

<table width="100%">
    <thead>
    	<caption>Kunden
	    	<span class="new-object">
	    		<?php $this->getLink('<img src="images/iconset/plus_white.png" alt="neuer kunde">Neuer Kunde ','Customer', 'new', array('ajax' => true), '.std-btn');?>
	    	</span>
    	</caption>
        <tr>
            <th>Kunden-Nr.</th>
            <th>Name</th>
            <th>Stra&szlig;e</th>
            <th>Ort</th>
            <th>Telefon/Fax</th>
            <th>Email</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->customers AS $customer) : ?>
            <tr>
                <td><?php echo sprintf("%05d", $customer->getId()); ?></td>
                <td><?php echo $customer->getName(); ?></td>
                <td><?php echo $customer->getStreet(); ?></td>
                <td><?php echo $customer->getZip() . " " . $customer->getCity(); ?></td> 
                <td><?php echo $customer->getPhone() . "<br>" . $customer->getFax(); ?></td> 
                <td><a href="mailto:<?php echo $customer->getEmail(); ?>"><?php echo $customer->getEmail(); ?></a></td> 
                <td>
                	<a href="<?php $this->getUrl('Customer', 'edit', array('customer[id]' => $customer->getId())); ?>" title="Bearbeiten">
                		<img src="images/iconset/writeNew_black.png" /></a> 
                	<a href="<?php $this->getUrl('Project', 'new', array('customer[id]' => $customer->getId())); ?>" title="Neues Projekt">
                		<img src="images/iconset/plus_black.png" /></a>
                </td> 
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
