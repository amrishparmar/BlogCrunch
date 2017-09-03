<p><a href="index.php"><i class="fa fa-chevron-circle-left" aria-hidden="false"></i> Back to Blog</a></p>
<article>
  <h2><?php echo $entry_data->entry_title; ?></h2>
  <p><strong>By: <a href='index.php?page=results&author=<?php echo $entry_data->username; ?>'><?php echo $entry_data->username; ?></a></strong></p>
  <p><em>Date posted: <?php echo $entry_data->entry_date; ?></em></p>
  <div class="container-fluid no-padding post-image">
    <div class="col-xs-12 col-sm-6 col-lg-4 no-padding">
      <img src="<?php echo $entry_data->image_url; ?>" width="100%">
    </div>
  </div>
  <p><?php echo $entry_data->entry_text; ?></p>
</article>
<hr>
<h3>Comments</h3>