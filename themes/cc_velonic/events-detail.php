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
        <?php require_once('lib/include.navigation-sidebar.php'); ?>
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
                    <h3 class="title">All Events</h3><a href="events-add.php" class="btn btn-primary m-b-5">Add Event</a>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#home" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">View Crew</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#profile" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                <span class="hidden-xs">View Sails</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div>
                                <?php display_events($_SESSION['member_id'], $_SESSION['boat_id'], ''); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="profile">
                          <div>
                              <?php display_events($_SESSION['member_id'], $_SESSION['boat_id'], 'past-all'); ?>
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
                $('.datatable').dataTable();
            } );
        </script>
    </body>
</html>
