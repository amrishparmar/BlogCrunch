<?php
$output = "";
// while we have entries in our list of entries keep appending them
while ($comment = $all_comments->fetchObject()) {
    $output .= "<div class='comment'>
                    <p>Author: $comment->username, <em>Date posted: $comment->date_posted</em></p>
                    <p>$comment->comment</p>
                </div>";
}
echo $output;