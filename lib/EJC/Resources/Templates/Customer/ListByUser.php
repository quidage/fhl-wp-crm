<table width="100%">
    <thead>
    	<caption>Kunden
    	<span style="float: right; padding-right: 10px;"><?php $this->getLink('neuen Kunden anlegen', 'Customer', 'new'); ?></span></caption>
        <tr>
            <td>Kunden-Nr.</td>
            <td>Name</td>
            <td>Stra&szlig;e</td>
            <td>Ort</td>
            <td>Telefon/Fax</td>
            <td>Email</td>
            <td></td>
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
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
