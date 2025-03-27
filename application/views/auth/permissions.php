<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
            	<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Selected Role</h2>
				</div>
				<div class="card-body">
					<h4 class="text-uppercase mb-0"><?php echo $role->role_name;?></h4>
					<p class="text-muted"><?php echo $role->role_name;?></p>
				</div>			
            </div>
		</div>
	</div>
</section>

<section class="pb-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
            	<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Assign Permission(s)</h2>
				</div>
				<div class="card-body">
				<?php
					$form = array(
						'class'		=>	'',
						'role'		=>	'form',
						'id' 		=> 	'roleform'
					);	
					echo form_open('auth/save_permission', $form);
				?>	
					<input type="hidden" id="hidden_role_id"  name="hidden_role_id" value="<?php echo $selected_role;?>">
					<input type="hidden" id="hidden_role_ref" name="hidden_role_ref" value="<?php echo $role->role_ref;?>">
					<input type="hidden" id="hidden_acl" name="hidden_acl" value="">
						<div class="form-group row">
	                        <label class="col-md-2 form-control-label">Module</label>
							<div class="col-md-3">
	                        <?php
								$modules = array(
									'id'    => 	'module_name',
									'class' => 	'form-control change-module'
								);
								$module_arr = array_merge(array(''=>''), $module_options);
								echo form_dropdown('module_name', $module_arr, null, $modules);
							?>
							</div>
	                    </div>
	                    
	                    <div class="col-md-12" id="acl_list" style="display: none;">
							<table class="table table-hover">
								<thead>
									<tr>
										<th style="width:5%;">#</th>
										<th style="width:30%;">URL</th>
										<th style="width:45%;">Description</th>
										<th style="width:20%;">Has Access?</th>
									</tr>
								</thead>
								
								<tbody></tbody>
							</table>
							
							<div class="form-group">
								<button type="button" class="mr-3 btn btn-primary btn-assign-access">Assign</button>
								<a href="<?php echo $this->config->base_url();?>roles">Cancel</a>
							</div>
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