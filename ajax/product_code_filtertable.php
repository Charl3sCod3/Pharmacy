<?php 
include '../dbcon.php';
$pcde = explode(" ", $product_code);
	if (count($pcde) > 1) {
		$pcode = $pcde[0];
	}else{
		$pcode = $product_code;
	}
	echo $pcode
 ?>