<div class="">
	<div class="page-title">
		<div class="title_left">
			<h1>Edit User</h1>
		</div>
		<div class="title_right">
			<div class="pull-right">
				<div class="input-group">
					<a class="btn btn-primary btn-xs" href="<?php echo $this->config->base_url();?>user/index">View All Users</a>
				</div>
			</div>
		</div>
	</div>	
	<div class="clearfix"></div>
		
	<?php
	if($this->session->flashdata('failure')){
		?>
		<div class="alert alert-danger alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#215;</span></button>
			<?php echo $this->session->flashdata('failure');?>
		</div>
		<?php		
	}
	elseif($this->session->flashdata('success')){
		?>
		<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#215;</span></button>
			<?php echo $this->session->flashdata('success');?>
		</div>
		<?php		
	}
	?>		
		
	
	<div class="row row-create">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="x_panel">
				<div class="x_title">
					<h2>Edit Profile</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<?php
					$form = array(
						'class'		=>	'form-horizontal form-label-left validate-form',
						'role'		=>	'form',
						'id' 		=> 	'userform',
						'data-parsley-validate'	=>	''
					);	
					echo form_open('user/edituser', $form);
					?>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_role_id">Role <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php
							$roles = array(
								'id'    	=> 	'role_id',
								'class' 	=> 	'form-control col-md-7 col-xs-12',
								'required'	=>	'required' 
							);
							echo form_dropdown('user_role_id', $role_options, $user[0]['user_role_id'], $roles);
							?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_name">User Name <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_name" name="user_name" required="required" class="form-control col-md-7 col-xs-12" data-parsley-type="alphanum"  data-parsley-length="[6, 20]" readonly="readonly" value="<?php echo $user[0]['user_name'];?>">
						</div>
					</div>
                        
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_firstname">First Name <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_firstname" name="user_firstname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user[0]['user_firstname'];?>">
						</div>
					</div>  
					
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_midname">Middle Name 
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_midname" name="user_midname" class="form-control col-md-7 col-xs-12" value="<?php echo $user[0]['user_midname'];?>">
						</div>
					</div>
                      
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_lastname">Last Name <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_lastname" name="user_lastname" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $user[0]['user_lastname'];?>">
						</div>
					</div>  
                      
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4  col-xs-12" for="user_email">Email <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_email" name="user_email" required="required" class="form-control col-md-7 col-xs-12" data-parsley-type="email" value="<?php echo $user[0]['user_email'];?>">
						</div>
					</div> 
                      
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="user_mobile">Mobile Number <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="user_mobile" name="user_mobile" required="required" class="form-control col-md-7 col-xs-12" data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10" value="<?php echo $user[0]['user_mobile'];?>">
						</div>
					</div>   
							
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
							<button type="submit" class="btn btn-success btn-save">Submit</button>
							<a class="btn btn-default" href="<?php echo $this->config->base_url();?>user/index">Cancel</a>
						</div>
					</div>
						
					</form>
				</div>
			</div>
		</div>
	
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="x_panel">
				<div class="x_title">
					<h2>Edit Organisation Unit</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<?php
					$form = array(
						'class'		=>	'form-horizontal form-label-left validate-form',
						'role'		=>	'form',
						'id' 		=> 	'userorgform',
						'data-parsley-validate'	=>	''
					);	
					echo form_open('user/editorgunit', $form);
					?>
					
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="uo_dept_code">Department <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php
								$departments = array(
									'id'    	=> 	'uo_dept_code',
									'class' 	=> 	'form-control col-md-7 col-xs-12 dept-onchange',
									'required'	=>	'required' 
								);
								echo form_dropdown('uo_dept_code', $department_options, $user_org[0]['dept_code'], $departments);
							?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="uo_brnc_code">Branch <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php
								$branches = array(
									'id'    	=> 	'uo_brnc_code',
									'class' 	=> 	'form-control col-md-7 col-xs-12 branch',
									'required'	=>	'required' 
								);
								echo form_dropdown('uo_brnc_code', $branch_options, $user_org[0]['brnc_code'], $branches);
							?>
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12" for="uo_desg_code">Designation <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<?php
								$designations = array(
									'id'    	=> 	'uo_desg_code',
									'class' 	=> 	'form-control col-md-7 col-xs-12',
									'required'	=>	'required' 
								);
								echo form_dropdown('uo_desg_code', $designation_options, $user_org[0]['desg_code'], $designations);
							?>
						</div>
					</div>
					 
							
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
							<input type="hidden" name="uo_user_name" value="<?php echo $user[0]['user_name'];?>">
							<button type="submit" class="btn btn-success btn-save">Submit</button>
							<a class="btn btn-default" href="<?php echo $this->config->base_url();?>user/index">Cancel</a>
						</div>
					</div>
						
					</form>
				</div>
			</div>
		
			<div class="x_panel">
				<div class="x_title">
					<h2>Reset Password</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<?php
					$form = array(
						'class'		=>	'form-horizontal form-label-left validate-form',
						'role'		=>	'form',
						'id' 		=> 	'userorgform',
						'data-parsley-validate'	=>	''
					);	
					echo form_open('user/reset_password', $form);
					?>
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
								<input type="hidden" name="rp_user_name" value="<?php echo $user[0]['user_name'];?>">
								<button type="submit" class="btn btn-danger btn-reset-pass">Reset Password</button><br>
								<small>Password will reset to 123456</small>
							</div>
						</div>
					</form>
				</div>
			</div>	
		
		</div>
	
	</div>
	

</div>			


<?php
$this->load->view("common/footer");
?>
