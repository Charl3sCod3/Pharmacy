<?php 
	include '../dbcon.php';
	$sql ="SELECT * FROM `discount` WHERE `d_id`='$d_id' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$dp = $row['dp'];
	echo $dp;
 ?>