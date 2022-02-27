<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="rcExaminationModal" class="modal">
    <div class="modal-dialog" style="width: 80%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">ADD NEW EXAMINATION</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 25px 0px 25px;">
                <?php echo form_open(''); ?>
                <input type="hidden" name="workerId" value="<?php echo $wid; ?>" id="workerId" />
	          	<div class="box-body">
	          		<div class="row clearfix">
						<div class="col-sm-12">
	          				<h5 class="modal-info">EXAMINATION DETAILS</h5>
							<div class="col-md-3">
								<label for="dateOfExam" class="control-label">Date Of Examination</label>
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="dateOfExam" type="text" name="dateOfExam" value="<?php echo $this->input->post('dateOfExam'); ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2">
								<label for="cleared" class="control-label">Clearded</label>
								<div class="form-group">
									<input class="control-label" type="radio" name="cleared" value="YES"<?php if($this->input->post('cleared') == 'YES') { echo ' checked'; } ?> /><label for="yes">&nbsp;YES<span></span></label>
									&nbsp;&nbsp;&nbsp;&nbsp;<input class="control-label" type="radio" name="cleared" value="NO"<?php if($this->input->post('cleared') == 'NO') { echo ' checked'; } ?> /><label for="no">&nbsp;NO<span></span></label>
								</div>
							</div>
							<div class="col-md-7">
								<label for="typeOfExamination" class="control-label">Type Of Examination</label>
								<div class="form-group">
									<input class="control-label" type="radio" name="typeOfExamination" value="INITIAL"<?php if($this->input->post('typeOfExamination') == 'INITIAL') { echo ' checked'; } ?> /><label for="initial">&nbsp;INITIAL<span></span></label>
									&nbsp;&nbsp;&nbsp;&nbsp;<input class="control-label" type="radio" name="typeOfExamination" value="PERIODIC"<?php if($this->input->post('typeOfExamination') == 'PERIODIC') { echo ' checked'; } ?> /><label for="periodic">&nbsp;PERIODIC<span></span></label>
									&nbsp;&nbsp;&nbsp;&nbsp;<input class="control-label" type="radio" name="typeOfExamination" value="SPECIALIST"<?php if($this->input->post('typeOfExamination') == 'SPECIALIST') { echo ' checked'; } ?> /><label for="specialist">&nbsp;SPECIALIST<span></span></label>
									&nbsp;&nbsp;&nbsp;&nbsp;<input class="control-label" type="radio" name="typeOfExamination" value="OTHER"<?php if($this->input->post('typeOfExamination') == 'OTHER') { echo ' checked'; } ?> /><label for="other">&nbsp;&nbsp;OTHER<span></span></label>&nbsp;&nbsp;<input type="text" name="other-type" size="10" id="other-type" value="<?php echo $this->input->post('other-type'); ?>">&nbsp;( Fill for 'OTHER' type )
								</div>
							</div>
	          			</div>
	          			<div class="col-sm-12" style="height: 0px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<h5 class="modal-info">EXAMINATION RESULTS</h5>
							<!-- <h5 style="text-align: center;"><b><u>TEST RESULTS</u></b></h5> -->
							<div class="col-md-2">
								<label style="color: #28B463;" for="physicalExamination" class="control-label">Physical Test</label>
							</div>
							<!-- <div class="col-md-10"> -->
								<!-- <label for="typeOfExamination" class="control-label">Physical Test</label> -->
							<div class="col-md-2">
								<input class="control-label" type="radio" name="physicalExamination" value="Normal"<?php if($this->input->post('physicalExamination') == 'Normal') { echo ' checked'; } ?> /><label for="normal">&nbsp;Normal<span></span></label>
							</div>
							<div class="col-md-6">
								<input class="control-label" type="radio" name="physicalExamination" value="Abnormal"<?php if($this->input->post('physicalExamination') == 'Abnormal') { echo ' checked'; } ?> /><label for="abnormal">&nbsp;Abnormal<span></span></label><!-- <input type="text" name="other-physical" size="15" id="other-physical" value="<?php //echo $this->input->post('other-physical'); ?>">&nbsp;( Fill for 'Abnormal' Physical Test Result) -->
							<!-- </div>
							<div class="col-md-4"> -->
								( Fill for 'Abnormal' Physical Test Result Below )
								<textarea name="abnormalPhysical" rows="1" class="form-control" id="abnormalPhysical"><?php echo $this->input->post('abnormalPhysical'); ?></textarea>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="physicalExamination" value="Not Performed"<?php if($this->input->post('physicalExamination') == 'Not Performed') { echo ' checked'; } ?> /><label for="not-performed">&nbsp;Not Performed<span></span></label>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
	          				<div class="col-md-2">
								<label style="color: #28B463;" for="chestXray" class="control-label">Chest X-Ray Test</label>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="chestXray" value="Normal"<?php if($this->input->post('chestXray') == 'Normal') { echo ' checked'; } ?> /><label for="normal">&nbsp;Normal<span></span></label>
							</div>
							<div class="col-md-6">
								<input class="control-label" type="radio" name="chestXray" value="Abnormal"<?php if($this->input->post('chestXray') == 'Abnormal') { echo ' checked'; } ?> /><label for="abnormal">&nbsp;Abnormal<span></span></label>
							<!-- </div>
							<div class="col-md-4"> -->
								( Fill for 'Abnormal' Chest X-Ray Test Result Below )
								<textarea name="abnormalChestXray" rows="1" class="form-control" id="abnormalChestXray"><?php echo $this->input->post('abnormalChestXray'); ?></textarea>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="chestXray" value="Not Performed"<?php if($this->input->post('chestXray') == 'Not Performed') { echo ' checked'; } ?> /><label for="not-performed">&nbsp;Not Performed<span></span></label>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label style="color: #28B463;" for="breathingTest" class="control-label">Breathing Test</label>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="breathingTest" value="Normal"<?php if($this->input->post('breathingTest') == 'Normal') { echo ' checked'; } ?> /><label for="normal">&nbsp;Normal<span></span></label>
							</div>
							<div class="col-md-6">
								<input class="control-label" type="radio" name="breathingTest" value="Abnormal"<?php if($this->input->post('breathingTest') == 'Abnormal') { echo ' checked'; } ?> /><label for="abnormal">&nbsp;Abnormal<span></span></label>
								( Fill for 'Abnormal' Breathing Test Result Below )
								<textarea name="abnormalBreathing" rows="1" class="form-control" id="abnormalBreathing"><?php echo $this->input->post('abnormalBreathing'); ?></textarea>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="breathingTest" value="Not Performed"<?php if($this->input->post('breathingTest') == 'Not Performed') { echo ' checked'; } ?> /><label for="not-performed">&nbsp;Not Performed<span></span></label>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label style="color: #28B463;" for="testForTuberculosis" class="control-label">Tuberculosis Test</label>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="testForTuberculosis" value="Normal"<?php if($this->input->post('testForTuberculosis') == 'Normal') { echo ' checked'; } ?> /><label for="nornal">&nbsp;Normal<span></span></label>
							</div>
							<div class="col-md-6">
								<input class="control-label" type="radio" name="testForTuberculosis" value="Abnormal"<?php if($this->input->post('testForTuberculosis') == 'Abnormal') { echo ' checked'; } ?> /><label for="abnormal">&nbsp;Abnormal<span></span></label>
								( Fill for 'Abnormal' Tuberculosis Test Result Below )
								<textarea name="abnormalTuberculosis" rows="1" class="form-control" id="abnormalTuberculosis"><?php echo $this->input->post('abnormalTuberculosis'); ?></textarea>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="testForTuberculosis" value="Not Performed"<?php if($this->input->post('testForTuberculosis') == 'Not Performed') { echo ' checked'; } ?> /><label for="not-performed">&nbsp;Not Performed<span></span></label>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label style="color: #28B463;" for="otherTest" class="control-label">Other Test</label><br><input type="text" name="otherTestName" size="15" id="otherTestName" value="<?php echo $this->input->post('otherTestName'); ?>"><br>( Enter 'Other Test' Name )
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="otherTest" value="Normal"<?php if($this->input->post('otherTest') == 'Normal') { echo ' checked'; } ?> /><label for="nornal">&nbsp;Normal<span></span></label>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="control-label" type="radio" name="otherTest" value="Abnormal"<?php if($this->input->post('otherTest') == 'Abnormal') { echo ' checked'; } ?> /><label for="abnormal">&nbsp;Abnormal<span></span></label>
									( Fill for 'Abnormal' Other Test Result Below )
									<textarea name="abnormalOther" rows="1" class="form-control" id="abnormalOther"><?php echo $this->input->post('abnormalOther'); ?></textarea>
								</div>
							</div>
							<div class="col-md-2">
								<input class="control-label" type="radio" name="otherTest" value="Not Performed"<?php if($this->input->post('otherTest') == 'Not Performed') { echo ' checked'; } ?> /><label for="not-performed">&nbsp;Not Performed<span></span></label>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label style="color: #28B463;" for="otherTest" class="control-label">Health Risk</label>
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<input type="checkbox" id="risk" name="risk" value="YES" /><span></span> Your health may be at increased RISK from exposure to respirable crystalline silica due to the following:<br>
									<textarea name="causeOfRisk" rows="1" class="form-control" id="causeOfRisk"><?php echo $this->input->post('causeOfRisk'); ?></textarea>
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">

						</div> -->
					</div>
				</div>
	          	<div class="box-footer">
	            	<button type="submit" name="rc_exam_submit" id="rc_exam_submit" value="rc_exam_submit" class="btn btn-success">ADD</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="cancel_rc_exam" value="cancel_rc_exam" class="btn btn-warning">CANCEL</button>
	          	</div>
	            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>