<nav id="left">
  <ul>
    <li><a href="index.php" class="home"><img src="images/logo.svg" /></a></li>
    <li><a href="#">Analytics</a></li>
    <li><a class="on" href="channels.php">Content</a></li>
    <li><a href="#">Setup</a></li>
    <li><a href="#">Account</a></li>
  </ul>
</nav>
<nav id="left-sub">
  <ul>
    <li><a <?php if ($subpage == 'channels') { echo 'class="on" ';} ?>href="channels.php">My Channels</a></li>
    <li><a <?php if ($subpage == 'reviews') { echo 'class="on" ';} ?>href="reviews.php">Reviews</a></li>
    <li><a href="#">Images &amp; Videos</a></li>
    <li><a href="#">Settings</a></li>
  </ul>
</nav>
<nav id="top" class="cf">
  <div class="selector"><?php echo $clientname; ?></div>
  <div class="links">
    <ul class="cf">
      <li><a href="#">Zach Walsh</a></li>
      <li><a href="#">Support</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
</nav>
