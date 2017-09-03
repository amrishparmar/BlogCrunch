<p class="success bg-success"><?php echo $success_message; ?></p>
<p class="error bg-danger"><?php echo $error_message; ?></p>
<form method="post" action="admin.php?page=editor" id="editor" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $entry_data->id; ?>" id="id">
    <fieldset>
        <legend>Blog entry editor</legend>
        <label for="image-to-upload">Upload an image</label><br>
        <input type="file" name="imageToUpload" id="imageToUpload">
        <label for="entry-title">Title</label><br>
        <input type="text" maxlength="150" name="entry-title" value="<?php echo $entry_data->entry_title; ?>" id="entry-title" required><br>
        <label for="entry-text">Content</label><br>
        <textarea name="entry-text" id="entry-text"><?php echo $entry_data->entry_text; ?></textarea><br>
        <button class="btn btn-primary" type="submit" name="action" value="save"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
    </fieldset>
    <fieldset>
        <legend>Other actions</legend>
        <button class="btn btn-primary" type="submit" name="action" value="delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete this post</button>
    </fieldset>
</form>