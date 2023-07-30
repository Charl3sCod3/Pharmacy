<?php 
  include '../dbcon.php';
  $gspp = getSpProduct($p_id);
  $gsppr = $gspp->fetch_array();
  $pdesc = substr($gsppr['p_desc'], 0, 25) . '...';
 ?>
<div class="modal-dialog modal-lg">
    <div class="modal-content bg-secondary">
          <div class="modal-header">
                <h4 class="modal-title">ADD TO CART <?php echo $p_id ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
          </div>
          <form id="addtocartForm" method="post" action="includes/queries.php" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div class="product_cont" style="margin-top: 1em;">
                          <div class="product_inner_cont">
                            <div class="image_cont" style="height: 330px;">
                              <img src="images/<?php echo $gsppr['p_img'] ?>" style="width: 100%;margin:auto;height: 100%;">
                            </div>
                          </div>
                        </div>
                </div>
                <div class="col-6">
                  <div style="padding: 1em;color:black;background-color: white;margin:1em; ">
                              <h6 style="height: 60px;">
                                  <small>Product Name:</small> <br>
                                <?php echo $gsppr['p_name'] ?></h6>
                                <p>
                                  <small>Product Description:</small> <br>
                                <?php echo $pdesc ?></p>
                                <h5 style="padding: 10px 5px;background-color: grey;color:white;">Price: Php <?php echo $gsppr['p_price'] ?></h5>
                                <div class="form-group">
                                  <small>Quantity:</small>
                                  <input oninput="calcTotal(this.value,'<?php echo $gsppr['p_price'] ?>')" type="number" name="or_qtty" id="or_qtty" class="form-control" placeholder="Enter Quantity "> 
                                </div>
                                <div class="form-group">
                                  <input type="hidden" name="adtocart" id="adtocart" class="form-control" placeholder="Enter Quantity " value="<?php echo $p_id ?>"> 
                                  <small>Total Ammount:</small>
                                  <input type="text" readonly="" id="totalammountOR" class="form-control">
                                </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="addnewProduct" class="btn btn-outline-light"><i class="fa fa-plus"></i> ADD</button>
          </div>
          </form>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->