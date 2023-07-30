<?php 
include '../dbcon.php';

	$sql = "DELETE FROM `suppliers` WHERE `sup_id`='$pc_id' ";
	$query = $con->query($sql);
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}

 ?>