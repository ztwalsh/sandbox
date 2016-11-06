<?php
	require('lib/config.php');
	check_login();
  $submission = add_event($_SESSION['boat_id']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Events | CrewConnect</title>
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <?php require_once('lib/include.head.php'); ?>
        <!-- DataTables -->
    </head>

    <body>
        <!-- Aside Start-->
				<?php
					$section = 'events';
					require_once('lib/include.navigation-sidebar.php');
				?>
        <!-- Aside Ends-->

        <!--Main Content Start -->
        <section class="content">
            <!-- Header -->
            <?php require_once('lib/include.navigation-header.php'); ?>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title">
                    <h2><a href="events-all.php">Events</a> // Add an Event</h2>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="panel">
                      <?php display_error_alert($submission); ?>
            					<form action="events-add.php" id="form" method="post">
            						<p><label class="main" for="lastname">Name</label><br />
            						<?php display_error('name', 'Enter an event name'); ?>
            						<?php form_input('name', '', 'name', '', 'large', 'text'); ?></p>

            						<p><label class="main" for="type">What type of event is this?</label><br />
            						<?php display_error('type', 'Select an event type'); ?>
            						<?php form_event_type(); ?></p>

            						<p><label class="main" for="edate">When does the event start</label><br />
            						<?php display_error('edate', 'Enter the event start date'); ?>
            						<?php form_input('edate', '', 'edate', '', 'datepicker', 'text'); ?></p>

            						<p><label class="main" for="etime">And at what time?</label><br />
            						<?php form_input('hour', '8', 'hour', '', 'short', 'tel'); ?> : <?php form_input('minute', '00', 'minute', '', 'short', 'tel'); ?> <?php form_am_pm(); ?></p>

            						<p><label class="main" for="edate_end">When does the event end? <small>(Optional)</small></label><br />
            						<?php form_input('edate_end', '', 'edate_end', '', 'datepicker', 'text'); ?></p>

            						<p><label class="main" for="location">Where is the event?</label><br />
            						<?php display_error('location', 'Enter the race start location'); ?>
            						<?php form_input('location', '', 'location', '', 'location', 'text'); ?></p>

            						<p><label class="main" for="description">Any additional comments</label><br />
            						<?php form_textarea('description', '', ''); ?></p>

            						<p><?php primary_submit('Add event'); ?></p>
            					</form>
                    </div>
                  </div> <!-- end col -->
                </div> <!-- End row -->


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <?php require_once('lib/include.footer.php'); ?>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        <?php require_once('lib/include.scripts.php'); ?>
        <script src="assets/timepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
          jQuery(document).ready(function() {
              jQuery('.datepicker').datepicker();
          });
        </script>
    </body>
</html>
