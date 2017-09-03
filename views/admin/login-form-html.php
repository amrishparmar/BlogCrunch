<p class="error bg-danger"><?php echo $error_message ?></p>
<form method="post" action="admin.php">
    <fieldset>
        <legend>Login to access admin area</legend>
        <label for="username">Enter your username or e-mail address: </label><br>
        <input type="text" name="username" id="username" required><br>
        <label for="password">Password: </label><br>
        <input type="password" name="password" id="password"><br>
        <button class="btn btn-primary" type="submit" name="login" value="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>
    </fieldset>
</form>