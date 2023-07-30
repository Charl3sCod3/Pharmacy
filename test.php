<?php 
include 'dbcon.php';
// echo    idRandomizer();
$product_id =1;
$qtty = 600;
 $ids = '';
    $excluded_ps_ids = array(); // to keep track of already fetched ps_ids
    do {
        // Exclude ps_ids that have already been fetched
        if (!empty($excluded_ps_ids)) {
            $exclude_clause = "AND `ps_id` NOT IN (" . implode(",", $excluded_ps_ids) . ")";
        } else {
            $exclude_clause = "";
        }

        // Select the next ps_id
        $sql = "SELECT * FROM `product_sub` WHERE `p_id`='$product_id' $exclude_clause ORDER BY `ps_id` ASC LIMIT 1";
        $query = $con->query($sql);
        $row = $query->fetch_array();

        // If no more rows are returned, break out of the loop
        if (!$row) {
            break;
        }

        // Add the ps_id to the list of excluded ps_ids
        $excluded_ps_ids[] = $row['ps_id'];

        // Add the ps_id to $ids
        if ($qtty <= $row['p_qqty']) {
            $ids .= $row['ps_id'];
            $qtty = 0;
        } else {
            $ids .= $row['ps_id'] . '|';
            $qtty = $qtty - $row['p_qqty'];
        }
    } while ($qtty > 0);

    // Trim trailing '|' if present
    $ids = rtrim($ids, '|');

    // Get the price for the selected ps_ids
    $id = explode("|", $ids);
    $start = reset($id);
    $end = end($id);

    $getprice = "SELECT *, MAX(p_price) as actual_price FROM `product_sub` WHERE `ps_id` BETWEEN '$start' AND '$end'";
    $gpq = $con->query($getprice);
    $gpr = $gpq->fetch_array();

    echo  $gpr['actual_price'];
 ?>