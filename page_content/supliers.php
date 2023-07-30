<div class="row">
	<div class="col-3">
		<div class="card card-primary">
			<div class="card-header">
				<h4 class="card-title">New supplier</h4>
			</div>
			<form id="InsertForm">
				<input type="hidden" name="insert_supplier" value="true">
				<div class="card-body">
					<div class="form-group">
						<p>Company Name:</p>
						<textarea required name="company_name" rows="2" class="form-control" placeholder="Enter Supplier Company"></textarea>
					</div>
					<div class="form-group">
						<p>Company Address:</p>
						<input type="text" name="company_address" class="form-control" placeholder="Ex. Street Barangay Municipality City">
					</div>
					<div class="form-group">
						<p>Company TIN:</p>
						<input type="text" name="company_TIN" class="form-control" placeholder="Enter Company TIN">
					</div>
					<div class="form-group">
						<p>Company Contact Person:</p>
						<input required type="text" name="contactname" class="form-control" placeholder="Enter contact person name"> 
					</div>
					<div class="form-group">
						<p>Company Email-addres:</p>
						<input type="email" name="company_email" class="form-control" placeholder="Ex. Johndoe@gmail.com">
					</div>
					<div class="form-group">
						<p>Phone Number:</p>
						<textarea name="contactnumber" class="form-control" placeholder="Ex.09062248536 / 09234263453"></textarea>
					</div>
					<button class="btn btn-primary btn-md">Add new supplier</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-9">
		<div class="card card-primary">
			<div class="card-header">
				<h4 class="card-title">List of Supplier</h4>
			</div>
			<div class="card-body">
				<table id="prod_cat-table" class="table table-bordered" style="font-size:14px;">
		       		<thead style="text-align:center">
		       			<tr>
		       				<th>#</th>
		       				<th>Company Name</th>
		       				<th>Company Address</th>
		       				<th>Company TIN</th>
		       				<th>Company Email</th>
		       				<th>Contact Number</th>
		       				<th style="width:30%;">Options</th>
		       			</tr>
		       		</thead>
		       		<tbody>
		       			<?php 
		       				$gpcq = getSuppliers();
		       				while ($row = $gpcq->fetch_array()) { ?>
		       					<tr>
		       						<td></td>
			       					<td><?php echo $row[1] ?></td>
			       					<td><?php echo $row['sup_address'] ?></td>
			       					<td><?php echo $row['sup_tin'] ?></td>
			       				    <td><?php echo $row['sup_email'] ?></td>
			       					<td><?php echo $row[3] ?></td>
			       					<td style="text-align: center;vertical-align: middle;">
			       						<button onclick="editSupplier('<?php echo $row[0] ?>')" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
			       						<button onclick="delSupplier('<?php echo $row[0] ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
			       					</td>
		       					</tr>
		       				<?php } ?>
		       		</tbody>
		       	</table>
			</div>
		</div>
	</div>
</div>