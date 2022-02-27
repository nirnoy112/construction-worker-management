<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="alcoholTestModal" class="modal">
    <div class="modal-dialog" style="width: 900px !important; display: block; padding: 30px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">EDIT ALCOHOL TEST</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 25px 0px 25px;">
                <?php echo form_open('', 'name="at-form"'); ?>
                <input type="hidden" name="aatId" value="<?php echo $at['id']; ?>" id="aatId" />
                <input type="hidden" name="workerId" value="<?php echo $at['workerId']; ?>" id="workerId" />
                <input type="hidden" name="loggedInUser" value="<?php echo $user_session['realName'] . ' (' . $user_session['username'] . ')'; ?>" id="loggedInUser" />
                <input type="hidden" name="currentDate" value="<?php echo date('m-d-Y'); ?>" id="currentDate" />
	          	<div class="box-body">
	          		<div class="row clearfix">
	          			<div style="text-align: center;" class="col-sm-12">
	          				<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="150" width="150">
	          				<h3 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 115%;"><b><?= strtoupper($worker['site']['assigningCompanyName']); ?></b></h3>
	          				<h4 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 105%;"><b><?= strtoupper($worker['site']['siteName'] . ' - ' . $worker['site']['city'] . ', ' . $worker['site']['state']); ?></b></h4>
	          				<br>
	          				<h4 style="font-family: Times New Roman; font-stretch: ultra-condensed; font-size: 120%;"><b>CONSENT FOR URINE ANALYSIS FOR THE</b><br>
	          				<h4 style="font-family: Times New Roman; font-stretch: ultra-condensed; font-size: 120%;"><b>PURPOSES OF ALCOHOL & DRUG TESTING</b><br>
	          				<h4 style="font-family: Times New Roman; font-stretch: ultra-condensed; font-size: 120%;"><b>AND</b><br>
	          				<h4 style="font-family: Times New Roman; font-stretch: ultra-condensed; font-size: 120%;"><b>CONSENT FOR THE RELEASE OF INFORMATION</b></h4>
	          			</div>
	          			<div style="padding: 30px; font-size: 95%; text-align: justify;" class="col-sm-12">
