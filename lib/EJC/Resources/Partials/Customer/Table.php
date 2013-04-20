<table>
    <thead>
        <tr>
            <td>id</td>
            <td>name</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->cusomers AS $customer): ?>
        <tr>
            <td><?php echo $customer->getId(); ?></td>
            <td><?php echo $customer->getName(); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
 