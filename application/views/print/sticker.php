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
<html>

	<head>
	
		<title></title>

		<style type="text/css">
			@page { sheet-size: 3.5in 1.125in; margin: 0mm; }
		</style>

	</head>

	<body>
		<div style="align-content: center;">
			<div style="height: 1.125in; width: 3.5in; text-align: center;" class="sticker">
				<span><?php echo $name; ?></span>
				<br>
				<span><?php echo $dob; ?></span>
				<br>
				<img src="<?php echo base_url('utility/getbarcode/' . $uid);?>" alt="barcode">
			</div>
		</div>
	</body>

</html>