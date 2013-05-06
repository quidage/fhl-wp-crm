    

<div id="loginform">
    <form name="login" method="post" action="index.php?controller=user&action=login">


        
    </form>

    <form name="login" method="post" action="<?php $this->getUrl('user', 'login'); ?>">
        <table>
            <tr>
                <td></td>
                <td>
                    <div class="errors">
                        <?php echo $this->errors; ?>
                    </div>    
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="login[name]" /></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="button-link" type="submit">Login</button></td>
            </tr>
        </table>
    </form>
</div>