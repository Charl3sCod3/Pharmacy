<?php 
		$gsps = getSpSupplier($sups_id)->fetch_array();
 ?>
<div class="card">
	<div class="card-header">
		<h4 id="reptitle" class="card-title">
			<table>
				<tr>
				<td colspan="4">SUPLIER : <?php echo strtoupper($gsps['company_name']) ?></td>
				<td colspan="3" style="padding-left:3em;"> DELIVERY DATE : <?php echo date("F d, Y", strtotime($dr_dateis)) ?></td>
			</tr>
			</table>
		</h4>
		<div class="card-tools"></div>
	</div>
	<div class="card-body">
		<table id="delivery_records" class="table table-bordered">
			<thead style="background-color: #646464;color:white;">
				<tr>
					<th>#</th>
					<th>Product Name</th>
					<th>Product Category</th>
					<th>Product Type</th>
					<th>Quantity</th>
					<th>Cost</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php 	$i=0;
						$gdi = getDeliveryRecordsItems($sups_id,$dr_dateis);
						$grandtotal =0;
						while ($gdir = $gdi->fetch_array()) {
							$i++;
							$gspp = getSpProduct($gdir['p_id'])->fetch_array();
							$gsppc = getSpProdCat($gspp['pc_id'])->fetch_array();
							$gsppt = getSpProdType($gspp['pct_id'])->fetch_array();
							$totalamount = $gdir['dr_qtty'] * $gdir['dr_cost'];
							$grandtotal += $totalamount;
				 ?>
				 	<tr>
				 		<td><?php echo $i ?></td>
				 		<td><?php echo $gspp['p_name'] ?></td>
				 		<td><?php echo $gsppc['pc_name'] ?></td>
				 		<td><?php echo $gsppt[1] ?></td>
				 		<td><?php echo number_format($gdir['dr_qtty']) ?></td>
				 		<td>
				 			<?php echo $gdir['dr_cost'] ?>
				 		</td>
				 		<td align="right">₱ <?php echo number_format($totalamount,2) ?></td>
				 	</tr>
				<?php } ?>
			
					<tr style="background-color: #646464;color:white;">
					<td coalign="right" style="color:transparent;"></td>
					<td coalign="right"></td>
					<td coalign="right"></td>
					<td coalign="right"></td>
					<td coalign="right"></td>
					<td coalign="right">Total</td>
					<td align="right">₱ <?php echo number_format($grandtotal,2) ?></td>
				</tr>

			</tbody>
		</table>
	</div>
</div>