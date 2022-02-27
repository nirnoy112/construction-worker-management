<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
            	<h3 style="color: #ffffff;" class="box-title">WELCOME TO OHS TRAINING & CONSULTING, INC.</h3>
            </div>
            <div class="box-body">
                <div class="col-sm-12" style="text-align: center; padding-left: 20px; padding-top: 30px;">
                <?php if($user_session['userType'] == 'ADMIN' || $user_session['userType'] == 'OHS_STAFF') { ?>
                    <div class="col-sm-4"><a href="<?php echo site_url('worker/add'); ?>"><i class="fa fa-plus-square" style="font-size:10em;" aria-hidden="true"></i><br><h5>REGISTER NEW WORKER</h5></a>
                    </div>
                <?php } ?>
                    <div class="col-sm-4"><a href="<?php echo site_url('worker/index'); ?>"><i class="fa fa-users" style="font-size:10em;" aria-hidden="true"></i><br><h5>CONSTRUCTION WORKERS</h5></a>
                    </div>
                <?php if($user_session['userType'] == 'ADMIN' || $user_session['userType'] == 'OHS_STAFF') { ?>
                    <div class="col-sm-4"><a href="<?= site_url('time_clock/index'); ?>"><i class="fa fa-clock-o" style="font-size:10em;" aria-hidden="true"></i><br><h5>TIME-CLOCK</h5></a>
                    </div>
                <?php } ?>
                </div>
                <div class="col-sm-12" style="height: 10px;">
                    
                </div>
                <div class="col-sm-12" style="text-align: center; padding-left: 20px; padding-top: 30px;">
                    <div class="col-sm-4" style="display: <?php if($user_session['userType'] != 'ADMIN') { echo 'none'; } ?>"><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-cogs" style="font-size:10em;" aria-hidden="true"></i><br><h5>MANAGEMENT</h5></a>
                    </div>
                </div>
            </div>
            <br />
        </div>
    </div>
</div>