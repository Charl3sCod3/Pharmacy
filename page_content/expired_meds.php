<div class="card">
	<div class="card-header">
		<h4 class="card-title">
		   List of products for disposal 
		</h4>
		<div class="card-tools">
			<button onclick="disposedMeds()" class="btn btn-md btn-danger">Disposed <i class="fa fa-trash"></i></button>
		</div>
	</div>
	<div class="card-body">
		<table id="example4" class="table table-bordered" style="font-size: 13px;">
			<ul class="legends"> 
				<li>Table Legends :</li>
				<li><i style="color:lightgreen;" class="fas fa-circle"></i> 6 Months</li>
				<li><i style="color:green;" class="fa fa-circle"></i> 5 Months</li>
				<li><i style="color:orange;" class="fa fa-circle"></i> 4 Months</li>
				<li><i style="color:red;" class="fa fa-circle"></i> 3 Months</li> 
			</ul>
			<thead style="text-align:center;">
				<tr>
					<th>Product Code</th>
					<th>Product Desc</th>
					<th>Category</th>
					<th>Type</th>
					<th>Quantity</th>
					<th>Expiration date</th>
					<th>Supplier</th>
				</tr> 
			</thead>
			<tbody>
				<?php 
					$ge = getExpiredProducts();
					while($ger = $ge->fetch_array()){
						$endDate1 = date("Y-m-01", strtotime($ger['expiration_date']));
						$startDate1 = date('Y-m-01');
						$startDate = new DateTime($startDate1);
						$endDate = new DateTime($endDate1);
						$interval = $endDate->diff($startDate);
						$numberOfMonths = ($interval->y * 12) + $interval->m;

						$gp = getSpProduct($ger['p_id']);
						$gpr = $gp->fetch_array();
						$pcat = getSpProdCat($gpr['pc_id'])->fetch_array();
						$pct = getSpProdType($gpr['pct_id'])->fetch_array();
						$supplieris = getSpSupplier($ger['dr_id'])->fetch_array();

						switch ($numberOfMonths) {
							case '6':
								$backgroundis = 'background-color:lightgreen;color:black;';
								break;
							case '5':
								$backgroundis = 'background-color:green;color:white;';
								break;
							case '4':
								$backgroundis = 'background-color:orange;color:white;';
								break;
							case '3':
								$backgroundis = 'background-color:red;color:white;';
								break;
							
							default:
								$backgroundis = 'background-color:transparent';
								break;
						}
				 ?>
				 <tr style="<?php echo $backgroundis ?>">
				 	<td><?php echo $gpr['product_code'] ?></td>
				 	<td><?php echo $gpr['p_name'] ?>  <?php echo $numberOfMonths ?></td>
				 	<td><?php echo $pcat[1] ?></td>
				 	<td><?php echo $pct[1] ?></td>
				 	<td align="right"><?php echo number_format($ger['p_qqty']) ?></td>
				 	<td align="right"><?php echo date("D F d, Y", strtotime($ger['expiration_date'])) ?></td>
				 	<td><?php echo $supplieris['company_name'] ?></td>
				 </tr>
				<?php  }  ?>
				<tfoot>
					<tr>
						<td colspan="4" align="right" style="font-weight: 700;">TOTAL ITEM</td>
						<td align="right" style="font-weight: 700;"><?php echo number_format(getExpiredMeds()) ?></td>
						<td></td>
						<td></td>
					</tr>
				</tfoot>
			</tbody>
		</table>
	</div>
</div>