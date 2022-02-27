<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Certification Add</h3>
            </div>
            <?php echo form_open('certification/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="date" class="control-label">Date</label>
						<div class="form-group">
							<input type="text" name="date" value="<?php echo $this->input->post('date'); ?>" class="form-control" id="date" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="expirationDate" class="control-label">ExpirationDate</label>
						<div class="form-group">
							<input type="text" name="expirationDate" value="<?php echo $this->input->post('expirationDate'); ?>" class="form-control" id="expirationDate" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="workerId" class="control-label">WorkerId</label>
						<div class="form-group">
							<input type="text" name="workerId" value="<?php echo $this->input->post('workerId'); ?>" class="form-control" id="workerId" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="frontOfCertification" class="control-label">FrontOfCertification</label>
						<div class="form-group">
							<input type="text" name="frontOfCertification" value="<?php echo $this->input->post('frontOfCertification'); ?>" class="form-control" id="frontOfCertification" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="backOfCertification" class="control-label">BackOfCertification</label>
						<div class="form-group">
							<input type="text" name="backOfCertification" value="<?php echo $this->input->post('backOfCertification'); ?>" class="form-control" id="backOfCertification" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="administeredBy" class="control-label">AdministeredBy</label>
						<div class="form-group">
							<input type="text" name="administeredBy" value="<?php echo $this->input->post('administeredBy'); ?>" class="form-control" id="administeredBy" />
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