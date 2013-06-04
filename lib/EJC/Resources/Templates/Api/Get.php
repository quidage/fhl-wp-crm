<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<CUSTOMERS>
    <?php foreach ($this->customers AS $customer): ?><CUSTOMER>
        <ID><?php echo $customer->getId(); ?></ID>
        <NAME><?php echo $customer->getName(); ?></NAME>
        <STREET><?php echo $customer->getStreet(); ?></STREET>
        <ZIP><?php echo $customer->getZip(); ?></ZIP>
        <CITY><?php echo $customer->getCity(); ?></CITY>
        <PHONE><?php echo $customer->getPhone(); ?></PHONE>
        <FAX><?php echo $customer->getFax(); ?></FAX>
        <EMAIL><?php echo $customer->getEmail(); ?></EMAIL>
    </CUSTOMER><?php endforeach; ?>
</CUSTOMERS>