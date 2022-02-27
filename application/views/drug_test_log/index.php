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
                <h3 style="color: #ffffff;" class="box-title">DRUG TEST LOG</h3>
            </div>
            <div class="box-body">
                <div style="display: none;" id="log-dtc-heading" class="col-sm-12">
                    <h5 class="modal-info">LOG NEW COLLECTION</h5>
                </div>
                <div class="col-md-12" style="min-height: 10px;">
                </div>
                <div style="display: none;" id="log-new-dtc" class="col-sm-12">
                    <?php echo form_open('drug_test_log/addcollection'); ?>
                    <input type="hidden" name="collectorId" id="collectorId" value="<?= $user_session['id']; ?>">
                    <div style="padding-top: 5px;" class="col-sm-1">
                        <small>DATE</small>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group date">
                            <input class="form-control" type="text" name="date" value="<?php if($this->input->post('date') == null){ echo date('m-d-Y'); } else { echo $this->input->post('date'); } ?>" />
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small>SELECT SITE</small>
                    </div>
                    <div class="col-sm-2">
                        <select id="siteId" name="siteId" class="form-control">
                            <?php 
                            foreach($all_sites as $s)
                            {
                                $selected = ($s['id'] == $this->input->post('siteId')) ? ' selected="selected"' : "";

                                echo '<option value="'. $s['id'] . '/' . $s['assignedCompanyId'] . '"' . $selected . '>' . $s['siteName']  .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small>NUMBER OF TESTS</small>
                    </div>
                    <div class="col-sm-2">
                        <input type="number" name="testCount" id="testCount" value="0" class="form-control" />
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" id="run_dtc_filter" name="run_dtc_filter" class="btn btn-success btn-sm">ADD</button>
                    </div>
                    <?php echo form_close(); ?>
                    <br>
                    <hr>
                </div>
                <div class="col-sm-12">
                    <h4 class="page-info">COLLECTION RECORDS</h4>
                </div>
                <div class="col-md-12" style="min-height: 20px;">
                </div>
                <?php echo form_open('drug_test_log/index'); ?>
                <div class="col-sm-12">
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small>DATE RANGE</small>
                    </div>
                    <div class="col-sm-5">
                        <div class="input-group input-daterange" id="datepicker">
                            <input type="text" class="form-control" name="dtcRules[dateFrom]" value="<?php if($dtcRules['dateFrom'] != null){ echo $dtcRules['dateFrom']; } else { echo ''; } ?>" />
                            <div class="input-group-addon"><b>TO</b></div>
                            <input type="text" class="form-control" name="dtcRules[dateTo]" value="<?php if($dtcRules['dateTo'] != null){ echo $dtcRules['dateTo']; } else { echo ''; } ?>" />
                        </div>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-2">
                        <small>SELECT SITE</small>
                    </div>
                    <div class="col-sm-3">
                        <select id="siteId" name="dtcRules[siteId]" class="form-control">
                            <option value="0"<?php if($dtcRules['siteId'] == 0) { echo ' selected="selected"'; } ?>>ALL</option>
                            <?php 
                            foreach($all_sites as $s)
                            {
                                $selected = ($s['id'] == $dtcRules['siteId']) ? ' selected="selected"' : "";

                                echo '<option value="'. $s['id'] . '"' . $selected . '>' . $s['siteName']  .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-12" style="min-height: 10px;">
                    </div>
                    <?php
                        if($user_session['userType'] == 'ADMIN') {
                    ?>
                    <div style="padding-top: 5px;" class="col-sm-3">
                        <small> SELECT COMPANY</small>
                    </div>
                    <div class="col-sm-3">
                        <select id="companyId" name="dtcRules[companyId]" class="form-control">
                            <option value="0"<?php if($dtcRules['companyId'] == 0) { echo ' selected="selected"'; } ?>>ALL</option>
                            <?php 
                            foreach($all_companies as $c)
                            {
                                $selected = ($c['id'] == $dtcRules['companyId']) ? ' selected="selected"' : "";

                                echo '<option value="'. $c['id'] . '"' . $selected . '>' . $c['companyName']  .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div style="padding-top: 5px;" class="col-sm-3">
                        <small>SELECT TEST COLLECTOR</small>
                    </div>
                    <div class="col-sm-3">
                        <select name="dtcRules[collectorId]" class="form-control">
                            <option value="0"<?php if($dtcRules['collectorId'] == 0) { echo ' selected="selected"'; } ?>>ALL</option>
                            <?php 
                            foreach($drug_test_collectors as $tc)
                            {
                                $selected = ($tc['id'] == $dtcRules['collectorId']) ? ' selected="selected"' : "";

                                echo '<option value="'. $tc['id'] . '"' . $selected . '>' . $tc['fullName'] . ' (' . $tc['username'] . ')' .'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                        } else {
                    ?>
                    <input type="hidden" name="dtcRules[companyId]" value="<?= $dtcRules['companyId']; ?>">
                    <input type="hidden" name="dtcRules[collectorId]" value="<?= $dtcRules['collectorId']; ?>">
                    <?php
                        }
                    ?>
                    <input type="hidden" name="dtcRules[sortBy]" value="<?= $dtcRules['sortBy']; ?>">
                    <input type="hidden" name="dtcRules[sortingOrder]" value="<?= $dtcRules['sortingOrder']; ?>">
                </div>
                <div class="col-sm-12" style="min-height: 10px;">
                </div>
                <div class="col-sm-12 col-sm-offset-5">
                    <button type="submit" id="run_dtc_filter" name="run_dtc_filter" class="btn btn-primary btn-xs">RUN FILTER</button>
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
                        <?php
                            if($user_session['userType'] == 'ADMIN') {
                        ?>
                        <th>Collector Name (Username)</th>
                        <?php
                            }
                        ?>
                        <th>Site Name</th>
                        <?php
                            if($user_session['userType'] == 'ADMIN') {
                        ?>
                        <th>Company Name</th>
                        <?php
                            }
                        ?>
                        <th>Number Of Collected Tests</th>
                    </tr>
                    <?php foreach($dtc_records as $dtc){ ?>
                    <tr>
						<td><?php echo date('m-d-Y', $dtc['date']); ?></td>
                        <?php
                            if($user_session['userType'] == 'ADMIN') {
                        ?>
                        <td>
                            <?= $dtc['fullName'] . ' (' . $dtc['username'] . ')'; ?>
                        </td>
                        <?php
                            }
                        ?>
						<td><?php echo $dtc['siteName']; ?></td>
                        <?php
                            if($user_session['userType'] == 'ADMIN') {
                        ?>
                        <td>
                            <?= $dtc['companyName']; ?>
                        </td>
                        <?php
                            }
                        ?>
						<td><?php echo $dtc['testCount']; ?></td>
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
