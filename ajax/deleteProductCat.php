<?php 
include '../dbcon.php';
$check =  "SELECT * FROM `product` WHERE `pc_id`='$pc_id'";
$cquery = $con->query($check);
$cnrow = $cquery->num_rows;
if ($cnrow > 0) {
	echo "0";
}else{
	$table = "prod_cat";
	$conditions = array("pc_id" => $pc_id);
	$result = delete_records($table, $conditions);
	echo $result;
}

 ?>