<?php 
  include '../dbcon.php';
  $pakdates = date("Y-m-d");
  $cashfloats = getCashfloat1($uuser,$pakdates)->fetch_array();
 ?>
<div class="modal-dialog modal-md">
<div class="modal-content bg-secondary">
  <div class="modal-header">
    <h4 class="modal-title">Shift Cash float</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
  </div>
  <form id="cashfloat">
  <div class="modal-body">
    <div class="form-group">
      <p style="margin-bottom: 2px;">Current cash float :</p>
      <h4 style="color:black;padding: 4px;background-color: white;text-indent: 20px;border-radius: 5px;">₱<?php echo number_format($cashfloats['pt_cash'],2) ?></h4>
    </div>
  </div>
  <div class="modal-footer justify-content-between">
    <!-- <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button> -->
    <input type="hidden" name="uuser" value="<?php echo $uuser ?>">
    <input type="text" name="cf_toAdd" required class="form-control" style="width:60%;" placeholder="Amount to add as ( Cash Float )">
    <button type="submit" name="editPcat" class="btn btn-outline-light"><i class="fa fa-plus"></i> Add</button>
  </div>
  </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->