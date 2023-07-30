<?php 
include '../dbcon.php';
if (isset($setActiveCustomer)) {
	unset($_SESSION['setActiveCustomer']);
	$_SESSION['setActiveCustomer'] = $c_id;
}else{
	$_SESSION['setActiveCustomer'] = $c_id;
}
 ?>