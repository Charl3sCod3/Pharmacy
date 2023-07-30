<?php 
include '../dbcon.php';
$today = date("Y-m-d");
$data = 1;
foreach ($cd_id as $key => $id) {
  $c = $cash[$key];
  $a = $cd_amount[$key];
  $sql = "INSERT INTO `sales_cashd`( `cd_id`, `scd_qtty`, `cd_amount`, `scd_date`, `user_id`) 
    VALUES ('$id','$c','$a','$today','$user_id')";
  $query = $con->query($sql);
  $update = "UPDATE `sales_report` SET `sale_status`=1 WHERE `user_id`='$user_id' AND `sale_date`='$today'";
    $upquery = $con->query($update);
  if (!$query) {
    $data = 0;
  }
}
echo $data;
 ?>