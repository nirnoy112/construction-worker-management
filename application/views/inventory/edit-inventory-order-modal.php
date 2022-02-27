<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="editSupplyOrderModal" class="modal">
    <div class="modal-dialog" style="width: 75%; display: block; padding: 30px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">EDIT INVENTORY ORDER</h4>
            </div>
            <div class="row modal-body" style="padding: 0px 25px 0px 25px;">
                <?php echo form_open(''); ?>
                <input type="hidden" name="ioId" value="<?php echo $ioId; ?>" id="ioId" />
                <input type="hidden" name="order[siteId]" value="<?php echo $sid; ?>" id="siteId" />
                <input type="hidden" name="order[CreatingUserId]" value="<?php echo $user_session['id']; ?>" id="CreatingUserId" />
                <input type="hidden" name="order[createdBy]" value="<?php echo $user_session['realName'] . ' (' . $user_session['username'] . ')'; ?>" id="createdBy" />
	          	<div class="box-body">
	          		<div class="row clearfix">
	          			<div style="text-align: left;" class="col-sm-5">
	          				<div class="col-md-12">
	          					<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="120" width="120">
	          					<h3>OHS Training & Consulting, Inc.</h3>
	          					<h4>9 Faunbar Ave</h4>
	          					<h4>Suite #2</h4>
	          					<h4>Winthrop, MA 02152</h4>
	          					<h4>617-846-5059</h4>
	          				</div>
	          			</div>
	          			<div class="col-sm-2">
	          				
	          			</div>
	          			<div style="text-align: left;" class="col-sm-5">
	          				<h2><i>OFFICIAL SUPPLY ORDER</i></h2>
	          				<br>
	          				<br>
	          				<div class="col-md-4">
	          					<label for="osLocation" class="control-label">Location</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="order[osLocation]" value="<?= $order['osLocation']; ?>" class="form-control" id="osLocation" />
								</div>
	          				</div>
	          				<div class="col-md-4">
	          					<label for="osDate" class="control-label">Date</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="osDate" type="text" name="order[osDate]" value="<?= $order['osDate']; ?>" />
										<div class="input-group-addon">
									        <span class="glyphicon glyphicon-th"></span>
										</div>
									</div>
								</div>
							</div>
	          				<div class="col-md-4">
	          					<label for="osAddressLine1" class="control-label">Address</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="order[osAddressLine1]" value="<?= $order['osAddressLine1']; ?>" class="form-control" id="osAddressLine1" />
								</div>
							</div>
							<div class="col-md-4">
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="order[osAddressLine2]" value="<?= $order['osAddressLine2']; ?>" class="form-control" id="osAddressLine2" />
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

			                    	foreach($official_supplies as $os){ ?>
			                    <tr>
									
									<td><code><?= $os->description; ?></code><input type="hidden" name="os[<?= $counter ?>][description]" value="<?php echo $os->description; ?>" id="os-description-<?= $counter; ?>" /></td>
									<th style="width: 8%;"></th>
									<td><input type="text" name="os[<?= $counter ?>][quantity]" value="<?= $os->quantity; ?>" size="6" class="form-control" id="os-quantity-<?= $counter; ?>" /></td>
									<th style="width: 8%;"></th>
			                        <td><input type="text" name="os[<?= $counter ?>][unitPrice]" value="<?= sprintf("%.2f", $os->unitPrice); ?>" size="6" class="form-control" id="os-unitPrice-<?= $counter; ?>" /></td>
									<th style="width: 8%;"></th>
			                        <td><input type="text" name="os[<?= $counter ?>][lineTotal]" value="<?= sprintf("%.2f", $os->lineTotal); ?>" size="8" class="form-control" id="os-lineTotal-<?= $counter; ?>" /></td>
			                    </tr>
			                    <?php
			                    		$counter = $counter + 1;

			                		}

			                	?>
			                    <tr>
									<td colspan="6" style="text-align: right;"><b>SUBTOTAL</b></td>
			                        <td><input type="text" name="order[osSubTotal]" value="<?= sprintf("%.2f", $order['osSubTotal']); ?>" class="form-control" id="osSubTotal" /></td>
			                    </tr>
			                    <tr>
									<td colspan="6" style="text-align: right;"><b>TOTAL</b></td>
			                        <td><input type="text" name="order[osTotal]" value="<?= sprintf("%.2f", $order['osTotal']); ?>" class="form-control" id="osTotal" /></td>
			                    </tr>
			                </table>
	          			</div>
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
	          				<h2><i>MEDICAL SUPPLY ORDER</i></h2>
	          				<br>
	          				<br>
	          				<div class="col-md-4">
	          					<label for="msLocation" class="control-label">Location</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="order[msLocation]" value="<?= $order['msLocation']; ?>" class="form-control" id="msLocation" />
								</div>
	          				</div>
	          				<div class="col-md-4">
	          					<label for="msDate" class="control-label">Date</label>
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<div class="input-group date">
										<input class="form-control" id="msDate" type="text" name="order[msDate]" value="<?= $order['msDate']; ?>" />
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
									<input type="text" name="order[msAddressLine1]" value="<?= $order['msAddressLine1']; ?>" class="form-control" id="msAddressLine1" />
								</div>
							</div>
							<div class="col-md-4">
	          				</div>
	          				<div class="col-md-8">
	          					<div class="form-group">
									<input type="text" name="order[msAddressLine2]" value="<?= $order['msAddressLine2']; ?>" class="form-control" id="msAddressLine2" />
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
									<td><input type="text" name="ms[<?= $counter ?>][quantity]" value="<?= $ms->quantity; ?>" size="6" class="form-control" id="ms-quantity-<?= $counter; ?>" /></td>
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
									<td colspan="6" style="text-align: right;"><b>SUBTOTAL</b></td>
			                        <td><input type="text" name="order[msSubTotal]" value="<?= sprintf("%.2f", $order['msSubTotal']); ?>" class="form-control" id="msSubTotal" /></td>
			                    </tr>
			                    <tr>
									<td colspan="6" style="text-align: right;"><b>TOTAL</b></td>
			                        <td><input type="text" name="order[msTotal]" value="<?= sprintf("%.2f", $order['msTotal']); ?>" class="form-control" id="msTotal" /></td>
			                    </tr>
			                </table>
	          			</div>
	          			<div class="col-sm-12">
	          				<br>
	          			</div>
	          			<div class="col-md-12">
	          				<div class="col-md-3">
	          					<label for="sendingOption" class="control-label">Sending Option</label>
	          				</div>
	          				<div class="col-md-3">
	          					<div class="form-group">
									<select name="sendingOption" class="form-control">
										<option value="both" selected="selected">BOTH ORDERS</option>
										<option value="official">OFFICIAL ORDER</option>
										<option value="medical">MEDICAL ORDER</option>
									</select>
								</div>
							</div>
	          				<div class="col-md-3">
	          					<label for="emailedTo" class="control-label">Send To (Email)</label>
	          				</div>
	          				<div class="col-md-3">
	          					<input type="text" name="emailedTo" class="form-control" id="emailedTo" />
	          				</div>
	          			</div>
					</div>
				</div>
			</div>
	          	<div class="box-footer">
	            	<button type="submit" name="io_edit" id="io_edit" value="io_edit" class="btn btn-success">SAVE</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" id="cancel_io_edit" name="cancel_io_edit" value="cancel_io_edit" class="btn btn-warning">CANCEL</button>
	          	</div>
	            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>