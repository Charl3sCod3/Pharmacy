<?php 
include '../dbcon.php';
	$sql = "DELETE FROM `delivery_record` WHERE `dr_id`='$dr_id'";
	$query=$con->query($sql);
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}
 ?>