<p style="font-family:candara; font-size: 130%;">I understand that testing for illegal drug use is required by my Employer, Prospective Employer, Project Manager, Safety Manager, Director of Safety or other supervisory personnel as a part of comprehensive safety program.</p>
<p style="font-family:candara; font-size: 130%;">As such,</p>
<p style="font-family:candara; font-size: 130%;">I hereby consent to the collection of my urine by <b>OHS Training & Consulting</b> for the purpose of drug testing and for the specimen to be further tested by the drug testing laboratories as necessary to complete analysis required by my Employer, Prospective Employer, Project Manager, Safety Manager, Director of Safety or other supervisory personnel.</p>
<p style="font-family:candara; font-size: 130%;">I release and discharge <b>OHS Training & Consulting</b>, it's officers, and agents from any claim or liability arising from the use of such test for any decision concerning employment based on the results of such a test.</p>
<p style="font-family:candara; font-size: 130%;">I understand that the results of this test is shared with <?= $worker['site']['assigningCompanyName']; ?> Safety Department, and that signing this document is consent to both the collection of the urine and the release of the results to <?= $worker['site']['assigningCompanyName']; ?>.</p>
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="signature" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Name (Signature):</label>
								<input type="hidden" name="signature" id="signature" />
							</div>
							<div class="col-md-9">
								<?php
									if($at['signature']) {
								?>
								<img src="<?php echo site_url('resources/signatures/'. $at['signature']); ?>" style="width: 175px; height: 50px;" alt="Worker Signature">
								<?php
									}
								?>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="workerName" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> Name (Printed):</label>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<input type="text" name="workerName" value="<?php echo ($this->input->post('workerName')) ? $this->input->post('workerName') : $at['workerName']; ?>" class="form-control" id="workerName" />
									<span class="text-danger" name="ds-workerName" id="ds-workerName"></span>
								</div>
							</div>
							<div class="col-md-4">
							</div>
	          			</div>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="contractorId" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Company:</label>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<select id="contractorId" name="contractorId" class="form-control">
										<option value="0">NONE</option>
										<?php 
										foreach($all_companies as $sc)
										{
											$selected = ($sc['id'] == $worker['companyId']) ? ' selected="selected"' : "";

											echo '<option value="'.$sc['id'].'" '.$selected.'>'.$sc['companyName'].'</option>';
										}
										?>
										?>
									</select>
								</div>
							</div>
							<div class="col-md-1">
								<label for="date" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Date:</label>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="date" type="text" name="date" value="<?php echo ($this->input->post('date')) ? $this->input->post('date') : $at['date']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
	          			</div>
	          			<div class="col-sm-12">
	          				<hr>
	          			</div>
	          			<div style="text-align: center;" class="col-sm-12">
	          				<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="150" width="150">
	          				<h3 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 115%;"><b><?= strtoupper($worker['site']['assigningCompanyName']); ?></b></h3>
	          				<h4 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 105%;"><b><?= strtoupper($worker['site']['siteName'] . ' - ' . $worker['site']['city'] . ', ' . $worker['site']['state']); ?></b></h4>
	          				<br>
	          			</div>
	          			<div class="col-sm-12">
							<div class="col-md-2">
								<label for="donor" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Donor:</label>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<input type="text" name="donor" value="<?php echo ($this->input->post('donor')) ? $this->input->post('donor') : $at['donor']; ?>" class="form-control" id="donor" />
								</div>
							</div>
							<div class="col-md-1">
								<label for="identificationId" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> ID:</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="identificationId" value="<?php echo ($this->input->post('identificationId')) ? $this->input->post('identificationId') : $at['identificationId']; ?>" class="form-control" id="identificationId" />
									<span class="text-danger" name="ds-identificationId" id="ds-identificationId"></span>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label for="subcontractorId" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Employer:</label>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<select name="subcontractorId" class="form-control">
										<option value="0">NONE</option>
										<?php 
										foreach($all_companies as $sc)
										{
											$selected = ($sc['id'] == $at['subcontractorId']) ? ' selected="selected"' : "";

											echo '<option value="'.$sc['id'].'" '.$selected.'>'.$sc['companyName'].'</option>';
										} 
										?>
									</select>
									<span class="text-danger" name="ds-subcontractorId" id="ds-subcontractorId"></span>
								</div>
							</div>
							<div class="col-md-1">
								<label for="der" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;DER:</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="der" value="<?php echo ($this->input->post('der')) ? $this->input->post('der') : $at['der']; ?>" class="form-control" id="der" />
								</div>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-md-2">
								<label for="isPrevious" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Previous :</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="checkbox" id="isPrevious" name="isPrevious" value="YES" <?php if($at['isPrevious'] == 'YES') { echo ' checked'; } ?> /><span></span> If it's PREVIOUS Drug Screening.
								</div>
							</div>
							<div class="col-md-2">
								<label for="cardNumber" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Card Number :</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" name="cardNumber" value="<?php echo ($this->input->post('cardNumber')) ? $this->input->post('cardNumber') : $at['cardNumber']; ?>" class="form-control" id="cardNumber" />
								</div>
							</div>
						</div>
						<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="reason" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> Reason:</label>
							</div>
							<div class="col-md-9">
								<span class="text-danger" name="ds-reason" id="ds-reason"></span>
							</div>
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-1"></div>
							<div class="col-md-5">
								<input class="control-label" type="radio" name="reason" value="Pre-Employment"<?php if($at['reason'] == 'Pre-Employment') { echo ' checked'; } ?> /><label for="pre-employment">&nbsp;Pre-Employment<span></span></label>
								<br>
								<input class="control-label" type="radio" name="reason" value="Random"<?php if($at['reason'] == 'Random') { echo ' checked'; } ?> /><label for="random">&nbsp;Random<span></span></label>
								<br>
								<input class="control-label" type="radio" name="reason" value="Reasonable Suspicion / For Cause"<?php if($at['reason'] == 'Reasonable Suspicion / For Cause') { echo ' checked'; } ?> /><label for="rs-or-fc">&nbsp;Reasonable Suspicion / For Cause<span></span></label>
								<span class="text-danger"><?php echo form_error('reason');?></span>
							</div>
							<div class="col-md-5">
								<input class="control-label" type="radio" name="reason" value="Return To Duty"<?php if($at['reason'] == 'Return To Duty') { echo ' checked'; } ?> /><label for="return-to-duty">&nbsp;Return To Duty<span></span></label>
								<br>
								<input class="control-label" type="radio" name="reason" value="Post-Accident"<?php if($at['reason'] == 'Post-Accident') { echo ' checked'; } ?> /><label for="post-accident">&nbsp;Post-Accident<span></span></label>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="testType" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> Test Type:</label>
							</div>
							<div class="col-md-9">
								<span class="text-danger" name="ds-testType" id="ds-testType"></span>
							</div>
	          			</div>
	          			<div class="col-sm-12">
							<div class="col-md-1">
							</div>
							<div class="col-md-4">
								<input type="checkbox" id="isTT1" name="isTT1" value="YES" <?php if($at['isTT1'] == 'YES') { echo 'checked="checked"'; } ?> /><span></span> <label for="tt1">Non-DOT Panel Instant</label>
								<select name="tt1Id" class="control-label">
									<option value="5" <?php if($at['tt1Id'] == 7) { echo ' selected="selected"'; } ?>>7</option>
									<option value="7" <?php if($at['tt1Id'] == 8) { echo ' selected="selected"'; } ?>>8</option>
									<option value="12" <?php if($at['tt1Id'] == 12) { echo ' selected="selected"'; } ?>>12</option>
								</select>
							</div>
							<div class="col-md-2">
								Lot #&nbsp;<input size="5" id="tt1" type="text" name="tt1" value="<?php echo $at['tt1']; ?>" />
							</div>
							<div class="col-md-2">
								Exp Date
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="tt1ExpDate" type="text" name="tt1ExpDate" value="<?php echo $at['tt1ExpDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<input type="checkbox" id="isTT2" name="isTT2" value="YES" <?php if($at['isTT2'] == 'YES') { echo 'checked="checked"'; } ?> /><span></span> <label for="tt2">Oxy Dip</label>
							</div>
							<div class="col-md-2">
								Lot #&nbsp;<input size="5" id="tt2" type="text" name="tt2" value="<?php echo $at['tt2']; ?>" />
							</div>
							<div class="col-md-2">
								Exp Date
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="tt2ExpDate" type="text" name="tt2ExpDate" value="<?php echo $at['tt2ExpDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<input type="checkbox" id="isTT3" name="isTT3" value="YES" <?php if($at['isTT3'] == 'YES') { echo 'checked="checked"'; } ?> /><span></span> <label for="tt3">Fentanyl Dip</label>
							</div>
							<div class="col-md-2">
								Lot #&nbsp;<input size="5" id="tt3" type="text" name="tt3" value="<?php echo $at['tt3']; ?>" />
							</div>
							<div class="col-md-2">
								Exp Date
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="tt3ExpDate" type="text" name="tt3ExpDate" value="<?php echo $at['tt3ExpDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<input type="checkbox" id="isTT4" name="isTT4" value="YES" <?php if($at['isTT4'] == 'YES') { echo 'checked="checked"'; } ?> /><span></span> <label for="tt4">Alcohol Screen 02</label>
							</div>
							<div class="col-md-2">
								Lot #&nbsp;<input size="5" id="tt4" type="text" name="tt4" value="<?php echo $at['tt4']; ?>" />
							</div>
							<div class="col-md-2">
								Exp Date
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="tt4ExpDate" type="text" name="tt4ExpDate" value="<?php echo $at['tt4ExpDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="testResult" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> Test Result:</label>
							</div>
							<div class="col-md-9">
								<span class="text-danger" name="ds-testResult" id="ds-testResult"></span>
							</div>
	          			</div>
						<div class="col-sm-12">
	          				<div class="col-sm-1">
							</div>
							<div class="col-md-3">
								<input class="control-label" type="radio" id="at-negative-result" name="testResult" value="Negative"<?php if($at['testResult'] == 'Negative') { echo ' checked'; } ?> /><b>Negative.</b>
							</div>
							<div class="col-md-5">
								<input class="control-label" type="radio" id="at-inconclusive-result" name="testResult" value="Inconclusive; Sent for further testing"<?php if($at['testResult'] == 'Inconclusive; Sent for further testing') { echo ' checked'; } ?> /><b>Inconclusive; Sent for further testing.</b>
							</div>
							<div class="col-sm-3">
								<input class="control-label" type="radio" name="testResult" id="at-refused-to-test-result" value="Refused To Test"<?php if($at['testResult'] == 'Refused To Test') { echo ' checked'; } ?> /><b>Refused To Test.</b>
							</div>
						</div>
						<div <?= ($user_session['userType'] != 'ADMIN') ? 'style="display: none;"' : ''; ?> class="col-sm-12">
							<div class="col-sm-12" style="height: 5px;">
		          			</div>
	          				<div class="col-sm-1">
							</div>
							<div class="col-md-3">
								<input class="control-label" type="radio" id="at-alcohol-negative" name="testResult" value="Alcohol Negative"<?php if($at['testResult'] == 'Alcohol Negative') { echo ' checked'; } ?> /><b>Alcohol Negative.</b>
							</div>
							<div class="col-md-5">
								<input class="control-label" type="radio" id="at-positive" name="testResult" value="Positive; Screening Confirmation Required"<?php if($at['testResult'] == 'Positive; Screening Confirmation Required') { echo ' checked'; } ?> /><b>Positive; Screening Confirmation Required.</b>
							</div>
	          				<div class="col-sm-3">
							</div>
						</div>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div id="at-inconclusive-div" class="col-sm-12">
	          				<div class="col-md-1">
								
							</div>
							<div class="col-md-3">
								Specimen ID&nbsp;&nbsp;<input type="text" name="specimenId" value="<?php echo ($this->input->post('specimenId')) ? $this->input->post('specimenId') : $at['specimenId']; ?>" size="8" id="at-specimenId" />
							</div>
							<div id="at-test-details" class="col-md-3">
								Test Details
							</div>
							<div class="col-md-5">
								<textarea name="inconclusiveDetails" class="form-control" id="at-inconclusiveDetails"><?php echo ($this->input->post('inconclusiveDetails') ? $this->input->post('inconclusiveDetails') : $at['inconclusiveDetails']); ?></textarea>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-md-2">
								<label for="comments" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Comments:</label>
							</div>
							<div class="col-md-10">
								<textarea name="comments" class="form-control" id="comments"><?php echo ($this->input->post('comments') ? $this->input->post('comments') : $at['comments']); ?></textarea>
							</div>
	          			</div>
						<div class="col-sm-12" style="height: 20px;">
	          			</div>
						<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="collectionDate" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> Collection Date:</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="collectionDate" type="text" name="collectionDate" value="<?php echo ($this->input->post('collectionDate')) ? $this->input->post('collectionDate') : $at['collectionDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
									<span class="text-danger" name="ds-collectionDate" id="ds-collectionDate"></span>
								</div>
							</div>
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="collectionSite" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Collection Site:</label>
							</div>
							<div class="col-md-5">
								<input type="text" name="collectionSite" value="<?php echo ($at['collectionSite']) ? $at['collectionSite'] : $worker['site']['siteName'] . ', ' . $worker['site']['city'] . ', ' . $worker['site']['state']; ?>" class="form-control" id="collectionSite" />
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="collector" class="control-label"><span style="font-size: 150%;" class="text-danger">*</span> Collector:</label>
							</div>
							<div class="col-md-5">
								<input type="text" name="collector" value="<?php echo ($this->input->post('collector')) ? $this->input->post('collector') : $at['collector']; ?>" class="form-control" id="collector" />
									<span class="text-danger" name="ds-collector" id="ds-collector"></span>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="collectorSignature" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;Collector Signature:</label>
								<input type="hidden" name="collectorSignature" id="collectorSignature" />
							</div>
							<div class="col-md-7">
								<?php
									if($at['collectorSignature']) {
								?>
								<img src="<?php echo site_url('resources/signatures/'. $at['collectorSignature']); ?>" style="width: 175px; height: 50px;" alt="Collector Signature">
								<?php
									}
								?>
							</div>
							<!-- <div class="col-md-6">
								<div class="sp-wrapper">
  									<canvas id="collector-signature-pad" class="signature-pad" width=350 height=100></canvas>
								</div>
							</div>
							<div style="padding-top: 35px;" class="col-md-3">
								<button id="clear-collector-signature">Clear Signature</button>
							</div> -->
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
					</div>
				</div>
	          	<div class="box-footer">
	            	<button type="submit" name="at_edition_submit" id="at_edition_submit" value="at_edition_submit" class="btn btn-success">SAVE</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="cancel_at_modal" value="cancel_at_modal" class="btn btn-warning">CANCEL</button>
	          	</div>
	            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>