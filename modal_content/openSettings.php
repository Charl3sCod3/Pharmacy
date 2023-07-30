<?php 
  include '../dbcon.php';
  $sql = "SELECT * FROM `system_settings` WHERE 1=1 ORDER BY `ss_id` DESC lIMIT 1";
  $query = $con->query($sql);
  $cnrow = $query->num_rows;
  if ($cnrow > 0) {
    $row = $query->fetch_array();
     $cc_name= $row['ss_company'];
     $cc_address = $row['ss_address'];
     $cc_owner = $row['ss_owner'];
     $cc_number = $row['ss_contact'];
  }else{ 
     $cc_name = "";
     $cc_address = "";
     $cc_owner  = "";
     $cc_number = ""; 
  }
 ?>
<div class="modal-dialog modal-md">
  <div class="modal-content bg-secondary">
    <div class="modal-header">
      <h4 class="modal-title">SYSTEM SETTINGS</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    </div>
    <form id="openSettingsUpdate">
    <div class="modal-body">
        <div class="form-group">
            <p>Company Name :</p>
            <textarea name="ss_company_name" class="form-control" placeholder="Ex. CHARLESCODE PHARMACY"><?php echo $cc_name ?></textarea>
          </div>
          <div class="form-group">
            <p>Company Address :</p>
            <textarea name="ss_company_address" class="form-control" placeholder="Ex. P-7 MABINI POB. SAN JOSE DINAGAT ISLANDS"><?php echo $cc_address ?></textarea>
          </div>
          <div class="form-group">
            <p>Company Owner :</p>
            <input type="text" name="ss_company_owner" class="form-control" placeholder="Ex. Charles Macalua" value="<?php echo $cc_owner ?>">
          </div>
          <div class="form-group">
            <p>Contact Number :</p>
            <input type="text" name="ss_company_number" class="form-control" placeholder="Ex. 09062248536" value="<?php echo $cc_number ?>">
          </div>
          <div class="form-group">
            <p>Company Logo :</p>
            <input type="file" name="ss_company_logo" id="file_input" class="form-control" placeholder="Ex. 09062248536" value="<?php echo $cc_number ?>">
          </div>
    </div>
    <div class="modal-footer justify-content-between">
      <button class="btn btn-outline-light float-right"><i class="fa fa-save"></i> Save</button>
    </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->