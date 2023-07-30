 <?php 
	if (!isset($themonthis)) {
		$themonthis = date("Y-m-d");
	}
	if (!isset($theyearis)) {
		$theyearis = date("Y-m-d");
	}
	if (!isset($cashieris)) {
		$cashieris =0;
		$cashierday = "SELECT DATE AND CASHIER";
	}else{
		$sql = "SELECT * FROM `wd_user` WHERE `user_id`='$cashieris'";
			$result = $con->query($sql);

			if ($result->num_rows > 0) {
			    $row = $result->fetch_assoc();
			    $cashierday = $row['user_fullname'];
			} 
	}
 ?>
<div class="card">
	<div class="card-header">
		<h4 id="reptitle" class="card-title">
			<div class="form-group">
				<small>Cahier Name:</small>
				<input type="text" name="" readonly class="form-control" value="<?php echo $cashierday ?>">
			</div>
		</h4>
		<div class="card-tools" style="width:70%;">
			<form id="fetchSalesByDateRangeCashier">
				<div class="row">
				<div class="col-3">
					<div class="form-group">
						<small>Date Start:</small>
						<input type="date" name="Themonthis" id="Themonthis" class="form-control" value="<?php echo $themonthis ?>">
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
						<small>Date End:</small>
						<input type="date" name="Themonthis" id="theyearis" class="form-control" value="<?php echo $theyearis ?>">
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
						<small>Date End:</small>
						<select required name="thecashieris" id="thecashieris" class="form-control select2">
										<option value="" selected disabled>Select Cashier</option>
										<?php 
										   $gu = "SELECT * FROM `wd_user` WHERE `user_access` BETWEEN 1 AND 2 ";
											$guq = $con->query($gu);
											while ($gur = $guq->fetch_array()) { ?> 	
												<option <?php echo selected($cashieris,$gur[0]) ?> value="<?php echo $gur[0] ?>"><?php echo $gur['user_fullname'] ?></option>
										<?php } ?>
									</select>
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
						<small>&nbsp</small>
						<button class="btn btn-primary btn-md " style="width:100%"><i class="fa fa-search"></i> fetch</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div> 
	<div class="card-body">
		<div class="row">
			<div class="col-12">
						<?php 
							$data = SalesReportByCashier('0',$themonthis,$theyearis,$cashieris);
							echo $data;
						 ?>
			</div>
		</div>
	</div>
</div>