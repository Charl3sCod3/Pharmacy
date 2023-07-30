<div class="card card-secondary" style="font-size:13px;">
	<div class="card-header">
		<h4 class="card-title">
			Sales Report Today
		</h4>
		<div class="card-tools">
			<?php echo date("Y-m-d") ?>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-6">
				<form id="fetch_salesReport">
					<div class="row">
						<div class="col-5">
							<div class="form-group">
									<select required name="theuseris" id="stheuseris" class="form-control select2">
										<option value="" selected disabled>Select User</option>
										<?php 
										   $gu = "SELECT * FROM `wd_user` WHERE 1=1 ";
											$guq = $con->query($gu);
											while ($gur = $guq->fetch_array()) { ?> 	
												<option value="<?php echo $gur[0] ?>"><?php echo $gur['user_fullname'] ?></option>
										<?php } ?>
									</select>
								</div>
						</div>
						<div class="col-4">
							<div class="form-group">
								<input required type="date" name="thedate" id="sthedate" class="form-control" >
							</div>
						</div>
						<div class="col-3">
							<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> fetch</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-6">
				
			</div> 
		</div>
		<div class="row">
			<div class="col-8">
				<table class="table table-bordered">
					<thead style="background-color:#646464;color:white;">
						<tr>
							<th>#</th>
							<th>PRODUCT NAME</th>
							<th>QTTY</th>
							<th>PRICE | COST</th>
							<th>AMOUNT</th>
							<th>Discount</th>
						</tr>
					</thead>
					<tbody>
						<?php 
								if (!isset($thedate)) {
									$thedate = date('Y-m-d');
								}
								if (!isset($theuseris)) {
									$theuseris = 0;
								}
								$data = getSubmittedSalesByDate($theuseris,$thedate);
								echo $data;
						 ?>
					</tbody>
				</table>
			</div>
			<div class="col-4">
						<?php 
			$scheck = checkSalesSubmittedByDate($theuseris,$thedate);
			if ($scheck > 0) {
		 ?>
		 	<div class="card">
		 		<div class="card-header">
		 			<h4 class="card-title">
		 				Cash Dinomination Submitted
		 			</h4>
		 		</div>
		 		<div class="card-body">
		 			<?php 
		 				$Cdis = getSubmittedSalesByDateByUser($theuseris,$thedate);
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
		 			<?php echo  '₱'.number_format(gettotalCDDate($theuseris,$thedate),2); ?>
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
			<div class="card-body" style="text-align:center;">
			NO CASH DINOMINATION SUBMITTED
			</div>
			<div class="card-footer">
				&nbsp
			</div>
			</form>
		</div>
	<?php } ?>
			</div>
		</div>
	</div>
</div>