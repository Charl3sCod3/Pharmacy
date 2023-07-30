<?php 
session_start();
$con = new mysqli("localhost", "root", "", "pharmacy");
$con -> set_charset("utf8");	
extract($_POST);
extract($_GET);
extract($_SESSION);

if (isset($_SESSION['userid'])) {
  $user_id = $_SESSION['userid'];
  $getuserdata = "SELECT * FROM `wd_user` WHERE `user_id`='$user_id'";
  $userquery = $con->query($getuserdata);
  $user = $userquery->fetch_array();
  $usertype = $user['user_access'];
  $userfullname = $user['user_fullname'];
  $loginstat = "template/index1.php"; 

    $sssql = "SELECT * FROM `system_settings` WHERE 1=1 LIMIT 1";
	$ssquery = $con->query($sssql); 
	$ssnrow = $ssquery->num_rows;
	$ssrow = $ssquery->fetch_array();


  }else{
  $loginstat = "template/index.php";
  $content = "page_content/login.php";
  $title = "Login Form";
  }
function generate_random_string($length) {
  $letters = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
  return substr($letters, 0, $length);
}
function getdevset(){
	global $con;
	$sql = "SELECT * FROM `dev_set` WHERE 1=1";
		$query = $con->query($sql);
		$row = $query->fetch_array();
		return $row['ds_abbri'];
}
function idRandomizer(){
global $con;
$identifier = getdevset();
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$randomString = '';
$length = 18;

for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, strlen($characters) - 1)];
}

$randomString = strtoupper($randomString);
$finalid = $identifier.$randomString;
return $finalid;
}
function getcounter($table){
	global $con;
	$sql = "SELECT MAX(nc_counter) as max_counter FROM $table";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	return $row['max_counter']+1;
}
function expirationDate(){
	$month3 = date("Y-m-d", strtotime(date("Y-m-01"). '+ 3 month'));
	return $month3;
}
function selected($val1,$val2){
	if ($val1==$val2) {
		return "selected";
	}else{

	}

}

function getTodayTrans($user_id){
	global $con;
	$today = date("Y-m-d");
	$sql = "SELECT * FROM `customers` WHERE `transaction_date`='$today' AND `user_id`='$user_id'";
	$query = $con->query($sql);
	return $query;
}
function numberToDecimal($percentage){
	$decimal = $percentage / 100;
	return $decimal;
}
function DiscountedPrice($price,$discount){
	$discountis = numberToDecimal($discount);
	$discounted = $price - ($price * $discountis);
	return $discounted;
}
function getDiscounts(){
	global $con;
	$sql = "SELECT * FROM `discount` WHERE 1=1";
	$query = $con->query($sql);
	return $query;
}
function getSpDiscounts($that){
	global $con;
	$sql = "SELECT * FROM `discount` WHERE `d_id`='$that'";
	$query = $con->query($sql);
	return $query;
}
function checkNavActivity($data1,$data2){
	if ($data1 == $data2) {
		return  "active";
	}else{
		return "";
	}
}
function getSystem_usersActives(){
	global $con;
	$sql = "SELECT *,CASE 
            WHEN `user_status` = 1 THEN 'Active'
            WHEN `user_status` = 2 THEN 'De-activated'
            ELSE 'New User'
        END AS statusis ,CASE 
            WHEN `user_access` = 1 THEN 'Administrator'
            WHEN `user_access` = 2 THEN 'Cashier'
            WHEN `user_access` = 3 THEN 'Inventory Manager'
            WHEN `user_access` = 4 THEN 'user4'
        END AS useraccessis

        FROM `wd_user` WHERE `user_status` between 0 AND 2 ";
	$query = $con->query($sql);
	return $query;
}
function getSystem_usersActives1(){
	global $con;
	$sql = "SELECT *,CASE 
            WHEN user_status >= 1 THEN 'Active'
            WHEN user_status >= 2 THEN 'De-activated'
            ELSE 'New User'
        END AS statusis FROM `wd_user` WHERE `user_status`=1 ";
	$query = $con->query($sql);
	return $query;
}
function getSystem_usersNew(){
	global $con;
	$sql = "SELECT * FROM `wd_user` WHERE `user_status`=0 AND `user_access`!=1 ";
	$query = $con->query($sql);
	return $query;
}
function getSpUser($id){
	global $con;
	$sql = "SELECT * FROM `wd_user` WHERE `user_id`='$id' ";
	$query = $con->query($sql);
	return $query;
}
function getOrTotal($id){
	global $con;
	$grandtotal = 0;
	$sql = "SELECT * FROM `orders` WHERE `or_code`='$id' ";
	$query = $con->query($sql);
	while ($row = $query->fetch_array()) {
		$total = $row['or_price'] * $row['or_qtty'];
		$grandtotal = $grandtotal + $total;
	}
	return number_format($grandtotal,2);
}
function getProductCat(){
	global $con;
	$sql = "SELECT * FROM `prod_cat` WHERE 1=1 ";
	$query = $con->query($sql);
	return $query;
}
function getProductType(){
	global $con;
	$sql = "SELECT * FROM `pc_type` WHERE 1=1 ";
	$query = $con->query($sql);
	return $query;
}
function getSpProdCat($that){
	global $con;
	$sql = "SELECT * FROM `prod_cat` WHERE `pc_id`='$that' ";
	$query = $con->query($sql);
	return $query;
}
function getSpProdType($that){
	global $con;
	$sql = "SELECT * FROM `pc_type` WHERE `pct_id`='$that' ";
	$query = $con->query($sql);
	return $query;
}
function getSpProduct($that){
	global $con;
	$sql = "SELECT * FROM `product` WHERE `p_id`='$that' ";
	$query = $con->query($sql);
	return $query;
}
function getSpSupplier($that){
	global $con;
	$sql = "SELECT * FROM `suppliers` WHERE `sup_id`='$that' ";
	$query = $con->query($sql);
	return $query;
}
function getSuppliers(){
	global $con;
	$sql = "SELECT * FROM `suppliers` WHERE 1=1 ";
	$query = $con->query($sql);
	return $query;
}

