<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-8 mb-4 mb-lg-0">
			<div class="card">
            	<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Available Roles</h2>
				</div>
				<div class="card-body">
					<table id="user_role_listing" class="table table-striped table-bordered table-hover responsive datatbl" width="100%">
						<thead>
							<tr>
								<th style="width:5%">#</th>
								<th style="width:30%">Role Name</th>
								<th style="width:55%">Description</th>
								<th style="width:10%">Action</th>
							</tr>
						</thead>
							
						<tbody>
						<?php
						$n = 1;
						foreach($roles as $val){
							?>
							<tr>
								<td><?php echo $n;?></td>
								<td><a href="<?php echo $this->config->base_url() . 'permissions/' . $val->role_ref;?>" target="_blank"><?php echo $val->role_name;?></a></td>
								<td><?php echo $val->role_description;?></td>
								<td class="text-center">
									<a href="javascript:void(0)" data-role="<?php echo $val->role_id;?>"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
									<a href="<?php echo $this->config->base_url() . 'permissions/' . $val->role_ref;?>" target="_blank"><i class="fas fa-shield-alt"></i></a></td>
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
		
		<div class="col-lg-4 mb-4 mb-lg-0">
			<div class="card mb-3">
            	<div class="card-header">
					<h2 class="h6 text-uppercase mb-0 role-action-header">Create Role</h2>
				</div>
				<div class="card-body">
				<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'roleform'
					);	
					echo form_open('roles/save', $form);
					
				?>
						<div class="form-group">
	                        <label class="form-control-label">Role Name</label>
	                        <input type="text" id="role_name" name="role_name" placeholder="e.g. Accountant" class="form-control">
	                    </div>
	                    
	                    <div class="form-group">
	                        <label class="form-control-label">Role Description</label>
	                        <textarea id="role_description" name="role_description" placeholder="e.g. Accountant of the institution" class="form-control"></textarea>
	                    </div>
	                    
	                    <div class="form-group">  
	                    	<input type="hidden" id="role_id" name="role_id" value="">     
                        	<button type="button" class="btn btn-primary btn-save-role">Save</button>
                      	</div>
					</form>
				</div>
            </div>
		</div>
	</div>
</section>

<?php
$this->load->view("common/footer");
?>		