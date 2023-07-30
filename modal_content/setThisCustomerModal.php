<?php 
include '../dbcon.php';
$gcdq = getSpActiveCustomer($c_id);
$gcdr = $gcdq->fetch_array();
?>
<div class="modal-dialog modal-md">
  <div class="modal-content bg-secondary">
    <div class="modal-header">
      <h4 class="modal-title">Select or Edit Customer</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    </div>
    <form id="updateCustomerData">
      <input type="hidden" name="c_id_updateData" value="<?php echo $c_id ?>">
    <div class="modal-body">
      <div class="form-group">
        <p>Customer Name: </p>
        <input type="text" name="cname" value="<?php echo $gcdr['cname'] ?>" class="form-control" placeholder="First name | Last name">
      </div>
      <div class="form-group">
        <p>Customer Contact: </p>
        <input type="text" name="cphone" value="<?php echo $gcdr['cphone'] ?>" class="form-control" placeholder="Contact Number">
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <a onclick="setThisCustomer('<?php echo $c_id ?>')" class="btn btn-md btn-primary"> View Item List</a>
      <button type="submit" name="editPcat" class="btn btn-outline-light">Update Customer Name</button>
      <a onclick="removeActiveCustomer('<?php echo $c_id ?>')" class="btn btn-outline-light btn-danger" >Remove</a>
    </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->