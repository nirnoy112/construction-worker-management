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
			@page { sheet-size: 2.0in 2.0in; margin: 0mm; }
		</style>

	</head>

	<body style="padding-bottom: 0px;">
		<img src="<?php echo base_url('utility/getqrcode/' . $w['uid']);?>" alt="QRcode" height="100%" width="100%">
	</body>

</html>