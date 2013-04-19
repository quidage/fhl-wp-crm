<div class="errors">
    <?php echo $this->errors; ?>
</div>        

<div id="loginform">
    <form name="login" method="post" action="index.php?controller=user&action=login">
            <input type="text" name="user[name]" />
            <input type="password" name="user[password]" />
            <button type="submit">Einloggen</button>
    </form>
</div>