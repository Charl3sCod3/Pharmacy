<?php 
	$sql = "SELECT * FROM `customers` WHERE `c_id`='$c_id' ";
	$query = $con->query($sql);
	$row = $query->fetch_array();
	$d_id = $row['d_id'];
	$drow = getSpDiscounts($d_id)->fetch_array();

	$getspuser = getSpUser($row['user_id']);
	$spuser = $getspuser->fetch_array();
 ?>
<div class="card" style="width:80% "> 
	<div class="card-header">
		<h4 class="card-title">
			List of items 
		</h4>
	</div>
	<div class="card-body" style="font-family: tahoma;font-size:17px;">
		<div class="row">
			<div class="col-4">
				<div class="form-group">
					<p style="margin-bottom:2px;">Cashier :</p>
					<input type="text" value="<?php echo $spuser['user_fullname'] ?>" readonly name="" placeholder="Empty text" class="form-control">
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					<p style="margin-bottom:2px;">Transaction Code :</p>
					<input type="text" value="<?php echo $row['transaction_code'] ?>" readonly name="" placeholder="Empty text" class="form-control">
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					<p style="margin-bottom:2px;">Transaction Date :</p>
					<input type="text" value="<?php echo $row['transaction_date'] ?>" readonly name="" placeholder="Empty text" class="form-control">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<p style="margin-bottom:2px;">Customer Name :</p>
					<input type="text" value="<?php echo $row['cname'] ?>" readonly name="" placeholder="Empty text" class="form-control">
				</div>
			</div>
			<div class="col-6">
				<div class="form-group">
					<p style="margin-bottom:2px;">Returned Amount :</p>
					<input type="text" value="<?php echo $row['return_amount'] ?>" readonly name="" placeholder="Returned item" class="form-control">
				</div>
			</div>
		</div>
		<table class="table table-bordered">
			<thead style="text-align:center;">
				<tr>
					<th><i class="fa fa-check"></i></th>
					<th style="width:5%">#</th>
					<th>Product Name</th>
					<th>Qtty</th>
					<th>Price</th>
					<th>Amount</th>
				</tr>
			</thead>
			<form id="returnitemquery">
			<tbody>
				<?php 
				$i=0;
				$grandtotal = 0;
					$sql1="SELECT * FROM `sales_report` WHERE `c_id`='$c_id' GROUP BY `p_id` ";
					$query1 = $con->query($sql1);
					while ($row1 = $query1->fetch_array()) { $i++;
						$row2 = getSpProduct($row1[2])->fetch_array();
						$p_id = $row1['p_id'];
						$fck = "SELECT *, SUM(sale_qtty) as newqtty FROM `sales_report` WHERE `c_id`='$c_id' AND `p_id`='$p_id' ";
						$fckq = $con->query($fck);
						$fckr = $fckq->fetch_array();
						$total = $fckr['newqtty']*$row1['sale_price'];
						$grandtotal += $total;
						?>
						<tr> 
							<td>
								<div class="form-group">
									<input type="checkbox" name="return[]" value="<?php echo $row1['sale_id'] ?>" class="form-control">
								</div>
							</td>
							<td><?php echo $i ?></td>
							<td><?php echo $row2['p_name'] ?></td>
							<td align="center"><?php echo $fckr['newqtty'] ?></td>
							<td align="right"><?php echo '₱'.number_format($row1['sale_price'],2) ?></td>
							<td align="right"><?php echo '₱'.number_format($total,2) ?></td>
						</tr>
				<?php }  ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" rowspan="2" style="text-align:center;vertical-align: middle;" >
							<p>Note: If a customer wish to return an item they must present a receipt.</p>
						</td>
						<td align="right">Discount :</td>
						<td align="right"> <?php echo $drow[2] ?></td>
					</tr>
					<tr>
						
						<td align="right">Grand Total :</td>
						<td align="right"> <?php echo '₱'.number_format($grandtotal,2) ?></td>
					</tr>
					<tr>
						<td></td>
						<td  align="center" style="vertical-align: middle;">
						</td>
						<td colspan="2"  align="center" style="vertical-align: middle;">
							<button id="btn-return" style="margin:auto;" class="btn btn-danger btn-md"><i class="fas fa-undo"></i> Return an item</button>
							<a onclick=" openPopUp1('printable/receipt.php?c_id=<?php echo $c_id ?>');" style="margin:auto;color: white;" class="btn btn-primary btn-md"><i class="fa fa-print"></i> Re print receipt</a>
						</td>
						<td align="right">CASH :</td>
						<td align="right"> <?php echo '₱'.number_format($row['c_cash'],2) ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td align="right">Change :</td>
						<td align="right"> <?php echo '₱'.number_format($row['c_change'],2) ?></td>
					</tr>
				</tfoot>
				</form>
		</table>
	</div>
</div>