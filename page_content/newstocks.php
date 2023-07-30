<div class="row">
	<!-- <div class="col-3">
		<div class="card card-secondary"> 
			<div class="card-header">
				<h4 class="card-title">
					Select Supplier
				</h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<select onchange="setsupplier(this.value)" class="form-control select2">
						<option selected disabled value="">SELECT A SUPPLIER FIRST</option>
						<?php 
						if (isset($tssuplier)) {
							$supp = $tssuplier;
						}else{
							$supp = "what";
						} 
							$gsup = getSuppliers();
							while ($gsrow = $gsup->fetch_array()) { ?>
								<option <?php echo selected($gsrow[0],$supp) ?> value="<?php echo $gsrow[0] ?>"><?php echo $gsrow[1] ?></option>
							<?php }  ?> 
					</select>
				</div>
			</div>
		</div>
	</div> -->
	<div class="col-12"> 
		<div class="card card-secondary">
			<div class="card-header">
				<h4 class="card-title">
					Product
				</h4>
			</div>
			<form id="addProductQuantity">
			<div class="card-body">
				<div class="row">
					<div class="col-3">
						<div class="form-group">
							<label>Supplier</label>
								<select onchange="setsupplier(this.value)" class="form-control select2">
									<option selected disabled value="">SELECT A SUPPLIER FIRST</option>
									<?php 
									if (isset($tssuplier)) {
										$supp = $tssuplier;
									}else{
										$supp = "what";
									} 
										$gsup = getSuppliers();
										while ($gsrow = $gsup->fetch_array()) { ?>
											<option <?php echo selected($gsrow[0],$supp) ?> value="<?php echo $gsrow[0] ?>"><?php echo $gsrow[1] ?></option>
										<?php }  ?> 
								</select>
							</div>
					</div>
					<div class="col-9">
						<div class="form-group">
							<label>Product Code</label>
							<input id="product_code" <?php echo (!isset($tssuplier)) ? "disabled" : ""; ?> type="text" name="product_code_update_inventory" class="form-control" placeholder="Product Code">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<div class="form-group">
						<p>Product Name | Brand:</p>
						<select <?php echo (!isset($tssuplier)) ? "disabled" : ""; ?> onchange="transaction_product(this.value)" class="form-control select2" name="product_name" id="product_name" style="width:100%;">
							<option value="" selected disabled>Select Product Name</option>
							<?php 
								$gpq = getAllProduct();
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
							<p>Quantity :</p>
							<input <?php echo (!isset($tssuplier)) ? "disabled" : ""; ?> required type="number" name="product_quantity" id="trans_qtty" class="form-control" placeholder="Quantity">
						</div>
					</div>
					<div class="col-2">
						<div class="form-group">
							<p>Selling Price (SRP):</p>
							<input <?php echo (!isset($tssuplier)) ? "disabled" : ""; ?> required type="text" name="product_price" class="form-control onlyNumbers" placeholder="Price ( SRP )">
						</div>
					</div>
					<div class="col-2">
						<div class="form-group">
							<p>Cost :</p>
							<input <?php echo (!isset($tssuplier)) ? "disabled" : ""; ?> required type="text" name="product_cost" class="form-control onlyNumbers" placeholder="Cost">
						</div>
					</div>
					<div class="col-2">
						<p>&nbsp</p>
						<button <?php echo (!isset($tssuplier)) ? "disabled" : ""; ?> class="btn btn-primary btn-md"><i class="fa fa-plus"></i> add</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card card-secondary">
			<div class="card-header">
				<h4 class="card-title">
					List of Purchases
				</h4>
			</div>
			<form id="addDeliveryToInventory">
			<div class="card-body">
				<table id="example2" class="table table-bordered" style="font-size:14px;">
					<thead style="text-align:center;">
						<tr>
							<th>#</th>
							<th width="20%">Expiration Date</th>
							<th width="40%">Product Name</th>
							<th>Quantity</th>
							<th>Cost</th>
							<th>Selling Price (SRP)</th>
							<th>Amount</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$gdrlq = getDeliveredListRaw($supp);
							$i=0;
							$grandtotalis = 0;
							while ($drlrow = $gdrlq->fetch_array()) {
								$i++;
								$totalamount = $drlrow['dr_qtty'] * $drlrow['dr_price'];
								$grandtotalis += $totalamount;
								 ?>
							<tr>
								<td><?php echo $i ?></td>
								<td>
									<div class="form-group">
										<input required onblur="expCheckDate(this.value,'<?php echo $drlrow[0] ?>','<?php echo $i ?>')" type="date" name="expirationdate[]" class="form-control input_date<?php echo $i ?>" value="<?php echo $drlrow['dr_expiration'] ?>">
									</div>
								</td>
								<td style="text-align:left;vertical-align: middle;">
									<p>
										<?php echo getProductName($drlrow['p_id']) ?>
									</p>
								</td>
								<td id="edit_quantity" style="text-align:center;vertical-align: middle;">
									<div class="form-group">
										<input onchange="updateDrQtty(this.value,'<?php echo $drlrow[0] ?>')" type="number" class="form-control" value="<?php echo $drlrow['dr_qtty'] ?>" name="">
									</div>
								</td>
								<td style="text-align:right;vertical-align: middle;"><?php echo number_format($drlrow['dr_cost'],2) ?></td>
								<td style="text-align:right;vertical-align: middle;"><?php echo number_format($drlrow['dr_price'],2) ?></td>
								<td style="text-align:right;vertical-align: middle;"><?php echo number_format($totalamount,2) ?></td>
								<td style="text-align:center;vertical-align: middle;">
									<button onclick="removeDrItem('<?php echo $drlrow[0] ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<div class="card-footer">
					<div class="row">
						<div class="col-2">
						</div><div class="col-2">
							<div class="form-group">
								<p>Entered item total amount: </p>
								<input type="text" readonly name="DLT" id="DLT" class="form-control" style="text-align: right;" value="<?php echo $grandtotalis ?>"> 
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<p>DR / OR Receipt: </p>
								<input oninput="newStockValidation()" type="text" required name="DelOrNumber" id="DelOrNumber" class="form-control">
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<p>DR / OR Total Amount: </p>
								<input oninput="newStockValidation()" type="number" required name="delamout" id="delamout" class="form-control">
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<p>OR DR Date: </p>
								<input oninput="newStockValidation()" type="date" required name="date_delivered_insert" id="date_delivered_insert" class="form-control">
							</div>
						</div>
						<div class="col-2">
							<div class="form-group">
								<p>&nbsp</p>
								<button id="insertnewStocks" class="btn btn-primary btn-md float-right" style="width:100%;">
								<i class="fa fa-save"></i> Add to inventory
							</button>
							</div>
						</div>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>