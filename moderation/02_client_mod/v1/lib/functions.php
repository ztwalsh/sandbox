<?php
  $clientname = 'Timberland';
  $datapath = 'json/timberland.json';

  function status_icon($status) {
    if ($status == 'published') {
      echo '<span class="status pub"></span>';
    } elseif ($status == 'unpublished') {
      echo '<span class="status unpub"></span>';
    } else {
      echo '<span class="status pend"></span>';
    }
  }

?>

<?php
  function display_content($filepath, $type = 'moderation') {
    $json = str_replace('&quot;', '"', file_get_contents($filepath));
    $json = json_decode($json, true);
    $content_count = 1;
    foreach ($json as $ugc) {
?>

  <article class="card cf">
    <span class="attributes">
      <span class="rating" data="<?php echo $ugc[ugc][rating]; ?>"></span>
      <span class="category" data="<?php echo $ugc[ugc][rating]; ?>"></span>
      <span class="brand" data="<?php echo $ugc[ugc][rating]; ?>"></span>
      <span class="rating" data="<?php echo $ugc[ugc][rating]; ?>"></span>
    </span>
    <div class="content">
      <div class="content-product">
        <div class="product-top">
          <div class="product-image">
            <?php if ($ugc[subject][product_image_url]) { echo '<img src="'.$ugc[subject][product_image_url].'" />';} else { echo '<img src="images/no-image.jpg" />';} ?>
          </div>
          <div class="product-title cf truncate">
            <?php if ($ugc[subject][product_url]) { echo '<h3><a href="'.$ugc[subject][product_url].'" target="_blank">'.$ugc[subject][name].'</a></h3>';} else { echo '<h3>'.$ugc[subject][brand_name].' '.$ugc[subject][name].'</h3>';} ?>
            <?php if ($ugc[subject][brand_name]) { echo '<div class="product-details"><strong>Brand:</strong> '.$ugc[subject][brand_name].'</div>';} ?>
            <?php if ($ugc[subject][category_name]) { echo '<div class="product-details"><strong>Category:</strong> '.$ugc[subject][category_name].'</div>';} ?>
          </div>
          <div class="product-expand">
            <a href="#" class="product-more btn-reveal">Product Info <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
          </div>
        </div>
        <div class="product-bottom">
          <h5><?php echo $ugc[subject][name]; ?></h5>
          <p><?php echo $ugc[subject][description]; ?></p>
          <table width="100%">
            <tr>
              <td width="25%"><h5>Page ID</h5></td>
              <td width="5%"></td>
              <td width="70%"><?php echo $ugc[subject][page_id]; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="content-ugc">
        <div class="rating">
          <?php
            $count = 1;
            while($count <= 5) {
              echo '<div class="star';
              if($ugc[ugc][rating] < $count) {
                echo '-off';
              }
              echo '"><i class="fa fa-star" aria-hidden="true"></i></div>';
              $count++;
            }
          ?>
          <div class="numeric"><?php echo $ugc[ugc][rating];?>.0</div>
        </div>

        <h3><mark><?php echo $ugc[ugc][review_headline];?></mark></h3>
        <p class="small">Submitted on <mark><?php echo date('m/d/Y', strtotime($ugc[ugc][created_date]));?></mark> by <mark><?php echo $ugc[ugc][author];?></mark> from <mark><?php echo $ugc[ugc][location];?></mark></p>
        <p><mark><?php echo $ugc[ugc][review_comments];?></mark></p>
        <table width="100%">
          <?php
            if($ugc[ugc][email]) {
              echo '<tr><td width="25%"><h5>Email</h5></td><td width="5%"></td><td width="70%"><mark>'.$ugc[ugc][email].'</mark></td></tr>';
            }
            if($ugc[ugc][reviewer_type]) {
              echo '<tr><td width="25%"><h5>Reviewer Type</h5></td><td width="5%"></td><td width="70%">'.$ugc[ugc][reviewer_type].'</td></tr>';
            }
          ?>
        </table>
        <a href="#" class="ugc-more btn-reveal">Meta Info <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
        <div class="content-meta">
          <table width="100%">
            <tr>
              <td width="25%"><h5>Review ID</h5></td>
              <td width="5%"></td>
              <td width="70%"><?php echo $ugc[ugc][ugc_id];?></td>
            </tr>
            <?php
              if($ugc[ugc][shared_review_id]) {
                echo '<tr><td width="25%"><h5>Shared Review ID</h5></td><td width="5%"></td><td width="70%">'.$ugc[ugc][shared_review_id].'</td></tr>';
              }
            ?>
          </table>
        </div>
      </div>
      <div class="content-response">
        <textarea placeholder="Add a Response"></textarea>
      </div>
    </div>
    <div class="actions">
      <div class="actions-wrapper">
        <div class="actions-publishing">
          <p>
            <label><?php status_icon($ugc[ugc][site_status]); ?>Site Status</label>
            <?php
              if($type == "moderation") {
                echo '<select data="btn-'.$content_count.'">';
              } else {
                echo '<select state="btn-'.$content_count.'">';
              }
            ?>
              <?php if ($ugc[ugc][site_status] == 'published') { echo ' selected="selected"'; } ?>
              <option<?php if ($ugc[ugc][site_status] == 'published') { echo ' selected="selected"'; } ?>>Published</option>
              <option<?php if ($ugc[ugc][site_status] == 'unpublished') { echo ' selected="selected"'; } ?>>Unpublished</option>
            </select>
          </p>
          <?php
            if ($ugc[ugc][network_status]) {
          ?>
          <p>
            <label><span class="status unpub"></span>Network Status</label>
            <select>
              <option>Published</option>
              <option selected="selected">Unpublished</option>
            </select>
          </p>
          <?php } ?>
          <p>
            <label>Observations</label>
            <select>
              <option selected="selected">None</option>
              <option>Safety Alert</option>
              <option>Profanity</option>
              <option>Pricing</option>
              <option>Competitors</option>
            </select>
          </p>
          <p>
            <textarea placeholder="Add notes..."></textarea>
          </p>
          <p>
            <?php
              if($type == "moderation") {
                echo '<a class="actions-btn save" id="btn-'.$content_count.'" href="#">Dismiss</a>';
              } else {
                echo '<a class="actions-btn save disabled" href="#" id="btn-'.$content_count.'">Save</a>';
              }
            ?>
          </p>
        </div>
        <div class="actions-tools">
          <p><a class="tools-btn" href="#">Forward this Review</a></p>
          <p><a class="tools-btn" href="#">See Activity History</a></p>
          <p><a class="tools-btn" href="#">Request an Update</a></p>
        </div>
      </div>
    </div>
  </article>

<?php
      $content_count++;
    }
  }
?>
