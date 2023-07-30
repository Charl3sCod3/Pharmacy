<?php 
  include '../dbcon.php';
 ?>
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <h4 class="modal-title">ADD NEW PRODUCT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form id="addnewProduct">
              <input type="hidden" name="product_code_insert_new" value="<?php echo $product_code ?>">
            <div class="modal-body">
              <div class="form-group">
                <small>Product Category</small>
                <select required name="product_category" class="form-control selectnew">
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
                <small>Product Type</small>
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
                <small>Product Name</small>
                <textarea required name="product_name" class="form-control" placeholder="Ex. Productname | Brand | Generic Name"></textarea>
              </div>
              <div class="form-group">
                <small>Product Requirements</small>
                <select name="product_Requirements" class="form-control selectnew">
                  <option value="0">N/A</option>
                  <option value="1">Prescription</option>
                </select>
              </div>
              <hr>
              <div class="form-group">
                <small>Quantity</small>
                <input required type="number" name="product_quantity" class="form-control">
              </div>
              <div class="form-group">
                <small>Cost</small>
                <input required type="text" name="product_cost" class="form-control onlyNumbers">
              </div>
              <div class="form-group">
                <small>Price</small>
                <input required type="text" name="product_price" class="form-control onlyNumbers">
              </div>
              <div class="form-group">
                <small>Quantity Cap</small>
                <input required type="number" required name="product_qtty_cap" class="form-control" placeholder="System will realease notification when reached">
              </div>
            </div>
            <div class="modal-footer justify-content-between bg-secondary">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="addnewProduct" class="btn btn-outline-light"><i class="fa fa-save"></i> Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->