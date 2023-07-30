<?php 
	if (!isset($themonthis)) {
		$themonthis = date("m");
	}
	if (!isset($theyearis)) {
		$theyearis = date("Y");
	}
 ?>
<div class="card">
	<div class="card-header">
		<h4 id="reptitle" class="card-title">
			Sales Report For <?php echo $theyearis ?>
		</h4>
		<div class="card-tools" style="width:50%;">
			<form id="fetchSalesYear">
			<div class="row">
				<div class="col-6"> 
					<div class="form-group">
						<select name="yearis" id="yearis" class="form-control select2">
							<option selected disabled value="">SELECT YEAR</option>
							 <?php
							    for ($year = 2020; $year <= 2040; $year++) {
							    	if ($theyearis == $year) {
							    		$sel = "selected";
							    	}else{
							    		$sel = "";
							    	}
							      echo "<option ".$sel."  value=\"$year\">$year</option>";
							    }
							  ?>
						</select>
					</div> 
				</div>
				<div class="col-6">
			 	<button class="btn btn-primary btn-md"><i class="fa fa-search"></i> Fetch</button>
				</div>
			</div>
			</form>
		</div> 
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-12">
				<div style="width: 100%">
						<?php 
							// $data = SalesReport('2',$themonthis,$theyearis);
							$data = SalesYearlyByMonth($theyearis);
							echo $data;
						 ?>
				</div>
			</div>
		</div>
	</div>
</div>