<?php
/**
 * Template fuer \EJC\Controller\TaskController->editAction()
 *
 * Formular zum Editieren einer Aufgabe
 *
 * @author Enrico Lauterschlag <enrico.lauterschlag@web.de>
 * @package wp-crm
 */
?>

<h1>Aufgabe <?php echo $this->task->getName(); ?> editieren</h1>

<form name="edit" method="post" action="<?php echo $this->getUrl('Task', 'update'); ?>">
    <input type="hidden" name="task[id]" value="<?php echo $this->task->getId() ?>">
    <table>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="task[name]" value="<?php echo $this->task->getName(); ?>" /></td>
        </tr>
        <tr>
                <td>Beschreibung:</td>
                <td>
                    <textarea rows="4" columns="60" name="task[description]"><?php echo $this->task->getDescription(); ?></textarea>
                </td>
        </tr>
        <tr>
                <td>Status:</td>
                <td>
                    <select name="task[status]">
                        <?php foreach ($this->task->getPossibleStatus() AS $status): ?>
                        <option value="<?php echo $status; ?>" <?php if($status === $this->task->getStatus()) echo ' selected' ?>><?php echo $status; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
        </tr>
        <tr>
                <td colspan="2" class="btn-field">
                	<input type="submit" value="Speichern" class="submit button-link" />
                	<input id="std-close-wnd" type="submit" value="Abbrechen" class="submit button-link" />
                </td>
        </tr>
    </table>
</form>