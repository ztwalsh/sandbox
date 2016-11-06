<?php
	require('lib/config.php');
	check_login();
	$event = display_event_detail($_GET['event_id']);
	check_item_for_boat($event['bid'], $_SESSION['boat_id']);
	add_remove_event_members();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Events | CrewConnect</title>
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <?php require_once('lib/include.head.php'); ?>
        <!-- DataTables -->
        <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
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
                    <h2><a href="events-all.php">Events</a> // <?php echo $event['name']; ?></h2>
										<span class="meta"><i class="ion-calendar"></i> <?php echo date('M d, Y', $event['edate']);
											if (isset($event['edate_end'])) {
												echo '&ndash;'.date('M d, Y', $event['edate_end']);
											}
										?></span>
										<span class="meta"><i class="ion-location"></i> <?php echo $event['location']; ?></span>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#home" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Crew Members</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#profile" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">Sails</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div>
															<?php display_available_event_members($event['id'], $_SESSION['boat_id']); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                          <div>
                          </div>
                        </div>
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

        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $('#member-datatable').dataTable( {
								  "columns": [
								    null,
								    null,
								    null,
								    { "orderable": false }
								  ],
									"searching": false,
									"lengthChange": false
								});
            } );
        </script>
    </body>
</html>
