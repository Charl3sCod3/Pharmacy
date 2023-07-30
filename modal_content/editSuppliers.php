<?php 
include '../dbcon.php';
$pcq = getSpSupplier($sup_id);
$pcr = $pcq->fetch_array();
?>
<div class="modal-dialog modal-md">
<div class="modal-content bg-secondary">
  <div class="modal-header">
    <h4 class="modal-title">Edit Supplier Data</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
  </div>
  <form id="editSuppliers">
    <input type="hidden" name="editSupData" value="<?php echo $sup_id ?>">
  <div class="modal-body">
          <div class="form-group">
            <p>Company Name:</p>
            <textarea required name="company_name" rows="2" class="form-control" placeholder="Enter Supplier Company"><?php echo $pcr[1] ?></textarea>
          </div>
          <div class="form-group">
            <p>Company Contact:</p>
            <input required type="text" name="contactname" class="form-control" placeholder="Enter contact person name" value="<?php echo $pcr[2] ?>"> 
          </div>
          <div class="form-group">
            <p>Company Email-addres:</p>
            <input type="email" name="company_email" class="form-control" placeholder="Ex. Johndoe@gmail.com" value="<?php echo $pcr[4] ?>">
          </div>
          <div class="form-group">
            <p>Phone Number:</p>
            <textarea name="contactnumber" class="form-control" placeholder="Ex.09062248536 / 09234263453"><?php echo $pcr[3] ?></textarea>
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