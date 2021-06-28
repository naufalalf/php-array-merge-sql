<?php
 $tgl=date('Y-m-d');

		
						header("Content-type: application/vnd-ms-excel");
						header("Content-Disposition: attachment; filename=jaksa-hari-".$tgl.".xls");
						include 'jaksa-hari.php';
	
?>

