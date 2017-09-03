<?php
include_once "includes/helpers.php";
include_once "models/StandardUserTable.php";

// the message to display upon success or failure (defaults to empty string)
$error_message = "";
$success_message = "";

// check if one of the action buttons was clicked
if (isset($_POST['action'])) {
    // create a new standard user table object (admins and standard users will therefore see the same thing)
    $user_table = new StandardUserTable($connection);
    // if the login button was clicked
    if ($_POST['action'] === "login") {
        try {
            // check if the credentials are valid and log them in if so
            $user_table->checkCredentials($_POST['username'], $_POST['password']);
            getIdAndLogIn($user_session, $user_table, $_POST['username'], false);
        }
        catch (Exception $e) {
            $error_message = "Invalid username or password combination.";
        }
    }
    // if the create user button was clicked
    elseif ($_POST['action'] === 'create-user') {
        // attempt to add the user and get the result of whether or not it succeeded
        $add_user_success = $user_table->addUser($_POST['username'], $_POST['email'], $_POST['password']);
        // if it was successful log the user in with the new account
        if ($add_user_success) {
            $success_message = "User \"" . $_POST['username'] . "\" has been successfully created.";
            getIdAndLogIn($user_session, $user_table, $_POST['username'], false);
        }
        // otherwise show an error message
        else {
            $error_message = "Username or e-mail already exists.";
        }
    }
}

// if the user is not logged in then show the login/create account view
if (!$user_session->isLoggedIn()) {
    include_once "views/user-login-form-html.php";
}