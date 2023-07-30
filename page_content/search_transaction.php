<div class="card" style="width:80%;margin: auto;">
	<div class="card-header">
		<h4 class="card-title">
			Below is the result of the search.
		</h4>
	</div>
	<div class="card-body">
		<table id="example1" class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Transaction Code</th>
					<th>Customer Name</th>
					<th>Transaction Date</th>
					<th>Amount</th>
					<th>Cash</th>
					<th>Change</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=0;
				$search_q = transaction_search($search_request);
				$snrow = $search_q->num_rows;
				while ($search = $search_q->fetch_array()) {  $i++; ?>
					<tr onclick="window.location.href='?q=trans_history&c_id='+'<?php echo $search[0] ?>'" style="cursor: pointer;">
						<td><?php echo $i ?></td>
						<td><?php echo $search['transaction_code'] ?></td>
						<td><?php echo $search['cname'] ?></td>
						<td><?php echo $search['transaction_date'] ?></td>
						<td><?php echo '₱'.number_format($search['c_amount'],2) ?></td>
						<td><?php echo '₱'.number_format($search['c_cash'],2) ?></td>
						<td><?php echo '₱'.number_format($search['c_change'],2) ?></td>
					</tr>	
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>