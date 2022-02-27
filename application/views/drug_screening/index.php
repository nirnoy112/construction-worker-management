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
                <h3 style="color: #ffffff;" class="box-title">DRUG SCREENINGS</h3>
            </div>
            <div class="box-body">
                <?php echo form_open('drug_screening/index'); ?>
                <div class="col-sm-12" style="min-height: 15px;">
                </div>
                <div class="col-sm-12">
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small><b>COLLECTION DATE</b></small>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-daterange" id="datepicker">
                            <input type="text" class="form-control" name="dsRules[dateFrom]" value="<?php if($dsRules['dateFrom'] != null){ echo $dsRules['dateFrom']; } else { echo ''; } ?>" />
                            <div class="input-group-addon"><b>TO</b></div>
                            <input type="text" class="form-control" name="dsRules[dateTo]" value="<?php if($dsRules['dateTo'] != null){ echo $dsRules['dateTo']; } else { echo ''; } ?>" />
                        </div>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-1">
                        <small><b>RESULT</b></small>
                    </div>
                    <div class="col-sm-4">
                        <select id="testResult" name="dsRules[testResult]" class="form-control">
                            <option value="ALL"<?php if($dsRules['testResult'] == 'ALL') { echo ' selected="selected"'; } ?>>ALL</option>
                            <option value="Negative"<?php if($dsRules['testResult'] == 'Negative') { echo ' selected="selected"'; } ?>>Negative</option>
                            <option value="Inconclusive; Sent for further testing"<?php if($dsRules['testResult'] == 'Inconclusive; Sent for further testing') { echo ' selected="selected"'; } ?>>Inconclusive; Sent for further testing</option>
                            <option value="Inconclusive; Cleared"<?php if($dsRules['testResult'] == 'Inconclusive; Cleared') { echo ' selected="selected"'; } ?>>Inconclusive; Cleared</option>
                            <option value="FAR"<?php if($dsRules['testResult'] == 'FAR') { echo ' selected="selected"'; } ?>>FAR</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12" style="min-height: 10px;">
                </div>
                <div class="col-sm-12 col-sm-offset-5">
                    <button type="submit" id="run_ds_filter" name="run_ds_filter" class="btn btn-primary btn-xs">RUN FILTER</button>
                </div>
                <br>
                <div class="col-md-12" style="min-height: 10px;">
                    <hr>
                </div>
                <hr>
                <?php echo form_close(); ?>
                <table class="table table-striped">
                    <tr>
						<th>Collection Date</th>
                        <th>Name Of Worker</th>
                        <!-- <th>Site</th>
                        <th>Company</th> -->
                        <th>Name Of Collector</th>
                        <th>Test Result</th>
                        <th>Options</th>
                    </tr>
                    <?php foreach($drug_screenings as $ds){ ?>
                    <tr>
						<td><?php echo $ds['collectionDate']; ?></td>
                        <td><?php echo $ds['workerName']; ?></td>
                        <!-- <td><?php //echo $ds['siteName']; ?></td>
                        <td><?php //echo $ds['companyName']; ?></td> -->
                        <td><?php echo $ds['collector']; ?></td>
                        <td><?php if($ds['testResult'] == 'FAR') { echo 'No cleared for Work'; } else { echo $ds['testResult']; } ?></td>
                        <td>
                        <?php if($ds['testResult'] == 'Inconclusive; Sent for further testing') { ?>
                            <a href="<?php echo site_url('drug_screening/markascleared/'.$ds['id']); ?>" class="btn btn-info btn-xs"></span>Mark 'CLEARED'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('drug_screening/markasfar/'.$ds['id']); ?>" class="btn btn-success btn-xs"></span>Mark 'FAR'</a>
                        <?php } ?>
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