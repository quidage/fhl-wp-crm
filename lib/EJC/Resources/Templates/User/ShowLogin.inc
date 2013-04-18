<?php
$this->template = <<<TEMPLATE
        
<form name="login" method="post" action="index.php?controller=user&action=login">
        <input type="text" name="name" />
        <input type="password" name="password" />
        <button type="submit">Einloggen</button>
</form>

TEMPLATE;
?>
