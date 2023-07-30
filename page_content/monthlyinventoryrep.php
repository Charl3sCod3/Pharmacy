<div class="card card-secondary">
	<div class="card-header">
		<h4 class="card-title">Generated Inventory Report every end of the month</h4>
	</div>
	<div class="card-body">
		<table class="table table-bordered " style="font-size:30px;">
			<thead style="text-align:center;">
				<tr>
					<th>REPORT DATE</th>
					<th>REPORT BY ITEM DELIVERY</th>
					<th>REPORT BY ITEM</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$sql = "SELECT * FROM `monthly_stock_report` WHERE 1=1 GROUP BY `month_date_rep` ";
					$query = $con->query($sql);
					while ($row = $query->fetch_array()) {
				 ?>
				<tr style="text-align:center;">
					<td><?php echo date("F d, Y", strtotime($row['month_date_rep'])) ?></td>
					<td>
						<button onclick="window.location.href='?q=mrbydeliveryitem&mrdateis='+'<?php echo $row['month_date_rep'] ?>'" class="btn btn-info btn-md"><i class="fa fa-truck"></i> View Report</button>
					</td>
					<td>
						<button onclick="window.location.href='?q=mrbyitem&mrdateis='+'<?php echo $row['month_date_rep'] ?>'" class="btn btn-success btn-md"><i class="fa fa-box"></i> View Report</button>
					</td>
				</tr>
				<?php 
					}
				 ?>
			</tbody>
		</table>
	</div>
</div>