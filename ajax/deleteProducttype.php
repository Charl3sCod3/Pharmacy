<?php 
include '../dbcon.php';
$check =  "SELECT * FROM `product` WHERE `pct_id`='$pct_id'";
$cquery = $con->query($check);
$cnrow = $cquery->num_rows;
if ($cnrow > 0) {
	echo "0";
}else{
	$table = "pc_type";
	$conditions = array("pct_id" => $pct_id);
	$result = delete_records($table, $conditions);
	echo $result;
}

 ?>