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
			Sales Report For The Month of <?php echo date("F, Y", strtotime($theyearis.'-'.$themonthis)) ?>
		</h4>
		<div class="card-tools" style="width:50%;">
			<form id="fetchSalesMonths">
				<div class="row">
				<div class="col-4">
					<div class="form-group">
						<select name="monthis" id="monthis" class="form-control select2">
							<option selected disabled value="">SELECT MONTH</option>
							  <option <?php echo selected($themonthis,"01") ?> value="01">January</option>
							  <option <?php echo selected($themonthis,"02") ?> value="02">February</option>
							  <option <?php echo selected($themonthis,"03") ?> value="03">March</option>
							  <option <?php echo selected($themonthis,"04") ?> value="04">April</option>
							  <option <?php echo selected($themonthis,"05") ?> value="05">May</option>
							  <option <?php echo selected($themonthis,"06") ?> value="06">June</option>
							  <option <?php echo selected($themonthis,"07") ?> value="07">July</option>
							  <option <?php echo selected($themonthis,"08") ?> value="08">August</option>
							  <option <?php echo selected($themonthis,"09") ?> value="09">September</option>
							  <option <?php echo selected($themonthis,"10") ?> value="10">October</option>
							  <option <?php echo selected($themonthis,"11") ?> value="11">November</option>
							  <option <?php echo selected($themonthis,"12") ?> value="12">December</option>
							</select>
					</div> 
				</div>
				<div class="col-4">
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
				<div class="col-4">
					<button class="btn btn-primary btn-md"><i class="fa fa-search"></i> Fetch</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<div class="card-body">
		<div class="row">
			<div  class="col-lg-12">
				
						<?php 
							// $data = SalesReport('1',$themonthis,$theyearis);
						$data = SalesMonthlyBydate($themonthis,$theyearis);
							echo $data;
						 ?>
			</div>
		</div>
	</div>
</div>