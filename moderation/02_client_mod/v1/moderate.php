<?php include('lib/functions.php'); ?>
<?php $subpage = 'channels'; ?>
<!doctype html>
<html lang="en">
  <head>
      <title>Moderation</title>
      <link href="css/styles.css" type="text/css" rel="stylesheet" media="screen" />
      <script src="https://use.fontawesome.com/a29610890b.js"></script>
      <script src="js/jquery.js"></script>
      <script src="js/behaviors.js"></script>
  </head>
  <body>
    <?php include('lib/include.nav.php'); ?>
    <section>
      <div class="contents">
        <header>
          <h4><a href="channels.php">Content</a> / <a href="channels.php">My Channels</a> / Reviews Under 2 Stars</h4>
        </header>

        <div class="filters">
          <a href="#" class="btn-secondary add-filters">Add Filters</a>
          <div class="panel">
            <table width="100%">
              <tr>
                <td width="47.5%">
                  <p><label for="rating">Rating</label>
                  <select id="rating">
                    <option selected="selected">All Ratings</option>
                    <option>1 Star</option>
                    <option>2 Stars</option>
                    <option>3 Stars</option>
                    <option>4 Stars</option>
                    <option>5 Stars</option>
                  </select></p>

                  <p><label for="source">Source</label>
                  <select id="source">
                    <option selected="selected">All Sources</option>
                    <option>Native</option>
                    <option>Syndication Network</option>
                  </select></p>

                  <p><label for="pubstatus">Publish Status</label>
                  <select id="pubstatus">
                    <option>All Statuses</option>
                    <option selected="selected">Published</option>
                    <option>Unpublished</option>
                    <option>Unmoderated</option>
                  </select></p>

                  <p><label for="reviewertype">Reviewer Type</label>
                  <select id="reviewertype">
                    <option selected="selected">All Reviewers</option>
                    <option>Verified Buyers</option>
                    <option>Verified Reviewers</option>
                    <option>Annonymous</option>
                  </select></p>
                </td>
                <td width="5%"></td>
                <td width="47.5%">
                  <p><label for="productname">Product Name</label>
                  <input type="text" placeholder="Add a Product Name..." id="productname" /></p>

                  <p><label for="productid">Product ID</label>
                  <input type="text" placeholder="Add a Product ID" id="productid" /></p>

                  <p><label for="category">Category</label>
                  <select id="category">
                    <option selected="selected">All Categories</option>
                    <option>Category 1</option>
                    <option>Category 2</option>
                    <option>Category 3</option>
                    <option>Category 4</option>
                    <option>Category 5</option>
                  </select></p>

                  <p><label for="brand">Brand</label>
                  <select id="brand">
                    <option selected="selected">All Brands</option>
                    <option>Brand 1</option>
                    <option>Brand 2</option>
                    <option>Brand 3</option>
                    <option>Brand 4</option>
                    <option>Brand 5</option>
                  </select></p>
                </td>
              </tr>
              <tr>
                <td colspan="3">
                  <a class="btn-filter" href="#">Apply</a>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <!--START INDV CARD-->
        <div id="list">
        <?php //display_content($datapath); ?>
        <?php include('lib/include.timbmoderation.php'); ?>
        </div>
        <!--END INDV CARD-->
      </div>




    </section>
  </body>
</html>
