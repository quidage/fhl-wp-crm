<?php
/**
 * Template fuer \EJC\Controller\ProjectController->editAction()
 * 
 * Formular zum Editieren des Project
 * 
 * @author Christian Hansen <christian.hansen@stud.fh-luebeck.de>
 * @package wp-crm
 */
?>

<h1>Projekt <?php echo $this->project->getName(); ?> editieren</h1>

<form name="edit" method="post" action="<?php $this->getUrl('Project', 'update'); ?>">
    <input type="hidden" name="project[id]" value="<?php echo $this->project->getId() ?>">
    <table>
        <tr>
                <td>Name:</td>
                <td><input type="text" name="project[name]" value="<?php echo $this->project->getName(); ?>" /></td>
        </tr>
        <tr>
                <td>Beschreibung:</td>
                <td>
                    <textarea rows="4" columns="60" name="project[description]"><?php echo $this->project->getDescription(); ?></textarea>
                </td>
        </tr>
        <tr>
                <td>Status:</td>
                <td>
                    <select name="project[status]">
                        <?php foreach ($this->project->getPossibleStatus() AS $status): ?>
                        <option value="<?php echo $status; ?>" <?php if($status === $this->project->getStatus()) echo ' selected' ?>><?php echo $status; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
        </tr>
        <tr>
                <td colspan="2" style="text-align: left;"><input type="submit" value="Speichern" class="submit button-link" /></td>
        </tr>
    </table>
</form>