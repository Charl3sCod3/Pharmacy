<?php 
include '../dbcon.php';

	$sql = "SELECT * FROM `product` WHERE `p_id`='$p_id'  ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$product_code = $row['product_code'];
	$price = getActivePrice($p_id);
	$data = $product_code.'|'.$price;
	echo $data;
 ?>