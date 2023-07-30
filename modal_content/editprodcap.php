<?php 
  include '../dbcon.php';
  $pakdates = date("Y-m-d");
  $row = getSpProduct($p_id)->fetch_array();
  $rowsee =$row;
  extract($rowsee);
 ?>
<div class="modal-dialog modal-md">
<div class="modal-content bg-secondary">
  <div class="modal-header">
    <h4 class="modal-title">Edit Product Quantitity Cap</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
  </div>
  <form id="editprodcap">
  <div class="modal-body">
    <div class="form-group">
      <p style="margin-bottom: 2px;">Product Code :</p>
      <input type="text" value="<?php echo $product_code ?>" name="product_code" class="form-control" placeholder="Make sure product code is correct">
    </div>
    <div class="form-group">
      <p style="margin-bottom: 2px;">Sub Product Code :</p>
      <input type="text" value="<?php echo $sub_product_code ?>" name="sub_product_code" class="form-control" placeholder="Make sure product code is correct">
    </div>
    <div class="form-group">
      <p style="margin-bottom: 2px;">Product Name :</p>
      <input type="text" value="<?php echo $p_name ?>" name="product_name" class="form-control" placeholder="Enter Product Name">
    </div>
     <div class="form-group">
      <p style="margin-bottom: 2px;">Product Category :</p>
      <select required name="product_category" class="form-control selectnew">
                  <option value="" selected disabled>Select product category</option>
                  <?php 
                   $gpcq =  getProductCat();
                   while ($pcr = $gpcq->fetch_array()) {
                   ?>
                   <option <?php echo selected($pc_id,$pcr[0]) ?> value="<?php echo $pcr[0] ?>"><?php echo $pcr[1] ?></option>
                 <?php } ?>
                </select>
    </div>
    <div class="form-group">
      <p style="margin-bottom: 2px;">Product Type :</p>
      <select name="product_type" required class="form-control selectnew">
                  <option value="" selected disabled>Select product type</option>
                  <?php 
                   $gptq =  getProductType();
                   while ($ptr = $gptq->fetch_array()) {
                   ?>
                   <option <?php echo selected($pct_id,$ptr[0]) ?> value="<?php echo $ptr[0] ?>"><?php echo $ptr[1] ?></option>
                 <?php } ?>
                </select>
    </div>
    <div class="form-group">
                    <small>Product Requirements</small>
                    <select name="product_Requirements" class="form-control selectnew">
                      <option <?php echo selected($p_req,'0') ?> value="0">N/A</option>
                      <option <?php echo selected($p_req,'1') ?> value="1">Prescription</option>
                    </select>
                  </div>
    <div class="form-group">
      <p style="margin-bottom: 2px;">Current Product Cap :</p>
       <input type="text" value="<?php echo $cap_qtty ?>" name="edit_qtty_cap" required class="form-control" placeholder="Enter New Product Cap ( Warning qtty )">
    </div>
  </div>
  <div class="modal-footer justify-content-between">
    <!-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button> -->
    <input type="hidden" name="p_id_editcap" value="<?php echo $p_id ?>">
    <button type="submit" name="editPcat" class="btn btn-outline-light"><i class="fa fa-edit"></i> Edit</button>
  </div>
  </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->