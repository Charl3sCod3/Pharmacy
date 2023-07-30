<div class="card">
	<div class="card-header">
		<h4 class="card-title">
		   List of Stocks
		</h4>
		<div  class="card-tools">
			
		</div>
	</div>
	<div class="card-body">
		<table id="example4" class="table table-bordered" style="font-size:14px;">
			<thead style="text-align:center;background-color: #646464;color:white;">
				<tr>
					<th>Product Code</th>
					<th>Product Desc</th>
					<th>Category</th>
					<th>Type</th>
					<th>Stock (QTY)</th>
					<th>Selling Price (SRP)</th>
					<!-- <th>Net Sales (P)</th> -->
					<th>Cost/Unit</th>
					<th>Total Cost</th>
					<th>Expiration Date</th>
					<th>Delivery Company</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					// $gp = getProductTrans1();
					// while ($gr = $gp->fetch_array()) {
					// 	$pcat = getSpProdCat($gr['pc_id'])->fetch_array();
					// 	$pct = getSpProdType($gr['pct_id'])->fetch_array();
					// 	$stock = getProductStock($gr[0]);
				$sss = "SELECT * FROM `product_sub` AS ps inner join `product` as p WHERE ps.p_id=p.p_id ";
					$gpd = $con->query($sss);
					$totalSP = 0;
					$totalCP = 0;
					$totalSk = 0;
					$totalNS = 0;
					$totalC =0;
					while ($gpr = $gpd->fetch_array()) {
							$pcat = getSpProdCat($gpr['pc_id'])->fetch_array();
							$pct = getSpProdType($gpr['pct_id'])->fetch_array();
							// $stock = getProductStock($gpr['p_id']);
							$sr = getSpSupplier($gpr['dr_id'])->fetch_array();
							$tsp  = $gpr['p_qqty']*$gpr['p_price'];
							$tc = $gpr['p_qqty']*$gpr['cost'];
							$totalSP += $gpr['p_price'];
							$totalCP += $gpr['cost'];
							$totalSk += $gpr['p_qqty'];
							$totalNS += $tsp;
							$totalC += $tc;
				 ?>
				 <tr>
				 	<td style="vertical-align:middle;"><?php echo $gpr['product_code'] ?></td>
				 	<td style="vertical-align:middle;"><?php echo $gpr['p_name'] ?></td>
				 	<td style="vertical-align:middle;text-align: center;"><?php echo $pcat[1] ?></td>
				 	<td style="vertical-align:middle;text-align: center;"><?php echo $pct[1] ?></td>
				 	<td align="right" style="vertical-align:middle;" ><?php echo $gpr['p_qqty'] ?></td>
				 	<td style="text-align:right; vertical-align:middle;"><?php echo number_format($gpr['p_price'],2); ?></td>
				 	<!-- <td style="text-align:right; vertical-align:middle;"><?php echo number_format($tsp,2) ?></td> -->
				 	<td style="text-align:right; vertical-align:middle;"><?php echo number_format($gpr['cost'],2)?></td>
				 	<td style="text-align:right; vertical-align:middle;"><?php echo number_format($tc,2) ?></td>
				 	<td style="text-align:center; vertical-align:middle;"><?php echo date("F d, Y", strtotime($gpr['expiration_date'])) ?></td>
				 	<td style="vertical-align:middle;text-align: center;"><?php echo $sr['company_name']; ?></td>
				 </tr>
				<?php } ?>
<!-- 				<tr>
					<td>&nbsp</td>
					<td>asdas</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr> -->
			</tbody>
		</table>
	</div>
</div>