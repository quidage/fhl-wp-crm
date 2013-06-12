<?php
/**
 * Template fuer \EJC\Controller\CustomerController->listByUserAction()
 * 
 * Liste alle Customer zu einem User
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<table width="100%">
    <thead>
    	<caption>Kunden
    	<span class="new-object"><?php $this->getLink('neuen Kunden anlegen', 'Customer', 'new'); ?></span></caption>
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
                <td><?php $this->getLink('Bearbeiten', 'Customer', 'edit', array('customer[id]' => $customer->getId())); ?></td> 
                <td><?php $this->getLink('neues Projekt', 'Project', 'new', array('customer[id]' => $customer->getId())); ?></td> 
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
