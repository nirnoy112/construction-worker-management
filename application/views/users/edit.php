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
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 style="color: #ffffff;" class="box-title">EDIT USER</h3>
            </div>
			<?php echo form_open(''); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-sm-12" style="padding-right: 50px;">
						<div class="col-sm-2" style="float: right;">
							<button type="submit" name="print_badge" id="print_badge" class="btn btn-success btn-lg">
								<i class="fa fa-id-card"></i> PRINT BADGE
							</button>
						</div>
					</div>
					<div class="col-sm-12" style="min-height: 5px;">
					</div>
          			<div class="col-sm-12">
						<div class="col-sm-2">
							<label for="pictureFile">User's Picture</label>
						</div>
						<div class="col-sm-3">
							<!-- <img src="<?php //echo site_url('resources/img/user_default.png');?>" style="height: 120px; width: 100px;" alt="Worker Image"> -->
							<div id="profile_picture">
								<input type="hidden" name="default_picture" id="default_picture" value="<?php echo site_url('resources/img/user_default.png');?>">
							<?php

								if($user['imageURI']) {

							?>

									<img src="<?php echo $user['imageURI']; ?>" style="height: 120px; width: 100px;" alt="Worker Image"><input type="hidden" name="dp_user_id" id="dp_user_id">
									<input type="hidden" name="udp_api_url" id="udp_api_url" value="<?= site_url('user/delete_picture?id=' . $user['id']); ?>">
									<div class="col-sm-12" style="height: 5px;"></div>
									<br>
									<a style="width: 100px;" class="btn btn-xs btn-warning" id="u_delete_picture" name="u_delete_picture" href="#">Delete Picture</a>

							<?php

								} else {

							?>

									<img src="<?php echo site_url('resources/img/user_default.png');?>" style="height: 120px; width: 100px;" alt="User Image">

							<?php

								}
							?>
							</div>
							<div style="min-height: 10px;"></div>
							<div id="results" ></div>

							<br>

							<input type="hidden" name="usp_api_url" id="usp_api_url" value="<?= site_url('user/save_picture?id=' . $user['id']); ?>">

							<div style=" padding-left: 20px; text-align: center;">
								<input type="button" id="save_user_snapshot" value="Save">
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
						<div style="padding-top: 100px;" class="col-sm-3">
							
							UPLOAD PICTURE<input type="file" id="pictureFile" name="pictureFile">


						</div>
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">BASIC INFORMATION</h4>
						<div class="col-md-4">
							<label for="roleId" class="control-label">User Type</label>
							<div class="form-group">
								<select id="ohs-utid" name="roleId" class="form-control">
									<?php 
									foreach($all_roles as $role)
									{
										$selected = ($role['id'] == $user['roleId']) ? ' selected="selected"' : "";

										echo '<option value="'.$role['id'].'" '.$selected.'>'.$role['title'].'</option>';
									} 
									?>
								</select>
							</div>
						</div>
						<input type="hidden" name="generatedUID" value="<?php echo $user['uid']; ?>"  />
						<div class="col-md-4">
							<label for="uid" class="control-label">UID</label>
							<div class="form-group">
								<input type="text" name="uid" value="<?php echo ($this->input->post('uid') ? $this->input->post('uid') : $user['uid']); ?>" class="form-control" id="uid" disabled="disabled" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="fullName" class="control-label">Full Name</label>
							<div class="form-group">
								<input type="text" name="fullName" value="<?php echo ($this->input->post('fullName') ? $this->input->post('fullName') : $user['fullName']); ?>" class="form-control" id="fullName" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="statusId" class="control-label">User Status</label>
							<div class="form-group">
								<select name="statusId" class="form-control">
									<?php 
									foreach($all_user_statuses as $user_status)
									{
										$selected = ($user_status['id'] == $user['statusId']) ? ' selected="selected"' : "";

										echo '<option value="'.$user_status['id'].'" '.$selected.'>'.$user_status['title'].'</option>';
									} 
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="username" class="control-label">Username</label>
							<div class="form-group">
								<input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $user['username']); ?>" class="form-control" id="username" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="password" class="control-label">Password</label>
							<div class="form-group">
								<input type="password" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $user['password']); ?>" class="form-control" id="password" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="email" class="control-label">Email</label>
							<div class="form-group">
								<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>" class="form-control" id="email" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="address1" class="control-label">Address #1</label>
							<div class="form-group">
								<input type="text" name="address1" value="<?php echo ($this->input->post('address1') ? $this->input->post('address1') : $user['address1']); ?>" class="form-control" id="address1" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="address2" class="control-label">Address #2</label>
							<div class="form-group">
								<input type="text" name="address2" value="<?php echo ($this->input->post('address2') ? $this->input->post('address2') : $user['address2']); ?>" class="form-control" id="address2" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="city" class="control-label">City</label>
							<div class="form-group">
								<input type="text" name="city" value="<?php echo ($this->input->post('city') ? $this->input->post('city') : $user['city']); ?>" class="form-control" id="city" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="state" class="control-label">State</label>
							<div class="form-group">
								<input type="text" name="state" value="<?php echo ($this->input->post('state') ? $this->input->post('state') : $user['state']); ?>" class="form-control" id="state" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="zipCode" class="control-label">Zip Code</label>
							<div class="form-group">
								<input type="text" name="zipCode" value="<?php echo ($this->input->post('zipCode') ? $this->input->post('zipCode') : $user['zipCode']); ?>" class="form-control" id="zipCode" />
							</div>
						</div>
						<div id="foreperson-user-role">
							<div class="col-md-2">
								<label for="Foreman" class="control-label">Foreperson</label>
							</div>
							<div class="col-md-4">
								<input type="checkbox" id="Foreman" name="Foreman" value="1" <?php if($user['Foreman'] == '1') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check to provide <b>"Foreperson"</b> role.</i>
							</div>
						</div>
						<div id="drug-test-collector">
							<div class="col-md-2">
								<label for="drugTestCollector" class="control-label">Drug Test Collector</label>
							</div>
							<div class="col-md-4">
								<input type="checkbox" id="drugTestCollector" name="drugTestCollector" value="1" <?php if($user['drugTestCollector'] == '1') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check to provide <b>"Drug Test Collector"</b> role.</i>
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="min-height: 400px;">
						<h4 class="page-info">USER AUTHORITY</h4>
						<?php
							$cid_str = substr($user['companies'], 1);

	        				$cids = explode('/', $cid_str);
							 
						?>
						<div class="col-md-2">
							<h5>COMPANIES</h5>
							<input type="hidden" name="cid_str" id="cid_str" value="<?= $cid_str; ?>">
							<input type="hidden" name="c-selected-count" id="c-selected-count" value="<?= count($cids); ?>">
							<div id="selectedCList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                <?php

                                    $counter = 0;
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

									}
									
                                ?>
                            </div>
                        </div>
						<div class="col-md-2">
							<input type="hidden" name="c_search_api_url" id="c_search_api_url" value="<?= site_url('company/search?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="company-key" id="company-key" placeholder="SEARCH COMPANIES">
							<div id="fullCList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
							</div>
						</div>
						<?php
							$scid_str = substr($user['subcontractors'], 1);

							$scids = explode('/', $scid_str);
							 
						?>
						<div class="col-md-2">
							<h5>SUBCONTRACTORS</h5>
							<input type="hidden" name="scid_str" id="scid_str" value="<?= $scid_str; ?>">
							<input type="hidden" name="sc-selected-count" id="sc-selected-count" value="<?= count($scids); ?>">
							<div id="selectedScList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                <?php

                                    $counter = 0;
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

									}
									
                                ?>
                            </div>
                        </div>
						<div class="col-md-2">
							<input type="hidden" name="sc_search_api_url" id="sc_search_api_url" value="<?= site_url('company/scsearch?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="subcontractor-key" id="subcontractor-key" placeholder="SEARCH SUBCONTRACTORS">
							<div id="fullScList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
							</div>
						</div>
						<?php
							$sid_str = substr($user['sites'], 1);

							$sids = explode('/', $sid_str);
							 
						?>
						<input type="hidden" name="sid_str" id="sid_str" value="<?= $sid_str; ?>">
						<div class="col-md-2">
							<h5>SITES</h5>
							<input type="hidden" name="selected-count" id="selected-count" value="<?= count($sids); ?>">
							<div id="selectedSList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
                                <?php

                                    $counter = 0;
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

									}

                                ?>
                            </div>
                        </div>
						<div class="col-md-2">
							<input type="hidden" name="search_api_url" id="search_api_url" value="<?= site_url('site/search?key='); ?>">
                            <input style="border-radius: 15px;" type="text" class="form-control" name="site-key" id="site-key" placeholder="SEARCH SITES">
							<div id="fullSList" style="height: 300px; overflow: auto; border: 0.5px solid gray; border-radius: 15px;">
							</div>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" name="user_edit" id="user_edit" class="btn btn-success">
            		<i class="fa fa-check"></i> SAVE
            	</button>
          	</div>
            <?php echo form_close(); ?>
		</div>
    </div>
</div>