<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3  style="color: #ffffff;" class="box-title">REGISTERED WORKERS</h3>
            	<div class="box-tools">
                    <?php

                        if($user_session['userType'] == 'ADMIN' || $user_session['userType'] == 'OHS_STAFF') {

                    ?>
                    <a href="<?php echo site_url('worker/add'); ?>" class="btn btn-success btn-sm">REGISTER NEW WORKER</a> 
                    <?php

                        }

                    ?>
                </div>
            </div>
            <div class="box-body">
                <br>
                <?php echo form_open('worker/index'); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>UID</small>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="wfRules[uid]" class="form-control" value="<?php if($wfRules['uid'] != null && $wfRules['uid'] != ''){ echo $wfRules['uid']; } else { echo ''; } ?>" />
                        </div>
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>LASTNAME</small>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="wfRules[lName]" class="form-control" value="<?php if($wfRules['lName'] != null && $wfRules['lName'] != ''){ echo $wfRules['lName']; } else { echo ''; } ?>" />
                        </div>
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>FIRSTNAME</small>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="wfRules[fName]" class="form-control" value="<?php if($wfRules['fName'] != null && $wfRules['fName'] != ''){ echo $wfRules['fName']; } else { echo ''; } ?>" />
                        </div>
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>CITY</small>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="wfRules[city]" class="form-control" value="<?php if($wfRules['city'] != null && $wfRules['city'] != ''){ echo $wfRules['city']; } else { echo ''; } ?>" />
                        </div>
                    </div>
                    <div class="col-sm-12" style="min-height: 10px;">
                        
                    </div>
                     <div class="col-sm-12">
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>DOB</small>
                        </div>
                        <div class="col-sm-2">
                            <div class="input-group date">
                                <input class="form-control" type="text" name="wfRules[dob]" value="<?php if($wfRules['dob'] != null){ echo $wfRules['dob']; } else { echo ''; } ?>" />
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>COMPANY</small>
                        </div>
                        <div class="col-sm-4">
                            <select id="com" name="wfRules[comId]" class="single-searchable-select form-control">
                                <option value="0">ALL</option>
                                <?php 
                                foreach($all_companies as $company)
                                {
                                    $selected = ($company['id'] == $wfRules['comId']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$company['id'].'" '.$selected.'>'.$company['companyName'].'</option>';
                                } 
                                ?>
                            </select>
                        </div>
                        <div style="padding-top: 5px;" class="col-sm-1">
                            <small>TRADE</small>
                        </div>
                        <div class="col-sm-3">
                            <select name="wfRules[jobTitle]" class="single-searchable-select form-control">
                                    <option value="ALL"<?php if($wfRules['jobTitle'] == 'ALL') { echo ' selected="selected"'; } ?>>ALL</option>
                                    <?php 
                                    foreach($user_session['trades'] as $trade)
                                    {
                                        $selected = ($trade == $wfRules['jobTitle']) ? ' selected="selected"' : "";

                                        echo '<option value="'.$trade.'" '.$selected.'>'.$trade.'</option>';
                                    }

                                    ?>
                                </select>
                        </div>
                    </div>
                    <div class="col-sm-12" style="min-height: 10px;">
                    </div>
                    <div class="col-sm-12 col-sm-offset-5">
                        <button type="submit" id="run_w_filter" name="run_w_filter" class="btn btn-primary btn-xs">RUN FILTER</button>
                    </div>
                    <br>
                    <div class="col-md-12" style="min-height: 10px;">
                        <hr>
                    </div>
                    <hr>
                </div>
                <?php echo form_close(); ?>
                <table class="table table-striped">
                    <tr>
						<th>UID</th>
						<th>Full Name</th>
						<th>Status</th>
						<th>DOB</th>
						<th>Company</th>
						<th>Trade</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($workers as $key => $w){ ?>
                    <tr>
						<td><?php echo $w['uid']; ?></td>
						<td><?php echo $w['lastName'] . ' ' . $w['firstName'] . ' ' . $w['middleName']; ?></td>
						<td>
                            <?php

                                foreach($all_user_statuses as $us) {
                                    
                                    if($w['statusId'] == $us['id']) {

                                        echo $us['title'];

                                    }

                                }

                            ?>
                        </td>
						<td><?php echo $w['dob']; ?></td>
						<td>
                            <?php

                                //echo $w['companies'];
                                //echo $ctrl->_show_assigned_companies($w['companies']);
                                foreach($all_companies as $c) {
                                    
                                    if($w['companyId'] == $c['id']) {

                                        echo $c['companyName'];

                                    }

                                }

                            ?>                  
                        </td>
						<td><?php echo $w['jobTitle']; ?></td>
						<td>
                            <?php echo form_open('', array("method"=>"post")); ?>
                                <input type="hidden" name="workerId" value="<?php echo $w['id']; ?>">
                                <input type="hidden" name="workerName" value="<?php echo $w['lastName'] . ' ' . $w['firstName'] . ' ' . $w['middleName']; ?>">
                                <button type="submit" value="view_certs" id="view_certs" name="view_certs" class="btn btn-primary btn-xs">Certifications</button>&nbsp;<button type="submit" value="<?= site_url('worker/getWorker?id=' . $w['id']); ?>" class="view_worker btn btn-default btn-xs">VIEW</button>&nbsp;<a href="<?php echo site_url('worker/edit/'.$w['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <?php

                                if($user_session['userType'] == 'ADMIN') {

                            ?>
                                <a href="<?php echo site_url('worker/remove/'.$w['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                            <?php

                                }

                            ?> 
                            <?php echo form_close(); ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                <div style ="text-align: center;">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div id="viewWorkerModal" class="modal">
    <div class="modal-dialog" style="width: 90%; display: block; padding: 30px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">WORKER INFORMATION</h4>
            </div>
            <div class="row modal-body" style="padding: 30px 45px 30px 45px;">
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <label>Name Of Worker</label>
                        </div>
                        <div class="col-sm-3">
                            <p style="color: navy; font-size: 120%; font-family: Courier New;" id="workerName"></p>
                        </div>
                        <div class="col-sm-3">
                            <label>Worker's Picture</label>
                        </div>
                        <div class="col-sm-3">
                            <img id="wImg" src="<?php echo site_url('resources/img/user_default.png');?>" style="height: 120px; width: 100px;" alt="Worker Image">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h5 class="modal-info">BASIC INFORMATION</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">Status</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="status"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Sex</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="sex"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Date Of Birth</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="dob"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">Primary Phone</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="primaryPhone"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Email</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="email"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Address #1</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="address1"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">Address #2</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="address2"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Communication Preference</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="comm_pref"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">City</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="city"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">State</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="state"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Zip Code</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="zipCode"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Trade</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="jobTitle"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">Other Trade</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="otherTrade"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Identification Type</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="identificationType"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Other Identification Type</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="otherIdType"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">Identification ID</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="identificationId"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Jobs</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="jobs"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-3">
                            <label class="control-label">Company</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="companyName"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Site</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="siteName"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h5 class="modal-info">EMERGENCY CONTACT</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-2">
                            <label class="control-label">Contact's Name</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="ecName"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Relationship</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="ecRelationship"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label">Phone Number</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="ecPhone"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-md-3">
                            <label for="ecAltPhone" class="control-label">Alternative Phone Number</label>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p style="color: navy; font-size: 120%; font-family: Courier New;" id="ecAltPhone"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="box-footer">
                    <button type="submit" id="close_worker_view" name="close_worker_view" value="close_worker_view" class="btn btn-warning">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
