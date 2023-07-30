<?php 
	$totalcd = gettotalCDToday($user_id);
 ?>
		<?php 
			$scheck = checkSalesSubmitted($user_id);
			if ($scheck > 0) {
		 ?>
	<div class="row">
			<div class="col-9">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">
							Submit Sales Report
						</h4> 
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<thead style="text-align:center;">
								<tr>
									<th>#</th>
									<th>Product Name</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php echo getTodaySales($user_id) ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-3">
			 	<div class="card">
			 		<div class="card-header">
			 			<h4 class="card-title">
			 				Cash Dinomination Submitted
			 			</h4>
			 		</div>
			 		<div class="card-body">
			 			<?php 
			 				$Cdis = getsubmittedCD($user_id);
			 				while($cdris = $Cdis->fetch_array()){
			 					$cdtype = getsubmittedCdType($cdris['cd_id']);
			 					$cdtotal = $cdris['scd_qtty'] * $cdris['cd_amount'];
			 			 ?>
			 			 <div class="form-group">
								<p style="margin-bottom:2px;"><?php echo $cdris['cd_amount'] ?> | <?php echo $cdtype ?></p>
								<input type="text" readonly class="form-control" value="x<?php echo $cdris['scd_qtty'] ?> = <?php echo number_format($cdtotal,2) ?>">
							</div>
			 			<?php } ?>
			 		</div>
			 		<div class="card-footer">
			 			<?php echo  '₱'.number_format(gettotalCDToday($user_id),2); ?>
			 		</div>
			 	</div>
			 </div>
		</div>
		<?php }else{ ?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">
					Cash Demonination
				</h4>  
			</div>
			<form id="salesCDForm">
			<div class="card-body">
				<div class="row">
				<?php 
				$gcd = getCashDenomination();
					while ($gcdr = $gcd->fetch_array()) { ?>
						<div class="col-4">
							<div class="form-group">
							<p style="margin-bottom:2px;"><?php echo $gcdr[1] ?> | <?php echo $gcdr[2] ?></p>
							<input type="number" name="cash[]" class="form-control">
							<input type="hidden" name="cd_id[]" class="form-control" value="<?php echo $gcdr[0] ?>">
							<input type="hidden" name="cd_amount[]" class="form-control" value="<?php echo $gcdr[1] ?>">
						</div>
						</div>
				<?php } ?>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary btn-md float-right"><i class="fa fa-save"></i> Submit Report</button>
			</div>
			</form>
		</div>

	<?php } ?>