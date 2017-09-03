<?php
include_once "models/BlogEntryTable.php";
include_once "includes/file-upload.php";

// instantiate a new blog entry table object
$entry_table = new BlogEntryTable($connection);

// the user message will blank unless some action has occurred
$success_message = "";
$error_message = "";

// check if any action button was clicked
if (isset($_POST['action'])) {
    // check if the save button was clicked
    if ($_POST['action'] === "save") {
        // the id will be 0 if it is a new entry
        if ($_POST['id'] == 0) {
            try {
                $img_result = upload_image("images/uploads/");
                // call the saveEntry() method to save the entry to the database and get back the id
                $entry_table->saveEntry($_POST['entry-title'], $_POST['entry-text'], $_SESSION['user_id'], $img_result);
                $success_message = "Entry \"".$_POST['entry-title']."\" has been successfully saved.";
            }
            // if the upload failed set the error message to that returned by the exception
            catch (Exception $e) {
                $error_message = $e->getMessage();
            }
        }
        // if not 0 then we are updating an existing one
        else {
            // call the updateEntry() method since we have a non 0 id
            // if the user edited the image
            if (is_uploaded_file($_FILES['imageToUpload']['tmp_name'])) {
                try {
                    $img_result = upload_image("images/uploads/");
                    // update the entry text and image
                    $entry_table->updateEntry($_POST['id'], $_POST['entry-title'], $_POST['entry-text'], $img_result);
                    $success_message = "Entry \"".$_POST['entry-title']."\" has been successfully updated.";
                }
                catch (Exception $e) {
                    $error_message = $e->getMessage();
                }
            }
            // otherwise just update the text
            else {
                $entry_table->updateEntry($_POST['id'], $_POST['entry-title'], $_POST['entry-text']);
                $success_message = "Entry \"".$_POST['entry-title']."\" has been successfully updated.";
            }
        }
    }
    // check if the delete button was clicked
    elseif ($_POST['action'] === "delete") {
        $entry_table->deleteEntry($_POST['id']);
        $success_message = "Entry \"".$_POST['entry-title']."\" has been deleted.";
    }
}

// if there is an id set then we want to grab the existing information about that entry
if (isset($_GET['id'])) {
    $entry_data = $entry_table->getEntry($_GET['id']);
}
// otherwise set some initial blank values
else {
    $entry_data = new stdClass();
    $entry_data->id = 0;
    $entry_data->entry_title = "";
    $entry_data->entry_text = "";
}

// include the view for the actual html content
include_once "views/admin/editor-html.php";