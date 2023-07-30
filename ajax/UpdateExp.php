<?php 
include '../dbcon.php';
$sql = "UPDATE `delivery_record` SET `dr_expiration`='$expdate' WHERE `dr_id`='$dr_id'";
$query = $con->query($sql);
?>