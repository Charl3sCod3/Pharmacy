<div class="card">
	<div class="card-header">
		<h4 class="card-title">LIST OF SYSTEM USERS</h4>
	</div>
	<div class="card-body">
		<table id="example2" class="table table-bordered" style="font-size:13px;">
			<thead style="background-color:#646464;color:white;">
				<th>#</th>
				<th>Fullname</th>
				<th>POSITION</th>
				<th>Contact</th>
				<th>Gender</th>
				<th>User Status</th>
				<th>OPT</th>
			</thead>
			<tbody>
				<?php 
					$u = getSystem_usersActives();
					$i=0;
					while ($ur = $u->fetch_array()) {
						$i++;
				 ?>
				 <tr>
				 	<td><?php echo $i ?></td>
				 	<td><?php echo strtoupper($ur['user_fullname']) ?></td>
				 	<td><?php echo strtoupper($ur['useraccessis']) ?></td>
				 	<td><?php echo $ur['user_contact'] ?></td>
				 	<td><?php echo $ur['user_gender'] ?></td>
				 	<td><?php echo $ur['statusis'] ?></td>
				 	<td>
				 		<button class="btn btn-xs btn-primary float-right" data-toggle="dropdown" style="height: 28px;width: 28px;border-radius: 50%;"><i class="fa fa-ellipsis-v"></i>
                              <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" onclick="editUserData1('<?php echo $ur[0] ?>')" >View Information</a>
                                <?php if ($ur['user_status']==1 && $ur['user_access'] != 1): ?>
                                	<a onclick="diactivateUser('<?php echo $ur[0] ?>')" class="dropdown-item"  >Diactivate</a>
                                <?php else: ?>
                                	<a onclick="activateUser('<?php echo $ur[0] ?>')" class="dropdown-item" >Activate</a>
                                <?php endif ?>
                              </div>
                            </button>
                     </td>
				 </tr>
				<?php } ?>
			</tbody> 
		</table>
	</div>
</div>