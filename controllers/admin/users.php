<?php
include_once "models/AdminTable.php";

// instantiate a new admin table object
$admin_table = new AdminTable($connection);

// the success message will blank unless a successful action has occurred
$success_message = "";
// the error message will be blank unless an error has occurred
$error_message = "";

// check if any action button was clicked
if (isset($_POST['action'])) {
    // check if the create user button was clicked
    if ($_POST['action'] == "create-user") {
        // add the user and get return value of whether it was successful
        $add_user_success = $admin_table->addUser($_POST['username'], $_POST['email'], $_POST['password']);
        // update the success or error message depending on the result
        if ($add_user_success) {
            $success_message = "User \"" . $_POST['username'] . "\" has been successfully created.";
        }
        else {
            $error_message = "Username or e-mail already exists.";
        }
    }
}

// include the view for the admin creation form
include_once "views/admin/new-admin-form-html.php";