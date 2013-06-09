<?php
/**
 * Template fuer das Formular zum Editieren des Customer
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Kunde <?php echo $this->customer->getName(); ?> editieren</h1>

<form name="edit" method="post" action="<?php $this->getUrl('Customer', 'update'); ?>">
    <input type="hidden" name="customer[id]" value="<?php echo $this->customer->getId() ?>">
    <table>
        <tr>
                <td>Vorname:</td>
                <td><input type="text" name="customer[name]" value="<?php echo $this->customer->getName(); ?>" /></td>
        </tr>
        <tr>
                <td>Stra&szlig;e:</td>
                <td><input type="text" name="customer[street]" value="<?php echo $this->customer->getStreet(); ?>" /></td>
        </tr>
        <tr>
                <td>Plz/Ort</td>
                <td><input type="text" name="customer[zip]" style="width: 20%;" value="<?php echo $this->customer->getZip(); ?>" />
                <input type="text" name="customer[city]" style="width: 70%;" value="<?php echo $this->customer->getCity(); ?>" /></td>
        </tr>
        <tr>
                <td>Telefon:</td>
                <td><input type="text" name="customer[phone]" value="<?php echo $this->customer->getPhone(); ?>" /></td>
        </tr>
        <tr>
                <td>Fax:</td>
                <td><input type="text" name="customer[fax]" value="<?php echo $this->customer->getFax(); ?>" /></td>
        </tr>
        <tr>
                <td>E-Mail:</td>
                <td><input type="text" name="customer[email]" value="<?php echo $this->customer->getEmail(); ?>" /></td>
        </tr>
        <tr>
                <td colspan="2" style="text-align: left;"><input type="submit" value="Speichern" class="submit button-link" /></td>
        </tr>
    </table>
</form>