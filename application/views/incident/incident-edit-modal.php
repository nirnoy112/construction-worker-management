<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="editIncidentModal" class="modal">
    <div class="modal-dialog" style="width: 75%; display: block; padding: 30px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">EDIT INCIDENT</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 25px 0px 25px;">
                <?php echo form_open(''); ?>
                <input type="hidden" name="iId" value="<?= $iId; ?>" id="iId" />
                <input type="hidden" name="incident[workerId]" value="<?= $incident['workerId']; ?>" id="workerId" />
                <input type="hidden" name="incident[CreatingUserId]" value="<?= $incident['CreatingUserId']; ?>" id="CreatingUserId" />
	          	<div class="box-body">
	          		<div class="row clearfix">
	          			<div class="col-sm-12">
	          				<div class="col-sm-1">
	          					<label for="date" class="control-label">DATE</label>
	          				</div>
	          				<div class="col-sm-2">
	          					<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="date" type="text" name="incident[date]" value="<?= $incident['date']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
	          				</div>
	          				<div class="col-sm-2">
	          					<label for="ohsStaffId" class="control-label">OHS STAFF</label>
	          				</div>
	          				<div class="col-sm-3">
	          					<div class="form-group">
	          						<select name="incident[ohsStaffId]" class="form-control">
										<?php

										if($user_session['roleId'] == 1) {

										?>
										<option value="0">NONE</option>

										<?php

											foreach($staff as $su)
											{
												$selected = ($su['id'] == $incident['ohsStaffId']) ? ' selected="selected"' : "";

												echo '<option value="'.$su['id'].'"' . $selected .'>'.$su['username'].'( '.$su['fullName'].' )'.'</option>';
											}

										} else {

											//$selected = ($su['id'] == $incident['ohsStaffId']) ? ' selected="selected"' : "";

											echo '<option value="'.$user_session['id'].'">'.$user_session['username'].'( '.$su['realName'].' )'.'</option>';

										}

										?>
									</select>
								</div>
	          				</div>
	          				<div class="col-sm-1">
	          					<label for="siteId" class="control-label">SITE</label>
	          				</div>
	          				<div class="col-sm-3">
	          					<div class="form-group">
		          					<select  id="site-id" name="incident[siteId]" class="form-control">
										<option value="0">NONE</option>
										<?php 
										foreach($all_sites as $site)
										{
											$al2 = '';
											if($site['city']) { $al2 .= $site['city'] . ', ' ; }
											if($site['state']) { $al2 .= $site['state'] . ' '; }
											if($site['zipCode']) { $al2 .= $site['zipCode'] . '.'; }
											$siteDetails = $site['id'] . '|'.$site['siteName'] . '|'.$site['address1'] . '|'.$al2;

											$selected = ($site['id'] == $incident['siteId']) ? ' selected="selected"' : "";

											echo '<option value="'.$siteDetails.'"' . $selected .'>'.$site['siteName'].'</option>';
										} 
										?>
									</select>
								</div>
	          				</div>
	          			</div>
	          			<div class="col-sm-12">
	          				<div class="col-sm-2">
	          					<label for="type" class="control-label">INCIDENT TYPE</label>
	          				</div>
	          				<div class="col-sm-3">
	          					<div class="form-group">
	          						<select name="incident[type]" id="in-type" class="form-control">
	          							<option value="FIRST AID" <?php if($incident['type'] == 'FIRST AID') { echo ' selected="selected"'; } ?>>FIRST AID ADMINISTRATION</option>
	          							<option value="VACCINATION" <?php if($incident['type'] == 'VACCINATION') { echo ' selected="selected"'; } ?>>VACCINATION</option>
									</select>
								</div>
	          				</div>
	          				<div class="col-sm-3">
	          					<label for="service" class="control-label">PROVIDED SERVICE</label>
	          				</div>
	          				<div id="fa-opts" class="col-sm-4">
	          					<div class="form-group">
	          						<select name="incident[service]" class="form-control">
										<?php

											foreach($first_aids as $fa)
											{
												$selected = ($fa['title'] == $incident['service']) ? ' selected="selected"' : "";

												echo '<option value="'.$fa['title'].'"' . $selected .'>'.$fa['title'].'</option>';

											}

										?>
									</select>
								</div>
	          				</div>
	          				<div id="v-opts" class="col-sm-4">
	          					<div class="form-group">
	          						<select name="incident[service]" class="form-control">
										<?php

											foreach($vaccinations as $v)
											{
												$selected = ($v['title'] == $incident['service']) ? ' selected="selected"' : "";

												echo '<option value="'.$v['title'].'"' . $selected .'>'.$v['title'].'</option>';

											}

										?>
									</select>
								</div>
	          				</div>
	          			</div>
	          			<div class="col-sm-12" style="min-height: 20px;"></div>
	          			<h5 style="text-align: center;">INVENTORY USAGE</h5>
	          			<div style="text-align: left;" class="col-sm-5">
	          				<div class="col-md-12">
	          					<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="120" width="120">
	          					<h4>OHS Training & Consulting, Inc.</h4>
	          					<h5>9 Faunbar Ave</h5>
	          					<h5>Suite #2</h5>
	          					<h5>Winthrop, MA 02152</h5>
	          					<h5>617-846-5059</h5>
	          				</div>
	          			</div>
	          			<div class="col-sm-2">
	          				
	          			</div>
	          			<div style="text-align: left;" class="col-sm-5">
	          				<h3><i>INVENTORY USAGE BY INCIDENT</i></h3>
	          				<br>
	          				<br>
	          				<div class="col-md-4">
	          					<label for="msLocation" class="control-label">Location</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="incident[msLocation]" class="form-control" id="msLocation" value="<?= $incident['msLocation']; ?>" />
								</div>
	          				</div>
	          				<div class="col-md-4">
	          					<label for="msDate" class="control-label">Date</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="msDate" type="text" name="incident[msDate]" value="<?= $incident['msDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
	          				<div class="col-md-4">
	          					<label for="msAddressLine1" class="control-label">Address</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="incident[msAddressLine1]" class="form-control" id="msAddressLine1" value="<?= $incident['msAddressLine1']; ?>" />
								</div>
							</div>
							<div class="col-md-4">
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="incident[msAddressLine2]" class="form-control" id="msAddressLine2" value="<?= $incident['msAddressLine2']; ?>" />
								</div>
							</div>
	          			</div>
	          			<div class="col-sm-12">
	          				<hr>
	          			</div>
	          			<div class="col-md-12">
	          				<table class="table table-striped">
			                    <tr>
									<th style="width: 30%;">SUPPLY ITEM DESCRIPTION</th>
									<th style="width: 8%;">___</th>
									<th style="width: 10%;">QUANTITY</th>
									<th style="width: 8%;">___</th>
									<th style="width: 16%;">UNIT PRICE</th>
									<th style="width: 8%;">___</th>
									<th style="width: 20%;">LINE TOTAL</th>
			                    </tr>
			                    <?php

			                    	$counter = 0;

			                    	foreach($medical_supplies as $ms){ ?>
			                    <tr>
									
									<td><code><?= $ms->description; ?></code><input type="hidden" name="ms[<?= $counter ?>][description]" value="<?php echo $ms->description; ?>" id="ms-description-<?= $counter; ?>" /></td>
									<th style="width: 8%;"></th>
									<td><input type="text" name="ms[<?= $counter ?>][quantity]" value="<?php echo $ms->quantity; ?>" size="6" class="form-control" id="ms-quantity-<?= $counter; ?>" /></td>
									<th style="width: 8%;"></th>
			                        <td><input type="text" name="ms[<?= $counter ?>][unitPrice]" value="<?= sprintf("%.2f", $ms->unitPrice); ?>" size="6" class="form-control" id="ms-unitPrice-<?= $counter; ?>" /></td>
									<th style="width: 8%;"></th>
			                        <td><input type="text" name="ms[<?= $counter ?>][lineTotal]" value="<?= sprintf("%.2f", $ms->lineTotal); ?>" size="8" class="form-control" id="ms-lineTotal-<?= $counter; ?>" /></td>
			                    </tr>
			                    <?php
			                    		$counter = $counter + 1;

			                		}

			                	?>
			                    <tr>
									<td colspan="6" style="text-align: right;"><b>TOTAL</b></td>
			                        <td><input type="text" name="incident[msTotal]" value="<?= sprintf("%.2f", $incident['msTotal']); ?>" class="form-control" id="msTotal" /></td>
			                    </tr>
			                </table>
	          			</div>
					</div>
				</div>
			</div>
	          	<div class="box-footer">
	            	<button type="submit" name="update_incident" id="update_incident" value="update_incident" class="btn btn-success">SAVE</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="cancel_update_incident" name="cancel_update_incident" value="cancel_update_incident" class="btn btn-warning">CANCEL</button>
	          	</div>
	            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>