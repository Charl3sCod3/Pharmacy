<?php 
  include '../dbcon.php';
 ?>
        <div class="modal-dialog modal-lg">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Check Product Cost</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form id="checkCost">
                  <div class="form-group">
                  <p style="margin-bottom:2px;">Product Code :</p>
                  <input type="text" name="CC_product_code" id="CC_product_code" class="form-control" placeholder="Product_code">
                </div>
              </form>
                <div class="form-group">
                  <p style="margin-bottom:2px;">Product Name :</p>
                  <select onchange="getCostPname(this.value)" class="form-control selectnew" name="CC_product_name" id="CC_product_name">
                    <option selected disabled value="">SELECT PRODUCT NAME</option>
                          <?php 
                            $gpq = getProductTrans1();
                            while ($gpr = $gpq->fetch_array()) {
                              $gpdcat = getSpProdCat($gpr['pc_id']);
                              $gpcr = $gpdcat->fetch_array();
                             ?>
                            <option value="<?php echo $gpr[0] ?>"><?php echo $gpr['p_name'] ?> ( <?php echo $gpcr['pc_name'] ?> )</option>
                          <?php } ?>
                  </select>
                </div>
                <div id="result_content">
                  
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->