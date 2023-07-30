<div class="card">
	<div class="card-header">
		<h4 class="card-title">
			List of Employees
		</h4>
	</div>
	<div class="card-body">
		<table class="table table-bordered" style="font-size:25px;">
			<thead style="text-align:center;">
				<tr>
					<th style="width:25px;">#</th>
					<th>Employee</th>
					<th>Cash Float</th>
					<th>OPT</th>
				</tr>
			</thead>
			<tbody>
		<?php 
			$u = getSystem_usersActives1();
				$i=0;
				$pt_date = date("Y-m-d");
					while ($ur = $u->fetch_array()) {
						$i++;
  						$cashfloat = getCashfloat($ur[0],$pt_date)->fetch_array();
		 ?>
		 <tr>
		 	<td><?php echo $i ?></td>
		 	<td><?php echo strtoupper($ur['user_fullname']) ?></td>
		 	<td align="right">₱<?php echo number_format($cashfloat['pt_cash'],2) ?></td>
		 	<td>
		 		<button onclick="AddPettycash('<?php echo $ur[0] ?>')" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i></button>
		 	</td>
		 </tr>
		<?php } ?>
		</tbody>
		</table>
	</div>
</div>