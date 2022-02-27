<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="certsModal" class="modal">
    <div class="modal-dialog" style="width: 80%; display: block;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">WORKER CERTIFICATIONS</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 60px 0px 60px;">
	          	<div class="box-body">
	          		<div class="row clearfix">
	          			<div class="col-sm-12">
	          				<div class="col-sm-2"></div>
	          				<div class="col-sm-4"><label>NAME OF WORKER</label></div>
	          				<div class="col-sm-4"><p style="color: navy; font-size: 120%; font-family: Courier New;"><?= $workerName; ?></p></div>
	          				<div class="col-sm-2"></div>
	          			</div>
	          			<div class="col-md-12" style="min-height: 10px;"></div>
						</div>
	          			<div style="min-height: 250px;" class="col-sm-12">
						<table class="table table-striped">
		                    <tr>
								<th>Date</th>
								<th>EST</th>
								<th>Expiration Date</th>
								<th>Administered By</th>
								<th>Scaffold</th>
								<th>Front Of Certification</th>
								<th>Back Of Certification</th>
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
		                    </tr>
		                    <?php } ?>
		                </table>
					</div>
					<div class="col-md-12" style="min-height: 10px;"></div>
					</div>
				</div>
	          	<div class="box-footer">
	          		<button type="submit" name="cancel_certs" id="cancel_certs" class="btn btn-warning">CLOSE</button>
	          	</div>
            </div>
        </div>
    </div>
</div>