<?php 
include '../dbcon.php';
	$sql = "SELECT * FROM `product` WHERE `p_id`='$p_id'";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$productcode = $row['product_code'];
	echo $productcode;
	echo "||";
	$pcat = getSpProdCat($row['pc_id'])->fetch_array();
	$pct = getSpProdType($row['pct_id'])->fetch_array();
	// echo $pcat[1];
	// echo "||";
	// echo $pct[1];
	$sql1= "SELECT * FROM `delivery_record` WHERE `p_id`='$p_id' AND `dr_status`=1 ORDER BY `dr_date`  ASC LIMIT 1 ";
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
