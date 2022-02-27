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
            <?php echo form_open('synergy_log/index'); ?>
            <div class="box-header">
                <h3 style="color: #ffffff;" class="box-title">SYNERGY LOG</h3>
                <div class="box-tools">
                    <button type="submit" name="export_log" id="export_log" class="btn btn-success btn-sm">EXPORT FILTERED LOG</button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-sm-12">
                    <h4 class="page-info">RECENT EVENTS</h4>
                </div>
                <div class="col-md-12" style="min-height: 20px;">
                </div>
                <div class="col-sm-12">
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <b>DATE RANGE</b>
                    </div>
                    <div class="col-sm-6">
                        <div class="input-group input-daterange" id="datepicker">
                            <input type="text" class="form-control" name="slRules[dateFrom]" value="<?php if($slRules['dateFrom'] != null){ echo $slRules['dateFrom']; } else { echo ''; } ?>" />
                            <div class="input-group-addon"><b>TO</b></div>
                            <input type="text" class="form-control" name="slRules[dateTo]" value="<?php if($slRules['dateTo'] != null){ echo $slRules['dateTo']; } else { echo ''; } ?>" />
                        </div>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <b>RESPONSE TYPE</b>
                    </div>
                    <div class="col-sm-2">
                        <select id="activity" name="slRules[success]" class="form-control">
                            <option value="1"<?php if($slRules['success'] == 1) { echo ' selected="selected"'; } ?>>ALL</option>
                            <option value="0"<?php if($slRules['success'] == 0) { echo ' selected="selected"'; } ?>>SUCCESSFUL</option>
                            <option value="-1"<?php if($slRules['success'] == -1) { echo ' selected="selected"'; } ?>>FAILED</option>
                        </select>
                    </div>
                    <div class="col-sm-12" style="min-height: 15px;">
                    </div>
                    <div class="col-sm-2">
                        <b>EVENT TYPE</b>
                    </div>
                    <div class="col-sm-2">
                        <input type="checkbox" id="workerRegister" name="workerRegister" <?php if($slRules['workerRegister'] == 1) { echo ' checked="checked"'; } ?> /><span></span>Register Worker
                    </div>
                    <div class="col-sm-2">
                        <input type="checkbox" id="workerUpdate" name="workerUpdate" <?php if($slRules['workerUpdate'] == 1) { echo ' checked="checked"'; } ?> /><span></span>Update Worker
                    </div>
                    <div class="col-sm-3">
                        <input type="checkbox" id="subcontractorRegister" name="subcontractorRegister" <?php if($slRules['subcontractorRegister'] == 1) { echo ' checked="checked"'; } ?> /><span></span>Register Subcontractor
                    </div>
                    <div class="col-sm-3">
                        <input type="checkbox" id="subcontractorUpdate" name="subcontractorUpdate" <?php if($slRules['subcontractorUpdate'] == 1) { echo ' checked="checked"'; } ?> /><span></span>Update Subcontractor
                    </div>
                    <div class="col-sm-12" style="min-height: 10px;">
                    </div>
                <div class="col-sm-12" style="min-height: 10px;">
                </div>
                <div class="col-sm-12 col-sm-offset-5">
                    <button type="submit" id="run_sl_filter" name="run_sl_filter" class="btn btn-primary btn-xs">RUN FILTER</button>
                </div>
                <br>
                <div class="col-md-12" style="min-height: 10px;">
                    <hr>
                </div>
                <hr>
                <table class="table table-striped">
                    <tr style="overflow: hidden;">
						<th>Time</th>
                        <th>Event</th>
                        <th>Response</th>
                        <th>Status</th>
                        <th>Error</th>
                    </tr>
                    <?php foreach($sl_records as $sl){ ?>
                    <tr style="overflow: hidden;">
						<td><?php echo date('m-d-Y h:i:s A', $sl['time']); ?></td>
                        <td><?php echo $sl['event']; ?></td>
                        <td><?php echo $sl['resData']; ?></td>
                        <td><?php echo ($sl['success'] == 0) ? 'SUCCESSFUL' : 'FAILED'; ?></td>
						<td><?php echo $sl['errMsg']; ?></td>
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
