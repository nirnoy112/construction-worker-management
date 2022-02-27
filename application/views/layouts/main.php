<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>OHS</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap.min.css');?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/font-awesome.min.css');?>">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Datetimepicker -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datetimepicker.min.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-datepicker.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('resources/css/bootstrap-timepicker.min.css');?>">
        <!-- Select 2 -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/select2.min.css');?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('resources/css/sigpad/sigpad.css?v=' . time());?>">
        <link rel="stylesheet" href="<?php echo site_url('resources/css/styles.css');?>">


        <script src="<?php echo site_url('resources/js/sigpad/sigpad.js');?>"></script>
        
    </head>
    
    <body class="hold-transition skin-blue sidebar-mini">
        
        <p style="display: none;" id="ohs-u-id"><?= (isset($user_session['id']) && $user_session['id']) ? $user_session['id'] : 0; ?></p>
        <p style="display: none;" id="ohs-ur-id"><?= (isset($user_session['roleId']) && $user_session['roleId']) ? $user_session['roleId'] : 0; ?></p>
        <p style="display: none;" id="ohs-dst-collector"><?= (isset($user_session['dst_collector']) && $user_session['dst_collector']) ? $user_session['dst_collector'] : 0; ?></p>
        <p style="display: none;" id="ohs-clocked-in"><?= (isset($user_session['clocked_in']) && $user_session['clocked_in']) ? $user_session['clocked_in'] : 0; ?></p>
        <p style="display: none;" id="tc-time"><?= (isset($user_session['tc_time']) && $user_session['tc_time']) ? $user_session['tc_time'] : 0; ?></p>
        <p style="display: none;" id="tc-company"><?= (isset($user_session['tc_company']) && $user_session['tc_company']) ? $user_session['tc_company'] : 0; ?></p>
        <p style="display: none;" id="td-site"><?= (isset($user_session['tc_site']) && $user_session['tc_site']) ? $user_session['tc_site'] : ''; ?></p>
        <p style="display: none;" id="tc-company-id"><?= (isset($user_session['tc_company_id']) && $user_session['tc_company_id']) ? $user_session['tc_company_id'] : 0; ?></p>
        <p style="display: none;" id="td-site-id"><?= (isset($user_session['tc_site_id']) && $user_session['tc_site_id']) ? $user_session['tc_site_id'] : 0; ?></p>
        <p style="display: none;" id="ohs-breaked-in"><?= (isset($user_session['breaked_in']) && $user_session['breaked_in']) ? $user_session['breaked_in'] : 0; ?></p>

        <p style="display: none;" id="tc-url"><?= site_url('time_clock/registerEvent'); ?></p>
        <p style="display: none;" id="tc-out-url"><?= site_url('time_clock/index'); ?></p>
        
        <div class="wrapper">
            <header style="height: 70px;" class="main-header">
                <!-- Logo -->
                <a href="" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span style="color: #38247B;"  class="logo-mini"><img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="70" width="70">&nbsp;OHS TRAINING & CONSULTING, INC.</span>
                    <!-- logo for regular state and mobile devices -->
                    <span style="color: #38247B;" class="logo-lg"><img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="70" width="70">&nbsp;OHS TRAINING & CONSULTING, INC.</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav style="height: 70px;" class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a> -->

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                            <li style="padding-top:20px;" class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span><img src="<?php echo site_url('resources/img/user.jpg');?>" class="user-image" alt="User Image"></span>
                                    <span style="color: #38247B;" class="hidden-xs"><?php echo $user_session['username']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                       <img src="<?php echo site_url('resources/img/user_default.png');?>" class="img-circle" alt="User Image">

                                    <p style="color: #38247B;">
                                        <?php echo $user_session['realName']; ?>
                                    </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                        </div>
                                        <div class="pull-right">
                                            <a id="ohs-log-out-link" href="<?= ($user_session['clocked_in'] == 1) ? site_url('logout/clocked_in') : site_url('logout');?>" class="btn btn-info">LOG OUT</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo site_url('resources/img/user1.png');?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_session['realName']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <hr>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <!-- <li class="header">MAIN NAVIGATION</li> -->
                        <li>
                            <a href="<?php echo site_url('dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <?php

                            if($user_session['userType'] == 'ADMIN' || $user_session['userType'] == 'OHS_STAFF') {

                        ?>
                        <li>
                            <a href="<?php echo site_url('worker/add');?>">
                                <i class="fa fa-plus"></i> <span>Register New Worker</span>
                            </a>
                        </li>
                        <?php

                            }

                        ?>
                        <!-- <li>
                            <a href="#">
                                <i class="fa fa-group"></i> <span>Users</span>
                            </a>
                            <ul class="treeview-menu"> -->
                            <!-- <li class="header" style="text-align:center;">USERS</li> -->
                            <?php

                                if($user_session['userType'] == 'ADMIN') {

                            ?>

                                <li>
                                    <a href="<?php echo site_url('user/add');?>"><i class="fa fa-plus"></i> Add New User</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('user/index');?>"><i class="fa fa-microchip "></i> View All Users</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('user/staff');?>">
                                        <i class="fa fa-vcard"></i> <span>OHS Staff</span>
                                    </a>
                                    <!-- <ul class="treeview-menu">
                                        <li>
                                            <a href="<?php //echo site_url('staff/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('staff/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                                </li>
                                <li>
                                    <a href="<?php echo site_url('user/company_users');?>">
                                        <i class="fa fa-users"></i> <span>Company Users</span>
                                    </a>
                                    <!-- <ul class="treeview-menu">
                                        <li>
                                            <a href="<?php //echo site_url('company_user/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('company_user/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                                </li>

                            <?php

                                }

                            ?>

                                <li>
                                    <a href="<?php echo site_url('worker/index');?>">
                                        <i class="fa fa-address-book"></i> <span>Construction Workers</span>
                                    </a>
                                    <!-- <ul class="treeview-menu">
                                        <li>
                                            <a href="<?php //echo site_url('worker/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php //echo site_url('worker/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul> -->
                                </li>

                            <?php

                                if($user_session['userType'] == 'ADMIN') {

                            ?>


                            <li class="header" style="text-align:center;">MANAGEMENT</li>

                                <li>
                                    <a href="#">
                                        <i class="fa fa-gg"></i> <span>Construction Companies</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="<?php echo site_url('company/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('company/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul>
                                </li>

                            <?php

                                }

                                if($user_session['userType'] == 'ADMIN') {

                            ?>
                            <li>
                                <a href="#">
                                    <i class="fa fa-align-center"></i> <span>Construction Sites</span>
                                </a>
                                <ul class="treeview-menu">
                                    <li>
                                        <a href="<?php echo site_url('site/add');?>"><i class="fa fa-plus"></i> Add</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('site/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                    </li>
                                </ul>
                            </li>

                            <?php

                                }

                                if($user_session['userType'] == 'ADMIN') {

                            ?>
                                
                                <li>
                                    <a href="#">
                                        <i class="fa fa-compass"></i> <span>ESTs (For Certification)</span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li>
                                            <a href="<?php echo site_url('est/add');?>"><i class="fa fa-plus"></i> Add</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('est/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?= site_url('drug_screening/index'); ?>"><i class="fa fa-stethoscope"></i> Drug Screenings</a>
                                </li>
                            <?php

                                }

                            ?>
                            <?php

                                if($user_session['userType'] == 'ADMIN' || ($user_session['dst_collector'] == 1 && $user_session['userType'] == 'OHS_STAFF')) {

                            ?>
                            <li>
                                <a href="<?= site_url('drug_test_log/index'); ?>"><i class="fa fa-heartbeat"></i> Drug Test Log</a>
                            </li>
                            <?php

                                }

                            ?>
                            <?php

                                if($user_session['userType'] == 'ADMIN' || $user_session['userType'] == 'OHS_STAFF') {

                            ?>
                            <li>
                                <a id="ohs-tc-link" href="<?= site_url('time_clock/index'); ?>"><i class="fa fa-clock-o"></i> Time-Clock</a>
                            </li>

                            <?php

                                }

                            ?>
                            <?php

                                if($user_session['userType'] == 'ADMIN') {

                            ?>

                            <li class="header" style="text-align:center;">ADMIN FUNCTIONS</li>
                            <li>
                                <a href="<?php echo site_url('synergy_log/index'); ?>"><i class="fa fa-file"></i> Synergy Log</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('inventory_management/index'); ?>"><i class="fa fa-cart-plus"></i> Inventory Management</a>
                            </li>
                            <?php

                                }

                                if($user_session['userType'] == 'OHS_STAFF') {

                            ?>
                            <li>
                                <a href="<?php echo site_url('inventory_order/index'); ?>"><i class="fa fa-cart-plus"></i> Inventory Orders</a>
                            </li>
                                
                            <?php

                                }

                                if($user_session['userType'] == 'ADMIN') {

                            ?>
                            
                            <li>
                                <a href="<?php echo site_url('site_report/index'); ?>"><i class="fa fa-line-chart"></i> Site Reports</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('ageing_report/index'); ?>"><i class="fa fa-line-chart"></i> Ageing Reports</a>
                            </li>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-line-chart"></i> Company Reports</a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-line-chart"></i> Subcontractor Reports</a>
                            </li>

                            <?php

                                }

                            ?>
                            <!-- </ul>
                        </li> -->
                        <!-- <li class="header">START@USER MANAGEMENT</li>
						<li>
                            <a href="#">
                                <i class="fa fa-institution"></i> <span>Companies</span>
                            </a>
                            <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('company/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('company/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul>
                        </li>
						<li>
                            <a href="#">
                                <i class="fa fa-address-card"></i> <span>Company Admins</span>
                            </a>
                            <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('company_admin/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('company_admin/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul>
                        </li>
						<li>
                            <a href="#">
                                <i class="fa fa-child"></i> <span>Company Users</span>
                            </a>
                            <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('company_user/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('company_user/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul>
                        </li>
						<li>
                            <a href="#">
                                <i class="fa fa-credit-card-alt"></i> <span>User Roles</span>
                            </a>
                            <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('role/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('role/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul>
                        </li>
						<li>
                            <a href="#">
                                <i class="fa fa-group"></i> <span>Users</span>
                            </a>
                            <ul class="treeview-menu">
								<li class="active">
                                    <a href="<?php //echo site_url('user/add');?>"><i class="fa fa-plus"></i> Add</a>
                                </li>
								<li>
                                    <a href="<?php //echo site_url('user/index');?>"><i class="fa fa-list-ul"></i> Listing</a>
                                </li>
							</ul>
                        </li>
                        <li class="header">END@USER MANAGEMENT</li> -->
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content" style="border-top: 2px solid #38247B; border-bottom: 1px solid #38247B;">
                    <?php                    
                    if(isset($_view) && $_view)
                        $this->load->view($_view);

                    if(isset($_modal) && $_modal)
                        $this->load->view($_modal);
                    ?>

                    <!-- <div style="border: 1px solid #38247B;">
                        <h2 style="text-align: center; color: #8492af;"><b><i style="color: #38247B;">OHS Training & Consulting, Inc.</i></b></h2>
                        <h4 style="text-align: center; color:   #38247B;">Serving Massachusetts and New England states.<br>Phone:  <i>617-959-4414</i>   Fax:  <i>617-663-6677</i><br>Email: <i>support@ohstc.us</i></h4>
                        <div style="height: 10px;"></div>
                    </div> -->               
                </section>
                <!-- /.content -->
                <div style="text-align: center; background-color: #222d32; padding: 5px; color: #ffffff; border-left: 1px solid gray;">
                    <span style="font-size: 150%;">OHS Training & Consulting, Inc.</span><br>Serving Massachusetts and New England states.<br>Phone:  <i>617-959-4414</i>   Fax:  <i>617-663-6677</i><br>Email: <i>support@ohstc.us</i>
                </div>
                <!-- <div style="background-color: #808080; font-size: 50%; padding: 0px;">
                    <h2 style="text-align: center; color: #ffffff;"><b><i style="color: #ffffff;">OHS Training & Consulting, Inc.</i></b></h2>
                    <h4 style="text-align: center; color: #ffffff;">Serving Massachusetts and New England states.<br>Phone:  <i>617-959-4414</i>   Fax:  <i>617-663-6677</i><br>Email: <i>support@ohstc.us</i></h4>
                    <div style="height: 10px;"></div>
                </div> -->
            </div>
            <!-- /.content-wrapper -->
            
        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="<?php echo site_url('resources/js/jquery-2.2.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo site_url('resources/js/bootstrap.min.js');?>"></script>
        <!-- FastClick -->
        <script src="<?php echo site_url('resources/js/fastclick.js');?>"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo site_url('resources/js/app.min.js');?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo site_url('resources/js/demo.js');?>"></script>
        <!-- DatePicker -->
        <script src="<?php echo site_url('resources/js/moment.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-datetimepicker.min.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-datepicker.js');?>"></script>
        <script src="<?php echo site_url('resources/js/bootstrap-timepicker.js');?>"></script>
        <script src="<?php echo site_url('resources/js/global.js');?>"></script>
        <!-- Select 2 -->
        <script src="<?php echo site_url('resources/js/select2.min.js');?>"></script>

        <script src="<?php echo site_url('resources/js/webcamjs/webcam.js?v=' . time());?>"></script>

        <script src="<?php echo site_url('resources/js/scripts.js?v=' . time());?>"></script>
    </body>
</html>