function delete_records($table, $conditions){
    global $con;
      // Prepare the delete query
    $sql = "DELETE FROM $table WHERE ";
    foreach ($conditions as $key => $value) {
        $sql .= " `$key` = '$value' AND ";
    }
    $sql = rtrim($sql, " AND ");
    $query  = $con->query($sql);
    if ($query) {
    	echo '1';
    }else{
    	echo '0';
    }
}
function tars_query($table, $conditions){
	global $con;
	$sql = "INSERT INTO $table (";
		$params = array();
		$column = array();
    foreach ($conditions as $key => $value) {
        $params[] = $value;
        $column[] = $key;
    }
    foreach ($column as $key){
    	$sql .= "`$key` , ";
    }
     $sql = rtrim($sql, " , ");
    $sql .= ") Values (";
    foreach ($params as $key){
    	$sql .= "'$key' , ";
    }
    $sql = rtrim($sql, " , ");
    $sql .= ")";

    $query = $con->query($sql);
    if ($query) {
    	echo '1';
    }else{
    	echo '0';
    }
}
function getDeliveredListRaw($supplier){
	global $con;
	$sql = "SELECT * FROM `delivery_record` WHERE `sup_id`='$supplier' AND `dr_status`=0 ORDER BY `dr_id` DESC ";
	$query = $con->query($sql);
	return $query;
}
function getProductName($product_id){
	global $con;
	$sql = "SELECT * FROM `product` WHERE `p_id`='$product_id' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	return $row['p_name'];
}
function getproductcode($product_id){
	global $con;
	$sql = "SELECT * FROM `product` WHERE `p_id`='$product_id' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	return $row['product_code'];
}
function DrAddtoInventory($supplier_id){
	global $con;
	$query = $con->query("SELECT * FROM `delivery_record` WHERE `dr_status`=0 AND 
		((`dr_expiration`='0000-00-00') OR (`dr_qtty`<='0') OR (`dr_price`<='0'))");
	$nrow = $query->num_rows;
	if ($nrow >0) {
		return '0';
	}else{

	}
		
}
function addDeliveryToInventory($supplier,$deldate,$ORNUM,$DRTOTAL,$DLT){ 
	global $con;

		$check_delivery = "SELECT * FROM `delivery_record` WHERE `sup_id`='$supplier' AND `dr_status`=0 AND (( `dr_qtty` < 1 ) OR ( `dr_price`< 1 ) )";
		$cquery = $con->query($check_delivery);
		$cnrow = $cquery->num_rows;

		if ($cnrow > 0) { 
			return '4';
		}else{

			$getDrItems = "SELECT * FROM `delivery_record` WHERE `sup_id`='$supplier' AND `dr_status`=0";
			$gdrq = $con->query($getDrItems);
			while ($gdr = $gdrq->fetch_array()) {
				$pId = $gdr['p_id'];
				$drqtty = $gdr['dr_qtty'];
				$drprice = $gdr['dr_price'];
				$drexp = $gdr['dr_expiration'];
				$dr_cost = $gdr['dr_cost'];
				$drid = $gdr[0];
				$insert = "INSERT INTO `product_sub`(`p_id`, `p_qqty`, `p_price`, `expiration_date`,`dr_id`,`cost`,`dg_Ornumber`,`drid`) VALUES 
																							('$pId','$drqtty','$drprice','$drexp','$supplier','$dr_cost','$ORNUM','$drid')";
				$inquery = $con->query($insert);
			}

			$sql = "UPDATE `delivery_record` SET `dr_date`='$deldate',`dr_status`=1, `dg_Ornumber`='$ORNUM' WHERE `sup_id`='$supplier' AND `dr_status`=0 ";
			$query =$con->query($sql);

			$sqlrev ="INSERT INTO `delivery_grouper`(`dg_dr_date`, `dg_Ornumber`, `dg_amount`, `dg_actual_amount`,`sup_id`) VALUES ('$deldate','$ORNUM','$DRTOTAL','$DLT','$supplier')";
			$queryrev = $con->query($sqlrev);

			if ($query) {
				return '1';
			}else{
				return '0';
			}

		}

}
function getActivePrice1($product_id,$qtty){
	global $con;
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

    return  $gpr['actual_price'];

}
function getActivePrice($product_id){
	global $con;
	$sql ="SELECT * FROM `product_sub` WHERE `p_id`='$product_id' ORDER BY `ps_id` ASC Limit 1";
	$query =$con->query($sql);
	$row = $query->fetch_array();
	$price = $row['p_price'];

	return $price;
}
function getAllUsers(){
	global $con;
	$sql = "SELECT * FROM `wd_user` WHERE 1=1 ";
	$query = $con->query($sql);
	return $query;
}
function getActiveCost($product_id){
	global $con;
	$sql ="SELECT * FROM `product_sub` WHERE `p_id`='$product_id' ORDER BY `ps_id` ASC Limit 1";
	$query =$con->query($sql);
	$row = $query->fetch_array();
	$cost = $row['cost'];
	return $cost;
}
function getAllProduct(){
	global $con;
	$month3 = expirationDate();
	$sql = "SELECT * FROM `product` WHERE 1=1 ";
	$query = $con->query($sql);
	return $query;
}
function getProductTrans(){
	global $con;
	$month3 = expirationDate();
	$sql = "SELECT * FROM `product` INNER JOIN `product_sub` ON product.p_id=product_sub.p_id WHERE product_sub.expiration_date > '$month3' GROUP BY product.p_id ";
	$query = $con->query($sql);
	return $query;
}
function getProductTrans1(){
	global $con;
	$month3 = expirationDate();
	$sql = "SELECT * FROM `product` Where 1=1 ORDER BY `p_name` ASC ";
	$query = $con->query($sql);
	return $query;
}


function getActiveCustomer($user_id){
	global $con;
	$sql = "SELECT * FROM `customers` WHERE `c_status`=0 AND `user_id`='$user_id' ";
	$query = $con->query($sql);
	return $query;
}
function getActiveCustomer1(){
	global $con;
	$sql = "SELECT * FROM `customers` WHERE `c_status`=0 AND `user_id`=0 ";
	$query = $con->query($sql);
	return $query;
}
function getSpActiveCustomer($a){
	global $con;
	$sql = "SELECT * FROM `customers` WHERE `c_id`='$a' ";
	$query = $con->query($sql);
	return $query;

}

function checkAvailableQtty($p_id, $trans_qtty) {
    global $con;
    $month3 = expirationDate();
    $sql = "SELECT *, SUM(p_qqty) as `newqtty` FROM `product_sub` WHERE `p_id`='$p_id' AND `expiration_date`>'$month3'";
    $query = $con->query($sql);
    $row = $query->fetch_array();
    $avQtty = $row['newqtty'];
    $activeprice = getActivePrice1($p_id, $trans_qtty);
    if ($avQtty >= $trans_qtty) {
        return '1|'.$activeprice;
    } else {
        return '0|'.$activeprice;
    }
}
function getCustomerOrder($c_id){
	global $con;
	$sql = "SELECT * FROM `customer_order` WHERE `c_id`='$c_id' AND `co_status`=0 ";
	$query = $con->query($sql);
	return $query;
}
function getTransactionItem($p_id){
	global $con;
	$sql = "SELECT * FROM `product` as p inner join `prod_cat` as pc inner join `pc_type` as pt  WHERE p.p_id='$p_id' AND p.pc_id=pc.pc_id AND p.pct_id=pt.pct_id ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$desc = $row['p_name'].'('.$row['pc_name'].')'.$row['pct_name'];
	return $desc;
}
function getTotalAmmount($id){
global $con;
$getOrList = getCustomerOrder($id);
$grandtotal = 0;
	while ($golr = $getOrList->fetch_array()) {
					$dessc = getTransactionItem($golr['p_id']);
					if ($golr['co_price'] < 1) {
							$actprice = getActivePrice($golr['p_id']);
						}else{
							$actprice = $golr['co_price'];
						}
					// $actprice = getActivePrice($golr['p_id']);

					$productcodeis = getproductcode($golr['p_id']);
					$transamm = $actprice * $golr['co_qtty'];
					$grandtotal = $grandtotal + $transamm;
	}
	return $grandtotal;
}
function getProductStock($that){
	global $con;
	$month3 = expirationDate();
	$sql = "SELECT *, SUM(p_qqty) as `newqtty` FROM `product_sub` WHERE `p_id`='$that' AND `expiration_date` > '$month3' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$numrow = $query->num_rows;
	if ($numrow > 0) {
		return $row['newqtty'];		
	}else{
		return '0';
	}
}
function checktheqtty($that,$qttycap){
	$month3 = expirationDate();
	global $con;
	$sql = "SELECT *, SUM(p_qqty) as `newqtty` FROM `product_sub` WHERE `p_id`='$that' AND `expiration_date` > '$month3' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	 $numrow = $query->num_rows;
	 if ($numrow > 0) {
	 	if ($qttycap >= $row['newqtty']) {
			 	return "1";
			 }else{
			 	return "0";
			 }
	 }else{
	 	echo "1";
	 }
}
function getExpiredProducts(){
	global $con;
	$month6 = date("Y-m-d", strtotime(date("Y-m-d"). '+ 6 month'));
	$sql = "SELECT * FROM `product_sub` WHERE `expiration_date` <= '$month6' ";
	$query = $con->query($sql);
	return $query;

}
function getExpiredProducts1(){
	global $con;
	$month6 = date("Y-m-d", strtotime(date("Y-m-d"). '+ 3 month'));
	$sql = "SELECT * FROM `product_sub` WHERE `expiration_date` <= '$month6' ";
	$query = $con->query($sql);
	return $query;

}


function getTodayGrandtotalSales($user_id){
global $con;
	$today = date("Y-m-d");
	$sql = "SELECT * FROM `sales_report` WHERE `user_id`='$user_id' AND `sale_status` between 0 AND 1 AND `sale_date`='$today' ";
	$query = $con->query($sql);
	$data = "";
	$i=0;
	$grandtotal =0;
	while ($row = $query->fetch_array()) {
		$pp_iid = $row['p_id'];
		$rowprod = getSpProduct($pp_iid)->fetch_array();
		$pcat = $rowprod['pc_id'];
		$rowpcat = getSpProdCat($pcat)->fetch_array();
		$total = $row['sale_qtty']*$row['sale_price'];
		$grandtotal = $grandtotal + $total;
	}
	return $grandtotal;
}
function getCashfloat($user_id,$pt_date){
	global $con;
	$sql = "SELECT * FROM `petty_cash` WHERE `user_id`='$user_id' AND `pt_date`='$pt_date' ";
	$query = $con->query($sql);
	return $query;
}
function getCashfloat1($user_id,$pt_date){
	global $con;
	$sql = "SELECT * FROM `petty_cash` WHERE `user_id`='$user_id' AND `pt_date`='$pt_date' ";
	$query = $con->query($sql);
	return $query;
}
function getCFdata($user_id){
	$pt_date = date("Y-m-d");
	$cashfloat = getCashfloat($user_id,$pt_date)->fetch_array();
	$cf = $cashfloat['pt_cash'];
	return $cf;
}
function getSubmittedSalesByDate($user_id,$today){
	global $con;
	$sql = "SELECT * FROM `sales_report` WHERE `user_id`='$user_id' AND `sale_status` = 1 AND `sale_date`='$today'  ";
	$query = $con->query($sql);
	$data = "";
	$i=0;
	$grandtotal =0;
	$grandcost = 0;
	$profit = 0;
	$nrow = $query->num_rows;
	$total_discount = 0;
	while ($row = $query->fetch_array()) {
			$i++;
			$pp_iid = $row['p_id'];
			$rowprod = getSpProduct($pp_iid)->fetch_array();
			$pcat = $rowprod['pc_id'];
			$rowpcat = getSpProdCat($pcat)->fetch_array();
			$total = $row['sale_qtty']*$row['sale_price'];
			$totalcost = $row['sale_qtty'] * $row['sale_cost'];
			$grandtotal = $grandtotal + $total;
			$grandcost = $grandcost + $totalcost;
			$profit = $grandtotal - $grandcost;
			$discount = $row['the_discount'] * $row['sale_qtty'];
			$total_discount += $discount;
			$data .= '<tr>';
			$data .= '<td>';
			$data .= $i;
			$data .= '</td>';
			$data .= '<td>';
			$data .= $rowprod['p_name'].'<br><i style="color:red;">('.$rowpcat['pc_name'].')</i> ';
			$data .= '</td>';
			$data .= '<td align="center">';
			$data .= $row['sale_qtty'];
			$data .= '</td>';
			$data .= '<td align="right">';
			$data .= '₱'.number_format($row['sale_price'],2).'<br> <i style="color:red;">('.'₱'.number_format($row['sale_cost'],2).')</i>';
			$data .= '</td>';
			$data .= '<td align="right" style="font-weight:700;">';
			$data .= '₱'.number_format($total,2).'<br> <i style="color:red;">('.'₱'.number_format($totalcost,2).')</i>';
			$data .= '</td>';
						$data .= '<td align="right" style="font-weight:700;">';
			$data .= '₱'.number_format($total_discount,2);
			$data .= '</td>';
			$data .= '</tr>';

	}
	if ($nrow < 1) {
			$data .= '<tr>';
			$data .= '<td colspan="5" align="center">';
			$data .= 'No Sales Report';
			$data .= '</td>';
			$data .= '</tr>';
	}
			$spg = "SELECT * FROM `shortage_payment` WHERE `user_id`='$user_id' AND `sp_date`='$today'";
			$spgq = $con->query($spg);
			$spgr = $spgq->fetch_array();
			$totalcd = gettotalCDToday($user_id);
			$totalcd += $spgr['sp_amount'];
			$cf_data = getCFdata($user_id);
			$totalcash = $cf_data + $grandtotal;
			$cashdiff = $totalcd - $totalcash;
			$yawa = $today;
			$data .= '<tfoot style="font-weight:800;">';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="4" align="right">';
			$data .= 'CASH FLOAT :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($cf_data,2);
			$data .= '</td>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="4" align="right">';
			$data .= 'NET SALES :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($grandtotal,2).' <br><i style="color:red;">'.'₱'.number_format($grandcost,2).'</i>';
			$data .= '</td>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="4" align="right">';
			$data .= 'TOTAL CASH :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($totalcash,2);
			$data .= '</td>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="4" align="right">';
			$data .= 'CASH DINOMINATION :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($totalcd,2);
			$data .= '</td>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="4" align="right">';
			$data .= 'CASH SHORT :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($cashdiff,2);
			$data .= '</td>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="2" align="right">';
			$data .= 'NET SALES :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($grandtotal,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px" rowspan="2" colspan="1" align="right">';
			$data .= 'PROFIT :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" rowspan="2" align="right">';
			$data .= '₱'.number_format($profit,2);
			$data .= '</td>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="2" align="right">';
			$data .= 'COST OF SOLD GOODS :';
			$data .= '</td>';
			$data .= '<td style="padding:3px" align="right">';
			$data .= '₱'.number_format($grandcost,2);
			$data .= '</td>';
			$data .= '</tr>';
			if ($cashdiff < 0) {
			$data .= '<tr>';
			$data .= '<td style="padding:3px" colspan="5">';
			$data .= '<div class="form-group">
                <button onclick="payshorted('.$user_id.',\''.$yawa.'\','.$cashdiff.')" class="btn btn-primary btn-sm float-right"><i class="fas fa-coins"></i> Pay shortage'.$spgr['sp_amount'].'</button>
            </div>';
			$data .= '</td>';
			$data .= '</tr>';
				}
			$data .= '</tfoot>';

	return $data;
}
function getTodaySales($user_id){
	global $con;
	$today = date("Y-m-d");
	$sql = "SELECT * FROM `sales_report` WHERE `user_id`='$user_id' AND `sale_date`='$today'  ";
	$query = $con->query($sql);
	$data = "";
	$i=0;
	$grandtotal =0;
	$grandcost = 0;
	$profit = 0;
	while ($row = $query->fetch_array()) {
		$i++;
		$pp_iid = $row['p_id'];
		// $gqtty = "SELECT *, SUM(sale_qtty) as newqtty FROM `sales_report` WHERE `p_id`='$pp_iid' AND  `user_id`='$user_id' AND `sale_status` = 0 AND `sale_date`='$today' ";
		// $gqttyq = $con->query($gqtty);
		// $qttyrow = $gqttyq->fetch_array();
		$rowprod = getSpProduct($pp_iid)->fetch_array();
		$pcat = $rowprod['pc_id'];
		$rowpcat = getSpProdCat($pcat)->fetch_array();
		$total = $row['sale_qtty']*$row['sale_price'];
		$totalcost = $row['sale_qtty'] * $row['sale_cost'];
		$grandtotal = $grandtotal + $total;
		$grandcost = $grandcost + $totalcost;
		$profit = $grandtotal- $grandcost;
		$data .= '<tr>';
		$data .= '<td>';
		$data .= $i;
		$data .= '</td>';
		$data .= '<td>';
		$data .= $rowprod['p_name'].' ('.$rowpcat['pc_name'].') ';
		$data .= '</td>';
		$data .= '<td align="center">';
		$data .= $row['sale_qtty'];
		$data .= '</td>';
		$data .= '<td align="right">';
		$data .= '₱'.number_format($row['sale_price'],2);
		$data .= '</td>';
		$data .= '<td align="right" style="font-weight:700;">';
		$data .= '₱'.number_format($total,2);
		$data .= '</td>';
		$data .= '</tr>';

	}
		$totalcd = gettotalCDToday($user_id);
		$cf_data = getCFdata($user_id);
		$totalcash = $cf_data + $grandtotal;
		$cashdiff = $totalcd - $totalcash;
		$data .= '<tfoot style="font-weight:800;">';
		$data .= '<tr>';
		$data .= '<td colspan="4" align="right">';
		$data .= 'CASH FLOAT :';
		$data .= '</td>';
		$data .= '<td align="right">';
		$data .= '₱'.number_format($cf_data,2);
		$data .= '</td>';
		$data .= '</tr>';
		$data .= '<tr>';
		$data .= '<td colspan="4" align="right">';
		$data .= 'NET SALES :';
		$data .= '</td>';
		$data .= '<td align="right">';
		$data .= '₱'.number_format($grandtotal,2);
		$data .= '</td>';
		$data .= '</tr>';
		$data .= '<tr>';
		$data .= '<td colspan="4" align="right">';
		$data .= 'TOTAL CASH :';
		$data .= '</td>';
		$data .= '<td align="right">';
		$data .= '₱'.number_format($totalcash,2);
		$data .= '</td>';
		$data .= '</tr>';
		// $data .= '<tr>';
		// $data .= '<td colspan="4" align="right">';
		// $data .= 'CASH DINOMINATION :';
		// $data .= '</td>';
		// $data .= '<td align="right">';
		// $data .= '₱'.number_format($totalcd,2);
		// $data .= '</td>';
		// $data .= '</tr>';
		// $data .= '<tr>';
		// $data .= '<td colspan="4" align="right">';
		// $data .= 'CASH DIFF :';
		// $data .= '</td>';
		// $data .= '<td align="right">';
		// $data .= '₱'.number_format($cashdiff,2);
		// $data .= '</td>';
		// $data .= '</tr>';
		// $data .= '<tr>';
		// $data .= '<td colspan="3" align="right">';
		// $data .= 'NET SALES :';
		// $data .= '</td>';
		// $data .= '<td align="right">';
		// $data .= '₱'.number_format($grandtotal,2);
		// $data .= '</td>';
		// $data .= '<td rowspan="2" colspan="2" align="right">';
		// $data .= 'PROFIT :';
		// $data .= '</td>';
		// $data .= '<td rowspan="2" align="right">';
		// $data .= '₱'.number_format($profit,2);
		// $data .= '</td>';
		// $data .= '</tr>';
		// $data .= '<tr>';
		// $data .= '<td colspan="3" align="right">';
		// $data .= 'COST OF SOLD GOODS :';
		// $data .= '</td>';
		// $data .= '<td align="right">';
		// $data .= '₱'.number_format($grandcost,2);
		// $data .= '</td>';
		// $data .= '</tr>';
		$data .= '</tfoot>';
	return $data;
}

function getCashDenomination(){
	global $con;
	$sql = "SELECT * FROM `cash_denomination` WHERE 1=1";
	$query = $con->query($sql);
	return $query;
}
function generate_transaction_code() {
  // Get today's date in YYYYMM format
  $date = date('ymd');

  // Define all possible characters that can be used in the code
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

  // Generate a random code of length 4
  $code = "";
  for ($i = 0; $i < 6; $i++) {
    $code .= $chars[rand(0, strlen($chars) - 1)];
  }

  // Combine the date and random code to form the complete transaction code
  $transaction_code = $date . $code;

  return $transaction_code;
}
function AlmostExpired(){ 
	$gp = getProductTrans1();
	$i=0;
					while ($gr = $gp->fetch_array()) {
						$pcat = getSpProdCat($gr['pc_id'])->fetch_array();
						$pct = getSpProdType($gr['pct_id'])->fetch_array();
						$stock = getProductStock($gr[0]);
						$checkqtty = checktheqtty($gr[0],$gr['cap_qtty']);
						if ($checkqtty > 0) {
							$i++;
						}
					}
	return $i;
}
function getExpiredMeds(){
$ge = getExpiredProducts1();
$i=0;
		while($ger = $ge->fetch_array()){
			$i += $ger['p_qqty'];
		}
		return $i;
}
function transaction_search($search_request){
	global $con;
$sql = "SELECT * FROM `customers` WHERE `c_status` = 1 ";
$sql .= "AND (`cname` LIKE '%" . $search_request . "%' ";
$sql .= "OR `transaction_code` LIKE '%" . $search_request . "%' ";
$sql .= "OR `transaction_date` LIKE '%" . $search_request . "%')";
$sql .= " ORDER BY `c_id` DESC ";
$query = $con->query($sql);
return $query;
}


function checkSalesSubmitted($user_id){
	global $con;
	$today = date("Y-m-d");
	$sql = "SELECT * FROM `sales_cashd` WHERE `scd_date`='$today' AND `user_id`='$user_id' ";
	$query = $con->query($sql);
	$nrow = $query->num_rows;
	return $nrow;
}
function checkSalesSubmittedByDate($user_id,$today){
	global $con;
	$sql = "SELECT * FROM `sales_cashd` WHERE `scd_date`='$today' AND `user_id`='$user_id' ";
	$query = $con->query($sql);
	$nrow = $query->num_rows;
	return $nrow;
}
function getsubmittedCashDByDateRange($user_id,$start,$end){
global $con;
	$today = date("Y-m-d");
	$sql = "SELECT * FROM `sales_cashd` WHERE `user_id`='$user_id' AND `scd_date` BETWEEN '$start' AND '$end' ";
	$query = $con->query($sql);
	return $query;
}
function getsubmittedCD($user_id){
global $con;
	$today = date("Y-m-d");
	$sql = "SELECT * FROM `sales_cashd` WHERE `scd_date`='$today' AND `user_id`='$user_id' ";
	$query = $con->query($sql);
	return $query;
}
function getSubmittedSalesByDateByUser($user_id,$today){
global $con;
	$sql = "SELECT * FROM `sales_cashd` WHERE `scd_date`='$today' AND `user_id`='$user_id' ";
	$query = $con->query($sql);
	return $query;
}
function getsubmittedCdType($cd_id){
	global $con;
	$sql = "SELECT * FROM `cash_denomination` WHERE `cd_id`='$cd_id' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	return $row['cd_type'];
}

function gettotalCDToday($user_id){
	$Cdis = getsubmittedCD($user_id);
	$grandtotal = 0;
		 				while($cdris = $Cdis->fetch_array()){
		 					$cdtotal = $cdris['scd_qtty'] * $cdris['cd_amount'];
		 					$grandtotal += $cdtotal;
		 				}
		 			return $grandtotal;
}
function gettotalCDDate($user_id,$today){
	$Cdis = getSubmittedSalesByDateByUser($user_id,$today);
	$grandtotal = 0;
		 				while($cdris = $Cdis->fetch_array()){
		 					$cdtotal = $cdris['scd_qtty'] * $cdris['cd_amount'];
		 					$grandtotal += $cdtotal;
		 				}
		 			return $grandtotal;
}


function SalesReport($what,$month,$year){
	global $con;
	if ($what > 0) {
		$start = date("Y-m-d", strtotime("$year-$month-01"));
 		$end = date("Y-m-d", strtotime("$year-$month-".date("t", strtotime("$year-$month-01"))));
 		if ($what < 2) {
 		$start = date("Y-m-d", strtotime("$year-$month-01"));
 		$end = date("Y-m-d", strtotime("$year-$month-".date("t", strtotime("$year-$month-01"))));
 		}else{
 		$firstDate = date("Y-m-d", strtotime("$year-01-01"));
  	$lastDate = date("Y-m-d", strtotime("$year-12-31"));
 		}
	}else{
		$start = $month; 
		$end = $month;
	}
	
if ($what == 3) {
	$start = date("Y-m-d", strtotime($month));
	$end = date("Y-m-d", strtotime($year));
		$sql = "SELECT * FROM `sales_report` WHERE  `sale_status` = 1 AND `sale_date` BETWEEN '$start' AND '$end' GROUP BY `p_id`,`sale_price`,`sale_cost`  ";
}else{
		$sql = "SELECT * FROM `sales_report` WHERE  `sale_status` = 1 AND `sale_date`>='$start' AND `sale_date`<= '$end' GROUP BY `p_id`,`sale_price`,`sale_cost`  ";
}
	$query = $con->query($sql);
	$data = "";
	$i=0;
	$grandtotal =0;
	$grandcost = 0;
	$profit = 0;
	$discount =0;
	$sellprice =0;
	$costprice=0;
	$quantits = 0;

	$nrow = $query->num_rows;
	$data.='<table id="example8" style="font-size:14px;" class="table table-bordered">';
	$data.='<thead style="background-color:#646464;color:white;">';
	$data.='<tr>';
	$data.='<th>#</th>';
	$data.='<th>Product Name</th>';
	$data.='<th>Qty Sold</th>';
	$data.='<th>Selling Price (SRP)</th>';
	$data.='<th>Discount</th>';
	$data.='<th>Net Sales (P)</th>';
	$data.='<th>Cost/Unit</th>';
	$data.='<th>Total Cost</th>';
	$data.='</tr>';
	$data.='</thead>';
	$data.='<tbody>';
	while ($row = $query->fetch_array()) {
		$ppid = $row['p_id'];
		$ssaleprice = $row['sale_price'];
		$ssalecost = $row['sale_cost'];
		$getqtty ="SELECT *, SUM(sale_qtty) as `new_qtty` FROM `sales_report` WHERE  `sale_status` = 1 AND `sale_date`>='$start' AND `sale_date`<= '$end' AND `p_id`='$ppid' AND `sale_price`='$ssaleprice' AND `sale_cost`='$ssalecost' ";
		$gqquery = $con->query($getqtty);
		$gqrow = $gqquery->fetch_array();

			$i++;
			$pp_iid = $row['p_id'];
			$rowprod = getSpProduct($pp_iid)->fetch_array();
			$pcat = $rowprod['pc_id'];
			$rowpcat = getSpProdCat($pcat)->fetch_array();
			$rowpt = getSpProdType($rowprod['pct_id'])->fetch_array();
			$total = $gqrow['new_qtty']*$row['sale_price'];
			$totalcost = $gqrow['new_qtty'] * $row['sale_cost'];
			$grandtotal = $grandtotal + $total;
			$grandcost = $grandcost + $totalcost;
			$profit = $grandtotal - $grandcost;
			$discount += $row['the_discount'];
			$sellprice +=$row['sale_price'];
			$costprice +=$row['sale_cost'];
			$quantits +=$row['sale_qtty'];

			$data .= '<tr>';
			$data .= '<td style="padding:3px;vertical-align:middle">';
			$data .= $i;
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle">';
			$data .= $rowprod['p_name'].' <i style="color:red;">('.$rowpcat['pc_name'].') '.$rowpt['pct_name'].'</i> ';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="center">';
			$data .= $gqrow['new_qtty'];
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right">';
			$data .= '₱'.number_format($row['sale_price'],2).'<br> <i style="color:red;"></i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right">';
			$data .= '₱'.number_format($row['the_discount'],2).'<br> <i style="color:red;"></i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right" style="font-weight:700;">';
			$data .= '₱'.number_format($total,2).'<br> <i style="color:red;"></i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right">';
			$data .= '₱'.number_format($row['sale_cost'],2).'</i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right" style="font-weight:700;">';
			$data .= '₱'.number_format($totalcost,2).'</i>';
			$data .= '</td>';
			$data .= '</tr>';

	}
	if ($nrow < 1) {
			// $data .= '<tr>';
			// $data .= '<td style="padding:3px;" colspan="5" align="center">';
			// $data .= 'No Sales Report';
			// $data .= '</td>';
			// $data .= '</tr>';
	}
			// $data .= '</body>';
			// $data .= '</table>';

			// $data .= '<table class="table table-bordered" style="font-weight:bold">';
			// $data .= '<tfoot>';
			$data .= '<tr style="font-weight:700;background-color:#646464;color:white;" >';
			$data .= '<td>';
			$data .= '';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:centernumber_format(;" align="center">';
			$data .= 'GRANDTOTAL';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($quantits,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($sellprice,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($discount,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($grandtotal,2);
			$data .= '</td>';
			$data .= '<td >';
			$data .= number_format($costprice,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($grandcost,2);
			$data .= '</td>';
			$data .= '</tr>';

			for ($i=0; $i <2 ; $i++) { 
				$data .= '<tr >';
				$data .= '<th>';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th >';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '</tr>';
			}

			$data .= '<tr >';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'Summary';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'Net Sales';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= '₱'.number_format($grandtotal,2);
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';

			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'COGS';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;border-bottom:solid 2px black" align="center">';
			$data .= '₱'.number_format($grandcost,2);
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';


			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'Profit';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= '₱'.number_format($profit,2);
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';

			// $data .= '</tfoot>';
			$data .= '</tbody>';
			$data .= '</table>';


	return $data;
}
function databaseBackup(){
	// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// MySQL database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'pharmacy';

// Connect to MySQL
$conn = mysqli_connect($host, $username, $password, $database);

// Get all table names from the database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Loop through all tables and generate SQL statements to export their data
$sql = '';
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT * FROM $table");
    $num_fields = mysqli_num_fields($result);

    $sql .= "DROP TABLE IF EXISTS `$table`;\n";
    $create_table = mysqli_query($conn, "SHOW CREATE TABLE `$table`");
    $row = mysqli_fetch_row($create_table);
    $sql .= $row[1] . ";\n\n";

    while ($row = mysqli_fetch_row($result)) {
        $sql .= "INSERT INTO `$table` VALUES(";
        for ($i = 0; $i < $num_fields; $i++) {
            $row[$i] = addslashes($row[$i]);
            $row[$i] = str_replace("\n","\\n",$row[$i]);
            if (isset($row[$i])) {
                $sql .= '"' . $row[$i] . '"';
            } else {
                $sql .= 'NULL';
            }
            if ($i < ($num_fields-1)) {
                $sql .= ',';
            }
        }
        $sql .= ");\n";
    }
    $sql .= "\n";
}

// Set the filename and path for the backup file
$date = date('Y-m-d');
$filename = "database_backup_$date.sql";
$directory = "C:/database_backup";
$filepath = $directory . '/' . $filename;

// Create the directory if it doesn't exist
if (!is_dir($directory)) {
    if (!mkdir($directory, 0777, true)) {
        die("Error: Failed to create directory.");
    }
}

// Check if the backup file already exists, and delete it if it does
if (file_exists($filepath)) {
    unlink($filepath);
}

// Write the SQL statements to the backup file
if (file_put_contents($filepath, $sql) !== false) {
} else {

}

}

function getTopSellingProducts() {
    global $con;

    // Prepare the SQL query
    $query = "SELECT p.p_name, SUM(sr.sale_qtty) as total_quantity_sold 
              FROM Product p 
              INNER JOIN sales_report sr ON p.p_id = sr.p_id 
              WHERE sr.sale_status = 1 
              GROUP BY p.p_name 
              ORDER BY total_quantity_sold DESC 
              LIMIT 10";

    // Execute the query
    $result = $con->query($query);

    // Check for query errors
    if (!$result) {
        die("Query failed: " . $con->error);
    }
// Fetch the results as an associative array
    $results = array();
    while ($row = $result->fetch_assoc()) {
        $results[] = $row;
    }
    // Close the database connection


    // Return the results array
    return $results;

}

function getTop20ProductCategories() {
    global $con;

    // Query to retrieve the top 20 product categories
    $query = "SELECT pc.pc_name, COUNT(p.p_id) AS num_products
              FROM prod_cat pc
              JOIN product p ON pc.pc_id = p.pc_id
              GROUP BY pc.pc_id
              ORDER BY num_products DESC
              LIMIT 20";

    // Execute the query and fetch the result
    $result = mysqli_query($con, $query);

    // Create an empty array to store the result
    $data = array();

  $results = array();
    while ($row = mysqli_fetch_assoc($result)) {
         $results[] = $row;
    }
return $results;

}

function generate_sales_data_line_chart() {
global $con;

// Replace with the current and previous years
$currentYear = date('Y');
$previousYear = $currentYear - 1;

// SQL queries to retrieve monthly sales data for the current and previous years
$sqlCurrentYear = "SELECT MONTH(sale_date) as month, SUM(sale_qtty * sale_price) as total_sales
                   FROM sales_report
                   WHERE YEAR(sale_date) = $currentYear
                   GROUP BY MONTH(sale_date)";
$sqlPreviousYear = "SELECT MONTH(sale_date) as month, SUM(sale_qtty * sale_price) as total_sales
                    FROM sales_report
                    WHERE YEAR(sale_date) = $previousYear
                    GROUP BY MONTH(sale_date)";

$resultCurrentYear = mysqli_query($con, $sqlCurrentYear);
$resultPreviousYear = mysqli_query($con, $sqlPreviousYear);

// Format the query results into the desired array format
$data = [
    [
        'label' => $currentYear,
        'backgroundColor' => 'rgba(60,141,188,0.9)',
        'borderColor' => 'rgba(60,141,188,0.8)',
        'pointRadius' => true,
        'pointColor' => '#3b8bba',
        'pointStrokeColor' => 'rgba(60,141,188,1)',
        'pointHighlightFill' => '#fff',
        'pointHighlightStroke' => 'rgba(60,141,188,1)',
        'data' => array_fill(0, 12, 0),
    ],
    [
        'label' => $previousYear,
        'backgroundColor' => 'rgba(210, 214, 222, 1)',
        'borderColor' => 'rgba(210, 214, 222, 1)',
        'pointRadius' => true,
        'pointColor' => 'rgba(210, 214, 222, 1)',
        'pointStrokeColor' => '#c1c7d1',
        'pointHighlightFill' => '#fff',
        'pointHighlightStroke' => 'rgba(220,220,220,1)',
        'data' => array_fill(0, 12, 0),
    ],
];

while ($row = mysqli_fetch_assoc($resultCurrentYear)) {
    $data[0]['data'][$row['month'] - 1] = $row['total_sales'];
}

while ($row = mysqli_fetch_assoc($resultPreviousYear)) {
    $data[1]['data'][$row['month'] - 1] = $row['total_sales'];
}



// Close the database connection

// Output the data as JSON
return json_encode($data);
}

function getInStockNetValue(){
	global $con;
	$sql = "SELECT  SUM(p_qqty * p_price) as total_amount
                   FROM product_sub
                   WHERE
                   1=1 ";
     $query = $con->query($sql);
     $grandtotal = 0;
     while ($row = $query->fetch_array()) {
     	$grandtotal += $row['total_amount'];
     }
     return $grandtotal;
}
function getInStockCostValue(){
	global $con;
	$sql = "SELECT  SUM(p_qqty * cost) as total_amount
                   FROM product_sub
                   WHERE
                   1=1 ";
     $query = $con->query($sql);
     $grandtotal = 0;
     while ($row = $query->fetch_array()) {
     	$grandtotal += $row['total_amount'];
     }
     return $grandtotal;
}

function gettotalTodaysales(){
	global $con;
	$today = date("Y-m-d");
	$sql = "SELECT  SUM(sale_qtty * sale_price) as total_amount
                   FROM sales_report
                   WHERE
                   `sale_date`='$today' ";
     $query = $con->query($sql);
     $grandtotal = 0;
     while ($row = $query->fetch_array()) {
     	$grandtotal += $row['total_amount'];
     }
     return $grandtotal;
}
function getdeliveryRecord(){
	global $con;
	$sql = "SELECT *, SUM(dr_qtty * dr_cost) as total_sales
                   FROM delivery_record
                   WHERE 1=1 AND dr_status = 1  GROUP BY dr_date ";
	$query = $con->query($sql);
	return $query;
}

function getDeliveryRecordsItems($sup,$date){
	global $con;
	$sql = "SELECT * FROM `delivery_record` WHERE `dr_date`='$date' AND `sup_id`='$sup' ";
	$query = $con->query($sql);
	return $query;

}



function getCdByDateRange($user_id,$start,$end){
	global $con;	

	$sql = "SELECT * FROM `sales_cashd` WHERE `user_id`='$user_id' AND `scd_date` BETWEEN '$start' AND '$end'";
	$query = $con->query($sql);
	$total = 0;
	$spg = "SELECT *, SUM(`sp_amount`) as `newspam` FROM `shortage_payment` WHERE `user_id`='$user_id' AND `sp_date` BETWEEN '$start' AND '$end'";
			$spgq = $con->query($spg);
			$spgr = $spgq->fetch_array();
			$newspam = $spgr['newspam'];
	while ($row = $query->fetch_array()) {
		$totalis = $row['scd_qtty']*$row['cd_amount'];
		$total += $totalis;
	}
	$total += $newspam;
	return $total;
}



function SalesReportByCashier($what,$month,$year,$cashier){
	global $con;
	$start = date("Y-m-d", strtotime($month));
	$end = date("Y-m-d", strtotime($year));
	if ($cashier == 0 ) {
			$sql = "SELECT * FROM `sales_report` WHERE  `sale_status` = 1 AND `sale_date` BETWEEN '$start' AND '$end' GROUP BY `p_id`,`sale_price`,`sale_cost`  ";
	}else{
			$sql = "SELECT * FROM `sales_report` WHERE  `sale_status` = 1 AND `user_id`='$cashier' AND `sale_date` BETWEEN '$start' AND '$end' GROUP BY `p_id`,`sale_price`,`sale_cost`  ";
	}
	$query = $con->query($sql);
	$data = "";
	$i=0;
	$grandtotal =0;
	$grandcost = 0;
	$profit = 0;
	$discount =0;
	$sellprice =0;
	$costprice=0;
	$quantits = 0;
	$newspam = getCdByDateRange($cashier,$start,$end);
	$nrow = $query->num_rows;
	$data.='<table id="example8" style="font-size:14px;" class="table table-bordered">';
	$data.='<thead style="background-color:#646464;color:white;">';
	$data.='<tr>';
	$data.='<th>#</th>';
	$data.='<th>Product Name</th>';
	$data.='<th>Qty Sold</th>';
	$data.='<th>Selling Price (SRP)</th>';
	$data.='<th>Discount</th>';
	$data.='<th>Net Sales (P)</th>';
	$data.='<th>Cost/Unit</th>';
	$data.='<th>Total Cost</th>';
	$data.='</tr>';
	$data.='</thead>';
	$data.='<tbody>';
	while ($row = $query->fetch_array()) {
		$ppid = $row['p_id'];
		$ssaleprice = $row['sale_price'];
		$ssalecost = $row['sale_cost'];
		$getqtty ="SELECT *, SUM(sale_qtty) as `new_qtty` FROM `sales_report` WHERE  `sale_status` = 1 AND `sale_date`>='$start' AND `sale_date`<= '$end' AND `p_id`='$ppid' AND `sale_price`='$ssaleprice' AND `sale_cost`='$ssalecost' ";
		$gqquery = $con->query($getqtty);
		$gqrow = $gqquery->fetch_array();

			$i++;
			$pp_iid = $row['p_id'];
			$rowprod = getSpProduct($pp_iid)->fetch_array();
			$pcat = $rowprod['pc_id'];
			$rowpcat = getSpProdCat($pcat)->fetch_array();
			$rowpt = getSpProdType($rowprod['pct_id'])->fetch_array();
			$total = $gqrow['new_qtty']*$row['sale_price'];
			$totalcost = $gqrow['new_qtty'] * $row['sale_cost'];
			$grandtotal = $grandtotal + $total;
			$grandcost = $grandcost + $totalcost;
			$profit = $grandtotal - $grandcost;
			$discount += $row['the_discount'];
			$sellprice +=$row['sale_price'];
			$costprice +=$row['sale_cost'];
			$quantits +=$row['sale_qtty'];

			$data .= '<tr>';
			$data .= '<td style="padding:3px;vertical-align:middle">';
			$data .= $i;
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle">';
			$data .= $rowprod['p_name'].' <i style="color:red;">('.$rowpcat['pc_name'].') '.$rowpt['pct_name'].'</i> ';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="center">';
			$data .= $gqrow['new_qtty'];
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right">';
			$data .= '₱'.number_format($row['sale_price'],2).'<br> <i style="color:red;"></i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right">';
			$data .= '₱'.number_format($row['the_discount'],2).'<br> <i style="color:red;"></i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right" style="font-weight:700;">';
			$data .= '₱'.number_format($total,2).'<br> <i style="color:red;"></i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right">';
			$data .= '₱'.number_format($row['sale_cost'],2).'</i>';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle" align="right" style="font-weight:700;">';
			$data .= '₱'.number_format($totalcost,2).'</i>';
			$data .= '</td>';
			$data .= '</tr>';

	}
	if ($nrow < 1) {
			// $data .= '<tr>';
			// $data .= '<td style="padding:3px;" colspan="5" align="center">';
			// $data .= 'No Sales Report';
			// $data .= '</td>';
			// $data .= '</tr>';
	}
			// $data .= '</body>';
			// $data .= '</table>';

			// $data .= '<table class="table table-bordered" style="font-weight:bold">';
			// $data .= '<tfoot>';
			$data .= '<tr style="font-weight:700;background-color:#646464;color:white;" >';
			$data .= '<td>';
			$data .= '';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:centernumber_format(;" align="center">';
			$data .= 'GRANDTOTAL';
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($quantits,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($sellprice,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($discount,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($grandtotal,2);
			$data .= '</td>';
			$data .= '<td >';
			$data .= number_format($costprice,2);
			$data .= '</td>';
			$data .= '<td style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= number_format($grandcost,2);
			$data .= '</td>';
			$data .= '</tr>';

			for ($i=0; $i <2 ; $i++) { 
				$data .= '<tr >';
				$data .= '<th>';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '<th >';
				$data .= '';
				$data .= '</th>';
				$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
				$data .= '';
				$data .= '</th>';
				$data .= '</tr>';
			}

			$data .= '<tr >';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'Summary';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';
			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'Net Sales';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= '₱'.number_format($grandtotal,2);
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';

			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'COGS';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;border-bottom:solid 2px black" align="center">';
			$data .= '₱'.number_format($grandcost,2);
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';


			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'Profit';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= '₱'.number_format($profit,2);
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';

			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';

			$data .= '<tr>';
			$data .= '<th>';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:left;" align="center">';
			$data .= 'SCD';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:right;" align="center">';
			$data .= '₱'.number_format($newspam,2);
			$data .= '</th>';
			$data .= '<th >';
			$data .= '';
			$data .= '</th>';
			$data .= '<th style="padding:3px;vertical-align:middle; text-align:center;" align="center">';
			$data .= '';
			$data .= '</th>';
			$data .= '</tr>';

			// $data .= '</tfoot>';
			$data .= '</tbody>';
			$data .= '</table>';


	return $data;
}

function getNetSalesSPDate($date){
	global $con;
	$sql ="SELECT *, SUM(sale_qtty * sale_price) as totalSales FROM `sales_report` WHERE `sale_date`= '$date' ";
	$query = $con->query($sql);
	$grandtotal =0;
	while ($row  = $query->fetch_array()) {
		$grandtotal += $row['totalSales'];
	}
	return $grandtotal;
}

function getCostSalesSPDate($date){
	global $con;
	$sql ="SELECT *, SUM(sale_qtty * sale_cost) as totalCost FROM `sales_report` WHERE `sale_date`= '$date' ";
	$query = $con->query($sql);
	$grandtotal =0;
	while ($row  = $query->fetch_array()) {
		$grandtotal += $row['totalCost'];
	}
	return $grandtotal;
}
function getTotalQttySalesSPDate($date){
	global $con;
	$sql ="SELECT *, SUM(sale_qtty) as newQtty FROM `sales_report` WHERE `sale_date`= '$date' ";
	$query = $con->query($sql);
	$grandtotal =0;
	$row  = $query->fetch_array();
	return $row['newQtty'];
}

function SalesMonthlyBydate($month,$year){
	global $con;
	$sql = "SELECT * FROM `sales_report` WHERE MONTH(sale_date)='$month' AND YEAR(sale_date) ='$year' GROUP BY `sale_date` ORDER BY `sale_date` ASC ";
	$query = $con->query($sql);
	$totalnetsales = 0;
	$totalsalescost = 0;
	$totalprofit = 0;
	$totalquantity = 0;
	$data = "";
	$data.='<table id="example8" style="font-size:14px;" class="table table-bordered">';
	$data.='<thead style="background-color:#646464;color:white;">';
	$data.='<tr>';
	$data.='<th>#</th>';
	$data.='<th style="width:19%;">Sale Date</th>';
	$data.='<th style="width:19%;">Items Sold</th>';
	$data.='<th style="width:19%;">Net Sales</th>';
	$data.='<th style="width:19%;">Cost/Unit</th>';
	$data.='<th style="width:19%;">Profit</th>';
	$data.='</tr>';
	$data.='</thead>';
	$data.='<tbody>';
	$i=0;
	while ($row = $query->fetch_array()) {
		$i++;
		$NetSales = getNetSalesSPDate($row['sale_date']);
		$SalesCost = getCostSalesSPDate($row['sale_date']);
		$Quantity = getTotalQttySalesSPDate($row['sale_date']);
		$Profit = $NetSales - $SalesCost;
		$totalnetsales += $NetSales;
		$totalsalescost += $SalesCost;
		$totalprofit += $Profit;
		$totalquantity += $Quantity;
		$url = "?q=todaySales&themonthis=" . $row['sale_date'];
		$data .= '<tr style="cursor:pointer" ondblclick="window.location.href=\'' . $url . '\'" title="Click to view date Sales">';
		$data.='<td>'; 
		$data .= $i;
		$data.='</td>';
		$data.='<td align="center">';
		$data .= date("F d, Y", strtotime($row['sale_date']));
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($Quantity);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($NetSales,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($SalesCost,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($Profit,2);
		$data.='</td>';
		$data.='</tr>';

	}
	$data.='<tr style="background-color:#646464;color:white;font-weight: 800;">';
		$data.='<td>';
		$data .= '';
		$data.='</td>';
		$data.='<td align="center" >';
		$data .= 'GRANDTOTAL';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalquantity);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalnetsales,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalsalescost,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalprofit,2);
		$data.='</td>';
		$data.='</tr>';
	for ($i=0; $i <2 ; $i++) { 
		$data.='<tr>';
		$data.='<td align="right">';
		$data .= '&nbsp';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';
	}

		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td >';
		$data .= 'Summary';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';


		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td >';
		$data .= 'NET SALES:';
		$data.='</td>';
		$data.='<td align="right">';
		$data .=   number_format($totalnetsales,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';

		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td>';
		$data .= 'COST OF GOODS:';
		$data.='</td>';
		$data.='<td align="right">';
		$data .=   number_format($totalsalescost,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';

		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td>';
		$data .= 'PROFIT:';
		$data.='</td>';
		$data.='<td align="right">';
		$data .=   number_format($totalprofit,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';

	$data.='</tbody>';
	$data.='</table>';

	return $data;
}
function getNetSalesSPDateY($month,$year){
	global $con;
	$sql ="SELECT *, SUM(sale_qtty * sale_price) as totalSales FROM `sales_report` WHERE MONTH(sale_date)='$month' AND YEAR(sale_date) ='$year' ";
	$query = $con->query($sql);
	$grandtotal =0;
	while ($row  = $query->fetch_array()) {
		$grandtotal += $row['totalSales'];
	}
	return $grandtotal;
}

function getCostSalesSPDateY($month,$year){
	global $con;
	$sql ="SELECT *, SUM(sale_qtty * sale_cost) as totalCost FROM `sales_report` WHERE MONTH(sale_date)='$month' AND YEAR(sale_date) ='$year' ";
	$query = $con->query($sql);
	$grandtotal =0;
	while ($row  = $query->fetch_array()) {
		$grandtotal += $row['totalCost'];
	}
	return $grandtotal;
}
function getTotalQttySalesSPDateY($month,$year){
	global $con;
	$sql ="SELECT *, SUM(sale_qtty) as newQtty FROM `sales_report` WHERE MONTH(sale_date)='$month' AND YEAR(sale_date) ='$year' ";
	$query = $con->query($sql);
	$grandtotal =0;
	$row  = $query->fetch_array();
	return $row['newQtty'];
}
function SalesYearlyByMonth($year){
	global $con;
	$sql = "SELECT *, MONTH(sale_date) as newm, YEAR(sale_date) as newy, DATE_FORMAT(sale_date, '%Y-%m') as newvariable FROM `sales_report` WHERE  YEAR(sale_date) ='$year' GROUP BY DATE_FORMAT(sale_date, '%Y-%m') ORDER BY DATE_FORMAT(sale_date, '%Y-%m') ASC ";
	$query = $con->query($sql);
	$totalnetsales = 0;
	$totalsalescost = 0;
	$totalprofit = 0;
	$totalquantity = 0;
	$data = "";
	$data.='<table id="example8" style="font-size:14px;" class="table table-bordered">';
	$data.='<thead style="background-color:#646464;color:white;">';
	$data.='<tr>';
	$data.='<th>#</th>';
	$data.='<th style="width:19%;">Sale Date</th>';
	$data.='<th style="width:19%;">Items Sold</th>';
	$data.='<th style="width:19%;">Net Sales</th>';
	$data.='<th style="width:19%;">Cost/Unit</th>';
	$data.='<th style="width:19%;">Profit</th>';
	$data.='</tr>';
	$data.='</thead>';
	$data.='<tbody>';
	$i=0;
	while ($row = $query->fetch_array()) {
		$i++;
		$NetSales = getNetSalesSPDateY($row['newm'],$row['newy']);
		$SalesCost = getCostSalesSPDateY($row['newm'],$row['newy']);
		$Quantity = getTotalQttySalesSPDateY($row['newm'],$row['newy']);
		$Profit = $NetSales - $SalesCost;
		$totalnetsales += $NetSales;
		$totalsalescost += $SalesCost;
		$totalprofit += $Profit;
		$totalquantity += $Quantity;
		$url = "?q=monthSales&themonthis=".$row['newm']."&theyearis=".$row['newy'];
		$data .= '<tr style="cursor:pointer" ondblclick="window.location.href=\'' . $url . '\'" title="Click to view date Sales">';
		$data.='<td>'; 
		$data .= $i;
		$data.='</td>';
		$data.='<td align="center">';
		$data .= date("F-Y", strtotime($row['newvariable']));
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($Quantity);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($NetSales,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($SalesCost,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($Profit,2);
		$data.='</td>';
		$data.='</tr>';

	}
	$data.='<tr style="background-color:#646464;color:white;font-weight: 800;">';
		$data.='<td>';
		$data .= '';
		$data.='</td>';
		$data.='<td align="center" >';
		$data .= 'GRANDTOTAL';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalquantity);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalnetsales,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalsalescost,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= number_format($totalprofit,2);
		$data.='</td>';
		$data.='</tr>';
	for ($i=0; $i <2 ; $i++) { 
		$data.='<tr>';
		$data.='<td align="right">';
		$data .= '&nbsp';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';
	}

		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td >';
		$data .= 'Summary';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';


		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td >';
		$data .= 'NET SALES:';
		$data.='</td>';
		$data.='<td align="right">';
		$data .=   number_format($totalnetsales,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';

		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td>';
		$data .= 'COST OF GOODS:';
		$data.='</td>';
		$data.='<td align="right">';
		$data .=   number_format($totalsalescost,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';

		$data.='<tr style="font-weight:700;">';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='<td>';
		$data .= 'PROFIT:';
		$data.='</td>';
		$data.='<td align="right">';
		$data .=   number_format($totalprofit,2);
		$data.='</td>';
		$data.='<td align="right">';
		$data .= '';
		$data.='</td>';
		$data.='</tr>';

	$data.='</tbody>';
	$data.='</table>';

	return $data;
}

function duplicate_InventoryTable($monthis){
	global $con;
	$sql = "SELECT * FROM `product_sub` WHERE 1=1 ";
	$query = $con->query($sql);
	while ($rowx = $query->fetch_array()) {
		extract($rowx);
		$in = "INSERT INTO `monthly_stock_report`(`p_id`, `p_qtty`, `p_price`, `p_cost`, `p_expdate`, `dg_Ornumber`, `p_drid`, `dr_id`, `month_date_rep`) 
									VALUES ('$p_id','$p_qqty','$p_price','$cost','$expiration_date','$dg_Ornumber','$drid','$dr_id','$monthis')";
		$unq  = $con->query($in);
	}
	return '1';

}

function getTotalQuantityByProductMR($p_id){
	global $con;
	$sql = "SELECT *, SUM(p_qtty) as newqtty FROM `monthly_stock_report` WHERE `p_id`='$p_id'";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	return $row['newqtty'];

}



 ?>

