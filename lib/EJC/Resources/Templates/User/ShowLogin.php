<div class="errors">
    <?php echo $this->errors; ?>
</div>        

<div id="loginform">
    <form name="login" method="post" action="index.php?controller=user&action=login">
            <input type="text" name="login[name]" />
            <input type="password" name="login[password]" />
            <button type="submit">Login</button>
    </form>
</div>