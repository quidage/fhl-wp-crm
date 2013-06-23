<?php
/**
 * Template fuer \EJC\Controller\TaskController->newAction()
 *
 * Formular zum Erstellen eines neuen Task
 *
 * @todo nur von project kopiert, muss noch angepasst werden
 *
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Neue Aufgabe</h1>

<form name="newTask" method="post" action="<?php $this->getUrl('Task', 'create'); ?>">
    <table>
        <tr>
                <td>Project:</td>
                <td>
                    <?php echo $this->project->getId() . ' ' . $this->project->getName(); ?>
                    <input type="hidden" name="newTask[parent_id]" value="<?php echo $this->project->getId(); ?>">
                </td>
        </tr>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="newTask[name]" value="" placeholder="Musteraufgabe" /></td>
        </tr>
        <tr>
                <td>Beschreibung:</td>
                <td>
                    <textarea rows="4" columns="60" name="newTask[description]" placeholder="Musterbeschreibungstext" ></textarea>
                </td>
        </tr>
        <tr>
                <td>Status:</td>
                <td>
                    <?php
                        // Die Statusse zum Project stehen als Array im Model des Projects
                        // in der Methode getPossibleStatus()
                    ?>
                    <select name="newTask[status]">
                        <?php foreach ($this->newTask->getPossibleStatus() AS $status): ?>
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