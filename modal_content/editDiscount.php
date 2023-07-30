<?php 
  include '../dbcon.php';
  $row = getSpDiscounts($pt_id)->fetch_array();
 ?>
<div class="modal-dialog modal-md">
  <div class="modal-content bg-secondary">
    <div class="modal-header">
      <h4 class="modal-title">Edit Discount Data</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    </div>
    <form id="editDiscount">
    <div class="modal-body">
      <div class="form-group">
        <p style="margin-bottom: 2px;">Description :</p>
        <input type="hidden" name="d_id" value="<?php echo $pt_id ?>">
        <input type="text" name="d_desc" class="form-control" value="<?php echo $row['ddesc'] ?>" placeholder="Ex.Senior Citizen">
      </div>
      <div class="form-group">
        <p style="margin-bottom: 2px;">Percent :</p>
        <input type="number" name="dp" value="<?php echo $row['dp'] ?>" class="form-control" placeholder="Ex.Senior Citizen">
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
      <button type="submit" name="" class="btn btn-outline-light">Update</button>
    </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->