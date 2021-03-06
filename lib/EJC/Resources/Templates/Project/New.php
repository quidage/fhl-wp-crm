<?php
/**
 * Template fuer \EJC\Controller\ProjectController->newAction()
 *
 * Formular zum Erstellen eines neuen Project
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Neues Projekt anlegen</h1>

<form name="newProject" method="post" action="<?php echo $this->getUrl('Project', 'create'); ?>">
    <table>
        <tr>
                <td>Kunde:</td>
                <td>
                    <?php if (count($this->customers) > 1): ?>
                        <select name="newProject[parent_id]">
                            <?php foreach ($this->customers AS $customer): ?>
                            <option value="<?php echo $customer->getId(); ?>"><?php echo $customer->getId() . ' | ' . $customer->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <?php echo $this->customers[0]->getId() . ' ' . $this->customers[0]->getName(); ?>
                        <input type="hidden" name="newProject[parent_id]" value="<?php echo $this->customers[0]->getId(); ?>">
                    <?php endif; ?>
                </td>
        </tr>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="newProject[name]" value="" placeholder="Musterprojekt" /></td>
        </tr>
        <tr>
                <td>Beschreibung:</td>
                <td>
                    <textarea rows="4" columns="60" name="newProject[description]" placeholder="Musterbeschreibungstext" ></textarea>
                </td>
        </tr>
        <tr>
                <td>Status:</td>
                <td>
                    <?php
                        // Die Statusse zum Project stehen als Array im Model des Projects
                        // in der Methode getPossibleStatus()
                    ?>
                    <select name="newProject[status]">
                        <?php foreach ($this->newProject->getPossibleStatus() AS $status): ?>
                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
        </tr>
        <tr>
                <td></td>
                <td class="btn-field"><input type="submit" value="Speichern" class="submit button-link" />
                	<input id="std-close-wnd" type="submit" value="Abbrechen" class="submit button-link" /></td>
        </tr>
    </table>
</form>