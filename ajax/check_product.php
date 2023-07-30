<?php 
include '../dbcon.php';
	$pcde = explode(" ", $product_code);
	if (count($pcde) > 1) {
		$pcode = $pcde[0];
	}else{
		$pcode = $product_code;
	}
	$check = "SELECT * FROM `product` WHERE `product_code`='$pcode' ";
	$cquery = $con->query($check);
	$cnrow = $cquery->num_rows;
	if ($cnrow > 0) {
		$row = $cquery->fetch_array();
		$pid = $row['p_id'];
		echo '1||<option value="" selected disabled>SELECT PRODUCT NAME</option>';
		$gpq = getProductTrans1();
			while ($gpr = $gpq->fetch_array()) {
			$gpdcat = getSpProdCat($gpr['pc_id']);
			$gpcr = $gpdcat->fetch_array(); 
			$pct = getSpProdType($gpr['pct_id'])->fetch_array();
			if ($row[0]==$gpr[0]) {
				$selected="selected";
			}else{
				$selected="";
			}
			echo '<option '.$selected.' value="'.$gpr[0].'">'.$gpr['p_name'].' ( '.$gpcr['pc_name'].' | '.$pct['pct_name'].' )</option>';
	}
	}else{
		echo "0||".$product_code;
	}
 ?>