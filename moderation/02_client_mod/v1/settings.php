<?php include('lib/functions.php'); ?>
<?php $subpage = 'settings'; ?>
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
          <h4>Stances</h4>
        </header>
        <div class="cf">
          <div class="col-2">
            <div class="channels">
              <img src="images/portal-channel.svg" />
              <h4>Site Publish Stance</h4>
              <a class="btn-primary" href="images/edit-stance.jpg">Configure</a>
            </div>
          </div>
          <div class="col-2">
          </div>
          <div class="col-2">
          </div>
        </div>
      </div>
      <div class="contents">
        <header>
          <h4>Channels</h4>
        </header>
        <div class="cf">
          <div class="col-2">
            <div class="channels">
              <img src="images/portal-channel.svg" />
              <h4>Reviews Under 2 Stars</h4>
              <a class="btn-primary" href="moderate.php">Configure</a>
            </div>
          </div>
          <div class="col-2">
            <div class="channels">
              <img src="images/portal-channel.svg" />
              <h4>Service Issue Reviews</h4>
              <a class="btn-primary" href="">Configure</a>
            </div>
          </div>
          <div class="col-2">
            <div class="channels">
              <img src="images/portal-channel.svg" />
              <h4>Reviews with Images/Videos</h4>
              <a class="btn-primary" href="">Configure</a>
            </div>
          </div>
          <div class="col-2">
            <div class="channels add">
              <img src="images/portal-channel.svg" /><br /><br />
              <a class="btn-primary" href="images/add-channel.jpg">Add a New Channel</a>
            </div>
          </div>
        </div>
    </section>
  </body>
</html>
