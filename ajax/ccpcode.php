<?php 
include '../dbcon.php';
	$sql = "SELECT * FROM `product` WHERE `product_code`='$CC_product_code'";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$ppidd = $row['p_id'];
	$productcode = $row['product_code'];
	echo '<option value="" selected disabled>Select Product Name</option>';
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
	echo "||";
	$pcat = getSpProdCat($row['pc_id'])->fetch_array();
	$pct = getSpProdType($row['pct_id'])->fetch_array();
	// echo $pcat[1];
	// echo "||";
	// echo $pct[1];
	$sql1= "SELECT * FROM `delivery_record` WHERE `p_id`='$ppidd' AND `dr_status`=1 ORDER BY `dr_date`  ASC LIMIT 1 ";
	$query1 = $con->query($sql1);
	$row1 = $query1->fetch_array();
	$cost = $row1['dr_cost'];
 ?>
<div class="form-group">
	<p style="margin-bottom: 2px;">Product Category</p>
	<h4 style="padding:6px;background-color: white;color:black;border-radius: 5px;"><?php echo $pcat[1]; ?></h4>
</div>
<div class="form-group">
	<p style="margin-bottom: 2px;">Product Type</p>
	<h4 style="padding:6px;background-color: white;color:black;border-radius: 5px;"><?php echo $pct[1]; ?></h4>
</div>
<div class="form-group">
	<p style="margin-bottom: 2px;">Product cost</p>
	<h4 style="padding:6px;background-color: white;color:black;border-radius: 5px;"><?php echo number_format($cost,2) ?></h4>
</div>
