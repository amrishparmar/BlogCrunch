<?php
include_once "models/BlogEntryTable.php";

// create a new blog entry table object
$entry_table = new BlogEntryTable($connection);

// get all of the entries that are in the database
$all_entries = $entry_table->getAllEntries();

// include the view for the actual html content
include_once "views/admin/entries-html.php";