<?php
include_once "models/CommentsTable.php";

// create a new comments table object
$comments_table = new CommentsTable($connection);

// check if a comment was submitted and then save if so
if (isset($_POST['post-comment'])) {
    $comments_table->saveComment($_GET['id'], $_SESSION['user_id'], $_POST['comment']);
}

// get the list of all existing comments
$all_comments = $comments_table->getAllComments($_GET['id']);

// include the view of the list of comments
include_once "views/comments-html.php";

// include the controller for handling user login
include_once "controllers/user-login.php";

// if the user is logged in then show the comment entry box
if ($user_session->isLoggedIn()) {
    include_once "views/comment-form-html.php";
}