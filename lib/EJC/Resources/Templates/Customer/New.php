<?php
/**
 * Template fuer \EJC\Controller\CustomerController->newAction()
 * 
 * Formular um einen neuen Customer zu erstellen
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Neuen Kunde anlegen</h1>

<form name="newCustomer" method="post" action="<?php $this->getUrl('Customer', 'create'); ?>">
    <table>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="customer[name]" placeholder="Musterkunde" value=""></td>
        </tr>
        <tr>
                <td>Stra&szlig;e:</td>
                <td><input type="text" name="customer[street]" placeholder="Musterstra&szlig;e" value="" /></td>
        </tr>
        <tr>
                <td>Plz/Ort</td>
                <td><input type="text" name="customer[zip]" style="width: 60px;" placeholder="PLZ" value="" />
                <input type="text" name="customer[city]" style="width: 188px;" value="" placeholder="Musterstadt" /></td>
        </tr>
        <tr>
                <td>Telefon:</td>
                <td><input type="text" name="customer[phone]" value="" placeholder="+49 (0) 40 1234 5678" /></td>
        </tr>
        <tr>
                <td>Fax:</td>
                <td><input type="text" name="customer[fax]" value="" placeholder="+49 (0) 40 1234 5678" /></td>
        </tr>
        <tr>
                <td>E-Mail:</td>
                <td><input type="text" name="customer[email]" value="" placeholder="max.mustermann@musterkunde.de" /></td>
        </tr>
        <tr>
                <td colspan="2" style="text-align: left;"><input type="submit" value="Speichern" class="submit button-link" /></td>
        </tr>
    </table>
</form>