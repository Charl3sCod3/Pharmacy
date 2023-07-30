<?php 
  include '../dbcon.php';
  $gsu = getSpUser($ur_id);
  $gsur = $gsu->fetch_array();
 ?>
        <div class="modal-dialog modal-md">
          <div class="modal-content bg-secondary">
            <div class="modal-header">
              <h4 class="modal-title">New User Application Information</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                  <div style="height: 250px;overflow: hidden;">
                    <img style="width: 100%;height: 100%;" src="images/<?php echo $gsur['user_img'] ?>">
                  </div>
                </div>
                <div class="col-6">
                  <h5>
                    <small>Full Name:</small> <br>
                    <?php echo $gsur['user_fullname'] ?>
                  </h5>
                  <h6>
                    <small>Gender:</small> <br>
                    <?php echo $gsur['user_gender'] ?>
                  </h6>
                  <h6>
                    <small>Contact:</small> <br>
                    <?php echo $gsur['user_contact'] ?>
                  </h6>
                  <h6>
                    <small>Address:</small> <br>
                    <?php echo $gsur['user_address'] ?>
                  </h6>
                  <h6>
                    <small>Identification Card:</small> <br>
                    <a style="cursor: pointer;" onclick="window.open('identificationCard.php?id=<?php echo $gsur['userVerification'] ?>', 'Check ID', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700px, height=400px, top=100, left=100')"><?php echo $gsur['userVerification'] ?></a>
                  </h6>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
              <button onclick="approveuser('<?php echo $gsur[0] ?>')" class="btn btn-outline-light">Approve</button>
              <button onclick="disapprove('<?php echo $gsur[0] ?>')" class="btn btn-outline-light">Disapprove</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->