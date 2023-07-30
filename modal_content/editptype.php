<?php 
  include '../dbcon.php';
  $pcq = getSpProdType($pct_id);
  $pcr = $pcq->fetch_array();
 ?>
        <div class="modal-dialog modal-md">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">Edit Product Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form id="editptype">
            <div class="modal-body">
              <div class="form-group">
                <small>Product Type Name:</small>
                <input required type="text" name="editptype_edit" class="form-control" value="<?php echo $pcr[1] ?>" placeholder="Enter Product Category Name">
                <input type="hidden" name="pct_id_edit" value="<?php echo $pct_id ?>">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="editPcat" class="btn btn-outline-light">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->