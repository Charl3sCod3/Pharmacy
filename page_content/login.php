<div class="row">
	<div class="col-8">
		<div style="margin:auto;width: 700px;height: auto;">
			<h2 class="typewriter" style="font-size:50px;font-weight: 900;margin-bottom: 2px;color:black">CHARLESCODE</h2>
			<p style="width:80%;font-size: 20px;font-family: tahoma;margin-left:20px;"><b>CHARLESCODE</b> creates custom software solutions that can streamline various business processes, improve data management, automate tasks, and provide valuable insights into business operations.</p>
		</div>
		<div style="width: 700px;margin-left:5%;">
			<h3 style="font-size: 80px;font-family: tahoma;font-weight: 900;color:blue">WEB BASE POINT OF SALE SYSTEM</h3>
		</div>

	</div>
	<div class="col-4">
		<div class="card card-danger" style="margin-top: 20%;border: 2px solid white;">
			<div class="card-header">
				<h4 class="card-title">System Login Form</h4>
			</div>
			<form id="loginForm" method="post" action="includes/queries.php">
				<div class="card-body">
					<p style="width: 100%;text-align: center;">Authorized Personel Only!</p>
					<div class="form-group">
						<small>Username:</small>
						<input type="text" name="solx_username" id="solx_username" class="form-control" placeholder="Ex.juantamad">
					</div>
					<div class="form-group">
						<small>Password:</small>
						<input type="password" name="solx_password" id="solx_password" class="form-control" placeholder="Ex. favorite Singer/Actors">
						<input type="hidden" name="login_user" id="login_user" value="true">
					</div>
					<p style="width: 100%;text-align: center;">___________</p>
					<div style="display: flex;justify-content: space-around;">
						<button style="width: 40%;" type="submit" name="login_user" id="login_user" class="btn btn-success btn-md">
						<i class="fa fa-sign-in"></i> Login
					</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>