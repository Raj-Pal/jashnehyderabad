
<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.5/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2016 09:53:03 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Jashn Hyderabad | Dashboard</title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/logo.png">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?php echo base_url(); ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/chosen.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		//google.charts.load('current', {'packages':['bar','corechart']});
		google.charts.load('current', {'packages': ['corechart', 'bar', 'calendar']});
	</script>
	
	<style>
	.chzn-container-multi .chzn-choices .search-field .default{
		height:30px !important;
	}
	</style>
	<style>
	.nav > li.<?php echo $content; ?> {
		border-left: 4px solid #19aa8d;
		background: #293846;
		position: relative;
		display: block;
		list-style: none;
	}
	.nav > li.<?php echo $content; ?> > a {
		color:white !important;
	}
	#page-wrapper{
		min-height:100% important;
	}
	</style>
	

</head>

<body class="fixed-sidebar no-skin-config full-height-layout">
  <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" width="50px" class="img-circle" src="<?php echo base_url(); ?>assets/img/a4.jpg"/>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->userdata('userName'); ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $this->session->userdata('email'); ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                               <li><a href="<?php echo base_url(); ?>index.php/home/logout">Logout</a></li>
							   
                            </ul>
                        </div>
                        <div class="logo-element">
                           Jashne App
                        </div>
                    </li>
                    <li class="dashboard">
                        <a href="<?php echo base_url(); ?>index.php/home/dashboard"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
					
					<li class="notification">
                        <a href="<?php echo base_url(); ?>index.php/home/notification"><i class="fa fa-user"></i> <span class="nav-label">Notification</span></a>
                    </li>
					
					<!--<li class="flightNotification">
                        <a href="<?php echo base_url(); ?>index.php/home/flightNotification"><i class="fa fa-user"></i> <span class="nav-label">Flight Notification</span></a>
                    </li>-->
					
					<li class="user">
                        <a href="<?php echo base_url(); ?>index.php/home/user"><i class="fa fa-user"></i> <span class="nav-label">User</span></a>
                    </li>
					
					<li class="chatView">
                        <a href="<?php echo base_url(); ?>index.php/home/chatView"><i class="fa fa-user"></i> <span class="nav-label">Feedback Panel</span></a>
                    </li>
					
					<li class="smsModuleAuto">
                        <a href="<?php echo base_url(); ?>index.php/home/smsModuleAuto"><i class="fa fa-user"></i> <span class="nav-label">SMS</span></a>
                    </li>
					
					
				</ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg" style="min-height:100%;height:auto;">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           <!-- <form role="search" class="navbar-form-custom" action="http://webapplayers.com/inspinia_admin-v2.5/search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>-->
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"> Welcome to the Jashne App Admin Panel</span>
                </li>
              <!--  <li class="dropdown">
			
					<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">5</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
				
                   
                </li> -->
               <!-- <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li> -->


                <li>
                    <a href="<?php echo base_url(); ?>index.php/home/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            <!--    <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>-->
            </ul>

        </nav>
        </div>
