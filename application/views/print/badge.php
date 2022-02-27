<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html style="padding-bottom: 0px;">

	<head>
	
		<title></title>

		<style type="text/css">
			@page { sheet-size: 3.375in 2.125in; margin: 0mm; }
		</style>

	</head>

	<body style="padding-bottom: 0px;">
		<div style="align-content: center; padding-bottom: 0px;">
			<div style="height: 2.125in; width: 3.375in; text-align: center; padding-bottom: 0px;" class="row card">
				<table style="width:100%;height: 100%;">
					<tr>
						<td rowspan="2" style="width: 25%; float:left; text-align: left;">
							<img src="<?php echo site_url('resources/img/ohs_logo.jpg');?>" alt="LOGO"  height="82" width="82">
						</td>
						<td style="width: 35%; font-size: 90%; text-align: left; padding-top: 5px; padding-bottom: 2px;"><br><h1 style="padding-bottom: 0px;">OHS</h1></td>
						<td style="font-size: 80%; width:40%; text-align: left;">
							<b><?php echo '# ' . $u['uid']; ?></b>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width: 75%; padding-bottom: 10px; padding-top: 0px;">Training & Consulting, Inc.</td>
					</tr>
				</table>
				<div style="height: 2.0mm; margin-left: 0.5mm; margin-right: 0.5mm; background: #CB262D"></div>
				<table style="width:100%;">
					<tr>
						<td rowspan="2" style="width:28%; float:left; text-align: left;">
							<?php

								if($u['imageURI']) {

							?>

									<img src="<?php echo $u['imageURI'];?>" style="height: 102px; width: 85px;" alt="User Image">

							<?php

								} else {

							?>

									<img src="<?php echo site_url('resources/img/user_default.png');?>" style="height: 102px; width: 85px;" alt="User Image">

							<?php

								}
							?>
						</td>
						<td style="width: 45%; font-size: 100%; font-family: Arial Narrow; text-align: left; padding-top: 5px;">
							<i><?php echo $u['fullName']; ?></i>
							<p style="font-size: 75%;"><?php echo ''; ?></p><br>
							<small><?php echo $u['city'] . ', ' . $u['state'] . ' ' . $u['zipCode']; ?></small>
						</td>
						<td style="width:27%; float: right; text-align: right;">
							<img src="<?php echo base_url('utility/getqrcode/' . $u['uid']);?>" alt="QRcode" height="80" width="80">
						</td>
					</tr>
					<tr>
						<td colspan="2" style="width: 80%; font-size: 80%; text-align: left;">
							&copy; <small>2017 OHS Training & Consulting, Inc.</small>
						</td>
					</tr>
				</table>

				<!-- <div style="font-size: 70%; text-align: center; padding-bottom: 0px;">
					&copy; <small>2017 OHS Training & Consulting, Inc.</small>
				</div> -->
			</div>
		</div>
	</body>

</html>