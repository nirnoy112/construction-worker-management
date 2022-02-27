<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 style="color: #ffffff;" class="box-title">Site Edit</h3>
            </div>
			<?php echo form_open('site/edit/'.$site['id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="statusId" class="control-label">Site Status</label>
						<div class="form-group">
							<select name="statusId" class="form-control">
								<?php 
								foreach($all_site_statuses as $site_status)
								{
									$selected = ($site_status['id'] == $site['statusId']) ? ' selected="selected"' : "";

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
									$selected = ($company['id'] == $site['assignedCompanyId']) ? ' selected="selected"' : "";

									echo '<option value="'.$company['id'].'" '.$selected.'>'.$company['companyName'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="isSubsite" class="control-label">Subsite</label>
						<div class="form-group">
							<input type="checkbox" id="isSubsite" name="isSubsite" value="YES" <?php if($site['isSubsite'] == 'YES') { echo ' checked'; } ?> /><span></span> Check f it's a SUBSITE.
						</div>
					</div>
					<div class="col-md-6">
						<label for="parentCompanyId" class="control-label">Parent Site</label>
						<div class="form-group">
							<select id="ohs-psid" name="parentSiteId" class="single-searchable-select form-control">
								<option value="0">NONE</option>
								<?php 
								foreach($main_sites as $st)
								{
									$selected = ($st['id'] == $site['parentSiteId']) ? ' selected="selected"' : "";

									echo '<option value="'.$st['id'].'" '.$selected.'>'.$st['siteName'].'</option>';
								} 
								?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<label for="siteName" class="control-label">Site Name</label>
						<div class="form-group">
							<input type="text" name="siteName" value="<?php echo ($this->input->post('siteName') ? $this->input->post('siteName') : $site['siteName']); ?>" class="form-control" id="siteName" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="primaryContact" class="control-label">Primary Contact</label>
						<div class="form-group">
							<input type="text" name="primaryContact" value="<?php echo ($this->input->post('primaryContact') ? $this->input->post('primaryContact') : $site['primaryContact']); ?>" class="form-control" id="primaryContact" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="emailAddress" class="control-label">Email Address</label>
						<div class="form-group">
							<input type="text" name="emailAddress" value="<?php echo ($this->input->post('emailAddress') ? $this->input->post('emailAddress') : $site['emailAddress']); ?>" class="form-control" id="emailAddress" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="phoneNumber" class="control-label">Phone Number</label>
						<div class="form-group">
							<input type="text" name="phoneNumber" value="<?php echo ($this->input->post('phoneNumber') ? $this->input->post('phoneNumber') : $site['phoneNumber']); ?>" class="form-control" id="phoneNumber" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="faxNumber" class="control-label">Fax Number</label>
						<div class="form-group">
							<input type="text" name="faxNumber" value="<?php echo ($this->input->post('faxNumber') ? $this->input->post('faxNumber') : $site['faxNumber']); ?>" class="form-control" id="faxNumber" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address1" class="control-label">Address #1</label>
						<div class="form-group">
							<input type="text" name="address1" value="<?php echo ($this->input->post('address1') ? $this->input->post('address1') : $site['address1']); ?>" class="form-control" id="address1" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address2" class="control-label">Address #2</label>
						<div class="form-group">
							<input type="text" name="address2" value="<?php echo ($this->input->post('address2') ? $this->input->post('address2') : $site['address2']); ?>" class="form-control" id="address2" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="city" class="control-label">City</label>
						<div class="form-group">
							<input type="text" name="city" value="<?php echo ($this->input->post('city') ? $this->input->post('city') : $site['city']); ?>" class="form-control" id="city" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="state" class="control-label">State</label>
						<div class="form-group">
							<input type="text" name="state" value="<?php echo ($this->input->post('state') ? $this->input->post('state') : $site['state']); ?>" class="form-control" id="state" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="zipCode" class="control-label">Zip Code</label>
						<div class="form-group">
							<input type="text" name="zipCode" value="<?php echo ($this->input->post('zipCode') ? $this->input->post('zipCode') : $site['zipCode']); ?>" class="form-control" id="zipCode" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="der" class="control-label">DER</label>
						<div class="form-group">
							<input type="text" name="der" value="<?php echo ($this->input->post('der') ? $this->input->post('der') : $site['der']); ?>" class="form-control" id="der" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="synergy" class="control-label">Synergy</label>
						<div class="form-group">
							<input type="checkbox" id="synergy" name="synergy" value="YES" <?php if($site['synergy'] == 'YES' || $this->input->post('synergy') == 'YES') { echo ' checked="checked"'; } ?> /><span></span>&nbsp;&nbsp;<i>Check this for 'Synergy' Site.</i>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-md-6">
							<label for="startTime" class="control-label">Start Time</label>
							<div class="form-group">
								<div class="input-group bootstrap-timepicker timepicker">
						            <input id="startTime" name="startTime" type="text" value="<?= $site['startTime']; ?>" class="form-control input-small">
						            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
						        </div>
							</div>
						</div>
						<div class="col-md-6">
							<label for="endTime" class="control-label">End Time</label>
							<div class="form-group">
								<div class="input-group bootstrap-timepicker timepicker">
						            <input id="endTime" name="endTime" type="text" value="<?= $site['endTime']; ?>" class="form-control input-small">
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
										$selected = ($non_dot_test_panel['id'] == $site['ndttPanelId']) ? ' selected="selected"' : "";

										echo '<option value="'.$non_dot_test_panel['id'].'" '.$selected.'>'.$non_dot_test_panel['panel'].'</option>';
									} 
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="ndttLotId" class="control-label">Lot #</label>
							<div class="form-group">
								<input type="text" name="ndttLotId" value="<?= $site['ndttLotId']; ?>" class="form-control" id="ndttLotId" />
							</div>
						</div>
						<div class="col-md-4">
							<label for="ndttExpDate" class="control-label">Expiry Date</label>
							<div class="form-group">
								<div class="input-group date">
									<input class="form-control" id="ndttExpDate" type="text" name="ndttExpDate" value="<?= $site['ndttExpDate']; ?>" />
									<div class="input-group-addon">
								        <span class="glyphicon glyphicon-th"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="height: 20px;">
						
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">INVENTORY ORDERING</h4><button type="submit" name="inventory_order_add" id="inventory_order_add" value="inventory_order_add" class="btn btn-primary btn-xs">Add New Order</button>
						<table class="table table-striped">
		                    <tr>
								<th>Created By</th>
								<th>Date</th>
								<th>Subtotal</th>
								<th>Total</th>
								<th>Status / Action</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($all_inventory_orders as $io){ ?>
		                    <tr>
								<td><?php echo $io['createdBy']; ?></td>
								<td><?php echo date('m-d-Y', $io['creatingTime']); ?></td>
								<td><?php echo $io['osSubTotal']; ?></td>
								<td><?php echo $io['msTotal']; ?></td>
								<?php echo form_open('', array("method"=>"post")); ?>
								<input type="hidden" name="invOrdrId" value="<?php echo $io['id']; ?>">
								<td>
	                            <?php

	                                foreach($all_order_statuses as $os) {
	                                    
	                                    if($io['statusId'] == $os['id']) {

	                                        echo $os['title'];

	                                    }

	                                }

	                                if($io['statusId'] == 3) {

		                                echo '&nbsp;&nbsp;&nbsp;<button type="submit" name="receive_inventory_order" class="btn btn-info btn-xs">RECEIVED</button>';
		                            }

	                            ?>
	                        	</td>
								<td>
									<?php
					            	if($io['statusId'] < 3) {
					            	?>
									<button type="submit" name="edit_inventory_order" value="edit_inventory_order" class="btn btn-default btn-xs">EDIT</button>&nbsp;&nbsp;&nbsp;
					            	<?php
					            	}
					            	?>
					            	<button value="<?php echo $io['id']; ?>" class="send_inventory_order btn btn-warning btn-xs">RESEND</button>
								</td>
								<?php echo form_close(); ?>
		                    </tr>
		                    <?php } ?>
		                </table>
					<div class="col-sm-12" style="height: 20px;">
						
					</div>
					<div class="col-sm-12">
						<h4 class="page-info">INCIDENTS</h4>
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>Worker</th>
								<th>Type</th>
								<th>Service</th>
								<th>Options</th>
		                    </tr>
		                    <?php foreach($incidents as $incident){ ?>
		                    <tr>
								<td><?php echo $incident['date']; ?></td>
								<td><?php echo $incident['workerName']; ?></td>
								<td><?php echo $incident['type']; ?></td>
								<td><?php echo $incident['service']; ?></td>
								<?php echo form_open('', array("method"=>"post")); ?>
								<input type="hidden" name="incidentId" value="<?php echo $incident['id']; ?>">
								<td>
									<button type="submit" id="edit_incident" name="edit_incident" value="edit_incident" class="btn btn-warning btn-xs">EDIT</button>
								</td>
								<?php echo form_close(); ?>
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" name="site_edit" id="site_edit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>
<div id="sendingOrderEmail" class="modal">
    <div class="modal-dialog" style="width: 50%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">RESEND INVENTORY ORDER</h4>
            </div>
            <div class="row modal-body" style="padding: 10px 25px 10px 25px;">
	            <h5 class="modal-info">AVAILABLE OPTIONS</h5>
	            <?php echo form_open('', array("class"=>"form-horizontal", "method"=>"post")); ?>
	            <input type="hidden" id="sioId" name="sioId">
	            <div class="col-sm-12">
	            	<div class="col-sm-3"></div>
	            	<div class="col-sm-6">
	            		<table class="table table-striped">
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="emailOption" value="official"<?php if($this->input->post('emailOption') == 'official') { echo ' checked'; } ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFFICIAL SUPPLIES
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="emailOption" value="medical"<?php if($this->input->post('emailOption') == 'medical') { echo ' checked'; } ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MEDICAL SUPPLIES
								</td>
							</tr>
							<tr>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="emailOption" value="both"<?php if($this->input->post('emailOption') == null || $this->input->post('emailOption') == 'both') { echo ' checked'; } ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BOTH
								</td>
							</tr>
						</table>
	            	</div>
	            	<div class="col-sm-3"></div>
	            </div>
	            <br>
	            <div class="col-sm-12">
	            	<div class="col-sm-2"></div>
	            	<label class="col-sm-2">
	            		EMAIL TO:
	            	</label>
	            	<div class="col-sm-4">
	            		<input type="text" name="emailTo">
	            	</div>
	            	<div class="col-sm-2"><button type="submit" id="send_io_email" name="send_io_email" value="send_io_email" class="btn btn-xs btn-primary btn-rounded no_border">SEND</button></div>
	            	<div class="col-sm-2"></div>
	            </div>
	            <div class="col-sm-12" style="min-height: 30px;"></div>
	            <div class="col-sm-offset-5 col-sm-12">
	            	<button type="submit" id="close_send" name="close_send" value="close_send" class="btn btn-warning">CLOSE</button>
	            </div>
            	<?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <!-- footer section -->
            </div>
        </div>
    </div>
</div>