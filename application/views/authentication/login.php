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
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/AdminLTE.min.css');?>">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo site_url('resources/css/_all-skins.min.css');?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i">
        <link rel="stylesheet" href="<?php echo site_url('resources/css/theme-style.css?v='.time());?>">
    </head>
    <body style="background: #808080;">
    	<div style="width: 32%; margin-top: 15px; margin-left: 34%; background: #ffffff; border: 5px solid #38247B;" class="login-box">
            <div style="height: 10px; background-color: #38247B;"></div><div style="height: 5px;"></div>
            <div class="logo-holder" style="text-align: center;">
                <img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="200" width="200">
            </div>
            <div class="setting_inner_input">
          	    <p style="color: red;"><?php if(isset($errorMessage) && $errorMessage) { echo $errorMessage; }?></p>
            </div>
            <div class="setting_inner_form">
	            <form method="post" action="<?= base_url('login/authenticate'); ?>">
	         	    <div class="setting_inner_input">
	                    <span><img src="<?php echo site_url('resources/img/user-2.png');?>" alt=""></span> 
	                    <input name="username" type="text" placeholder="Username"> 
	                </div> 
	                <div class="setting_inner_input">
	                    <span><img src="<?php echo site_url('resources/img/password.png');?>" alt=""></span> 
	                    <input name="password" type="password" placeholder="Password"> 
	                </div>
	                <button type="submit" style="color: #ffffff; background: #38247B;">LOGIN</button>
                    <p>Forgot Your Password? <a href="<?= base_url('uac/forgot_password'); ?>">CLICK HERE</a></p>
	            </form>
            </div>
            <div style="background-color: #38247B;">
                <h2 style="text-align: center; color: #ffffff;"><b><i style="color: #ffffff;">OHS Training & Consulting, Inc.</i></b></h2>
                <h4 style="text-align: center; color: #ffffff;">Serving Massachusetts and New England states.<br>Phone:  <i>617-959-4414</i>   Fax:  <i>617-663-6677</i><br>Email: <i>support@ohstc.us</i></h4>
                <div style="height: 10px;"></div>
            </div>
            <!-- <h2 style="text-align: center; color: #8492af;"><b><i style="color: #38247B;">OHS Training & Consulting, Inc.</i></b></h2>
            <h4 style="text-align: center; color:   #38247B;">Serving Massachusetts and New England states.<br>Phone:  <i>617-959-4414</i>   Fax:  <i>617-663-6677</i><br>Email: <i>support@ohstc.us</i></h4>
            <div style="height: 10px;"></div> -->
	    </div>
    </body>
</html>