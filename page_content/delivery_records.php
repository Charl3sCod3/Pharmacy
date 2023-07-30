<div class="card card-secondary" >
	<div class="card-header">
		<h4 class="card-title">
			Suppliers Delivery Records
		</h4>
	</div>
	<div class="card-body">
		<table id="example4" class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Delivery Date</th>
					<th>Suplier Company</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php 
						$i=0;
						$gdr = getdeliveryRecord();
						while ($gdrr = $gdr->fetch_array()) {
							$i++;
						$gds = getSpSupplier($gdrr['sup_id']);
						$gdsr = $gds->fetch_array();
				 ?>
				 <tr onclick="window.location.href='?q=delivery_history_records&sups_id='+'<?php echo $gdrr['sup_id'] ?>'+'&dr_dateis='+'<?php echo $gdrr['dr_date'] ?>'" style="cursor:pointer;">
				 	<td><?php echo $i ?></td>
				 	<td><?php echo date("F d, Y", strtotime($gdrr['dr_date'])) ?></td>
				 	<td><?php echo strtoupper($gdsr['company_name']) ?></td>
				 	<td align="right">₱ <?php echo number_format($gdrr['total_sales'],2) ?></td>
				 </tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>