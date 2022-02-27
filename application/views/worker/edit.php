<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3  style="color: #ffffff;" class="box-title">EDIT WORKER</h3>
            </div>
			<?php echo form_open('worker/edit/' . $worker['id'], array("name"=>"ew-form", "id"=>"ewForm", "method"=>"post", "enctype"=>"multipart/form-data")); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-sm-12" style="padding: 10px;">
						<div class="col-sm-6" style="float: right;">
							<button type="submit" name="print_sticker" id="print_sticker" class="btn btn-success btn-lg">
								<i class="fa fa-bars"></i> Print Barcode
							</button><span></span>
							<button type="submit" name="print_qrcode" id="print_qrcode" class="btn btn-success btn-lg">
								<i class="fa fa-bars"></i> Print QR Code
							</button><span></span>
							<button type="submit" name="print_card" id="print_card" class="btn btn-success btn-lg">
								<i class="fa fa-id-card"></i> Print Card
							</button>
						</div>
					</div>
					<div class="col-sm-12" style="min-height: 5px;">
					</div>
					<div class="col-sm-12">
						<div class="col-sm-2">
							<label for="pictureFile">Worker's Picture</label>
						</div>
						<div class="col-sm-10"></div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-2">
						</div>
						<div class="col-sm-5">
							<h4 style="text-align: center;">UPLOAD PICTURE USING WEBCAM</h4>
						</div>
						<div class="col-sm-5">
							<h4 style="text-align: center;">UPLOAD PICTURE FROM COMPUTER</h4>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-sm-3">
							<div id="profile_picture">
								<input type="hidden" name="default_picture" id="default_picture" value="<?php echo site_url('resources/img/user_default.png');?>">
							<?php

								if($worker['imageURI']) {

							?>

									<img src="<?php echo $worker['imageURI']; ?>" style="height: 120px; width: 100px;" alt="Worker Image">
									<input type="hidden" name="dp_user_id" id="dp_user_id">
									<input type="hidden" name="wdp_api_url" id="wdp_api_url" value="<?= site_url('worker/delete_picture?id=' . $worker['id']); ?>">
									<div class="col-sm-12" style="height: 5px;"></div>
									<br>
									<a style="width: 100px;" class="btn btn-xs btn-warning" id="w_delete_picture" name="w_delete_picture" href="#">Delete Picture</a>

							<?php

								} else {

							?>

									<img src="<?php echo site_url('resources/img/user_default.png');?>" style="height: 120px; width: 100px;" alt="Worker Image">

							<?php

								}
							?>
							</div>

							<div style="min-height: 10px;"></div>

							<div id="results" ></div>

							<br>

							<input type="hidden" name="wsp_api_url" id="wsp_api_url" value="<?= site_url('worker/save_picture?id=' . $worker['id']); ?>">

							<div style=" padding-left: 20px; text-align: center;">
								<input type="button" id="save_snapshot" value="Save">
							</div>

							<input type="hidden" id="pictureDataURI" name="pictureDataURI" value="">
						</div>
						<div class="col-sm-4">
							
							
							<div id="ohs_webcam" style="height: 240px; width: 200px; align-content: center; border: 0.5px solid skyblue;">
								<div style="padding-top: 90px; text-align: center;">
									<a name="capture_picture" id="capture_picture" class="btn btn-info" href="">
										<i class="fa fa-camera-retro"></i> CAPTURE PICTURE
									</a>
								</div>
							</div>

							<br>

							<div style=" padding-left: 40px; text-align: center;"><input type="button" id="take_snapshot" value="Take Snapshot"></div>

							
							
							<!-- <button name="take_snapshot" id="take_snapshot" class="btn btn-info btn-lg">
								<i class="fa fa-camera-retro"></i> TAKE SNAPSHOT
							</button> -->

							<br>
							<br>
						</div>
						<div style="padding-top: 20px; height: 240px; border-left: 1px solid #333333;" class="col-sm-5">
							<div class="col-sm-4"><label>Image File</label></div>
							<div class="col-sm-8"><input type="file" id="pictureFile" name="pictureFile"></div>
							<div class="col-sm-12" style="padding-top: 20px; text-align: center;">
								<button type="submit" class="btn btn-sm btn-info" name="upload_image" id="upload_image" disabled="true">Save Picture</button>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">BASIC INFORMATION</h4>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="statusId" class="control-label">Status</label>
							<div class="form-group">
								<select name="statusId" class="form-control">
									<?php 
									foreach($all_user_statuses as $user_status)
									{
										$selected = ($user_status['id'] == $worker['statusId']) ? ' selected="selected"' : "";

										echo '<option value="'.$user_status['id'].'" '.$selected.'>'.$user_status['title'].'</option>';
									} 
									?>
								</select>
							</div>
						</div>
						<input type="hidden" name="generatedUID" value="<?php echo $worker['uid']; ?>"  />
						<div class="col-md-4">
							<label for="uid" class="control-label">UID</label>
							<div class="form-group">
								<input type="text" name="uid" value="<?php echo ($this->input->post('uid') ? $this->input->post('uid') : $worker['uid']); ?>" class="form-control" id="uid" disabled="disabled" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="firstName" class="control-label">First Name<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<input type="text" name="firstName" value="<?php echo ($this->input->post('firstName') ? $this->input->post('firstName') : $worker['firstName']); ?>" class="form-control" id="firstName" />
								<span class="text-danger"><?php echo form_error('firstName');?></span>
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="lastName" class="control-label">Last Name<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<input type="text" name="lastName" value="<?php echo ($this->input->post('lastName') ? $this->input->post('lastName') : $worker['lastName']); ?>" class="form-control" id="lastName" />
								<span class="text-danger"><?php echo form_error('lastName');?></span>
							</div>
						</div>
						<div class="col-md-4">
							<label for="middleName" class="control-label">Middle Name</label>
							<div class="form-group">
								<input type="text" name="middleName" value="<?php echo ($this->input->post('middleName') ? $this->input->post('middleName') : $worker['middleName']); ?>" class="form-control" id="middleName" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="suffix" class="control-label">Suffix</label>
							<div class="form-group">
								<input type="text" name="suffix" value="<?php echo ($this->input->post('suffix') ? $this->input->post('suffix') : $worker['suffix']); ?>" class="form-control" id="suffix" />
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="suffix" class="control-label">Sex<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<input type="radio" name="sex" value="Male" <?php if($worker['sex'] == 'Male') { echo 'checked'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<label for="male">MALE<span></span></label>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="Female" <?php if($worker['sex'] == 'Female') { echo 'checked'; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;<label for="female">FEMALE</label>
								<span class="text-danger"><?php echo form_error('sex');?></span>
							</div>
						</div>
						<div class="col-md-4">
							<label for="dob" class="control-label">Date Of Birth<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<div class="input-group date">
									<input class="form-control" id="dob" type="text" name="dob" value="<?php echo ($this->input->post('dob') ? $this->input->post('dob') : $worker['dob']); ?>" />
									<div class="input-group-addon">
								        <span class="glyphicon glyphicon-th"></span>
									</div>
								</div>
								<span class="text-danger"><?php echo form_error('dob');?></span>
							</div>
						</div>
						<div class="col-md-4">
							<label for="primaryPhone" class="control-label">Primary Phone Number</label>
							<div class="form-group">
								<input type="text" name="primaryPhone" value="<?php echo ($this->input->post('primaryPhone') ? $this->input->post('primaryPhone') : $worker['primaryPhone']); ?>" class="form-control" id="primaryPhone" />
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="secondaryPhone" class="control-label">Secondary Phone Number</label>
							<div class="form-group">
								<input type="text" name="secondaryPhone" value="<?php echo ($this->input->post('secondaryPhone') ? $this->input->post('secondaryPhone') : $worker['secondaryPhone']); ?>" class="form-control" id="secondaryPhone" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="email" class="control-label">Email</label>
							<div class="form-group">
								<input type="text" name="emailAddress" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $worker['email']); ?>" class="form-control" id="email" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="address1" class="control-label">Address #1</label>
							<div class="form-group">
								<input type="text" name="address1" value="<?php echo ($this->input->post('address1') ? $this->input->post('address1') : $worker['address1']); ?>" class="form-control" id="address1" />
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="address2" class="control-label">Address #2</label>
							<div class="form-group">
								<input type="text" name="address2" value="<?php echo ($this->input->post('address2') ? $this->input->post('address2') : $worker['address2']); ?>" class="form-control" id="address2" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="comm_pref" class="control-label">Communication Preference</label>
							<div class="form-group">
								<select id="comm_pref" name="comm_pref" class="form-control">
									<option value="NONE"<?php if($worker['comm_pref'] == null || $worker['comm_pref'] == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
									<option value="SMS"<?php if($worker['comm_pref'] == 'SMS') { echo ' selected="selected"'; } ?>>SMS</option>
									<option value="EMAIL"<?php if($worker['comm_pref'] == 'EMAIL') { echo ' selected="selected"'; } ?>>EMAIL</option>
									<option value="SNAIL MAIL"<?php if($worker['comm_pref'] == 'SNAIL MAIL') { echo ' selected="selected"'; } ?>>SNAIL MAIL</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="city" class="control-label">City</label>
							<div class="form-group">
								<input type="text" name="city" value="<?php echo ($this->input->post('city') ? $this->input->post('city') : $worker['city']); ?>" class="form-control" id="city" />
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="state" class="control-label">State</label>
							<div class="form-group">
								<input type="text" name="state" value="<?php echo ($this->input->post('state') ? $this->input->post('state') : $worker['state']); ?>" class="form-control" id="state" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="zipCode" class="control-label">Zip Code</label>
							<div class="form-group">
								<input type="text" name="zipCode" value="<?php echo ($this->input->post('zipCode') ? $this->input->post('zipCode') : $worker['zipCode']); ?>" class="form-control" id="zipCode" />
							</div>
						</div>
						<div class="col-md-4">
						<label for="jobTitle" class="control-label">Trade<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<select id="worker-trade" name="jobTitle" class="single-searchable-select form-control">
									<option value=""<?php if($worker['jobTitle'] == null || $worker['jobTitle'] == '') { echo ' selected="selected"'; } ?>>NONE</option>
								<?php 
									foreach($user_session['trades'] as $trade)
									{
										$selected = ($trade == $worker['jobTitle']) ? ' selected="selected"' : "";

										echo '<option value="'.$trade.'" '.$selected.'>'.$trade.'</option>';
									}

								?>
									<option value="OTHER" <?php if($worker['jobTitle'] == 'OTHER') { echo ' selected="selected"'; } ?>>OTHER</option>
								</select>
								<span class="text-danger"><?php echo form_error('jobTitle');?></span>
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="otherTrade" class="control-label">Other Trade</label>
							<div class="form-group">
								<input type="text" name="otherTrade" value="<?php echo $worker['otherTrade']; ?>" class="form-control" id="otherTrade" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="identificationType" class="control-label">Identification Type<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<select id="w-id-type" name="identificationType" class="form-control">
									<option value="DRIVER LICENSE" <?php if($worker['identificationType'] == 'DRIVER LICENSE') { echo ' selected="selected"'; } ?>>DRIVER LICENSE</option>
									<option value="STATE IDENTIFICATION" <?php if($worker['identificationType'] == 'STATE IDENTIFICATION') { echo ' selected="selected"'; } ?>>STATE IDENTIFICATION</option>
									<option value="PASSPORT" <?php if($worker['identificationType'] == 'PASSPORT') { echo ' selected="selected"'; } ?>>PASSPORT</option>
									<option value="UNION CARD" <?php if($worker['identificationType'] == 'UNION CARD') { echo ' selected="selected"'; } ?>>UNION CARD</option>
									<option value="OHS BADGE" <?php if($worker['identificationType'] == 'OHS BADGE') { echo ' selected="selected"'; } ?>>OHS BADGE</option>
									<option value="OTHER" <?php if($worker['identificationType'] == 'OTHER') { echo ' selected="selected"'; } ?>>OTHER</option>
								</select>
								<span class="text-danger"><?php echo form_error('identificationType');?></span>
							</div>
						</div>
						<div class="col-md-4">
							<label for="otherIdType" class="control-label">Other Identification Type</label>
							<div class="form-group">
								<input type="text" name="otherIdType" value="<?php echo $worker['otherIdType']; ?>" class="form-control" id="w-otherIdType" />
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="col-md-4">
							<label for="identificationId" class="control-label">Identification ID<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<input type="text" name="identificationId" value="<?php echo ($this->input->post('identificationId') ? $this->input->post('identificationId') : $worker['identificationId']); ?>" class="form-control" id="identificationId" />
								<span class="text-danger"><?php echo form_error('identificationId');?></span>
							</div>
						</div>
						<div class="col-md-4">
							<label for="minority" class="control-label">Minority</label>
							<div class="form-group">
								<select id="worker-minority" name="minority" class="form-control">
									<option value="0" <?php if($worker['minority'] == null || $worker['minority'] == 0) { echo ' selected="selected"'; } ?>>NO</option>
									<option value="1" <?php if($worker['minority'] == 1) { echo ' selected="selected"'; } ?>>YES</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="minorityType" class="control-label">Minority Type</label>
							<div class="form-group">
								<select id="worker-minority-type" name="minorityType" class="form-control">
									<option value="NONE" <?php if($worker['minorityType'] == null || $worker['minorityType'] == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
								<?php 
									foreach($user_session['minority_types'] as $mt)
									{
										$selected = ($mt == $worker['minorityType']) ? ' selected="selected"' : "";

										echo '<option value="'.$mt.'" '.$selected.'>'.$mt.'</option>';
									} 
								?>
								</select>
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="jobRole" class="control-label">Job Role</label>
							<div class="form-group">
								<select id="worker-job-role" name="jobRole" class="form-control">
									<option value="NONE" <?php if($this->input->post('jobRole') == null || $this->input->post('jobRole') == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
								<?php 
									foreach($user_session['job_roles'] as $jr)
									{
										$selected = ($jr == $worker['jobRole']) ? ' selected="selected"' : "";

										echo '<option value="'.$jr.'" '.$selected.'>'.$jr.'</option>';
									} 
								?>
									<option value="OTHER" <?php if($worker['jobRole'] == 'OTHER') { echo ' selected="selected"'; } ?>>OTHER</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="otherJobRole" class="control-label">Other Job Role</label>
							<div class="form-group">
								<input type="text" name="otherJobRole" value="<?php echo $worker['otherJobRole']; ?>" class="form-control" id="otherJobRole" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="jobs" class="control-label">Jobs</label>
							<div class="form-group">
								<textarea name="jobs" class="form-control" id="jobs"><?php echo ($this->input->post('jobs') ? $this->input->post('jobs') : $worker['jobs']); ?></textarea>
							</div>
						</div>
					</div>
          			
          			<div class="col-sm-12">
          				<div class="col-md-4">
							<label for="companyId" class="control-label">Company<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<select name="companyId" class="single-searchable-select form-control">
									<option value="">Other</option>
									<?php 
									foreach($all_companies as $c)
									{
										$selected = ($c['id'] == $this->input->post('companyId') || $c['id'] == $worker['companyId']) ? ' selected="selected"' : "";

										echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['companyName'].'</option>';
									} 
									?>
								</select>
								<span class="text-danger" id="ew-companyId"></span>
							</div>
						</div>
						<div class="col-md-8">
							<br>
							<input type="checkbox" id="companyNotInList" name="companyNotInList" value="YES" <?php if($this->input->post('companyNotInList') == 'YES' || $worker['companyNotInList'] == 'YES') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check for Different Company; If <b>"Company"</b> is other than the enlisted options.</i>
						</div>
          			</div>
          			<div id="other-com" class="col-sm-12">
          				<input type="hidden" name="otherComBy" value="<?= $user_session['username'] . ' (Username: ' . $user_session['realName'] . ')'; ?>">
						<div class="col-md-4">
							Company Name<span class="text-danger"> (required)</span>
							<div class="form-group">
								<input type="text" name="otherCompanyName" value="<?php echo ($this->input->post('otherCompanyName')) ? $this->input->post('otherCompanyName') : $worker['otherCompanyName']; ?>" class="form-control" id="otherCompanyName" />
							<span class="text-danger" id="ew-otherCompanyName"></span>
							</div>
						</div>
						<div class="col-md-3">
							Contact Name
							<div class="form-group">
								<input type="text" name="otherComContactName" value="<?php echo ($this->input->post('otherComContactName')) ? $this->input->post('otherComContactName') : $worker['otherComContactName']; ?>" class="form-control" id="otherComContactName" />
							</div>
						</div>
						<div class="col-md-3">
							Phone Number
							<div class="form-group">
								<input type="text" name="otherComPhone" value="<?php echo ($this->input->post('otherComPhone')) ? $this->input->post('otherComPhone') : $worker['otherComPhone']; ?>" class="form-control" id="otherComPhone" />
							</div>
						</div>
					</div>
					<div class="col-sm-12">
          				<div class="col-md-4">
							<label for="siteIdW" class="control-label">Site<span class="text-danger"> (required)</span></label>
							<div class="form-group">
								<select name="siteIdW" class="single-searchable-select form-control">
									<option value="">Other</option>
									<?php 
									foreach($all_sites as $s)
									{
										$selected = ($s['id'] == $this->input->post('siteIdW') || $s['id'] == $worker['siteIdW']) ? ' selected="selected"' : "";

										echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['siteName'].'</option>';
									} 
									?>
								</select>
								<span class="text-danger" id="ew-siteIdW"></span>
							</div>
						</div>
						<div class="col-md-8">
							<br>
							<input type="checkbox" id="siteNotInList" name="siteNotInList" value="YES" <?php if($this->input->post('siteNotInList') == 'YES' || $worker['siteNotInList'] == 'YES') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check for Different Site; If <b>"Site"</b> is other than the enlisted options.</i>
						</div>
          			</div>
          			<div id="other-site" class="col-sm-12">
          				<input type="hidden" name="otherSiteBy" value="<?= $user_session['username'] . ' (Username: ' . $user_session['realName'] . ')'; ?>">
						<div class="col-md-4">
							Site Name<span class="text-danger"> (required)</span>
							<div class="form-group">
								<input type="text" name="otherSiteName" value="<?php echo ($this->input->post('otherSiteName')) ? $this->input->post('otherSiteName') : $worker['otherSiteName']; ?>" class="form-control" id="otherSiteName" />
							<span class="text-danger" id="ew-otherSiteName"></span>
							</div>
						</div>
						<div class="col-md-3">
							Contact Name
							<div class="form-group">
								<input type="text" name="otherSiteContactName" value="<?php echo ($this->input->post('otherSiteContactName')) ? $this->input->post('otherSiteContactName') : $worker['otherSiteContactName']; ?>" class="form-control" id="otherSiteContactName" />
							</div>
						</div>
						<div class="col-md-2">
							Phone Number
							<div class="form-group">
								<input type="text" name="otherSitePhone" value="<?php echo ($this->input->post('otherSitePhone')) ? $this->input->post('otherSitePhone') : $worker['otherSitePhone']; ?>" class="form-control" id="otherSitePhone" />
							</div>
						</div>
						<div class="col-md-3">
							Email
							<div class="form-group">
								<input type="text" name="otherSiteEmail" value="<?php echo ($this->input->post('otherSiteEmail')) ? $this->input->post('otherSiteEmail') : $worker['otherSiteEmail']; ?>" class="form-control" id="otherSiteEmail" />
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">EMERGENCY CONTACT</h4>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="ecType" class="control-label">Contact Type</label>
							<div class="form-group">
								<select id="worker-ec-type" name="ecType" class="form-control">
									<option value="NONE" <?php if($this->input->post('ecType') == 'NONE' || $worker['ecType'] == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
								<?php 
									foreach($user_session['ec_types'] as $et)
									{
										$selected = ($et == $worker['ecType']) ? ' selected="selected"' : "";

										echo '<option value="'.$et.'" '.$selected.'>'.$et.'</option>';
									}
								?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="ecName" class="control-label">Contact's Name</label>
							<div class="form-group">
								<input type="text" name="ecName" value="<?php echo ($this->input->post('ecName') ? $this->input->post('ecName') : $worker['ecName']); ?>" class="form-control" id="ecName" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="ecRelationship" class="control-label">Relationship To Worker</label>
							<div class="form-group">
								<input type="text" name="ecRelationship" value="<?php echo ($this->input->post('ecRelationship') ? $this->input->post('ecRelationship') : $worker['ecRelationship']); ?>" class="form-control" id="ecRelationship" />
							</div>
						</div>
					</div>
          			<div class="col-sm-12">
						<div class="col-md-4">
							<label for="ecPhone" class="control-label">Phone Number</label>
							<div class="form-group">
								<input type="text" name="ecPhone" value="<?php echo ($this->input->post('ecPhone') ? $this->input->post('ecPhone') : $worker['ecPhone']); ?>" class="form-control" id="ecPhone" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="ecAltPhone" class="control-label">Alternative Phone Number</label>
							<div class="form-group">
								<input type="text" name="ecAltPhone" value="<?php echo ($this->input->post('ecAltPhone') ? $this->input->post('ecAltPhone') : $worker['ecAltPhone']); ?>" class="form-control" id="ecAltPhone" />
							</div>
						</div>
					</div>
					<!-- <div class="col-sm-12">
						<h4 class="page-info">WORKER AUTHORITY</h4>
						<?php
							/*$cid_str = substr($worker['companies'], 1);

	        				$cids = explode('/', $cid_str);*/
							 
						?>
						<div class="col-md-2">
							<h5>COMPANIES<span class="text-danger"> (required)</span></h5>
							<input type="hidden" name="cid_str" id="cid_str" value="<?php //echo $cid_str; ?>">
							<input type="hidden" name="c-selected-count" id="c-selected-count" value="<?php //echo count($cids); ?>">
							<div id="selectedCList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                <?php

                                    /*$counter = 0;
									foreach($all_companies as $company)
									{
										$found = false;
										foreach ($cids as $cid) {
											if($cid == $company['id']) {
												$found = true;
												break;
											}
										}

										if($found) {

											echo '<div style="padding: 3px;" class="form-group"><input type="checkbox" name="companyOpts[' . $counter . ']" value="' . $company['id'] . '" checked="checked"'.' />&nbsp;&nbsp;&nbsp;' . $company['companyName'] . '&nbsp;</div>';

											$counter = $counter + 1;

										}

									}*/
									
                                ?>
                            </div>
							<span class="text-danger"><?php //echo form_error('cid_str');?></span>
                        </div>
						<div class="col-md-2">
							<input type="hidden" name="c_search_api_url" id="c_search_api_url" value="<?php //echo site_url('company/search?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="company-key" id="company-key" placeholder="SEARCH COMPANIES">
							<div id="fullCList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
							</div>
						</div>
						<?php
							/*$scid_str = substr($worker['subcontractors'], 1);

							$scids = explode('/', $scid_str);*/
							 
						?>
						<div class="col-md-2">
							<h5>SUBCONTRACTORS</h5>
							<input type="hidden" name="scid_str" id="scid_str" value="<?php //echo $scid_str; ?>">
							<input type="hidden" name="sc-selected-count" id="sc-selected-count" value="<?php //echo count($scids); ?>">
							<div id="selectedScList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                <?php

                                    /*$counter = 0;
									foreach($all_scs as $sc)
									{
										$found = false;
										foreach ($scids as $scid) {
											if($scid == $sc['id']) {
												$found = true;
												break;
											}
										}

										if($found) {

											echo '<div style="padding: 3px;" class="form-group"><input type="checkbox" name="scOpts[' . $counter . ']" value="' . $sc['id'] . '" checked="checked"'.' />&nbsp;&nbsp;&nbsp;' . $sc['companyName'] . '&nbsp;</div>';

											$counter = $counter + 1;

										}

									}*/
									
                                ?>
                            </div>
                        </div>
						<div class="col-md-2">
							<input type="hidden" name="sc_search_api_url" id="sc_search_api_url" value="<?php //echo site_url('company/scsearch?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="subcontractor-key" id="subcontractor-key" placeholder="SEARCH SUBCONTRACTORS">
							<div id="fullScList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
							</div>
						</div>
						<?php
							/*$sid_str = substr($worker['sites'], 1);

							$sids = explode('/', $sid_str);*/
							 
						?>
						<input type="hidden" name="sid_str" id="sid_str" value="<?php //echo $sid_str; ?>">
						<div class="col-md-2">
							<h5>SITES<span class="text-danger"> (required)</span></h5>
							<input type="hidden" name="selected-count" id="selected-count" value="<?php //echo count($sids); ?>">
							<div id="selectedSList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                <?php

                                    /*$counter = 0;
									foreach($all_sites as $site)
									{
										$found = false;
										foreach ($sids as $sid) {
											if($sid == $site['id']) {
													$found = true;
													break;
											}
										}

										if($found) {

											echo '<div style="padding: 3px;" class="form-group"><input type="checkbox" name="siteOpts[' . $counter . ']" value="' . $site['id'] . '" checked="checked"'.' />&nbsp;&nbsp;&nbsp;' . $site['siteName'] . '&nbsp;</div>';

											$counter = $counter + 1;

										}

									}*/

                                ?>
                            </div>
							<span class="text-danger"><?php //echo form_error('sid_str');?></span>
                        </div>
						<div class="col-md-2">
							<input type="hidden" name="search_api_url" id="search_api_url" value="<?php //echo site_url('site/search?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="site-key" id="site-key" placeholder="SEARCH SITES">
							<div id="fullSList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
							</div>
						</div>
					</div> -->
					<div class="col-sm-12">
						<h4 class="page-info">CERTIFICATIONS</h4><button type="submit" name="cert_add" id="cert_add" value="cert_add" class="btn btn-primary btn-xs">Add New Certification</button>
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>EST</th>
								<th>Expiration Date</th>
								<th>Administered By</th>
								<th>Scaffold</th>
								<th>Front Of Certification</th>
								<th>Back Of Certification</th>
								<th>Option</th>
		                    </tr>
		                    <?php foreach($certs as $c){ ?>
		                    <tr>
								<td><?php echo $c['date']; ?></td>
								<td>
									<?php

		                                foreach($all_ests as $e) {
		                                    
		                                    if($c['estId'] == $e['id']) {

		                                        echo $e['title'];

		                                    }

		                                }

		                            ?>
								</td>
								<td><?php echo $c['expirationDate']; ?></td>
								<td><?php echo $c['administeredBy']; ?></td>
								<td><?php echo $c['scaffold']; ?></td>
								<td>
									<?php

									if($c['frontOfCertification']) {

									?>

										<img style="height: 120px; width: 100px;" src="<?php echo $c['frontOfCertification']; ?>">

									<?php

									}

									?>	
								</td>
								<td>
									<?php

									if($c['backOfCertification']) {

									?>

										<img style="height: 120px; width: 100px;" src="<?php echo $c['backOfCertification']; ?>">
										
									<?php

									}

									?>
								</td>
								<td>
									<?php

		                                if($user_session['userType'] == 'ADMIN') {

		                                	echo form_open('', array("method"=>"post"));

		                            ?>
									<input type="hidden" name="certId" value="<?php echo $c['id']; ?>">
									<button type="submit" name="remove_cert" value="remove_cert" class="btn btn-danger btn-xs">DELETE</button>
									<?php

											echo form_close();

										}

									?>
								</td>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">RESPIRATOR CLEARANCE</h4><button type="submit" name="rc_add" id="rc_add" value="rc_add" class="btn btn-primary btn-xs">Add New Examination</button>
						<h5 class="modal-info">EXAMINATIONS</h5>
						<table class="table table-striped">
		                    <tr>
								<th>Date Of Examination</th>
								<th>Clearance</th>
								<th>Examination Type</th>
								<th>Health Risk</th>
		                    </tr>
		                    <?php foreach($rcs as $rc){ ?>
		                    <tr>
								<td><?php echo $rc['dateOfExam']; ?></td>
								<td><?php echo $rc['cleared']; ?></td>
								<td><?php echo $rc['typeOfExamination']; ?></td>
								<td><?php echo $rc['risk']; ?></td>
		                    </tr>
		                    <?php } ?>
		                </table>
	          			<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<h5 class="modal-info">REPORTS FOR EMPLOYEE</h5>
			            <input type="hidden" name="workerId" value="<?php echo $worker['id']; ?>">
						<input type="hidden" name="for" value="<?php echo 'employee'; ?>">
						<div class="colsm-12">
							<div class="col-sm-2">
			            	</div>
			            	<div class="col-sm-2">
			            		<label for="new-report">Add Report</label>
			            	</div>
			            	<div class="col-sm-4">
			            		<label for="fileToUpload_emple">Choose Report File</label><input type="file" id="fileToUpload_emple" name="fileToUpload_emple">
			            	</div>
			            	<div class="col-sm-2">
			            		<br>
			            		<button type="submit" id="upload_emple_report" name="upload_emple_report" value="upload_emple_report" class="btn btn-info btn-xs" disabled="true">UPLOAD</button>
			            	</div>
			            	<div class="col-sm-2">
			            	</div>
			            </div>
	          			<div class="col-sm-12" style="height: 20px;">
	          			</div>
						<table class="table table-striped">
		                    <tr>
								<th>Date Of Upload</th>
								<th>Filename</th>
								<th>Size</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($all_reports_for_employee as $rfemple){ ?>
		                    <tr>
								<td><?php echo $rfemple['dateOfUpload']; ?></td>
								<td><?php echo $rfemple['filename']; ?></td>
								<td><?php echo $rfemple['size'] . ' Bytes'; ?></td>
								<td>
									<?php echo form_open('', array("method"=>"post")); ?>
									<input type="hidden" name="reportId" value="<?php echo $rfemple['id']; ?>">
									<button type="submit" name="download_file" value="download_file" class="btn btn-warning btn-xs">DOWNLOAD</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="remove_report" value="remove_report" class="btn btn-danger btn-xs">REMOVE</button>
									<?php echo form_close(); ?>
								</td>
		                    </tr>
		                    <?php } ?>
		                </table>
	          			<div class="col-sm-12" style="height: 10px;">
	          			</div>
						<h5 class="modal-info">REPORTS FOR EMPLOYER</h5>
			            <input type="hidden" name="workerId" value="<?php echo $worker['id']; ?>">
						<input type="hidden" name="for" value="<?php echo 'employer'; ?>">
						<div class="colsm-12">
							<div class="col-sm-2">
			            	</div>
			            	<div class="col-sm-2">
			            		<label for="new-report">Add Report</label>
			            	</div>
			            	<div class="col-sm-4">
			            		<label for="fileToUpload_emplr">Choose Report File</label><input type="file" id="fileToUpload_emplr" name="fileToUpload_emplr">
			            	</div>
			            	<div class="col-sm-2">
			            		<br>
			            		<button type="submit" id="upload_emplr_report" name="upload_emplr_report" value="upload_emplr_report" class="btn btn-info btn-xs" disabled="true">UPLOAD</button>
			            	</div>
			            	<div class="col-sm-2">
			            	</div>
			            </div>
	          			<div class="col-sm-12" style="height: 20px;">
	          			</div>
						<table class="table table-striped">
		                    <tr>
								<th>Date Of Upload</th>
								<th>Filename</th>
								<th>Size</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($all_reports_for_employer as $rfemplr){ ?>
		                    <tr>
								<td><?php echo $rfemplr['dateOfUpload']; ?></td>
								<td><?php echo $rfemplr['filename']; ?></td>
								<td><?php echo $rfemplr['size'] . ' Bytes'; ?></td>
								<td>
									<?php echo form_open('', array("method"=>"post")); ?>
									<input type="hidden" name="reportId" value="<?php echo $rfemplr['id']; ?>">
									<button type="submit" name="download_file" value="download_file" class="btn btn-warning btn-xs">DOWNLOAD</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="remove_report" value="remove_report" class="btn btn-danger btn-xs">REMOVE</button>
									<?php echo form_close(); ?>
								</td>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">DRUG SCREENINGS</h4><button type="submit" name="ds_add" id="ds_add" value="ds_add" class="btn btn-primary btn-xs">Add New Drug Screening</button>
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>Reason</th>
								<th>Collection Date</th>
								<th>Collection Site</th>
								<th>Collector</th>
								<th>Test Result</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($dss as $ds){ ?>
		                    <tr>
								<td><?php echo $ds['date']; ?></td>
								<td><?php echo $ds['reason']; ?></td>
								<td><?php echo $ds['collectionDate']; ?></td>
								<td><?php echo $ds['collectionSite']; ?></td>
								<td><?php echo $ds['collector']; ?></td>
								<td><?php if($ds['testResult'] == 'FAR') { echo 'No cleared for Work'; } else { echo $ds['testResult']; } ?></td>
								<td>
									<?php echo form_open('', array("method"=>"post")); ?>
									<input type="hidden" name="dsId" value="<?php echo $ds['id']; ?>">
									<button type="submit" id="view_ds" name="view_ds" value="view_ds" class="btn btn-default btn-xs">VIEW</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="edit_ds" value="edit_ds" class="btn btn-warning btn-xs">EDIT</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="print_ds" value="print_ds" class="btn btn-info btn-xs">PRINT</button>
									<?php echo form_close(); ?>
								</td>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">NON-OHS DRUG SCREENINGS</h4><button type="submit" name="nods_add" id="nods_add" value="nods_add" class="btn btn-primary btn-xs">Add New Non-OHS Drug Screening</button>
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>Providing Company</th>
								<th>Notes</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($nodss as $nods){ ?>
		                    <tr>
								<td><?php echo $nods['date']; ?></td>
								<td><?php echo $nods['providingCompany']; ?></td>
								<td><?php echo $nods['notes']; ?></td>
								<td>
									<?php echo form_open('', array("method"=>"post")); ?>
									<input type="hidden" name="nodsId" value="<?php echo $nods['id']; ?>">
									<button type="submit" name="edit_nods" value="edit_nods" class="btn btn-warning btn-xs">EDIT</button>
									<?php echo form_close(); ?>
								</td>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">ALCOHOL TESTS</h4><button type="submit" name="at_add" id="at_add" value="at_add" class="btn btn-primary btn-xs">Add New Alcohol Test</button>
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>Reason</th>
								<th>Collection Date</th>
								<th>Collection Site</th>
								<th>Collector</th>
								<th>Test Result</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($ats as $at){ ?>
		                    <tr>
								<td><?php echo $at['date']; ?></td>
								<td><?php echo $at['reason']; ?></td>
								<td><?php echo $at['collectionDate']; ?></td>
								<td><?php echo $at['collectionSite']; ?></td>
								<td><?php echo $at['collector']; ?></td>
								<td><?php echo $at['testResult']; ?></td>
								<td>
									<?php echo form_open('', array("method"=>"post")); ?>
									<input type="hidden" name="atId" value="<?php echo $at['id']; ?>">
									<button type="submit" id="view_at" name="view_at" value="view_at" class="btn btn-default btn-xs">VIEW</button>&nbsp;&nbsp;&nbsp;<button type="submit" name="edit_at" value="edit_at" class="btn btn-warning btn-xs">EDIT</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="print_at" value="print_at" class="btn btn-info btn-xs">PRINT</button>
									<?php echo form_close(); ?>
								</td>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
					<div class="col-sm-12" style="height: 20px;">
						
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">INCIDENTS</h4><button type="submit" name="incident_add" id="incident_add" value="incident_add" class="btn btn-primary btn-xs">Add New Incident</button>
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>Site</th>
								<th>Type</th>
								<th>Service</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($incidents as $incident){ ?>
		                    <tr>
								<td><?php echo $incident['date']; ?></td>
								<td>
		                        <?php

		                            foreach($all_sites as $site) {
		                                
		                                if($incident['siteId'] == $site['id']) {

		                                    echo $site['siteName'];

		                                }

		                            }

		                        ?>
		                        </td>
								<td><?php echo $incident['type']; ?></td>
								<td><?php echo $incident['service']; ?></td>
								<?php echo form_open('', array("method"=>"post")); ?>
								<input type="hidden" name="incidentId" value="<?php echo $incident['id']; ?>">
								<td>
									<button type="submit" name="edit_incident" value="edit_incident" class="btn btn-warning btn-xs">EDIT</button>
								</td>
								<?php echo form_close(); ?>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" name="worker_edit" id="worker_edit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>
<div id="certModal" class="modal">
    <div class="modal-dialog" style="width: 70%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">ADD WORKER CERTIFICATION</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 60px 0px 60px;">
                <?php echo form_open('worker/edit/' . $worker['id'], array("method"=>"post", "enctype"=>"multipart/form-data")); ?>
                <input type="hidden" name="workerId" value="<?php echo $worker['id']; ?>" id="workerId" />
	          	<div class="box-body">
	          		<div class="row clearfix">
						<div class="col-sm-12">
							<div class="col-md-4">
								<label for="estId" class="control-label">Select EST</label>
								<div class="form-group">
									<select name="estId" class="form-control">
										<?php 
										foreach($all_ests as $e)
										{
											$selected = ($e['id'] == $this->input->post('estId')) ? ' selected="selected"' : "";

											echo '<option value="'.$e['id'].'" '.$selected.'>'.$e['title'].'</option>';
										} 
										?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<label for="date" class="control-label">Date</label>
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="date" type="text" name="date" value="<?php echo $this->input->post('date'); ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label for="expirationDate" class="control-label">Expiration Date</label>
								<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="expirationDate" type="text" name="expirationDate" value="<?php echo $this->input->post('expirationDate'); ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<label for="scaffold" class="control-label">Scaffold</label>
								<div class="form-group">
									<select id="scaffold" name="scaffold" class="form-control">
										<option value="BUILDER"<?php if($this->input->post('scaffold') == null || $this->input->post('scaffold') == 'BUILDER') { echo ' selected="selected"'; } ?>>BUILDER</option>
										<option value="ERECTOR"<?php if($this->input->post('scaffold') == 'ERECTOR') { echo ' selected="selected"'; } ?>>ERECTOR</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<label for="administeredBy" class="control-label">Administered By</label>
								<div class="form-group">
									<input type="text" name="administeredBy" value="<?php echo $this->input->post('administeredBy'); ?>" class="form-control" id="administeredBy" />
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<h5 class="modal-info">Certification Front</h5>
							<div class="col-md-6">
								<div id="ohs_webcam_cert_front" style="height: 240px; width: 200px; align-content: center; border: 0.5px solid skyblue;">
									<div style="padding-top: 90px; text-align: center;">
										<a name="capture_cert_front" id="capture_cert_front" class="btn btn-info btn-lg" href="">
											<i class="fa fa-camera-retro"></i> CAPTURE IMAGE
										</a>
									</div>
								</div>

								<br>

								<div style=" padding-left: 40px; text-align: center;"><input type="button" id="take_cert_front" value="Take Picture (Front)"></div>
							</div>
							<div class="col-md-6">
								<div id="cert-front-results" ></div>
								<input type="hidden" id="certFrontDataURI" name="certFrontDataURI" value="">
							</div>
						</div>
						<div class="col-sm-6">
							<h5 class="modal-info">Certification Back</h5>
							<div class="col-md-6">
                                <div id="ohs_webcam_cert_back" style="height: 240px; width: 200px; align-content: center; border: 0.5px solid skyblue;">
                                    <div style="padding-top: 90px; text-align: center;">
                                        <a name="capture_cert_back" id="capture_cert_back" class="btn btn-info btn-lg" href="">
                                            <i class="fa fa-camera-retro"></i> CAPTURE IMAGE
                                        </a>
                                    </div>
                                </div>

                                <br>

                                <div style=" padding-left: 40px; text-align: center;"><input type="button" id="take_cert_back" value="Take Picture (Back)"></div>
                            </div>
                            <div class="col-md-3">
                                <div id="cert-back-results" ></div>
                                <input type="hidden" id="certBackDataURI" name="certBackDataURI" value="">
                            </div>
						</div>
						<div class="col-md-12" style="min-height: 45px;"></div>
						<div class="col-md-3">
							<label for="frontOfCertification" class="control-label">OR Choose (Front) Image To Upload</label>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="file" id="frontOfCert" name="frontOfCert">
							</div>
						</div>
						<div class="col-md-3">
							<label for="backOfCertification" class="control-label">OR Choose (Back) Image To Upload</label>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="file" id="backOfCert" name="backOfCert">
							</div>
						</div>
						<div class="col-md-12" style="min-height: 10px;"></div>
					</div>
				</div>
	          	<div class="box-footer">
	            	<button type="submit" name="cert_submit" id="cert_submit" value="cert_submit" class="btn btn-success">ADD</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="cancel_cert" value="cancel_cert" class="btn btn-warning">CANCEL</button>
	          	</div>
	            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	var construction_sites = <?php echo json_encode($all_sites); ?>
</script>
