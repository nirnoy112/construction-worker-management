<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div id="viewInventoryOrderModal" class="modal">
    <div class="modal-dialog" style="width: 75%; display: block; padding: 30px;">
        <div class="modal-content">
            <div class="modal-header">
                <!-- header section -->
                <h4 class="modal-heading">VIEW INVENTORY ORDER</h4>
            </div>
            <div class="row modal-body" style="padding: 30px 45px 30px 45px;">
	          	<div class="box-body">
	          			<?php

		if($order['sendingOption'] == 'both' || $order['sendingOption'] == 'official') {

		?>
		<div style="align-content: center; padding-bottom: 0px;">
			<table style="width:100%;">
				<tr>
					<td style="float:left; text-align: left;">
						<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="120" width="120">
      					<h3>OHS Training & Consulting, Inc.</h3>
					</td>
					<td style="width: 10%;"></td>
					<td colspan="2" style="width:45%; text-align: right;">
						<h3><i>OFFICIAL SUPPLY ORDER</i></h3>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
						<h4>9 Faunbar Ave</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
						LOCATION
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['osLocation'] ?>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
      					<h4>Suite #2</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
						DATE
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['osDate'] ?>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
      					<h4>Winthrop, MA 02152</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
						ADDRESS
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['osAddressLine1'] ?>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
      					<h4>617-846-5059</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['osAddressLine2'] ?>
					</td>
				</tr>
			</table>
			<br>
			<br>
			<table style="width: 100%; border-collapse: none;">
                <tr style="border: 1px solid black;">
					<th style="border-right: 1px solid black; text-align: center; width: 45%;">SUPPLY ITEM DESCRIPTION</th>
					<th style="border-right: 1px solid black; text-align: center; width: 15%;">QUANTITY</th>
					<th style="border-right: 1px solid black; text-align: center; width: 20%;">UNIT PRICE</th>
					<th style="border-right: 1px solid black; text-align: center; width: 20%;">LINE TOTAL</th>
                </tr>
                <?php

                	$counter = 0;

                	foreach($official_supplies as $os){ ?>
                <tr style="border: 1px solid black;">
					<td style="border-right: 1px solid black; text-align: center;"><code><?= $os->description; ?></td>
					<td style="border-right: 1px solid black; text-align: center;"><?= $os->quantity; ?></td>
                    <td style="border-right: 1px solid black; text-align: center;"><?= sprintf("%.2f", $os->unitPrice); ?></td>
                    <td style="text-align: center;"><?= sprintf("%.2f", $os->lineTotal); ?></td>
                </tr>
                <?php
                		$counter = $counter + 1;

            		}

            	?>
                <tr>
					<td colspan="3" style="text-align: right; border: 1px solid black;">SUBTOTAL</td>
                    <td style="border: 1px solid black; text-align: center;"><?= sprintf("%.2f", $order['osSubTotal']); ?></td>
                </tr>
                <tr>
					<td colspan="3" style="text-align: right; border: 1px solid black;">TOTAL</td>
                    <td style="border: 1px solid black; text-align: center;"><?= sprintf("%.2f", $order['osSubTotal']); ?></td>
                </tr>
            </table>
		</div>
		<?php

		}

		?>
		<?php

		if($order['sendingOption'] == 'both') {

		?>
		<br>
		<br>
		<hr>
		<br>
		<br>
		<?php
		
		}

		?>
		<?php

		if($order['sendingOption'] == 'both' || $order['sendingOption'] == 'medical') {

		?>
		<div style="align-content: center; padding-bottom: 0px;">
			<table style="width:100%;">
				<tr>
					<td style="float:left; text-align: left;">
						<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="" height="120" width="120">
      					<h3>OHS Training & Consulting, Inc.</h3>
					</td>
					<td style="width: 10%;"></td>
					<td colspan="2" style="width:45%; text-align: right;">
						<h3><i>MEDICAL SUPPLY ORDER</i></h3>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
						<h4>9 Faunbar Ave</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
						LOCATION
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['msLocation'] ?>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
      					<h4>Suite #2</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
						DATE
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['msDate'] ?>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
      					<h4>Winthrop, MA 02152</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
						ADDRESS
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['msAddressLine1'] ?>
					</td>
				</tr>
				<tr>
					<td style="width: 45%; float:left; text-align: left;">
      					<h4>617-846-5059</h4>
					</td>
					<td style="width: 10%;"></td>
					<td style="width:20%; text-align: left;">
					</td>
					<td style="width:25%; text-align: center; border-bottom: 1px solid black;">
						<?php echo $order['msAddressLine2'] ?>
					</td>
				</tr>
			</table>
			<br>
			<br>
			<table style="width: 100%; border-collapse: none;">
                <tr style="border: 1px solid black;">
					<th style="border-right: 1px solid black; text-align: center; width: 45%;">SUPPLY ITEM DESCRIPTION</th>
					<th style="border-right: 1px solid black; text-align: center; width: 15%;">QUANTITY</th>
					<th style="border-right: 1px solid black; text-align: center; width: 20%;">UNIT PRICE</th>
					<th style="border-right: 1px solid black; text-align: center; width: 20%;">LINE TOTAL</th>
                </tr>
                <?php

                	$counter = 0;

                	foreach($medical_supplies as $ms){ ?>
                <tr style="border: 1px solid black;">
					<td style="border-right: 1px solid black; text-align: center;"><code><?= $ms->description; ?></td>
					<td style="border-right: 1px solid black; text-align: center;"><?= $ms->quantity; ?></td>
                    <td style="border-right: 1px solid black; text-align: center;"><?= sprintf("%.2f", $ms->unitPrice); ?></td>
                    <td style="text-align: center;"><?= sprintf("%.2f", $ms->lineTotal); ?></td>
                </tr>
                <?php
                		$counter = $counter + 1;

            		}

            	?>
                <tr>
					<td colspan="3" style="text-align: right; border: 1px solid black;">SUBTOTAL</td>
                    <td style="border: 1px solid black; text-align: center;"><?= sprintf("%.2f", $order['msSubTotal']); ?></td>
                </tr>
                <tr>
					<td colspan="3" style="text-align: right; border: 1px solid black;">TOTAL</td>
                    <td style="border: 1px solid black; text-align: center;"><?= sprintf("%.2f", $order['msTotal']); ?></td>
                </tr>
            </table>
		</div>
		<?php

		}

		?>
				</div>
			</div>

                <?php echo form_open(''); ?>
                <input type="hidden" name="invOrdrId" value="<?php echo $order['id']; ?>" id="invOrdrId" />
	          	<div class="box-footer">
	            	<?php
	            	if($order['statusId'] == 2) {
	            	?>
	            	<button type="submit" name="accept_inventory_order" class="btn btn-success">ACCEPT</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	            	<?php
	            	}
	            	?>
	            	<button type="submit" id="close_io_view" name="close_io_view" value="close_io_view" class="btn btn-warning">CLOSE</button>
	          	</div>
	            <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>