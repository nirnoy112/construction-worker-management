<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 style="color: #ffffff;" class="box-title">ADD NEW SITE</h3>
            </div>
            <?php echo form_open('site/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="statusId" class="control-label">Site Status</label>
						<div class="form-group">
							<select name="statusId" class="form-control">
								<?php 
								foreach($all_site_statuses as $site_status)
								{
									$selected = ($site_status['id'] == $this->input->post('statusId')) ? ' selected="selected"' : "";

									echo '<option value="'.$site_status['id'].'" '.$selected.'>'.$site_status['title'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="assignedCompanyId" class="control-label">Assigning Company</label>
						<div class="form-group">
							<select name="assignedCompanyId" class="single-searchable-select form-control">
								<option value="0">NONE</option>
								<?php 
								foreach($all_companies as $company)
								{
									$selected = ($company['id'] == $this->input->post('assignedCompanyId')) ? ' selected="selected"' : "";

									echo '<option value="'.$company['id'].'" '.$selected.'>'.$company['companyName'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="isSubsite" class="control-label">Subsite</label>
						<div class="form-group">
							<input type="checkbox" id="isSubsite" name="isSubsite" value="YES" /><span></span> Check f it's a SUBSITE.
						</div>
					</div>
					<div class="col-md-6">
						<label for="parentCompanyId" class="control-label">Parent Site</label>
						<div class="form-group">
							<select id="ohs-psid" name="parentSiteId" class="single-searchable-select form-control">
								<option value="0">NONE</option>
								<?php 
								foreach($main_sites as $site)
								{
									$selected = ($site['id'] == $this->input->post('parentSiteId')) ? ' selected="selected"' : "";

									echo '<option value="'.$site['id'].'" '.$selected.'>'.$site['siteName'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="siteName" class="control-label">Site Name</label>
						<div class="form-group">
							<input type="text" name="siteName" value="<?php echo $this->input->post('siteName'); ?>" class="form-control" id="siteName" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="primaryContact" class="control-label">Primary Contact</label>
						<div class="form-group">
							<input type="text" name="primaryContact" value="<?php echo $this->input->post('primaryContact'); ?>" class="form-control" id="primaryContact" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="emailAddress" class="control-label">Email Address</label>
						<div class="form-group">
							<input type="text" name="emailAddress" value="<?php echo $this->input->post('emailAddress'); ?>" class="form-control" id="emailAddress" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="phoneNumber" class="control-label">Phone Number</label>
						<div class="form-group">
							<input type="text" name="phoneNumber" value="<?php echo $this->input->post('phoneNumber'); ?>" class="form-control" id="phoneNumber" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="faxNumber" class="control-label">Fax Number</label>
						<div class="form-group">
							<input type="text" name="faxNumber" value="<?php echo $this->input->post('faxNumber'); ?>" class="form-control" id="faxNumber" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address1" class="control-label">Address #1</label>
						<div class="form-group">
							<input type="text" name="address1" value="<?php echo $this->input->post('address1'); ?>" class="form-control" id="address1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address2" class="control-label">Address #2</label>
						<div class="form-group">
							<input type="text" name="address2" value="<?php echo $this->input->post('address2'); ?>" class="form-control" id="address2" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="city" class="control-label">City</label>
						<div class="form-group">
							<input type="text" name="city" value="<?php echo $this->input->post('city'); ?>" class="form-control" id="city" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="state" class="control-label">State</label>
						<div class="form-group">
							<input type="text" name="state" value="<?php echo $this->input->post('state'); ?>" class="form-control" id="state" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="zipCode" class="control-label">Zip Code</label>
						<div class="form-group">
							<input type="text" name="zipCode" value="<?php echo $this->input->post('zipCode'); ?>" class="form-control" id="zipCode" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="der" class="control-label">DER</label>
						<div class="form-group">
							<input type="text" name="der" value="<?php echo $this->input->post('der'); ?>" class="form-control" id="der" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="synergy" class="control-label">Synergy</label>
						<div class="form-group">
							<input type="checkbox" id="synergy" name="synergy" value="YES" <?php if($this->input->post('synergy') == 'YES') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check this for 'Synergy' Site.</i>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="startTime" class="control-label">Start Time</label>
						<div class="form-group">
							<div class="input-group bootstrap-timepicker timepicker">
					            <input id="startTime" name="startTime" type="text" class="form-control input-small">
					            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					        </div>
						</div>
					</div>
					<div class="col-md-6">
						<label for="endTime" class="control-label">End Time</label>
						<div class="form-group">
							<div class="input-group bootstrap-timepicker timepicker">
					            <input id="endTime" name="endTime" type="text" class="form-control input-small">
					            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
					        </div>
						</div>
					</div>
					<div class="col-md-12">
						<h5 class="modal-info">TYPE OF TESTS AVAILABLE</h5>
					</div>
					<div class="col-md-4">
						<label for="ndttPanelId" class="control-label">Number of Panels</label>
						<div class="form-group">
							<select name="ndttPanelId" class="form-control">
								<option value="0">NONE</option>
								<?php 
								foreach($all_non_dot_test_panels as $non_dot_test_panel)
								{
									$selected = ($non_dot_test_panel['id'] == $this->input->post('ndttPanelId')) ? ' selected="selected"' : "";

									echo '<option value="'.$non_dot_test_panel['id'].'" '.$selected.'>'.$non_dot_test_panel['panel'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="ndttLotId" class="control-label">Lot #</label>
						<div class="form-group">
							<input type="text" name="ndttLotId" value="<?php echo $this->input->post('ndttLotId'); ?>" class="form-control" id="ndttLotId" />
						</div>
					</div>
					<div class="col-md-4">
						<label for="ndttExpDate" class="control-label">Expiry Date</label>
						<div class="form-group">
							<div class="input-group date">
								<input class="form-control" id="ndttExpDate" type="text" name="ndttExpDate" value="<?php echo $this->input->post('ndttExpDate'); ?>" />
								<div class="input-group-addon">
							        <span class="glyphicon glyphicon-th"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
          	<div class="box-footer">
            	<button type="submit" class="btn btn-success">
            		<i class="fa fa-check"></i> Save
            	</button>
          	</div>
            <?php echo form_close(); ?>
      	</div>
    </div>
</div>