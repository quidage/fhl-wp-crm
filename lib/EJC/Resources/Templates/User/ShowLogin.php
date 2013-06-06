 <div id="loginform">
    <form name="login" method="post" action="<?php $this->getUrl('user', 'login'); ?>">
        <table>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="login[name]" /></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input type="password" name="login[password]" /></td>
            </tr>
            <tr>
                <td></td>
                <td><button class="button-link" type="submit">Login</button></td>
            </tr>
        </table>
    </form>
</div>