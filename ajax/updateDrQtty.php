<?php 
include '../dbcon.php';

$sql = "UPDATE `delivery_record` SET `dr_qtty`='$value' WHERE `dr_id`='$dr_id' ";
$query = $con->query($sql);
if ($query) {
	echo "1";
}else{
	echo "0";
}

?>