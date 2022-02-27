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
<html style="padding-bottom: 0px;">

	<head>
	
		<title></title>

	</head>

	<body style="padding-bottom: 0px;">
		<div style="align-content: center; padding-bottom: 0px;">
			<table style="width:100%;">
				<tr>
					<td style="width: 100%; text-align: center;">
						<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="150" width="150">
						<br>
          				<h4 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 105%;"><b><?= strtoupper($worker['site']['assigningCompanyName']); ?></b></h4>
          				<h5 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 100%;"><b><?= strtoupper($worker['site']['siteName'] . ' - ' . $worker['site']['city'] . ', ' . $worker['site']['state']); ?></b></h5>
          				<br>
          				<br>
          				<h5 style="font-family: Times New Roman; font-stretch: ultra-condensed; font-size: 90%;">
          					CONSENT FOR URINE ANALYSIS FOR THE<br>
          					PURPOSES OF DRUG TESTING AND<br>
          					CONSENT FOR THE RELEASE OF INFORMATION<br><br>
          				</h5>
          				<br>
          				<br>
					</td>
				</tr>
                <tr>
					<td style="width: 100%; font-size: 110%; text-align: justify;">
						<p style="font-family:candara;">I understand that testing for illegal drug use is required by my Employer, Prospective Employer, Project Manager, Safety Manager, Director of Safety or other supervisory personnel as a part of comprehensive safety program.</p>
						<br>
						<p style="font-family:candara;">As such,</p>
						<br>
						<p style="font-family:candara;">I hereby consent to the collection of my urine by <b>OHS Training & Consulting</b> for the purpose of drug testing and for the specimen to be further tested by the drug testing laboratories as necessary to complete analysis required by my Employer, Prospective Employer, Project Manager, Safety Manager, Director of Safety or other supervisory personnel.</p>
						<br>
						<p style="font-family:candara;">I release and discharge <b>OHS Training & Consulting</b>, it's officers, and agents from any claim or liability arising from the use of such test for any decision concerning employment based on the results of such a test.</p>
						<br>
						<p style="font-family:candara;">I understand that the results of this test is shared with <?= $worker['site']['assigningCompanyName']; ?> Safety Department, and that signing this document is consent to both the collection of the urine and the release of the results to <?= $worker['site']['assigningCompanyName']; ?>.</p>
						<br>
						<br>
						<br>
					</td>
				</tr>
			</table>
			<br>
			<table style="width:100%;">
				<tr>
					<td style="width: 25%; float:left; text-align: left;">
						<p style="font-size: 120%;">Name(Signature):</p>
					</td>
					<td style="width: 45%; text-align: left;">
						<?php
							if($ds['signature']) {
						?>
						<!-- <img src="<?php //echo site_url('resources/signatures/'. $ds['signature']); ?>" style="width: 175px; height: 50px;" alt="Worker Signature"> -->
						<img src="<?php echo site_url('resources/signatures/'. $ds['signature']); ?>" alt="Worker Signature">
						<?php
							}
						?>
					</td>
					<td style="width:10%; text-align: left;">
						
					</td>
					<td style="width:25%; text-align: right;">
						
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 25%; float:left; text-align: left;">
						<p style="font-size: 120%;">Name (Printed):</p>
					</td>
					<td style="width: 45%; text-align: left;">
						<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $ds['workerName'] ?></p>
					</td>
					<td style="width:10%; text-align: left;">
						
					</td>
					<td style="width:25%; text-align: right;">
						
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 25%; float:left; text-align: left;">
						<p style="font-size: 120%;">Company:</p>
					</td>
					<td style="width: 45%; text-align: left;">
						<?php 
							foreach($all_companies as $sc)
							{
								if($sc['id'] == $ds['contractorId']) {
									echo '<p style="color: navy; font-size: 120%; font-family: Courier New;">' . $sc['companyName'] . '</p>';
								}
							} 
						?>
					</td>
					<td style="width:10%; text-align: left;">
						<p style="font-size: 120%;">Date:</p>
					</td>
					<td style="width:25%; text-align: right;">
						<p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $ds['date'] ?></p>
					</td>
				</tr>
			</table>
		</div>
		<pagebreak>
		<div style="align-content: center; padding-bottom: 0px;">
			<table style="width:100%;">
				<tr>
					<td style="width: 100%; text-align: center;">
						<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="150" width="150">
						<br>
          				<h3 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 115%;"><b><?= strtoupper($worker['site']['assigningCompanyName']); ?></b></h3>
          				<h4 style="font-family: Tahoma, Sans-Serif; font-stretch: expanded; font-size: 105%;"><b><?= strtoupper($worker['site']['siteName'] . ' - ' . $worker['site']['city'] . ', ' . $worker['site']['state']); ?></b></h4>
          				<br>
          				<br>
					</td>
				</tr>
                <tr>
					<td>
						<br>
					</td>
				</tr>
			</table>
			<br>
			<table style="width:100%;">
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Donor:</p>
					</td>
					<td style="width: 40%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['donor'] ?></p>
					</td>
					<td style="width:20%; text-align: left;">
						<p style="font-size: 110%;">ID:</p>
					</td>
					<td style="width:25%; text-align: right;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['identificationId'] ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Employer:</p>
					</td>
					<td style="width: 40%; text-align: left;">
						<?php 
							foreach($all_companies as $sc)
							{
								if($sc['id'] == $ds['contractorId']) {
									echo '<p style="color: navy; font-size: 110%; font-family: Courier New;">' . $sc['companyName'] . '</p>';
								}
							} 
						?>
					</td>
					<td style="width:20%; text-align: left;">
						<p style="font-size: 110%;">DER:</p>
					</td>
					<td style="width:25%; text-align: right;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['der'] ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Previous:</p>
					</td>
					<td style="width: 40%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?php if($ds['isPrevious'] != null) { echo $ds['isPrevious']; } else { echo 'NO'; } ?></p>
					</td>
					<td style="width:20%; text-align: left;">
						<p style="font-size: 110%;">Card #:</p>
					</td>
					<td style="width:25%; text-align: right;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['cardNumber'] ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Reason:</p>
					</td>
					<td style="width: 40%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['reason'] ?></p>
					</td>
					<td style="width:20%; text-align: left;">
						
					</td>
					<td style="width:25%; text-align: right;">
						
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Test Type:</p>
					</td>
					<td style="width: 40%; text-align: left;">
						
					</td>
					<td style="width:20%; text-align: left;">
						
					</td>
					<td style="width:25%; text-align: right;">
						
					</td>
				</tr>
				<?php
							
					if($ds['isTT1'] == 'YES') {
				
				?>
				<!-- <tr>
					<td colspan="4">
						<br>
					</td>
				</tr> -->
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						
					</td>
					<td style="width: 40%; text-align: left;">
						<p style="color: navy; font-size: 90%; font-family: Courier New;">Non-DOT Panel Instant&nbsp;<?= $ds['tt1Id']; ?></p>
					</td>
					<td style="width:20%; text-align: left;">
						<p style="font-size: 90%;">Lot#&nbsp;<span style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['tt1']; ?></span></p>
					</td>
					<td style="width:25%; text-align: left;">
						<p style="font-size: 90%;">Exp. Date&nbsp;<span style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['tt1ExpDate']; ?></span></p>
					</td>
				</tr>
				<?php
							
					}
				
				?>
				<?php
							
					if($ds['isTT2'] == 'YES') {
				
				?>
				<!-- <tr>
					<td colspan="4">
						<br>
					</td>
				</tr> -->
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						
					</td>
					<td style="width: 40%; text-align: left;">
						<p style="color: navy; font-size: 90%; font-family: Courier New;">Oxy Dip</p>
					</td>
					<td style="width:20%; text-align: left;">
						<p style="font-size: 90%;">Lot#&nbsp;<span style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['tt2']; ?></span></p>
					</td>
					<td style="width:25%; text-align: left;">
						<p style="font-size: 90%;">Exp. Date&nbsp;<span style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['tt2ExpDate']; ?></span></p>
					</td>
				</tr>
				<?php
							
					}
				
				?>
				<?php
							
					if($ds['isTT3'] == 'YES') {
				
				?>
				<!-- <tr>
					<td colspan="4">
						<br>
					</td>
				</tr> -->
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						
					</td>
					<td style="width: 40%; text-align: left;">
						<p style="color: navy; font-size: 90%; font-family: Courier New;">Fentanyl Dip</p>
					</td>
					<td style="width:20%; text-align: left;">
						<p style="font-size: 90%;">Lot #&nbsp;<span style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['tt3']; ?></span></p>
					</td>
					<td style="width:25%; text-align: left;">
						<p style="font-size: 90%;">Exp. Date&nbsp;<span style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['tt3ExpDate']; ?></span></p>
					</td>
				</tr>
				<?php
							
					}
				
				?>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Test Result:</p>
					</td>
					<td colspan="2" style="width: 60%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?php if($ds['testResult'] == 'FAR') { echo 'Not cleared for work'; } else { echo $ds['testResult']; } ?></p>
					</td>
					<td style="width:25%; text-align: right;">
						
					</td>
				</tr>
				<?php
							
					if($ds['testResult'] == 'Inconclusive; Cleared' || $ds['testResult'] == 'FAR' || $ds['testResult'] == 'Inconclusive; Sent for further testing') {
				
				?>
				<tr>
					<td colspan="4">
						<table style="width: 100%;">
							<tr>
								<td style="width: 10%; text-align: left;">
									
								</td>
								<td style="width: 15%; text-align: left;">
									<p style="font-size: 90%;">Specimen #</p>
								</td>
								<td style="width: 10%; text-align: left;">
									<p style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['specimenId']; ?></p>
								</td>
								<td style="width: 20%; text-align: left;">
									<p style="font-size: 90%;">Inconclusive Details:</p>
								</td>
								<td style="width: 45%; text-align: left;">
									<p style="color: navy; font-size: 90%; font-family: Courier New;"><?= $ds['inconclusiveDetails']; ?></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
							
					}
				
				?>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 15%; float:left; text-align: left;">
						<p style="font-size: 110%;">Comments:</p>
					</td>
					<td colspan="3" style="width: 85%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['comments']; ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<br>
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td style="width: 35%; float:left; text-align: left;">
						<p style="font-size: 110%;">Collection Date:</p>
					</td>
					<td style="width: 65%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['collectionDate']; ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 35%; float:left; text-align: left;">
						<p style="font-size: 110%;">Collection Site:</p>
					</td>
					<td style="width: 65%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['collectionSite']; ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 35%; float:left; text-align: left;">
						<p style="font-size: 110%;">Collector Name:</p>
					</td>
					<td style="width: 65%; text-align: left;">
						<p style="color: navy; font-size: 110%; font-family: Courier New;"><?= $ds['collector']; ?></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<br>
					</td>
				</tr>
				<tr>
					<td style="width: 35%; float:left; text-align: left;">
						<p style="font-size: 110%;">Collector's Signature:</p>
					</td>
					<td style="width: 65%; text-align: left;">
						<?php
							if($ds['collectorSignature']) {
						?>
						<img src="<?php echo site_url('resources/signatures/'. $ds['collectorSignature']); ?>" alt="Collector Signature">
						<?php
							}
						?>
					</td>
				</tr>
			</table>
		</div>
	</body>

</html>