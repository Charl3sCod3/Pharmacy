<?php 
if (isset($setActiveCustomer)) {
					$cusID = $setActiveCustomer; 
				}else{
					$cusID = '0';
				}
	$getOrList = getCustomerOrder($cusID);
	$i=0;
	$nnrow = $getOrList->num_rows;
 ?>
<div class="row">
	<div class="<?php echo $y = ($usertype == 4) ? "col-12" :''; ?> <?php echo $y = ($usertype == 2) ? "col-9"  :''; ?> <?php echo $y = ($usertype == 1) ? "col-12" :'' ; ?>">
		<div class="card card-secondary transaction">  
	<div class="card-header">
		<div class="row">
			<div class="col-1 m-2">
					<button style="width:100%" onclick="addnewCustomer()" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></button>
			</div>	
			<?php if ($usertype == 4): ?>
				<?php 
						$gcq = getActiveCustomer1();
						while ($gcr = $gcq->fetch_array()) { 
							$cutomername = explode(" ",$gcr['cname']);
							?>
							<div class="col-2">
								<button onclick="setThisCustomerModal('<?php echo $gcr[0] ?>')" style="width:100%;" class="btn btn-danger btn-sm"><?php echo $cutomername[0] ?></button>
							</div>
						<?php } ?>
			<?php else: ?>
					<?php 
						$gcq = getActiveCustomer($user_id);
						while ($gcr = $gcq->fetch_array()) { 
							$cutomername = explode(" ",$gcr['cname']);
							?>
							<div class="col-2 m-2">
								<button onclick="setThisCustomerModal('<?php echo $gcr[0] ?>')" style="width:100%;" class="btn btn-danger btn-sm"><?php echo $cutomername[0] ?></button>
							</div>
						<?php } ?> 
			<?php endif ?>
				</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-6">
				<form id="prodcode_submit">
					<div class="form-group">
						<p>Product Code:</p>
						<input <?php echo (!isset($setActiveCustomer)) ? "disabled" : ""; ?> type="text" name="product_code" id="product_code" class="form-control" placeholder="Product_code">
					</div> 
				</form>
			</div>
			<div class="col-4">
				<div class="form-group">
					<p>Customer Name:</p>
					<h4 class="customerSection">
						<?php if (isset($setActiveCustomer)): ?>
						<?php 	
							$getcustomerq = getSpActiveCustomer($setActiveCustomer);
							$gcqr = $getcustomerq->fetch_array();
							echo $gcqr['cname'];
						 ?>
						<?php else: ?>
							No Setted Customer
						<?php endif ?>
					</h4>
				</div>
			</div>
			<div class="col-2">
				<?php if (isset($setActiveCustomer)): ?>
						 <?php if ($usertype != 4): ?>
						 	<button style="width: 100%;margin-top:20px" onclick="viewtotalBill('<?php echo $cusID ?>')" <?php echo ($nnrow < 1) ? "disabled" : ""; ?>  class="btn btn-danger btn-lg float-right"><i class="fa fa-shopping-cart"></i> Payment</button>
						 <?php else: ?>
						 	<button style="width: 100%;margin-top:20px" onclick="openPopUp('printable/temptranscode.php?tempcode=<?php echo $gcqr['cname'] ?>')" class="btn btn-danger btn-lg float-right"><i class="fa fa-print"></i> Print Temp Transcode</button>
						 <?php endif ?>
						<?php endif ?>
			</div>
		</div>
		<form id="addTransItem" method="get" action="includes/queries.php">
			<div class="row"> 
				<div class="col-6">
					<div class="form-group">
						<p>Product Name | Category:</p>
						<select <?php echo (!isset($setActiveCustomer)) ? "disabled" : ""; ?> onchange="transaction_product(this.value)" class="form-control select2" name="product_name" id="product_name" style="width:100%;">
							<option value="" selected disabled>Select Product Name</option>
							<?php 
								$gpq = getProductTrans();
								while ($gpr = $gpq->fetch_array()) {
									$gpdcat = getSpProdCat($gpr['pc_id']);
									$gpcr = $gpdcat->fetch_array();
									$pct = getSpProdType($gpr['pct_id'])->fetch_array();
								 ?>
								<option value="<?php echo $gpr[0] ?>"><?php echo $gpr['p_name'] ?> ( <?php echo $gpcr['pc_name'] ?> | <?php echo $pct['pct_name'] ?>)</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<p>Price (SRP):</p>
						<input readonly type="text" name="trans_price" id="trans_price" class="form-control" placeholder="Price">
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<p>Quantity:</p>
						<input min="1" oninput="checkTransQtty(this.value)" <?php echo (!isset($setActiveCustomer)) ? "disabled" : ""; ?> type="number" name="trans_qtty" id="trans_qtty" class="form-control" placeholder="Qtty">
					</div>
				</div>
				<div class="col-2">
					<div class="form-group">
						<p>&nbsp</p>
						<button id="trans_submit" name="addTransItem" disabled="true" class="btn btn-primary btn-md float-right"><i class="fa fa-shopping-cart"></i> Add Transaction</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="trans_items">
	<table class="table table-bordered">
		<thead style="text-align:center;">
			<tr>
				<th>#</th>
				<th>Product code</th>
				<th>Description/Category/Type</th>
				<th>Price (SRP)</th>
				<th>Qtty</th>
				<th>Amount</th>
				<th>Opt</th>
			</tr>
		</thead>
		<tbody>
				<?php 
					$grandtotal = 0;
					while ($golr = $getOrList->fetch_array()) {
						$i++; 
						$dessc = getTransactionItem($golr['p_id']);
						if ($golr['co_price'] < 1) {
							$actprice = getActivePrice1($golr['p_id'],$golr['co_qtty']);
						}else{
							$actprice = $golr['co_price'];
						}
						$productcodeis = getproductcode($golr['p_id']);
						$transamm = $actprice * $golr['co_qtty'];
						$grandtotal = $grandtotal + $transamm;
						?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $productcodeis ?></td>
							<td><?php echo $dessc ?></td>
							<td align="right"><?php echo number_format($actprice,2) ?></td>
							<td ondblclick="updateQttyOrder('<?php echo $golr[0] ?>')"><?php echo $golr['co_qtty'] ?></td>
							<td align="right"><?php echo number_format($transamm,2) ?></td>
							<td>
								<button onclick="removeTransactionItem('<?php echo $golr[0] ?>')" class="btn btn-danger btn-xs float-right">&#x2715</button>
							</td>
						</tr>
				<?php } ?>
				<?php if ($nnrow < 1): ?>
					<tr>
						<td colspan="7" align="center">No Items Selected</td>
					</tr>
				<?php endif ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3">
				</th>
				<th colspan="2" style="text-align:center;"><b>Total Amount</b></th>
				<th style="text-align:right;"><?php echo number_format($grandtotal) ?></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>
	</div>
	<?php if ($usertype == 2): ?>
		<div class="col-3">
			<div class="card card-secondary">
				<div class="card-header">
					<h4 class="card-title">Transaction of User4</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<?php 
						$gcq = getActiveCustomer1();
						while ($gcr = $gcq->fetch_array()) { 
							$cutomername = explode(" ",$gcr['cname']);
							?>
							<div class="col-12" style="margin:5px;">
								<button onclick="setThisCustomerModal('<?php echo $gcr[0] ?>')" style="width:100%;" class="btn btn-danger btn-sm"><?php echo $cutomername[0] ?></button>
							</div>
						<?php } 
							$gcqnr = $gcq->num_rows;
							if ($gcqnr == 0) {
						?>
							<h6 style="text-align: center;width: 100%;">No Transaction Here</h6>
						<?php } ?> 
					</div>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>