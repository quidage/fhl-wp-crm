<h1>Kunden</h1>

<table>
    <thead>
        <tr>
            <td>Kunden-Nr.</td>
            <td>Name</td>
            <td>Stra&szlig;e</td>
            <td>Ort</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->customers AS $customer) : ?>
            <tr>
                <td><?php echo sprintf("%05d", $customer->getId()); ?></td>
                <td><?php echo $customer->getName(); ?></td>
                <td><?php echo $customer->getStreet(); ?></td>
                <td><?php echo $customer->getZip() . " " . $customer->getCity(); ?></td> 
            </tr>
        <?php endforeach; ?> 
    </tbody>
</table>
