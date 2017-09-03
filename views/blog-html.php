<?php
$output = "";
// while we have entries in our list of entries keep appending them
while ($entry = $all_entries->fetchObject()) {
    $link = "index.php?page=blog&amp;id=$entry->id";
    $output .= "<div class='entry-listing container-fluid'>
                    <div class='col-xs-4 col-md-3'>
                        <img class='post-thumb' src='$entry->image_url' width='100%'>
                    </div>
                    <div class='col-xs-8 col-md-9'>
                        <h2><a href='$link'>$entry->entry_title</a></h2>
                        <p><strong>By: <a href='index.php?page=results&author=$entry->username'>$entry->username</a></strong></p>
                        <p><em>Date posted:</em> $entry->entry_date</p>
                        <p>$entry->intro <a href='$link'>Read more</a></p>
                    </div>
                </div>";
}
echo $output;
?>