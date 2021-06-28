<?php
 $tgl=date('Y-m-d');

		
						header("Content-type: application/vnd-ms-excel");
						header("Content-Disposition: attachment; filename=cyber-hari-".$tgl.".xls");
						include 'cyber-hari.php';
	
?>

