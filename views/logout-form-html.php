<hr>
<form method="post" action="<?php echo $redirect; ?>">
    <p>Logged in as <?php echo $_SESSION['username'] ?></p>
    <button class="btn btn-primary" type="submit" name="logout" value="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</button>
</form>