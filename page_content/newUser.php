<div class="card">
	<div class="card-header">
		<h4 class="card-title"><?php echo $admin_title ?></h4>
	</div>
	<div class="card-body">
		<table id="example2" class="table table-bordered" style="font-size:13px;">
			<thead>
				<th>#</th>
				<th>Fullname</th>
				<th>Address</th>
				<th>Contact</th>
				<th>Gender</th>
				<th>OPT</th>
			</thead>
			<tbody>
				<?php 
					$u = getSystem_usersNew();
					$i=0;
					while ($ur = $u->fetch_array()) {
						$i++;
				 ?>
				 <tr>
				 	<td><?php echo $i ?></td>
				 	<td><?php echo strtoupper($ur['user_fullname']) ?></td>
				 	<td><?php echo strtoupper($ur['user_address']) ?></td>
				 	<td><?php echo $ur['user_contact'] ?></td>
				 	<td><?php echo $ur['user_gender'] ?></td>
				 	<td><button class="btn btn-xs btn-primary float-right" data-toggle="dropdown" style="height: 28px;width: 28px;border-radius: 50%;"><i class="fa fa-ellipsis-v"></i>
                              <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" 
                                 onclick="ViewUserApplication('<?php echo $ur[0] ?>')" 
                                 >View User Application</a>
                              </div>
                            </button></td>
				 </tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>