<?php 
include '../dbcon.php';
	if (isset($login_user)) {	

		$solx_password = mysqli_escape_string($con,$solx_password);
		$newpass = md5($solx_password);
		$check = "SELECT * FROM `wd_user` WHERE `user_name`='$solx_username' AND `user_password`='$newpass' AND `user_status` between 1 and 2 ";
			$checkq = $con->query($check);
			if ($checkq) {

			}
		   $nrow = $checkq->num_rows;
			$row = $checkq->fetch_array();
			if ($nrow > 0) {
				if ($row['user_status'] > 1) {
					echo "2";
				}else{
					$_SESSION['userid'] = $row['user_id'];
					echo "1";
				}
			}else{
				echo "0";
			}

	}
	if (isset($logout)) {
			session_destroy();
			header('location:../');
			databaseBackup(); 
	}
	if (isset($fullnamexx)) {

		$userimg=$_FILES["user_img"]["tmp_name"];
		   	$userimgs = $_FILES["user_img"]["name"];
			$target_dir1 = "../images/";
			$target_file1 = $target_dir1 . basename($_FILES["user_img"]["name"]);
			if (file_exists($target_file1)) { }else{ move_uploaded_file($userimg,$target_file1 ); }

		$password = md5($password);

		$check = "SELECT * FROM `wd_user` WHERE `user_name`='$username' AND `user_password`='$password' ";
		$checkq = $con->query($check);
		$checknr = $checkq->num_rows;
		if ($checknr == 0) {
				$sql ="INSERT INTO `wd_user`(`user_name`, `user_password`, `user_fullname`, `user_designation`, `user_access`, `user_contact`, `user_gender`, `user_img`) VALUES ('$username','$password','$fullnamexx','Cashier','$userposition','$contact','$gender','$userimgs')";
					$query=$con->query($sql);
					if ($query) {
						echo "1";
					}else{
						echo "0";
					}
		}else{
						echo "2";
		}
		databaseBackup();
	}
	if (isset($approveUser) OR isset($disapproveUser)) {
		if (isset($approveUser)) {
			$sql = "UPDATE `wd_user` SET `user_status`=1 WHERE `user_id`='$u_id'";
			$query = $con->query($sql);
			if ($query) {
				echo "1";
			}
		}else{
			$sql = "UPDATE `wd_user` SET `user_status`=2 WHERE `user_id`='$u_id'";
			$query = $con->query($sql);
			if ($query) {
				echo "2";
			}
		}
		databaseBackup();
	}
	if (isset($fullnameEdit)) {
		$sql = "UPDATE `wd_user` SET `user_name`='$username',`user_fullname`='$fullnameEdit',`user_address`='$Address',`user_contact`='$contact',`user_gender`='$gender'";
		$urq = getSpUser($ur_id);
		$ur = $urq->fetch_array();
		if ($ur['user_password']!=$password) {
			$md5pass = md5($password);
			$sql.=",`user_password`='$md5pass' ";
		}
		$sql.=" WHERE `user_id`='$ur_id'";
		$query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
	if (isset($diactivateUser)) {
	 	$sql = "UPDATE `wd_user` SET `user_status`=2 WHERE `user_id`='$ur_id'";
		 $query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
	if (isset($activateUser)) {
	 	$sql = "UPDATE `wd_user` SET `user_status`=1 WHERE `user_id`='$ur_id'";
		 $query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
	if (isset($prod_cat_new)) {
		$table = "prod_cat";
		$conditions = array("pc_name" => $prod_cat_new);
		$result = tars_query($table, $conditions);
		echo $result;
		databaseBackup();
	}
	if (isset($prod_type_new)) {
		$table = "pc_type";
		$conditions = array("pct_name" => $prod_type_new);
		$result = tars_query($table, $conditions);
		echo $result;
		databaseBackup();
	}
	if (isset($catname_edit)) {
		$sql = "UPDATE `prod_cat` SET `pc_name`='$catname_edit' WHERE `pc_id`='$pc_id_edit' ";
		 $query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
	if (isset($editptype_edit)) {
		$sql = "UPDATE `pc_type` SET `pct_name`='$editptype_edit' WHERE `pct_id`='$pct_id_edit' ";
		 $query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
	if (isset($editSupData)) {
		$sql = "UPDATE `suppliers` SET `company_name`='$company_name',`sup_contact_name`='$contactname',`sup_contact_number`='$contactnumber',`sup_email`='$company_email' WHERE `sup_id`='$editSupData' ";
		 $query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
	if (isset($insert_supplier)) {
		$table = "suppliers";
		$conditions = array("company_name" => $company_name,"sup_contact_name" => $contactname,"sup_contact_number" => $contactnumber,"sup_email" => $company_email,"sup_address" => $company_address,"sup_tin" => $company_TIN);
		$result = tars_query($table, $conditions);
		echo $result;
		databaseBackup();
	}
	if (isset($product_code_insert_new)) {
		$pcde = explode(" ", $product_code_insert_new);
			if (count($pcde) > 1) {
				$pcode = $pcde[0];
			}else{
				$pcode = $product_code_insert_new;
			}
		$product_name = mysqli_real_escape_string($con, $product_name);
		$pname = strtoupper($product_name);
		$sql = "INSERT INTO `product`(`pc_id`, `pct_id`, `product_code`, `p_name`, `p_req`,`cap_qtty`) VALUES ('$product_category','$product_type','$pcode','$pname','$product_Requirements','$product_qtty_cap')";
		$query = $con->query($sql);
		$last_id = $con->insert_id;

		$table = "delivery_record";
		$conditions = array("p_id" => $last_id,"dr_qtty" => $product_quantity,"dr_price" => $product_price,"sup_id" => $tssuplier,"dr_cost"=>$product_cost);
		$result = tars_query($table, $conditions);
		echo $result;
		databaseBackup();
	}
	if (isset($product_code_update_inventory)) 
{		$get_product = "SELECT * FROM `product` WHERE `product_code`='$product_code_update_inventory' ";
		$gpq = $con->query($get_product);
		$gpr = $gpq->fetch_array();
		$product_id = $gpr[0];
		$table = "delivery_record";
		$conditions = array("p_id" => $product_id,"dr_qtty" => $product_quantity,"dr_price" => $product_price,"sup_id" => $tssuplier,"dr_cost"=>$product_cost);
		$result = tars_query($table, $conditions);
		echo $result;
		databaseBackup();
	}
	if (isset($date_delivered_insert)) {
		$result = addDeliveryToInventory($tssuplier,$date_delivered_insert,$DelOrNumber,$delamout,$DLT);
		echo $result; 
		databaseBackup();
	}
if (isset($AddnewCustomer)) {
	$random_string = generate_random_string(10);
	if ($usertype == 4) {
		$sql = "INSERT INTO `customers`(`cname`,`user_id`) VALUES ('$random_string','0')";
	}else{
		$sql = "INSERT INTO `customers`(`cname`,`user_id`) VALUES ('$random_string','$user_id')";
	}
	$query = $con->query($sql);
	if ($query) {
		echo "1";
		databaseBackup();
	}else{
		echo "0";
	}

}
if (isset($c_id_updateData)) {
	$sql = "UPDATE `customers` SET `cname`='$cname',`cphone`='$cphone' WHERE `c_id`='$c_id_updateData'";
	$query = $con->query($sql);
	if ($query) {
		echo "1";
		databaseBackup();
	}else{
		echo "0";
	}

}
if (isset($remove_cutomer)) {
	$sql = "DELETE FROM `customers` WHERE `c_id`='$c_id' AND `c_status`=0 ";
	$query = $con->query($sql);
	if ($query) {
		$sql1 = "DELETE FROM `customer_order` WHERE `c_id`='$c_id'";
		$query1 = $con->query($sql1);
		unset($_SESSION['setActiveCustomer']);
		echo "1";
		databaseBackup();
	}else{
		echo "0";
	}
}
if (isset($addTransItem)) {
	$check = "SELECT * FROM `customer_order` WHERE `c_id`='$setActiveCustomer' AND `p_id`='$product_name'  AND `co_status`=0 ";
	$cquery = $con->query($check);
	$cnrow = $cquery->num_rows;
	if ($cnrow > 0) {
		$row = $cquery->fetch_array();
		$existing_qtty = $row['co_qtty'];
		$newqtty = $trans_qtty + $existing_qtty;
		if (isset($newpricing)) {
			$sql = "UPDATE `customer_order` SET `co_qtty`='$newqtty',`co_price`='$newpricing'  WHERE `c_id`='$setActiveCustomer' AND `p_id`='$product_name'  AND `co_status`=0 ";
		}else{
		$sql = "UPDATE `customer_order` SET `co_qtty`='$newqtty'  WHERE `c_id`='$setActiveCustomer' AND `p_id`='$product_name'  AND `co_status`=0 ";
		}
		$query = $con->query($sql);
		if ($query) {
			echo "1";
		}else{
			echo "0";
		}
	}else{
		if (isset($newpricing)) {
			$sql = "INSERT INTO `customer_order`(`c_id`, `p_id`, `co_qtty`,`co_price`) VALUES ('$setActiveCustomer','$product_name','$trans_qtty','$newpricing')";
		}else{
			$sql = "INSERT INTO `customer_order`(`c_id`, `p_id`, `co_qtty`) VALUES ('$setActiveCustomer','$product_name','$trans_qtty')";
		}
		// $sql = "INSERT INTO `customer_order`(`c_id`, `p_id`, `co_qtty`) VALUES ('$setActiveCustomer','$product_name','$trans_qtty')";
		$query = $con->query($sql);
		if ($query) {
			echo "1";
			databaseBackup();
		}else{
			echo "0";
		}
	}
}


if (isset($paytimeNow)) {
	$today = date("Y-m-d");
		$getitem = "SELECT * FROM `customer_order` WHERE `c_id`='$customer_id' AND `co_status`=0 ";
		$gq = $con->query($getitem);
		while ($gir = $gq->fetch_array()) {
			$qtty = $gir['co_qtty'];
			$p_id = $gir['p_id'];
		do {
		$sql = "SELECT * FROM `product_sub` WHERE `p_id`='$p_id' ORDER BY `expiration_date` ASC limit 1 ";
		$query = $con->query($sql);
		$row = $query->fetch_array();
		$ps_id = $row['ps_id'];
		$inqtty = $row['p_qqty'];
		if ($gir['co_price'] < 1) {
				$price = getActivePrice1($p_id,$qtty);
			}else{
				$price = $gir['co_price'];
			}
		$scost= getActiveCost($p_id);
		$discounted = DiscountedPrice($price,$discount_id);
		if ($discounted == $price) {
			$discountlang = 0;
		}else{
			$discountlang = $price - $discounted;
		}
		$expdate = $row['expiration_date'];
		if ($qtty >= $inqtty) {
			$insert = "INSERT INTO `sales_report`(`c_id`, `p_id`, `sale_qtty`, `sale_price`, `sale_expirationdate`, `sale_date`,`user_id`,`sale_cost`,`the_discount`) 
											VALUES ('$customer_id','$p_id','$inqtty','$discounted','$expdate','$today','$user_id','$scost','$discountlang')";
			$inquery = $con->query($insert);
			$delete_inventory = "DELETE FROM `product_sub` WHERE `ps_id`='$ps_id'";
			$delete_query = $con->query($delete_inventory);
			$qtty = $qtty - $inqtty;
		}else{
			$newinqtty = $inqtty - $qtty;
			$insert = "INSERT INTO `sales_report`(`c_id`, `p_id`, `sale_qtty`, `sale_price`, `sale_expirationdate`, `sale_date`,`user_id`,`sale_cost`,`the_discount`) 
											VALUES ('$customer_id','$p_id','$qtty','$discounted','$expdate','$today','$user_id','$scost','$discountlang')";
			$inquery = $con->query($insert);

			$update = "UPDATE `product_sub` SET `p_qqty`='$newinqtty' WHERE `ps_id`='$ps_id'";
			$upquery = $con->query($update);
			$qtty = 0;
		}
		
	} while ($qtty > 0);
	}
	$transaction_code = generate_transaction_code();
	$updatec = "UPDATE `customers` SET `c_status`= 1, `transaction_date`='$today',`d_id`='$discount_id',`c_cash`='$themoney',`c_change`='$thechange',`c_amount`='$topay',`transaction_code`='$transaction_code',`user_id`='$user_id' WHERE `c_id`='$customer_id' AND `c_status`=0 ";
	$upcquery = $con->query($updatec);
	$updatecor = "UPDATE `customer_order` SET `co_status`=1 WHERE `c_id`='$customer_id' AND `co_status`=0 ";
	$upcorquery = $con->query($updatecor);

	if ($upcorquery) {
	unset($_SESSION['setActiveCustomer']);
		echo '1';
		databaseBackup();
	}else{
		echo "0";
	}
}


if (isset($removeTransactionItem)) {
	$sql = "DELETE FROM `customer_order` WHERE `co_id`='$co_id' ";
	$query = $con->query($sql);
	if ($query > 0) {
		echo "1";
	}else{
		echo "0";
	}
	databaseBackup();
}
if (isset($cf_toAdd)) {
	$today = date("Y-m-d");
	$check = "SELECT * FROM `petty_cash` WHERE `user_id`='$uuser' AND `pt_date`='$today' ";
	$cquery = $con->query($check);
	$cnrow = $cquery->num_rows;
	if ($cnrow > 0) {
		$row = $cquery->fetch_array();
		$newptc = $row['pt_cash'] + $cf_toAdd;
		$sql= "UPDATE `petty_cash` SET `pt_cash`='$newptc' WHERE `user_id`='$uuser' AND `pt_date`='$today'";
		$query = $con->query($sql);
	}else{
		$sql= "INSERT INTO `petty_cash`(`pt_cash`, `user_id`, `pt_date`) VALUES ('$cf_toAdd','$uuser','$today')";
		$query = $con->query($sql);
	}
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}
	databaseBackup();
}
if (isset($addnewDiscount)) {
	$sql = "INSERT INTO `discount`(`dp`, `ddesc`) VALUES ('$discount_percentage','$discount_desc')";
	$query = $con->query($sql);
	if ($query) {
		databaseBackup();
		echo "1";
	}else{
		echo "0";
	}

}
if (isset($p_id_editcap)) {
	$pname = strtoupper($product_name);
 $sql = "UPDATE `product` SET `cap_qtty`='$edit_qtty_cap',`p_name`='$pname',`product_code`='$product_code', `pc_id`='$product_category',`pct_id`='$product_type',`sub_product_code`='$sub_product_code' WHERE `p_id`='$p_id_editcap' ";
	$query = $con->query($sql);
	if ($query) {
		databaseBackup();
		echo "1";
	}else{
		echo "0";
	}
}
if (isset($AddnewProductNoQtty)) {
	$pcde = explode(" ", $product_code);
	if (count($pcde) > 1) {
		$pcode = $pcde[0];
	}else{
		$pcode = $product_code;
	}
	$sql = "SELECT * FROM `product` WHERE 1=1 AND ((`product_code`='$pcode') OR (`p_name`='$product_name'))";
	$query = $con -> query($sql);
	$nrow = $query->num_rows;
	if ($nrow > 0) {
		echo "0";
	}else{
		$pname = strtoupper($product_name);
		$in = "INSERT INTO `product`
		(`pc_id`, `pct_id`, `product_code`, `p_name`, `p_req`, `cap_qtty`,`sub_product_code`) VALUES 
		('$product_category','$product_type','$pcode','$pname','$product_Requirements','$product_qtty_cap','$sub_product_code')";
		$inquery = $con->query($in);
		if ($inquery) {
			echo "1";
		}
	}
}
if (isset($qttyupdatetrans)) {
	$sql="UPDATE `customer_order` SET `co_qtty`='$qttyis' WHERE `co_id`='$qttyupdatetrans'";
	$query = $con->query($sql);
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}
}
if (isset($openSettingsUpdate)) {
	$check = "SELECT * FROM `system_settings` WHERE 1=1";
	$checkq = $con->query($check);
	$checknr = $checkq->num_rows;
	if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
	  $newFileName = uniqid('', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	  $uploadPath = '../images/' . $newFileName;
	  if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
	   
	  } else {
	  
	  }
	}
	if ($checknr > 0) {
		$sql = "UPDATE `system_settings` SET `ss_company`='$ss_company_name',`ss_address`='$ss_company_address',`ss_contact`='$ss_company_number',`ss_owner`='$ss_company_owner' ,`ss_company_logo`='$newFileName' ";
		$query = $con->query($sql);
	}else{
		$sql = "INSERT INTO `system_settings`(`ss_company`, `ss_address`, `ss_contact`, `ss_owner`,`ss_company_logo`) VALUES ('$ss_company_name','$ss_company_address','$ss_company_number','$ss_company_owner')";
		$query = $con->query($sql);
	}
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}
}
if (isset($returnanitem)) {
	$totalRet = 0;
	$c_id = '';
	foreach ($return as $key => $value) {
		$sql = "SELECT *, SUM(`sale_qtty` * `sale_price`) as totalam FROM `sales_report` WHERE `sale_id`='$value' ";
		$query = $con->query($sql);
		$row = $query->fetch_array();
		$c_id =$row['c_id'];
		$quant = $row['sale_qtty'];
		$pp_id = $row['p_id'];
		$totalRet += $row['totalam'];
		$sql1 ="UPDATE `product_sub` SET `p_qqty`='$quant' WHERE `p_id`='$pp_id' ORDER BY `expiration_date` ASC  Limit 1";
		$query = $con->query($sql1);
		$delete = $con->query("DELETE FROM `sales_report` WHERE `sale_id`='$value'");
	}
	$cq = $con->query("UPDATE `customers` SET `return_amount`='$totalRet' WHERE `c_id`='$c_id'");
	echo $totalRet;
}

if (isset($editdiscount)) {
	
	$sql = "UPDATE `discount` SET `dp`='$dp',`ddesc`='$d_desc' WHERE `d_id`='$d_id' ";
	$query = $con->query($sql);
	if ($query) {
		echo "1";
	}else{
		echo "0";
	}
}


 ?>