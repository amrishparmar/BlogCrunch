<?php
include_once "includes/helpers.php";
include_once "models/AdminTable.php";

// the message to display if there is an error to show (defaults to empty string)
$error_message = "";

// check if the login form was submitted
if (isset($_POST['login'])) {
    // connect to the admin table
    $admin_table = new AdminTable($connection);
    try {
        // check the credentials passed in, may cause exception if they are invalid
        $admin_table->checkCredentials($_POST['username'], $_POST['password']);
        // log the user in
        getIdAndLogIn($user_session, $admin_table, $_POST['username'], true);
    }
    catch (Exception $e) {
        $error_message = "Invalid username or password combination.";
    }
}

// if the logout button was pressed then log the user out
if (isset($_POST['logout'])) {
    $user_session->logout();
}

// if the user is not logged in as an admin then show the login form
if (!$user_session->isAdminLoggedIn()) {
    include_once "views/admin/login-form-html.php";
}