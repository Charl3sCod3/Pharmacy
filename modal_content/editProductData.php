<?php 
  include '../dbcon.php';
  $pcq = getAllProdCat();
  $gpq = getSpProduct($p_id);
  $gpr = $gpq->fetch_array();
 ?>
        <div class="modal-dialog modal-md">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">EDIT PRODUCT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form id="editProductDataForm" method="post" action="includes/queries.php" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" name="p_idEdit" id="p_idEdit" value="<?php echo $p_id ?>">
                <small>Product Name:</small>
                <input type="text" required="" id="prodname" value="<?php echo $gpr['p_name'] ?>" name="prodname" class="form-control"  placeholder="Enter Product Category Name">
              </div>
              <div class="form-group">
                <small>Product Description:</small>
                <textarea id="proddesc" name="proddesc" class="form-control"><?php echo $gpr['p_desc'] ?></textarea>
              </div>
              <div class="form-group">
                <small>Product Price:</small>
                <input type="text" required="" id="prodprice" value="<?php echo $gpr['p_price'] ?>" name="prodprice" class="form-control" placeholder="Enter Product Category Name">
              </div>
              <div class="form-group">
                <small>Product Category:</small>
                <select id="prodCat"  name="prodCat" required="" class="form-control">
                  <option disabled="" selected="" value="">Select Product Category</option>
                  <?php 
                    while ($pcr = $pcq->fetch_array()) {
                   ?>
                   <option <?php echo selected($pcr[0],$gpr['pc_id']) ?> value="<?php echo $pcr[0] ?>"><?php echo $pcr[1] ?></option>
                 <?php } ?>
                </select>
              </div>
              <div class="row">
                <div class="col-4">
                  <div style="width: 100%;height: 100px;border:solid white 4px; overflow: hidden;">
                    <img src="images/<?php echo $gpr['p_img'] ?>" style="width: 100%;height: 100%;">
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                      <small>Product Image:</small>
                      <input type="file"  id="prodImg" name="prodImg" class="form-control"  placeholder="Enter Product Category Name">
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="addnewProduct" class="btn btn-outline-light">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->