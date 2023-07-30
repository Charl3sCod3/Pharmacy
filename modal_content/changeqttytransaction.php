<?php 
  include '../dbcon.php';
  $sql = "SELECT * FROM `customer_order` WHERE `co_id`='$or_id'";
  $query = $con->query($sql);
  $row = $query->fetch_array();
 ?>
<div class="modal-dialog modal-sm">
<div class="modal-content bg-secondary">
  <div class="modal-header">
    <h4 class="modal-title">Change Quantity</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
  </div>
  <form id="changetransqtty">
  <div class="modal-body">
    <div class="form-group">
      <p>Quantity</p>
      <input type="hidden" name="qttyupdatetrans" value="<?php echo $or_id ?>">
      <input type="number" name="qttyis" class="form-control" value="<?php echo $row['co_qtty'] ?>">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" name="editPcat" class="btn btn-outline-light float-right"><i class="fa fa-save"></i> Update</button>
  </div>
  </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->