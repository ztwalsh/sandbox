
  <aside class="left-panel">
      <div class="logo">
          <a href="index.html" class="logo-expanded">
              <img src="images/logo.png" alt="logo" height="auto" width="170">
          </a>
      </div>

      <nav class="navigation">
          <ul class="list-unstyled">
              <li <?php page_active($section, 'dashboard'); ?>><a href="<?php echo $root; ?>"><i class="ion-home"></i> <span class="nav-label">Dashboard</span></a></li>
              <li <?php page_active($section, 'events'); ?>><a href="<?php echo $root; ?>events-all.php"><i class="ion-ios7-calendar"></i> <span class="nav-label">Events</span></a></li>
              <li <?php page_active($section, 'members'); ?>><a href="<?php echo $root; ?>members-all.php"><i class="ion-person"></i> <span class="nav-label">Members</span></a></li>
              <li <?php page_active($section, 'sails'); ?>><a href="<?php echo $root; ?>sails-all.php"><i class="ion-ios7-analytics"></i> <span class="nav-label">Sails</span></a></li>
          </ul>
      </nav>
  </aside>
