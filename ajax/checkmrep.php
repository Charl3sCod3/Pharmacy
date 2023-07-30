<?php 
include '../dbcon.php';
$today = date("Y-m-d");
$monthdate = date("Y-m-d", strtotime($today.' - 5 day'));
$actualdate = date("Y-m-t", strtotime($monthdate));
$check  = $con->query("SELECT * FROM `monthly_stock_report` WHERE `month_date_rep`='$actualdate'");
$cnumr = $check->num_rows;
echo $cnumr;
 ?>