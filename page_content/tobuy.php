<div class="card">
	<div class="card-header">
		<h4 class="card-title">
		   List of Stocks
		</h4>
		<div class="card-tools">
			<button onclick="openPopUp('printable/forPurchase.php')" class="btn btn-primary btn-md"><i class="fa fa-print"></i> Print</button>
		</div>
	</div>
	<div class="card-body">
		<table id="example8" class="table table-bordered">
			<thead style="text-align:center;">
				<tr>
					<th>Product Code</th>
					<th>Product Desc</th>
					<th>Category</th>
					<th>Type</th>
					<th>Stock</th>
					<th>Quantity Cap</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$gp = getProductTrans1();
					while ($gr = $gp->fetch_array()) {
						$pcat = getSpProdCat($gr['pc_id'])->fetch_array();
						$pct = getSpProdType($gr['pct_id'])->fetch_array();
						$stock = getProductStock($gr[0]);
						$checkqtty = checktheqtty($gr[0],$gr['cap_qtty']);
						if ($checkqtty > 0) {
				 ?>
				 <tr>
				 	<td><?php echo $gr['product_code'] ?></td>
				 	<td><?php echo $gr['p_name'] ?></td>
				 	<td><?php echo $pcat[1] ?></td>
				 	<td><?php echo $pct[1] ?></td>
				 	<td align="right"><?php echo number_format($stock) ?></td>
				 	<td align="right"><?php echo number_format($gr['cap_qtty']) ?></td>
				 </tr>
				<?php  }}  ?>
			</tbody>
		</table>
	</div>
</div>