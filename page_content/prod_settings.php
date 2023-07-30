<div class="row">
	<div class="col-4">
		<div class="card card-secondary">
			<div class="card-header">
				<h4 class="card-title">
					ADD NEW PRODUCT
				</h4>
			</div>
			<form id="newproductNoqqty">
			<div class="card-body"> 
					<div class="form-group">
						<p>Product code</p>
						<input type="text" required name="product_code" id="product_codeis" class="form-control" placeholder="Enter Product Code">
					</div>
					<div class="form-group">
						<p>Sub Product code</p>
						<input type="number"  name="sub_product_code" id="sub_product_codeis" class="form-control" placeholder="Enter Sub Product Code">
					</div>
					<div class="form-group">
						<p>Product Description</p>
						<textarea name="product_name" required id="product_name" class="form-control" rows="4"></textarea>
					</div>
					<div class="form-group">
						<p>Product Category</p>
						<select required name="product_category" class="form-control select2">
		                  <option value="" selected disabled>Select product category</option>
		                  <?php 
		                   $gpcq =  getProductCat();
		                   while ($pcr = $gpcq->fetch_array()) {
		                   ?>
		                   <option value="<?php echo $pcr[0] ?>"><?php echo $pcr[1] ?></option>
		                 <?php } ?>
		                </select>
					</div>
					<div class="form-group">
						<p>Product Type</p>
						<select name="product_type" required class="form-control selectnew">
			                  <option value="" selected disabled>Select product type</option>
			                  <?php 
			                   $gptq =  getProductType();
			                   while ($ptr = $gptq->fetch_array()) {
			                   ?>
			                   <option value="<?php echo $ptr[0] ?>"><?php echo $ptr[1] ?></option>
			                 <?php } ?>
			                </select>
					</div>
					<div class="form-group">
		                <small>Product Requirements</small>
		                <select name="product_Requirements" class="form-control selectnew">
		                  <option value="0">N/A</option>
		                  <option value="1">Prescription</option>
		                </select>
		              </div>
					<div class="form-group">
		                <p>Quantity Cap</p>
		                <input required type="number" required name="product_qtty_cap" class="form-control" placeholder="System will realease notification when reached">
		              </div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Add new Product</button>
			</div>
			</form>
		</div>
	</div>
	<div class="col-8">
		<div class="card card-secondary">
				<div class="card-header">
					<h4 class="card-title">
					   List of Products
					</h4>
				</div>
				<div class="card-body" style="font-size: 13px;">
					<table id="filterable" class="table table-bordered">
						<thead style="text-align:center;">
							<tr>
								<th>Product Code</th>
								<th>Sub Product Code</th>
								<th>Product Desc</th>
								<th>Category</th>
								<th>Type</th>
								<th>Quantity Threshold</th>
								<th>Opt</th>
							</tr>
						</thead>
						<tbody style="height: 450px;">
							<?php 
								$gp = getProductTrans1();
								while ($gr = $gp->fetch_array()) {
									$pcat = getSpProdCat($gr['pc_id'])->fetch_array();
									$pct = getSpProdType($gr['pct_id'])->fetch_array();
									$stock = getProductStock($gr[0]);
							 ?>
							 <tr>
							 	<td><?php echo $gr['product_code'] ?></td>
							 	<td><?php echo $gr['sub_product_code'] ?></td>
							 	<td><?php echo $gr['p_name'] ?></td>
							 	<td><?php echo $pcat[1] ?></td>
							 	<td><?php echo $pct[1] ?></td>
							 	<td><?php echo number_format($gr['cap_qtty']) ?></td>
							 	<td align="right">
							 		<button onclick="editprodcap('<?php echo $gr[0] ?>')" class="btn btn-primary btn-sm"><i class="fa fa-cog"></i></button>
							 	</td>
							 </tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
	</div>
</div>