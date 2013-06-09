<?php
/**
 * Template fuer das Formular zum Editieren des Customer
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Neues Projekt</h1>

<form name="newProject" method="post" action="<?php $this->getUrl('Project', 'create'); ?>">
    <table>
        <tr>
                <td>Kunde:</td>
                <td>
                    <select name="newProject[parent_id]">
                        <?php foreach ($this->customers AS $customer): ?>
                        <option value="<?php echo $customer->getId(); ?>"><?php echo $customer->getId() . ' ' . $customer->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
        </tr>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="newProject[name]" value="" /></td>
        </tr>
        <tr>
                <td>Beschreibung:</td>
                <td>
                    <textarea rows="4" columns="60" name="newProject[description]"></textarea>
                </td>
        </tr>
        <tr>
                <td>Status:</td>
                <td>
                    <select name="newProject[status]">
                        <?php foreach ($this->newProject->getPossibleStatus() AS $status): ?>
                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
        </tr>
        <tr>
                <td colspan="2" style="text-align: left;"><input type="submit" value="Speichern" class="submit button-link" /></td>
        </tr>
    </table>
</form>