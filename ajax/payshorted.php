<?php 
include '../dbcon.php';
$newam = str_replace("-","",$amount);
	$sql ="INSERT INTO `shortage_payment`(`user_id`, `sp_date`, `sp_amount`) VALUES ('$uid','$todate','$newam')";
	$query = $con->query($sql);
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}	


 ?>