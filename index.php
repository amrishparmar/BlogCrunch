<?php
// show all error messages
error_reporting(E_ALL);
ini_set("display_errors", 1);

// include the code for connecting to the database
include_once "includes/database-connect.php";

// the heading to show at the top of the page
$site_heading = "Blog <i class=\"fa fa-rss\" aria-hidden=\"true\"></i> Crunch";

// show the header view
include_once "views/header.php";

// include the model for user sessions
include_once "models/UserSession.php";

// create a new user session object
$user_session = new UserSession();

// include the controller for showing the blog
include_once "controllers/blog.php";

// if user clicked log out then log them out
if (isset($_POST['logout'])) {
    $user_session->logout();
}

// if the user is logged in then show the option to log out
if ($user_session->isLoggedIn()) {
    $redirect = "index.php";
    include_once "views/logout-form-html.php";
}

// show the footer view
include_once "views/footer.php";