<?php 
  include '../dbcon.php';
$urq = getSpUser($ur_id);
$ur = $urq->fetch_array();
 ?>
        <div class="modal-dialog modal-md">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">User Information</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <form id="edituserdataForm" method="post" action="includes/queries.php" enctype="multipart/form-data">
            <div class="modal-body">
                  <div class="form-group">
                    <input value="<?php echo $ur_id ?>" type="hidden" id="ur_id" name="ur_id" class="form-control" placeholder="Ex. 09124355353">

                    <small>Full Name :</small>
                    <input value="<?php echo $ur['user_fullname'] ?>" required="" type="text" id="fullnameEdit" name="fullnameEdit" class="form-control" placeholder="Ex. Juan O. Tamad">
                  </div>
                  <div class="form-group">
                    <small>GENDER :</small>
                    <select id="gender" name="gender" class="form-control">
                      <option selected="" disabled="" value="">SELECT GENDER</option>
                      <option <?php echo selected($ur['user_gender'],"Male"); ?> value="Male">Male</option>
                      <option <?php echo selected($ur['user_gender'],"Female"); ?> value="FeMale">Female</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <small>Contact :</small>
                    <input value="<?php echo $ur['user_contact'] ?>" required="" type="text" id="contact" name="contact" class="form-control" placeholder="Ex. 09124355353">
                  </div>
                  <div class="form-group">
                    <small>Address :</small>
                    <input value="<?php echo $ur['user_address'] ?>" required="" type="text" id="Address" name="Address" class="form-control" placeholder="Purok | Barangay | Municipality | Dinagat Islands">
                  </div>
                  <div class="form-group">
                    <small>Username :</small>
                    <input value="<?php echo $ur['user_name'] ?>" required="" type="text" id="username" name="username" autocomplete="off" class="form-control" placeholder="Ex. Narda">
                    <div class="form-group">
                    <small>Password :</small>
                    <input value="<?php echo $ur['user_password'] ?>" required="" type="password" id="password" name="password" autocomplete="off" class="form-control" placeholder="">
                  </div>
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button type="submit" name="addnewProduct" class="btn btn-outline-light">Save</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->