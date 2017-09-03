<?php
include_once "models/BlogEntryTable.php";

// create a new blog entry table object
$entry_table = new BlogEntryTable($connection);

// check if there was a request for a particular entry post
if (isset($_GET["id"])) {
    $entry_data = $entry_table->getEntry($_GET["id"]);

    // if we have a result back for the entry
    if (isset($entry_data)) {
        // include the view for the entry content
        include_once "views/entry-html.php";
        // include the controller for the comments section
        include_once "controllers/comments.php";
    }
}
// otherwise show a list of posts
else {
    include_once "views/search-form-html.php";
    // if the user searched for something get the search results
    if (isset($_GET['q'])) {
        // get any entries matching the search query
        $all_entries = $entry_table->getSearchEntries($_GET['q']);
        // include the view for the search results
        include_once "views/search-results-html.php";
    }
    // if the user clicked on an author name to show their posts
    elseif (isset($_GET['author'])) {
        // get any entries by the requested author
        $all_entries = $entry_table->getNamedEntries($_GET['author']);
        // include the view for the results
        include_once "views/author-results-html.php";
    }
    else {
        // get all of the entries that are in the database
        $all_entries = $entry_table->getAllEntries();
        // include the view for the blog content
        include_once "views/blog-html.php";
    }
}