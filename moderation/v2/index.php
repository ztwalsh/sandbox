<!doctype html>
<html lang="en">
  <head>
      <title>Moderation</title>
      <link href="css/styles.css" type="text/css" rel="stylesheet" />
      <script src="https://use.fontawesome.com/a29610890b.js"></script>
      <script src="js/jquery.js"></script>
      <script src="js/behaviors.js"></script>
  </head>
  <body>

    <nav>
      <div class="logo"><img src="images/logo.svg" /></div>
      <a href="#">Find a Review</a>
      <a href="#">Leaderboard</a>
      <a href="#">Logout</a>
    </nav>

    <header class="tools cf">
      <section class="counter left cf">
        <div class="count-label">Today's Count</div><div class="count-number">0</div>
      </section>
      <section class="call-to-action right">
        <a class="btn primary next-btn right">No Comment, Next</a>
      </section>
    </header>

    <?php include('includes/include.card.php'); ?>
    <?php include('includes/include.card.php'); ?>
    <?php include('includes/include.card.php'); ?>
    <?php include('includes/include.card.php'); ?>

  </body>
</html>
