<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 style="color: #ffffff;" class="box-title">ADD NEW COMPANY</h3>
            </div>
            <?php echo form_open('company/add', array("method"=>"post", "enctype"=>"multipart/form-data")); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="typeId" class="control-label">Company Type</label>
						<div class="form-group">
							<select id="ohs-ctid" name="typeId" class="form-control">
								<!-- <option value="0">NONE</option> -->
								<?php 
								foreach($all_company_types as $company_type)
								{
									$selected = ($company_type['id'] == $this->input->post('typeId')) ? ' selected="selected"' : "";

									echo '<option value="'.$company_type['id'].'" '.$selected.'>'.$company_type['title'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="parentCompanyId" class="control-label">Parent Company</label>
						<div class="form-group">
							<select id="ohs-pcid" name="parentCompanyId" class="single-searchable-select form-control">
								<option value="0">NONE</option>
								<?php 
								foreach($all_companies as $company)
								{
									$selected = ($company['id'] == $this->input->post('parentCompanyId')) ? ' selected="selected"' : "";

									echo '<option value="'.$company['id'].'" '.$selected.'>'.$company['companyName'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="billToSub" class="control-label">Bill To Sub</label>
						<div class="form-group">
							<select id="ohs-btsid" name="billToSub" class="form-control">
								<option value="0">SELF</option>
								<?php 
								foreach($all_sc_companies as $sc_company)
								{
									$selected = ($sc_company['id'] == $this->input->post('billToSub')) ? ' selected="selected"' : "";

									echo '<option value="'.$sc_company['id'].'" '.$selected.'>'.$sc_company['companyName'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="companyName" class="control-label">Company Name</label>
						<div class="form-group">
							<input type="text" name="companyName" value="<?php echo $this->input->post('companyName'); ?>" class="form-control" id="companyName" />
						</div>
					</div>
					<?php
					
						$currentTime = time();
						$hexTime = dechex($currentTime);

						$cryptoStrong = true; // can be false
						$length = 8; // Any length you want
						$bytes = openssl_random_pseudo_bytes($length, $cryptoStrong);
						$randomString = bin2hex($bytes);

					?>
					<input type="hidden" name="generatedUID" value="<?php echo $randomString; ?>"  />
					<div class="col-md-6">
						<label for="uid" class="control-label">UID (Autogenerated)</label>
						<div class="form-group">
							<input type="text" name="uid" value="<?php echo $randomString; ?>" class="form-control" id="uid" disabled="disabled" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="fein" class="control-label">FEIN</label>
						<div class="form-group">
							<input type="text" name="fein" class="form-control" id="fein" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="statusId" class="control-label">Company Status</label>
						<div class="form-group">
							<select id="ohs-csid" name="statusId" class="form-control">
								<!-- <option value="0">NONE</option> -->
								<?php 
								foreach($all_company_statuses as $company_status)
								{
									$selected = ($company_status['id'] == $this->input->post('statusId')) ? ' selected="selected"' : "";

									echo '<option value="'.$company_status['id'].'" '.$selected.'>'.$company_status['title'].'</option>';
								} 
								?>
							</select>
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
						<label for="secondaryContact" class="control-label">Secondary Contact</label>
						<div class="form-group">
							<input type="text" name="secondaryContact" value="<?php echo $this->input->post('secondaryContact'); ?>" class="form-control" id="secondaryContact" />
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
						<label for="comm_pref" class="control-label">Communication Preference</label>
						<div class="form-group">
							<select id="comm_pref" name="comm_pref" class="form-control">
								<option value="NONE"<?php if($this->input->post('comm_pref') == null || $this->input->post('comm_pref') == 'NONE') { echo ' selected="selected"'; } ?>>NONE</option>
								<option value="SMS"<?php if($this->input->post('comm_pref') == 'SMS') { echo ' selected="selected"'; } ?>>SMS</option>
								<option value="EMAIL"<?php if($this->input->post('comm_pref') == 'EMAIL') { echo ' selected="selected"'; } ?>>EMAIL</option>
								<option value="SNAIL MAIL"<?php if($this->input->post('comm_pref') == 'SNAIL MAIL') { echo ' selected="selected"'; } ?>>SNAIL MAIL</option>
							</select>
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