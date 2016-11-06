<?php
	require('lib/config.php');
	check_login();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard | CrewConnect</title>
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <?php require_once('lib/include.head.php'); ?>
    </head>

    <body>
        <!-- Aside Start-->
				<?php
					$section = 'dashboard';
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
                    <h3 class="title">Welcome to Painkiller4</h3>
                </div>

                <div class="row">
                    <a href="#">
                      <div class="col-lg-4 col-sm-6">
                          <div class="widget-panel widget-style-2 bg-cc-blue">
                              <i class="ion-ios7-calendar"></i>
                              <h2 class="m-0 counter">15</h2>
                              <div>Upcoming Events</div>
                          </div>
                      </div>
                    </a>
                    <a href="#">
                      <div class="col-lg-4 col-sm-6">
                          <div class="widget-panel widget-style-2 bg-cc-blue">
                              <i class="ion-person"></i>
                              <h2 class="m-0 counter">25</h2>
                              <div>Boat Members</div>
                          </div>
                      </div>
                    </a>
                    <a href="#">
                      <div class="col-lg-4 col-sm-6">
                          <div class="widget-panel widget-style-2 bg-cc-blue">
                              <i class="ion-checkmark-round"></i>
                              <h2 class="m-0 counter">21</h2>
                              <div>Open To-do Items</div>
                          </div>
                      </div>
                    </a>
                </div> <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                      <!-- Chat -->
                      <div class="portlet"><!-- /primary heading -->
                          <div class="portlet-heading">
                              <h3 class="portlet-title text-dark text-uppercase">
                                  Chat Wall
                              </h3>
                              <div class="portlet-widgets">
                                  <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                  <span class="divider"></span>
                                  <a data-toggle="collapse" data-parent="#accordion1" href="#portlet-3"><i class="ion-minus-round"></i></a>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          <div id="portlet-3" class="panel-collapse collapse in">
                              <div class="portlet-body">
                                  <div class="row">
                                      <div class="col-xs-9 chat-inputbar">
                                          <input type="text" class="form-control chat-input" placeholder="Enter your text">
                                      </div>
                                      <div class="col-xs-3 chat-send">
                                          <button type="submit" class="btn btn-info">Send</button>
                                      </div>
                                  </div>
                                  <div class="chat-conversation">
                                      <ul class="conversation-list nicescroll">
                                          <li class="clearfix">
                                              <div class="chat-avatar">
                                                  <img src="img/avatar-2.jpg" alt="male">
                                                  <i>10:00</i>
                                              </div>
                                              <div class="conversation-text">
                                                  <div class="ctext-wrap">
                                                      <i>John Deo</i>
                                                      <p>
                                                          Hello!
                                                      </p>
                                                  </div>
                                              </div>
                                          </li>
                                          <li class="clearfix">
                                              <div class="chat-avatar">
                                                  <img src="img/avatar-3.jpg" alt="Female">
                                                  <i>10:01</i>
                                              </div>
                                              <div class="conversation-text">
                                                  <div class="ctext-wrap">
                                                      <i>Smith</i>
                                                      <p>
                                                          Hi, How are you? What about our next meeting?
                                                      </p>
                                                  </div>
                                              </div>
                                          </li>
                                          <li class="clearfix">
                                              <div class="chat-avatar">
                                                  <img src="img/avatar-2.jpg" alt="male">
                                                  <i>10:01</i>
                                              </div>
                                              <div class="conversation-text">
                                                  <div class="ctext-wrap">
                                                      <i>John Deo</i>
                                                      <p>
                                                          Yeah everything is fine
                                                      </p>
                                                  </div>
                                              </div>
                                          </li>
                                          <li class="clearfix">
                                              <div class="chat-avatar">
                                                  <img src="img/avatar-3.jpg" alt="male">
                                                  <i>10:02</i>
                                              </div>
                                              <div class="conversation-text">
                                                  <div class="ctext-wrap">
                                                      <i>Smith</i>
                                                      <p>
                                                          Wow that's great
                                                      </p>
                                                  </div>
                                              </div>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div> <!-- end Chat -->
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
    </body>
</html>
