<?php
// show all error messages
error_reporting(E_ALL);
ini_set("display_errors", 1);

// include the code for connecting to the database
include_once "includes/database-connect.php";

// the heading to show at the top of the page
$site_heading = "Blog <i class=\"fa fa-rss\" aria-hidden=\"true\"></i> Crunch (Admin Area)";

// show the header view
include_once "views/header.php";

// include the model for user sessions
include_once "models/UserSession.php";

// if it does not already exist (i.e. the user has visited the main site in the current session)
if (!isset($user_session)) {
    $user_session = new UserSession();
}

// include the login controller
include_once "controllers/admin/login.php";

// if an admin user is logged in
if ($user_session->isAdminLoggedIn()) {
    // show the admin navigation section
    include_once "views/admin/admin-navigation.php";

    // if the page id is set
    if (isset($_GET['page'])) {
        // prepare to load the corresponding controller
        $contrl = $_GET['page'];
    }
    else {
        // or prepare to load the default controller
        $contrl = "entries";
    }

    // show the correct view
    include_once "controllers/admin/$contrl.php";

    // the page to redirect the user upon logging out
    $redirect = "admin.php";

    // show the logout form view
    include_once "views/logout-form-html.php";
}

// show the footer view
include_once "views/footer.php";