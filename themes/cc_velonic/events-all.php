<?php
	require('lib/config.php');
	check_login();
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
                    <h2>
											Events
											<div class="pull-right"><a href="events-add.php" class="btn btn-primary btn-lg m-b-5"><i class="fa fa-plus-circle"></i> Add Event</a></div>
										</h2>
                </div>

                <div class="row">
                  <div class="col-lg-12">
									  <div class="portlet">
											<div class="portlet-body">
                        <?php display_events($_SESSION['member_id'], $_SESSION['boat_id'], ''); ?>
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

				<script src="js/jquery.app.js"></script>

        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>

				<script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable({
								  "order": [1, 'desc'],
									"searching": false,
									"lengthChange": false
								});
            });
        </script>

    </body>
</html>
