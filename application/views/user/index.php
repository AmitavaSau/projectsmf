<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Available Users</h2>
				</div>
				<div class="card-body">
					<table id="user_activity_listing" class="table table-striped table-bordered table-hover responsive datatbl" width="100%">
							<thead>
								<tr>
									<th style="width:5%">#</th>
									<th style="width:10%">Username</th>
									<th style="width:20%">Fullname</th>
									<th style="width:15%">Phone</th>
									<th style="width:25%">Email</th>
									<th style="width:15%">Role</th>
									<th style="width:10%">Action</th>
								</tr>
							</thead>
								
							<tbody>
								<?php
								$n = 1;
								foreach($users as $val){
									?>
									<tr>
										<td><?php echo $n;?></td>
										<td>
										<div class="d-flex align-items-center flex-column flex-lg-row text-center text-md-left">
											<img src="<?php echo getFileLocation('user-profile') . $val->user_photo;?>" class="rounded-circle mr-2 my-1 my-lg-0" style="max-width: 2.25rem;">&nbsp;<a href="<?php echo $this->config->base_url();?>users/<?php echo $val->user_ref;?>"><?php echo $val->user_name;?></a>	
										</div>
										</td>
										<td><?php echo $val->user_fullname;?></td>
										<td><?php echo $val->user_mobile;?></td>
										<td><?php echo $val->user_email;?></td>
										<td><?php echo $val->role_name;?></td>
										<td class="text-center"><a href="<?php echo $this->config->base_url();?>users/edit/<?php echo $val->user_ref;?>"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
										<a href="<?php echo $this->config->base_url();?>activity-log/<?php echo $val->user_name;?>"><i class="fas fa-chess-bishop"></i></a></td>
									</tr>
									<?php	
									$n++;	
								}
								?>
							</tbody>
								
						</table>
				</div>
			</div>
		</div>
	</div>
		
</section>


<?php
$this->load->view("common/footer");
?>