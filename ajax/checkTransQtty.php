<?php 
include '../dbcon.php';
$result = checkAvailableQtty($p_id,$trans_qtty);
echo $result;
 ?> 