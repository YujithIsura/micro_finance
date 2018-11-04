<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Micro Finance  | MFS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/daterangepicker.css'); ?>" type="text/css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/Ionicons/css/ionicons.min.css'); ?>" type="text/css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">
  <link href="<?php echo base_url('assets/css/AdminLTE.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins/datatables/css/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/plugins2/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url('assets/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/flat-green.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url('assets/css/checkbox3.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- jQuery  -->
  <script src="<?php echo base_url('assets/plugins/jquery/dist/jquery.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/jquery.multicolselect.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/accounting.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/js/moment.js'); ?>" type="text/javascript"></script>
  
  <link href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url('assets/plugins/select2/dist/js/select2.full.min.js'); ?>" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins2/iCheck/all.css');?>" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url('assets/plugins/datatables2/js/jquery.dataTables.min.css'); ?>" type="text/css"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
       /*.sidebar-menu li a:hover, .sidebar-menu li.active{*/
            .sidebar-menu li a:hover, .sidebar-menu li a.selected{
                background-color: #96C11F;
                color: #fff;
                -moz-transition: background-color 0.01s;
                -webkit-transition: background-color 0.01s;
                -o-transition: background-color 0.01s;
                transition: background-color 0.01s;
            }
            li a{
/*                display: block;
                color: #969E8D;
                width: 196px;
                padding: 3px 4px;
                margin: 5px 13px;
                border-bottom: 1px dotted #96BF1F;*/


                -moz-transition: background-color .3s ease-in;
                -webkit-transition: background-color .3s ease-in;
                -o-transition: background-color .3s ease-in;
                transition: background-color .3s ease-in;
            }
            
            
         
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
   
    <a href="../../index2.html" class="logo" style="background: #000033;background: linear-gradient(90deg, #003300, #00ff00);">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>FS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Micro</b>FINANCE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  style="background: #000033;background: linear-gradient(-90deg, #003300, #00ff00);">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url('assets/img/logo/prasath2.jpg')?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/img/user2-160x160.jpg')?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header"  style="background: #000033;background: linear-gradient(-90deg, #003300, #00ff00);">
                <img src="<?php echo base_url('assets/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('Welcome/logout'); ?>" class="btn btn-info bg-olive- progress-bar-striped " style="background-color: #00c0ef;" ><i class="fa fa-sign-out fa-fw fa-2x-"></i>
                                                Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->