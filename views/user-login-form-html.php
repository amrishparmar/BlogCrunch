<form method="post" action="index.php?page=blog&id=<?php echo $_GET['id']?>">
    <fieldset>
        <legend>Login to post a comment</legend>
        <label>Enter your username: </label>
        <input type="text" name="username" title="username" required><br>
        <label>Password: </label>
        <input type="password" name="password" title="password"><br>
        <button class="btn btn-primary" type="submit" name="action" value="login"><i class="fa fa-sign-in" aria-hidden="true"></i> Log in</button>
    </fieldset>
</form>
<p class="error bg-danger"><?php echo $error_message ?></p>
<p class="success bg-success"><?php echo $success_message ?></p>
<form method="post" action="index.php?page=blog&id=<?php echo $_GET['id']?>">
    <fieldset>
        <legend>Or create an account</legend>
        <label>Username: </label>
        <input type="text" name="username" title="username" required><br>
        <label>Email address: </label>
        <input type="email" name="email" title="email" required><br>
        <label>Password: </label>
        <input type="password" name="password" title="password" required><br>
        <button class="btn btn-primary" type="submit" name="action" value="create-user"><i class="fa fa-user-plus" aria-hidden="true"></i> Create account</button>
    </fieldset>
</form>