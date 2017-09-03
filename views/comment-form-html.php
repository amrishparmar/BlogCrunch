<form method="post" action="index.php?page=blog&id=<?php echo $_GET['id']?>">
    <fieldset>
        <legend>Post a comment</legend>
        <textarea name="comment" title="comment" required></textarea><br>
        <button class="btn btn-primary" type="submit" name="post-comment" value="post-comment"><i class="fa fa-comment" aria-hidden="true"></i> Post comment</button>
    </fieldset>
</form>