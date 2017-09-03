<ul>
    <?php
    $output = "";
    // while we have entries in our list of entries keep appending them
    while ($entry = $all_entries->fetchObject()) {
        $link = "admin.php?page=editor&amp;id=$entry->id";
        $output .= "<li class='entry-listing'><a href='$link'>$entry->entry_title</a><br>
                        <em>Date posted:</em> $entry->entry_date<br>
                        $entry->intro
                    </li>";
    }
    echo $output;
    ?>
</ul>