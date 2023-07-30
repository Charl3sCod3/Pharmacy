 <?php 
	if (!isset($themonthis)) {
		$themonthis = date("Y-m-d");
	}
	if (!isset($theyearis)) {
		$theyearis = date("Y-m-d");
	}
 ?>
<div class="card">
	<div class="card-header">
		<h4 id="reptitle" class="card-title">
			Sales Report For <?php echo date("F d, Y", strtotime($themonthis)); ?> to <?php echo date("F d, Y", strtotime($theyearis)); ?>
		</h4>
		<div class="card-tools" style="width:60%;">
			<form id="fetchSalesByDateRange">
				<div class="row">
				<div class="col-4">
					<div class="form-group">
						<input type="date" name="Themonthis" id="Themonthis" class="form-control" value="<?php echo $themonthis ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<input type="date" name="Themonthis" id="theyearis" class="form-control" value="<?php echo $theyearis ?>">
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<button class="btn btn-primary btn-md"><i class="fa fa-search"></i> fetch</button>
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
							$data = SalesReport('3',$themonthis,$theyearis);
							echo $data;
						 ?>
			</div>
		</div>
	</div>
</div>