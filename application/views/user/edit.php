<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card mb-3">
            	<div class="card-body">
                	<div class="row align-items-center flex-row">
                		<div class="col-lg-2">
                			<img src="<?php echo getFileLocation('user-profile') . $user->user_photo;?>" alt="<?php echo $user->user_name;?>" class="rounded-circle my-2">
                			<br>
                			<a href="">Change Photo</a>
                  		</div>
                  		<div class="col-lg-10">
                  			<h2 class="mx-auto mb-4 text-uppercase"><?php echo $user->user_fullname;?></h2>
                  		<?php
							$form = array(
								'class'		=>	'',
								'role'		=>	'form',
								'id' 		=> 	'userform'
							);	
							echo form_open('users/edit', $form);
						?>
						
								<div class="form-group row">
									<label class="col-md-2 form-control-label">Name</label>
									<div class="col-md-3">
										<input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="First name" value="<?php echo $user->user_firstname;?>">
									</div>
									<div class="col-md-3">
										<input type="text" name="user_midname" id="user_midname" class="form-control" placeholder="Middle name" value="<?php echo $user->user_midname;?>">
									</div>
									<div class="col-md-3">
										<input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="Last name" value="<?php echo $user->user_lastname;?>">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-md-2 form-control-label">Role</label>
									<div class="col-md-3">
										<?php
											$roles = array(
												'id'    => 	'user_role_id',
												'class' => 	'form-control'
											);
											echo form_dropdown('user_role_id', $role_options, $user->user_role_id, $roles);
										?>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-md-2 form-control-label">Phone</label>
									<div class="col-md-3">
										<input type="text" name="user_mobile" id="user_mobile" class="form-control" placeholder="Mobile Number" value="<?php echo $user->user_mobile;?>">
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-md-2 form-control-label">Email</label>
									<div class="col-md-3">
										<input type="text" name="user_email" id="user_email" class="form-control" placeholder="Email Address" value="<?php echo $user->user_email;?>">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-md-10 ml-auto">
										<button type="button" class="btn btn-primary btn-user-save">Save</button>
										&nbsp;<a href="<?php echo $this->config->base_url();?>users/<?php echo $user->user_ref;?>">Cancel</a>
									</div>
								</div>
									
							</form>
                  		</div>
                  		
                	</div>
              	</div>
            </div>
		</div>
	</div>
</section>

<?php
$this->load->view("common/footer");
?>		