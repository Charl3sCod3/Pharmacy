<div class="row">
	<div class="col-4">
		<div class="card card-secondary">
			<div class="card-header">
				<h4 class="card-title">
					Add new discounts
				</h4>
			</div>
			<form id="AddNewDiscount">
				<div class="card-body">
					<div class="form-group">
						<p style="margin-bottom: 2px;">Discount description :</p>
						<input type="text" name="discount_desc" class="form-control" placeholder="Ex.Senior Citizen">
					</div>
					<div class="form-group">
						<p style="margin-bottom:2px;">Percent :</p>
						<input type="number" name="discount_percentage" class="form-control" placeholder="Ex.20 for 20%">
					</div>
				</div>
				<div class="card-footer">
					<button class="btn btn-danger btn-sm float-right"><i class="fa fa-plus"></i> ADD NEW DISCOUNT</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-8">
		<div class="card card-secondary">
			<div class="card-header">
				<h4 class="card-title">
					List of discounts
				</h4>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead style="background-color: #646464;color:white;">
						<tr>
							<th>#</th>
							<th>Description</th>
							<th>Discount</th>
							<th>Opt</th>
						</tr>
					</thead>
					<tbody>
				<?php 
					$gd = getDiscounts();
					$i=0;
					while ($gdr = $gd->fetch_array()) {
						$i++;
				 ?>
				 	<tr>
				 		<td><?php echo $i ?></td>
				 		<td><?php echo $gdr[2] ?></td>
				 		<td align="right"><?php echo $gdr[1] ?>%</td>
				 		<td align="right">
				 			 <button onclick="editDiscount('<?php echo $gdr[0] ?>')" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></button>
				 			 <button onclick="hahaaha()" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
				 		</td>
				 	</tr>
				<?php } ?>
				</tbody>
				</table>
			</div> 
		</div>
	</div>
</div>