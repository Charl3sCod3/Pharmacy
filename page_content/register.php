<div class="row">
	<div class="col-3"></div>
	<div class="col-6">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">NEW SYSTEM USER FORM</h4>
			</div>
			<form id="resgisterForm" method="post" action="includes/queries.php" enctype="multipart/form-data">
				<div class="card-body">
					<div class="form-group">
						<small>Full Name :</small>
						<input required="" type="text" id="fullnamexx" name="fullnamexx" class="form-control" placeholder="Ex. Juan O. Tamad">
					</div>
					<div class="form-group">
						<small>Gender :</small>
						<select id="gender" name="gender" class="form-control">
							<option selected="" disabled="" value="">SELECT GENDER</option>
							<option value="Male">Male</option>
							<option value="FeMale">Female</option>
						</select>
					</div>
					<div class="form-group">
						<small>User Position :</small>
						<select id="userposition" name="userposition" class="form-control">
							<option selected="" disabled="" value="">SELECT POSITION</option>
							<option value="1">Administrator</option>
							<option value="2">Cashier</option>
							<option value="3">inventory manager</option>
							<option value="4">user 4</option>
						</select>
					</div>
					<div class="form-group">
						<small>Contact :</small>
						<input required="" type="text" id="contact" name="contact" class="form-control" placeholder="Ex. 09124355353">
					</div>
					<div class="form-group">
						<small>User-Image :</small>
						<input required="" type="file" id="user_img" name="user_img" class="form-control" >
					</div>
					<div class="form-group">
						<small>Username :</small>
						<input required="" type="text" id="username" name="username" autocomplete="off" class="form-control" placeholder="Ex. Narda">
						<div class="form-group">
						<small>Password :</small>
						<input required="" type="password" id="password" name="password" autocomplete="off" class="form-control" placeholder="">
					</div>
					</div>
				</div>
				<div class="card-footer">
					<button type="Submit" id="newuser" name="newuser" class="btn btn-success btn-md float-right"><i class="fa fa-save"></i> ADD NEW USER</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-3"></div>
</div>