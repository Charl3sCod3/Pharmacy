<?php 
include '../dbcon.php';
$sql = "SELECT * FROM `delivery_grouper` WHERE `dg_Ornumber`='$delornumber' AND `dg_actual_amount`='$delamout' AND `dg_dr_date`='$deldateInsert' ";
$query = $con->query($sql);
$nrow = $query->num_rows;
echo $nrow;

 ?>