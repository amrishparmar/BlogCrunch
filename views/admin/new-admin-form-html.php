<p class="success bg-success"><?php echo $success_message; ?></p>
<p class="error bg-danger"><?php echo $error_message; ?></p>
<form method="post" action="admin.php?page=users" id="login-form">
    <fieldset>
        <legend>Create a user</legend>
        <label for="username">Username: </label><br>
        <input type="text" name="username" id="username" required><br>
        <label for="email">Email address: </label><br>
        <input type="email" name="email" id="email" required><br>
        <label for="password">Password: </label><br>
        <input type="password" name="password" id="password" required><br>
        <button class="btn btn-primary" type="submit" name="action" value="create-user"><i class="fa fa-user-plus" aria-hidden="true"></i> Create user</button>
    </fieldset>
</form>