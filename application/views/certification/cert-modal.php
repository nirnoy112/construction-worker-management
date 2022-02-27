<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="certModal" class="modal">
    <div class="modal-dialog" style="width: 80%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">ADD WORKER CERTIFICATION</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 60px 0px 60px;">
                <?php echo form_open(''); ?>
                <input type="hidden" name="workerId" value="<?php echo $wid; ?>" id="workerId" />
	          	<div class="box-body">
	          		<div class="row clearfix">
						<div class="col-sm-12">
							<div class="col-md-3">
								<label for="expirationDate" class="control-label">Select EST</label>
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
							<div class="col-md-3">
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
							<div class="col-md-3">
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
							<div class="col-md-3">
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