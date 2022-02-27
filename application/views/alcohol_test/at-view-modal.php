<div id="viewAtModal" class="modal">
    <div class="modal-dialog" style="width: 900px !important; display: block; padding: 30px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">ALCOHOL TEST</h4>
            </div>
            <div class="row modal-body" style="padding: 30px 45px 30px 45px;">
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
								<label for="signature" class="control-label">Name(Signature):</label>
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
							<!-- <div class="col-md-6">
								<div class="sp-wrapper">
  									<canvas id="worker-signature-pad" class="signature-pad" width=350 height=100></canvas>
								</div>
							</div>
							<div style="padding-top: 35px;" class="col-md-3">
								<button id="clear-signature">Clear Signature</button>
							</div> -->
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="workerName" class="control-label">Name (Printed):</label>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['workerName'] ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						
						<?php
							if($at['siteNotInList'] != 'YES') {
						?>
	          			<div class="col-sm-12">
							<div class="col-md-2">
								<label for="siteId" class="control-label">Company:</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<?php 
										foreach($all_companies as $sc)
										{
											if($sc['id'] == $at['contractorId']) {
												echo '<p style="color: navy; font-size: 120%; font-family: Courier New;">' . $sc['companyName'] . '</p>';
											}
										} 
									?>
								</div>
							</div>
							<div class="col-md-2">
								<label for="date" class="control-label">Date:</label>
							</div>
							<div class="col-md-">
								<div class="form-group">
									<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['date'] ?></p>
								</div>
							</div>
	          			</div>
						<?php
						}
						
							if($at['siteNotInList'] == 'YES') {
						
						?>
							<div class="col-sm-12">
								<div class="col-md-4">
									<label>Site Name</label>
									<div class="form-group">
										<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['otherSiteName'] ?></p>
									</div>
								</div>
								<div class="col-md-3">
									<label>Contact Name</label>
									<div class="form-group">
										<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['otherSiteContactName'] ?></p>
									</div>
								</div>
								<div class="col-md-2">
									<label>Phone Number</label>
									<div class="form-group">
										<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['otherSitePhone'] ?></p>
									</div>
								</div>
								<div class="col-md-3">
									<label>Email</label>
									<div class="form-group">
										<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['otherSiteEmail'] ?></p>
									</div>
								</div>
							</div>
						<?php
							}
						?>
						
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
								<label for="donor" class="control-label">Donor:</label>
	          				</div>
	          				<div class="col-sm-5">
								<div class="form-group">
									<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['donor'] ?></p>
								</div>
							</div>
							<div class="col-md-1">
								<label for="identificationId" class="control-label">ID:</label>
	          				</div>
	          				<div class="col-sm-4">
								<div class="form-group">
									<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['identificationId'] ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label for="subcontractorId" class="control-label">Employer:</label>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<?php 
										foreach($all_scs as $sc)
										{
											if($sc['id'] == $at['subcontractorId']) {
												echo '<p style="color: navy; font-size: 120%; font-family: Courier New;">' . $sc['companyName'] . '</p>';
											}
										} 
									?>
								</div>
							</div>
							<div class="col-md-1">
								<label for="der" class="control-label">DER:</label>
	          				</div>
							<div class="col-md-4">
								<div class="form-group">
									<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['der'] ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-md-2">
								<label for="isPrevious" class="control-label">Previous :</label>
							</div>
							<div class="col-md-4">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?php if($at['isPrevious'] != null) { echo $at['isPrevious']; } else { echo 'NO'; } ?></p>
							</div>
							<div class="col-md-2">
								<label for="cardNumber" class="control-label">Card Number :</label>
							</div>
							<div class="col-md-4">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['cardNumber']; ?></p>
							</div>
						</div>
						<div class="col-sm-12">
	          				<div class="col-md-2">
								<label for="reason" class="control-label">Reason:</label>
							</div>
							<div class="col-md-5">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['reason']; ?></p>
							</div>
						</div>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label for="testType" class="control-label">Test Type:</label>
							</div>
							<div class="col-md-10">
								
							</div>
						</div>
							<?php
							
								if($at['isTT1'] == 'YES') {
							
							?>
						<div class="col-sm-12">
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<p style="color: navy; font-size: 120%; font-family: Courier New;">Non-DOT Panel Instant <h5><?= $at['tt1Id']; ?></h5></p>
							</div>
							<div class="col-md-1">
								<label>Lot #</label>
							</div>
							<div class="col-md-1">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt1']; ?></p>
							</div>
							<div class="col-md-2">
								<label>Expire Date</label>
							</div>
							<div class="col-md-3">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt1ExpDate']; ?></p>
							</div>
						</div>
							<?php

								}

								if($at['isTT2'] == 'YES') {
							
							?>
						<div class="col-sm-12">
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<p style="color: navy; font-size: 120%; font-family: Courier New;">Oxy Dip</p>
							</div>
							<div class="col-md-1">
								<label>Lot #</label>
							</div>
							<div class="col-md-1">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt2']; ?></p>
							</div>
							<div class="col-md-2">
								<label>Expire Date</label>
							</div>
							<div class="col-md-3">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt2ExpDate']; ?></p>
							</div>
						</div>
							<?php

								}

								if($at['isTT3'] == 'YES') {
							
							?>
						<div class="col-sm-12">
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<p style="color: navy; font-size: 120%; font-family: Courier New;">Fentanyl Dip</p>
							</div>
							<div class="col-md-1">
								<label>Lot #</label>
							</div>
							<div class="col-md-1">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt3']; ?></p>
							</div>
							<div class="col-md-2">
								<label>Expire Date</label>
							</div>
							<div class="col-md-3">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt3ExpDate']; ?></p>
							</div>
						</div>
							<?php

								}

								if($at['isTT4'] == 'YES') {
							
							?>
						<div class="col-sm-12">
							<div class="col-md-1">
								
							</div>
							<div class="col-md-4">
								<p style="color: navy; font-size: 120%; font-family: Courier New;">Alcohol Screen 02</p>
							</div>
							<div class="col-md-1">
								<label>Lot #</label>
							</div>
							<div class="col-md-1">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt4']; ?></p>
							</div>
							<div class="col-md-2">
								<label>Expire Date</label>
							</div>
							<div class="col-md-3">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['tt4ExpDate']; ?></p>
							</div>
						</div>
							<?php

								}

							?>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div class="col-sm-12">
	          				<div class="col-md-2">
								<label for="testResult" class="control-label">Test Result:</label>
							</div>
							<div class="col-md-6">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?php echo $at['testResult']; ?></p>
							</div>
						</div>
						<?php
						//if($at['testResult'] == 'Inconclusive; Sent for further testing') {
						?>
						<!-- <div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div id="inconclusive-div" class="col-sm-12">
	          				<div class="col-md-2">
								
							</div>
							<div class="col-md-4">
								&nbsp;&nbsp;<span style="color: navy; font-size: 120%; font-family: Courier New;"><?php //echo $at['specimenId']; ?></span>
							</div>
							<div class="col-md-6">
								<b>Inconclusive Details</b>&nbsp;&nbsp;<span style="color: navy; font-size: 120%; font-family: Courier New;"><?php //echo  $at['inconclusiveDetails']; ?></span>
							</div>
						</div> -->
						<?php
						//}
						?>
						<?php
						if($this->input->post('testResult') != 'Negative' && $this->input->post('testResult') != 'Refused To Test') {
						?>
						<div class="col-sm-12" style="height: 5px;">
	          			</div>
						<div id="at-inconclusive-div" class="col-sm-12">
	          				<div class="col-md-2">
								
							</div>
							<div class="col-md-4">
								<b>Specimen ID</b>&nbsp;&nbsp;<span style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['specimenId']; ?></span>
							</div>
							<div class="col-md-6">
								<b>Test Details</b>&nbsp;&nbsp;<span style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['inconclusiveDetails']; ?></span>
							</div>
						</div>
						<?php
						}
						?>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-2">
								<label for="comments" class="control-label">Comments:</label>
							</div>
							<div class="col-md-10">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['comments']; ?></p>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
	          				<div class="col-md-3">
								<label for="collectionDate" class="control-label">Collection Date:</label>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['collectionDate']; ?></p>
								</div>
							</div>
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="collectionSite" class="control-label">Collection Site:</label>
							</div>
							<div class="col-md-9">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= ($at['collectionSite']) ? $at['collectionSite'] : $worker['site']['siteName'] . ', ' . $worker['site']['city'] . ', ' . $worker['site']['state']; ?></p>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="collector" class="control-label">Collector:</label>
							</div>
							<div class="col-md-9">
								<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $at['collector']; ?></p>
							</div>
						</div>
						<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="collectorSignature" class="control-label">Collector Signature:</label>
								<input type="hidden" name="collectorSignature" id="collectorSignature" />
							</div>
							<div class="col-md-9">
								<?php
									if($at['collectorSignature']) {
								?>
								<img src="<?php echo site_url('resources/signatures/'. $at['collectorSignature']); ?>" style="width: 175px; height: 50px;" alt="Collector Signature">
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
            </div>
                <div class="box-footer">
                    <button type="submit" id="close_at_view" name="close_at_view" value="close_at_view" class="btn btn-warning">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
