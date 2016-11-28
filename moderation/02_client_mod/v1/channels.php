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
          <h4><a href="#">Content</a> / My Channels</h4>
        </header>
        <div class="cf">
          <div class="col-2">
            <div class="channels">
              <span class="count">14 Reviews</span>
              <img src="images/portal-channel.svg" />
              <h4>Reviews Under 2 Stars</h4>
              <a class="btn-primary" href="moderate.php">Moderate</a>
            </div>
          </div>
          <div class="col-2">
            <div class="channels">
              <span class="count">23 Reviews</span>
              <img src="images/portal-channel.svg" />
              <h4>Service Issues Reviews</h4>
              <a class="btn-primary" href="">Moderate</a>
            </div>
          </div>
          <div class="col-2">
            <div class="channels">
              <span class="count">3 Reviews</span>
              <img src="images/portal-channel.svg" />
              <h4>Reviews with Images/Videos</h4>
              <a class="btn-primary" href="">Moderate</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
