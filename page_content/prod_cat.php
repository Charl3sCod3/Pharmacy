<div class="row">
	<div class="col-4">
		<div class="card card-secondary">
		      <div class="card-header">
		        <h3 class="card-title">New product category</h3>
		        <!-- /.card-tools -->
		      </div>
		      <!-- /.card-header -->
		      <form id="addNewCat">
		      <div class="card-body">
		       	<div class="form-group">
		       		<small>Product Category</small>
		       		<input required type="text" name="prod_cat_new" class="form-control" placeholder="Type in Product Category" autocomplete="off">
		       	</div>
		    </div>
		    <div class="card-footer">
		    	<button type="submit" class="btn btn-primary btn-md"><i class="fa fa-save"></i> Add new category</button>
		    </div>
		      <!-- /.card-body -->
		    </form>
	    </div>
	</div>
	<div class="col-8">
		<div class="card card-secondary">
		      <div class="card-header">
		        <h3 class="card-title">Product category list</h3>
		        <!-- /.card-tools -->
		      </div>
		      <!-- /.card-header -->
		      <div class="card-body" style="min-height: 500px;">
		       	<table id="prod_cat-table" class="table table-bordered">
		       		<thead style="text-align:center">
		       			<tr>
		       				<th>#</th>
		       				<th>Product Category</th>
		       				<th style="width:30%;">Options</th>
		       			</tr>
		       		</thead>
		       		<tbody>
		       			<?php 
		       				$gpcq = getProductCat();
		       				while ($row = $gpcq->fetch_array()) { ?>
		       					<tr>
		       						<td></td>
			       					<td><?php echo $row[1] ?></td>
			       					<td>
			       						<button onclick="editpcat('<?php echo $row[0] ?>')" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
			       						<button onclick="delpcat('<?php echo $row[0] ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
			       					</td>
		       					</tr>
		       				<?php } ?>
		       		</tbody>
		       	</table>
		    </div>
		      <!-- /.card-body -->
	    </div>
	</div>
</div>