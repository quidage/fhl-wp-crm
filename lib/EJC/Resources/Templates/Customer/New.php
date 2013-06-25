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

<form name="newCustomer" method="post" action="<?php echo $this->getUrl('Customer', 'create'); ?>">

    <input type="hidden" name="newCustomer[parent_id]" value="<?php echo $this->user->getId(); ?>" />

    <table>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="newCustomer[name]" placeholder="Musterkunde" value="<?php echo $this->newCustomer->getName(); ?>"></td>
        </tr>
        <tr>
                <td>Stra&szlig;e:</td>
                <td><input type="text" name="newCustomer[street]" placeholder="Musterstra&szlig;e" value="<?php echo $this->newCustomer->getStreet(); ?>" /></td>
        </tr>
        <tr>
                <td>Plz/Ort</td>
                <td><input type="text" name="newCustomer[zip]" style="width: 60px;" placeholder="PLZ" value="<?php echo $this->newCustomer->getZip(); ?>" />
                <input type="text" name="newCustomer[city]" style="width: 188px;" value="<?php echo $this->newCustomer->getCity(); ?>" placeholder="Musterstadt" /></td>
        </tr>
        <tr>
                <td>Telefon:</td>
                <td><input type="text" name="newCustomer[phone]" value="<?php echo $this->newCustomer->getPhone(); ?>" placeholder="+49 (0) 40 1234 5678" /></td>
        </tr>
        <tr>
                <td>Fax:</td>
                <td><input type="text" name="newCustomer[fax]" value="<?php echo $this->newCustomer->getFax(); ?>" placeholder="+49 (0) 40 1234 5678" /></td>
        </tr>
        <tr>
                <td>E-Mail:</td>
                <td><input type="text" name="newCustomer[email]" value="<?php echo $this->newCustomer->getEmail(); ?>" placeholder="max.mustermann@musterkunde.de" /></td>
        </tr>
        <tr>
                <td></td>
                <td class="btn-field"><input type="submit" value="Speichern" class="submit button-link" />
                	<input id="std-close-wnd" type="submit" value="Abbrechen" class="submit button-link" /></td>
        </tr>
    </table>
</form>