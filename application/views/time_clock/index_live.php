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
            <?php echo form_open('time_clock/index'); ?>
            <div class="box-header">
                <h3 style="color: #ffffff;" class="box-title">TIME-CLOCK</h3>
                <div class="box-tools">
                    <button type="submit" name="export_tc_records" id="export_tc_records" class="btn btn-success btn-sm">EXPORT FILTERED RECORDS</button>
                </div>
            </div>
            <div class="box-body">
                <div style="display: none;" id="clock-in-out-heading" class="col-sm-12">
                    <h5 class="modal-info">CLOCK IN / CLOCK OUT</h5>
                </div>
                <div style="display: none;" id="clock-out-option" class="col-sm-12">
                    <h5>You are currently <b>CLOCKED IN</b>.</h5>
                    <a class="btn btn-info btn-sm" id="ohs-clock-out-link" href="<?= site_url('time_clock/index'); ?>">CLOCK OUT</a>
                    <br>
                </div>
                <div style="display: none;" id="clock-in-option" class="col-sm-12">
                    <h5>You are currently <b>CLOCKED OUT</b>.</h5>
                    <a class="btn btn-info btn-sm" id="ohs-clock-in-link" href="<?= site_url('time_clock/index'); ?>">CLOCK IN</a>
                    <br>
                </div>
                <div style="display: none;" id="break-in-out-heading" class="col-sm-12">
                    <h5 class="modal-info">BREAK IN / BREAK OUT</h5>
                </div>
                <div style="display: none;" id="break-in-out-option" class="col-sm-12">
                    <h5>You are currently not allowed to <b>BREAK IN / BREAK OUT</b>. To <b>BREAK IN / BREAK OUT</b>, you must <b>CLOCK IN</b> first.</h5>
                    <br>
                    <hr>
                </div>
                <div style="display: none;" id="break-out-option" class="col-sm-12">
                    <h5>You are currently <b>BREAKED IN</b>. To <b>BREAK OUT</b>, click the following link:</h5>
                    <a class="btn btn-info btn-sm" id="ohs-break-out-link" href="<?= site_url('time_clock/index'); ?>">BREAK OUT</a>
                    <br>
                    <hr>
                </div>
                <div style="display: none;" id="break-in-option" class="col-sm-12">
                    <h5>You are currently <b> NOT BREAKED IN</b>. To <b>BREAK IN</b>, click the following link:</h5>
                    <a class="btn btn-info btn-sm" id="ohs-break-in-link" href="<?= site_url('time_clock/index'); ?>">BREAK IN</a>
                    <br>
                    <hr>
                </div>
                <?php echo form_close(); ?>
                <div class="col-sm-12">
                    <h4 class="page-info">ACTIVITY RECORDS</h4>
                </div>
                <div class="col-md-12" style="min-height: 20px;">
                </div>
                <?php echo form_open('time_clock/index'); ?>
                <div class="col-sm-12">
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small>DATE RANGE</small>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-daterange" id="datepicker">
                            <input type="text" class="form-control" name="tcRules[dateFrom]" value="<?php if($tcRules['dateFrom'] != null){ echo $tcRules['dateFrom']; } else { echo ''; } ?>" />
                            <div class="input-group-addon"><b>TO</b></div>
                            <input type="text" class="form-control" name="tcRules[dateTo]" value="<?php if($tcRules['dateTo'] != null){ echo $tcRules['dateTo']; } else { echo ''; } ?>" />
                        </div>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-1">
                        <small>ACTIVITY</small>
                    </div>
                    <div class="col-sm-3">
                        <select id="activity" name="tcRules[activity]" class="form-control">
                            <option value="ALL"<?php if($tcRules['activity'] == 'ALL') { echo ' selected="selected"'; } ?>>ALL</option>
                            <option value="Clock In"<?php if($tcRules['activity'] == 'Clock In') { echo ' selected="selected"'; } ?>>CLOCK IN</option>
                            <option value="Clock Out"<?php if($tcRules['activity'] == 'Clock Out') { echo ' selected="selected"'; } ?>>CLOCK OUT</option>
                            <option value="Break In"<?php if($tcRules['activity'] == 'Break In') { echo ' selected="selected"'; } ?>>BREAK IN</option>
                            <option value="Break Out"<?php if($tcRules['activity'] == 'Break Out') { echo ' selected="selected"'; } ?>>BREAK OUT</option>
                        </select>
                    </div>
                    <div class="col-sm-12" style="min-height: 10px;">
                    </div>
                    <?php
                        if($user_session['userType'] == 'ADMIN') {
                    ?>
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small>SELECT STAFF</small>
                    </div>
                    <div class="col-sm-3">
                        <select name="tcRules[user_id]" class="form-control">
                            <option value="0"<?php if($tcRules['user_id'] == 0) { echo ' selected="selected"'; } ?>>ALL</option>
                            <?php 
                            foreach($staff as $s)
                            {
                                $selected = ($s['id'] == $tcRules['user_id']) ? ' selected="selected"' : "";

                                echo '<option value="'. $s['id'] . '"' . $selected . '>' . $s['fullName'] . ' (' . $s['username'] . ')' .'</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <?php
                        } else {
                    ?>
                    <input type="hidden" name="tcRules[user_id]" value="<?= $tcRules['user_id']; ?>">
                    <?php
                        }
                    ?>
                    <input type="hidden" name="tcRules[sortBy]" value="<?= $tcRules['sortBy']; ?>">
                    <input type="hidden" name="tcRules[sortingOrder]" value="<?= $tcRules['sortingOrder']; ?>">
                </div>
                <div class="col-sm-12" style="min-height: 10px;">
                </div>
                <div class="col-sm-12 col-sm-offset-5">
                    <button type="submit" id="run_tc_filter" name="run_tc_filter" class="btn btn-primary btn-xs">RUN FILTER</button>
                </div>
                <br>
                <div class="col-md-12" style="min-height: 10px;">
                    <hr>
                </div>
                <hr>
                <table class="table table-striped">
                    <tr>
						<th>Date</th>
                        <th>Time</th>
                        <?php
                            if($user_session['userType'] == 'ADMIN') {
                        ?>
                        <th>Staff (Site)</th>
                        <?php
                            }
                        ?>
                        <th>Activity</th>
                        <th>After / Before</th>
                        <th>Due Time</th>
                        <th>Note</th>
                    </tr>
                    <?php

                    foreach($tc_records as $tc){

                        $dueTime = '';

                        if($tc['activity'] == 'Clock In') {

                            $dueTime = $tc['startTime'];

                        } else if($tc['activity'] == 'Clock Out') {

                            $dueTime = $tc['endTime'];

                        }

                        $timeDiff = '';

                        if($tc['lateInTime'] > 600) {

                            $timeDiff = (int)(($tc['lateInTime']-600) / 60) . ' Hr ' . (($tc['lateInTime']-600) % 60) . ' Min ' . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AFTER';

                        }

                        if($tc['earlyInTime'] > 600) {

                            $timeDiff = (int)(($tc['earlyInTime']-600) / 60) . ' Hr ' . (($tc['earlyInTime']-600) % 60) . ' Min ' . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BEFORE';

                        }

                    ?>
                    <tr>
						<td><?php echo date('m-d-Y', $tc['time']); ?></td>
                        <td><?php echo date('h:i A', $tc['time']); ?></td>
                        <?php
                            if($user_session['userType'] == 'ADMIN') {
                        ?>
                        <td>
                            <?= $tc['fullName'] . ' (' . $tc['siteName'] . ')'; ?>
                            <?= ($tc['drugTestCollector'] == 1) ? '<br>Drug Test Collector' : '' ?>
                        </td>
                        <?php
                            }
                        ?>
                        <td><?php echo $tc['activity']; ?></td>
                        <td><?php echo $timeDiff; ?></td>
                        <td><?php echo $dueTime; ?></td>
						<td><?php echo $tc['note']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <div style ="text-align: center;">
                    <?php echo $this->pagination->create_links(); ?>                    
                </div>                
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="clockOutModal" class="modal">
    <div class="modal-dialog" style="width: 65%; display: block; padding: 20px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">CLOCK OUT</h4>
            </div>
            <div class="row modal-body" style="padding: 20px 30px 20px 30px;">
                <div style="min-height: 260px;" class="box-body">
                        <h5 style="color: seagreen;"><b>You are currently CLOCKED IN. Check your clock in details below and if you are sure to CLOCK OUT press "CONFIRM".</b></h5>
                        <br>
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label>SITE:</label>
                        </div>
                        <div class="col-sm-3">
                            <?= $user_session['tc_site'] ?>
                        </div>
                        <?php

                            $coTimeString = 0;
                            foreach ($all_sites as $s) {
                                if($s['id'] == $user_session['tc_site_id']) {
                                    $ciSite = $s;
                                }
                            }

                            if($ciSite['endTime'] != '' && $ciSite['endTime'] != null) {

                                $coTimeString = date('m-d-Y') . ' ' . $ciSite['endTime'];

                            }

                        ?>
                        <div class="col-sm-4">
                            <input type="hidden" id="ohs-co-curr-time" name="ohs-co-curr-time" value="<?= date('m-d-Y h:i:s A'); ?>">
                            <input type="hidden" id="ohs-co-due-time" name="ohs-co-due-time" value="<?= $coTimeString; ?>">
                            <small>Ending Time:</small> <code style="color: teal;" id="co-due-time"></code>
                        </div>
                        <div class="col-sm-3">
                            <small>Now:</small> <code style="color: teal;" id="co-current-time"></code>
                        </div>
                    </div>

                    <input type="hidden" id="co-ohs-tc-url" value="<?= site_url('time_clock/registerEvent'); ?>">
                    <input type="hidden" id="co-target-url" value="<?= site_url('time_clock/index'); ?>">
                    <input type="hidden" id="co-userId" name="co-userId" value="<?= $user_session['id']; ?>">
                    <input type="hidden" id="co-time" name="co-time" value="0">
                    <input type="hidden" id="co-dueTime" name="co-dueTime" value="0">
                    <input type="hidden" id="co-earlyInTime" name="co-earlyInTime" value="0">
                    <input type="hidden" id="co-lateInTime" name="co-lateInTime" value="0">
                    <input type="hidden" id="co-siteId" name="co-siteId" value="0">
                    <input type="hidden" id="co-companyId" name="co-companyId" value="0">
                    
                    <div class="col-sm-12" id="co-intime-section">
                        <div class="col-sm-12" style="height: 8px;"></div>
                        <code id="co-intime-information"></code>
                        <div class="col-sm-12" style="height: 8px;"></div>
                    </div>
                    <div class="col-sm-12" id="co-note-section">
                        <div class="col-sm-3">
                            <label>SHOW CAUSE NOTE</label>
                        </div>
                        <div class="col-sm-8">
                            <textarea rows="3" name="co-note" class="form-control" id="co-note"><?php echo ($this->input->post('note') ? $this->input->post('note') : ''); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="clock_out_submit" id="clock_out_submit" value="clock_out_submit" class="btn btn-success">CONFIRM</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="close_clock_out" name="close_clock_out" value="close_clock_out" class="btn btn-warning">CANCEL</button>
            </div>
        </div>
    </div>
</div>