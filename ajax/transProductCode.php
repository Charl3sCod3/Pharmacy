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
	$row = $cquery->fetch_array();
	$data = $row['p_name']; ?>
<option value="" selected disabled>Select Product Name</option>
<?php 
$gpq = getProductTrans();
while ($gpr = $gpq->fetch_array()) {
$gpdcat = getSpProdCat($gpr['pc_id']);
$gpcr = $gpdcat->fetch_array();
$pct = getSpProdType($gpr['pct_id'])->fetch_array();
?>
<option <?php echo selected($gpr[0],$row['p_id']) ?> value="<?php echo $gpr[0] ?>"><?php echo $gpr['p_name'] ?> ( <?php echo $gpcr['pc_name'] ?> | <?php echo $pct['pct_name'] ?>)</option>
<?php } ?>
<?php
	echo '||'.getActivePrice($row['p_id']);
?>