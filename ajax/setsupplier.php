<?php 
include '../dbcon.php';
if (isset($tssuplier)) {
	unset($_SESSION['tssuplier']);
	$_SESSION['tssuplier'] = $sup_id;
}else{
	$_SESSION['tssuplier'] = $sup_id;
}


 ?>